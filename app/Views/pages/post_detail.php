<?php $post = $data['post']; ?>

<div class="container" style="margin-top: 30px; margin-bottom: 60px;">

    <div class="news-detail-layout">

        <article class="news-article">

            <div class="article-header">
                <span class="article-category"><?php echo htmlspecialchars($post['category_name'] ?? 'Tin tức'); ?></span>
                <h1 class="article-title"><?php echo htmlspecialchars($post['title']); ?></h1>

                <div class="article-meta">
                    <div class="author-info">
                        <div class="author-avatar">
                            <?php echo strtoupper(substr($post['author_name'], 0, 1)); ?>
                        </div>
                        <div>
                            <span class="author-name"><?php echo htmlspecialchars($post['author_name']); ?></span>
                            <span class="post-date"><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                        </div>
                    </div>
                    <div class="post-views">
                        <i class="far fa-eye"></i> <?php echo $post['views']; ?> lượt xem
                    </div>
                </div>
            </div>

            <div class="article-featured-image">
                <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
            </div>

            <div class="article-content">
                <?php echo $post['content']; ?>
            </div>

            <div class="article-footer">
                <a href="<?php echo URLROOT; ?>/page/news" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Quay lại tin tức
                </a>
            </div>

        </article>

        <aside class="news-sidebar">
            <div class="sidebar-widget">
                <h3>Tin mới nhất</h3>
                <p style="color: #777; font-style: italic;">Đang cập nhật thêm tin tức...</p>
            </div>

            <div class="sidebar-widget banner-widget">
                <img src="<?php echo URLROOT; ?>/images/hero-phones-banner.jpg" alt="Quảng cáo">
                <div class="banner-text">
                    <h4>Siêu Sale tháng 11</h4>
                    <a href="<?php echo URLROOT; ?>/product/all">Mua ngay</a>
                </div>
            </div>
        </aside>

    </div>
</div>

<style>
    .news-detail-layout {
        display: grid;
        grid-template-columns: 2.5fr 1fr;
        gap: 40px;
    }

    /* Article Style */
    .news-article {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .article-category {
        color: #288ad6;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .article-title {
        font-size: 2.2rem;
        color: #333;
        margin: 10px 0 20px 0;
        line-height: 1.3;
    }

    .article-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .author-avatar {
        width: 40px;
        height: 40px;
        background: #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #555;
    }

    .author-name {
        font-weight: bold;
        display: block;
        color: #333;
    }

    .post-date {
        font-size: 0.85rem;
        color: #999;
    }

    .post-views {
        color: #777;
        font-size: 0.9rem;
    }

    .article-featured-image img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .article-content p {
        margin-bottom: 20px;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin: 20px 0;
    }

    .article-content h2,
    .article-content h3 {
        color: #000;
        margin-top: 30px;
    }

    .article-footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .btn-back {
        text-decoration: none;
        color: #555;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: #288ad6;
    }

    /* Sidebar */
    .sidebar-widget {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .sidebar-widget h3 {
        margin-top: 0;
        font-size: 1.2rem;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .banner-widget {
        position: relative;
        padding: 0;
        overflow: hidden;
    }

    .banner-widget img {
        width: 100%;
        display: block;
    }

    .banner-text {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 15px;
        box-sizing: border-box;
    }

    .banner-text a {
        color: #ff9f00;
        text-decoration: underline;
    }

    @media (max-width: 992px) {
        .news-detail-layout {
            grid-template-columns: 1fr;
        }

        .news-article {
            padding: 20px;
        }

        .article-title {
            font-size: 1.8rem;
        }
    }
</style>
