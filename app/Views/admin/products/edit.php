<style>
    /* CSS tạm thời */
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

    .variant-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #007bff;
    }
</style>

<h2><?php echo $data['title']; ?></h2>
<?php $product = $data['product']; // Lấy data cho gọn 
?>

<div class="form-container" style="background: #f9f9f9; padding: 20px; border-radius: 5px;">
    <h4>Bước 1: Sửa thông tin chung / Thông số kỹ thuật</h4>
    <form action="<?php echo URLROOT; ?>/admin/updateBaseProduct/<?php echo $product['id']; ?>" method="POST">
        <div class="form-grid-2">
            <div class="form-group">
                <label>Tên sản phẩm <sup>*</sup></label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="form-group">
                <label>Thương hiệu <sup>*</sup></label>
                <select name="brand_id" required>
                    <?php foreach ($data['brands'] as $brand): ?>
                        <option value="<?php echo $brand['id']; ?>" <?php echo ($brand['id'] == $product['brand_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($brand['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Danh mục <sup>*</sup></label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($data['categories'] as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"
                            <?php
                            // Kiểm tra nếu ID danh mục trùng với ID danh mục của sản phẩm thì chọn (selected)
                            echo (isset($data['product']) && $data['product']['category_id'] == $cat['id']) ? 'selected' : '';
                            ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Mô tả sản phẩm</label>
            <textarea name="description" rows="5"><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>
        <div class="form-grid-3">
            <div class="form-group"><label>Kích thước màn hình</label><input type="text" name="screen_size" value="<?php echo htmlspecialchars($product['screen_size']); ?>"></div>
            <div class="form-group"><label>Công nghệ màn hình</label><input type="text" name="screen_tech" value="<?php echo htmlspecialchars($product['screen_tech']); ?>"></div>
            <div class="form-group"><label>Hệ điều hành</label><input type="text" name="os" value="<?php echo htmlspecialchars($product['os']); ?>"></div>
            <div class="form-group"><label>Camera sau</label><input type="text" name="camera_rear" value="<?php echo htmlspecialchars($product['camera_rear']); ?>"></div>
            <div class="form-group"><label>Camera trước</label><input type="text" name="camera_front" value="<?php echo htmlspecialchars($product['camera_front']); ?>"></div>
            <div class="form-group"><label>CPU</label><input type="text" name="cpu" value="<?php echo htmlspecialchars($product['cpu']); ?>"></div>
            <div class="form-group"><label>Chip</label><input type="text" name="chip" value="<?php echo htmlspecialchars($product['chip']); ?>"></div>
            <div class="form-group"><label>RAM</label><input type="text" name="ram" value="<?php echo htmlspecialchars($product['ram']); ?>"></div>
            <div class="form-group"><label>Loại RAM</label><input type="text" name="ram_tech" value="<?php echo htmlspecialchars($product['ram_tech']); ?>"></div>
            <div class="form-group"><label>Pin</label><input type="text" name="battery" value="<?php echo htmlspecialchars($product['battery']); ?>"></div>
            <div class="form-group"><label>Sạc</label><input type="text" name="battery_tech" value="<?php echo htmlspecialchars($product['battery_tech']); ?>"></div>
            <div class="form-group"><label>Kết nối</label><input type="text" name="connectivity" value="<?php echo htmlspecialchars($product['connectivity']); ?>"></div>
            <div class="form-group"><label>Trọng lượng</label><input type="text" name="weight" value="<?php echo htmlspecialchars($product['weight']); ?>"></div>
            <div class="form-group"><label>Kích thước</label><input type="text" name="dimensions" value="<?php echo htmlspecialchars($product['dimensions']); ?>"></div>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi Thông tin chung</button>
    </form>
</div>

<div class="form-container variant-section">
    <h4>Bước 2: Quản lý các Biến thể (Dung lượng, Màu sắc, Giá)</h4>

    <h5>Các biến thể hiện có:</h5>
    <table style="width: 100%; margin-bottom: 20px;">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên Biến thể</th>
                <th>Màu</th>
                <th>Dung lượng</th>
                <th>Giá</th>
                <th>Giá Sale</th>
                <th>Tồn kho</th>
                <th>Chỉnh Sửa</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['variants'])) : ?>
                <tr>
                    <td colspan="8" style="text-align: center;">Chưa có biến thể nào.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($data['variants'] as $variant) : ?>
                    <tr>
                        <td><img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($variant['image']); ?>" alt="" style="width: 50px;"></td>
                        <td><?php echo htmlspecialchars($variant['name']); ?></td>
                        <td><?php echo htmlspecialchars($variant['color']); ?></td>
                        <td><?php echo htmlspecialchars($variant['storage']); ?></td>
                        <td><?php echo number_format($variant['price']); ?></td>
                        <td><?php echo number_format($variant['price_sale']); ?></td>
                        <td><?php echo $variant['stock_quantity']; ?></td>
                        <td class="action-links">
                            <a href="<?php echo URLROOT; ?>/admin/editVariant/<?php echo $variant['id']; ?>">Sửa</a>
                            <a href="<?php echo URLROOT; ?>/admin/deleteVariant/<?php echo $variant['id']; ?>" class="delete" onclick="return confirm('Bạn có chắc muốn xóa biến thể này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>
    <h5>Thêm biến thể mới:</h5>
    <form action="<?php echo URLROOT; ?>/admin/addVariant/<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-grid-3">
            <div class="form-group">
                <label>Tên Biến thể <sup>*</sup></label>
                <input type="text" name="name" required placeholder="Ví dụ: 256GB - Xám Titan">
            </div>

            <?php
            // Lọc ra các thuộc tính từ mảng data
            $storages = [];
            $colors = [];
            foreach ($data['all_attributes'] as $attr) {
                if ($attr['name'] == 'Dung lượng') {
                    $storages = $attr['values'];
                }
                if ($attr['name'] == 'Màu sắc') {
                    $colors = $attr['values'];
                }
            }
            ?>

            <div class="form-group">
                <label>Màu sắc <sup>*</sup></label>
                <select name="color" required>
                    <option value="">-- Chọn màu --</option>
                    <?php foreach ($colors as $color_value) : ?>
                        <option value="<?php echo htmlspecialchars($color_value['value']); ?>">
                            <?php echo htmlspecialchars($color_value['value']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Dung lượng <sup>*</sup></label>
                <select name="storage" required>
                    <option value="">-- Chọn dung lượng --</option>
                    <?php foreach ($storages as $storage_value) : ?>
                        <option value="<?php echo htmlspecialchars($storage_value['value']); ?>">
                            <?php echo htmlspecialchars($storage_value['value']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Giá bán <sup>*</sup></label>
                <input type="number" name="price" required placeholder="30000000">
            </div>
            <div class="form-group">
                <label>Giá Sale (Để 0 nếu không sale)</label>
                <input type="number" name="price_sale" value="0">
            </div>
            <div class="form-group">
                <label>Số lượng tồn kho <sup>*</sup></label>
                <input type="number" name="stock_quantity" value="0" required>
            </div>
            <div class="form-group">
                <label>Ảnh cho Biến thể này <sup>*</sup></label>
                <input type="file" name="image" accept="image/*" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Thêm Biến thể mới</button>
    </form>
</div>
