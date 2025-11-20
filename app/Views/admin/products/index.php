<h2><?php echo $data['title']; ?></h2>

<a href="<?php echo URLROOT; ?>/admin/addProduct" class="btn btn-success">
    + Thêm Sản phẩm mới (Bước 1: Thông tin chung)
</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên Sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Mô tả (Ngắn)</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['products'] as $product) : ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                <td><?php echo htmlspecialchars($product['brand_name']); ?></td>
                <td><?php echo htmlspecialchars(substr($product['description'], 0, 50)); ?>...</td>
                <td class="action-links">
                    <a href="<?php echo URLROOT; ?>/admin/editProduct/<?php echo $product['id']; ?>">
                        Sửa (Quản lý Biến thể)
                    </a> |
                    <a href="<?php echo URLROOT; ?>/admin/deleteProduct/<?php echo $product['id']; ?>"
                        class="delete"
                        onclick="return confirm('XÓA SẢN PHẨM GỐC?\nThao tác này sẽ xóa tất cả các biến thể (256GB, 512GB...) của sản phẩm này!');">
                        Xóa Gốc
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
