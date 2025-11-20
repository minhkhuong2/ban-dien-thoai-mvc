<div class="static-page-container" style="max-width: 500px; margin: 50px auto;">
    <h2 style="text-align: center;">Đặt Mật Khẩu Mới</h2>

    <?php if (!empty($data['error_message'])) : ?>
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <?php echo $data['error_message']; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/user/reset_password/<?php echo $data['token']; ?>" method="POST">
        <div class="form-group" style="margin-bottom: 15px;">
            <label>Mật khẩu mới</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <div class="form-group" style="margin-bottom: 15px;">
            <label>Nhập lại mật khẩu mới</label>
            <input type="password" name="confirm_password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Đổi mật khẩu</button>
    </form>
</div>
