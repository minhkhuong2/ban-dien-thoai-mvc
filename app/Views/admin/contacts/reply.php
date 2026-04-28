<div class="mb-4" style="display: flex; justify-content: space-between; align-items: center;">
    <h2 class="card-title" style="font-size: 1.5rem; margin: 0;"><?php echo $data['title']; ?></h2>
    <a href="<?php echo URLROOT; ?>/admin/contacts" class="btn" style="background-color: #6c757d; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<?php if (isset($data['error'])) : ?>
    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <?php echo $data['error']; ?>
    </div>
<?php endif; ?>

<div class="card">
    <div style="padding: 24px;">
        <h4 style="margin-top: 0;">Thông tin liên hệ</h4>
        <table style="width: 100%; max-width: 600px; margin-bottom: 20px;">
            <tr><td style="width: 150px; padding: 5px 0;"><strong>Họ và tên:</strong></td><td><?php echo htmlspecialchars($data['contact']['name']); ?></td></tr>
            <tr><td style="padding: 5px 0;"><strong>Điện thoại:</strong></td><td><?php echo htmlspecialchars($data['contact']['phone']); ?></td></tr>
            <tr><td style="padding: 5px 0;"><strong>Email:</strong></td><td><?php echo htmlspecialchars($data['contact']['email']); ?></td></tr>
            <tr><td style="padding: 5px 0;"><strong>Chủ đề:</strong></td><td><?php echo htmlspecialchars($data['contact']['subject']); ?></td></tr>
            <tr><td style="padding: 5px 0;"><strong>Ngày gửi:</strong></td><td><?php echo date('d/m/Y H:i', strtotime($data['contact']['created_at'])); ?></td></tr>
        </table>
        
        <h4>Nội dung:</h4>
        <div style="background: #f8f9fa; padding: 15px; border-radius: var(--radius-md); border: 1px solid var(--border-color); margin-bottom: 30px;">
            <?php echo nl2br(htmlspecialchars($data['contact']['message'])); ?>
        </div>

        <form action="<?php echo URLROOT; ?>/admin/replyContact/<?php echo $data['contact']['id']; ?>" method="POST">
            <div class="form-group">
                <label class="form-label" style="font-size: 1.1rem; font-weight: 600;">Gửi phản hồi qua Email</label>
                <textarea name="reply_message" rows="8" class="form-control" placeholder="Nhập nội dung trả lời cho khách hàng tại đây..." required></textarea>
                <small style="color: #666; margin-top: 5px; display: block;">Email phản hồi sẽ được tự động gửi đến địa chỉ: <strong><?php echo htmlspecialchars($data['contact']['email']); ?></strong></small>
            </div>
            
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-size: 1rem;">
                <i class="fas fa-paper-plane"></i> Gửi phản hồi & Đánh dấu đã đọc
            </button>
        </form>
    </div>
</div>
