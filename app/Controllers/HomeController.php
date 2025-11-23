<?php
// File: app/Controllers/HomeController.php

class HomeController extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
    }

    public function index()
    {
        // [SỬA] Gọi hàm lấy sản phẩm gom nhóm thay vì lấy tất cả biến thể
        $products = $this->productModel->getAllProductsForDisplay();

        $data = [
            'title' => 'Trang Chủ',
            'products' => $products // Đổi tên biến từ 'variants' thành 'products' cho đúng nghĩa
        ];

        $this->view('home', $data);
    }
}
