<?php
// File: app/Controllers/CartController.php

class CartController extends Controller
{
    private $productModel;
    private $voucherModel;

    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->voucherModel = $this->model('VoucherModel');
    }

    /**
     * HÀM ADD (ĐÃ SỬA DÙNG variant_id)
     * Xử lý AJAX
     */
    public function add($variant_id)
    {
        try {
            $variant = $this->productModel->getVariantById($variant_id);
            if (!$variant || $variant['stock_quantity'] <= 0) {
                throw new Exception('Sản phẩm không tồn tại hoặc đã hết hàng.');
            }

            $quantity = (isset($_POST['quantity']) && (int)$_POST['quantity'] > 0) ? (int)$_POST['quantity'] : 1;

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Kiểm tra số lượng hiện có trong giỏ
            $current_in_cart = $_SESSION['cart'][$variant_id] ?? 0;
            $new_quantity = $current_in_cart + $quantity;

            // Kiểm tra xem số lượng mới có vượt quá tồn kho không
            if ($new_quantity > $variant['stock_quantity']) {
                $_SESSION['cart'][$variant_id] = $variant['stock_quantity']; // Chỉ cho phép mua tối đa
                throw new Exception('Số lượng trong giỏ vượt quá tồn kho!');
            } else {
                $_SESSION['cart'][$variant_id] = $new_quantity;
            }

            // Tính toán lại tổng số lượng
            $cart_total_quantity = array_sum($_SESSION['cart']);

            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ!',
                'cartCount' => $cart_total_quantity
            ]);
            exit();
        } catch (Exception $e) {
            header('Content-Type: application/json');
            http_response_code(400); // 400 Bad Request
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit();
        }
    }

    /**
     * HÀM INDEX (ĐÃ SỬA DÙNG variant_id)
     * Hiển thị trang giỏ hàng
     */
    public function index()
    {
        $cart_data = $_SESSION['cart'] ?? [];
        $variant_ids = array_keys($cart_data);

        $variants = [];
        $subtotal = 0;
        if (!empty($variant_ids)) {
            // Lặp qua từng variant_id để lấy thông tin chi tiết
            foreach ($variant_ids as $id) {
                $variant = $this->productModel->getVariantById($id);
                if ($variant) {
                    $variants[] = $variant; // Thêm biến thể vào mảng
                    $quantity = $cart_data[$id];
                    $price = ($variant['price_sale'] > 0) ? $variant['price_sale'] : $variant['price'];
                    $subtotal += $price * $quantity;
                } else {
                    // Nếu sản phẩm bị xóa, tự động xóa khỏi giỏ
                    unset($_SESSION['cart'][$id]);
                }
            }
        }

        // --- XỬ LÝ VOUCHER ---
        $voucher_code = $_SESSION['voucher']['code'] ?? null;
        $voucher_discount = $_SESSION['voucher']['discount'] ?? 0;
        $voucher_error = $_SESSION['voucher_error'] ?? null;
        $voucher_info = $_SESSION['voucher']['info'] ?? null;
        unset($_SESSION['voucher_error']);

        $grand_total = $subtotal - $voucher_discount;

        $data = [
            'title' => 'Giỏ hàng của bạn',
            'variants' => $variants, // Đổi tên thành variants
            'cart' => $cart_data,
            'subtotal' => $subtotal,
            'voucher_code' => $voucher_code,
            'voucher_discount' => $voucher_discount,
            'grand_total' => $grand_total,
            'voucher_error' => $voucher_error,
            'voucher_info' => $voucher_info
        ];

        $this->view('cart/index', $data);
    }

    // HÀM REMOVE (ĐÃ SỬA: TRẢ VỀ JSON)
    public function remove($variant_id)
    {
        try {
            if (isset($_SESSION['cart'][$variant_id])) {
                unset($_SESSION['cart'][$variant_id]);
            }
            // Xóa voucher vì giỏ hàng đã thay đổi
            unset($_SESSION['voucher']);

            // Tính toán lại tổng số lượng
            $cart_total_quantity = array_sum($_SESSION['cart'] ?? []);

            // Tính toán lại tổng tiền (để cập nhật giao diện nếu đang ở trang cart)
            $totals = $this->calculateTotals();

            // Trả về JSON thành công
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Đã xóa sản phẩm.',
                'cartCount' => $cart_total_quantity, // Gửi số lượng mới về
                'subtotal' => $totals['subtotal'],
                'discount' => $totals['voucher_discount'],
                'grandTotal' => $totals['grand_total'],
                'voucherCode' => null,
                'voucherError' => null
            ]);
            exit();
        } catch (Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit();
        }
    }
    // SỬA LẠI TOÀN BỘ HÀM UPDATE
    public function update()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu không hợp lệ');
            }

            $quantities = $_POST['quantity'] ?? [];
            if (empty($quantities)) {
                throw new Exception('Không có dữ liệu cập nhật');
            }

            // Mảng để lưu giá mới của từng item
            $updated_item_totals = [];

            foreach ($quantities as $variant_id => $quantity) {
                $quantity = (int)$quantity;
                $variant = $this->productModel->getVariantById($variant_id);

                if (!$variant) continue; // Bỏ qua nếu không tìm thấy variant

                if ($quantity > $variant['stock_quantity']) {
                    $_SESSION['cart'][$variant_id] = $variant['stock_quantity'];
                    // Trả về lỗi nếu vượt tồn kho
                    throw new Exception('Số lượng sản phẩm "' . $variant['product_name'] . '" vượt quá tồn kho!');
                } elseif ($quantity > 0) {
                    $_SESSION['cart'][$variant_id] = $quantity;
                    // Tính giá mới cho item này
                    $price = ($variant['price_sale'] > 0) ? $variant['price_sale'] : $variant['price'];
                    $updated_item_totals[$variant_id] = $price * $quantity;
                } else {
                    // Nếu số lượng là 0, xóa item
                    unset($_SESSION['cart'][$variant_id]);
                    $updated_item_totals[$variant_id] = 0; // Giá mới là 0
                }
            }

            // Xóa voucher vì giỏ hàng đã thay đổi
            unset($_SESSION['voucher']);

            // Tính toán lại toàn bộ
            $totals = $this->calculateTotals();

            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Đã cập nhật giỏ hàng.',
                'cartCount' => $totals['cart_total_quantity'],
                'subtotal' => $totals['subtotal'],
                'discount' => $totals['voucher_discount'],
                'grandTotal' => $totals['grand_total'],
                'voucherCode' => null, // Xóa voucher
                'voucherError' => 'Voucher đã được làm mới, vui lòng áp dụng lại.',
                'itemTotals' => $updated_item_totals // TRẢ VỀ GIÁ MỚI CỦA ITEM
            ]);
            exit();
        } catch (Exception $e) {
            header('Content-Type: application/json');
            http_response_code(400); // 400 Bad Request
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit();
        }
    }

    /**
     * HÀM APPLY VOUCHER (ĐÃ SỬA)
     * Xử lý AJAX
     */
    public function applyVoucher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code = strtoupper(trim($_POST['voucher_code']));
            unset($_SESSION['voucher']);
            unset($_SESSION['voucher_error']);
            $voucher_code_applied = null;

            if (empty($code)) {
                $_SESSION['voucher_error'] = 'Vui lòng nhập mã voucher.';
            } else {
                $voucher = $this->voucherModel->findVoucherByCode($code);
                if ($voucher) {
                    $totals = $this->calculateTotals(); // Lấy subtotal

                    if ($totals['subtotal'] >= $voucher['min_order_value']) {
                        $discount = 0;
                        if ($voucher['type'] == 'percent') {
                            $discount = ($totals['subtotal'] * $voucher['value']) / 100;
                        } else {
                            $discount = $voucher['value'];
                        }
                        $discount = min($discount, $totals['subtotal']);
                        $_SESSION['voucher'] = [
                            'id' => $voucher['id'],
                            'code' => $voucher['code'],
                            'discount' => $discount,
                            'info' => $voucher
                        ];
                        $voucher_code_applied = $voucher['code'];
                    } else {
                        $_SESSION['voucher_error'] = 'Đơn hàng chưa đủ điều kiện (' . number_format($voucher['min_order_value']) . ' VNĐ).';
                    }
                } else {
                    $_SESSION['voucher_error'] = 'Mã voucher không hợp lệ.';
                }
            }

            // Tính toán lại lần cuối
            $totals = $this->calculateTotals();

            // Trả về JSON
            header('Content-Type: application/json');
            echo json_encode([
                'success' => $voucher_code_applied ? true : false,
                'message' => $voucher_code_applied ? 'Áp dụng mã thành công!' : 'Áp dụng mã thất bại!',
                'cartCount' => $totals['cart_total_quantity'],
                'subtotal' => $totals['subtotal'],
                'discount' => $totals['voucher_discount'],
                'grandTotal' => $totals['grand_total'],
                'voucherCode' => $voucher_code_applied,
                'voucherError' => $_SESSION['voucher_error'] ?? null
            ]);
            exit();
        }
    }

    /**
     * HÀM TRỢ GIÚP (ĐÃ SỬA)
     * Tính toán lại toàn bộ giỏ hàng
     */
    private function calculateTotals()
    {
        $cart_data = $_SESSION['cart'] ?? [];
        $variant_ids = array_keys($cart_data);

        $subtotal = 0;
        if (!empty($variant_ids)) {
            foreach ($variant_ids as $id) {
                $variant = $this->productModel->getVariantById($id);
                if ($variant) {
                    $quantity = $cart_data[$id];
                    $price = ($variant['price_sale'] > 0) ? $variant['price_sale'] : $variant['price'];
                    $subtotal += $price * $quantity;
                }
            }
        }

        $voucher_discount = 0;
        $voucher_code = $_SESSION['voucher']['code'] ?? null;
        if ($voucher_code) {
            $voucher = $this->voucherModel->findVoucherByCode($voucher_code);
            if ($voucher && $subtotal >= $voucher['min_order_value']) {
                if ($voucher['type'] == 'percent') {
                    $voucher_discount = ($subtotal * $voucher['value']) / 100;
                } else {
                    $voucher_discount = $voucher['value'];
                }
                $voucher_discount = min($voucher_discount, $subtotal);
                $_SESSION['voucher']['discount'] = $voucher_discount;
            } else {
                unset($_SESSION['voucher']);
                $_SESSION['voucher_error'] = 'Voucher không còn hợp lệ.';
            }
        }

        $grand_total = $subtotal - $voucher_discount;
        $cart_total_quantity = array_sum($cart_data);

        return [
            'subtotal' => $subtotal,
            'voucher_discount' => $voucher_discount,
            'grand_total' => $grand_total,
            'cart_total_quantity' => $cart_total_quantity,
            'voucherCode' => $_SESSION['voucher']['code'] ?? null,
            'voucherError' => $_SESSION['voucher_error'] ?? null
        ];
    }
}
