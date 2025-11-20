<h2><?php echo $data['title']; ?></h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò (Quyền)</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($data['users'])) : ?>
            <tr>
                <td colspan="6" style="text-align: center;">Chưa có người dùng nào đăng ký.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($data['users'] as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td>
                        <?php if ($user['is_admin'] == 1) : ?>
                            <strong style="color: #e74c3c;">Admin (Quản trị)</strong>
                        <?php else : ?>
                            <span>User (Khách hàng)</span>
                        <?php endif; ?>
                    </td>

                    <td class="action-links">
                        <a href="<?php echo URLROOT; ?>/admin/editUser/<?php echo $user['id']; ?>">
                            Sửa vai trò
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
