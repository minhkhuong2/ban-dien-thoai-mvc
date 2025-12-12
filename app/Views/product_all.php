<div class="page-title-header">
    <h1>Tất Cả Sản Phẩm</h1>
    <p>Tìm kiếm chiếc điện thoại ưng ý nhất cho bạn</p>
</div>


<div class="product-page-layout">

    <aside class="sidebar-filters">
        <form action="<?php echo URLROOT; ?>/product/all" method="GET" id="filter-form">
            <h4><i class="fas fa-filter"></i> Bộ lọc tìm kiếm</h4>

            <div class="filter-widget">
                <h5>Từ khóa</h5>
                <div class="search-filter">
                    <input type="text" name="query" placeholder="Nhập tên máy..."
                        value="<?php echo htmlspecialchars($data['filters']['search_query'] ?? ''); ?>">
                </div>
            </div>

            <div class="filter-widget">
                <h5>Danh mục</h5>
                <ul>
                    <li>
                        <a href="<?php echo URLROOT; ?>/product/all"
                            class="<?php echo !isset($_GET['category_filter']) ? 'active' : ''; ?>">
                            Tất cả
                        </a>
                    </li>
                    <?php if (!empty($data['categories'])) : ?>
                        <?php foreach ($data['categories'] as $cat) : ?>
                            <li>
                                <a href="<?php echo URLROOT; ?>/product/all?category_filter=<?php echo $cat['id']; ?>"
                                    class="<?php echo (isset($_GET['category_filter']) && $_GET['category_filter'] == $cat['id']) ? 'active' : ''; ?>">
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </a>
                                <span><?php echo $cat['product_count']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="filter-widget">
                <h5>Thương hiệu</h5>
                <select name="brand_filter" onchange="document.getElementById('filter-form').submit()">
                    <option value="">-- Tất cả hãng --</option>
                    <?php if (!empty($data['brands'])) : ?>
                        <?php foreach ($data['brands'] as $brand) : ?>
                            <option value="<?php echo $brand['id']; ?>"
                                <?php echo ($data['filters']['brand_id'] == $brand['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($brand['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="filter-widget">
                <h5>Mức giá</h5>
                <select name="price_filter" onchange="document.getElementById('filter-form').submit()">
                    <option value="">-- Tất cả --</option>
                    <option value="1" <?php echo ($data['filters']['price_range'] == 1) ? 'selected' : ''; ?>>Dưới 5 triệu</option>
                    <option value="2" <?php echo ($data['filters']['price_range'] == 2) ? 'selected' : ''; ?>>5 - 10 triệu</option>
                    <option value="3" <?php echo ($data['filters']['price_range'] == 3) ? 'selected' : ''; ?>>10 - 20 triệu</option>
                    <option value="4" <?php echo ($data['filters']['price_range'] == 4) ? 'selected' : ''; ?>>20 - 30 triệu</option>
                    <option value="5" <?php echo ($data['filters']['price_range'] == 5) ? 'selected' : ''; ?>>Trên 30 triệu</option>
                </select>
            </div>

            <a href="<?php echo URLROOT; ?>/product/all" class="btn-clear-filters">Xóa bộ lọc</a>
        </form>
    </aside>

    <main class="main-product-grid">
        <div class="product-grid-header">
            <span>Tìm thấy <strong><?php echo count($data['products']); ?></strong> sản phẩm</span>

            <div class="sort-by">
                <label>Sắp xếp:</label>
                <select name="sort" form="filter-form" onchange="document.getElementById('filter-form').submit()">
                    <option value="newest" <?php echo ($data['filters']['sort_by'] == 'newest') ? 'selected' : ''; ?>>Mới nhất</option>
                    <option value="price_asc" <?php echo ($data['filters']['sort_by'] == 'price_asc') ? 'selected' : ''; ?>>Giá tăng dần</option>
                    <option value="price_desc" <?php echo ($data['filters']['sort_by'] == 'price_desc') ? 'selected' : ''; ?>>Giá giảm dần</option>
                </select>
            </div>
        </div>

        <div class="product-grid">
            <?php if (empty($data['products'])) : ?>
                <p style="grid-column: 1/-1; text-align: center; padding: 40px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    Không tìm thấy sản phẩm nào phù hợp.
                </p>
            <?php else : ?>
                <?php foreach ($data['products'] as $product) : ?>
                    <div class="product-card">

                        <?php if ($product['max_sale'] > 0 && $product['max_sale'] < $product['min_price']):
                            $percent = round((($product['min_price'] - $product['max_sale']) / $product['min_price']) * 100);
                        ?>
                            <span class="badge-top-left">-<?php echo $percent; ?>%</span>
                        <?php endif; ?>

                        <span class="badge-top-right">Mới</span>

                        <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>">
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($product['image']); ?>"
                                class="pc-img"
                                alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        </a>

                        <div class="pc-info">
                            <div class="pc-name">
                                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>">
                                    <?php echo htmlspecialchars($product['product_name']); ?>
                                </a>
                            </div>

                            <div style="font-size: 13px; color: #ff9f00; margin-bottom: 5px;">
                                <?php
                                $avg_rating = isset($product['avg_rating']) ? (float)$product['avg_rating'] : 0;
                                $review_count = isset($product['review_count']) ? (int)$product['review_count'] : 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= round($avg_rating)) {
                                        echo '<i class="fas fa-star"></i>';
                                    } else {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                }
                                ?>
                                <span style="color: #999; margin-left: 5px; font-size: 12px;">(<?php echo $review_count > 0 ? number_format($avg_rating, 1) : '0'; ?>)</span>
                            </div>

                            <div class="pc-price">
                                <?php echo number_format($product['min_price']); ?> ₫
                                <?php if ($product['max_sale'] > 0): ?>
                                    <span class="pc-old-price"><?php echo number_format($product['max_price']); ?> đ</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="pc-btns">
                            <?php if (isset($product['default_variant_id'])): ?>
                                <form action="<?php echo URLROOT; ?>/cart/add/<?php echo $product['default_variant_id']; ?>"
                                    method="POST"
                                    class="add-to-cart-form"
                                    onsubmit="return handleAddToCart(event, this);"
                                    style="flex: 1;">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="pc-btn pc-btn-cart" style="width: 100%; cursor: pointer;">
                                        Giỏ hàng
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>" class="pc-btn pc-btn-cart">
                                    Chọn mua
                                </a>
                            <?php endif; ?>

                            <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>" class="pc-btn pc-btn-view">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="pagination-container">
            <?php echo $data['pagination'] ?? ''; ?>
        </div>
    </main>
</div>
