<?php
// File: app/Controllers/UserController.php

class UserController extends Controller
{
    private $userModel;
    private $orderModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
    }

    // Hiển thị form đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate
            if (empty($data['full_name'])) $data['name_err'] = 'Vui lòng nhập họ tên';
            if (empty($data['email'])) {
                $data['email_err'] = 'Vui lòng nhập email';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email này đã được sử dụng';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Vui lòng nhập mật khẩu';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Vui lòng xác nhận mật khẩu';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Mật khẩu không khớp';
            }

            // Kiểm tra không có lỗi
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    header('Location: ' . URLROOT . '/user/login');
                    exit();
                } else {
                    die('Có lỗi xảy ra, vui lòng thử lại');
                }
            } else {
                $this->view('user_register', $data);
            }
        } else {
            $data = [
                'title' => 'Đăng ký tài khoản',
                'full_name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('user_register', $data);
        }
    }

    // Hiển thị form đăng nhập VÀ xử lý đăng nhập
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            if (empty($data['email'])) $data['email_err'] = 'Vui lòng nhập email';
            if (empty($data['password'])) $data['password_err'] = 'Vui lòng nhập mật khẩu';

            // Kiểm tra email
            if (empty($data['email_err']) && !$this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email không tồn tại';
            }

            // Kiểm tra không có lỗi
            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    if (isset($_POST['remember'])) {
                        // 1. Tạo token ngẫu nhiên an toàn
                        $token = bin2hex(random_bytes(32));

                        // 2. Lưu vào Database
                        $this->userModel->setRememberToken($loggedInUser['id'], $token);

                        // 3. Lưu vào Cookie trình duyệt (Hết hạn sau 30 ngày)
                        // Tên cookie: 'remember_user', Giá trị: token, Thời gian: 30 ngày, Đường dẫn: /
                        setcookie('remember_user', $token, time() + (86400 * 30), "/");
                    }
                    // Đăng nhập thành công, Tạo Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Mật khẩu không chính xác';
                    $this->view('user_login', $data);
                }
            } else {
                $this->view('user_login', $data);
            }
        } else {
            $data = [
                'title' => 'Đăng nhập',
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            $this->view('user_login', $data);
        }
    }

    /**
     * HÀM QUAN TRỌNG NHẤT (SỐ 1)
     * Đảm bảo bạn có dòng `$_SESSION['is_admin'] = $user['is_admin'];`
     */
    private function createUserSession($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['is_admin'] = $user['is_admin'];

        // --- SỬA ĐOẠN NÀY ---
        // Kiểm tra: Nếu là Admin thì chuyển thẳng vào trang quản trị
        if ($user['is_admin'] == 1) {
            header('Location: ' . URLROOT . '/admin');
        } else {
            // Nếu là khách thì về trang chủ
            header('Location: ' . URLROOT);
        }
        exit();
    }

    // Hàm Đăng xuất
    public function logout()
    {
        // Xóa token trong DB trước khi hủy session
        if (isset($_SESSION['user_id'])) {
            $this->userModel->removeRememberToken($_SESSION['user_id']);
        }
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['is_admin']);
        session_destroy();
        // [MỚI] Xóa Cookie
        setcookie('remember_user', '', time() - 3600, "/");
        header('Location: ' . URLROOT);
        exit();
    }

    // Hiển thị trang Lịch sử đơn hàng
    public function orders()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/user/login');
            exit();
        }
        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user_id']);
        $data = [
            'title' => 'Lịch sử đơn hàng của bạn',
            'orders' => $orders
        ];
        $this->view('user_orders', $data);
    }

    // Hiển thị trang Chi tiết Đơn hàng
    public function orderdetail($order_id = 0)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/user/login');
            exit();
        }
        $order = $this->orderModel->getOrderById($order_id, $_SESSION['user_id']);
        if (!$order) {
            header('Location: ' . URLROOT . '/user/orders');
            exit();
        }
        $details = $this->orderModel->getOrderDetails($order_id);
        $data = [
            'title' => 'Chi tiết Đơn hàng #' . $order_id,
            'order' => $order,
            'details' => $details
        ];
        $this->view('user_order_detail', $data);
    }
    // ----------------------------------------------------
    // HÀM QUẢN LÝ THÔNG TIN CÁ NHÂN (MỚI)
    // ----------------------------------------------------
    public function profile()
    {
        // 1. Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/user/login');
            exit();
        }

        // 2. XỬ LÝ POST (Khi người dùng nhấn Cập nhật)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'full_name' => trim($_POST['full_name']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'success_message' => ''
                // (Thêm validation lỗi sau nếu cần)
            ];

            // Gọi Model để cập nhật
            if ($this->userModel->updateProfile($data)) {
                // Cập nhật thành công, cập nhật lại Session
                $_SESSION['user_name'] = $data['full_name'];

                // Gửi thông báo thành công
                $data['success_message'] = 'Cập nhật thông tin thành công!';

                // Lấy lại thông tin user mới nhất
                $user = $this->userModel->getUserById($_SESSION['user_id']);
                $data['user'] = $user;
                $data['title'] = 'Thông tin cá nhân';

                $this->view('user_profile', $data);
            } else {
                die('Cập nhật thất bại');
            }
        } else {
            // 3. XỬ LÝ GET (Hiển thị form)

            // Lấy thông tin user hiện tại
            $user = $this->userModel->getUserById($_SESSION['user_id']); // Hàm này đã có

            $data = [
                'title' => 'Thông tin cá nhân',
                'user' => $user,
                'success_message' => ''
            ];

            $this->view('user_profile', $data);
        }
    }
    public function forgot_password()
    {
        $data = ['title' => 'Quên mật khẩu'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);

            // 1. Kiểm tra email có tồn tại không
            if ($this->userModel->findUserByEmail($email)) {
                // 2. Tạo Token ngẫu nhiên
                $token = bin2hex(random_bytes(32));

                // 3. Lưu vào DB
                $this->userModel->updateResetToken($email, $token);

                // 4. Gửi Email
                require_once '../app/core/Mailer.php';
                $mailer = new Mailer();
                if ($mailer->sendPasswordReset($email, $token)) {
                    $data['success_message'] = 'Vui lòng kiểm tra Email để lấy lại mật khẩu.';
                } else {
                    $data['error_message'] = 'Gửi mail thất bại. Vui lòng thử lại sau.';
                }
            } else {
                $data['error_message'] = 'Email này chưa được đăng ký.';
            }
        }

        $this->view('user_forgot_password', $data);
    }

    // Trang nhập mật khẩu mới (Từ link email)
    public function reset_password($token = '')
    {
        if (empty($token)) {
            header('Location: ' . URLROOT);
            exit();
        }

        // 1. Xác thực Token
        $user = $this->userModel->verifyResetToken($token);
        if (!$user) {
            die('Liên kết không hợp lệ hoặc đã hết hạn.');
        }

        $data = ['title' => 'Đặt lại mật khẩu mới', 'token' => $token];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];

            if (strlen($password) < 6) {
                $data['error_message'] = 'Mật khẩu phải từ 6 ký tự.';
            } elseif ($password != $confirm) {
                $data['error_message'] = 'Mật khẩu xác nhận không khớp.';
            } else {
                // 2. Đổi mật khẩu
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $this->userModel->resetPassword($user['id'], $newHash);

                // Chuyển về trang đăng nhập
                header('Location: ' . URLROOT . '/user/login?msg=reset_success');
                exit();
            }
        }

        $this->view('user_reset_password', $data);
    }
    public function change_password()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/user/login');
            exit();
        }

        $data = ['title' => 'Đổi mật khẩu'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_pass = $_POST['current_password'];
            $new_pass = $_POST['new_password'];
            $confirm_pass = $_POST['confirm_password'];

            // Lấy thông tin user để check pass cũ
            $user = $this->userModel->getUserById($_SESSION['user_id']);

            if (!password_verify($current_pass, $user['password'])) {
                $data['error'] = 'Mật khẩu hiện tại không đúng';
            } elseif (strlen($new_pass) < 6) {
                $data['error'] = 'Mật khẩu mới phải từ 6 ký tự';
            } elseif ($new_pass != $confirm_pass) {
                $data['error'] = 'Mật khẩu xác nhận không khớp';
            } else {
                // Đổi pass
                $this->userModel->changePassword($_SESSION['user_id'], password_hash($new_pass, PASSWORD_DEFAULT));
                $data['success'] = 'Đổi mật khẩu thành công!';
            }
        }

        $this->view('user_change_password', $data);
    }
}
