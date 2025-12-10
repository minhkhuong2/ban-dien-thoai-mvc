<?php
// File: app/Views/product_detail.php

$product = $data['product'];
$variants = $data['variants'];
$gallery = $data['gallery'];
$reviews = $data['reviews'];
$rating_info = $data['rating_info'];
$related_products = $data['related_products'];
$dynamic_colors = $data['dynamic_colors'] ?? []; // [MỚI] Lấy màu động từ Controller

$first_variant = !empty($variants) ? $variants[0] : null;

// Tính toán sao
$avg_rating = $rating_info['avg_rating'] ? round($rating_info['avg_rating'], 1) : 0;
$review_count = $rating_info['review_count'];
$star_percent = ($avg_rating / 5) * 100;

// [LOGIC MỚI] GỘP ẢNH THEO MÀU (FALLBACK)
// 1. Tìm ảnh "xịn" nhất cho từng màu
$color_best_images = [];
foreach ($variants as $v) {
    $c = $v['color'];
    $img = $v['image'];
    // Nếu ảnh không phải default và không rỗng thì ưu tiên
    $is_real_image = !empty($img) && strpos($img, 'default-variant') === false;

    if (!isset($color_best_images[$c])) {
        $color_best_images[$c] = $img;
    }

    $current_best = $color_best_images[$c];
    $current_is_real = !empty($current_best) && strpos($current_best, 'default-variant') === false;

    if ($is_real_image && !$current_is_real) {
        $color_best_images[$c] = $img;
    }
}

// 2. Cập nhật lại ảnh cho toàn bộ biến thể theo màu
foreach ($variants as &$v) {
    if (isset($color_best_images[$v['color']])) {
        $v['image'] = $color_best_images[$v['color']];
    }
}
unset($v);
$data['variants'] = $variants; // Cập nhật lại data gốc nếu cần thiết

// 3. Chuẩn bị ảnh cho Slider
$final_images = [];
$added_src = [];

// Luôn thêm ảnh của biến thể đầu tiên (đang được chọn mặc định)
if (!empty($variants)) {
    $first_v = $variants[0];
    $final_images[] = ['src' => $first_v['image'], 'color' => $first_v['color']];
    $added_src[] = $first_v['image'];
}

// Thêm các ảnh unique khác từ variants
foreach ($variants as $v) {
    if (!in_array($v['image'], $added_src)) {
        $final_images[] = ['src' => $v['image'], 'color' => $v['color']];
        $added_src[] = $v['image'];
    }
}

// Thêm ảnh từ Gallery (nếu có)
if (!empty($gallery)) {
    foreach ($gallery as $g) {
        if (!in_array($g['image'], $added_src)) {
            $final_images[] = ['src' => $g['image'], 'color' => $g['color']];
            $added_src[] = $g['image'];
        }
    }
}

?>

<div class="breadcrumb">
    <a href="<?php echo URLROOT; ?>/">Trang chủ</a> ›
    <a href="<?php echo URLROOT; ?>/product/all">Điện thoại</a> ›
    <a href="<?php echo URLROOT; ?>/product/brand/<?php echo $product['brand_id']; ?>">
        <?php echo htmlspecialchars($product['brand_name']); ?>
    </a> ›
    <span><?php echo htmlspecialchars($product['name']); ?></span>
</div>

<div class="product-detail-container">

    <div class="detail-left">
        <div class="product-gallery">
            <div id="dynamic-discount-badge" class="discount-badge" style="display: none;"></div>

            <div class="main-image-slider">
                <button class="gallery-btn btn-prev" id="gallery-prev"><i class="fas fa-chevron-left"></i></button>

                <div class="main-slider-track" id="main-track">
                    <?php foreach ($final_images as $img) : ?>
                        <div class="slider-single-img" data-color="<?php echo htmlspecialchars($img['color'] ?? ''); ?>">
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($img['src']); ?>"
                                alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="gallery-btn btn-next" id="gallery-next"><i class="fas fa-chevron-right"></i></button>
            </div>

            <div class="thumbnail-wrapper">
                <button class="thumb-btn prev" id="thumb-prev"><i class="fas fa-chevron-left"></i></button>

                <div class="thumb-list" id="thumb-track">
                    <?php foreach ($final_images as $index => $img) : ?>
                        <div class="thumb-item <?php echo ($index == 0) ? 'active' : ''; ?>"
                            onclick="goToSlide(<?php echo $index; ?>)">
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($img['src']); ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="thumb-btn next" id="thumb-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <div class="detail-right">
        <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>

        <div class="rating-area">
            <div class="stars-outer">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                <div class="stars-inner" style="width: <?php echo $star_percent; ?>%;">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
            </div>
            <span style="color: #555; margin-left: 10px;">
                <?php echo $avg_rating; ?>/5 (<?php echo $review_count; ?> đánh giá)
            </span>
        </div>

        <div class="price-area">
            <span class="current-price" id="display-price">
                <?php echo $first_variant ? number_format($first_variant['price']) . ' ₫' : 'Liên hệ'; ?>
            </span>
            <span class="old-price" id="display-old-price" style="display:none;"></span>
            <span class="discount-tag" id="display-badge" style="display:none;"></span>
        </div>

        <form id="add-cart-form" method="POST" class="add-to-cart-form" onsubmit="return handleAddToCart(event, this);">

            <?php
            $colors = array_unique(array_column($variants, 'color'));
            $storages = array_unique(array_column($variants, 'storage'));
            ?>

            <?php if (!empty($colors)): ?>
                <div class="option-block">
                    <span class="option-label">Màu sắc: <span id="text-color" style="font-weight:normal"></span></span>
                    <div class="color-list">
                        <?php foreach ($colors as $idx => $c):
                            // Lấy mã màu từ DB
                            $hex = isset($dynamic_colors[$c]) ? $dynamic_colors[$c] : '#eee';
                        ?>
                            <div class="color-item <?php echo $idx == 0 ? 'active' : ''; ?>"
                                style="background-color: <?php echo $hex; ?>;"
                                title="<?php echo $c; ?>"
                                data-val="<?php echo $c; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($storages)): ?>
                <div class="option-block">
                    <span class="option-label">Dung lượng:</span>
                    <div class="storage-list">
                        <?php foreach ($storages as $idx => $s): ?>
                            <div class="storage-item <?php echo $idx == 0 ? 'active' : ''; ?>" data-val="<?php echo $s; ?>">
                                <strong><?php echo $s; ?></strong>
                                <span class="storage-price">...</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="option-block">
                <span class="option-label">Số lượng:</span>
                <div class="qty-control">
                    <button type="button" class="qty-btn" onclick="updateQty(-1)">-</button>
                    <input type="text" name="quantity" id="qty" value="1" class="qty-input" readonly>
                    <button type="button" class="qty-btn" onclick="updateQty(1)">+</button>
                </div>
            </div>

            <div class="action-btns">
                <button type="submit" class="btn btn-cart" id="btn-add">THÊM VÀO GIỎ</button>
                <button type="submit" class="btn btn-buy" name="buy_now" value="1">MUA NGAY</button>
            </div>

            <p id="error-msg" style="color:red; display:none; margin-top:10px; font-style: italic;">
                <i class="fas fa-exclamation-circle"></i> Phiên bản này đang tạm hết hàng.
            </p>
        </form>

        <div class="feature-box">
            <h4><i class="fas fa-check-circle" style="color: #28a745;"></i> Thông số nổi bật</h4>
            <ul class="feature-list">
                <?php if ($product['screen_size']) echo "<li>Màn hình: " . htmlspecialchars($product['screen_size']) . "</li>"; ?>
                <?php if ($product['camera_rear']) echo "<li>Camera: " . htmlspecialchars($product['camera_rear']) . "</li>"; ?>
                <?php if ($product['cpu']) echo "<li>Chip: " . htmlspecialchars($product['cpu']) . "</li>"; ?>
                <?php if ($product['ram']) echo "<li>RAM: " . htmlspecialchars($product['ram']) . "</li>"; ?>
                <?php if ($product['battery']) echo "<li>Pin: " . htmlspecialchars($product['battery']) . "</li>"; ?>
            </ul>
        </div>
    </div>
</div>

<div class="product-tabs">
    <div class="tab-nav">
        <div class="tab-link active" onclick="openTab('desc')">Mô tả sản phẩm</div>
        <div class="tab-link" onclick="openTab('spec')">Thông số kỹ thuật</div>
        <div class="tab-link" onclick="openTab('review')">Đánh giá (<?php echo $review_count; ?>)</div>
    </div>
    <div id="tab-desc" class="tab-content">
        <div style="line-height: 1.8; color: #333;"><?php echo $product['description']; ?></div>
    </div>
    <div id="tab-spec" class="tab-content" style="display:none">
        <table class="specs-table">
            <tr>
                <td>Màn hình</td>
                <td><?php echo htmlspecialchars($product['screen_size']); ?></td>
            </tr>
            <tr>
                <td>Camera sau</td>
                <td><?php echo htmlspecialchars($product['camera_rear']); ?></td>
            </tr>
            <tr>
                <td>Camera trước</td>
                <td><?php echo htmlspecialchars($product['camera_front']); ?></td>
            </tr>
            <tr>
                <td>Chip xử lý</td>
                <td><?php echo htmlspecialchars($product['cpu']); ?></td>
            </tr>
            <tr>
                <td>RAM</td>
                <td><?php echo htmlspecialchars($product['ram']); ?></td>
            </tr>
            <tr>
                <td>Pin</td>
                <td><?php echo htmlspecialchars($product['battery']); ?></td>
            </tr>
        </table>
    </div>
    <div id="tab-review" class="tab-content" style="display:none">
        
        <div class="review-layout">
            <!-- Left: Review Form -->
            <div class="review-form-card">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <h4 class="form-title">Đánh giá sản phẩm</h4>
                    <form action="<?php echo URLROOT; ?>/product/addReview" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        
                        <div class="form-group">
                            <label class="form-label">Chất lượng sản phẩm:</label>
                            <div class="stars-input-wrapper">
                                <input type="radio" name="rating" value="5" id="s5" required><label for="s5" title="5 sao">★</label>
                                <input type="radio" name="rating" value="4" id="s4" title="4 sao"><label for="s4">★</label>
                                <input type="radio" name="rating" value="3" id="s3" title="3 sao"><label for="s3">★</label>
                                <input type="radio" name="rating" value="2" id="s2" title="2 sao"><label for="s2">★</label>
                                <input type="radio" name="rating" value="1" id="s1" title="1 sao"><label for="s1">★</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Nội dung đánh giá:</label>
                            <textarea name="comment" class="review-textarea" rows="4" required placeholder="Mời bạn chia sẻ cảm nhận về sản phẩm..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-submit-review">Gửi đánh giá</button>
                    </form>
                <?php else: ?>
                    <div class="login-prompt">
                        <div class="icon-lock"><i class="fas fa-lock"></i></div>
                        <p>Vui lòng <a href="<?php echo URLROOT; ?>/user/login">đăng nhập</a> để gửi đánh giá của bạn.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right: Review List -->
            <div class="review-list-container">
                <h4 class="list-title">Khách hàng nhận xét (<?php echo count($reviews); ?>)</h4>
                
                <?php if (empty($reviews)): ?>
                    <div class="empty-reviews">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" alt="No reviews" class="empty-icon">
                        <p>Chưa có đánh giá nào. Hãy là người đầu tiên!</p>
                    </div>
                <?php else: ?>
                    <div class="review-items">
                        <?php foreach ($reviews as $rv): 
                            $initial = strtoupper(substr($rv['user_name'], 0, 1));
                            $bg_colors = ['#f56a00', '#7265e6', '#ffbf00', '#00a2ae', '#1890ff'];
                            $bg = $bg_colors[rand(0, 4)];
                        ?>
                            <div class="review-item">
                                <div class="reviewer-avatar" style="background-color: <?php echo $bg; ?>;">
                                    <?php echo $initial; ?>
                                </div>
                                <div class="review-content">
                                    <div class="reviewer-header">
                                        <span class="reviewer-name"><?php echo htmlspecialchars($rv['user_name']); ?></span>
                                        <span class="review-date"><i class="far fa-clock"></i> <?php echo date('d/m/Y', strtotime($rv['created_at'])); ?></span>
                                    </div>
                                    <div class="review-rating">
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <i class="fas fa-star <?php echo $i <= $rv['rating'] ? 'filled' : ''; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="review-text"><?php echo nl2br(htmlspecialchars($rv['comment'])); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <style>
            /* REVIEW TAB STYLES */
            .review-layout {
                display: grid;
                grid-template-columns: 1fr 1.5fr; /* Form nhỏ hơn List */
                gap: 40px;
                padding: 20px 0;
            }

            @media (max-width: 768px) {
                .review-layout {
                    grid-template-columns: 1fr;
                    gap: 30px;
                }
            }

            /* --- FORM CARD --- */
            .review-form-card {
                background: #f9fafb;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                padding: 25px;
                height: fit-content;
            }
            .form-title {
                margin: 0 0 20px 0;
                font-size: 1.1rem;
                font-weight: 600;
                color: #1f2937;
            }
            .form-label {
                display: block;
                font-size: 0.95rem;
                font-weight: 500;
                color: #4b5563;
                margin-bottom: 8px;
            }
            
            /* Horizontal Stars */
            .stars-input-wrapper {
                display: flex;
                flex-direction: row-reverse;
                justify-content: flex-end;
                gap: 5px;
            }
            .stars-input-wrapper input { display: none; }
            .stars-input-wrapper label {
                font-size: 28px;
                color: #d1d5db; /* Grey */
                cursor: pointer;
                transition: color 0.2s;
            }
            /* Hover & Checked Logic */
            .stars-input-wrapper input:checked ~ label,
            .stars-input-wrapper label:hover,
            .stars-input-wrapper label:hover ~ label {
                color: #fbbf24; /* Amber-400 */
                transform: scale(1.1);
            }

            .review-textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                font-family: inherit;
                resize: vertical;
                transition: border-color 0.2s;
            }
            .review-textarea:focus {
                outline: none;
                border-color: #3b82f6; /* Blue-500 */
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            .btn-submit-review {
                background-color: #2563eb;
                color: white;
                border: none;
                padding: 10px 24px;
                border-radius: 8px;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.2s;
                width: 100%;
                margin-top: 15px;
            }
            .btn-submit-review:hover {
                background-color: #1d4ed8;
            }

            /* Login Prompt */
            .login-prompt {
                text-align: center;
                padding: 30px 10px;
                background: white;
                border-radius: 8px;
                border: 1px dashed #cbd5e1;
            }
            .icon-lock {
                font-size: 2rem;
                color: #94a3b8;
                margin-bottom: 10px;
            }

            /* --- REVIEW LIST --- */
            .list-title {
                font-size: 1.2rem;
                margin: 0 0 20px 0;
                padding-bottom: 10px;
                border-bottom: 2px solid #f3f4f6;
            }
            .review-items {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
            .review-item {
                display: flex;
                gap: 15px;
                padding-bottom: 20px;
                border-bottom: 1px solid #f3f4f6;
            }
            .review-item:last-child {
                border-bottom: none;
            }
            .reviewer-avatar {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 600;
                font-size: 1.1rem;
                flex-shrink: 0;
            }
            .review-content {
                flex-grow: 1;
            }
            .reviewer-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 5px;
            }
            .reviewer-name {
                font-weight: 600;
                color: #111827;
            }
            .review-date {
                font-size: 0.85rem;
                color: #9ca3af;
                display: flex;
                align-items: center;
                gap: 5px;
            }
            .review-rating {
                color: #fbbf24;
                font-size: 0.9rem;
                margin-bottom: 8px;
            }
            .review-rating .fas.fa-star {
                color: #e5e7eb; /* Empty star color */
            }
            .review-rating .fas.filled {
                color: #fbbf24;
            }
            .review-text {
                color: #4b5563;
                line-height: 1.5;
                font-size: 0.95rem;
                margin: 0;
            }
            .empty-reviews {
                text-align: center;
                padding: 40px;
                color: #6b7280;
            }
            .empty-icon {
                width: 64px;
                opacity: 0.5;
                margin-bottom: 10px;
            }
        </style>
    </div>
</div>

<div class="container" style="margin-top: 50px; margin-bottom: 60px;">
    <h2 class="section-title" style="text-align: left; border-left: 5px solid #288ad6; padding-left: 15px; margin-bottom: 20px;">
        Sản phẩm liên quan
    </h2>
    <?php if (empty($related_products)) : ?>
        <p style="color: #777;">Đang cập nhật...</p>
    <?php else : ?>
        <div class="related-slider-wrapper">
            <div class="related-slider-container">
                <div class="related-slider-track" id="related-track">
                    <?php foreach ($related_products as $p) : ?>
                        <div class="product-card slider-item">
                            <?php if ($p['max_sale'] > 0 && $p['max_sale'] < $p['min_price']): $pct = round((($p['min_price'] - $p['max_sale']) / $p['min_price']) * 100); ?>
                                <span class="badge-top-left">-<?php echo $pct; ?>%</span>
                            <?php endif; ?>
                            <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $p['product_id']; ?>">
                                <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($p['image']); ?>" class="pc-img" alt="">
                            </a>
                            <div class="pc-info">
                                <div class="pc-name"><a href="<?php echo URLROOT; ?>/product/detail/<?php echo $p['product_id']; ?>"><?php echo htmlspecialchars($p['product_name']); ?></a></div>
                                <div class="pc-price">Từ <?php echo number_format($p['min_price']); ?> ₫</div>
                            </div>
                            <div class="pc-btns">
                                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $p['product_id']; ?>" class="pc-btn pc-btn-view" style="width: 100%;">Xem chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script id="variants-json" type="application/json">
    <?php echo json_encode($variants); ?>
</script>
