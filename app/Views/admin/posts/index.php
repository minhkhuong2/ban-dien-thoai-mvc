<h2><?php echo $data['title']; ?></h2>
<a href="<?php echo URLROOT; ?>/admin/addPost" class="btn btn-success">+ Viết bài mới</a>
<table>
    <thead>
        <tr>
            <th>Ảnh</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Ngày đăng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['posts'] as $post) : ?>
            <tr>
                <td><img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($post['image']); ?>" alt="" style="width: 80px;"></td>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['author_name']); ?></td>
                <td><?php echo date('d-m-Y', strtotime($post['created_at'])); ?></td>
                <td class="action-links">
                    <a href="<?php echo URLROOT; ?>/admin/editPost/<?php echo $post['id']; ?>">Sửa</a> |
                    <a href="<?php echo URLROOT; ?>/admin/deletePost/<?php echo $post['id']; ?>" class="delete" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
