<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2><?php echo $data['title']; ?></h2>
    <a href="<?php echo URLROOT; ?>/admin/addProduct" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm Sản Phẩm Mới
    </a>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 50px;">ID</th>
            <th>Tên sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Thông số chính</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['products'] as $product) : ?>
            <tr>
                <td>#<?php echo $product['id']; ?></td>
                <td>
                    <strong><?php echo htmlspecialchars($product['name']); ?></strong>
                </td>
                <td><?php echo htmlspecialchars($product['brand_name']); ?></td>
                <td>
                    <small>
                        Chip: <?php echo htmlspecialchars($product['cpu']); ?><br>
                        Ram: <?php echo htmlspecialchars($product['ram']); ?><br>
                        Pin: <?php echo htmlspecialchars($product['battery']); ?>
                    </small>
                </td>
                <td class="action-links">
                    <a href="<?php echo URLROOT; ?>/admin/editProduct/<?php echo $product['id']; ?>">
                        <i class="fas fa-edit"></i> Sửa & Biến thể
                    </a>
                    <a href="<?php echo URLROOT; ?>/admin/deleteProduct/<?php echo $product['id']; ?>"
                        class="delete"
                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này? Toàn bộ biến thể cũng sẽ bị xóa!');">
                        <i class="fas fa-trash"></i> Xóa
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
