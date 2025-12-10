<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Admin Panel'; ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin_style.css">

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/f5ki7g32fbz5dvwyewmebby06c18z1eictmhgmftkwkhehmi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <a href="<?php echo URLROOT; ?>/admin" class="sidebar-brand">
                <i class="fas fa-shield-cat"></i>
                <span>AdminPanel</span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo URLROOT; ?>/admin" class="menu-link <?php echo (!isset($data['active_menu']) || $data['active_menu'] == 'dashboard') ? 'active' : ''; ?>">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Products -->
            <li>
                <div class="menu-link" onclick="toggleSubmenu(this)">
                    <i class="fas fa-box"></i>
                    <span>Sản phẩm</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="submenu">
                    <li><a href="<?php echo URLROOT; ?>/admin/products" class="submenu-link">Tất cả sản phẩm</a></li>
                    <li><a href="<?php echo URLROOT; ?>/admin/product_categories" class="submenu-link">Danh mục</a></li>
                    <li><a href="<?php echo URLROOT; ?>/admin/attributes" class="submenu-link">Thuộc tính</a></li>
                </ul>
            </li>
            <li><a href="<?php echo URLROOT; ?>/admin/brands" class="menu-link"><i class="fas fa-copyright"></i> <span>Thương hiệu</span></a></li>

            <!-- Orders -->
            <li>
                <a href="<?php echo URLROOT; ?>/admin/orders" class="menu-link">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>

            <!-- Users -->
            <li>
                <a href="<?php echo URLROOT; ?>/admin/users" class="menu-link">
                    <i class="fas fa-users"></i>
                    <span>Khách hàng</span>
                </a>
            </li>

            <!-- Vouchers -->
            <li>
                <a href="<?php echo URLROOT; ?>/admin/vouchers" class="menu-link">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Mã giảm giá</span>
                </a>
            </li>

            <!-- News -->
            <li>
                <div class="menu-link" onclick="toggleSubmenu(this)">
                    <i class="fas fa-newspaper"></i>
                    <span>Tin tức</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="submenu">
                    <li><a href="<?php echo URLROOT; ?>/admin/posts" class="submenu-link">Bài viết</a></li>
                    <li><a href="<?php echo URLROOT; ?>/admin/post_categories" class="submenu-link">Danh mục tin</a></li>
                </ul>
            </li>

            <!-- Reviews -->
            <li>
                <a href="<?php echo URLROOT; ?>/admin/reviews" class="menu-link">
                    <i class="fas fa-star"></i>
                    <span>Đánh giá</span>
                </a>
            </li>
        </ul>
        <li>
            <a href="<?php echo URLROOT; ?>/admin/settings" class="menu-link <?php echo (isset($data['active_menu']) && $data['active_menu'] == 'settings') ? 'active' : ''; ?>">
                <i class="fas fa-cog"></i>
                <span>Cài đặt tài khoản</span>
            </a>
        </li>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="admin-main">

        <!-- HEADER -->
        <header class="admin-header">
            <div class="header-left">
                <h2><?php echo $data['title'] ?? 'Dashboard'; ?></h2>
            </div>

            <div class="header-right">
                <a href="<?php echo URLROOT; ?>/" target="_blank" class="btn-icon" title="Xem website">
                    <i class="fas fa-globe"></i>
                </a>

                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo isset($_SESSION['user_name']) ? strtoupper(substr($_SESSION['user_name'], 0, 1)) : 'A'; ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?php echo $_SESSION['user_name'] ?? 'Admin'; ?></span>
                        <span class="user-role">Administrator</span>
                    </div>
                </div>

                <a href="<?php echo URLROOT; ?>/user/logout" class="btn-icon" title="Đăng xuất" style="color: var(--danger-color); border-color: var(--danger-color);">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="admin-content">

            <script>
                function toggleSubmenu(element) {
                    const submenu = element.nextElementSibling;
                    const isActive = element.classList.contains('active');

                    // Toggle active state
                    element.classList.toggle('active');
                    submenu.classList.toggle('show');
                }

                // Auto-expand active menu
                document.addEventListener('DOMContentLoaded', function() {
                    const currentPath = window.location.pathname;

                    // Check submenus
                    document.querySelectorAll('.submenu-link').forEach(link => {
                        if (currentPath.includes(link.getAttribute('href'))) {
                            link.classList.add('active');
                            const submenu = link.closest('.submenu');
                            if (submenu) {
                                submenu.classList.add('show');
                                if (submenu.previousElementSibling) {
                                    submenu.previousElementSibling.classList.add('active');
                                }
                            }
                        }
                    });

                    // Check main menus
                    document.querySelectorAll('.menu-link').forEach(link => {
                        const href = link.getAttribute('href');
                        if (href && currentPath === href) {
                            link.classList.add('active');
                        }
                    });
                });
            </script>
