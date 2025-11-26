<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $data['title']; ?></h3>
        <a href="<?php echo URLROOT; ?>/admin/addVoucher" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tạo Voucher Mới
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Mã Code</th>
                    <th>Giảm giá</th>
                    <th>Đơn tối thiểu</th>
                    <th>Lượt dùng</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th class="text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['vouchers'] as $voucher) : ?>
                    <tr>
                        <td>
                            <strong style="color: var(--primary-color); border: 1px dashed var(--primary-color); padding: 4px 10px; border-radius: 6px; background-color: var(--primary-light); font-family: monospace; font-size: 1rem;">
                                <?php echo htmlspecialchars($voucher['code']); ?>
                            </strong>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-main);">
                                <?php if ($voucher['type'] == 'percent') : ?>
                                    <?php echo $voucher['value']; ?>%
                                <?php else : ?>
                                    <?php echo number_format($voucher['value']); ?> đ
                                <?php endif; ?>
                            </div>
                        </td>
                        <td><?php echo number_format($voucher['min_order_value']); ?> đ</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <span style="font-weight: 600;"><?php echo $voucher['usage_count']; ?></span>
                                <span style="color: var(--text-light);">/</span>
                                <span style="color: var(--text-light);"><?php echo ($voucher['usage_limit'] == 0) ? '∞' : $voucher['usage_limit']; ?></span>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem; color: var(--text-light);">
                                <?php
                                $start = $voucher['start_date'] ? date('d/m/Y', strtotime($voucher['start_date'])) : 'Tự do';
                                $end = $voucher['end_date'] ? date('d/m/Y', strtotime($voucher['end_date'])) : 'Vĩnh viễn';
                                echo "$start - $end";
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($voucher['is_active']) : ?>
                                <span class="badge badge-success">Hoạt động</span>
                            <?php else : ?>
                                <span class="badge badge-danger">Đã khóa</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-right">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="<?php echo URLROOT; ?>/admin/editVoucher/<?php echo $voucher['id']; ?>" class="btn-icon" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo URLROOT; ?>/admin/deleteVoucher/<?php echo $voucher['id']; ?>"
                                    class="btn-icon"
                                    title="Xóa"
                                    style="color: var(--danger-color); border-color: var(--danger-color);"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa mã này?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
