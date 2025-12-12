<?php
// File: app/Models/OrderModel.php

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // HÀM createOrder (ĐÃ SỬA LẠI)
    public function createOrder($orderData, $cartItems)
    {
        try {
            $this->db->dbh->beginTransaction();

            // 1. Thêm vào bảng `orders` (đã thêm 2 cột mới)
            $this->db->query('INSERT INTO orders (user_id, full_name, email, phone, address, 
                            total_amount, voucher_code, voucher_discount, payment_method, shipping_method) 
                         VALUES (:user_id, :full_name, :email, :phone, :address, 
                            :total_amount, :voucher_code, :voucher_discount, :payment_method, :shipping_method)');

            $this->db->bind(':user_id', $orderData['user_id']);
            $this->db->bind(':full_name', $orderData['full_name']);
            $this->db->bind(':email', $orderData['email']);
            $this->db->bind(':phone', $orderData['phone']);
            $this->db->bind(':address', $orderData['address']);
            $this->db->bind(':total_amount', $orderData['total_amount']);
            $this->db->bind(':voucher_code', $orderData['voucher_code']);
            $this->db->bind(':voucher_discount', $orderData['voucher_discount']);
            $this->db->bind(':payment_method', $orderData['payment_method']); // Cột mới
            $this->db->bind(':shipping_method', $orderData['shipping_method']); // Cột mới

            $this->db->execute();
            $orderId = $this->db->dbh->lastInsertId();

            // 2. Thêm vào bảng `order_details` (Giữ nguyên)
            $this->db->query('INSERT INTO order_details (order_id, product_variant_id, quantity, price) 
                         VALUES (:order_id, :product_variant_id, :quantity, :price)');

            foreach ($cartItems as $item) {
                $this->db->bind(':order_id', $orderId);
                $this->db->bind(':product_variant_id', $item['product_variant_id']);
                $this->db->bind(':quantity', $item['quantity']);
                $this->db->bind(':price', $item['price']);
                $this->db->execute();
            }

            $this->db->dbh->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->dbh->rollBack();
            return false;
        }
    }

    // Lấy tất cả đơn hàng của 1 user (có phân trang)
    public function getOrdersByUserId($user_id, $limit = null, $offset = 0)
    {
        $sql = 'SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC';
        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int)$offset . ', ' . (int)$limit;
        }
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    // Đếm tổng số đơn hàng của user (cho phân trang)
    public function countOrdersByUserId($user_id)
    {
        $this->db->query('SELECT COUNT(*) as count FROM orders WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row['count'];
    }

    // Lấy thông tin 1 đơn hàng (cho user)
    public function getOrderById($order_id, $user_id)
    {
        $this->db->query('SELECT * FROM orders WHERE id = :order_id AND user_id = :user_id');
        $this->db->bind(':order_id', $order_id);
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    // Lấy chi tiết đơn hàng (SỬA LẠI JOIN)
    public function getOrderDetails($order_id)
    {
        // Sửa: JOIN với product_variants
        $this->db->query(
            'SELECT od.*, pv.name as variant_name, pv.image as variant_image, p.name as product_name
             FROM order_details as od
             JOIN product_variants as pv ON od.product_variant_id = pv.id
             JOIN products as p ON pv.product_id = p.id
             WHERE od.order_id = :order_id'
        );
        $this->db->bind(':order_id', $order_id);
        return $this->db->resultSet();
    }

    // --- HÀM CHO ADMIN (Giữ nguyên) ---

    public function getAllOrders($limit = null, $offset = 0)
    {
        $sql = 'SELECT * FROM orders ORDER BY order_date DESC';
        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int)$offset . ', ' . (int)$limit;
        }
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getOrderById_Admin($order_id)
    {
        $this->db->query('SELECT * FROM orders WHERE id = :order_id');
        $this->db->bind(':order_id', $order_id);
        return $this->db->single();
    }

    public function updateOrderStatus($order_id, $status)
    {
        $this->db->query('UPDATE orders SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $order_id);
        return $this->db->execute();
    }
    public function getTotalRevenue()
    {
        $this->db->query('SELECT SUM(total_amount) as total FROM orders');
        $row = $this->db->single();
        return $row['total'] ?? 0;
    }

    // Đếm tổng số đơn hàng
    public function countOrders()
    {
        $this->db->query('SELECT COUNT(*) as count FROM orders');
        $row = $this->db->single();
        return $row['count'];
    }

    // Lấy 5 đơn hàng mới nhất
    public function getRecentOrders($limit = 5)
    {
        $this->db->query('SELECT * FROM orders ORDER BY order_date DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
    public function getRevenueChartData()
    {
        // Chỉ tính đơn hàng có status = 3 (Đã hoàn thành)
        $this->db->query("
            SELECT DATE(order_date) as date, SUM(total_amount) as total 
            FROM orders 
            WHERE status = 3 
            AND order_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY DATE(order_date) 
            ORDER BY DATE(order_date) ASC
        ");
        return $this->db->resultSet();
    }

    // [MỚI] Thống kê tỷ lệ trạng thái đơn hàng
    public function getOrderStatusDistribution()
    {
        $this->db->query("
            SELECT status, COUNT(*) as count 
            FROM orders 
            GROUP BY status
        ");
        return $this->db->resultSet();
    }

    // [MỚI] Top sản phẩm bán chạy
    public function getTopSellingProducts($limit = 5) {
        $this->db->query("
            SELECT p.name as product_name, SUM(od.quantity) as total_sold
            FROM order_details od
            JOIN product_variants v ON od.product_variant_id = v.id
            JOIN products p ON v.product_id = p.id
            JOIN orders o ON od.order_id = o.id
            WHERE o.status = 3 -- Chỉ tính đơn hoàn thành
            GROUP BY p.id
            ORDER BY total_sold DESC
            LIMIT :limit
        ");
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
}
