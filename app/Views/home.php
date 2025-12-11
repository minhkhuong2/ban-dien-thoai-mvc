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

<!-- ADVERTISEMENT POPUP -->
<div id="ad-popup" class="ad-popup-overlay" style="display:none;">
    <div class="ad-popup-content">
        <span class="ad-close-btn" onclick="closeAdPopup()">&times;</span>
        <div class="ad-image-container">
            <img src="<?php echo URLROOT; ?>/uploads/popup-sale.png" alt="Siêu Sale">
        </div>
        <div class="ad-text-content">
            <h3>🔥 SIÊU SALE HÔM NAY 🔥</h3>
            <p>Giảm giá lên đến <strong>50%</strong> cho các dòng điện thoại Samsung Galaxy S24 Series.</p>
            <a href="<?php echo URLROOT; ?>/product/all" class="btn btn-warning" style="width: 100%; display: block; margin-top: 15px; font-weight: bold;">MUA NGAY</a>
        </div>
    </div>
</div>

<script>
    // Hiển thị quảng cáo sau 1 giây
    // Hiển thị quảng cáo ngay khi DOM sẵn sàng (không đợi ảnh load hết)
    document.addEventListener("DOMContentLoaded", function() {
        // Tạm thời bỏ check session để bạn test quảng cáo xuất hiện mỗi lần reload
        // if (!sessionStorage.getItem('adPopupClosed')) {
            setTimeout(function() {
                document.getElementById('ad-popup').style.display = 'flex';
            }, 500); // Giảm thời gian chờ xuống 0.5s hỗ trợ loading nhanh
        // }
    });

    function closeAdPopup() {
        document.getElementById('ad-popup').style.display = 'none';
        sessionStorage.setItem('adPopupClosed', 'true'); // Lưu trạng thái đã đóng phiên này
    }
</script>
