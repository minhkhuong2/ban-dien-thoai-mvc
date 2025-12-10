<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<?php $product = $data['product']; ?>

<!-- Step 1: Base Product Info -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Bước 1: Sửa thông tin chung / Thông số kỹ thuật</h4>
    </div>
    <form action="<?php echo URLROOT; ?>/admin/updateBaseProduct/<?php echo $product['id']; ?>" method="POST">
        <div style="padding: 24px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label">Tên sản phẩm <span style="color: var(--danger-color);">*</span></label>
                    <input type="text" name="name" required value="<?php echo htmlspecialchars($product['name']); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Thương hiệu <span style="color: var(--danger-color);">*</span></label>
                    <select name="brand_id" required class="form-control">
                        <?php foreach ($data['brands'] as $brand): ?>
                            <option value="<?php echo $brand['id']; ?>" <?php echo ($brand['id'] == $product['brand_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($brand['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Danh mục <span style="color: var(--danger-color);">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($data['categories'] as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"
                                <?php echo (isset($data['product']) && $data['product']['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea name="description" rows="5" class="form-control"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            
            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border-color);">
                <h5 style="margin-bottom: 16px; font-weight: 600; color: var(--text-main);">Thông số kỹ thuật</h5>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                    <div class="form-group"><label class="form-label">Kích thước màn hình</label><input type="text" name="screen_size" value="<?php echo htmlspecialchars($product['screen_size']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Công nghệ màn hình</label><input type="text" name="screen_tech" value="<?php echo htmlspecialchars($product['screen_tech']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Hệ điều hành</label><input type="text" name="os" value="<?php echo htmlspecialchars($product['os']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Camera sau</label><input type="text" name="camera_rear" value="<?php echo htmlspecialchars($product['camera_rear']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Camera trước</label><input type="text" name="camera_front" value="<?php echo htmlspecialchars($product['camera_front']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">CPU</label><input type="text" name="cpu" value="<?php echo htmlspecialchars($product['cpu']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Chip</label><input type="text" name="chip" value="<?php echo htmlspecialchars($product['chip']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">RAM</label><input type="text" name="ram" value="<?php echo htmlspecialchars($product['ram']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Loại RAM</label><input type="text" name="ram_tech" value="<?php echo htmlspecialchars($product['ram_tech']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Pin</label><input type="text" name="battery" value="<?php echo htmlspecialchars($product['battery']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Sạc</label><input type="text" name="battery_tech" value="<?php echo htmlspecialchars($product['battery_tech']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Kết nối</label><input type="text" name="connectivity" value="<?php echo htmlspecialchars($product['connectivity']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Trọng lượng</label><input type="text" name="weight" value="<?php echo htmlspecialchars($product['weight']); ?>" class="form-control"></div>
                    <div class="form-group"><label class="form-label">Kích thước</label><input type="text" name="dimensions" value="<?php echo htmlspecialchars($product['dimensions']); ?>" class="form-control"></div>
                </div>
            </div>
        </div>
        <div style="padding: 24px; border-top: 1px solid var(--border-color); background-color: var(--bg-color); border-radius: 0 0 var(--radius-lg) var(--radius-lg);">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Lưu thay đổi Thông tin chung
            </button>
        </div>
    </form>
</div>

<!-- Step 2: Variant Management -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Bước 2: Quản lý các Biến thể (Dung lượng, Màu sắc, Giá)</h4>
    </div>
    
    <div style="padding: 24px;">
        <h5 style="margin-bottom: 16px; font-weight: 600; color: var(--text-main);">Các biến thể hiện có:</h5>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px;">Ảnh</th>
                        <th>Tên Biến thể</th>
                        <th>Màu</th>
                        <th>Dung lượng</th>
                        <th>Giá</th>
                        <th>Giá Sale</th>
                        <th>Tồn kho</th>
                        <th class="text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['variants'])) : ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 24px; color: var(--text-light);">Chưa có biến thể nào.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['variants'] as $variant) : ?>
                            <tr>
                                <td>
                                    <?php 
                                    $imgSrc = URLROOT . '/uploads/' . htmlspecialchars($variant['image']);
                                    $uploadPath = APPROOT . '/../public/uploads/' . $variant['image'];
                                    
                                    if (empty($variant['image']) || !file_exists($uploadPath)) {
                                        $imgSrc = URLROOT . '/uploads/default-variant.png';
                                    }
                                    ?>
                                    <img src="<?php echo $imgSrc; ?>" alt="" style="width: 48px; height: 48px; object-fit: cover; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: var(--text-main);"><?php echo htmlspecialchars($variant['name']); ?></div>
                                </td>
                                <td><?php echo htmlspecialchars($variant['color']); ?></td>
                                <td><?php echo htmlspecialchars($variant['storage']); ?></td>
                                <td style="font-weight: 600;"><?php echo number_format($variant['price']); ?></td>
                                <td style="color: var(--danger-color);"><?php echo number_format($variant['price_sale']); ?></td>
                                <td>
                                    <span class="badge <?php echo $variant['stock_quantity'] > 0 ? 'badge-success' : 'badge-danger'; ?>">
                                        <?php echo $variant['stock_quantity']; ?>
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div style="display: inline-flex; gap: 8px;">
                                        <a href="<?php echo URLROOT; ?>/admin/editVariant/<?php echo $variant['id']; ?>" class="btn-icon" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo URLROOT; ?>/admin/deleteVariant/<?php echo $variant['id']; ?>"
                                            class="btn-icon"
                                            title="Xóa"
                                            style="color: var(--danger-color); border-color: var(--danger-color);"
                                            onclick="return confirm('Bạn có chắc muốn xóa biến thể này?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--border-color);">
            <h5 style="margin-bottom: 16px; font-weight: 600; color: var(--text-main);">Thêm biến thể mới:</h5>
            <form action="<?php echo URLROOT; ?>/admin/addVariant/<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                    <div class="form-group">
                        <label class="form-label">Tên Biến thể <span style="color: var(--danger-color);">*</span></label>
                        <input type="text" name="name" required placeholder="Ví dụ: 256GB - Xám Titan" class="form-control">
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
                        <label class="form-label">Màu sắc <span style="color: var(--danger-color);">*</span></label>
                        <select name="color" required class="form-control">
                            <option value="">-- Chọn màu --</option>
                            <?php foreach ($colors as $color_value) : ?>
                                <option value="<?php echo htmlspecialchars($color_value['value']); ?>">
                                    <?php echo htmlspecialchars($color_value['value']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dung lượng <span style="color: var(--danger-color);">*</span></label>
                        <select name="storage" required class="form-control">
                            <option value="">-- Chọn dung lượng --</option>
                            <?php foreach ($storages as $storage_value) : ?>
                                <option value="<?php echo htmlspecialchars($storage_value['value']); ?>">
                                    <?php echo htmlspecialchars($storage_value['value']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Giá bán <span style="color: var(--danger-color);">*</span></label>
                        <input type="number" name="price" required placeholder="30000000" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Giá Sale (Để 0 nếu không sale)</label>
                        <input type="number" name="price_sale" value="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Số lượng tồn kho <span style="color: var(--danger-color);">*</span></label>
                        <input type="number" name="stock_quantity" value="0" required class="form-control">
                    </div>
                    <div class="form-group" style="grid-column: span 3;">
                        <label class="form-label">Ảnh cho Biến thể này <span style="color: var(--danger-color);">*</span></label>
                        <input type="file" name="image" accept="image/*" required class="form-control" style="padding: 6px;">
                    </div>
                </div>
                <div style="margin-top: 24px;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Thêm Biến thể mới
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
