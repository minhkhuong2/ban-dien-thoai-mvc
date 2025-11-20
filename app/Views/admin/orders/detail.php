<a href="<?php echo URLROOT; ?>/admin/orders" class="btn btn-secondary" style="margin-bottom: 20px;">&lt; Quay lại Danh sách</a>

<h2><?php echo $data['title']; ?></h2>

<div style="display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap;">

    <div style="flex: 2; min-width: 600px; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h4>Sản phẩm đã đặt</h4>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Phân loại hàng</th>
                    <th style="text-align: center;">SL</th>
                    <th style="text-align: right;">Đơn giá</th>
                    <th style="text-align: right;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['details'] as $item) : ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;">
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($item['variant_image']); ?>"
                                alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                        </td>
                        <td style="padding: 10px;">
                            <strong><?php echo htmlspecialchars($item['product_name']); ?></strong>
                        </td>
                        <td style="padding: 10px; color: #555;">
                            <?php echo htmlspecialchars($item['variant_name']); ?>
                        </td>
                        <td style="padding: 10px; text-align: center;">
                            <?php echo $item['quantity']; ?>
                        </td>
                        <td style="padding: 10px; text-align: right;">
                            <?php echo number_format($item['price']); ?> ₫
                        </td>
                        <td style="padding: 10px; text-align: right; font-weight: bold;">
                            <?php echo number_format($item['price'] * $item['quantity']); ?> ₫
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right; padding-top: 20px;"><strong>Tạm tính:</strong></td>
                    <td style="text-align: right; padding-top: 20px;">
                        <?php
                        // Tính ngược tạm tính
                        $subtotal = $data['order']['total_amount'] + $data['order']['voucher_discount'];
                        echo number_format($subtotal);
                        ?> ₫
                    </td>
                </tr>
                <?php if ($data['order']['voucher_discount'] > 0): ?>
                    <tr>
                        <td colspan="5" style="text-align: right; color: green;"><strong>Voucher (<?php echo $data['order']['voucher_code']; ?>):</strong></td>
                        <td style="text-align: right; color: green;">
                            -<?php echo number_format($data['order']['voucher_discount']); ?> ₫
                        </td>
                    </tr>
                <?php endif; ?>
                <tr style="font-size: 1.2em;">
                    <td colspan="5" style="text-align: right; padding-top: 10px;"><strong>TỔNG CỘNG:</strong></td>
                    <td style="text-align: right; padding-top: 10px; color: #e74c3c; font-weight: bold;">
                        <?php echo number_format($data['order']['total_amount']); ?> ₫
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div style="flex: 1; min-width: 300px;">

        <div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px;">
            <h4 style="margin-top: 0;">Xử lý đơn hàng</h4>
            <form action="<?php echo URLROOT; ?>/admin/orderdetail/<?php echo $data['order']['id']; ?>" method="POST">
                <div style="margin-bottom: 15px;">
                    <label for="status" style="font-weight: bold; display: block; margin-bottom: 5px;">Trạng thái:</label>
                    <select name="status" id="status" style="width: 100%; padding: 10px; font-size: 1rem; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="0" <?php echo ($data['order']['status'] == 0) ? 'selected' : ''; ?>>⏳ Chờ xử lý</option>
                        <option value="1" <?php echo ($data['order']['status'] == 1) ? 'selected' : ''; ?>>✅ Đã xác nhận</option>
                        <option value="2" <?php echo ($data['order']['status'] == 2) ? 'selected' : ''; ?>>🚚 Đang giao</option>
                        <option value="3" <?php echo ($data['order']['status'] == 3) ? 'selected' : ''; ?>>🎉 Đã hoàn thành</option>
                        <option value="4" <?php echo ($data['order']['status'] == 4) ? 'selected' : ''; ?>>❌ Đã hủy</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Cập nhật Trạng thái</button>
            </form>
        </div>

        <div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h4 style="margin-top: 0;">Thông tin giao hàng</h4>

            <p style="margin-bottom: 5px;"><strong>Người nhận:</strong><br> <?php echo htmlspecialchars($data['order']['full_name']); ?></p>

            <p style="margin-bottom: 5px;"><strong>Số điện thoại:</strong><br> <a href="tel:<?php echo htmlspecialchars($data['order']['phone']); ?>"><?php echo htmlspecialchars($data['order']['phone']); ?></a></p>

            <p style="margin-bottom: 15px;"><strong>Địa chỉ:</strong><br> <?php echo htmlspecialchars($data['order']['address']); ?></p>

            <hr style="border-top: 1px dashed #ddd;">

            <p style="margin-bottom: 5px;"><strong>Phương thức thanh toán:</strong></p>
            <?php if ($data['order']['payment_method'] == 'bank') : ?>
                <p><span style="background: #e8f0fe; color: #1967d2; padding: 3px 8px; border-radius: 4px; font-size: 0.9em; font-weight: bold;">🏦 Chuyển khoản Ngân hàng</span></p>
                <small style="color: #666;">(Kiểm tra tài khoản Vietcombank của bạn)</small>
            <?php elseif ($data['order']['payment_method'] == 'wallet') : ?>
                <p><span style="background: #fce8e6; color: #c5221f; padding: 3px 8px; border-radius: 4px; font-size: 0.9em; font-weight: bold;">📱 Ví điện tử</span></p>
            <?php else : ?>
                <p><span style="background: #e6f4ea; color: #137333; padding: 3px 8px; border-radius: 4px; font-size: 0.9em; font-weight: bold;">💵 Thanh toán khi nhận hàng (COD)</span></p>
            <?php endif; ?>

            <p style="margin-top: 10px; color: #777; font-size: 0.9em;">
                Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($data['order']['order_date'])); ?>
            </p>
        </div>
    </div>
</div>
