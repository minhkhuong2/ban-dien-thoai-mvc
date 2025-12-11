<?php
// File: app/Controllers/PageController.php

class PageController extends Controller
{
    private $productModel;
    private $postModel;
    private $categoryModel;
    private $voucherModel;
    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->postModel = $this->model('PostModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->voucherModel = $this->model('VoucherModel');
    }

    // Trang Liên hệ
    public function contact()
    {
        $data = [
            'title' => 'Liên hệ với chúng tôi'
        ];

        // Xử lý khi người dùng gửi form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // (Thêm code xử lý gửi email sau)

            // Tạm thời chỉ báo thành công
            $data['success_message'] = 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.';
            $this->view('pages/contact', $data);
        } else {
            // Hiển thị form
            $this->view('pages/contact', $data);
        }
    }
    public function promotions()
    {
        // Lấy sản phẩm đang sale
        $variants = $this->productModel->getOnSaleVariants();

        // [MỚI] Lấy danh sách Voucher đang hoạt động
        $vouchers = $this->voucherModel->getActiveVouchers();

        $data = [
            'title' => 'Săn Voucher & Khuyến Mãi',
            'variants' => $variants,
            'vouchers' => $vouchers // Truyền sang view
        ];

        $this->view('pages/promotions', $data);
    }

    // Trang Giới thiệu (MỚI)
    public function about()
    {
        $data = [
            'title' => 'Về Chúng Tôi'
        ];

        $this->view('pages/about', $data);
    }

    // Trang Tin Tức (MỚI) - Hiển thị danh sách
    public function news()
    {
        // 1. Lấy danh sách bài viết (hàm này đã được nâng cấp)
        $posts = $this->postModel->getAllPosts_User();

        // 2. Lấy danh mục (kèm số lượng bài) cho Sidebar
        // (Chúng ta cần thêm CategoryModel vào __construct)
        $categories = $this->categoryModel->getCategoriesWithCount();

        // 3. Lấy bài viết phổ biến cho Sidebar (theo views)
        $popular_posts = $this->postModel->getPopularPosts(); // Lấy 3 bài

        $data = [
            'title' => 'Tin tức Công nghệ',
            'posts' => $posts,
            'categories' => $categories,      // <-- GỬI SANG VIEW
            'popular_posts' => $popular_posts // <-- GỬI SANG VIEW
        ];

        $this->view('pages/news', $data);
    }

    // Trang Chi tiết Tin Tức (MỚI) - Hiển thị 1 bài
    public function post($slug = '')
    {
        $post = $this->postModel->getPostBySlug($slug);

        if (!$post) {
            header('Location: ' . URLROOT . '/page/news');
            exit();
        }

        // TĂNG LƯỢT XEM (MỚI)
        $this->postModel->increaseView($post['id']);

        // [MỚI] Lấy bài viết liên quan
        $related_posts = $this->postModel->getRelatedPosts($post['id']);

        $data = [
            'title' => $post['title'],
            'post' => $post,
            'related_posts' => $related_posts // <-- Gửi sang view
        ];
        $this->view('pages/post_detail', $data);
    }
    public function warranty()
    {
        $data = ['title' => 'Chính sách Bảo hành'];
        $this->view('pages/warranty', $data); // Sửa tên View
    }

    public function returns()
    {
        $data = ['title' => 'Chính sách Đổi trả'];
        $this->view('pages/returns', $data); // Sửa tên View
    }

    public function shipping()
    {
        $data = ['title' => 'Hướng dẫn Mua hàng'];
        $this->view('pages/shipping', $data); // Sửa tên View
    }

    public function faq()
    {
        $data = ['title' => 'Câu hỏi thường gặp (FAQ)'];
        $this->view('pages/faq', $data); // Sửa tên View
    }
    public function payments()
    {
        $data = ['title' => 'Phương thức Thanh toán'];
        $this->view('pages/payments', $data); // Gọi view mới
    }
    public function support()
    {
        // Mặc định chuyển hướng đến trang Bảo hành hoặc tạo một trang tổng quan
        $this->warranty(); // Gọi hàm warranty() để hiển thị trang bảo hành
    }

    public function policy()
    {
        $data = ['title' => 'Điều khoản Dịch vụ'];
        $this->view('pages/policy', $data);
    }
}
