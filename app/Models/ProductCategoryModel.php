<?php
// File: app/Models/ProductCategoryModel.php

class ProductCategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $this->db->query('SELECT * FROM categories ORDER BY name ASC');
        return $this->db->resultSet();
    }

    // [QUAN TRỌNG] Lấy danh mục kèm số lượng BIẾN THỂ (Variants)
    // Hàm này đã được sửa để đếm từ bảng product_variants
    public function getCategoriesWithCount()
    {
        $this->db->query('SELECT c.*, COUNT(v.id) as product_count 
                          FROM categories c
                          LEFT JOIN products p ON c.id = p.category_id
                          LEFT JOIN product_variants v ON p.id = v.product_id
                          GROUP BY c.id');
        return $this->db->resultSet();
    }

    public function createCategory($name)
    {
        $this->db->query('INSERT INTO categories (name) VALUES (:name)');
        $this->db->bind(':name', $name);
        return $this->db->execute();
    }

    public function deleteCategory($id)
    {
        $this->db->query('DELETE FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
