<div class="new-hero-banner">
    <div class="new-hero-content">
        <h1>Điện Thoại Chính Hãng<br>Giá Tốt Nhất</h1>
        <p>Khám phá bộ sưu tập điện thoại thông minh mới nhất từ các thương hiệu hàng đầu. Chất lượng đảm bảo, giá cả cạnh tranh, dịch vụ tận tâm.</p>
        <div class="new-hero-buttons">
            <a href="<?php echo URLROOT; ?>/product/all" class="btn btn-yellow">Mua Ngay</a>
            <a href="<?php echo URLROOT; ?>/product/all" class="btn btn-outline">Xem Sản Phẩm</a>
        </div>
    </div>
    <div class="new-hero-image">
        <img src="<?php echo URLROOT; ?>/images/hero-phones-banner.jpg" alt="Điện thoại chính hãng">
    </div>
</div>

<div class="new-brands-section">
    <h2 class="section-title">Thương Hiệu Nổi Bật</h2>
    <p style="color: #555; text-align: center; margin-top: -20px; margin-bottom: 30px;">Khám phá các thương hiệu điện thoại hàng đầu thế giới với đa dạng mẫu mã và tính năng</p>
    <div class="new-brands-grid">
        <div class="new-brand-item">
            <img src="<?php echo URLROOT; ?>/images/brands/apple.png" alt="Apple">
            <span>iPhone</span>
        </div>
        <div class="new-brand-item">
            <img src="<?php echo URLROOT; ?>/images/brands/samsung.png" alt="Samsung">
            <span>Samsung</span>
        </div>
        <div class="new-brand-item">
            <img src="<?php echo URLROOT; ?>/images/brands/xiaomi.png" alt="Xiaomi">
            <span>Xiaomi</span>
        </div>
        <div class="new-brand-item">
            <img src="<?php echo URLROOT; ?>/images/brands/oppo.png" alt="Oppo">
            <span>Oppo</span>
        </div>
        <div class="new-brand-item">
            <img src="<?php echo URLROOT; ?>/images/brands/vivo.png" alt="Vivo">
            <span>Vivo</span>
        </div>
        <div class="new-brand-item">
            <img src="<?php echo URLROOT; ?>/images/brands/realme.png" alt="Realme">
            <span>Realme</span>
        </div>
    </div>
</div>

<h2 class="section-title">Sản Phẩm Nổi Bật</h2>
<p style="color: #555; text-align: center; margin-top: -20px; margin-bottom: 30px;">Những chiếc điện thoại được yêu thích nhất với công nghệ tiên tiến và giá cả hợp lý</p>

<div class="product-grid">
    <?php if (empty($data['products'])) : ?>
        <p style="text-align: center; grid-column: 1 / -1;">Không có sản phẩm nào để hiển thị.</p>
    <?php else : ?>
        <?php foreach ($data['products'] as $product) : ?>
            <div class="product-card">
                <?php
                // Logic này cần tinh chỉnh lại tùy vào logic giá của bạn, ở đây demo đơn giản
                if ($product['max_sale'] > 0 && $product['max_sale'] < $product['min_price']) {
                    echo '<div class="discount-badge">Giảm giá</div>';
                }
                ?>

                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>">
                    <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($product['image']); ?>"
                        alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                        class="product-card-image">
                </a>

                <div class="product-card-content">
                    <h3>
                        <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>">
                            <?php echo htmlspecialchars($product['product_name']); ?>
                        </a>
                    </h3>

                    <div class="product-price">
                        Từ <?php echo number_format($product['min_price']); ?> VNĐ
                    </div>

                    <div class="product-specs">
                        <span><?php echo htmlspecialchars($product['ram']); ?></span> |
                        <span><?php echo htmlspecialchars($product['cpu']); ?></span>
                    </div>

                    <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>" class="btn-add-to-cart">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="view-all-btn-container">
    <a href="<?php echo URLROOT; ?>/product/all" class="view-all-btn">Xem Tất Cả Sản Phẩm</a>
</div>


<div class="newsletter-banner">
    <h3>Đăng Ký Nhận Tin Tức</h3>
    <p>Nhận thông tin về sản phẩm mới, khuyến mãi đặc biệt và các tin tức công nghệ mới nhất</p>
    <form action="#" method="POST" class="newsletter-form">
        <input type="email" name="email" placeholder="Nhập email của bạn...">
        <button type="submit">Đăng ký</button>
    </form>
</div>
