<div class="checkout-page-layout">

    <div class="checkout-form-section">
        <form action="<?php echo URLROOT; ?>/checkout" method="POST" id="checkout-form">

            <h3>Thông tin giao hàng</h3>
            <div class="form-grid-half">
                <div class="form-group">
                    <label for="full_name">Họ và tên <sup>*</sup></label>
                    <input type="text" name="full_name" value="<?php echo htmlspecialchars($data['user']['full_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại <sup>*</sup></label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($data['user']['phone']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email <sup>*</sup></label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['user']['email']); ?>" required>
            </div>
            <div class="form-grid-half">
                <div class="form-group">
                    <label for="city">Tỉnh/Thành phố <sup>*</sup></label>
                    <input type="text" name="city" required placeholder="Ví dụ: TP. Hồ Chí Minh">
                </div>
                <div class="form-group">
                    <label for="district">Quận/Huyện <sup>*</sup></label>
                    <input type="text" name="district" required placeholder="Ví dụ: Quận 1">
                </div>
            </div>
            <div class="form-grid-half">
                <div class="form-group">
                    <label for="ward">Phường/Xã <sup>*</sup></label>
                    <input type="text" name="ward" required placeholder="Ví dụ: Phường Bến Nghé">
                </div>
                <div class="form-group">
                    <label for="address_detail">Địa chỉ cụ thể <sup>*</sup></label>
                    <input type="text" name="address_detail" required placeholder="Số nhà, tên đường...">
                </div>
            </div>
            <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea name="note" placeholder="Ghi chú thêm cho đơn hàng (tùy chọn)"></textarea>
            </div>

            <h3 style="margin-top: 30px;">Phương thức vận chuyển</h3>
            <div class="radio-group">
                <div class="radio-option">
                    <label>
                        <input type="radio" name="shipping_method" value="standard" checked>
                        Giao hàng tiêu chuẩn
                        <span class="option-price">Miễn phí</span>
                    </label>
                </div>
                <div class="radio-option">
                    <label>
                        <input type="radio" name="shipping_method" value="fast">
                        Giao hàng nhanh
                        <span class="option-price">30.000 VNĐ</span>
                    </label>
                </div>
            </div>

            <h3 style="margin-top: 30px;">Phương thức thanh toán</h3>
            <div class="radio-group">
                <div class="radio-option">
                    <label>
                        <input type="radio" name="payment_method" value="cod" checked>
                        Thanh toán khi nhận hàng (COD)
                    </label>
                </div>
                <div class="radio-option">
                    <label>
                        <input type="radio" name="payment_method" value="bank">
                        Chuyển khoản ngân hàng (Quét mã QR)
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-checkout" style="width: 100%; margin-top: 20px; display: none;">Đặt hàng</button>

        </form>
    </div>

    <aside class="order-summary-box">
        <h3>Đơn hàng của bạn</h3>

        <div class="summary-item-list">
            <?php foreach ($data['cart_items'] as $item) : ?>
                <?php $quantity = $data['cart_data'][$item['id']]; ?>
                <div class="summary-item-in-cart">
                    <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($item['image']); ?>" alt="">
                    <div class="summary-item-info">
                        <span><?php echo htmlspecialchars($item['product_name']); ?></span>
                        <small><?php echo htmlspecialchars($item['name']); ?> x <?php echo $quantity; ?></small>
                    </div>
                    <div class="summary-item-price">
                        <?php $price = ($item['price_sale'] > 0) ? $item['price_sale'] : $item['price']; ?>
                        <?php echo number_format($price * $quantity); ?> VNĐ
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr>

        <div class="summary-row">
            <span>Tạm tính:</span>
            <span id="checkout-subtotal"><?php echo number_format($data['subtotal']); ?> VNĐ</span>
        </div>

        <?php if ($data['voucher_discount'] > 0) : ?>
            <div class="summary-row" style="color: green;">
                <span>Giảm giá:</span>
                <span id="checkout-discount">- <?php echo number_format($data['voucher_discount']); ?> VNĐ</span>
            </div>
        <?php else: ?>
            <span id="checkout-discount" style="display:none;">0 VNĐ</span>
        <?php endif; ?>

        <div class="summary-row">
            <span>Phí vận chuyển:</span>
            <span id="checkout-shipping-fee" style="color: green;">Miễn phí</span>
        </div>

        <div class="summary-row total">
            <span>Tổng cộng:</span>
            <span class="total-price" id="checkout-total"><?php echo number_format($data['grand_total']); ?> VNĐ</span>
        </div>

        <button type="submit" form="checkout-form" class="btn-checkout" style="width: 100%;">
            Đặt Hàng
        </button>
        <a href="<?php echo URLROOT; ?>/cart" class="continue-shopping" style="margin-top: 10px;">
            ← Quay lại Giỏ hàng
        </a>
    </aside>
</div>
