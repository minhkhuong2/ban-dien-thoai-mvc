<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2><?php echo $data['title']; ?></h2>
    <a href="<?php echo URLROOT; ?>/admin/addVoucher" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tạo Voucher Mới
    </a>
</div>

<table>
    <thead>
        <tr>
            <th>Mã Code</th>
            <th>Giảm giá</th>
            <th>Đơn tối thiểu</th>
            <th>Lượt dùng</th>
            <th>Thời gian</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['vouchers'] as $voucher) : ?>
            <tr>
                <td>
                    <strong style="color: #667eea; border: 1px dashed #667eea; padding: 3px 8px; border-radius: 4px;">
                        <?php echo htmlspecialchars($voucher['code']); ?>
                    </strong>
                </td>
                <td>
                    <?php if ($voucher['type'] == 'percent') : ?>
                        <?php echo $voucher['value']; ?>%
                    <?php else : ?>
                        <?php echo number_format($voucher['value']); ?> đ
                    <?php endif; ?>
                </td>
                <td><?php echo number_format($voucher['min_order_value']); ?> đ</td>
                <td>
                    <?php echo $voucher['usage_count']; ?> /
                    <?php echo ($voucher['usage_limit'] == 0) ? '∞' : $voucher['usage_limit']; ?>
                </td>
                <td style="font-size: 0.9em;">
                    <?php
                    $start = $voucher['start_date'] ? date('d/m/Y', strtotime($voucher['start_date'])) : 'Tự do';
                    $end = $voucher['end_date'] ? date('d/m/Y', strtotime($voucher['end_date'])) : 'Vĩnh viễn';
                    echo "$start - $end";
                    ?>
                </td>
                <td>
                    <?php if ($voucher['is_active']) : ?>
                        <span style="color: green; font-weight: bold;">Hoạt động</span>
                    <?php else : ?>
                        <span style="color: red;">Đã khóa</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
