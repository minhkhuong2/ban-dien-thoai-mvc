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
        $filters = [
            'brand_id' => $_GET['brand_filter'] ?? null,
            'category_id' => $_GET['category_filter'] ?? null,
            'price_range' => $_GET['price_filter'] ?? null,
            'sort_by' => $_GET['sort'] ?? null,
            'search_query' => $_GET['query'] ?? null
        ];

        // [SỬA] Gọi hàm getFilteredProducts (thay vì getFilteredVariants)
        // Biến trả về giờ là danh sách Products (đã gom nhóm)
        $products = $this->productModel->getFilteredProducts($filters);

        $brands = $this->brandModel->getAllBrands();
        $categories = $this->productCategoryModel->getCategoriesWithCount();

        $data = [
            'title' => 'Tất cả Sản phẩm',
            'products' => $products, // Đổi tên key thành products cho dễ hiểu
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $filters
        ];

        $this->view('product_all', $data);
    }
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

        // 3. [MỚI - QUAN TRỌNG] Lấy Ảnh Phụ (Gallery)
        // Hàm này chúng ta đã viết trong Model lúc làm trang Admin rồi, giờ chỉ cần gọi ra
        $gallery = $this->productModel->getGalleryByProductId($product_id);

        // 4. Lấy sản phẩm liên quan
        $related_products = $this->productModel->getRelatedProducts($product['category_id'], $product_id);

        // 5. Lấy Đánh giá
        $reviews = $this->productModel->getReviewsByProductId($product_id);
        $rating_info = $this->productModel->getRatingInfo($product_id);

        $data = [
            'title' => $product['name'],
            'product' => $product,
            'variants' => $variants,
            'gallery' => $gallery, // <-- Truyền biến này sang View
            'related_products' => $related_products,
            'reviews' => $reviews,
            'rating_info' => $rating_info
        ];

        $this->view('product_detail', $data);
    }
    public function search()
    {
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        // [SỬA] Gọi hàm tìm kiếm mới (trả về products gom nhóm)
        $products = $this->productModel->searchProducts($query);

        $data = [
            'title' => 'Kết quả tìm kiếm cho: "' . htmlspecialchars($query) . '"',
            'products' => $products, // Đổi tên key
            'search_query' => $query
        ];

        $this->view('product_search', $data);
    }
    // Hiển thị trang sản phẩm theo thương hiệu
    // URL: /public/product/brand/1
    public function brand($brand_id = 0)
    {
        // [SỬA] Tái sử dụng hàm lọc để lấy theo brand (gom nhóm luôn)
        $products = $this->productModel->getFilteredProducts(['brand_id' => $brand_id]);

        $data = [
            'title' => 'Sản phẩm theo Thương hiệu',
            'products' => $products
        ];

        $this->view('product_all', $data);
    }
}
