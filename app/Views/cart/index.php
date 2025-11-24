<div class="page-title-header" style="margin-bottom: 20px;">
    <h1>Giỏ Hàng Của Bạn</h1>
</div>

<div class="container">

    <?php if (empty($data['variants'])) : ?>
        <div style="text-align: center; padding: 50px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <img src="<?php echo URLROOT; ?>/images/empty-cart.png" alt="" style="width: 150px; margin-bottom: 20px; opacity: 0.6;">
            <p style="font-size: 1.2rem; color: #777;">Giỏ hàng của bạn đang trống</p>
            <a href="<?php echo URLROOT; ?>/product/all" class="btn-buy" style="display: inline-block; width: auto; padding: 10px 30px; margin-top: 15px; text-decoration: none;">
                Tiếp tục mua sắm
            </a>
        </div>
    <?php else : ?>

        <div class="cart-page-layout">

            <div class="cart-items-list">
                <div style="background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 15px; font-weight: bold;">
                    Sản phẩm đã chọn (<span id="cart-page-count"><?php echo count($data['variants']); ?></span>)
                </div>

                <?php foreach ($data['variants'] as $item) :
                    $variant_id = $item['id'];
                    $qty = $data['cart'][$variant_id];
                    // Logic giá
                    $price = ($item['price_sale'] > 0) ? $item['price_sale'] : $item['price'];
                    $total_item = $price * $qty;
                ?>
                    <div class="cart-item-card cart-item-row" data-variant-id="<?php echo $variant_id; ?>">
                        <div class="cart-item-image">
                            <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $item['product_id']; ?>">
                                <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($item['image']); ?>" alt="">
                            </a>
                        </div>

                        <div class="cart-item-info">
                            <h4>
                                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $item['product_id']; ?>">
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </a>
                            </h4>
                            <div class="item-specs">
                                Phân loại: <?php echo htmlspecialchars($item['storage']); ?> - <?php echo htmlspecialchars($item['color']); ?>
                            </div>

                            <div class="cart-item-price">
                                <?php echo number_format($price); ?> ₫
                                <?php if ($item['price_sale'] > 0): ?>
                                    <span class="price-original"><?php echo number_format($item['price']); ?> ₫</span>
                                <?php endif; ?>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 15px;">
                                <div class="quantity-selector" style="width: 100px;">
                                    <button type="button" class="qty-minus cart-qty-change">-</button>
                                    <input type="text" name="quantity[<?php echo $variant_id; ?>]" value="<?php echo $qty; ?>" readonly style="width: 30px; font-size: 0.9rem;">
                                    <button type="button" class="qty-plus cart-qty-change">+</button>
                                </div>

                                <div style="text-align: right;">
                                    <div style="font-weight: bold; color: #288ad6; margin-bottom: 5px;" id="item-total-<?php echo $variant_id; ?>">
                                        <?php echo number_format($total_item); ?> ₫
                                    </div>
                                    <a href="<?php echo URLROOT; ?>/cart/remove/<?php echo $variant_id; ?>" class="remove-from-cart-ajax" style="color: #999; font-size: 0.85rem; text-decoration: none;">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">

                <div class="order-summary-box" style="margin-bottom: 20px;">
                    <h3 style="font-size: 1.1rem; margin-bottom: 15px;"><i class="fas fa-ticket-alt"></i> Mã giảm giá</h3>
                    <form action="<?php echo URLROOT; ?>/cart/applyVoucher" method="POST" id="voucher-form" style="display: flex; gap: 10px;">
                        <input type="text" name="voucher_code"
                            placeholder="Nhập mã voucher"
                            value="<?php echo htmlspecialchars($data['voucher_code'] ?? ''); ?>"
                            style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; text-transform: uppercase;">
                        <button type="submit" style="background: #288ad6; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Áp dụng</button>
                    </form>
                    <div id="voucher-message-container">
                        <?php if (!empty($data['voucher_error'])): ?>
                            <p style="color: red; font-size: 0.9em; margin-top: 5px;"><?php echo $data['voucher_error']; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($data['voucher_code'])): ?>
                            <p style="color: green; font-size: 0.9em; margin-top: 5px;">Đang áp dụng mã: <strong><?php echo $data['voucher_code']; ?></strong></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="order-summary-box">
                    <div class="summary-row">
                        <span>Tạm tính:</span>
                        <span id="cart-subtotal"><?php echo number_format($data['subtotal']); ?> VNĐ</span>
                    </div>

                    <div class="summary-row" id="cart-discount-row" style="color: green; <?php echo ($data['voucher_discount'] > 0) ? '' : 'display: none;'; ?>">
                        <span>Giảm giá (<span id="cart-voucher-code"><?php echo $data['voucher_code']; ?></span>):</span>
                        <span id="cart-discount">- <?php echo number_format($data['voucher_discount']); ?> VNĐ</span>
                    </div>

                    <div class="summary-row total">
                        <span>Tổng cộng:</span>
                        <span class="total-price" id="cart-grand-total"><?php echo number_format($data['grand_total']); ?> VNĐ</span>
                    </div>
                    <div style="text-align: right; font-size: 0.8em; color: #777; margin-bottom: 15px;">(Đã bao gồm VAT)</div>

                    <a href="<?php echo URLROOT; ?>/checkout" class="btn-checkout">MUA HÀNG NGAY</a>
                    <a href="<?php echo URLROOT; ?>/product/all" class="continue-shopping" style="margin-top: 10px; display: block;">Tiếp tục chọn thêm</a>
                </div>

            </div>
        </div>
    <?php endif; ?>
</div>
