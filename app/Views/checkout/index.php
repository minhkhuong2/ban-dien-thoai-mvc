<div class="page-title-header">
    <h1>Thanh Toán & Đặt Hàng</h1>
</div>

<div class="container">

    <form action="<?php echo URLROOT; ?>/checkout" method="POST" id="checkout-form">
        <div class="cart-page-layout">
            <div class="checkout-left">

                <div class="checkout-form-section" style="margin-bottom: 20px;">
                    <h3><i class="fas fa-map-marker-alt"></i> Thông tin giao hàng</h3>

                    <div class="form-group">
                        <label>Họ và tên người nhận <sup>*</sup></label>
                        <input type="text" name="full_name" required
                            value="<?php echo htmlspecialchars($data['user']['full_name'] ?? ''); ?>">
                    </div>

                    <div class="form-grid-half">
                        <div class="form-group">
                            <label>Email <sup>*</sup></label>
                            <input type="email" name="email" required
                                value="<?php echo htmlspecialchars($data['user']['email'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại <sup>*</sup></label>
                            <input type="text" name="phone" required
                                value="<?php echo htmlspecialchars($data['user']['phone'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ chi tiết (Số nhà, tên đường...) <sup>*</sup></label>
                        <input type="text" name="address_detail" required placeholder="Ví dụ: 123 Nguyễn Huệ"
                            value="<?php echo htmlspecialchars($data['user']['address'] ?? ''); ?>">
                    </div>

                    <div class="form-grid-3" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                        <div class="form-group">
                            <label>Tỉnh / Thành phố</label>
                            <input type="text" name="city" required placeholder="Hà Nội / TP.HCM...">
                        </div>
                        <div class="form-group">
                            <label>Quận / Huyện</label>
                            <input type="text" name="district" required placeholder="Quận 1...">
                        </div>
                        <div class="form-group">
                            <label>Phường / Xã</label>
                            <input type="text" name="ward" required placeholder="Phường Bến Nghé...">
                        </div>
                    </div>
                </div>

                <div class="checkout-form-section" style="margin-bottom: 20px;">
                    <h3><i class="fas fa-truck"></i> Vận chuyển</h3>
                    <div class="radio-group">
                        <div class="radio-option">
                            <label>
                                <span>
                                    <input type="radio" name="shipping_method" value="standard" checked>
                                    Giao hàng tiêu chuẩn (3-5 ngày)
                                </span>
                                <span style="color: green; font-weight: bold;">Miễn phí</span>
                            </label>
                        </div>
                        <div class="radio-option">
                            <label>
                                <span>
                                    <input type="radio" name="shipping_method" value="fast">
                                    Giao hàng nhanh hỏa tốc (1-2 ngày)
                                </span>
                                <span style="color: #333; font-weight: bold;">30.000 ₫</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="checkout-form-section">
                    <h3><i class="fas fa-credit-card"></i> Thanh toán</h3>
                    <div class="radio-group">
                        <div class="radio-option">
                            <label>
                                <span>
                                    <input type="radio" name="payment_method" value="cod" checked>
                                    <i class="fas fa-money-bill-wave" style="margin-right: 5px; color: green;"></i>
                                    Thanh toán khi nhận hàng (COD)
                                </span>
                            </label>
                        </div>
                        <div class="radio-option">
                            <label>
                                <span>
                                    <input type="radio" name="payment_method" value="bank">
                                    <i class="fas fa-qrcode" style="margin-right: 5px; color: #288ad6;"></i>
                                    Chuyển khoản ngân hàng (Quét mã QR)
                                </span>
                            </label>
                        </div>
                        <div class="radio-option">
                            <label>
                                <span>
                                    <input type="radio" name="payment_method" value="wallet">
                                    <i class="fas fa-wallet" style="margin-right: 5px; color: #d63384;"></i>
                                    Ví điện tử (Momo / ZaloPay)
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="cart-summary">
                <div class="order-summary-box">
                    <h3>Đơn hàng của bạn</h3>

                    <div class="checkout-items" style="max-height: 300px; overflow-y: auto; margin-bottom: 20px; padding-right: 5px;">
                        <?php foreach ($data['cart_items'] as $item) :
                            $variant_id = $item['id'];
                            $qty = $data['cart_data'][$variant_id];
                            $price = ($item['price_sale'] > 0) ? $item['price_sale'] : $item['price'];
                        ?>
                            <div style="display: flex; gap: 10px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                <div style="width: 60px; height: 60px; border: 1px solid #eee; border-radius: 4px; flex-shrink: 0;">
                                    <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($item['image']); ?>"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div style="flex-grow: 1;">
                                    <div style="font-size: 0.9rem; font-weight: bold; margin-bottom: 3px;">
                                        <?php echo htmlspecialchars($item['product_name']); ?>
                                    </div>
                                    <div style="font-size: 0.85rem; color: #777;">
                                        <?php echo htmlspecialchars($item['storage']); ?> / <?php echo htmlspecialchars($item['color']); ?>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; font-size: 0.9rem; margin-top: 5px;">
                                        <span>SL: <?php echo $qty; ?></span>
                                        <span style="font-weight: bold; color: #e74c3c;"><?php echo number_format($price * $qty); ?> ₫</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="summary-row">
                        <span>Tạm tính:</span>
                        <span id="checkout-subtotal"><?php echo number_format($data['subtotal']); ?> VNĐ</span>
                    </div>

                    <?php if ($data['voucher_discount'] > 0): ?>
                        <div class="summary-row" style="color: green;">
                            <span>Giảm giá:</span>
                            <span id="checkout-discount"><?php echo number_format($data['voucher_discount']); ?> VNĐ</span>
                        </div>
                    <?php endif; ?>

                    <div class="summary-row">
                        <span>Phí vận chuyển:</span>
                        <span id="checkout-shipping-fee" style="color: green; font-weight: bold;">Miễn phí</span>
                    </div>

                    <div class="summary-row total">
                        <span>Tổng thanh toán:</span>
                        <span class="total-price" id="checkout-total"><?php echo number_format($data['grand_total']); ?> VNĐ</span>
                    </div>

                    <button type="submit" class="btn-checkout" style="margin-top: 20px;">
                        ĐẶT HÀNG NGAY
                    </button>

                    <p style="text-align: center; font-size: 0.85rem; color: #777; margin-top: 10px;">
                        Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý với <a href="#">điều khoản dịch vụ</a> của chúng tôi.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>
