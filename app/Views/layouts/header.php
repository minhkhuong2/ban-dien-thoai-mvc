<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($data['title']) ? $data['title'] . ' - ' : '') . SITENAME; ?></title>
    <script>
        var URLROOT = '<?php echo URLROOT; ?>';
    </script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <header class="main-header">
        <nav class="navbar">
            <a href="<?php echo URLROOT; ?>/" class="logo-link">
                <img src="<?php echo URLROOT; ?>/images/Logo.png" alt="<?php echo SITENAME; ?>">
            </a>

            <div class="main-nav">
                <a href="<?php echo URLROOT; ?>/" class="active">Trang Chủ</a>
                <a href="<?php echo URLROOT; ?>/page/about">Giới thiệu</a>
                <a href="<?php echo URLROOT; ?>/product/all">Sản Phẩm</a>
                <a href="<?php echo URLROOT; ?>/page/promotions">Khuyến Mãi</a>
                <a href="<?php echo URLROOT; ?>/page/news">Tin Tức</a>
                <a href="<?php echo URLROOT; ?>/page/support">Hỗ Trợ</a>
            </div>

            <div class="user-area">
                <form action="<?php echo URLROOT; ?>/product/search" method="GET" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>

                <a href="<?php echo URLROOT; ?>/cart" class="cart-icon">
                    <svg viewBox="0 0 24 24" class="icon icon-bag">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <?php
                    $cart_total_quantity = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
                    ?>
                    <span class="cart-count" id="cart-count-badge"><?php echo $cart_total_quantity; ?></span>
                </a>

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <div class="user-profile">
                        <div class="avatar"><?php echo htmlspecialchars(strtoupper(substr($_SESSION['user_name'], 0, 1))); ?></div>
                        <div class="dropdown-menu">
                            <div class="user-info">
                                <span><?php echo $_SESSION['user_name']; ?></span>
                            </div>
                            <a href="<?php echo URLROOT; ?>/user/profile">Thông tin cá nhân</a>
                            <a href="<?php echo URLROOT; ?>/user/orders">Lịch sử đơn hàng</a>

                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) : ?>
                                <a href="<?php echo URLROOT; ?>/admin" style="color: #e74c3c; font-weight: bold; border-top: 1px dashed #ccc;">
                                    ⚙️ Trang Quản Trị
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo URLROOT; ?>/user/logout" class="logout">Đăng Xuất</a>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="<?php echo URLROOT; ?>/user/login" class="user-icon-link">
                        <svg viewBox="0 0 24 24" class="icon">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                <?php endif; ?>

                <button id="mobile-menu-btn" class="mobile-menu-btn">
                    <svg viewBox="0 0 24 24" class="icon">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>
    <div class="mobile-menu-container" id="mobile-menu-container">
        <div class="mobile-menu-header">
            <span class="logo-text">PhoneStore</span>
            <button id="close-mobile-menu" class="close-btn">&times;</button>
        </div>

        <div class="mobile-search">
            <form action="<?php echo URLROOT; ?>/product/search" method="GET">
                <input type="text" name="query" placeholder="Tìm kiếm điện thoại...">
            </form>
        </div>

        <div class="mobile-nav-links">
            <a href="<?php echo URLROOT; ?>/">Trang chủ</a>
            <a href="<?php echo URLROOT; ?>/page/about">Giới thiệu</a>
            <a href="<?php echo URLROOT; ?>/product/all">Sản phẩm</a>
            <a href="<?php echo URLROOT; ?>/product/brand">Thương hiệu</a>
            <a href="<?php echo URLROOT; ?>/page/support">Hỗ trợ</a>
            <a href="<?php echo URLROOT; ?>/page/contact">Liên hệ</a>

            <?php if (!isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/user/login">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
