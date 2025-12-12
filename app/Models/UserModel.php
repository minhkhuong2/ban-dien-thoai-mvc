<?php
// File: app/Models/UserModel.php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Tìm user bằng email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        // Kiểm tra xem email có tồn tại không
        return ($this->db->rowCount() > 0);
    }

    // Đăng ký user
    public function register($data)
    {
        $this->db->query('INSERT INTO users (full_name, email, password) VALUES(:name, :email, :password)');

        // Gán giá trị
        $this->db->bind(':name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password_hash']);

        // Thực thi
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Đăng nhập user (ĐÃ SỬA LỖI CÚ PHÁP)
    public function login($email, $password)
    {
        // SỬA LỖI: Dùng dấu ->
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        // SỬA LỖI: Dùng dấu ->
        $row = $this->db->single();

        if ($row) {
            // Lấy mật khẩu đã băm (hash) từ database
            $hashed_password = $row['password'];

            // So sánh mật khẩu người dùng nhập với mật khẩu đã băm
            if (password_verify($password, $hashed_password)) {
                // Mật khẩu đúng, trả về thông tin user
                return $row;
            } else {
                // Mật khẩu sai
                return false;
            }
        } else {
            // Không tìm thấy email
            return false;
        }
    }
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    public function updateUserRole($user_id, $is_admin)
    {
        $this->db->query('UPDATE users SET is_admin = :is_admin WHERE id = :id');

        $this->db->bind(':is_admin', $is_admin);
        $this->db->bind(':id', $user_id);

        return $this->db->execute();
    }
    // Cập nhật thông tin cá nhân (dùng cho người dùng)
    public function updateProfile($data)
    {
        $this->db->query('UPDATE users SET 
                        full_name = :full_name, 
                        phone = :phone, 
                        address = :address 
                     WHERE id = :id');

        $this->db->bind(':id', $data['user_id']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);

        // [MỚI] Cập nhật Avatar nếu có
        if (isset($data['avatar']) && !empty($data['avatar'])) {
             $this->db->query('UPDATE users SET 
                        full_name = :full_name, 
                        phone = :phone, 
                        address = :address,
                        avatar = :avatar
                     WHERE id = :id');
             $this->db->bind(':avatar', $data['avatar']);
             // Bind lại các tham số khác vì query mới
             $this->db->bind(':id', $data['user_id']);
             $this->db->bind(':full_name', $data['full_name']);
             $this->db->bind(':phone', $data['phone']);
             $this->db->bind(':address', $data['address']);
        }

        return $this->db->execute();
    }
    
    // Cập nhật Avatar riêng (Optional helper)
    public function updateAvatarOnly($userId, $filename)
    {
        $this->db->query('UPDATE users SET avatar = :avatar WHERE id = :id');
        $this->db->bind(':avatar', $filename);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }
    public function getAllUsers($limit = null, $offset = 0)
    {
        $sql = 'SELECT id, full_name, email, phone, address, is_admin 
                         FROM users 
                         ORDER BY id DESC';
        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int)$offset . ', ' . (int)$limit;
        }
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    
    public function countAllUsers()
    {
        $this->db->query('SELECT COUNT(*) as count FROM users');
        $row = $this->db->single();
        return $row['count'];
    }
    public function countUsers()
    {
        $this->db->query('SELECT COUNT(*) as count FROM users WHERE is_admin = 0');
        $row = $this->db->single();
        return $row['count'];
    }
    public function updateResetToken($email, $token)
    {
        // Token hết hạn sau 1 giờ
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->db->query("UPDATE users SET reset_token = :token, reset_token_expiry = :expiry WHERE email = :email");
        $this->db->bind(':token', $token);
        $this->db->bind(':expiry', $expiry);
        $this->db->bind(':email', $email);

        return $this->db->execute();
    }

    // [QUÊN MK] 2. Kiểm tra token có hợp lệ không
    public function verifyResetToken($token)
    {
        // Lấy thời gian hiện tại theo giờ PHP
        $now = date('Y-m-d H:i:s');

        // SỬA CÂU TRUY VẤN: So sánh với biến :now thay vì hàm NOW() của MySQL
        $this->db->query("SELECT * FROM users WHERE reset_token = :token AND reset_token_expiry > :now");

        $this->db->bind(':token', $token);
        $this->db->bind(':now', $now); // Bind thêm tham số thời gian

        return $this->db->single();
    }

    // [QUÊN MK] 3. Đổi mật khẩu mới và xóa token
    public function resetPassword($userId, $newPasswordHash)
    {
        $this->db->query("UPDATE users SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE id = :id");
        $this->db->bind(':password', $newPasswordHash);
        $this->db->bind(':id', $userId);

        return $this->db->execute();
    }
    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    // Đổi mật khẩu (Khi đang đăng nhập)
    public function changePassword($id, $newPasswordHash)
    {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        $this->db->bind(':password', $newPasswordHash);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    public function setRememberToken($userId, $token)
    {
        $this->db->query('UPDATE users SET remember_token = :token WHERE id = :id');
        $this->db->bind(':token', $token);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }
    public function getUserByToken($token)
    {
        $this->db->query('SELECT * FROM users WHERE remember_token = :token');
        $this->db->bind(':token', $token);
        return $this->db->single();
    }

    // [GHI NHỚ] 3. Xóa token (Khi đăng xuất)
    public function removeRememberToken($userId)
    {
        $this->db->query('UPDATE users SET remember_token = NULL WHERE id = :id');
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }
}
