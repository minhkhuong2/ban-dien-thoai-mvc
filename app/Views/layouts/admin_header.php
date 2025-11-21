<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($data['title']) ? $data['title'] . ' - ' : '') . SITENAME; ?> (Admin)</title>
    <script src="https://cdn.tiny.cloud/1/f5ki7g32fbz5dvwyewmebby06c18z1eictmhgmftkwkhehmi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        :root {
            --primary-color: #667eea;
            --primary-dark: #5568d3;
            --secondary-color: #1a1f36;
            --secondary-light: #2d3748;
            --danger-color: #f56565;
            --success-color: #48bb78;
            --warning-color: #f6ad55;
            --light-color: #f7fafc;
            --dark-color: #2d3748;
            --white-color: #ffffff;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            color: var(--dark-color);
            min-height: 100vh;
        }

        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 18px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .admin-header strong {
            font-size: 1.4em;
            color: var(--white-color);
            font-weight: 600;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .admin-header a {
            color: var(--white-color);
            text-decoration: none;
            margin-left: 20px;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .admin-header a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .admin-wrapper {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        .admin-sidebar {
            width: 260px;
            background: var(--secondary-color);
            color: var(--light-color);
            padding: 25px 0;
            box-shadow: var(--shadow-md);
            overflow-y: auto;
        }

        .admin-sidebar h3 {
            text-align: center;
            color: var(--white-color);
            margin: 0 0 25px 0;
            padding: 0 20px 15px;
            border-bottom: 2px solid rgba(102, 126, 234, 0.3);
            font-size: 1.1em;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .admin-sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .admin-sidebar > ul > li {
            margin-bottom: 5px;
        }

        /* Menu item styles */
        .admin-sidebar ul li a,
        .admin-sidebar ul li .menu-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 20px;
            color: #cbd5e0;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 500;
            border-left: 3px solid transparent;
        }

        .admin-sidebar ul li a:hover,
        .admin-sidebar ul li .menu-toggle:hover {
            background: rgba(102, 126, 234, 0.15);
            color: var(--white-color);
            border-left-color: var(--primary-color);
            padding-left: 25px;
        }

        .admin-sidebar ul li a.active {
            background: rgba(102, 126, 234, 0.2);
            color: var(--white-color);
            border-left-color: var(--primary-color);
        }

        /* Dropdown menu styles */
        .menu-toggle {
            position: relative;
        }

        .menu-toggle::after {
            content: '▼';
            font-size: 0.7em;
            transition: transform 0.3s ease;
            opacity: 0.7;
        }

        .menu-toggle.active::after {
            transform: rotate(180deg);
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(0, 0, 0, 0.1);
        }

        .submenu.show {
            max-height: 500px;
        }

        .submenu li a {
            padding: 11px 20px 11px 45px;
            font-size: 0.95em;
            color: #a0aec0;
            border-left: 3px solid transparent;
        }

        .submenu li a:hover {
            color: var(--white-color);
            background: rgba(102, 126, 234, 0.1);
            border-left-color: var(--primary-color);
            padding-left: 50px;
        }

        .submenu li a::before {
            content: '→';
            margin-right: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .submenu li a:hover::before {
            opacity: 1;
        }

        .admin-content {
            flex-grow: 1;
            padding: 35px;
            background: transparent;
        }

        .admin-content h2 {
            margin-top: 0;
            color: var(--secondary-color);
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 12px;
            font-size: 1.8em;
            font-weight: 600;
            display: inline-block;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white-color);
            box-shadow: var(--shadow-sm);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 14px 16px;
            border: 1px solid var(--border-color);
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--white-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tr:hover {
            background-color: #f1f5f9;
            transition: background-color 0.2s ease;
        }

        /* Button styles */
        .btn {
            display: inline-block;
            padding: 11px 22px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            color: var(--white-color);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
        }

        .action-links a {
            color: var(--primary-color);
            text-decoration: none;
            margin-right: 12px;
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .action-links a:hover {
            background: rgba(102, 126, 234, 0.1);
        }

        .action-links a.delete {
            color: var(--danger-color);
        }

        .action-links a.delete:hover {
            background: rgba(245, 101, 101, 0.1);
        }

        .tox-notification {
            display: none !important;
        }

        /* Scrollbar styling */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.5);
            border-radius: 3px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.7);
        }
    </style>
</head>

<body>

    <header class="admin-header">
        <strong>🎯 Trang Quản Trị</strong>
        <div>
            <a href="<?php echo URLROOT; ?>/" target="_blank">🌐 Xem Website</a> |
            <a href="<?php echo URLROOT; ?>/user/logout">🚪 Đăng Xuất (<?php echo $_SESSION['user_name']; ?>)</a>
        </div>
    </header>

    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="<?php echo URLROOT; ?>/admin">📊 Dashboard</a></li>
                
                <!-- Products Dropdown -->
                <li>
                    <div class="menu-toggle" onclick="toggleSubmenu(this)">
                        <span>📦 Sản phẩm</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="<?php echo URLROOT; ?>/admin/products">Quản lý Sản phẩm</a></li>
                        <li><a href="<?php echo URLROOT; ?>/admin/product_categories">Danh mục Sản phẩm</a></li>
                        <li><a href="<?php echo URLROOT; ?>/admin/attributes">Quản lý Thuộc tính</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo URLROOT; ?>/admin/orders">🛒 Quản lý Đơn hàng</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/users">👥 Quản lý Người dùng</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/vouchers">🎟️ Quản lý Voucher</a></li>
                
                <!-- News Dropdown -->
                <li>
                    <div class="menu-toggle" onclick="toggleSubmenu(this)">
                        <span>📰 Tin tức</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="<?php echo URLROOT; ?>/admin/posts">Quản lý Tin tức</a></li>
                        <li><a href="<?php echo URLROOT; ?>/admin/post_categories">Danh mục Tin tức</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo URLROOT; ?>/admin/reviews">⭐ Quản lý Đánh giá</a></li>
            </ul>
        </aside>

        <main class="admin-content">

    <script>
        function toggleSubmenu(element) {
            const submenu = element.nextElementSibling;
            const isActive = element.classList.contains('active');
            
            // Close all other submenus
            document.querySelectorAll('.menu-toggle').forEach(toggle => {
                if (toggle !== element) {
                    toggle.classList.remove('active');
                    toggle.nextElementSibling.classList.remove('show');
                }
            });
            
            // Toggle current submenu
            if (isActive) {
                element.classList.remove('active');
                submenu.classList.remove('show');
            } else {
                element.classList.add('active');
                submenu.classList.add('show');
            }
        }

        // Auto-expand active section on page load
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const submenus = document.querySelectorAll('.submenu');
            
            submenus.forEach(submenu => {
                const links = submenu.querySelectorAll('a');
                links.forEach(link => {
                    if (currentPath.includes(link.getAttribute('href'))) {
                        link.classList.add('active');
                        submenu.classList.add('show');
                        submenu.previousElementSibling.classList.add('active');
                    }
                });
            });

            // Highlight active main menu items
            const mainLinks = document.querySelectorAll('.admin-sidebar > ul > li > a');
            mainLinks.forEach(link => {
                if (currentPath === link.getAttribute('href')) {
                    link.classList.add('active');
                }
            });
        });
    </script>
