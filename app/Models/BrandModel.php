<?php
// File: app/Models/BrandModel.php

class BrandModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Lấy tất cả thương hiệu
    public function getAllBrands()
    {
        $this->db->query('SELECT * FROM brands ORDER BY name ASC');
        return $this->db->resultSet();
    }
}
