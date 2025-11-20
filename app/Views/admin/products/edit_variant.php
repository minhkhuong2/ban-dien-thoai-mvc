<style>
    .form-container {
        max-width: 800px;
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
    .form-group select {
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
</style>

<h2><?php echo $data['title']; ?></h2>

<?php $variant = $data['variant']; ?>

<div class="form-container">
    <form action="<?php echo URLROOT; ?>/admin/editVariant/<?php echo $variant['id']; ?>" method="POST" enctype="multipart/form-data">

        <div class="form-grid-3">
            <div class="form-group">
                <label>Tên Biến thể <sup>*</sup></label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($variant['name']); ?>">
            </div>

            <div class="form-group">
                <label>Màu sắc <sup>*</sup></label>
                <select name="color" required>
                    <option value="">-- Chọn màu --</option>
                    <?php
                    // Lọc lấy thuộc tính Màu sắc từ $data['all_attributes']
                    $colors = [];
                    foreach ($data['all_attributes'] as $attr) {
                        if ($attr['name'] == 'Màu sắc') $colors = $attr['values'];
                    }
                    ?>
                    <?php foreach ($colors as $color_value) : ?>
                        <option value="<?php echo htmlspecialchars($color_value['value']); ?>"
                            <?php echo ($color_value['value'] == $variant['color']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($color_value['value']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Dung lượng <sup>*</sup></label>
                <select name="storage" required>
                    <option value="">-- Chọn dung lượng --</option>
                    <?php
                    // Lọc lấy thuộc tính Dung lượng
                    $storages = [];
                    foreach ($data['all_attributes'] as $attr) {
                        if ($attr['name'] == 'Dung lượng') $storages = $attr['values'];
                    }
                    ?>
                    <?php foreach ($storages as $storage_value) : ?>
                        <option value="<?php echo htmlspecialchars($storage_value['value']); ?>"
                            <?php echo ($storage_value['value'] == $variant['storage']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($storage_value['value']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Giá bán <sup>*</sup></label>
                <input type="number" name="price" required value="<?php echo $variant['price']; ?>">
            </div>
            <div class="form-group">
                <label>Giá Sale</label>
                <input type="number" name="price_sale" value="<?php echo $variant['price_sale']; ?>">
            </div>
            <div class="form-group">
                <label>Số lượng tồn kho <sup>*</sup></label>
                <input type="number" name="stock_quantity" required value="<?php echo $variant['stock_quantity']; ?>">
            </div>

            <div class="form-group">
                <label>Ảnh biến thể (Để trống nếu không đổi)</label>
                <input type="file" name="image" accept="image/*">
                <input type="hidden" name="current_image" value="<?php echo $variant['image']; ?>">
                <img src="<?php echo URLROOT . '/uploads/' . $variant['image']; ?>" alt="" style="width: 80px; margin-top: 10px;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Biến thể</button>
        <a href="<?php echo URLROOT; ?>/admin/editProduct/<?php echo $variant['product_id']; ?>" class="btn btn-secondary">Hủy</a>
    </form>
</div>
