<style>
    .attribute-box {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: var(--shadow);
        margin-bottom: 25px;
    }

    .attribute-box h4 {
        margin-top: 0;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        display: flex;
        /* Thêm flex */
        justify-content: space-between;
        /* Đẩy 2 item ra xa */
        align-items: center;
    }

    .value-tag {
        display: inline-block;
        background: #f0f7ff;
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        padding: 5px 10px;
        border-radius: 5px;
        margin: 5px;
        font-size: 0.9em;
    }

    .value-tag .delete-value {
        color: red;
        text-decoration: none;
        font-weight: bold;
        margin-left: 5px;
    }

    .value-form {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #ccc;
    }

    .value-form input {
        flex-grow: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

<h2><?php echo $data['title']; ?></h2>

<div class="attribute-box">
    <h4>Thêm Thuộc tính mới</h4>
    <form action="<?php echo URLROOT; ?>/admin/addAttribute" method="POST" class="value-form">
        <input type="text" name="name" placeholder="Tên thuộc tính mới (ví dụ: RAM)" required>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>

<?php foreach ($data['attributes'] as $attribute) : ?>
    <div class="attribute-box">
        <h4>
            <span><?php echo htmlspecialchars($attribute['name']); ?></span>

            <a href="<?php echo URLROOT; ?>/admin/deleteAttribute/<?php echo $attribute['id']; ?>"
                class="delete" style="font-size: 0.7em; font-weight: 400;"
                onclick="return confirm('Bạn có chắc muốn XÓA TOÀN BỘ thuộc tính (<?php echo htmlspecialchars($attribute['name']); ?>) và tất cả giá trị của nó?');">
                (Xóa thuộc tính này)
            </a>
        </h4>

        <div>
            <?php if (empty($attribute['values'])) : ?>
                <p>Chưa có giá trị nào.</p>
            <?php else : ?>
                <?php foreach ($attribute['values'] as $value) : ?>
                    <span class="value-tag">
                        <?php echo htmlspecialchars($value['value']); ?>

                        <a href="<?php echo URLROOT; ?>/admin/deleteAttributeValue/<?php echo $value['id']; ?>"
                            class="delete-value"
                            title="Xóa giá trị này"
                            onclick="return confirm('Bạn có chắc muốn xóa giá trị (<?php echo htmlspecialchars($value['value']); ?>)?');">
                            [x]
                        </a>
                    </span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <form action="<?php echo URLROOT; ?>/admin/addAttributeValue" method="POST" class="value-form">
            <input type="hidden" name="attribute_id" value="<?php echo $attribute['id']; ?>">
            <input type="text" name="value" placeholder="Thêm giá trị mới (ví dụ: 1TB)" required>
            <button type="submit" class="btn btn-primary" style="margin-bottom: 0;">+ Thêm giá trị</button>
        </form>
    </div>
<?php endforeach; ?>
