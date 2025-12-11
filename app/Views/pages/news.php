<div class="container news-page-container">
    <div class="news-page-header">
        <h1 class="page-title"><?php echo $data['title']; ?></h1>
        <p class="page-subtitle">Cập nhật tin tức công nghệ, đánh giá sản phẩm và mẹo hay mới nhất</p>
    </div>

    <div class="news-page-layout">

        <main class="main-content-area">
            <h3 class="section-title">Tất cả tin tức</h3>

            <div class="grid-2-cols">
                <?php if (empty($data['posts'])) : ?>
                    <p style="text-align: center; grid-column: 1 / -1; color: #6b7280;">Chưa có bài viết tin tức nào.</p>
                <?php else : ?>
                    <?php foreach ($data['posts'] as $post) : ?>

                        <article class="post-card">
                            <a href="<?php echo URLROOT; ?>/page/post/<?php echo $post['slug']; ?>" class="post-card-img-link">
                                <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($post['image']); ?>"
                                    alt="<?php echo htmlspecialchars($post['title']); ?>"
                                    class="post-card-image">
                            </a>
                            <div class="post-card-content">
                                <span class="post-badge"><?php echo htmlspecialchars($post['category_name'] ?? 'Tin tức'); ?></span>
                                <h3 class="post-title">
                                    <a href="<?php echo URLROOT; ?>/page/post/<?php echo $post['slug']; ?>">
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <span class="author"><i class="far fa-user"></i> <?php echo htmlspecialchars($post['author_name']); ?></span>
                                    <span class="date"><i class="far fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                                </div>
                                <p class="post-excerpt"><?php echo substr(strip_tags($post['content']), 0, 100) . '...'; ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination (Giữ nguyên hoặc ẩn nếu chưa cần) -->
            <div class="pagination" style="display:none"> <!-- Tạm ẩn pagination -->
                <span class="current">1</span>
                <a href="#">2</a>
                <a href="#">&raquo;</a>
            </div>
        </main>

        <aside class="sidebar-area">

            <!-- Categories Widget -->
            <div class="widget widget-categories">
                <h4 class="widget-title">Danh mục</h4>
                <ul class="cat-list">
                    <li><a href="<?php echo URLROOT; ?>/page/news">Tất cả <i class="fas fa-chevron-right"></i></a></li>
                    <?php foreach ($data['categories'] as $cat) : ?>
                        <li>
                            <a href="#"><?php echo htmlspecialchars($cat['name']); ?></a>
                            <span class="count"><?php echo $cat['post_count']; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Newsletter Widget -->
            <div class="widget widget-newsletter">
                <h4 class="widget-title">Đăng ký nhận tin</h4>
                <p>Nhận thông báo về tin tức và khuyến mãi mới nhất.</p>
                <form action="#" method="POST" class="sidebar-newsletter-form">
                    <input type="email" placeholder="Nhập email của bạn..." required>
                    <button type="submit">ĐĂNG KÝ</button>
                </form>
            </div>

            <!-- Popular Posts Widget -->
            <div class="widget widget-popular-posts">
                <h4 class="widget-title">Bài viết phổ biến</h4>
                <div class="popular-posts-list">
                    <?php if (empty($data['popular_posts'])) : ?>
                        <p>Chưa có bài viết nào.</p>
                    <?php else : ?>
                        <?php foreach ($data['popular_posts'] as $p_post) : ?>
                            <div class="popular-post-item">
                                <a href="<?php echo URLROOT; ?>/page/post/<?php echo $p_post['slug']; ?>" class="popular-post-img-link">
                                    <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($p_post['image']); ?>" alt="" class="popular-post-img">
                                </a>
                                <div class="popular-post-info">
                                    <a href="<?php echo URLROOT; ?>/page/post/<?php echo $p_post['slug']; ?>" class="popular-post-title">
                                        <?php echo htmlspecialchars($p_post['title']); ?>
                                    </a>
                                    <span class="popular-post-date"><?php echo date('d/m/Y', strtotime($p_post['created_at'])); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </aside>

    </div>
</div>

<style>
    /* VARIABLES */
    :root {
        --primary-color: #2563eb;
        --text-dark: #1f2937;
        --text-gray: #6b7280;
        --bg-light: #f3f4f6;
    }

    .news-page-container {
        padding: 40px 0;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* HEADER */
    .news-page-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .page-title {
        font-size: 2.5rem;
        color: var(--text-dark);
        margin-bottom: 10px;
        font-weight: 800;
    }

    .page-subtitle {
        color: var(--text-gray);
        font-size: 1.1rem;
    }

    /* LAYOUT Grid */
    .news-page-layout {
        display: grid;
        grid-template-columns: 2.5fr 1fr;
        gap: 40px;
    }

    @media (max-width: 992px) {
        .news-page-layout {
            grid-template-columns: 1fr;
        }
    }

    /* MAIN CONTENT */
    .section-title {
        font-size: 1.5rem;
        margin-bottom: 25px;
        color: var(--text-dark);
        padding-bottom: 10px;
        border-bottom: 2px solid #e5e7eb;
        display: inline-block;
    }

    .grid-2-cols {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }

    /* POST CARD */
    .post-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #f0f0f0;
        display: flex;
        flex-direction: column;
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .post-card-img-link {
        display: block;
        overflow: hidden;
        height: 200px;
    }

    .post-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .post-card:hover .post-card-image {
        transform: scale(1.05);
    }

    .post-card-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .post-badge {
        display: inline-block;
        background-color: #dbeafe;
        color: var(--primary-color);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 99px;
        margin-bottom: 12px;
        width: fit-content;
    }

    .post-title {
        font-size: 1.15rem;
        line-height: 1.5;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .post-title a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.2s;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-title a:hover {
        color: var(--primary-color);
    }

    .post-meta {
        font-size: 0.85rem;
        color: #9ca3af;
        margin-bottom: 12px;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .post-meta i {
        margin-right: 4px;
    }

    .post-excerpt {
        color: var(--text-gray);
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* SIDEBAR */
    .widget {
        background: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 30px;
        border: 1px solid #f0f0f0;
    }

    .widget-title {
        font-size: 1.2rem;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f3f4f6;
        color: var(--text-dark);
    }

    /* Categories Widget */
    .cat-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .cat-list li {
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 12px;
        border-bottom: 1px dashed #e5e7eb;
    }

    .cat-list li:last-child {
        border-bottom: none;
    }

    .cat-list a {
        color: var(--text-gray);
        text-decoration: none;
        transition: color 0.2s;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .cat-list a:hover {
        color: var(--primary-color);
    }

    .cat-list .count {
        background: #f3f4f6;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        color: var(--text-gray);
    }

    /* Newsletter Widget */
    .newsletter-form input {
        width: 100%;
        height: 50px;
        /* Chiều cao cố định */
        padding: 0 15px;
        /* Padding ngang */
        border: 2px solid #e5e7eb;
        /* Viền dày hơn chút */
        border-radius: 8px;
        /* Bo tròn hơn */
        margin-bottom: 12px;
        font-size: 1rem;
        box-sizing: border-box;
        /* Đảm bảo padding không làm vỡ layout */
        transition: border-color 0.2s;
    }

    .newsletter-form input:focus {
        border-color: var(--text-dark);
        outline: none;
    }

    .newsletter-form button {
        width: 100%;
        padding: 15px;
        /* Tăng padding */
        background: var(--text-dark);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 700;
        /* Đậm hơn */
        transition: background 0.2s;
        text-transform: uppercase;
        /* Chữ hoa cho nút */
        letter-spacing: 0.5px;
    }

    .newsletter-form button:hover {
        background: black;
    }

    /* Popular Posts Widget */
    .popular-post-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .popular-post-img-link {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
    }

    .popular-post-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .popular-post-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .popular-post-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        text-decoration: none;
        line-height: 1.4;
        margin-bottom: 5px;
        transition: color 0.2s;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .popular-post-title:hover {
        color: var(--primary-color);
    }

    .popular-post-date {
        font-size: 0.8rem;
        color: #9ca3af;
    }

    .sidebar-newsletter-form {
        display: block;
        /* Đảm bảo xếp chồng dọc */
    }

    .sidebar-newsletter-form input[type="email"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        margin-bottom: 12px;
        font-size: 0.95rem;
        box-sizing: border-box;
        /* Quan trọng để không bị vỡ khung */
        background: #f9fafb;
        color: #333;
    }

    .sidebar-newsletter-form input[type="email"]:focus {
        border-color: var(--primary-color);
        background: #fff;
        outline: none;
    }

    .sidebar-newsletter-form button {
        width: 100%;
        padding: 12px;
        background: var(--text-dark);
        /* Màu đen như thiết kế */
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.9rem;
        transition: background 0.2s;
        text-transform: uppercase;
    }

    .sidebar-newsletter-form button:hover {
        background: black;
    }
</style>
