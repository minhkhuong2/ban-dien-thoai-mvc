<?php $post = $data['post']; // Lấy dữ liệu bài viết cho gọn 
?>

<div class="post-detail-container">
    <div class="post-detail-header">
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="post-meta">
            <strong>Tác giả:</strong> <?php echo htmlspecialchars($post['author_name']); ?> |
            <strong>Ngày đăng:</strong> <?php echo date('d-m-Y H:i', strtotime($post['created_at'])); ?>
        </div>
    </div>

    <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($post['image']); ?>"
        alt="<?php echo htmlspecialchars($post['title']); ?>"
        class="post-detail-image">

    <div class="post-detail-content">
        <?php echo $post['content']; ?>
    </div>
</div>
