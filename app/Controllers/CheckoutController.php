<?php
// File: app/Controllers/CheckoutController.php

class CheckoutController extends Controller
{
    private $userModel;
    private $productModel;
    private $orderModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('ProductModel');
        $this->orderModel = $this->model('OrderModel');
    }

    public function index()
    {
        // 1. KIỂM TRA ĐĂNG NHẬP
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/user/login');
            exit();
        }

        // 2. KIỂM TRA GIỎ HÀNG
        $cart_data = $_SESSION['cart'] ?? [];
        if (empty($cart_data)) {
            header('Location: ' . URLROOT . '/cart');
            exit();
        }

        // 3. XỬ LÝ KHI NGƯỜI DÙNG NHẤN "ĐẶT HÀNG" (POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // ---- TÍNH TOÁN LẠI TỔNG TIỀN (Bảo mật) ----
            $variant_ids = array_keys($cart_data);
            $subtotal = 0;
            $cartItemsForDB = [];

            foreach ($variant_ids as $id) {
                $variant = $this->productModel->getVariantById($id);
                if ($variant) {
                    $quantity = $cart_data[$id];
                    // Lấy giá đúng (sale hoặc gốc)
                    $price = ($variant['price_sale'] > 0) ? $variant['price_sale'] : $variant['price'];
                    $subtotal += $price * $quantity;
                    // Chuẩn bị dữ liệu cho bảng order_details
                    $cartItemsForDB[] = [
                        'product_variant_id' => $id, // ID của biến thể
                        'quantity' => $quantity,
                        'price' => $price // Giá tại thời điểm mua
                    ];
                }
            }
            // Lấy thông tin voucher (nếu có)
            $voucher_discount = $_SESSION['voucher']['discount'] ?? 0;
            $grand_total = $subtotal - $voucher_discount;
            // --------------------------------------------------

            // Chuẩn bị dữ liệu cho bảng `orders`
            $orderData = [
                'user_id' => $_SESSION['user_id'],
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address_detail']) . ', ' . trim($_POST['ward']) . ', ' . trim($_POST['district']) . ', ' . trim($_POST['city']),
                'total_amount' => $grand_total, // Dùng tổng cuối cùng
                'voucher_code' => $_SESSION['voucher']['code'] ?? null,
                'voucher_discount' => $voucher_discount,
                'payment_method' => trim($_POST['payment_method']), // Lấy phương thức TT
                'shipping_method' => trim($_POST['shipping_method']) // Lấy phương thức VC
            ];

            // Gọi OrderModel để lưu
            $orderId = $this->orderModel->createOrder($orderData, $cartItemsForDB);

            if ($orderId) {
                // --- [MỚI] GỬI EMAIL XÁC NHẬN ---
                require_once '../app/core/Mailer.php';
                $mailer = new Mailer();

                // Chuẩn bị danh sách sản phẩm để gửi mail (có tên, màu, dung lượng)
                $emailItems = [];
                foreach ($cartItemsForDB as $item) {
                    $variant = $this->productModel->getVariantById($item['product_variant_id']);
                    $emailItems[] = [
                        'product_name' => $variant['product_name'] . ' (' . $variant['storage'] . ' - ' . $variant['color'] . ')',
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ];
                }

                // Gửi mail
                $mailer->sendOrderConfirmation(
                    $orderData['email'],
                    $orderData['full_name'],
                    $orderId,
                    $grand_total,
                    $emailItems
                );
                // Xóa giỏ hàng VÀ voucher
                unset($_SESSION['cart']);
                unset($_SESSION['voucher']);

                // KIỂM TRA PHƯƠNG THỨC THANH TOÁN
                $payment_method = trim($_POST['payment_method']);

                if ($payment_method == 'bank') {
                    // Nếu là Chuyển khoản -> Chuyển đến trang hiển thị QR
                    header('Location: ' . URLROOT . '/checkout/show_qr/' . $orderId);
                    exit();
                } else {
                    // Nếu là COD hoặc Ví điện tử (chưa tích hợp API) -> Chuyển đến trang thành công
                    header('Location: ' . URLROOT . '/checkout/success/' . $orderId);
                    exit();
                }
            } else {
                die('Đặt hàng thất bại, vui lòng thử lại.');
            }
        } else {
            // 4. NẾU LÀ GET REQUEST (HIỂN THỊ FORM)
            // (Code này đã đúng, lấy chi tiết sản phẩm và tính tổng)
            $variant_ids = array_keys($cart_data);
            $variants_in_cart = [];
            $subtotal = 0;
            if (!empty($variant_ids)) {
                foreach ($variant_ids as $id) {
                    $variant = $this->productModel->getVariantById($id);
                    if ($variant) {
                        $variants_in_cart[] = $variant;
                        $quantity = $cart_data[$id];
                        $price = ($variant['price_sale'] > 0) ? $variant['price_sale'] : $variant['price'];
                        $subtotal += $price * $quantity;
                    }
                }
            }
            $user = $this->userModel->getUserById($_SESSION['user_id']);
            $voucher_discount = $_SESSION['voucher']['discount'] ?? 0;
            $grand_total = $subtotal - $voucher_discount;

            $data = [
                'title' => 'Thanh toán',
                'user' => $user,
                'cart_items' => $variants_in_cart,
                'cart_data' => $cart_data,
                'subtotal' => $subtotal,
                'voucher_discount' => $voucher_discount,
                'grand_total' => $grand_total
            ];
            $this->view('checkout/index', $data);
        }
    }


    // Hàm hiển thị trang đặt hàng thành công
    public function success($orderId = 0)
    {
        // Kiểm tra nếu không có ID
        if ($orderId == 0) {
            header('Location: ' . URLROOT . '/');
            exit();
        }

        // Gán vào biến cục bộ để tránh cảnh báo (không bắt buộc nhưng tốt hơn)
        $id = $orderId;

        $data = [
            'title' => 'Đặt hàng thành công!',
            'orderId' => $id // Sử dụng biến cục bộ $id
        ];

        $this->view('checkout/success', $data);
    }
    public function show_qr($orderId = 0)
    {
        // Lấy thông tin đơn hàng (để biết số tiền)
        // Chúng ta dùng hàm của Admin để lấy vì hàm của User cần user_id (mà ở đây ta có thể bỏ qua check user_id cho tiện, hoặc check thêm nếu muốn bảo mật kỹ hơn)
        $order = $this->orderModel->getOrderById_Admin($orderId);

        if (!$order) {
            header('Location: ' . URLROOT . '/');
            exit();
        }

        $data = [
            'title' => 'Thanh toán QR cho Đơn hàng #' . $orderId,
            'order' => $order
        ];

        $this->view('checkout/show_qr', $data);
    }
} // Kết thúc class
