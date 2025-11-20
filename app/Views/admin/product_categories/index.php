<h2><?php echo $data['title']; ?></h2>

<div class="attribute-box">
    <h4>Thêm Danh mục mới</h4>
    <form action="<?php echo URLROOT; ?>/admin/addProductCategory" method="POST" class="value-form">
        <input type="text" name="name" placeholder="Tên danh mục (ví dụ: Gaming Phone)" required>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>

<div class="attribute-box">
    <h4>Các danh mục hiện có</h4>
    <table>
        <tbody>
            <?php foreach ($data['categories'] as $category) : ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($category['name']); ?></strong></td>
                    <td class="action-links" style="text-align: right;">
                        <a href="<?php echo URLROOT; ?>/admin/deleteProductCategory/<?php echo $category['id']; ?>"
                            class="delete"
                            onclick="return confirm('Bạn có chắc muốn xóa?');">
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
