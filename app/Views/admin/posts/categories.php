<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px; align-items: start;">

    <!-- Add Form -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thêm Danh mục mới</h4>
        </div>
        <form action="<?php echo URLROOT; ?>/admin/addPostCategory" method="POST">
            <div class="form-group">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="name" required placeholder="Ví dụ: Tin quốc tế" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fas fa-plus"></i> Thêm ngay
            </button>
        </form>
    </div>

    <!-- List -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Các danh mục hiện có</h4>
        </div>
        <div class="table-container">
            <table>
                <tbody>
                    <?php if (empty($data['categories'])): ?>
                        <tr>
                            <td colspan="2" style="text-align: center; padding: 24px; color: var(--text-light);">Chưa có danh mục nào.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['categories'] as $category) : ?>
                            <tr>
                                <td>
                                    <div style="font-weight: 600; color: var(--text-main);"><?php echo htmlspecialchars($category['name']); ?></div>
                                </td>
                                <td class="text-right">
                                    <a href="<?php echo URLROOT; ?>/admin/deletePostCategory/<?php echo $category['id']; ?>"
                                        class="btn-icon"
                                        title="Xóa"
                                        style="color: var(--danger-color); border-color: var(--danger-color);"
                                        onclick="return confirm('Bạn có chắc muốn xóa? Các bài viết thuộc danh mục này sẽ bị mất danh mục.');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
