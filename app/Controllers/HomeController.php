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
        // Lấy CÁC BIẾN THỂ (không phải sản phẩm gốc)
        $variants = $this->productModel->getAllVariantsForDisplay();

        $data = [
            'title' => 'Trang Chủ',
            'variants' => $variants // Gửi mảng "variants" sang View
        ];

        $this->view('home', $data);
    }
}
