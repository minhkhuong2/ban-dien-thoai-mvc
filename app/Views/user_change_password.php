<div class="static-page-container" style="max-width: 500px; margin: 30px auto;">
    <h2>Đổi Mật Khẩu</h2>

    <?php if (isset($data['error'])) : ?>
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <?php echo $data['error']; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($data['success'])) : ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <?php echo $data['success']; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/user/change_password" method="POST">
        <div class="form-group">
            <label>Mật khẩu hiện tại</label>
            <input type="password" name="current_password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <div class="form-group">
            <label>Xác nhận mật khẩu mới</label>
            <input type="password" name="confirm_password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #288ad6; color: white; border: none; border-radius: 5px; cursor: pointer;">Cập nhật mật khẩu</button>
    </form>

    <div style="margin-top: 15px; text-align: center;">
        <a href="<?php echo URLROOT; ?>/user/profile" style="color: #555;">Quay lại Hồ sơ</a>
    </div>
</div>
