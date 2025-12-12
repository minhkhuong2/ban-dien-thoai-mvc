<?php
// File: app/Controllers/ProductController.php

class ProductController extends Controller
{
    private $productModel;
    private $brandModel;
    private $productCategoryModel;
    private $attributeModel;
    private $reviewModel; // [MỚI]

    public function __construct()
    {
        // Khởi tạo các Model
        $this->productModel = $this->model('ProductModel');
        $this->brandModel = $this->model('BrandModel');
        $this->productCategoryModel = $this->model('ProductCategoryModel');
        $this->attributeModel = $this->model('AttributeModel');
        $this->reviewModel = $this->model('ReviewModel'); // [MỚI]
    }

    /**
     * Xử lý thêm đánh giá
     */
    public function addReview()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Kiểm tra đăng nhập
            if (!isset($_SESSION['user_id'])) {
                header('Location: ' . URLROOT . '/user/login');
                exit();
            }

            // Lọc dữ liệu đầu vào
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'product_id' => trim($_POST['product_id']),
                'user_id' => $_SESSION['user_id'],
                'user_name' => $_SESSION['user_name'],
                'rating' => trim($_POST['rating']),
                'comment' => trim($_POST['comment'])
            ];

            // Validate đơn giản
            if (empty($data['rating']) || empty($data['comment'])) {
                // Có thể thêm flash message lỗi ở đây nếu cần
                header('Location: ' . URLROOT . '/product/detail/' . $data['product_id']);
                exit();
            }

            // Gọi Model thêm đánh giá
            if ($this->reviewModel->addReview($data)) {
                // Success
                header('Location: ' . URLROOT . '/product/detail/' . $data['product_id']);
            } else {
                die('Something went wrong');
            }
        } else {
            header('Location: ' . URLROOT);
        }
    }


    /**
     * Hiển thị tất cả sản phẩm (Có lọc)
     */
    public function all()
    {
        $filters = [
            'brand_id' => $_GET['brand_filter'] ?? null,
            'category_id' => $_GET['category_filter'] ?? null,
            'price_range' => $_GET['price_filter'] ?? null,
            'sort_by' => $_GET['sort'] ?? null,
            'search_query' => $_GET['query'] ?? null
        ];

        // [MỚI] Pagination Setup
        require_once APPROOT . '/core/Pagination.php';
        $page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        $limit = 12; // Số sản phẩm mỗi trang

        // Thêm limit/offset vào filters
        $filters['limit'] = $limit;
        $filters['offset'] = ($page - 1) * $limit;

        // Gọi hàm lọc sản phẩm (với phân trang)
        $products = $this->productModel->getFilteredProducts($filters);
        
        // Đếm tổng số sản phẩm
        $total_products = $this->productModel->countFilteredProducts($filters);

        // Tạo URL Pattern cho Pagination
        // Lấy tất cả param hiện tại, trừ 'page'
        $url_params = $_GET;
        unset($url_params['url']);
        unset($url_params['page']);
        $url_params['page'] = '(:num)';
        
        // http_build_query sẽ mã hóa (:num) thành %28%3Anum%29. Ta cần replace lại.
        $url_query = http_build_query($url_params);
        $url_query = str_replace('%28%3Anum%29', '(:num)', $url_query);
        $url_pattern = URLROOT . '/product/all?' . $url_query;

        $pagination = new Pagination($total_products, $limit, $page, $url_pattern);

        // Lấy dữ liệu cho Sidebar
        $brands = $this->brandModel->getAllBrands();
        $categories = $this->productCategoryModel->getCategoriesWithCount();

        $data = [
            'title' => 'Tất cả Sản phẩm',
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $filters,
            'pagination' => $pagination->render() // HTML phân trang
        ];

        $this->view('product_all', $data);
    }

    // Hiển thị chi tiết sản phẩm
    public function detail($product_id = 0)
    {
        // 1. Lấy thông tin GỐC
        $product = $this->productModel->getProductDetail($product_id);

        if (!$product) {
            header('Location: ' . URLROOT);
            exit();
        }

        // 2. Lấy tất cả BIẾN THỂ
        $variants = $this->productModel->getVariantsByProductId($product_id);

        // 3. Lấy Ảnh Phụ (Gallery)
        $gallery = $this->productModel->getGalleryByProductId($product_id);

        // 4. Lấy sản phẩm liên quan
        $related_products = $this->productModel->getRelatedProducts($product['brand_id'], $product_id);

        // 5. Lấy Đánh giá
        $reviews = $this->productModel->getReviewsByProductId($product_id);
        $rating_info = $this->productModel->getRatingInfo($product_id);

        // 6. [MỚI] Lấy danh sách Mã Màu (Hex) từ DB để hiển thị nút tròn đẹp hơn
        $all_attributes = $this->attributeModel->getAllAttributesWithValues();
        $dynamic_colors = [];
        foreach ($all_attributes as $attr) {
            if (stripos($attr['name'], 'Màu') !== false) {
                foreach ($attr['values'] as $val) {
                    if (!empty($val['color_code'])) {
                        $dynamic_colors[$val['value']] = $val['color_code'];
                    }
                }
            }
        }

        $data = [
            'title' => $product['name'],
            'product' => $product,
            'variants' => $variants,
            'gallery' => $gallery,
            'related_products' => $related_products,
            'reviews' => $reviews,
            'rating_info' => $rating_info,
            'dynamic_colors' => $dynamic_colors // Truyền mã màu sang View
        ];

        $this->view('product_detail', $data);
    }

    // Tìm kiếm sản phẩm
    public function search()
    {
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        $products = $this->productModel->searchProducts($query);

        $data = [
            'title' => 'Kết quả tìm kiếm cho: "' . htmlspecialchars($query) . '"',
            'products' => $products,
            'search_query' => $query
        ];

        $this->view('product_search', $data);
    }

    // Hiển thị sản phẩm theo Thương hiệu
    public function brand($brand_id = 0)
    {
        $filters = [
            'brand_id' => $brand_id,
            'category_id' => null,
            'price_range' => null,
            'sort_by' => null,
            'search_query' => null
        ];

        $products = $this->productModel->getFilteredProducts($filters);

        $brands = $this->brandModel->getAllBrands();
        $categories = $this->productCategoryModel->getCategoriesWithCount();

        $data = [
            'title' => 'Sản phẩm theo Thương hiệu',
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $filters
        ];

        $this->view('product_all', $data);
    }
}
