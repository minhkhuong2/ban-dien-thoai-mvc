<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $data['title']; ?></h3>
        <a href="<?php echo URLROOT; ?>/admin/addPost" class="btn btn-primary">
            <i class="fas fa-plus"></i> Viết bài mới
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 100px;">Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Ngày đăng</th>
                    <th class="text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td>
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($post['image']); ?>" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-main);"><?php echo htmlspecialchars($post['title']); ?></div>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 24px; height: 24px; background: var(--primary-light); color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 600;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <?php echo htmlspecialchars($post['author_name']); ?>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem; color: var(--text-light);">
                                <?php echo date('d/m/Y', strtotime($post['created_at'])); ?>
                            </div>
                        </td>
                        <td class="text-right">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="<?php echo URLROOT; ?>/admin/editPost/<?php echo $post['id']; ?>" class="btn-icon" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo URLROOT; ?>/admin/deletePost/<?php echo $post['id']; ?>"
                                    class="btn-icon"
                                    title="Xóa"
                                    style="color: var(--danger-color); border-color: var(--danger-color);"
                                    onclick="return confirm('Bạn có chắc muốn xóa?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
