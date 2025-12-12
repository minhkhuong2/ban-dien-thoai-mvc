<?php
// File: app/Models/ReviewModel.php

class ReviewModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Thêm một đánh giá mới
    public function addReview($data)
    {
        $this->db->query('INSERT INTO product_reviews 
                            (product_id, user_id, user_name, rating, comment) 
                         VALUES 
                            (:product_id, :user_id, :user_name, :rating, :comment)');

        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':user_name', $data['user_name']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comment', $data['comment']);

        return $this->db->execute();
    }
    public function getAllReviews($limit = null, $offset = 0)
    {
        $sql = "
            SELECT r.*, p.name as product_name, u.full_name as user_name
            FROM product_reviews r
            JOIN products p ON r.product_id = p.id
            JOIN users u ON r.user_id = u.id
            ORDER BY r.created_at DESC
        ";
        
        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int)$offset . ', ' . (int)$limit;
        }

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function countAllReviews()
    {
        $this->db->query('SELECT COUNT(*) as count FROM product_reviews');
        $row = $this->db->single();
        return $row['count'];
    }

    // [ADMIN] Xóa đánh giá
    public function deleteReview($id)
    {
        $this->db->query("DELETE FROM product_reviews WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
