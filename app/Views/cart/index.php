<h2><?php echo $data['title']; ?></h2>

<?php if (empty($data['variants'])) : ?>
    <p>Giỏ hàng của bạn đang trống.</p>
<?php else : ?>
    <div class="cart-page-layout">
        <div class="cart-items-list">
            <h3>Sản phẩm đã chọn (<span id="cart-page-count"><?php echo count($data['variants']); ?></span>)</h3>

            <?php foreach ($data['variants'] as $variant) : ?>
                <?php
                $price = ($variant['price_sale'] > 0) ? $variant['price_sale'] : $variant['price'];
                $quantity = $data['cart'][$variant['id']];
                ?>

                <div class="cart-item-card cart-item-row" data-variant-id="<?php echo $variant['id']; ?>">
                    <div class="cart-item-image">
                        <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($variant['image']); ?>" alt="">
                    </div>
                    <div class="cart-item-info">
                        <h4><a href="<?php echo URLROOT; ?>/product/detail/<?php echo $variant['product_id']; ?>"><?php echo htmlspecialchars($variant['product_name']); ?></a></h4>
                        <div class="item-specs"><?php echo htmlspecialchars($variant['name']); ?></div>

                        <div class="quantity-selector">
                            <button type="button" class="qty-minus cart-qty-change" data-variant-id="<?php echo $variant['id']; ?>" data-change="-1">-</button>
                            <input type="text" name="quantity[<?php echo $variant['id']; ?>]"
                                id="qty-<?php echo $variant['id']; ?>"
                                value="<?php echo $quantity; ?>" readonly>
                            <button type="button" class="qty-plus cart-qty-change" data-variant-id="<?php echo $variant['id']; ?>" data-change="1">+</button>
                        </div>
                    </div>
                    <div class="cart-item-actions">
                        <div class="cart-item-price">
                            <span class="item-total-price" id="item-total-<?php echo $variant['id']; ?>">
                                <?php echo number_format($price * $quantity); ?> VNĐ
                            </span>
                            <?php if ($variant['price_sale'] > 0) : ?>
                                <span class="price-original" style="display: block; font-size: 0.9em; color: #777; text-decoration: line-through;">
                                    <?php echo number_format($variant['price'] * $quantity); ?> VNĐ
                                </span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo URLROOT; ?>/cart/remove/<?php echo $variant['id']; ?>"
                            class="remove-from-cart-ajax"
                            style="color: red; text-decoration: none; font-size: 0.9em; margin-top: 15px; display: inline-block;">
                            Xóa
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <aside class="order-summary-box">
            <h3>Tóm tắt đơn hàng</h3>
            <form action="<?php echo URLROOT; ?>/cart/applyVoucher" method="POST" id="voucher-form">
                <input type="text" name="voucher_code" placeholder="Nhập mã voucher" value="<?php echo htmlspecialchars($data['voucher_code'] ?? ''); ?>" style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px 0 0 4px;">
                <button type="submit" class="btn btn-secondary" style="margin-bottom: 0; border-radius: 0 4px 4px 0;">Áp dụng</button>
            </form>
            <div id="voucher-message-container">
                <?php if (!empty($data['voucher_error'])) : ?>
                    <p style="color: red; font-size: 0.9em;"><?php echo $data['voucher_error']; ?></p>
                <?php endif; ?>
                <?php if (!empty($data['voucher_info'])) : ?>
                    <p style="color: green; font-size: 0.9em; margin-top: -10px;">
                        ✓ Áp dụng mã <strong><?php echo $data['voucher_code']; ?></strong> thành công!
                    </p>
                <?php endif; ?>
            </div>
            <hr>
            <div class="summary-row">
                <span>Tạm tính:</span>
                <span id="cart-subtotal"><?php echo number_format($data['subtotal']); ?> VNĐ</span>
            </div>
            <div class="summary-row" id="cart-discount-row" style="color: green; <?php echo ($data['voucher_discount'] <= 0) ? 'display: none;' : ''; ?>">
                <span>Giảm giá (<span id="cart-voucher-code"><?php echo $data['voucher_code'] ?? ''; ?></span>):</span>
                <span id="cart-discount">- <?php echo number_format($data['voucher_discount']); ?> VNĐ</span>
            </div>
            <div class="summary-row">
                <span>Phí vận chuyển:</span>
                <span style="color: green;">Miễn phí</span>
            </div>
            <div class="summary-row total">
                <span>Tổng cộng:</span>
                <span class="total-price" id="cart-grand-total"><?php echo number_format($data['grand_total']); ?> VNĐ</span>
            </div>
            <a href="<?php echo URLROOT; ?>/checkout" class="btn-checkout">Tiến hành Thanh toán</a>
            <a href="<?php echo URLROOT; ?>/" class="continue-shopping">Tiếp tục mua sắm</a>
        </aside>
    </div>
<?php endif; ?>
