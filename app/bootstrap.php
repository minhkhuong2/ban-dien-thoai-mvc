<?php
// File: app/bootstrap.php

// Khởi động Session
session_start();

// 1. TẢI CONFIG TRƯỚC TIÊN (Rất quan trọng)
require_once 'config/config.php';

// 2. TẢI CÁC FILE LÕI
require_once 'core/Database.php';
require_once 'core/App.php';
require_once 'core/Controller.php';

// Tải file Mailer (bạn đang để nó trong core)
require_once 'core/Mailer.php';

// (Tải các helper hoặc thư viện khác nếu có sau này)
// --- [MỚI] LOGIC TỰ ĐỘNG ĐĂNG NHẬP NẾU CÓ COOKIE ---
// Kiểm tra: Nếu chưa đăng nhập (Session) NHƯNG có Cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    $token = $_COOKIE['remember_user'];

    // Khởi tạo Database (Vì ở đây chưa gọi Controller/Model)
    $db = new Database();

    // Kiểm tra token trong DB
    $db->query('SELECT * FROM users WHERE remember_token = :token');
    $db->bind(':token', $token);
    $user = $db->single();

    if ($user) {
        // Token đúng -> Tự động tạo Session (Đăng nhập)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['is_admin'] = $user['is_admin'];
    }
}
