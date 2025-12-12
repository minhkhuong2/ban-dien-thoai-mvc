<!-- HERO SLIDER SECTION WITH OVERLAY -->
<div class="hero-wrapper" style="position: relative; height: 500px; margin-bottom: 30px; overflow: hidden; border-radius: 8px;">
    
    <!-- 1. SLIDER BACKGROUND -->
    <div class="hero-slider" id="homeHeroSlider" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
        <div class="slider-wrapper">
            <!-- Slide 1: iPhone -->
            <div class="hero-slide"><img src="<?php echo URLROOT; ?>/uploads/banner-iphone.png" alt="iPhone 15 Pro Titanium"></div>
            <!-- Slide 2: Samsung -->
            <div class="hero-slide"><img src="<?php echo URLROOT; ?>/uploads/banner-samsung.png" alt="Samsung Galaxy Z Fold 5"></div>
            <!-- Slide 3: Xiaomi -->
            <div class="hero-slide"><img src="<?php echo URLROOT; ?>/uploads/banner-xiaomi.png" alt="Xiaomi 14 Ultra"></div>
            <!-- Slide 4: Sale Popup Banner -->
            <div class="hero-slide"><img src="<?php echo URLROOT; ?>/uploads/popup-sale.png" alt="Super Sale 50%"></div>
            <!-- Slide 5: Original Banner -->
            <div class="hero-slide"><img src="<?php echo URLROOT; ?>/images/hero-phones-banner.jpg" alt="Flagship Phones"></div>
        </div>
    </div>

    <!-- 2. DARK GRADIENT OVERLAY (For Readability) -->
    <div class="hero-gradient" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0) 100%); pointer-events: none;"></div>

    <!-- 3. CONTENT OVERLAY -->
    <div class="hero-overlay-content" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 3; pointer-events: none; display: flex; align-items: center;">
        <div class="container" style="width: 100%; padding-left: 50px;"> <!-- Padding for clean alignment -->
            <div class="new-hero-content" style="max-width: 550px; color: #fff; pointer-events: auto;">
                <h1 style="font-family: 'Segoe UI', sans-serif; font-size: 3.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px; letter-spacing: -1px; text-transform: uppercase;">
                    Siêu Phẩm <br>
                    <span style="color: #ffc107;">Công Nghệ</span>
                </h1>
                <p style="font-size: 1.1rem; margin-bottom: 35px; line-height: 1.6; opacity: 0.95; font-weight: 300; max-width: 480px;">
                    Giá Tốt Nhất Hôm Nay. Sở hữu ngay những chiếc điện thoại flagship mới nhất với ưu đãi độc quyền và quà tặng hấp dẫn.
                </p>
                <div class="new-hero-buttons" style="display: flex; gap: 20px;">
                    <a href="<?php echo URLROOT; ?>/product/all" class="btn btn-yellow" style="background: #ffc107; color: #000; padding: 14px 40px; border-radius: 4px; font-weight: 700; text-decoration: none; border: none; text-transform: uppercase; letter-spacing: 0.5px; transition: 0.3s; box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);">MUA NGAY</a>
                    <a href="<?php echo URLROOT; ?>/product/all" class="btn btn-outline" style="background: rgba(255,255,255,0.1); color: #fff; padding: 14px 40px; border-radius: 4px; font-weight: 700; text-decoration: none; border: 1px solid rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.5px; backdrop-filter: blur(5px);">XEM CHI TIẾT</a>
                </div>
            </div>
        </div>
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

    <div class="view-all-btn-container" style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
        <a href="<?php echo URLROOT; ?>/product/all" class="view-all-btn">Xem thêm sản phẩm <i class="fas fa-arrow-right" style="margin-left: 5px;"></i></a>
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

    // --- SLIDER LOGIC (MỚI) ---
    document.addEventListener("DOMContentLoaded", function() {
        const slider = document.querySelector('.slider-wrapper');
        const slides = document.querySelectorAll('.hero-slide');
        let slideIndex = 0;
        const totalSlides = slides.length;

        if (totalSlides > 0) {
            function autoSlide() {
                slideIndex++;
                if (slideIndex >= totalSlides) {
                    slideIndex = 0;
                }
                const offset = slideIndex * 100;
                slider.style.transform = `translateX(-${offset}%)`;
            }
            // Chuyển slide mỗi 3 giây
            setInterval(autoSlide, 3000);
        }
    });
</script>
