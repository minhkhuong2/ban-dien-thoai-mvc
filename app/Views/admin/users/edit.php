<style>
    .form-container {
        max-width: 500px;
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .user-info-row {
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .user-info-row label {
        font-weight: bold;
        color: #555;
        width: 100px;
        display: inline-block;
    }
</style>

<h2><?php echo $data['title']; ?></h2>

<div class="form-container">
    <div class="user-info-row">
        <label>Họ tên:</label> <?php echo htmlspecialchars($data['user']['full_name']); ?>
    </div>
    <div class="user-info-row">
        <label>Email:</label> <?php echo htmlspecialchars($data['user']['email']); ?>
    </div>

    <hr style="margin: 20px 0; border-top: 1px dashed #ccc;">

    <form action="<?php echo URLROOT; ?>/admin/editUser/<?php echo $data['user']['id']; ?>" method="POST">

        <div style="margin-bottom: 25px;">
            <label style="font-weight: bold; display: block; margin-bottom: 10px; font-size: 1.1rem;">Vai trò trong hệ thống:</label>

            <label style="display: flex; align-items: center; gap: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer;">
                <input type="checkbox" name="is_admin" value="1" style="width: 20px; height: 20px;"
                    <?php echo ($data['user']['is_admin'] == 1) ? 'checked' : ''; ?>>
                <span>Cấp quyền <strong>Quản Trị Viên (Admin)</strong></span>
            </label>
            <p style="color: #777; font-size: 0.9em; margin-top: 5px;">
                * Admin có toàn quyền truy cập vào trang quản trị, thêm sửa xóa sản phẩm, đơn hàng...
            </p>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Cài Đặt</button>
        <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-secondary">Hủy</a>

    </form>
</div>
