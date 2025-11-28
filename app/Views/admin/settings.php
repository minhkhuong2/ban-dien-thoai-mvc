<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<?php if (!empty($data['success'])): ?>
    <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #a7f3d0;">
        <i class="fas fa-check-circle"></i> <?php echo $data['success']; ?>
    </div>
<?php endif; ?>

<?php if (!empty($data['error'])): ?>
    <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fecaca;">
        <i class="fas fa-exclamation-circle"></i> <?php echo $data['error']; ?>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-user-edit"></i> Thông tin chung</h4>
        </div>
        <form action="" method="POST" style="padding: 24px;">
            <div class="form-group">
                <label class="form-label">Email (Tài khoản)</label>
                <input type="text" value="<?php echo htmlspecialchars($data['user']['email']); ?>" class="form-control" disabled style="background: #f1f5f9;">
            </div>
            <div class="form-group">
                <label class="form-label">Họ và Tên</label>
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($data['user']['full_name']); ?>" required class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($data['user']['phone']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($data['user']['address']); ?>" class="form-control">
            </div>

            <div class="text-right">
                <button type="submit" name="update_info" class="btn btn-primary">Cập nhật thông tin</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-key"></i> Đổi mật khẩu</h4>
        </div>
        <form action="" method="POST" style="padding: 24px;">
            <div class="form-group">
                <label class="form-label">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" required class="form-control">
            </div>
            <hr style="margin: 20px 0; border: 0; border-top: 1px dashed #e2e8f0;">
            <div class="form-group">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="new_password" required class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" name="confirm_password" required class="form-control">
            </div>

            <div class="text-right">
                <button type="submit" name="change_pass" class="btn btn-danger">Đổi mật khẩu</button>
            </div>
        </form>
    </div>

</div>
