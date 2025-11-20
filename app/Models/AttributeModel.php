<?php
// File: app/Models/AttributeModel.php

class AttributeModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Lấy tất cả thuộc tính (Màu sắc, Dung lượng...)
    public function getAllAttributes()
    {
        $this->db->query('SELECT * FROM attributes ORDER BY name ASC');
        return $this->db->resultSet();
    }

    // Lấy tất cả các giá trị của MỘT thuộc tính
    public function getValuesByAttributeId($attribute_id)
    {
        $this->db->query('SELECT * FROM attribute_values WHERE attribute_id = :attr_id ORDER BY value ASC');
        $this->db->bind(':attr_id', $attribute_id);
        return $this->db->resultSet();
    }

    // Lấy tất cả thuộc tính VÀ các giá trị của chúng (dùng cho trang quản lý)
    public function getAllAttributesWithValues()
    {
        $attributes = $this->getAllAttributes();
        $result = [];
        foreach ($attributes as $attr) {
            $attr['values'] = $this->getValuesByAttributeId($attr['id']);
            $result[] = $attr;
        }
        return $result;
    }

    // Thêm một thuộc tính mới (ví dụ: "RAM")
    public function createAttribute($name)
    {
        $this->db->query('INSERT INTO attributes (name) VALUES (:name)');
        $this->db->bind(':name', $name);
        return $this->db->execute();
    }

    // Thêm một giá trị mới (ví dụ: "512GB" vào "Dung lượng")
    public function createAttributeValue($data)
    {
        $this->db->query('INSERT INTO attribute_values (attribute_id, value) VALUES (:attr_id, :value)');
        $this->db->bind(':attr_id', $data['attribute_id']);
        $this->db->bind(':value', $data['value']);
        return $this->db->execute();
    }
    public function deleteAttribute($id)
    {
        $this->db->query('DELETE FROM attributes WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Xóa một giá trị cụ thể (ví dụ: Xóa "Tím")
    public function deleteAttributeValue($id)
    {
        $this->db->query('DELETE FROM attribute_values WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
