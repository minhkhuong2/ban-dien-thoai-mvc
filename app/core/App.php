<?php
// File: app/core/App.php

/*
 * Đây là lớp định tuyến chính (Router)
 * Nó sẽ phân tích URL để gọi đúng Controller, Method và truyền Params
 * Ví dụ: /public/product/detail/15
 * -> Controller: ProductController
 * -> Method: detail
 * -> Params: [15]
 */
class App
{
    protected $controller = 'HomeController'; // Controller mặc định
    protected $method = 'index'; // Method mặc định
    protected $params = []; // Tham số

    public function __construct()
    {
        $url = $this->parseUrl();

        // 1. Xử lý Controller
        if (isset($url[0])) {
            if (file_exists('../app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
                $this->controller = ucfirst($url[0]) . 'Controller';
                unset($url[0]);
            } else {
                // [MỚI] Nếu gõ tên controller bậy -> Chuyển sang ErrorsController
                require_once '../app/Controllers/ErrorsController.php';
                $this->controller = 'ErrorsController';
                // (Tùy chọn: có thể gán url[1] = index để nó chạy hàm index)
            }
        }

        // Require file controller
        require_once '../app/Controllers/' . $this->controller . '.php';

        // Khởi tạo controller
        // Ví dụ: $this->controller = new HomeController();
        $this->controller = new $this->controller;

        // 2. Xử lý Method (Hàm)
        // $url[1] là tên method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Xử lý Tham số (Params)
        // Lấy các tham số còn lại
        $this->params = $url ? array_values($url) : [];

        // Gọi hàm (method) của controller với các tham số (params)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Hàm này phân tích URL từ $_GET['url']
    // (Được cấu hình trong file .htaccess)
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
