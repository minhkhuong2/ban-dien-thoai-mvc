<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $data['title']; ?></h3>
    </div>

    <div class="table-container">
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
                    <th class="text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['orders'])) : ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 32px; color: var(--text-light);">
                            Chưa có đơn hàng nào.
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['orders'] as $order) : ?>
                        <tr>
                            <td><strong>#<?php echo $order['id']; ?></strong></td>
                            <td>
                                <div style="font-weight: 600; color: var(--text-main);"><?php echo htmlspecialchars($order['full_name']); ?></div>
                            </td>
                            <td><?php echo htmlspecialchars($order['phone']); ?></td>
                            <td><span style="display: inline-block; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?php echo htmlspecialchars($order['address']); ?>"><?php echo htmlspecialchars($order['address']); ?></span></td>
                            <td style="font-weight: 600; color: var(--text-main);">
                                <?php echo number_format($order['total_amount']); ?> ₫
                            </td>
                            <td>
                                <div style="font-size: 0.85rem; color: var(--text-light);">
                                    <?php echo date('d/m/Y', strtotime($order['order_date'])); ?>
                                    <br>
                                    <?php echo date('H:i', strtotime($order['order_date'])); ?>
                                </div>
                            </td>

                            <td>
                                <?php
                                $badge_class = 'badge-warning';
                                $stt_text = 'Chờ xử lý';
                                switch ($order['status']) {
                                    case 0:
                                        $badge_class = 'badge-warning';
                                        $stt_text = 'Chờ xử lý';
                                        break;
                                    case 1:
                                        $badge_class = 'badge-info';
                                        $stt_text = 'Đã xác nhận';
                                        break;
                                    case 2:
                                        $badge_class = 'badge-info';
                                        $stt_text = 'Đang giao';
                                        break;
                                    case 3:
                                        $badge_class = 'badge-success';
                                        $stt_text = 'Hoàn thành';
                                        break;
                                    case 4:
                                        $badge_class = 'badge-danger';
                                        $stt_text = 'Đã hủy';
                                        break;
                                    default:
                                        $stt_text = 'Không rõ';
                                }
                                ?>
                                <span class="badge <?php echo $badge_class; ?>"><?php echo $stt_text; ?></span>
                            </td>

                            <td class="text-right">
                                <a href="<?php echo URLROOT; ?>/admin/orderdetail/<?php echo $order['id']; ?>" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.8rem;">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
