<?php
// File: app/Controllers/PageController.php

class PageController extends Controller
{
    private $productModel;
    private $postModel;
    private $categoryModel;
    private $voucherModel;
    private $contactModel;
    
    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->postModel = $this->model('PostModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->voucherModel = $this->model('VoucherModel');
        $this->contactModel = $this->model('ContactModel');
    }

    // Trang Liên hệ
    public function contact()
    {
        $data = [
            'title' => 'Liên hệ với chúng tôi'
        ];

        // Xử lý khi người dùng gửi form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data_post = [
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'message' => trim($_POST['message'])
            ];

            if ($this->contactModel->createContact($data_post)) {
                // Gửi email xác nhận
                require_once APPROOT . '/core/Mailer.php';
                $mailer = new Mailer();
                $mailer->sendContactConfirmation($data_post['email'], $data_post['name']);

                $data['success_message'] = 'Cảm ơn bạn đã liên hệ! Chúng tôi đã nhận được tin nhắn và gửi email xác nhận cho bạn.';
            } else {
                $data['error_message'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
            }
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
        // [MỚI] Pagination Setup
        require_once APPROOT . '/core/Pagination.php';
        $limit = 6; // Số bài viết mỗi trang
        $page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // 1. Lấy danh sách bài viết (Có phân trang)
        // Lưu ý: PostModel::getAllPosts_User() gọi getAllPosts(), ta sẽ sửa getAllPosts_User để nhận tham số hoặc gọi trực tiếp getAllPosts
        $posts = $this->postModel->getAllPosts($limit, $offset);
        $total_posts = $this->postModel->countAllPosts();

        // Xử lý URL Pattern (Giữ lại các query param khác nếu có - ví dụ category)
        $url_params = $_GET;
        unset($url_params['url']);
        unset($url_params['page']);
        $url_params['page'] = '(:num)';
        
        $url_query = http_build_query($url_params);
        $url_query = str_replace('%28%3Anum%29', '(:num)', $url_query);
        $pagination = new Pagination($total_posts, $limit, $page, URLROOT . '/page/news?' . $url_query);

        // 2. Lấy danh mục (kèm số lượng bài) cho Sidebar
        $categories = $this->categoryModel->getCategoriesWithCount();

        // 3. Lấy bài viết phổ biến
        $popular_posts = $this->postModel->getPopularPosts();

        $data = [
            'title' => 'Tin tức Công nghệ',
            'posts' => $posts,
            'categories' => $categories,
            'popular_posts' => $popular_posts,
            'pagination' => $pagination->render()
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
    
    public function terms()
    {
        $data = ['title' => 'Điều khoản sử dụng'];
        $this->view('pages/terms', $data);
    }

    public function privacy()
    {
        $data = ['title' => 'Chính sách bảo mật'];
        $this->view('pages/privacy', $data);
    }
}
