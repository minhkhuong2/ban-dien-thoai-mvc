<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<div class="card" style="max-width: 800px;">
    <div class="card-header">
        <h4 class="card-title">Tạo mã giảm giá mới</h4>
    </div>
    <form action="<?php echo URLROOT; ?>/admin/addVoucher" method="POST">
        <div style="padding: 24px;">
            <div class="form-group">
                <label class="form-label">Mã Voucher (Ví dụ: SALE50K) <span style="color: var(--danger-color);">*</span></label>
                <input type="text" name="code" required style="text-transform: uppercase;" class="form-control" placeholder="Nhập mã voucher...">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
                <div class="form-group">
                    <label class="form-label">Loại giảm giá <span style="color: var(--danger-color);">*</span></label>
                    <select name="type" required class="form-control">
                        <option value="fixed">Trừ tiền cố định (VNĐ)</option>
                        <option value="percent">Giảm theo phần trăm (%)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Giá trị giảm <span style="color: var(--danger-color);">*</span></label>
                    <input type="number" name="value" required placeholder="Ví dụ: 50000 hoặc 10" class="form-control">
                </div>
            </div>

            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                <input type="number" name="min_order_value" value="0" class="form-control">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
                <div class="form-group">
                    <label class="form-label">Ngày bắt đầu (Để trống nếu áp dụng ngay)</label>
                    <input type="datetime-local" name="start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Ngày hết hạn (Để trống nếu không hết hạn)</label>
                    <input type="datetime-local" name="end_date" class="form-control">
                </div>
            </div>

            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Số lần sử dụng tối đa (0 = không giới hạn)</label>
                <input type="number" name="usage_limit" value="1" class="form-control">
            </div>

            <div class="form-group" style="margin-top: 24px;">
                <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" checked style="width: 20px; height: 20px;">
                    <span style="font-weight: 600; color: var(--text-main);">Kích hoạt voucher này ngay sau khi tạo?</span>
                </label>
            </div>
        </div>

        <div style="padding: 24px; border-top: 1px solid var(--border-color); background-color: var(--bg-color); border-radius: 0 0 var(--radius-lg) var(--radius-lg); display: flex; gap: 16px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Lưu Voucher
            </button>
            <a href="<?php echo URLROOT; ?>/admin/vouchers" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>
