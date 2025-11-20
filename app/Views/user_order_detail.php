<a href="<?php echo URLROOT; ?>/user/orders" style="display: inline-block; margin-bottom: 20px; text-decoration: none; color: #555;">
    &larr; Quay lại Lịch sử đơn hàng
</a>

<div class="static-page-container">
    <h2 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px;">
        Chi tiết Đơn hàng #<?php echo $data['order']['id']; ?>
    </h2>

    <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 30px; margin-bottom: 30px;">
        <div style="flex: 1; min-width: 250px;">
            <h4 style="border-bottom: 1px solid #eee; padding-bottom: 10px;">Thông tin đơn hàng</h4>
            <p><strong>Ngày đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($data['order']['order_date'])); ?></p>
            <p><strong>Trạng thái:</strong>
                <?php
                switch ($data['order']['status']) {
                    case 0:
                        echo '<span style="color: orange; font-weight: bold;">Chờ xử lý</span>';
                        break;
                    case 1:
                        echo '<span style="color: blue; font-weight: bold;">Đã xác nhận</span>';
                        break;
                    case 2:
                        echo '<span style="color: purple; font-weight: bold;">Đang giao</span>';
                        break;
                    case 3:
                        echo '<span style="color: green; font-weight: bold;">Hoàn thành</span>';
                        break;
                    case 4:
                        echo '<span style="color: red; font-weight: bold;">Đã hủy</span>';
                        break;
                }
                ?>
            </p>
            <p><strong>Phương thức thanh toán:</strong>
                <?php
                if ($data['order']['payment_method'] == 'cod') echo 'Thanh toán khi nhận hàng (COD)';
                elseif ($data['order']['payment_method'] == 'bank') echo 'Chuyển khoản ngân hàng';
                else echo 'Ví điện tử';
                ?>
            </p>
            <p><strong>Phương thức vận chuyển:</strong>
                <?php echo ($data['order']['shipping_method'] == 'fast') ? 'Giao hàng nhanh' : 'Tiêu chuẩn'; ?>
            </p>
        </div>

        <div style="flex: 1; min-width: 250px; background: #f9f9f9; padding: 15px; border-radius: 5px;">
            <h4 style="margin-top: 0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Địa chỉ giao hàng</h4>
            <p><strong>Người nhận:</strong> <?php echo htmlspecialchars($data['order']['full_name']); ?></p>
            <p><strong>SĐT:</strong> <?php echo htmlspecialchars($data['order']['phone']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($data['order']['email']); ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($data['order']['address']); ?></p>
        </div>
    </div>

    <h4 style="border-bottom: 2px solid #333; padding-bottom: 10px;">Sản phẩm đã mua</h4>
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <thead>
            <tr style="background: #f4f4f4; text-align: left;">
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Sản phẩm</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd; text-align: center;">SL</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd; text-align: right;">Đơn giá</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd; text-align: right;">Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['details'] as $item) : ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <img src="<?php echo URLROOT . '/uploads/' . htmlspecialchars($item['variant_image']); ?>"
                                alt="" style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #ddd; border-radius: 4px;">
                            <div>
                                <strong><?php echo htmlspecialchars($item['product_name']); ?></strong>
                                <br>
                                <small style="color: #777;"><?php echo htmlspecialchars($item['variant_name']); ?></small>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 10px; text-align: center;"><?php echo $item['quantity']; ?></td>
                    <td style="padding: 10px; text-align: right;"><?php echo number_format($item['price']); ?> ₫</td>
                    <td style="padding: 10px; text-align: right; font-weight: bold;"><?php echo number_format($item['price'] * $item['quantity']); ?> ₫</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <?php if ($data['order']['voucher_discount'] > 0): ?>
                <tr>
                    <td colspan="3" style="text-align: right; padding: 10px; color: green;">Giảm giá (<?php echo $data['order']['voucher_code']; ?>):</td>
                    <td style="text-align: right; padding: 10px; color: green;">-<?php echo number_format($data['order']['voucher_discount']); ?> ₫</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="3" style="text-align: right; padding: 10px; font-size: 1.2em;"><strong>TỔNG CỘNG:</strong></td>
                <td style="text-align: right; padding: 10px; font-size: 1.2em; color: #e74c3c; font-weight: bold;">
                    <?php echo number_format($data['order']['total_amount']); ?> ₫
                </td>
            </tr>
        </tfoot>
    </table>
</div>
