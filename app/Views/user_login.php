<h3>Đăng nhập tài khoản</h3>
<p class="subtext">Chưa có tài khoản? <a href="<?php echo URLROOT; ?>/user/register">Đăng ký ngay</a></p>

<?php if (!empty($data['success_message'])) : ?>
    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        <?php echo $data['success_message']; ?>
    </div>
<?php endif; ?>

<form action="<?php echo URLROOT; ?>/user/login" method="POST">
    <div class="form-group">
        <label for="email">Email <sup>*</sup></label>
        <input type="email" name="email" value="<?php echo $data['email']; ?>" placeholder="Nhập email">
        <span class="error-text"><?php echo $data['email_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu <sup>*</sup></label>
        <input type="password" name="password" value="<?php echo $data['password']; ?>" placeholder="Nhập mật khẩu">
        <span class="error-text"><?php echo $data['password_err']; ?></span>
    </div>

    <div class="form-options">
        <label><input type="checkbox" name="remember"> Ghi nhớ đăng nhập</label>
        <a href="<?php echo URLROOT; ?>/user/forgot_password">Quên mật khẩu?</a>
    </div>

    <button type="submit" class="btn-submit">Đăng nhập</button>
</form>
