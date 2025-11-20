<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($data['title']) ? $data['title'] . ' - ' : '') . SITENAME; ?> (Admin)</title>
    <script src="https://cdn.tiny.cloud/1/f5ki7g32fbz5dvwyewmebby06c18z1eictmhgmftkwkhehmi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --danger-color: #e74c3c;
            --success-color: #2ecc71;
            --light-color: #ecf0f1;
            --dark-color: #34495e;
            --white-color: #ffffff;
            --border-color: #ddd;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f7f6;
            color: var(--dark-color);
        }

        .admin-header {
            background: var(--white-color);
            padding: 15px 30px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .admin-header strong {
            font-size: 1.2em;
            color: var(--secondary-color);
        }

        .admin-header a {
            color: var(--primary-color);
            text-decoration: none;
            margin-left: 15px;
        }

        .admin-wrapper {
            display: flex;
        }

        .admin-sidebar {
            width: 230px;
            background: var(--secondary-color);
            min-height: calc(100vh - 61px);
            /* 100vh trừ đi chiều cao header */
            color: var(--light-color);
            padding: 20px;
            box-sizing: border-box;
        }

        .admin-sidebar h3 {
            text-align: center;
            color: var(--light-color);
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #4a6278;
        }

        .admin-sidebar ul {
            list-style: none;
            padding: 0;
        }

        .admin-sidebar ul li a {
            display: block;
            padding: 12px 18px;
            color: var(--light-color);
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 8px;
            transition: background 0.3s ease;
        }

        .admin-sidebar ul li a:hover,
        .admin-sidebar ul li a.active {
            background: var(--primary-color);
        }

        .admin-content {
            flex-grow: 1;
            padding: 30px;
        }

        .admin-content h2 {
            margin-top: 0;
            color: var(--secondary-color);
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
        }

        /* CSS cho Bảng (Table) */
        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f9f9f9;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        /* CSS cho Nút (Button) */
        .btn {
            display: inline-block;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: var(--white-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.3s ease;
            margin-bottom: 20px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-success {
            background-color: var(--success-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
        }

        .btn-secondary {
            background-color: #95a5a6;
        }

        .action-links a {
            color: var(--primary-color);
            text-decoration: none;
            margin-right: 10px;
        }

        .action-links a.delete {
            color: var(--danger-color);
        }

        .tox-notification {
            display: none !important;
        }
    </style>
</head>

<body>

    <header class="admin-header">
        <strong>Trang Quản Trị</strong>
        <div>
            <a href="<?php echo URLROOT; ?>/" target="_blank">Xem Website</a> |
            <a href="<?php echo URLROOT; ?>/user/logout">Đăng Xuất (<?php echo $_SESSION['user_name']; ?>)</a>
        </div>
    </header>

    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="<?php echo URLROOT; ?>/admin">Dashboard</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/products">Quản lý Sản phẩm</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/product_categories" style="padding-left: 30px;">Danh mục Sản phẩm</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/attributes">Quản lý Thuộc tính</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/orders">Quản lý Đơn hàng</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/users">Quản lý Người dùng</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/vouchers">Quản lý Voucher</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/posts">Quản lý Tin tức</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/post_categories">Danh mục Tin tức</a></li>
                <li><a href="<?php echo URLROOT; ?>/admin/reviews">Quản lý Đánh giá</a></li>
            </ul>

            </ul>
        </aside>

        <main class="admin-content">
