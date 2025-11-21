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
