<?php
// File: app/config/config.php

// Thông tin Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // User mặc định của XAMPP
define('DB_PASS', '');     // Password mặc định của XAMPP
define('DB_NAME', 'db_ban_dien_thoai'); // Tên DB bạn đã tạo ở bước trước
// THÊM CÁC HẰNG SỐ NÀY:

// Đường dẫn gốc của thư mục app (ví dụ: C:\xampp\htdocs\ban-dien-thoai-mvc\app)
define('APPROOT', dirname(dirname(__FILE__)));

// Đường dẫn URL gốc (ví dụ: http://localhost/ban-dien-thoai-mvc/public)
define('URLROOT', 'http://localhost/ban-dien-thoai-mvc/public');

// Tên của website
define('SITENAME', 'Cửa hàng Điện thoại');
