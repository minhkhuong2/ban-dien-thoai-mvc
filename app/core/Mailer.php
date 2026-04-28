<?php
// File: app/core/Mailer.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load thư viện thủ công
require_once APPROOT . '/lib/PHPMailer/Exception.php';
require_once APPROOT . '/lib/PHPMailer/PHPMailer.php';
require_once APPROOT . '/lib/PHPMailer/SMTP.php';

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        try {
            // Cấu hình Server gửi mail (Sử dụng Gmail)
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;

            // --- THAY ĐỔI THÔNG TIN CỦA BẠN Ở ĐÂY ---
            $this->mail->Username   = 'khuongbuivan826@gmail.com'; // Email của bạn
            $this->mail->Password   = 'fhto okta vdde imqu'; // Mật khẩu ứng dụng (Không phải pass đăng nhập)
            // ----------------------------------------

            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port       = 587;
            $this->mail->CharSet    = 'UTF-8'; // Hỗ trợ tiếng Việt

            // Người gửi mặc định
            $this->mail->setFrom('no-reply@phonestore.com', 'PhoneStore Notification');
        } catch (Exception $e) {
            // Ghi log lỗi nếu cần
        }
    }

    public function sendOrderConfirmation($toEmail, $customerName, $orderId, $totalAmount, $items)
    {
        try {
            // Người nhận
            $this->mail->clearAddresses();
            $this->mail->addAddress($toEmail, $customerName);

            // Tiêu đề
            $this->mail->isHTML(true);
            $this->mail->Subject = "Xác nhận đơn hàng #$orderId - PhoneStore";

            // Nội dung Email (HTML)
            $body = "<h1>Cảm ơn bạn đã đặt hàng tại PhoneStore!</h1>";
            $body .= "<p>Xin chào <strong>$customerName</strong>,</p>";
            $body .= "<p>Đơn hàng <strong>#$orderId</strong> của bạn đã được tiếp nhận.</p>";

            $body .= "<h3>Chi tiết đơn hàng:</h3>";
            $body .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
            $body .= "<tr style='background-color: #f2f2f2;'><th>Sản phẩm</th><th>Số lượng</th><th>Đơn giá</th></tr>";

            foreach ($items as $item) {
                // Lưu ý: Ở Controller ta cần truyền đúng dữ liệu item có tên sản phẩm
                $body .= "<tr>";
                $body .= "<td>" . ($item['product_name'] ?? 'Sản phẩm công nghệ') . "</td>"; // Tên SP
                $body .= "<td style='text-align: center;'>" . $item['quantity'] . "</td>";
                $body .= "<td style='text-align: right;'>" . number_format($item['price']) . " VNĐ</td>";
                $body .= "</tr>";
            }

            $body .= "</table>";
            $body .= "<h3>Tổng thanh toán: <span style='color: red;'>" . number_format($totalAmount) . " VNĐ</span></h3>";
            $body .= "<p>Chúng tôi sẽ sớm liên hệ để giao hàng.</p>";
            $body .= "<hr>";
            $body .= "<small>Đây là email tự động, vui lòng không trả lời.</small>";

            $this->mail->Body = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false; // Gửi thất bại
        }
    }

    public function sendPasswordReset($toEmail, $token)
    {
        try {
            $this->mail->addAddress($toEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Yêu cầu đặt lại mật khẩu - PhoneStore";

            // Tạo link reset (Lưu ý URLROOT phải đúng)
            $resetLink = URLROOT . "/user/reset_password/" . $token;

            $body = "<h3>Yêu cầu đặt lại mật khẩu</h3>";
            $body .= "<p>Bạn vừa yêu cầu đặt lại mật khẩu tại PhoneStore.</p>";
            $body .= "<p>Vui lòng bấm vào link dưới đây để tạo mật khẩu mới (Link hết hạn sau 1 giờ):</p>";
            $body .= "<p><a href='$resetLink' style='background:#007bff; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;'>Đặt lại mật khẩu</a></p>";
            $body .= "<p>Hoặc copy link này: $resetLink</p>";

            $this->mail->Body = $body;
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
