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

        // Gọi hàm lọc sản phẩm (lấy cả ID biến thể mặc định)
        $products = $this->productModel->getFilteredProducts($filters);

        // Lấy dữ liệu cho Sidebar
        $brands = $this->brandModel->getAllBrands();
        $categories = $this->productCategoryModel->getCategoriesWithCount();

        $data = [
            'title' => 'Tất cả Sản phẩm',
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $filters
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

        // 4. Lấy sản phẩm liên quan (Cùng thương hiệu)
        $related_products = $this->productModel->getRelatedProducts($product['brand_id'], $product_id);

        // 5. Lấy Đánh giá
        $reviews = $this->productModel->getReviewsByProductId($product_id);
        $rating_info = $this->productModel->getRatingInfo($product_id);

        $data = [
            'title' => $product['name'],
            'product' => $product,
            'variants' => $variants,
            'gallery' => $gallery,
            'related_products' => $related_products,
            'reviews' => $reviews,
            'rating_info' => $rating_info
        ];

        $this->view('product_detail', $data);
    }

    // Tìm kiếm sản phẩm
    public function search()
    {
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        // Gọi hàm tìm kiếm
        $products = $this->productModel->searchProducts($query);

        $data = [
            'title' => 'Kết quả tìm kiếm cho: "' . htmlspecialchars($query) . '"',
            'products' => $products,
            'search_query' => $query
        ];

        $this->view('product_search', $data);
    }

    // Hiển thị sản phẩm theo Thương hiệu (ĐÃ SỬA LỖI THIẾU DATA SIDEBAR)
    public function brand($brand_id = 0)
    {
        // Tạo bộ lọc chỉ có brand_id, các cái khác null
        $filters = [
            'brand_id' => $brand_id,
            'category_id' => null,
            'price_range' => null,
            'sort_by' => null,
            'search_query' => null
        ];

        // Tái sử dụng hàm lọc để lấy sản phẩm của hãng này
        $products = $this->productModel->getFilteredProducts($filters);

        // QUAN TRỌNG: Phải lấy cả Brands và Categories để hiển thị Sidebar không bị lỗi
        $brands = $this->brandModel->getAllBrands();
        $categories = $this->productCategoryModel->getCategoriesWithCount();

        $data = [
            'title' => 'Sản phẩm theo Thương hiệu',
            'products' => $products,
            'brands' => $brands,         // <-- Phải có cái này
            'categories' => $categories, // <-- Phải có cái này
            'filters' => $filters        // <-- Phải có cái này
        ];

        // Tái sử dụng View 'product_all'
        $this->view('product_all', $data);
    }
}
