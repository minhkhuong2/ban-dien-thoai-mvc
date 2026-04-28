<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $data['title']; ?></h3>
    </div>

    <?php if (isset($_GET['success'])) : ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 15px;">
            Đã gửi phản hồi thành công!
        </div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Người gửi</th>
                    <th>Email</th>
                    <th>Chủ đề</th>
                    <th>Ngày gửi</th>
                    <th>Trạng thái</th>
                    <th class="text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['contacts'])) : ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px;">Không có liên hệ nào.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['contacts'] as $contact) : ?>
                        <tr>
                            <td>#<?php echo $contact['id']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($contact['name']); ?></strong><br>
                                <small><?php echo htmlspecialchars($contact['phone']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($contact['email']); ?></td>
                            <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?></td>
                            <td>
                                <?php if ($contact['status'] == 1) : ?>
                                    <span class="badge badge-success">Đã phản hồi</span>
                                <?php else : ?>
                                    <span class="badge badge-warning">Chưa đọc</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-right">
                                <div style="display: inline-flex; gap: 8px;">
                                    <a href="<?php echo URLROOT; ?>/admin/replyContact/<?php echo $contact['id']; ?>" class="btn-icon" title="Xem & Trả lời">
                                        <i class="fas fa-reply"></i>
                                    </a>
                                    <a href="<?php echo URLROOT; ?>/admin/deleteContact/<?php echo $contact['id']; ?>"
                                        class="btn-icon"
                                        title="Xóa"
                                        style="color: var(--danger-color); border-color: var(--danger-color);"
                                        onclick="return confirm('Bạn có chắc muốn xóa liên hệ này?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        <?php echo $data['pagination'] ?? ''; ?>
    </div>
</div>
