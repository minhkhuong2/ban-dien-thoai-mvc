<?php
// File: public/index.php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// 1. Gọi file khởi động (bootstrap)
// Đây là file sẽ "require" các file lõi quan trọng
require_once '../app/bootstrap.php';

// 2. Khởi tạo lớp App (Bộ định tuyến)
// Lớp App này sẽ là bộ não xử lý URL của chúng ta
$app = new App();
