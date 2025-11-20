<h3>Tạo tài khoản mới</h3>
<p class="subtext">Đã có tài khoản? <a href="<?php echo URLROOT; ?>/user/login">Đăng nhập ngay</a></p>

<form action="<?php echo URLROOT; ?>/user/register" method="POST">
    <div class="form-group">
        <label for="full_name">Họ và tên <sup>*</sup></label>
        <input type="text" name="full_name" value="<?php echo $data['full_name']; ?>" placeholder="Nhập họ và tên">
        <span class="error-text"><?php echo $data['name_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="email">Email <sup>*</sup></label>
        <input type="email" name="email" value="<?php echo $data['email']; ?>" placeholder="Nhập email">
        <span class="error-text"><?php echo $data['email_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input type="text" name="phone" placeholder="Nhập số điện thoại">
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu <sup>*</sup></label>
        <input type="password" name="password" value="<?php echo $data['password']; ?>" placeholder="Nhập mật khẩu">
        <span class="error-text"><?php echo $data['password_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="confirm_password">Xác nhận mật khẩu <sup>*</sup></label>
        <input type="password" name="confirm_password" value="<?php echo $data['confirm_password']; ?>" placeholder="Nhập lại mật khẩu">
        <span class="error-text"><?php echo $data['confirm_password_err']; ?></span>
    </div>

    <button type="submit" class="btn-submit">Đăng ký</button>
</form>
