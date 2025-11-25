<?php
// File: app/Views/product_detail.php

// 1. Lấy dữ liệu từ Controller
$product = $data['product'];
$variants = $data['variants'];
$reviews = $data['reviews'];
$rating_info = $data['rating_info'];
$related_products = $data['related_products'];

// Lấy biến thể đầu tiên để hiển thị mặc định
$first_variant = !empty($variants) ? $variants[0] : null;

// Tính toán hiển thị sao trung bình
$avg_rating = $rating_info['avg_rating'] ? round($rating_info['avg_rating'], 1) : 0;
$review_count = $rating_info['review_count'];
$star_percent = ($avg_rating / 5) * 100;

// Mapping màu sắc (Để hiển thị nút tròn nếu cần dùng style inline, 
// nhưng chủ yếu CSS class sẽ xử lý việc này hoặc dùng mã màu từ DB nếu có)
$color_map = [
    'Đen' => '#000000',
    'Trắng' => '#f5f5f5',
    'Vàng' => '#f2d366',
    'Tím' => '#d8bfd8',
    'Xám' => '#808080',
    'Xanh' => '#a2c2e0',
    'Titan Tự nhiên' => '#bcb6a9',
    'Titan Xanh' => '#3e4f5c',
    'Titan Đen' => '#333333',
    'Titan Trắng' => '#eeeeee'
];
?>

<div class="breadcrumb">
    <a href="<?php echo URLROOT; ?>/">Trang chủ</a> ›
    <a href="<?php echo URLROOT; ?>/product/all">Điện thoại</a> ›
    <span><?php echo htmlspecialchars($product['name']); ?></span>
</div>

<div class="product-detail-container">

    <div class="detail-left">
        <div class="product-gallery">
            <div id="dynamic-discount-badge" class="discount-badge" style="display: none;"></div>

            <div class="main-image-slider">
                <button class="gallery-btn btn-prev" id="gallery-prev"><i class="fas fa-chevron-left"></i></button>

                <div class="main-slider-track" id="main-track">
                    <?php
                    // Lọc ảnh duy nhất để không bị trùng khi trượt
                    $unique_images = [];
                    $added_imgs = [];

                    // Ưu tiên ảnh đầu tiên
                    if ($first_variant) {
                        $unique_images[] = ['src' => $first_variant['image'], 'color' => $first_variant['color']];
                        $added_imgs[] = $first_variant['image'];
                    }

                    foreach ($variants as $v) {
                        if (!in_array($v['image'], $added_imgs)) {
                            $unique_images[] = ['src' => $v['image'], 'color' => $v['color']];
                            $added_imgs[] = $v['image'];
                        }
                    }

                    foreach ($unique_images as $img_data) : ?>
                        <div class="slider-single-img" data-color="<?php echo htmlspecialchars($img_data['color']); ?>">
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($img_data['src']); ?>"
                                alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="gallery-btn btn-next" id="gallery-next"><i class="fas fa-chevron-right"></i></button>
            </div>

            <div class="thumb-list">
                <?php foreach ($unique_images as $index => $img_data) : ?>
                    <div class="thumb-item <?php echo ($index == 0) ? 'active' : ''; ?>"
                        onclick="goToSlide(<?php echo $index; ?>)">
                        <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($img_data['src']); ?>" alt="">
                    </div>
                <?php endforeach; ?>
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

        <form id="add-cart-form" method="POST" class="add-to-cart-form">

            <?php
            $colors = array_unique(array_column($variants, 'color'));
            $storages = array_unique(array_column($variants, 'storage'));
            ?>

            <?php if (!empty($colors)): ?>
                <div class="option-block">
                    <span class="option-label">Màu sắc: <span id="text-color" style="font-weight:normal"></span></span>
                    <div class="color-list">
                        <?php foreach ($colors as $idx => $c):
                            $hex = isset($color_map[$c]) ? $color_map[$c] : '#eee';
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
        <div style="line-height: 1.8; color: #333;">
            <?php echo $product['description']; ?>
        </div>
    </div>

    <div id="tab-spec" class="tab-content" style="display:none">
        <table class="specs-table">
            <tr>
                <td>Màn hình</td>
                <td><?php echo htmlspecialchars($product['screen_size']); ?> - <?php echo htmlspecialchars($product['screen_tech']); ?></td>
            </tr>
            <tr>
                <td>Hệ điều hành</td>
                <td><?php echo htmlspecialchars($product['os']); ?></td>
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
            <tr>
                <td>Sạc nhanh</td>
                <td><?php echo htmlspecialchars($product['battery_tech']); ?></td>
            </tr>
        </table>
    </div>

    <div id="tab-review" class="tab-content" style="display:none">
        <div class="reviews-container">
            <?php if (empty($reviews)): ?>
                <p style="text-align: center; color: #777; padding: 20px;">Chưa có đánh giá nào. Hãy là người đầu tiên!</p>
            <?php else: ?>
                <?php foreach ($reviews as $rv): ?>
                    <div style="border-bottom:1px solid #eee; padding: 15px 0; display: flex; gap: 15px;">
                        <div style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #555;">
                            <?php echo strtoupper(substr($rv['user_name'], 0, 1)); ?>
                        </div>
                        <div style="flex: 1;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                <strong><?php echo htmlspecialchars($rv['user_name']); ?></strong>
                                <span style="color:#999; font-size: 0.85em;"><?php echo date('d/m/Y', strtotime($rv['created_at'])); ?></span>
                            </div>
                            <div style="margin-bottom: 8px; color: #f1c40f; font-size: 14px;">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo ($i <= $rv['rating']) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                                }
                                ?>
                            </div>
                            <p style="margin: 0; color: #333;"><?php echo nl2br(htmlspecialchars($rv['comment'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (isset($_SESSION['user_id'])) : ?>
            <div style="margin-top: 30px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
                <h4 style="margin-top: 0;">Gửi đánh giá</h4>
                <form action="<?php echo URLROOT; ?>/review/add/<?php echo $product['id']; ?>" method="POST">
                    <div style="margin-bottom: 15px;">
                        <select name="rating" style="padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
                            <option value="5">5 Sao (Rất hài lòng)</option>
                            <option value="4">4 Sao (Hài lòng)</option>
                            <option value="3">3 Sao (Bình thường)</option>
                            <option value="2">2 Sao (Tệ)</option>
                            <option value="1">1 Sao (Rất tệ)</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <textarea name="comment" required placeholder="Nhập nội dung đánh giá..." style="width: 100%; height: 80px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                    </div>
                    <button type="submit" class="btn-buy" style="width: auto; padding: 10px 30px;">Gửi Đánh Giá</button>
                </form>
            </div>
        <?php else: ?>
            <div style="margin-top: 30px; text-align: center; background: #f0f8ff; padding: 15px; border-radius: 8px;">
                Vui lòng <a href="<?php echo URLROOT; ?>/user/login" style="color: #288ad6; font-weight: bold;">Đăng nhập</a> để viết đánh giá.
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="container" style="margin-top: 50px; margin-bottom: 60px; position: relative;">
    <h2 class="section-title" style="text-align: left; border-left: 5px solid #288ad6; padding-left: 15px; margin-bottom: 20px;">
        Sản phẩm liên quan
    </h2>

    <?php if (empty($related_products)) : ?>
        <p style="color: #777;">Đang cập nhật thêm sản phẩm...</p>
    <?php else : ?>

        <div class="related-slider-wrapper">
            <button class="slider-nav-btn prev-btn" id="rel-prev"><i class="fas fa-chevron-left"></i></button>

            <div class="related-slider-container">
                <div class="related-slider-track" id="related-track">
                    <?php foreach ($related_products as $p) : ?>
                        <div class="product-card slider-item">
                            <?php if ($p['max_sale'] > 0 && $p['max_sale'] < $p['min_price']):
                                $pct = round((($p['min_price'] - $p['max_sale']) / $p['min_price']) * 100);
                            ?>
                                <span class="badge-top-left">-<?php echo $pct; ?>%</span>
                            <?php endif; ?>

                            <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $p['product_id']; ?>">
                                <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($p['image']); ?>"
                                    class="pc-img" alt="">
                            </a>

                            <div class="pc-info">
                                <div class="pc-name">
                                    <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $p['product_id']; ?>">
                                        <?php echo htmlspecialchars($p['product_name']); ?>
                                    </a>
                                </div>
                                <div style="font-size: 13px; color: #ff9f00; margin-bottom: 5px;">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <div class="pc-price">
                                    Từ <?php echo number_format($p['min_price']); ?> ₫
                                </div>
                            </div>

                            <div class="pc-btns">
                                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $p['product_id']; ?>" class="pc-btn pc-btn-view" style="width: 100%;">Xem chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button class="slider-nav-btn next-btn" id="rel-next"><i class="fas fa-chevron-right"></i></button>
        </div>
    <?php endif; ?>
</div>

<script id="variants-json" type="application/json">
    <?php echo json_encode($variants); ?>
</script>
