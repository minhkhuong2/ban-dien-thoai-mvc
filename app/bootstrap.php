<?php
// File: app/bootstrap.php

// Khởi động Session
session_start();

// 1. TẢI CONFIG TRƯỚC TIÊN (Rất quan trọng)
// File này định nghĩa DB_HOST
require_once 'config/config.php';

// 2. TẢI CÁC FILE LÕI
// File Database.php dùng DB_HOST, nên phải tải SAU config
require_once 'core/Database.php';
require_once 'core/App.php';
require_once 'core/Controller.php';

// (Tải các helper hoặc thư viện khác nếu có)
