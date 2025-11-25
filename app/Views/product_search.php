<div class="container" style="margin-top: 30px; margin-bottom: 50px;">

    <div class="page-title-header">
        <h1>Kết Quả Tìm Kiếm</h1>
        <p>
            Từ khóa: <strong style="color: #288ad6;">"<?php echo htmlspecialchars($data['search_query']); ?>"</strong>
            - Tìm thấy <strong><?php echo count($data['products']); ?></strong> sản phẩm
        </p>
    </div>

    <div class="product-grid">
        <?php if (empty($data['products'])) : ?>
            <div style="grid-column: 1 / -1; text-align: center; background: #fff; padding: 50px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <img src="<?php echo URLROOT; ?>/images/no-result.png" alt="" style="width: 100px; opacity: 0.5; margin-bottom: 15px;">
                <p style="font-size: 1.2rem; color: #555;">Rất tiếc, không tìm thấy sản phẩm nào phù hợp.</p>
                <a href="<?php echo URLROOT; ?>/product/all" class="btn-add-to-cart" style="display: inline-block; width: auto; padding: 10px 30px; margin-top: 15px;">
                    Xem tất cả sản phẩm
                </a>
            </div>
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
                            ★★★★★ <span style="color: #999;">(5.0)</span>
                        </div>

                        <div class="pc-price">
                            Từ <?php echo number_format($product['min_price']); ?> ₫
                        </div>
                    </div>

                    <div class="pc-btns">
                        <?php if (isset($product['default_variant_id'])): ?>
                            <form action="<?php echo URLROOT; ?>/cart/add/<?php echo $product['default_variant_id']; ?>" method="POST" class="add-to-cart-form">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="pc-btn pc-btn-cart" style="width: 100%; cursor: pointer; border:none;">
                                    <i class="fas fa-shopping-cart"></i> Giỏ hàng
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $product['product_id']; ?>" class="pc-btn pc-btn-cart">
                                <i class="fas fa-shopping-cart"></i> Chọn mua
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

</div>
