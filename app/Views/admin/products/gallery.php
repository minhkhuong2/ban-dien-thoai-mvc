<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2><?php echo $data['title']; ?></h2>
    <a href="<?php echo URLROOT; ?>/admin/editProduct/<?php echo $data['product']['id']; ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại Sửa Sản Phẩm
    </a>
</div>

<div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 30px;">
    <form action="<?php echo URLROOT; ?>/admin/gallery/<?php echo $data['product']['id']; ?>" method="POST" enctype="multipart/form-data">

        <div style="display: flex; gap: 20px; align-items: flex-end;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Chọn ảnh (Có thể chọn nhiều)</label>
                <input type="file" name="images[]" multiple accept="image/*" required
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div style="width: 200px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Gán cho màu (Tùy chọn)</label>
                <select name="color" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">-- Chung (Không theo màu) --</option>
                    <?php foreach ($data['colors'] as $color) : ?>
                        <option value="<?php echo htmlspecialchars($color); ?>"><?php echo htmlspecialchars($color); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="height: 42px;">
                <i class="fas fa-upload"></i> Tải lên
            </button>
        </div>
        <small style="color: #666; margin-top: 5px; display: block;">* Giữ phím Ctrl để chọn nhiều ảnh cùng lúc.</small>
    </form>
</div>

<div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
    <h4>Ảnh hiện có</h4>

    <?php if (empty($data['gallery'])) : ?>
        <p>Chưa có ảnh phụ nào.</p>
    <?php else : ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px;">
            <?php foreach ($data['gallery'] as $img) : ?>
                <div style="border: 1px solid #eee; border-radius: 8px; overflow: hidden; position: relative;">

                    <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($img['image']); ?>"
                        style="width: 100%; height: 150px; object-fit: cover;">

                    <div style="padding: 8px; font-size: 0.85em; background: #f9f9f9; border-top: 1px solid #eee;">
                        <?php if ($img['color']) : ?>
                            <span style="color: #007bff;">● <?php echo htmlspecialchars($img['color']); ?></span>
                        <?php else : ?>
                            <span style="color: #999;">Chung</span>
                        <?php endif; ?>
                    </div>

                    <a href="<?php echo URLROOT; ?>/admin/deleteGalleryImage/<?php echo $img['id']; ?>"
                        onclick="return confirm('Xóa ảnh này?')"
                        style="position: absolute; top: 5px; right: 5px; background: rgba(255,0,0,0.8); color: white; width: 25px; height: 25px; text-align: center; line-height: 25px; border-radius: 50%; text-decoration: none;">
                        &times;
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
