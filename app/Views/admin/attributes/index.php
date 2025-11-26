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
    }
    
    .value-tag a:hover {
        color: var(--danger-color);
    }

    .value-form {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }
</style>

<!-- Add New Attribute Group -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Thêm Nhóm Thuộc Tính Mới</h4>
    </div>
    <form action="<?php echo URLROOT; ?>/admin/addAttribute" method="POST" class="value-form" style="margin-top: 0;">
        <input type="text" name="name" placeholder="Ví dụ: Màn hình, Chip, RAM..." required class="form-control" style="max-width: 400px;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm Nhóm
        </button>
    </form>
</div>

<!-- Attribute Groups List -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 24px;">
    <?php foreach ($data['attributes'] as $attr) : ?>
        <div class="card" style="margin-bottom: 0; display: flex; flex-direction: column;">
            <div class="card-header" style="margin-bottom: 0; border-bottom: none; padding-bottom: 0;">
                <h3 class="card-title" style="font-size: 1.1rem;"><?php echo htmlspecialchars($attr['name']); ?></h3>
                <a href="<?php echo URLROOT; ?>/admin/deleteAttribute/<?php echo $attr['id']; ?>"
                    class="btn-icon"
                    title="Xóa nhóm này"
                    style="color: var(--danger-color); border-color: var(--danger-color); width: 32px; height: 32px;"
                    onclick="return confirm('Xóa nhóm này sẽ xóa tất cả giá trị bên trong?')">
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
                                <?php echo htmlspecialchars($val['value']); ?>
                                <a href="<?php echo URLROOT; ?>/admin/deleteAttributeValue/<?php echo $val['id']; ?>" title="Xóa giá trị">&times;</a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div style="padding: 24px; margin-top: auto;">
                <form action="<?php echo URLROOT; ?>/admin/addAttributeValue" method="POST" class="value-form" style="margin-top: 0;">
                    <input type="hidden" name="attribute_id" value="<?php echo $attr['id']; ?>">
                    <input type="text" name="value" placeholder="Thêm giá trị mới..." required class="form-control">
                    <button type="submit" class="btn btn-secondary">Thêm</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
