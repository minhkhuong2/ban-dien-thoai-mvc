<div class="static-page-container" style="max-width: 500px; margin: 50px auto;">
    <h2 style="text-align: center;">Quên Mật Khẩu?</h2>
    <p style="text-align: center; color: #666; margin-bottom: 20px;">Nhập email của bạn, chúng tôi sẽ gửi link đặt lại mật khẩu.</p>

    <?php if (!empty($data['success_message'])) : ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <?php echo $data['success_message']; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['error_message'])) : ?>
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <?php echo $data['error_message']; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/user/forgot_password" method="POST">
        <div class="form-group" style="margin-bottom: 15px;">
            <label for="email">Email đăng ký</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Gửi yêu cầu</button>
    </form>
    <div style="text-align: center; margin-top: 15px;">
        <a href="<?php echo URLROOT; ?>/user/login">Quay lại Đăng nhập</a>
    </div>
</div>
