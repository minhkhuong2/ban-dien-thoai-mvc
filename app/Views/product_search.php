<h2 class="section-title"><?php echo $data['title']; ?></h2>

<div class="product-grid">
    <?php if (empty($data['variants'])) : ?> <p style="text-align: center; grid-column: 1 / -1;">Không tìm thấy sản phẩm nào phù hợp.</p>
    <?php else : ?>
        <?php foreach ($data['variants'] as $variant) : ?> <div class="product-card">
                <?php
                // Tính % giảm giá
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
                        <span><?php echo htmlspecialchars($variant['storage']); ?></span> |
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
