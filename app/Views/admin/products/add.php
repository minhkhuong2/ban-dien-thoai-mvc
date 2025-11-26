<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
    <p style="color: var(--text-light); margin-top: 8px;">Bước 1: Nhập thông tin chung và thông số kỹ thuật cho dòng sản phẩm (ví dụ: "iPhone 15 Pro Max").</p>
</div>

<div class="card" style="max-width: 1000px;">
    <form action="<?php echo URLROOT; ?>/admin/addProduct" method="POST">
        
        <div class="card-header">
            <h4 class="card-title">Thông tin cơ bản</h4>
        </div>
        
        <div style="padding: 24px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label">Tên sản phẩm <span style="color: var(--danger-color);">*</span></label>
                    <input type="text" name="name" required placeholder="Ví dụ: Samsung Galaxy S24 Ultra" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Thương hiệu <span style="color: var(--danger-color);">*</span></label>
                    <select name="brand_id" required class="form-control">
                        <option value="">-- Chọn thương hiệu --</option>
                        <?php foreach ($data['brands'] as $brand): ?>
                            <option value="<?php echo $brand['id']; ?>"><?php echo htmlspecialchars($brand['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Danh mục <span style="color: var(--danger-color);">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($data['categories'] as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>">
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea name="description" rows="5" class="form-control"></textarea>
            </div>
        </div>

        <div class="card-header" style="border-top: 1px solid var(--border-color);">
            <h4 class="card-title">Thông số kỹ thuật (Chung)</h4>
        </div>

        <div style="padding: 24px;">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                <div class="form-group"><label class="form-label">Kích thước màn hình</label><input type="text" name="screen_size" class="form-control"></div>
                <div class="form-group"><label class="form-label">Công nghệ màn hình</label><input type="text" name="screen_tech" class="form-control"></div>
                <div class="form-group"><label class="form-label">Hệ điều hành</label><input type="text" name="os" class="form-control"></div>
                <div class="form-group"><label class="form-label">Camera sau</label><input type="text" name="camera_rear" class="form-control"></div>
                <div class="form-group"><label class="form-label">Camera trước</label><input type="text" name="camera_front" class="form-control"></div>
                <div class="form-group"><label class="form-label">CPU (Tên gọi chung)</label><input type="text" name="cpu" class="form-control"></div>
                <div class="form-group"><label class="form-label">Chip (Tên kỹ thuật)</label><input type="text" name="chip" class="form-control"></div>
                <div class="form-group"><label class="form-label">RAM (Chung)</label><input type="text" name="ram" placeholder="Ví dụ: 12GB" class="form-control"></div>
                <div class="form-group"><label class="form-label">Loại RAM</label><input type="text" name="ram_tech" class="form-control"></div>
                <div class="form-group"><label class="form-label">Dung lượng Pin</label><input type="text" name="battery" class="form-control"></div>
                <div class="form-group"><label class="form-label">Công nghệ Sạc</label><input type="text" name="battery_tech" class="form-control"></div>
                <div class="form-group"><label class="form-label">Kết nối</label><input type="text" name="connectivity" class="form-control"></div>
                <div class="form-group"><label class="form-label">Trọng lượng</label><input type="text" name="weight" class="form-control"></div>
                <div class="form-group"><label class="form-label">Kích thước</label><input type="text" name="dimensions" class="form-control"></div>
            </div>
        </div>

        <div style="padding: 24px; border-top: 1px solid var(--border-color); background-color: var(--bg-color); border-radius: 0 0 var(--radius-lg) var(--radius-lg); display: flex; gap: 16px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Lưu và Tiếp tục (Thêm Biến thể)
            </button>
            <a href="<?php echo URLROOT; ?>/admin/products" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>
