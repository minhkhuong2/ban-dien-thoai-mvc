<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <h4 class="card-title">Thông tin người dùng</h4>
    </div>
    
    <div style="padding: 24px;">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
            <div style="width: 64px; height: 64px; background-color: var(--bg-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary-color); font-weight: bold;">
                <?php echo strtoupper(substr($data['user']['full_name'], 0, 1)); ?>
            </div>
            <div>
                <h3 style="margin: 0; font-size: 1.25rem; color: var(--text-main);"><?php echo htmlspecialchars($data['user']['full_name']); ?></h3>
                <p style="margin: 4px 0 0; color: var(--text-light);"><?php echo htmlspecialchars($data['user']['email']); ?></p>
            </div>
        </div>

        <form action="<?php echo URLROOT; ?>/admin/editUser/<?php echo $data['user']['id']; ?>" method="POST">
            <div class="form-group">
                <label class="form-label">Vai trò trong hệ thống</label>
                <label style="display: flex; align-items: flex-start; gap: 12px; padding: 16px; border: 1px solid var(--border-color); border-radius: var(--radius-md); cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary-color)'" onmouseout="this.style.borderColor='var(--border-color)'">
                    <input type="checkbox" name="is_admin" value="1" style="width: 20px; height: 20px; margin-top: 2px;"
                        <?php echo ($data['user']['is_admin'] == 1) ? 'checked' : ''; ?>>
                    <div>
                        <span style="display: block; font-weight: 600; color: var(--text-main); margin-bottom: 4px;">Cấp quyền Quản Trị Viên (Admin)</span>
                        <span style="display: block; font-size: 0.9rem; color: var(--text-light);">Admin có toàn quyền truy cập vào trang quản trị, thêm sửa xóa sản phẩm, đơn hàng...</span>
                    </div>
                </label>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 16px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu Cài Đặt
                </button>
                <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
