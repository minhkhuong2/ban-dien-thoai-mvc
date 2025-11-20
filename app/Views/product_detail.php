<?php
$product = $data['product'];
$variants = $data['variants'];
$first_variant = $variants[0];
?>

<div class="breadcrumb">
    <a href="<?php echo URLROOT; ?>/">Trang chủ</a> /
    <a href="<?php echo URLROOT; ?>/product/all">Sản phẩm</a> /
    <span><?php echo htmlspecialchars($product['name']); ?></span>
</div>

<div class="product-detail-layout">

    <div class="product-gallery">
        <div id="dynamic-discount-badge" class="discount-badge" style="display: none;"></div>
        <div class="main-image">
            <img id="main-product-image" src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($first_variant['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="thumbnail-images">
        </div>
    </div>

    <div class="product-info">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>

        <div class="product-rating-summary">
            <?php
            $avg_rating = $data['rating_info']['avg_rating'];
            $review_count = $data['rating_info']['review_count'];
            $star_percentage = ($avg_rating / 5) * 100;
            ?>
            <div class="stars-outer">
                <svg class="icon icon-star" viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <svg class="icon icon-star" viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <svg class="icon icon-star" viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <svg class="icon icon-star" viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <svg class="icon icon-star" viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <div class="stars-inner" style="width: <?php echo $star_percentage; ?>%;">
                    <svg class="icon icon-star" viewBox="0 0 24 24">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg class="icon icon-star" viewBox="0 0 24 24">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg class="icon icon-star" viewBox="0 0 24 24">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg class="icon icon-star" viewBox="0 0 24 24">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg class="icon icon-star" viewBox="0 0 24 24">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
            </div>
            <span class="rating-count">
                <?php if ($review_count > 0) : ?>
                    <?php echo number_format($avg_rating, 1); ?> (<?php echo $review_count; ?> đánh giá)
                <?php else : ?>
                    (Chưa có đánh giá)
                <?php endif; ?>
            </span>
        </div>

        <div class="product-pricing">
            <span class="price-sale" id="dynamic-price-sale"></span>
            <span class="price-original" id="dynamic-price-original" style="display: none;"></span>
        </div>

        <form action="<?php echo URLROOT; ?>/cart/add/<?php echo $first_variant['id']; ?>" method="POST" class="add-to-cart-form" id="main-cart-form">

            <?php
            $options_storage = [];
            $options_color = [];
            foreach ($variants as $variant) {
                $options_storage[$variant['storage']] = $variant['storage'];
                $options_color[$variant['color']] = $variant['color'];
            }
            ?>

            <h4>Dung lượng: <span id="selected-storage"><?php echo htmlspecialchars($first_variant['storage']); ?></span></h4>
            <div class="product-options">
                <div class="option-group">
                    <?php $is_first = true; ?>
                    <?php foreach ($options_storage as $storage) : ?>
                        <button type="button"
                            class="option-btn storage-option <?php echo $is_first ? 'active' : '';
                                                                $is_first = false; ?>"
                            data-value="<?php echo htmlspecialchars($storage); ?>">
                            <?php echo htmlspecialchars($storage); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <h4>Màu sắc: <span id="selected-color"><?php echo htmlspecialchars($first_variant['color']); ?></span></h4>
            <div class="product-options">
                <div class="option-group">
                    <?php $is_first = true; ?>
                    <?php foreach ($options_color as $color) : ?>
                        <button type="button"
                            class="option-btn color-option <?php echo $is_first ? 'active' : '';
                                                            $is_first = false; ?>"
                            data-value="<?php echo htmlspecialchars($color); ?>">
                            <?php echo htmlspecialchars($color); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <h4>Số lượng:</h4>
            <div class="quantity-selector">
                <button type="button" class="qty-minus">-</button>
                <input type="text" name="quantity" value="1" readonly>
                <button type="button" class="qty-plus">+</button>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn btn-add-to-cart-lg">Thêm vào giỏ</button>
                <button type="submit" class="btn btn-buy-now">Mua ngay</button>
            </div>

        </form>

        <div class="product-highlights" style="margin-top: 20px;">
            <h4>Thông tin nổi bật</h4>
            <ul>
                <li><svg viewBox="0 0 24 24" class="icon icon-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg> Màn hình: <?php echo htmlspecialchars($product['screen_size']); ?> - <?php echo htmlspecialchars($product['screen_tech']); ?></li>
                <li><svg viewBox="0 0 24 24" class="icon icon-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg> Vi xử lý (CPU): <?php echo htmlspecialchars($product['cpu']); ?></li>
                <li><svg viewBox="0 0 24 24" class="icon icon-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg> RAM: <?php echo htmlspecialchars($product['ram']); ?> - Bộ nhớ: <?php echo htmlspecialchars($first_variant['storage']); ?></li>
                <li><svg viewBox="0 0 24 24" class="icon icon-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg> Camera sau: <?php echo htmlspecialchars($product['camera_rear']); ?></li>
                <li><svg viewBox="0 0 24 24" class="icon icon-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg> Camera trước: <?php echo htmlspecialchars($product['camera_front']); ?></li>
                <li><svg viewBox="0 0 24 24" class="icon icon-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg> Pin: <?php echo htmlspecialchars($product['battery']); ?> - Sạc: <?php echo htmlspecialchars($product['battery_tech']); ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="product-tabs-container">
    <div class="tab-headers">
        <div class="tab-header active" data-tab="tab-description">Mô tả sản phẩm</div>
        <div class="tab-header" data-tab="tab-specs">Thông số kỹ thuật</div>
        <div class="tab-header" data-tab="tab-reviews">Đánh giá (<?php echo count($data['reviews']); ?>)</div>
    </div>

    <div class="tab-content active" id="tab-description">
        <h3>Mô tả sản phẩm</h3>
        <div class="content">
            <?php echo nl2br(htmlspecialchars($product['description'])); ?>
        </div>
    </div>

    <div class="tab-content" id="tab-specs">
        <h3>Thông số kỹ thuật chi tiết</h3>
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
                <td>CPU</td>
                <td><?php echo htmlspecialchars($product['cpu']); ?> (<?php echo htmlspecialchars($product['chip']); ?>)</td>
            </tr>
            <tr>
                <td>RAM</td>
                <td><?php echo htmlspecialchars($product['ram']); ?> (<?php echo htmlspecialchars($product['ram_tech']); ?>)</td>
            </tr>
            <tr>
                <td>Bộ nhớ trong</td>
                <td><?php echo htmlspecialchars($first_variant['storage']); ?></td>
            </tr>
            <tr>
                <td>Pin & Sạc</td>
                <td><?php echo htmlspecialchars($product['battery']); ?> - <?php echo htmlspecialchars($product['battery_tech']); ?></td>
            </tr>
            <tr>
                <td>Kết nối</td>
                <td><?php echo htmlspecialchars($product['connectivity']); ?></td>
            </tr>
            <tr>
                <td>Kích thước</td>
                <td><?php echo htmlspecialchars($product['dimensions']); ?></td>
            </tr>
            <tr>
                <td>Trọng lượng</td>
                <td><?php echo htmlspecialchars($product['weight']); ?></td>
            </tr>
        </table>
    </div>

    <div class="tab-content" id="tab-reviews">
        <h3>Đánh giá từ khách hàng</h3>
        <div class="review-form-container">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <h4>Viết đánh giá của bạn</h4>
                <form action="<?php echo URLROOT; ?>/review/add/<?php echo $product['id']; ?>" method="POST">
                    <div class="form-group">
                        <label>Bạn chấm mấy sao? <sup>*</sup></label>
                        <div class="rating-stars">
                            <input type="radio" id="star5" name="rating" value="5" required><label for="star5"><svg class="icon icon-star" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg></label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4"><svg class="icon icon-star" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg></label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3"><svg class="icon icon-star" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg></label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2"><svg class="icon icon-star" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg></label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1"><svg class="icon icon-star" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Bình luận của bạn: <sup>*</sup></label>
                        <textarea name="comment" id="comment" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                </form>
            <?php else : ?>
                <p>Vui lòng <a href="<?php echo URLROOT; ?>/user/login">đăng nhập</a> để viết đánh giá.</p>
            <?php endif; ?>
        </div>

        <div class="review-list" style="margin-top: 30px;">
            <?php if (empty($data['reviews'])) : ?>
                <p>Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên!</p>
            <?php else : ?>
                <?php foreach ($data['reviews'] as $review) : ?>
                    <div class="review-item">
                        <div class="review-header">
                            <div class="review-avatar"><?php echo strtoupper(substr($review['user_name'], 0, 1)); ?></div>
                            <div>
                                <span class="user-name"><?php echo htmlspecialchars($review['user_name']); ?></span>
                                <div class="rating">
                                    <?php for ($i = 0; $i < $review['rating']; $i++) {
                                        echo '<svg class="icon icon-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="review-comment">
                            <?php echo nl2br(htmlspecialchars($review['comment'])); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<h2 class="section-title">Sản phẩm liên quan</h2>
<div class="product-grid">
    <?php if (empty($data['related_products'])) : ?>
        <p style="text-align: center; grid-column: 1 / -1;">Không có sản phẩm liên quan.</p>
    <?php else : ?>
        <?php foreach ($data['related_products'] as $variant) : ?>
            <div class="product-card">
                <?php
                if (isset($variant['price_sale']) && $variant['price_sale'] > 0) {
                    $discount_percent = round((($variant['price'] - $variant['price_sale']) / $variant['price']) * 100);
                    echo '<div class="discount-badge">-' . $discount_percent . '%</div>';
                }
                ?>
                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $variant['product_id']; ?>">
                    <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($variant['image']); ?>"
                        alt="<?php echo htmlspecialchars($variant['product_name']); ?>"
                        class="product-card-image">
                </a>
                <div class="product-card-content">
                    <h3>
                        <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $variant['product_id']; ?>">
                            <?php echo htmlspecialchars($variant['product_name']); ?>
                            (<?php echo htmlspecialchars($variant['storage']); ?>)
                        </a>
                    </h3>
                    <div class="product-price">
                        <?php if (isset($variant['price_sale']) && $variant['price_sale'] > 0) : ?>
                            <?php echo number_format($variant['price_sale']); ?> VNĐ
                            <span class="product-price-old"><?php echo number_format($variant['price']); ?> VNĐ</span>
                        <?php else : ?>
                            <?php echo number_format($variant['price']); ?> VNĐ
                        <?php endif; ?>
                    </div>
                    <div class="product-specs">
                        <span><?php echo htmlspecialchars($variant['ram']); ?></span> |
                        <span><?php echo htmlspecialchars($variant['storage']); ?></span>
                    </div>

                    <form action="<?php echo URLROOT; ?>/cart/add/<?php echo $variant['variant_id']; ?>" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-add-to-cart">Thêm vào giỏ</button>
                    </form>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script id="variants-data" type="application/json">
    <?php echo json_encode($data['variants']); ?>
</script>
