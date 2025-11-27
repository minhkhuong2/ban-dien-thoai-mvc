<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<style>
    .value-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 16px;
    }

    .value-tag {
        background: var(--bg-color);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .value-tag:hover {
        border-color: var(--primary-color);
        background: white;
        box-shadow: var(--shadow-sm);
    }

    .value-tag a {
        color: var(--text-light);
        text-decoration: none;
        font-weight: bold;
        font-size: 1rem;
        line-height: 1;
        transition: color 0.2s;
        margin-left: 5px;
    }

    .value-tag a:hover {
        color: var(--danger-color);
    }

    .value-form {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        align-items: center;
    }

    .color-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 1px solid #ddd;
        display: inline-block;
    }
</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Thêm Nhóm Thuộc Tính Mới</h4>
    </div>
    <div style="padding: 24px;">
        <form action="<?php echo URLROOT; ?>/admin/addAttribute" method="POST" style="display: flex; gap: 12px;">
            <input type="text" name="name" placeholder="Ví dụ: Màn hình, Chip, RAM..." required class="form-control" style="max-width: 400px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm Nhóm
            </button>
        </form>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 24px;">
    <?php foreach ($data['attributes'] as $attr) : ?>
        <div class="card" style="margin-bottom: 0; display: flex; flex-direction: column;">

            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="card-title" style="font-size: 1.1rem; margin: 0;"><?php echo htmlspecialchars($attr['name']); ?></h3>
                <a href="<?php echo URLROOT; ?>/admin/deleteAttribute/<?php echo $attr['id']; ?>"
                    class="btn-icon"
                    title="Xóa nhóm này"
                    style="color: var(--danger-color); border-color: var(--danger-color); width: 32px; height: 32px;"
                    onclick="return confirm('Cảnh báo: Xóa nhóm này sẽ xóa tất cả giá trị bên trong! Tiếp tục?')">
                    <i class="fas fa-trash" style="font-size: 0.8rem;"></i>
                </a>
            </div>

            <div style="padding: 0 24px; flex-grow: 1;">
                <div class="value-tags">
                    <?php if (empty($attr['values'])) : ?>
                        <span style="color: var(--text-light); font-style: italic; font-size: 0.9rem;">Chưa có giá trị nào.</span>
                    <?php else : ?>
                        <?php foreach ($attr['values'] as $val) : ?>
                            <div class="value-tag">
                                <?php if (!empty($val['color_code'])): ?>
                                    <span class="color-dot" style="background-color: <?php echo htmlspecialchars($val['color_code']); ?>;"></span>
                                <?php endif; ?>

                                <?php echo htmlspecialchars($val['value']); ?>

                                <a href="<?php echo URLROOT; ?>/admin/deleteAttributeValue/<?php echo $val['id']; ?>" title="Xóa giá trị">&times;</a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div style="padding: 24px; margin-top: auto;">
                <form action="<?php echo URLROOT; ?>/admin/addAttributeValue" method="POST" class="value-form">
                    <input type="hidden" name="attribute_id" value="<?php echo $attr['id']; ?>">

                    <input type="text" name="value" placeholder="Thêm giá trị mới..." required class="form-control" style="flex: 1;">

                    <?php if (stripos($attr['name'], 'Màu') !== false || stripos($attr['name'], 'Color') !== false): ?>
                        <input type="color" name="color_code" title="Chọn mã màu hiển thị"
                            style="height: 38px; width: 50px; padding: 0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">
                    <?php endif; ?>

                    <button type="submit" class="btn btn-secondary" style="white-space: nowrap;">Thêm</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
