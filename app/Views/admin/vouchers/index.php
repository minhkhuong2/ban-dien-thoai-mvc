<h2><?php echo $data['title']; ?></h2>

<a href="<?php echo URLROOT; ?>/admin/addVoucher" class="btn btn-success">
    + Thêm Voucher mới
</a>

<table>
    <thead>
        <tr>
            <th>Mã Code</th>
            <th>Loại</th>
            <th>Giá trị</th>
            <th>Đơn tối thiểu</th>
            <th>Ngày hết hạn</th>
            <th>Giới hạn</th>
            <th>Đã dùng</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($data['vouchers'])) : ?>
            <tr>
                <td colspan="8" style="text-align: center;">Chưa có voucher nào.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($data['vouchers'] as $voucher) : ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($voucher['code']); ?></strong></td>
                    <td><?php echo ($voucher['type'] == 'percent') ? '%' : 'VNĐ'; ?></td>
                    <td><?php echo number_format($voucher['value']); ?></td>
                    <td><?php echo number_format($voucher['min_order_value']); ?></td>
                    <td><?php echo $voucher['end_date'] ? date('d-m-Y', strtotime($voucher['end_date'])) : 'Không giới hạn'; ?></td>
                    <td><?php echo $voucher['usage_limit'] == 0 ? '∞' : $voucher['usage_limit']; ?></td>
                    <td><?php echo $voucher['usage_count']; ?></td>
                    <td><?php echo $voucher['is_active'] ? '<span style="color: green;">Hoạt động</span>' : '<span style="color: gray;">Ngừng</span>'; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
