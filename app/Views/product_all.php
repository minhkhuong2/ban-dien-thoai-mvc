<div class="page-title-header">
    <h1>Sản phẩm điện thoại</h1>
    <p>Khám phá bộ sưu tập điện thoại đa dạng...</p>
</div>

<form action="<?php echo URLROOT; ?>/product/all" method="GET" id="filter-form">
    <div class="product-page-layout">

        <aside class="sidebar-filters">

            <h4>Bộ lọc sản phẩm</h4>

            <div class="filter-widget">
                <h5>Tìm kiếm</h5>
                <div class="search-filter">
                    <input type="text" name="query" placeholder="Tìm kiếm sản phẩm..."
                        value="<?php echo htmlspecialchars($data['filters']['search_query'] ?? ''); ?>">
                </div>
            </div>

            <div class="filter-widget">
                <h5>Danh mục</h5>
                <ul>
                    <li>
                        <a href="<?php echo URLROOT; ?>/product/all" class="<?php echo !isset($_GET['category_filter']) ? 'active' : ''; ?>">
                            Tất cả
                        </a>
                        <span>(<?php echo $this->model('ProductModel')->countVariants(); ?>)</span>
                    </li>

                    <?php if (!empty($data['categories'])) : ?>
                        <?php foreach ($data['categories'] as $cat) : ?>
                            <li>
                                <a href="<?php echo URLROOT; ?>/product/all?category_filter=<?php echo $cat['id']; ?>"
                                    class="<?php echo (isset($_GET['category_filter']) && $_GET['category_filter'] == $cat['id']) ? 'active' : ''; ?>">
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </a>

                                <span>(<?php echo $cat['product_count']; ?>)</span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="filter-widget">
                <h5>Thương hiệu</h5>
                <select name="brand_filter" onchange="document.getElementById('filter-form').submit()">
                    <option value="">Tất cả thương hiệu</option>
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
                    <option value="">Tất cả mức giá</option>
                    <option value="1" <?php echo ($data['filters']['price_range'] == 1) ? 'selected' : ''; ?>>Dưới 5 triệu</option>
                    <option value="2" <?php echo ($data['filters']['price_range'] == 2) ? 'selected' : ''; ?>>5 - 10 triệu</option>
                    <option value="3" <?php echo ($data['filters']['price_range'] == 3) ? 'selected' : ''; ?>>10 - 20 triệu</option>
                    <option value="4" <?php echo ($data['filters']['price_range'] == 4) ? 'selected' : ''; ?>>20 - 30 triệu</option>
                    <option value="5" <?php echo ($data['filters']['price_range'] == 5) ? 'selected' : ''; ?>>Trên 30 triệu</option>
                </select>
            </div>

            <a href="<?php echo URLROOT; ?>/product/all" class="btn-clear-filters" style="text-align: center; text-decoration: none;">Xóa bỏ lọc</a>

        </aside>

        <main class="main-product-grid">

            <div class="product-grid-header">
                <span>Hiển thị <?php echo count($data['variants']); ?> sản phẩm</span>
                <div class="sort-by">
                    <label for="sort">Sắp xếp: </label>
                    <select name="sort" id="sort" onchange="document.getElementById('filter-form').submit()">
                        <option value="default" <?php echo ($data['filters']['sort_by'] == 'default') ? 'selected' : ''; ?>>Mặc định</option>
                        <option value="newest" <?php echo ($data['filters']['sort_by'] == 'newest') ? 'selected' : ''; ?>>Mới nhất</option>
                        <option value="price_asc" <?php echo ($data['filters']['sort_by'] == 'price_asc') ? 'selected' : ''; ?>>Giá tăng dần</option>
                        <option value="price_desc" <?php echo ($data['filters']['sort_by'] == 'price_desc') ? 'selected' : ''; ?>>Giá giảm dần</option>
                    </select>
                </div>
            </div>

            <div class="product-grid">
                <?php if (empty($data['variants'])) : ?>
                    <p style="text-align: center; grid-column: 1 / -1;">Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</p>
                <?php else : ?>
                    <?php foreach ($data['variants'] as $variant) : ?>
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
                                <h3><a href="<?php echo URLROOT; ?>/product/detail/<?php echo $variant['product_id']; ?>"><?php echo htmlspecialchars($variant['product_name']); ?> (<?php echo htmlspecialchars($variant['storage']); ?>)</a></h3>
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
                                    <span><?php echo htmlspecialchars($variant['cpu']); ?></span>
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

        </main>
    </div>
</form>
