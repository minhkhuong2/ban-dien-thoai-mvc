<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin_form.css">
<style>
    /* Tạm thời để CSS ở đây */
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
    <form action="<?php echo URLROOT; ?>/admin/addVoucher" method="POST">
        <div class="form-group">
            <label for="code">Mã Voucher (Ví dụ: SALE50K) <sup>*</sup></label>
            <input type="text" name="code" required style="text-transform: uppercase;">
        </div>

        <div class="form-grid-half">
            <div class="form-group">
                <label for="type">Loại giảm giá <sup>*</sup></label>
                <select name="type" required>
                    <option value="fixed">Trừ tiền cố định (VNĐ)</option>
                    <option value="percent">Giảm theo phần trăm (%)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Giá trị giảm <sup>*</sup></label>
                <input type="number" name="value" required placeholder="Ví dụ: 50000 hoặc 10">
            </div>
        </div>

        <div class="form-group">
            <label for="min_order_value">Giá trị đơn hàng tối thiểu (VNĐ)</label>
            <input type="number" name="min_order_value" value="0">
        </div>

        <div class="form-grid-half">
            <div class="form-group">
                <label for="start_date">Ngày bắt đầu (Để trống nếu áp dụng ngay)</label>
                <input type="datetime-local" name="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">Ngày hết hạn (Để trống nếu không hết hạn)</label>
                <input type="datetime-local" name="end_date">
            </div>
        </div>

        <div class="form-group">
            <label for="usage_limit">Số lần sử dụng tối đa (0 = không giới hạn)</label>
            <input type="number" name="usage_limit" value="1">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" checked> Kích hoạt voucher này?
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Voucher</button>
        <a href="<?php echo URLROOT; ?>/admin/vouchers" class="btn btn-secondary">Hủy</a>
    </form>
</div>
