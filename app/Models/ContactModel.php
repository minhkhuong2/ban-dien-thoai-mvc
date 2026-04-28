<?php
// File: app/Models/ContactModel.php

class ContactModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Thêm liên hệ mới vào CSDL
    public function createContact($data)
    {
        $this->db->query(
            'INSERT INTO contacts (name, phone, email, subject, message) 
             VALUES (:name, :phone, :email, :subject, :message)'
        );

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':message', $data['message']);

        return $this->db->execute();
    }

    // Lấy danh sách liên hệ (có phân trang)
    public function getAllContacts($limit = 10, $offset = 0)
    {
        $sql = 'SELECT * FROM contacts ORDER BY id DESC LIMIT ' . (int)$offset . ', ' . (int)$limit;
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    // Đếm tổng số liên hệ
    public function countAllContacts()
    {
        $this->db->query('SELECT COUNT(*) as count FROM contacts');
        $row = $this->db->single();
        return $row['count'];
    }

    // Lấy thông tin 1 liên hệ
    public function getContactById($id)
    {
        $this->db->query('SELECT * FROM contacts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Cập nhật trạng thái (đã trả lời)
    public function updateContactStatus($id, $status = 1)
    {
        $this->db->query('UPDATE contacts SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Xóa liên hệ
    public function deleteContact($id)
    {
        $this->db->query('DELETE FROM contacts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
