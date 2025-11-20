<?php
// File: app/Models/CategoryModel.php

class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $this->db->query('SELECT * FROM post_categories ORDER BY name ASC');
        return $this->db->resultSet();
    }

    // Lấy danh mục kèm số lượng bài viết (Dùng cho Sidebar)
    public function getCategoriesWithCount()
    {
        $this->db->query('SELECT c.*, COUNT(p.id) as post_count 
                          FROM post_categories c
                          LEFT JOIN posts p ON c.id = p.category_id
                          GROUP BY c.id');
        return $this->db->resultSet();
    }

    public function createCategory($name)
    {
        $this->db->query('INSERT INTO post_categories (name) VALUES (:name)');
        $this->db->bind(':name', $name);
        return $this->db->execute();
    }

    public function deleteCategory($id)
    {
        $this->db->query('DELETE FROM post_categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
