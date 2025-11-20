<?php
// File: app/Controllers/ProductController.php

class ProductController extends Controller
{
    private $productModel;
    private $brandModel;
    private $productCategoryModel;

    public function __construct()
    {
        // Khởi tạo ProductModel
        $this->productModel = $this->model('ProductModel');
        $this->brandModel = $this->model('BrandModel');
        $this->productCategoryModel = $this->model('ProductCategoryModel');
    }

    /**
     * Hiển thị trang chi tiết sản phẩm.
     * $id này sẽ được tự động truyền vào
     * bởi file /app/core/App.php
     */
    public function all()
    {
        // 1. Lấy các giá trị lọc từ URL
        $filters = [
            'brand_id' => $_GET['brand_filter'] ?? null,
            'category_id' => $_GET['category_filter'] ?? null, // <-- MỚI
            'price_range' => $_GET['price_filter'] ?? null,
            'sort_by' => $_GET['sort'] ?? null,
            'search_query' => $_GET['query'] ?? null
        ];

        // 2. Gọi Model lọc sản phẩm
        $variants = $this->productModel->getFilteredVariants($filters);

        // 3. Lấy dữ liệu cho Sidebar
        $brands = $this->brandModel->getAllBrands();
        $categories = $this->productCategoryModel->getCategoriesWithCount(); // <-- MỚI

        $data = [
            'title' => 'Tất cả Sản phẩm',
            'variants' => $variants,
            'brands' => $brands,
            'categories' => $categories, // <-- Gửi danh mục sang View
            'filters' => $filters
        ];

        $this->view('product_all', $data);
    }
    public function detail($product_id = 0)
    {
        // 1. Lấy thông tin GỐC (Chung) của sản phẩm
        $product = $this->productModel->getProductDetail($product_id); // Dùng hàm mới

        if (!$product) {
            header('Location: ' . URLROOT);
            exit();
        }

        // 2. Lấy tất cả BIẾN THỂ của sản phẩm này
        $variants = $this->productModel->getVariantsByProductId($product_id);

        // 3. Lấy sản phẩm liên quan
        $related_products = $this->productModel->getRelatedProducts($product['brand_id'], $product_id);

        // 4. Lấy Đánh giá & Sao
        $reviews = $this->productModel->getReviewsByProductId($product_id);
        $rating_info = $this->productModel->getRatingInfo($product_id);

        $data = [
            'title' => $product['name'],
            'product' => $product,           // Thông tin chung (thông số)
            'variants' => $variants,         // Danh sách các phiên bản (giá, màu, dung lượng)
            'related_products' => $related_products,
            'reviews' => $reviews,
            'rating_info' => $rating_info
        ];

        $this->view('product_detail', $data);
    }
    public function search()
    {
        // 1. Lấy từ khóa
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        // 2. Gọi Model (hàm mới)
        $variants = $this->productModel->searchProducts($query);

        // 3. Gửi dữ liệu (dưới tên 'variants')
        $data = [
            'title' => 'Kết quả tìm kiếm cho: "' . htmlspecialchars($query) . '"',
            'variants' => $variants, // SỬA: Gửi mảng 'variants'
            'search_query' => $query
        ];

        // 4. Gọi View (sửa tên view)
        $this->view('product_search', $data);
    }
    // Hiển thị trang sản phẩm theo thương hiệu
    // URL: /public/product/brand/1
    public function brand($brand_id = 0)
    {
        // 1. Gọi Model (hàm mới)
        $variants = $this->productModel->getVariantsByBrand($brand_id);

        // (Chúng ta có thể lấy tên Brand để làm tiêu đề đẹp hơn)

        // 2. Gửi dữ liệu (dưới tên 'variants')
        $data = [
            'title' => 'Sản phẩm theo Thương hiệu',
            'variants' => $variants
        ];

        // 3. Tái sử dụng View 'product_all' (Vì giao diện giống hệt)
        $this->view('product_all', $data);
    }
}
