<style>
    /* CSS tạm thời cho form */
    .form-container {
        max-width: 900px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
</style>

<h2><?php echo $data['title']; ?></h2>
<p>Bước 1: Nhập thông tin chung và thông số kỹ thuật cho dòng sản phẩm (ví dụ: "iPhone 15 Pro Max").</p>

<div class="form-container">
    <form action="<?php echo URLROOT; ?>/admin/addProduct" method="POST">

        <h4>Thông tin cơ bản</h4>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Tên sản phẩm <sup>*</sup></label>
                <input type="text" name="name" required placeholder="Ví dụ: Samsung Galaxy S24 Ultra">
            </div>
            <div class="form-group">
                <label>Thương hiệu <sup>*</sup></label>
                <select name="brand_id" required>
                    <option value="">-- Chọn thương hiệu --</option>
                    <?php foreach ($data['brands'] as $brand): ?>
                        <option value="<?php echo $brand['id']; ?>"><?php echo htmlspecialchars($brand['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Danh mục <sup>*</sup></label>
                <select name="category_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($data['categories'] as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Mô tả sản phẩm</label>
            <textarea name="description" rows="5"></textarea>
        </div>

        <hr>
        <h4>Thông số kỹ thuật (Chung)</h4>
        <div class="form-grid-3">
            <div class="form-group"><label>Kích thước màn hình</label><input type="text" name="screen_size"></div>
            <div class="form-group"><label>Công nghệ màn hình</label><input type="text" name="screen_tech"></div>
            <div class="form-group"><label>Hệ điều hành</label><input type="text" name="os"></div>
            <div class="form-group"><label>Camera sau</label><input type="text" name="camera_rear"></div>
            <div class="form-group"><label>Camera trước</label><input type="text" name="camera_front"></div>
            <div class="form-group"><label>CPU (Tên gọi chung)</label><input type="text" name="cpu"></div>
            <div class="form-group"><label>Chip (Tên kỹ thuật)</label><input type="text" name="chip"></div>
            <div class="form-group"><label>RAM (Chung)</label><input type="text" name="ram" placeholder="Ví dụ: 12GB"></div>
            <div class="form-group"><label>Loại RAM</label><input type="text" name="ram_tech"></div>
            <div class="form-group"><label>Dung lượng Pin</label><input type="text" name="battery"></div>
            <div class="form-group"><label>Công nghệ Sạc</label><input type="text" name="battery_tech"></div>
            <div class="form-group"><label>Kết nối</label><input type="text" name="connectivity"></div>
            <div class="form-group"><label>Trọng lượng</label><input type="text" name="weight"></div>
            <div class="form-group"><label>Kích thước</label><input type="text" name="dimensions"></div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu và Tiếp tục (Thêm Biến thể)</button>
        <a href="<?php echo URLROOT; ?>/admin/products" class="btn btn-secondary">Hủy</a>
    </form>
</div>
