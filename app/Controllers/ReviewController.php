<?php
// File: app/Controllers/ReviewController.php

class ReviewController extends Controller
{
    private $reviewModel;

    public function __construct()
    {
        $this->reviewModel = $this->model('ReviewModel');
    }

    // Hàm xử lý việc thêm đánh giá
    // URL: /review/add/{product_id}
    public function add($product_id)
    {

        // 1. Chỉ cho phép POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: ' . URLROOT); // Về trang chủ nếu ko phải POST
            exit();
        }

        // 2. Bắt buộc đăng nhập
        if (!isset($_SESSION['user_id'])) {
            die('Bạn phải đăng nhập để đánh giá.'); // Hoặc chuyển hướng
        }

        // 3. Lấy dữ liệu
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'product_id' => $product_id,
            'user_id' => $_SESSION['user_id'],
            'user_name' => $_SESSION['user_name'], // Lấy tên từ session
            'rating' => (int)$_POST['rating'],
            'comment' => trim($_POST['comment'])
        ];

        // (Thêm validation ở đây nếu cần, ví dụ: rating 1-5, comment không rỗng)

        // 4. Gọi Model để lưu
        if ($this->reviewModel->addReview($data)) {
            // Thành công, quay lại trang sản phẩm
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Quay lại trang trước
            exit();
        } else {
            die('Gửi đánh giá thất bại.');
        }
    }
}
