<div class="news-page-header">
    <h1><?php echo $data['title']; ?></h1>
    <p>Cập nhật những tin tức mới nhất về công nghệ, smartphone, đánh giá sản phẩm và mẹo hay</p>
</div>

<div class="news-page-layout">

    <main class="main-content-area">
        <h3>Tất cả tin tức</h3>

        <div class="grid-2-cols">
            <?php if (empty($data['posts'])) : ?>
                <p style="text-align: center; grid-column: 1 / -1;">Chưa có bài viết tin tức nào.</p>
            <?php else : ?>
                <?php foreach ($data['posts'] as $post) : ?>

                    <div class="post-card">
                        <a href="<?php echo URLROOT; ?>/page/post/<?php echo $post['slug']; ?>">
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($post['image']); ?>"
                                alt="<?php echo htmlspecialchars($post['title']); ?>"
                                class="post-card-image">
                        </a>
                        <div class="post-card-content">
                            <span class="post-category">Tin công nghệ</span>
                            <h3>
                                <a href="<?php echo URLROOT; ?>/page/post/<?php echo $post['slug']; ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h3>
                            <div class="post-meta">
                                <span><?php echo htmlspecialchars($post['author_name']); ?></span> -
                                <span><?php echo date('d-m-Y', strtotime($post['created_at'])); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <span class="current">1</span>
            <a href="#">2</a>
            <a href="#">&raquo;</a>
        </div>
    </main>

    <aside class="sidebar-area">

        <div class="widget widget-categories">
            <h4 class="widget-title">Danh mục</h4>
            <ul>
                <li><a href="<?php echo URLROOT; ?>/page/news">Tất cả</a></li>

                <?php foreach ($data['categories'] as $cat) : ?>
                    <li>
                        <a href="#"><?php echo htmlspecialchars($cat['name']); ?></a>
                        <span>(<?php echo $cat['post_count']; ?>)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="widget widget-newsletter">
            <h4 class="widget-title">Đăng ký nhận tin</h4>
            <p>Nhận thông báo về tin tức và khuyến mãi mới nhất.</p>
            <form action="#" method="POST">
                <input type="email" placeholder="Email của bạn...">
                <button type="submit">Đăng ký</button>
            </form>
        </div>

        <div class="widget widget-popular-posts">
            <h4 class="widget-title">Bài viết phổ biến</h4>

            <?php if (empty($data['popular_posts'])) : ?>
                <p>Chưa có bài viết nào.</p>
            <?php else : ?>
                <?php foreach ($data['popular_posts'] as $p_post) : ?>
                    <div class="popular-post-item">
                        <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($p_post['image']); ?>" alt="" class="popular-post-img">
                        <div>
                            <a href="<?php echo URLROOT; ?>/page/post/<?php echo $p_post['slug']; ?>" class="popular-post-title">
                                <?php echo htmlspecialchars($p_post['title']); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </aside>

</div>
