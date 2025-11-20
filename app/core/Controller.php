<?php
// File: app/core/Controller.php

// Đây là Base Controller (Controller Cha)
class Controller
{

    // Hàm này để gọi Model
    // Ví dụ: $this->model('ProductModel')
    public function model($model)
    {
        // Kiểm tra file model có tồn tại
        if (file_exists('../app/Models/' . $model . '.php')) {
            require_once '../app/Models/' . $model . '.php';
            // Khởi tạo Model
            // Ví dụ: new ProductModel()
            return new $model();
        }
        return null;
    }

    // Hàm này để gọi View (Giao diện)
    // Ví dụ: $this->view('home', ['name' => 'John'])
    public function view($view, $data = [])
    {
        // Kiểm tra xem có phải trang admin không
        if (strpos($view, 'admin/') === 0) {
            // DÙNG LAYOUT ADMIN
            if (file_exists('../app/Views/layouts/admin_header.php')) {
                require_once '../app/Views/layouts/admin_header.php';
            }
            if (file_exists('../app/Views/' . $view . '.php')) {
                require_once '../app/Views/' . $view . '.php';
            }
            if (file_exists('../app/Views/layouts/admin_footer.php')) {
                require_once '../app/Views/layouts/admin_footer.php';
            }

            // Kiểm tra xem có phải trang đăng nhập/đăng ký không
        } else if (strpos($view, 'user_login') === 0 || strpos($view, 'user_register') === 0) {
            // DÙNG LAYOUT AUTH (MỚI)
            if (file_exists('../app/Views/layouts/auth_header.php')) {
                require_once '../app/Views/layouts/auth_header.php';
            }
            if (file_exists('../app/Views/' . $view . '.php')) {
                require_once '../app/Views/' . $view . '.php';
            }
            if (file_exists('../app/Views/layouts/auth_footer.php')) {
                require_once '../app/Views/layouts/auth_footer.php';
            }
        } else {
            // DÙNG LAYOUT CHÍNH (CỦA NGƯỜI DÙNG)
            if (file_exists('../app/Views/layouts/header.php')) {
                require_once '../app/Views/layouts/header.php';
            }
            if (file_exists('../app/Views/' . $view . '.php')) {
                require_once '../app/Views/' . $view . '.php';
            }
            if (file_exists('../app/Views/layouts/footer.php')) {
                require_once '../app/Views/layouts/footer.php';
            }
        }
    }
}
