<h2><?php echo $data['title']; ?></h2>

<?php if (empty($data['orders'])) : ?>
    <p>Bạn chưa có đơn hàng nào.</p>
<?php else : ?>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f4f4f4;">
                <th style="padding: 10px; border: 1px solid #ccc;">Mã Đơn Hàng</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Ngày Đặt</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Tổng Tiền</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['orders'] as $order) : ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">
                        <a href="http://localhost/ban-dien-thoai-mvc/public/user/orderdetail/<?php echo $order['id']; ?>">
                            #<?php echo $order['id']; ?>
                        </a>
                    </td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <?php echo date('d-m-Y H:i', strtotime($order['order_date'])); ?>
                    </td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: right;">
                        <?php echo number_format($order['total_amount']); ?> VNĐ
                    </td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <?php
                        // Chuyển số 0, 1, 2... thành chữ
                        switch ($order['status']) {
                            case 0:
                                echo 'Chờ xử lý';
                                break;
                            case 1:
                                echo 'Đã xác nhận';
                                break;
                            case 2:
                                echo 'Đang giao';
                                break;
                            case 3:
                                echo 'Đã hoàn thành';
                                break;
                            case 4:
                                echo 'Đã hủy';
                                break;
                            default:
                                echo 'Không rõ';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
