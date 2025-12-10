<?php
// File: app/Models/PostModel.php

class PostModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Lấy 1 bài viết bằng ID (cho Admin)
    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // SỬA: Lấy tất cả bài viết (Kèm tên Tác giả + Danh mục)
    public function getAllPosts()
    {
        $this->db->query('SELECT posts.*, users.full_name as author_name, post_categories.name as category_name
                         FROM posts
                         JOIN users ON posts.user_id = users.id
                         LEFT JOIN post_categories ON posts.category_id = post_categories.id
                         ORDER BY posts.created_at DESC');
        return $this->db->resultSet();
    }

    // Tái sử dụng cho trang người dùng
    public function getAllPosts_User()
    {
        return $this->getAllPosts();
    }

    // Lấy 1 bài viết bằng SLUG (Kèm tên Tác giả + Danh mục)
    public function getPostBySlug($slug)
    {
        $this->db->query('SELECT posts.*, users.full_name as author_name, post_categories.name as category_name
                         FROM posts 
                         JOIN users ON posts.user_id = users.id
                         LEFT JOIN post_categories ON posts.category_id = post_categories.id
                         WHERE posts.slug = :slug');
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    // SỬA: Thêm bài viết (Thêm category_id)
    public function createPost($data)
    {
        $this->db->query('INSERT INTO posts (user_id, category_id, title, content, image, slug) 
                         VALUES (:user_id, :category_id, :title, :content, :image, :slug)');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':category_id', $data['category_id']); // Mới
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':slug', $data['slug']);

        return $this->db->execute();
    }

    // SỬA: Cập nhật bài viết (Thêm category_id)
    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET 
                            category_id = :category_id,
                            title = :title, 
                            content = :content, 
                            image = :image, 
                            slug = :slug
                         WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':category_id', $data['category_id']); // Mới
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':slug', $data['slug']); // Giữ slug cũ

        return $this->db->execute();
    }

    // Xóa bài viết (Giữ nguyên)
    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // HÀM MỚI: Lấy bài viết phổ biến (theo views)
    public function getPopularPosts($limit = 3)
    {
        $this->db->query('SELECT * FROM posts ORDER BY views DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    // HÀM MỚI: Tăng lượt xem
    public function increaseView($id)
    {
        $this->db->query('UPDATE posts SET views = views + 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    // HÀM MỚI: Lấy bài viết liên quan (Trừ bài hiện tại)
    public function getRelatedPosts($current_id, $limit = 5)
    {
        // Lấy ngẫu nhiên hoặc theo ID giảm dần
        $this->db->query('SELECT * FROM posts WHERE id != :id ORDER BY RAND() LIMIT :limit');
        $this->db->bind(':id', $current_id);
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
}

