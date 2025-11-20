<?php
// File: app/Models/VoucherModel.php

class VoucherModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Lấy tất cả voucher (cho Admin)
    public function getAllVouchers()
    {
        $this->db->query('SELECT * FROM vouchers ORDER BY id DESC');
        return $this->db->resultSet();
    }

    // Thêm voucher mới (cho Admin)
    public function createVoucher($data)
    {
        $this->db->query('INSERT INTO vouchers 
                            (code, type, value, min_order_value, start_date, end_date, usage_limit, is_active) 
                         VALUES 
                            (:code, :type, :value, :min_order_value, :start_date, :end_date, :usage_limit, :is_active)');

        $this->db->bind(':code', $data['code']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':value', $data['value']);
        $this->db->bind(':min_order_value', $data['min_order_value']);
        $this->db->bind(':start_date', $data['start_date'] ?: null); // Xử lý nếu ngày rỗng
        $this->db->bind(':end_date', $data['end_date'] ?: null);     // Xử lý nếu ngày rỗng
        $this->db->bind(':usage_limit', $data['usage_limit']);
        $this->db->bind(':is_active', $data['is_active']);

        return $this->db->execute();
    }
    // Tìm voucher bằng mã code (dùng cho người dùng)
    // Chỉ lấy voucher còn hoạt động, còn hạn, còn lượt dùng
    public function findVoucherByCode($code)
    {
        $this->db->query('SELECT * FROM vouchers 
                     WHERE code = :code 
                     AND is_active = 1
                     AND (start_date IS NULL OR start_date <= NOW())
                     AND (end_date IS NULL OR end_date >= NOW())
                     AND (usage_limit = 0 OR usage_count < usage_limit)');

        $this->db->bind(':code', $code);
        return $this->db->single();
    }

    // Tăng số lần đã sử dụng voucher lên 1
    public function incrementVoucherUsage($voucher_id)
    {
        $this->db->query('UPDATE vouchers SET usage_count = usage_count + 1 WHERE id = :id');
        $this->db->bind(':id', $voucher_id);
        return $this->db->execute();
    }

    // (Các hàm khác như findByCode, updateUsage... sẽ thêm sau)
}
