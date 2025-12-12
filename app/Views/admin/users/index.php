<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $data['title']; ?></h3>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th class="text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user) : ?>
                    <tr>
                        <td>#<?php echo $user['id']; ?></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <?php if (!empty($user['avatar'])): ?>
                                    <img src="<?php echo URLROOT . '/uploads/avatars/' . $user['avatar']; ?>" 
                                         alt="<?php echo htmlspecialchars($user['full_name']); ?>"
                                         style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 36px; height: 36px; background: var(--primary-light); color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem;">
                                        <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                                <div style="font-weight: 600; color: var(--text-main);"><?php echo htmlspecialchars($user['full_name']); ?></div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone'] ?? 'Chưa cập nhật'); ?></td>
                        <td>
                            <?php if ($user['is_admin'] == 1) : ?>
                                <span class="badge badge-danger">Admin</span>
                            <?php else : ?>
                                <span class="badge badge-success">Khách hàng</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-right">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="<?php echo URLROOT; ?>/admin/editUser/<?php echo $user['id']; ?>" class="btn-icon" title="Phân quyền">
                                    <i class="fas fa-user-cog"></i>
                                </a>
                                <?php if ($user['id'] != $_SESSION['user_id']) : ?>
                                    <a href="<?php echo URLROOT; ?>/admin/deleteUser/<?php echo $user['id']; ?>"
                                        class="btn-icon"
                                        title="Xóa"
                                        style="color: var(--danger-color); border-color: var(--danger-color);"
                                        onclick="return confirm('Xóa người dùng này? Hành động không thể hoàn tác.');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        <?php echo $data['pagination'] ?? ''; ?>
    </div>
</div>
