<div class="new-hero-banner">
    <div class="new-hero-content">
        <h1>Siêu Phẩm Công Nghệ<br>Giá Tốt Nhất Hôm Nay</h1>
        <p>Sở hữu ngay những chiếc điện thoại flagship mới nhất với ưu đãi độc quyền và quà tặng hấp dẫn.</p>
        <div class="new-hero-buttons">
            <a href="<?php echo URLROOT; ?>/product/all" class="btn btn-yellow">MUA NGAY</a>
            <a href="<?php echo URLROOT; ?>/product/all" class="btn btn-outline">XEM CHI TIẾT</a>
        </div>
    </div>
    <div class="new-hero-image" style="display:none;">
        <img src="<?php echo URLROOT; ?>/images/hero-phones-banner.jpg" alt="Banner">
    </div>
</div>

<div class="container">
    <h2 class="section-title" style="margin-top: 50px;">Sản Phẩm Nổi Bật</h2>
    <p style="text-align: center; color: #666; margin-bottom: 30px;">Khám phá những flagship đẳng cấp nhất hiện nay</p>

    <div class="product-grid">
        <?php if (empty($data['products'])) : ?>
            <p style="text-align: center; width: 100%;">Đang cập nhật sản phẩm...</p>
        <?php else : ?>
            <?php foreach ($data['products'] as $product) : ?>
                <div class="product-card">

                    <?php if ($product['max_sale'] > 0 && $product['max_sale'] < $product['min_price']):
                        $percent = round((($product['min_price'] - $product['max_sale']) / $product['min_price']) * 100);
                    ?>
                        <span class="badge-top-left">-<?php echo $percent; ?>%</span>
                    <?php endif; ?>
                    <span class="badge-top-right">Mới nhất</span>

                    <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>">
                        <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($product['image']); ?>" class="pc-img">
                    </a>

                    <div class="pc-info">
                        <div class="pc-name">
                            <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>">
                                <?php echo htmlspecialchars($product['product_name']); ?>
                            </a>
                        </div>
                        <div style="font-size: 13px; color: #ff9f00; margin-bottom: 5px;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="pc-price">
                            Từ <?php echo number_format($product['min_price']); ?> ₫
                        </div>
                    </div>

                    <div class="pc-btns">
                        <form action="<?php echo URLROOT; ?>/cart/add/<?php echo $product['default_variant_id']; ?>"
                            method="POST"
                            class="add-to-cart-form"
                            onsubmit="return handleAddToCart(event, this);" style="flex: 1;">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="pc-btn pc-btn-cart" style="width: 100%; cursor: pointer;">
                                Giỏ hàng
                            </button>
                        </form>

                        <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>" class="pc-btn pc-btn-view">
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
</div>

<div class="new-brands-section" style="margin-top: 60px;">
    <h3 style="margin-bottom: 20px;">Thương Hiệu Đồng Hành</h3>
    <div class="new-brands-grid">
        <div class="new-brand-item"><img src="<?php echo URLROOT; ?>/images/brands/apple.png" alt="Apple"></div>
        <div class="new-brand-item"><img src="<?php echo URLROOT; ?>/images/brands/samsung.png" alt="Samsung"></div>
        <div class="new-brand-item"><img src="<?php echo URLROOT; ?>/images/brands/xiaomi.png" alt="Xiaomi"></div>
        <div class="new-brand-item"><img src="<?php echo URLROOT; ?>/images/brands/oppo.png" alt="Oppo"></div>
        <div class="new-brand-item"><img src="<?php echo URLROOT; ?>/images/brands/vivo.png" alt="Vivo"></div>
        <div class="new-brand-item"><img src="<?php echo URLROOT; ?>/images/brands/realme.png" alt="Realme"></div>
    </div>
</div>
