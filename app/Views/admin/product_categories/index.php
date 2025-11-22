<h2><?php echo $data['title']; ?></h2>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">

    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); height: fit-content;">
        <h4>Thêm Danh Mục Mới</h4>
        <form action="<?php echo URLROOT; ?>/admin/addProductCategory" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tên danh mục</label>
                <input type="text" name="name" required placeholder="Ví dụ: Điện thoại Gaming" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Thêm ngay</button>
        </form>
    </div>

    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <table style="margin-top: 0;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th style="text-align: center;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['categories'] as $cat) : ?>
                    <tr>
                        <td>#<?php echo $cat['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($cat['name']); ?></strong></td>
                        <td class="action-links" style="text-align: center;">
                            <a href="<?php echo URLROOT; ?>/admin/deleteProductCategory/<?php echo $cat['id']; ?>"
                                class="delete"
                                onclick="return confirm('Xóa danh mục này? Các sản phẩm thuộc danh mục này sẽ bị mất danh mục.');">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
