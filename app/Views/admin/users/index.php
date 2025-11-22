<h2><?php echo $data['title']; ?></h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['users'] as $user) : ?>
            <tr>
                <td>#<?php echo $user['id']; ?></td>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 30px; height: 30px; background: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                            <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                        </div>
                        <?php echo htmlspecialchars($user['full_name']); ?>
                    </div>
                </td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['phone'] ?? 'Chưa cập nhật'); ?></td>
                <td>
                    <?php if ($user['is_admin'] == 1) : ?>
                        <span style="background: #e74c3c; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.85em;">Admin</span>
                    <?php else : ?>
                        <span style="background: #2ecc71; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.85em;">Khách hàng</span>
                    <?php endif; ?>
                </td>
                <td class="action-links">
                    <a href="<?php echo URLROOT; ?>/admin/editUser/<?php echo $user['id']; ?>">
                        <i class="fas fa-user-cog"></i> Phân quyền
                    </a>
                    <?php if ($user['id'] != $_SESSION['user_id']) : ?>
                        <a href="<?php echo URLROOT; ?>/admin/deleteUser/<?php echo $user['id']; ?>"
                            class="delete"
                            onclick="return confirm('Xóa người dùng này? Hành động không thể hoàn tác.');">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
