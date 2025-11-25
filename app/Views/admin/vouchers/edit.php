<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin_form.css">
<style>
    .form-container {
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-grid-half {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
</style>

<h2><?php echo $data['title']; ?></h2>

<div class="form-container">
    <?php $v = $data['voucher']; ?>

    <form action="<?php echo URLROOT; ?>/admin/editVoucher/<?php echo $v['id']; ?>" method="POST">
        <div class="form-group">
            <label for="code">Mã Voucher <sup>*</sup></label>
            <input type="text" name="code" required style="text-transform: uppercase;" value="<?php echo htmlspecialchars($v['code']); ?>">
        </div>

        <div class="form-grid-half">
            <div class="form-group">
                <label for="type">Loại giảm giá <sup>*</sup></label>
                <select name="type" required>
                    <option value="fixed" <?php echo ($v['type'] == 'fixed') ? 'selected' : ''; ?>>Trừ tiền cố định (VNĐ)</option>
                    <option value="percent" <?php echo ($v['type'] == 'percent') ? 'selected' : ''; ?>>Giảm theo phần trăm (%)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Giá trị giảm <sup>*</sup></label>
                <input type="number" name="value" required value="<?php echo $v['value']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="min_order_value">Giá trị đơn hàng tối thiểu (VNĐ)</label>
            <input type="number" name="min_order_value" value="<?php echo $v['min_order_value']; ?>">
        </div>

        <div class="form-grid-half">
            <div class="form-group">
                <label for="start_date">Ngày bắt đầu</label>
                <input type="datetime-local" name="start_date"
                    value="<?php echo $v['start_date'] ? date('Y-m-d\TH:i', strtotime($v['start_date'])) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="end_date">Ngày hết hạn</label>
                <input type="datetime-local" name="end_date"
                    value="<?php echo $v['end_date'] ? date('Y-m-d\TH:i', strtotime($v['end_date'])) : ''; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="usage_limit">Số lần sử dụng tối đa (0 = không giới hạn)</label>
            <input type="number" name="usage_limit" value="<?php echo $v['usage_limit']; ?>">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" <?php echo ($v['is_active'] == 1) ? 'checked' : ''; ?>>
                Kích hoạt voucher này?
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Voucher</button>
        <a href="<?php echo URLROOT; ?>/admin/vouchers" class="btn btn-secondary">Hủy</a>
    </form>
</div>
