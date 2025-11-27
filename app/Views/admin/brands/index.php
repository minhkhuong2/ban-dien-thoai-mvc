<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2><?php echo $data['title']; ?></h2>
    <a href="<?php echo URLROOT; ?>/admin/addBrand" class="btn btn-primary">+ Thêm Thương hiệu</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Tên Thương hiệu</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['brands'] as $brand) : ?>
                <tr>
                    <td><?php echo $brand['id']; ?></td>
                    <td><img src="<?php echo URLROOT; ?>/images/brands/<?php echo $brand['logo']; ?>" style="height: 30px;"></td>
                    <td><strong><?php echo htmlspecialchars($brand['name']); ?></strong></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/admin/editBrand/<?php echo $brand['id']; ?>" style="color: blue;">Sửa</a> |
                        <a href="<?php echo URLROOT; ?>/admin/deleteBrand/<?php echo $brand['id']; ?>" onclick="return confirm('Xóa?')" style="color: red;">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
