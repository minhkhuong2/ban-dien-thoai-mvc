<?php
// File: app/Models/BrandModel.php

class BrandModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBrands()
    {
        $this->db->query('SELECT * FROM brands ORDER BY name ASC');
        return $this->db->resultSet();
    }

    public function getBrandById($id)
    {
        $this->db->query('SELECT * FROM brands WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function createBrand($name, $image)
    {
        $this->db->query('INSERT INTO brands (name, logo) VALUES (:name, :logo)');
        $this->db->bind(':name', $name);
        $this->db->bind(':logo', $image);
        return $this->db->execute();
    }

    public function updateBrand($data)
    {
        $this->db->query('UPDATE brands SET name = :name, logo = :logo WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':logo', $data['logo']);
        return $this->db->execute();
    }

    public function deleteBrand($id)
    {
        $this->db->query('DELETE FROM brands WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
