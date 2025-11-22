<h2><?php echo $data['title']; ?></h2>

<style>
    .attribute-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .value-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .value-tag {
        background: #f0f7ff;
        border: 1px solid #cce5ff;
        color: #004085;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9em;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .value-tag a {
        color: #ff6b6b;
        text-decoration: none;
        font-weight: bold;
        margin-left: 5px;
    }

    .value-form {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
</style>

<div class="attribute-box">
    <h4>Thêm Nhóm Thuộc Tính Mới (Ví dụ: Màn hình, Chip...)</h4>
    <form action="<?php echo URLROOT; ?>/admin/addAttribute" method="POST" class="value-form">
        <input type="text" name="name" placeholder="Tên thuộc tính..." required style="flex: 1; padding: 8px;">
        <button type="submit" class="btn btn-primary" style="margin: 0;">Thêm Nhóm</button>
    </form>
</div>

<?php foreach ($data['attributes'] as $attr) : ?>
    <div class="attribute-box">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            <h3 style="margin: 0; color: #2d3748;"><?php echo htmlspecialchars($attr['name']); ?></h3>
            <a href="<?php echo URLROOT; ?>/admin/deleteAttribute/<?php echo $attr['id']; ?>"
                onclick="return confirm('Xóa nhóm này sẽ xóa tất cả giá trị bên trong?')"
                style="color: #e53e3e; text-decoration: none; font-size: 0.9em;">
                <i class="fas fa-trash"></i> Xóa nhóm này
            </a>
        </div>

        <div class="value-tags">
            <?php if (empty($attr['values'])) : ?>
                <span style="color: #777; font-style: italic;">Chưa có giá trị nào.</span>
            <?php else : ?>
                <?php foreach ($attr['values'] as $val) : ?>
                    <div class="value-tag">
                        <?php echo htmlspecialchars($val['value']); ?>
                        <a href="<?php echo URLROOT; ?>/admin/deleteAttributeValue/<?php echo $val['id']; ?>" title="Xóa giá trị">×</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <form action="<?php echo URLROOT; ?>/admin/addAttributeValue" method="POST" class="value-form">
            <input type="hidden" name="attribute_id" value="<?php echo $attr['id']; ?>">
            <input type="text" name="value" placeholder="Thêm giá trị mới (VD: Đỏ, 128GB)..." required style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" class="btn btn-secondary" style="margin: 0;">Thêm</button>
        </form>
    </div>
<?php endforeach; ?>
