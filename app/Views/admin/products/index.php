<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $data['title']; ?></h3>
        <a href="<?php echo URLROOT; ?>/admin/addProduct" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm Sản Phẩm Mới
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Thương hiệu</th>
                    <th>Thông số chính</th>
                    <th class="text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['products'] as $product) : ?>
                    <tr>
                        <td>#<?php echo $product['id']; ?></td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-main);"><?php echo htmlspecialchars($product['name']); ?></div>
                        </td>
                        <td>
                            <span class="badge badge-info"><?php echo htmlspecialchars($product['brand_name']); ?></span>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem; color: var(--text-light); line-height: 1.6;">
                                <div><i class="fas fa-microchip" style="width: 16px;"></i> <?php echo htmlspecialchars($product['cpu']); ?></div>
                                <div><i class="fas fa-memory" style="width: 16px;"></i> <?php echo htmlspecialchars($product['ram']); ?></div>
                                <div><i class="fas fa-battery-full" style="width: 16px;"></i> <?php echo htmlspecialchars($product['battery']); ?></div>
                            </div>
                        </td>
                        <td class="text-right">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="<?php echo URLROOT; ?>/admin/editProduct/<?php echo $product['id']; ?>" class="btn-icon" title="Sửa & Biến thể">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo URLROOT; ?>/admin/gallery/<?php echo $product['id']; ?>" class="btn-icon" title="Ảnh phụ" style="color: var(--success-color); border-color: var(--success-color);">
                                    <i class="fas fa-images"></i>
                                </a>
                                <a href="<?php echo URLROOT; ?>/admin/deleteProduct/<?php echo $product['id']; ?>"
                                    class="btn-icon"
                                    title="Xóa"
                                    style="color: var(--danger-color); border-color: var(--danger-color);"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này? Toàn bộ biến thể cũng sẽ bị xóa!');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
