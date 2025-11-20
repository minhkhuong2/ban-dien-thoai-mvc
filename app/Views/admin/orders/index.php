<h2><?php echo $data['title']; ?></h2>

<table>
    <thead>
        <tr>
            <th>Mã ĐH</th>
            <th>Tên Khách hàng</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($data['orders'])) : ?>
            <tr>
                <td colspan="8" style="text-align: center;">Chưa có đơn hàng nào.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($data['orders'] as $order) : ?>
                <tr>
                    <td><strong>#<?php echo $order['id']; ?></strong></td>
                    <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['phone']); ?></td>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                    <td style="text-align: right; color: #e74c3c; font-weight: bold;">
                        <?php echo number_format($order['total_amount']); ?> VNĐ
                    </td>
                    <td><?php echo date('d-m-Y H:i', strtotime($order['order_date'])); ?></td>

                    <td>
                        <?php
                        // Chuyển số 0, 1, 2... thành chữ
                        switch ($order['status']) {
                            case 0:
                                echo '<span style="color: #f39c12;">Chờ xử lý</span>';
                                break;
                            case 1:
                                echo '<span style="color: #2980b9;">Đã xác nhận</span>';
                                break;
                            case 2:
                                echo '<span style="color: #3498db;">Đang giao</span>';
                                break;
                            case 3:
                                echo '<span style="color: #2ecc71;">Đã hoàn thành</span>';
                                break;
                            case 4:
                                echo '<span style="color: #e74c3c;">Đã hủy</span>';
                                break;
                            default:
                                echo 'Không rõ';
                        }
                        ?>
                    </td>

                    <td class="action-links">
                        <a href="<?php echo URLROOT; ?>/admin/orderdetail/<?php echo $order['id']; ?>">
                            Xem
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
