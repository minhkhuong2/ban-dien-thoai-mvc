<h2><?php echo $data['title']; ?></h2>

<div class="attribute-box" style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f9f9f9; border-bottom: 2px solid #eee;">
                <th style="padding: 12px; text-align: left;">ID</th>
                <th style="padding: 12px; text-align: left;">Họ và Tên</th>
                <th style="padding: 12px; text-align: left;">Email / SĐT</th>
                <th style="padding: 12px; text-align: center;">Vai trò</th>
                <th style="padding: 12px; text-align: right;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $user) : ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;"><?php echo $user['id']; ?></td>

                    <td style="padding: 12px;">
                        <strong><?php echo htmlspecialchars($user['full_name']); ?></strong>
                    </td>

                    <td style="padding: 12px; color: #555;">
                        <?php echo htmlspecialchars($user['email']); ?><br>
                        <small><?php echo htmlspecialchars($user['phone']); ?></small>
                    </td>

                    <td style="padding: 12px; text-align: center;">
                        <?php if ($user['is_admin'] == 1) : ?>
                            <span style="background: #e74c3c; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: bold;">ADMIN</span>
                        <?php else : ?>
                            <span style="background: #3498db; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 0.85em;">Khách hàng</span>
                        <?php endif; ?>
                    </td>

                    <td style="padding: 12px; text-align: right;">
                        <a href="<?php echo URLROOT; ?>/admin/editUser/<?php echo $user['id']; ?>"
                            style="color: #3498db; text-decoration: none; font-weight: bold; margin-right: 10px;">
                            Phân quyền
                        </a>

                        <?php if ($user['id'] != $_SESSION['user_id']) : ?>
                            <a href="<?php echo URLROOT; ?>/admin/deleteUser/<?php echo $user['id']; ?>"
                                style="color: #e74c3c; text-decoration: none;"
                                onclick="return confirm('CẢNH BÁO: Xóa người dùng này sẽ xóa toàn bộ Đơn hàng và Đánh giá của họ.\nBạn có chắc chắn muốn xóa?');">
                                Xóa
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
