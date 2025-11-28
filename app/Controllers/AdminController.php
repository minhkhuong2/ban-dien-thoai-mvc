<?php
// File: app/Controllers/AdminController.php

class AdminController extends Controller
{
    // Khai báo tất cả các Model mà Admin sẽ dùng
    private $brandModel;
    private $productModel;
    private $orderModel;
    private $userModel;
    private $voucherModel;
    private $postModel;
    private $attributeModel;
    private $categoryModel;
    private $productCategoryModel;
    private $reviewModel;

    public function __construct()
    {
        // 1. BẢO MẬT: Kiểm tra xem user đã đăng nhập VÀ có phải là admin không
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            // Nếu không phải admin, đá về trang chủ
            header('Location: ' . URLROOT);
            exit();
        }

        // 2. KHỞI TẠO: Tải tất cả các Model cần thiết
        $this->brandModel = $this->model('BrandModel');
        $this->productModel = $this->model('ProductModel');
        $this->orderModel = $this->model('OrderModel');
        $this->userModel = $this->model('UserModel');
        $this->voucherModel = $this->model('VoucherModel');
        $this->postModel = $this->model('PostModel');
        $this->attributeModel = $this->model('AttributeModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->productCategoryModel = $this->model('ProductCategoryModel');
        $this->reviewModel = $this->model('ReviewModel');
    }

    // Trang Dashboard chính
    public function index()
    {
        // 1. Lấy số liệu thống kê (Giữ nguyên)
        $revenue = $this->orderModel->getTotalRevenue();
        $total_orders = $this->orderModel->countOrders();
        $total_products = $this->productModel->countVariants();
        $total_users = $this->userModel->countUsers();

        // 2. Lấy đơn hàng mới nhất (Giữ nguyên)
        $recent_orders = $this->orderModel->getRecentOrders(5);

        // 3. [MỚI] Lấy dữ liệu biểu đồ
        $chart_data = $this->orderModel->getRevenueChartData();

        $data = [
            'title' => 'Tổng quan kinh doanh',
            'revenue' => $revenue,
            'total_orders' => $total_orders,
            'total_products' => $total_products,
            'total_users' => $total_users,
            'recent_orders' => $recent_orders,
            'chart_data' => $chart_data // <-- Truyền biến này sang View
        ];

        $this->view('admin/index', $data);
    }

    // ----------------------------------------------------
    // PHẦN 1: QUẢN LÝ SẢN PHẨM (ĐÃ VIẾT LẠI)
    // ----------------------------------------------------

    // Trang danh sách sản phẩm (chỉ list sản phẩm GỐC)
    public function products()
    {
        $products = $this->productModel->getAllProducts();
        $data = [
            'title' => 'Quản lý Sản phẩm',
            'products' => $products
        ];
        $this->view('admin/products/index', $data);
    }

    // Trang Thêm Sản phẩm GỐC (Bước 1: Chỉ nhập thông số)
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'brand_id' => (int)$_POST['brand_id'],
                'category_id' => (int)$_POST['category_id'], // <-- MỚI: Lấy từ form
                // ... (các trường khác giữ nguyên) ...
                'description' => trim($_POST['description']),
                'screen_size' => trim($_POST['screen_size']),
                'screen_tech' => trim($_POST['screen_tech']),
                'camera_rear' => trim($_POST['camera_rear']),
                'camera_front' => trim($_POST['camera_front']),
                'cpu' => trim($_POST['cpu']),
                'chip' => trim($_POST['chip']),
                'ram' => trim($_POST['ram']),
                'ram_tech' => trim($_POST['ram_tech']),
                'battery' => trim($_POST['battery']),
                'battery_tech' => trim($_POST['battery_tech']),
                'os' => trim($_POST['os']),
                'connectivity' => trim($_POST['connectivity']),
                'weight' => trim($_POST['weight']),
                'dimensions' => trim($_POST['dimensions']),
            ];

            $newProductId = $this->productModel->createBaseProduct($data);

            if ($newProductId) {
                header('Location: ' . URLROOT . '/admin/editProduct/' . $newProductId);
                exit();
            } else {
                die('Thêm sản phẩm thất bại');
            }
        } else {
            $brands = $this->brandModel->getAllBrands();
            $categories = $this->productCategoryModel->getAllCategories(); // <-- MỚI: Lấy danh mục

            $data = [
                'title' => 'Thêm Sản phẩm mới (Bước 1: Thông tin chung)',
                'brands' => $brands,
                'categories' => $categories // <-- MỚI: Gửi sang view
            ];
            $this->view('admin/products/add', $data);
        }
    }

    // Trang Sửa sản phẩm (Gốc) VÀ Quản lý Biến thể (Variants)
    public function editProduct($id)
    {
        $product = $this->productModel->getBaseProductById($id);
        $variants = $this->productModel->getVariantsByProductId($id);
        $brands = $this->brandModel->getAllBrands();
        $categories = $this->productCategoryModel->getAllCategories(); // <-- MỚI
        $all_attributes = $this->attributeModel->getAllAttributesWithValues();

        $data = [
            'title' => 'Sửa sản phẩm & Quản lý Biến thể',
            'product' => $product,
            'variants' => $variants,
            'brands' => $brands,
            'categories' => $categories, // <-- MỚI
            'all_attributes' => $all_attributes
        ];
        $this->view('admin/products/edit', $data);
    }

    // Xử lý POST - Cập nhật Thông tin Gốc (Thông số)
    public function updateBaseProduct($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'brand_id' => (int)$_POST['brand_id'],
                'category_id' => (int)$_POST['category_id'], // <-- MỚI
                // ... (các trường khác giữ nguyên) ...
                'description' => trim($_POST['description']),
                'screen_size' => trim($_POST['screen_size']),
                'screen_tech' => trim($_POST['screen_tech']),
                'camera_rear' => trim($_POST['camera_rear']),
                'camera_front' => trim($_POST['camera_front']),
                'cpu' => trim($_POST['cpu']),
                'chip' => trim($_POST['chip']),
                'ram' => trim($_POST['ram']),
                'ram_tech' => trim($_POST['ram_tech']),
                'battery' => trim($_POST['battery']),
                'battery_tech' => trim($_POST['battery_tech']),
                'os' => trim($_POST['os']),
                'connectivity' => trim($_POST['connectivity']),
                'weight' => trim($_POST['weight']),
                'dimensions' => trim($_POST['dimensions']),
            ];

            if ($this->productModel->updateBaseProduct($data)) {
                header('Location: ' . URLROOT . '/admin/editProduct/' . $id);
                exit();
            } else {
                die('Cập nhật thông tin gốc thất bại');
            }
        }
    }

    // Xử lý POST - Thêm Biến thể (Màu sắc, Dung lượng, Giá)
    public function addVariant($product_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Xử lý upload ảnh
            $imageName = 'default-variant.jpg';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) {
                $newImageName = time() . '_' . $_FILES['image']['name'];
                $uploadPath = APPROOT . '/../public/uploads/' . $newImageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $imageName = $newImageName;
                }
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'product_id' => $product_id,
                'name' => trim($_POST['name']),
                'color' => trim($_POST['color']),
                'storage' => trim($_POST['storage']),
                'price' => (int)$_POST['price'],
                'price_sale' => (int)$_POST['price_sale'],
                'stock_quantity' => (int)$_POST['stock_quantity'],
                'image' => $imageName
            ];

            if ($this->productModel->addVariant($data)) {
                header('Location: ' . URLROOT . '/admin/editProduct/' . $product_id);
                exit();
            } else {
                die('Thêm biến thể thất bại');
            }
        }
    }

    // Xử lý GET - Xóa Biến thể
    public function deleteVariant($id)
    {
        if ($this->productModel->deleteVariant($id)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Quay lại trang Sửa
            exit();
        } else {
            die('Xóa biến thể thất bại');
        }
    }

    // Xử lý GET - Xóa Sản phẩm Gốc
    public function deleteProduct($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: ' . URLROOT . '/admin/products');
            exit();
        } else {
            die('Xóa sản phẩm thất bại');
        }
    }

    // ----------------------------------------------------
    // PHẦN 2: QUẢN LÝ ĐƠN HÀNG (GIỮ NGUYÊN)
    // ----------------------------------------------------
    public function orders()
    {
        $orders = $this->orderModel->getAllOrders();
        $data = [
            'title' => 'Quản lý Đơn hàng',
            'orders' => $orders
        ];
        $this->view('admin/orders/index', $data);
    }

    public function orderdetail($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = (int)$_POST['status'];
            if ($this->orderModel->updateOrderStatus($id, $status)) {
                // Cập nhật thành công
            } else {
                die('Cập nhật trạng thái thất bại');
            }
            header('Location: ' . URLROOT . '/admin/orderdetail/' . $id);
            exit();
        }
        $order = $this->orderModel->getOrderById_Admin($id);
        if (!$order) {
            header('Location: ' . URLROOT . '/admin/orders');
            exit();
        }
        $details = $this->orderModel->getOrderDetails($id);
        $data = [
            'title' => 'Chi tiết Đơn hàng #' . $order['id'],
            'order' => $order,
            'details' => $details
        ];
        $this->view('admin/orders/detail', $data);
    }

    // ----------------------------------------------------
    // PHẦN 3: QUẢN LÝ NGƯỜI DÙNG (GIỮ NGUYÊN)
    // ----------------------------------------------------
    public function users()
    {
        $users = $this->userModel->getAllUsers();
        $data = [
            'title' => 'Quản lý Người dùng',
            'users' => $users
        ];
        $this->view('admin/users/index', $data);
    }

    public function editUser($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy giá trị từ checkbox (nếu tick là 1, không tick là 0)
            $is_admin = isset($_POST['is_admin']) ? 1 : 0;

            // Không cho phép bỏ quyền admin của chính mình
            if ($id == $_SESSION['user_id'] && $is_admin == 0) {
                die('Bạn không thể gỡ quyền Admin của chính mình!');
            }

            if ($this->userModel->updateUserRole($id, $is_admin)) {
                header('Location: ' . URLROOT . '/admin/users');
                exit();
            } else {
                die('Cập nhật vai trò thất bại');
            }
        }

        // GET: Hiển thị form
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            header('Location: ' . URLROOT . '/admin/users');
            exit();
        }
        $data = [
            'title' => 'Phân quyền người dùng',
            'user' => $user
        ];
        $this->view('admin/users/edit', $data);
    }
    public function deleteUser($id)
    {
        // Bảo mật: Không cho phép xóa chính mình
        if ($id == $_SESSION['user_id']) {
            echo "<script>alert('Bạn không thể xóa tài khoản đang đăng nhập!'); window.location.href='" . URLROOT . "/admin/users';</script>";
            exit();
        }

        if ($this->userModel->deleteUser($id)) {
            header('Location: ' . URLROOT . '/admin/users');
            exit();
        } else {
            die('Xóa người dùng thất bại');
        }
    }

    // ----------------------------------------------------
    // PHẦN 4: QUẢN LÝ VOUCHER (GIỮ NGUYÊN)
    // ----------------------------------------------------
    public function vouchers()
    {
        $vouchers = $this->voucherModel->getAllVouchers();
        $data = [
            'title' => 'Quản lý Mã giảm giá (Voucher)',
            'vouchers' => $vouchers
        ];
        $this->view('admin/vouchers/index', $data);
    }

    public function addVoucher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'code' => strtoupper(trim($_POST['code'])),
                'type' => $_POST['type'],
                'value' => (int)$_POST['value'],
                'min_order_value' => (int)$_POST['min_order_value'],
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'usage_limit' => (int)$_POST['usage_limit'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];
            if ($this->voucherModel->createVoucher($data)) {
                header('Location: ' . URLROOT . '/admin/vouchers');
                exit();
            } else {
                die('Thêm voucher thất bại');
            }
        } else {
            $data = ['title' => 'Thêm Voucher mới'];
            $this->view('admin/vouchers/add', $data);
        }
    }

    // ----------------------------------------------------
    // PHẦN 5: QUẢN LÝ TIN TỨC (GIỮ NGUYÊN)
    // ----------------------------------------------------
    private function createSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug . '-' . time();
    }
    public function posts()
    {
        $posts = $this->postModel->getAllPosts();
        $data = [
            'title' => 'Quản lý Tin tức',
            'posts' => $posts
        ];
        $this->view('admin/posts/index', $data);
    }
    public function addPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imageName = 'default-post.jpg';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) {
                $newImageName = time() . '_' . $_FILES['image']['name'];
                $uploadPath = APPROOT . '/../public/uploads/' . $newImageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $imageName = $newImageName;
                }
            }
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'category_id' => (int)$_POST['category_id'],
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'image' => $imageName,
                'slug' => $this->createSlug(trim($_POST['title']))
            ];
            if ($this->postModel->createPost($data)) {
                header('Location: ' . URLROOT . '/admin/posts');
                exit();
            } else {
                die('Thêm bài viết thất bại');
            }
        } else {
            $categories = $this->categoryModel->getAllCategories();
            $data = [
                'title' => 'Viết bài mới',
                'categories' => $categories // <-- MỚI
            ];
            $this->view('admin/posts/add', $data);
        }
    }
    public function editPost($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imageName = trim($_POST['current_image']);
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) {
                $newImageName = time() . '_' . $_FILES['image']['name'];
                $uploadPath = APPROOT . '/../public/uploads/' . $newImageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $imageName = $newImageName;
                }
            }
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'image' => $imageName,
                'slug' => trim($_POST['slug'])
            ];
            if ($this->postModel->updatePost($data)) {
                header('Location: ' . URLROOT . '/admin/posts');
                exit();
            } else {
                die('Sửa bài viết thất bại');
            }
        } else {
            $post = $this->postModel->getPostById($id);
            $categories = $this->categoryModel->getAllCategories();
            $data = [
                'title' => 'Sửa bài viết',
                'post' => $post,
                'categories' => $categories // <-- MỚI
            ];
            $this->view('admin/posts/edit', $data);
        }
    }
    public function deletePost($id)
    {
        if ($this->postModel->deletePost($id)) {
            header('Location: ' . URLROOT . '/admin/posts');
            exit();
        } else {
            die('Xóa bài viết thất bại');
        }
    }


    // ----------------------------------------------------
    // PHẦN 6: HÀM VIEW (GIỮ NGUYÊN)
    // ----------------------------------------------------
    public function view($view, $data = [])
    {
        if (file_exists('../app/Views/layouts/admin_header.php')) {
            require_once '../app/Views/layouts/admin_header.php';
        } else {
            die('Admin Header view does not exist');
        }
        if (file_exists('../app/Views/' . $view . '.php')) {
            require_once '../app/Views/' . $view . '.php';
        } else {
            die('Admin View does not exist');
        }
        if (file_exists('../app/Views/layouts/admin_footer.php')) {
            require_once '../app/Views/layouts/admin_footer.php';
        } else {
            die('Admin Footer view does not exist');
        }
    }
    // ----------------------------------------------------
    // HÀM QUẢN LÝ THUỘC TÍNH (MỚI)
    // ----------------------------------------------------

    // Trang chính: Hiển thị danh sách
    public function attributes()
    {
        $attributes = $this->attributeModel->getAllAttributesWithValues();
        $data = [
            'title' => 'Quản lý Thuộc tính Sản phẩm',
            'attributes' => $attributes
        ];
        $this->view('admin/attributes/index', $data);
    }

    // Xử lý POST - Thêm thuộc tính MỚI (vd: "RAM")
    public function addAttribute()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $this->attributeModel->createAttribute($name);
            }
        }
        header('Location: ' . URLROOT . '/admin/attributes');
        exit();
    }

    // Xử lý POST - Thêm GIÁ TRỊ MỚI (vd: "8GB")
    public function addAttributeValue()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'attribute_id' => (int)$_POST['attribute_id'],
                'value' => trim($_POST['value']),
                'color_code' => !empty($_POST['color_code']) ? trim($_POST['color_code']) : null
            ];
            if (!empty($data['value']) && $data['attribute_id'] > 0) {
                $this->attributeModel->createAttributeValue($data);
            }
        }
        header('Location: ' . URLROOT . '/admin/attributes');
        exit();
    }
    // Xử lý GET - Xóa Thuộc tính
    public function deleteAttribute($id)
    {
        if ($this->attributeModel->deleteAttribute($id)) {
            // Xóa thành công
        } else {
            die('Xóa thuộc tính thất bại');
        }
        header('Location: ' . URLROOT . '/admin/attributes');
        exit();
    }

    // Xử lý GET - Xóa Giá trị
    public function deleteAttributeValue($id)
    {
        if ($this->attributeModel->deleteAttributeValue($id)) {
            // Xóa thành công
        } else {
            die('Xóa giá trị thất bại');
        }
        header('Location: ' . URLROOT . '/admin/attributes');
        exit();
    }
    // ----------------------------------------------------
    // HÀM QUẢN LÝ DANH MỤC TIN TỨC (MỚI)
    // ----------------------------------------------------
    public function post_categories()
    {
        $categories = $this->categoryModel->getAllCategories();
        $data = [
            'title' => 'Quản lý Danh mục Tin tức',
            'categories' => $categories
        ];
        $this->view('admin/posts/categories', $data);
    }

    public function addPostCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $this->categoryModel->createCategory($name);
            }
        }
        header('Location: ' . URLROOT . '/admin/post_categories');
        exit();
    }

    public function deletePostCategory($id)
    {
        // (Lưu ý: các bài viết sẽ bị set category_id = NULL)
        if ($this->categoryModel->deleteCategory($id)) {
            // Xóa thành công
        }
        header('Location: ' . URLROOT . '/admin/post_categories');
        exit();
    }
    public function product_categories()
    {
        $categories = $this->productCategoryModel->getAllCategories();
        $data = [
            'title' => 'Quản lý Danh mục Sản phẩm',
            'categories' => $categories
        ];
        $this->view('admin/product_categories/index', $data);
    }

    public function addProductCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $this->productCategoryModel->createCategory($name);
            }
        }
        header('Location: ' . URLROOT . '/admin/product_categories');
        exit();
    }

    public function deleteProductCategory($id)
    {
        if ($this->productCategoryModel->deleteCategory($id)) {
            // Xóa thành công
        }
        header('Location: ' . URLROOT . '/admin/product_categories');
        exit();
    }
    // Hàm Sửa Biến thể (MỚI)
    public function editVariant($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Xử lý upload ảnh mới
            $imageName = trim($_POST['current_image']);
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) {
                $newImageName = time() . '_' . $_FILES['image']['name'];
                $uploadPath = APPROOT . '/../public/uploads/' . $newImageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $imageName = $newImageName;
                }
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'color' => trim($_POST['color']),
                'storage' => trim($_POST['storage']),
                'price' => (int)$_POST['price'],
                'price_sale' => (int)$_POST['price_sale'],
                'stock_quantity' => (int)$_POST['stock_quantity'],
                'image' => $imageName
            ];

            if ($this->productModel->updateVariant($data)) {
                // Lấy lại variant để biết product_id mà quay về
                $variant = $this->productModel->getVariantById($id);
                header('Location: ' . URLROOT . '/admin/editProduct/' . $variant['product_id']);
                exit();
            } else {
                die('Sửa biến thể thất bại');
            }
        } else {
            // GET request: Hiển thị form
            $variant = $this->productModel->getVariantById($id);
            $all_attributes = $this->attributeModel->getAllAttributesWithValues(); // Lấy thuộc tính cho dropdown

            if (!$variant) {
                die('Biến thể không tồn tại');
            }

            $data = [
                'title' => 'Sửa Biến thể: ' . $variant['name'],
                'variant' => $variant,
                'all_attributes' => $all_attributes
            ];
            $this->view('admin/products/edit_variant', $data);
        }
    }
    public function reviews()
    {
        $reviews = $this->reviewModel->getAllReviews();
        $data = [
            'title' => 'Quản lý Đánh giá sản phẩm',
            'reviews' => $reviews
        ];
        $this->view('admin/reviews/index', $data);
    }

    public function deleteReview($id)
    {
        if ($this->reviewModel->deleteReview($id)) {
            // Xóa thành công
        } else {
            die('Xóa đánh giá thất bại');
        }
        header('Location: ' . URLROOT . '/admin/reviews');
        exit();
    }
    public function gallery($product_id)
    {
        // 1. XỬ LÝ POST: Upload ảnh
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Kiểm tra có file được chọn không
            if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                $total_files = count($_FILES['images']['name']);
                $color = !empty($_POST['color']) ? trim($_POST['color']) : null;

                for ($i = 0; $i < $total_files; $i++) {
                    if ($_FILES['images']['error'][$i] == 0) {
                        $fileName = $_FILES['images']['name'][$i];
                        $tmpName = $_FILES['images']['tmp_name'][$i];

                        // Tạo tên file mới để tránh trùng
                        $newFileName = time() . '_' . rand(100, 999) . '_' . $fileName;
                        $uploadPath = APPROOT . '/../public/uploads/' . $newFileName;

                        if (move_uploaded_file($tmpName, $uploadPath)) {
                            // Lưu vào DB
                            $this->productModel->addGalleryImage($product_id, $newFileName, $color);
                        }
                    }
                }
                // Upload xong thì reload trang
                header('Location: ' . URLROOT . '/admin/gallery/' . $product_id . '?msg=success');
                exit();
            }
        }

        // 2. XỬ LÝ GET: Hiển thị danh sách ảnh
        $product = $this->productModel->getBaseProductById($product_id);

        if (!$product) {
            header('Location: ' . URLROOT . '/admin/products');
            exit();
        }

        $gallery = $this->productModel->getGalleryByProductId($product_id);

        // Lấy danh sách màu để làm tùy chọn (Option) khi upload
        // Ta lấy màu từ các biến thể đã tạo của sản phẩm này
        $variants = $this->productModel->getVariantsByProductId($product_id);
        $colors = [];
        foreach ($variants as $v) {
            if (!empty($v['color']) && !in_array($v['color'], $colors)) {
                $colors[] = $v['color'];
            }
        }

        $data = [
            'title' => 'Thư viện ảnh: ' . $product['name'],
            'product' => $product,
            'gallery' => $gallery,
            'colors' => $colors
        ];

        $this->view('admin/products/gallery', $data);
    }

    // Xóa ảnh gallery
    public function deleteGalleryImage($image_id)
    {
        $imageName = $this->productModel->deleteGalleryImage($image_id);

        if ($imageName) {
            // Xóa file vật lý
            $filePath = APPROOT . '/../public/uploads/' . $imageName;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Quay lại trang trước đó
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    public function editVoucher($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'code' => strtoupper(trim($_POST['code'])),
                'type' => $_POST['type'],
                'value' => (int)$_POST['value'],
                'min_order_value' => (int)$_POST['min_order_value'],
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'usage_limit' => (int)$_POST['usage_limit'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            if ($this->voucherModel->updateVoucher($data)) {
                header('Location: ' . URLROOT . '/admin/vouchers');
                exit();
            } else {
                die('Cập nhật thất bại');
            }
        } else {
            // GET: Hiển thị form với dữ liệu cũ
            $voucher = $this->voucherModel->getVoucherById($id);
            if (!$voucher) {
                header('Location: ' . URLROOT . '/admin/vouchers');
                exit();
            }

            $data = [
                'title' => 'Sửa Voucher: ' . $voucher['code'],
                'voucher' => $voucher
            ];
            $this->view('admin/vouchers/edit', $data);
        }
    }

    // Xóa Voucher
    public function deleteVoucher($id)
    {
        if ($this->voucherModel->deleteVoucher($id)) {
            header('Location: ' . URLROOT . '/admin/vouchers');
            exit();
        } else {
            die('Xóa thất bại');
        }
    }
    // --- QUẢN LÝ THƯƠNG HIỆU ---
    public function brands()
    {
        $brands = $this->brandModel->getAllBrands();
        $data = ['title' => 'Quản lý Thương hiệu', 'brands' => $brands];
        $this->view('admin/brands/index', $data);
    }

    public function addBrand()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $image = 'default-brand.png';

            // Upload logo
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $image = time() . '_' . $_FILES['logo']['name'];
                move_uploaded_file($_FILES['logo']['tmp_name'], APPROOT . '/../public/images/brands/' . $image);
            }

            $this->brandModel->createBrand($name, $image);
            header('Location: ' . URLROOT . '/admin/brands');
            exit();
        }
        $data = ['title' => 'Thêm Thương hiệu'];
        $this->view('admin/brands/add', $data);
    }

    public function editBrand($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image = $_POST['current_logo'];
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $image = time() . '_' . $_FILES['logo']['name'];
                move_uploaded_file($_FILES['logo']['tmp_name'], APPROOT . '/../public/images/brands/' . $image);
            }

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'logo' => $image
            ];
            $this->brandModel->updateBrand($data);
            header('Location: ' . URLROOT . '/admin/brands');
            exit();
        }

        $brand = $this->brandModel->getBrandById($id);
        $data = ['title' => 'Sửa Thương hiệu', 'brand' => $brand];
        $this->view('admin/brands/edit', $data);
    }

    public function deleteBrand($id)
    {
        $this->brandModel->deleteBrand($id);
        header('Location: ' . URLROOT . '/admin/brands');
        exit();
    }
    public function settings()
    {
        // Lấy thông tin admin hiện tại
        $user = $this->userModel->getUserById($_SESSION['user_id']);

        $data = [
            'title' => 'Cài đặt tài khoản',
            'user' => $user,
            'success' => '',
            'error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // 1. Xử lý Cập nhật thông tin
            if (isset($_POST['update_info'])) {
                $updateData = [
                    'user_id' => $_SESSION['user_id'],
                    'full_name' => trim($_POST['full_name']),
                    'phone' => trim($_POST['phone']),
                    'address' => trim($_POST['address'])
                ];

                if ($this->userModel->updateProfile($updateData)) {
                    $_SESSION['user_name'] = $updateData['full_name']; // Cập nhật lại Session tên
                    $data['success'] = 'Đã cập nhật thông tin thành công!';
                    // Refresh lại dữ liệu user để hiển thị
                    $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
                } else {
                    $data['error'] = 'Có lỗi xảy ra khi cập nhật thông tin.';
                }
            }

            // 2. Xử lý Đổi mật khẩu
            if (isset($_POST['change_pass'])) {
                $current_pass = $_POST['current_password'];
                $new_pass = $_POST['new_password'];
                $confirm_pass = $_POST['confirm_password'];

                if (!password_verify($current_pass, $user['password'])) {
                    $data['error'] = 'Mật khẩu hiện tại không đúng.';
                } elseif (strlen($new_pass) < 6) {
                    $data['error'] = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
                } elseif ($new_pass !== $confirm_pass) {
                    $data['error'] = 'Mật khẩu xác nhận không khớp.';
                } else {
                    // Đổi mật khẩu (Hàm này đã có trong UserModel từ bước trước)
                    $newHash = password_hash($new_pass, PASSWORD_DEFAULT);
                    if ($this->userModel->changePassword($_SESSION['user_id'], $newHash)) {
                        $data['success'] = 'Đổi mật khẩu thành công!';
                        // Cập nhật lại biến user để lấy pass mới (dù ko hiển thị ra)
                        $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
                    } else {
                        $data['error'] = 'Lỗi hệ thống, không thể đổi mật khẩu.';
                    }
                }
            }
        }

        $this->view('admin/settings', $data);
    }
}
