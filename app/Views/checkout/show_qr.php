<div class="container" style="margin-top: 50px; margin-bottom: 80px;">

    <div class="qr-payment-card">

        <div class="qr-header">
            <div class="timer-badge">
                Hết hạn sau <span id="countdown-timer">15:00</span>
            </div>
            <div class="amount-display">
                <?php echo number_format($data['order']['total_amount']); ?> ₫
            </div>
        </div>

        <div class="qr-alert">
            <i class="fas fa-info-circle"></i>
            <span>Vui lòng nhập chính xác số tiền và nội dung chuyển khoản để hệ thống kích hoạt tự động.</span>
        </div>

        <?php
        $BANK_ID = '970436'; // Vietcombank
        $ACCOUNT_NO = '1056405604';
        $TEMPLATE = 'compact2';
        $AMOUNT = $data['order']['total_amount'];
        $DESCRIPTION = 'THANHTOAN DON ' . $data['order']['id'];
        $ACCOUNT_NAME = 'BUI VAN KHUONG';

        $qr_url = sprintf(
            "https://img.vietqr.io/image/%s-%s-%s.png?amount=%s&addInfo=%s&accountName=%s",
            $BANK_ID,
            $ACCOUNT_NO,
            $TEMPLATE,
            $AMOUNT,
            urlencode($DESCRIPTION),
            urlencode($ACCOUNT_NAME)
        );
        ?>

        <div class="qr-image-box">
            <img src="<?php echo $qr_url; ?>" alt="QR Code">
            <p>Quét mã bằng ứng dụng Ngân hàng / Ví điện tử</p>
        </div>

        <div class="qr-details">
            <div class="detail-row">
                <span class="label">Ngân hàng</span>
                <span class="value">Vietcombank</span>
            </div>
            <div class="detail-row">
                <span class="label">Số tài khoản</span>
                <span class="value copyable" onclick="copyToClipboard('<?php echo $ACCOUNT_NO; ?>')">
                    <?php echo $ACCOUNT_NO; ?> <i class="far fa-copy"></i>
                </span>
            </div>
            <div class="detail-row">
                <span class="label">Chủ tài khoản</span>
                <span class="value text-uppercase"><?php echo $ACCOUNT_NAME; ?></span>
            </div>
            <div class="detail-row highlight">
                <span class="label">Số tiền</span>
                <span class="value money copyable" onclick="copyToClipboard('<?php echo $AMOUNT; ?>')">
                    <?php echo number_format($AMOUNT); ?> ₫ <i class="far fa-copy"></i>
                </span>
            </div>
            <div class="detail-row highlight">
                <span class="label">Nội dung</span>
                <span class="value content copyable" onclick="copyToClipboard('<?php echo $DESCRIPTION; ?>')">
                    <?php echo $DESCRIPTION; ?> <i class="far fa-copy"></i>
                </span>
            </div>

            <div class="status-row">
                <div class="spinner"></div> Đang chờ thanh toán...
            </div>
        </div>

        <div class="qr-actions">
            <a href="<?php echo URLROOT; ?>/" class="btn-cancel">Hủy giao dịch</a>
            <a href="<?php echo URLROOT; ?>/user/orders" class="btn-confirm"
                onclick="return confirm('Bạn xác nhận đã chuyển khoản thành công? Chúng tôi sẽ kiểm tra và xử lý đơn hàng ngay.');">
                Tôi đã chuyển tiền
            </a>
        </div>

    </div>
</div>

<style>
    .qr-payment-card {
        max-width: 450px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #f0f0f0;
    }

    .qr-header {
        background: #f8f9fa;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
    }

    .timer-badge {
        color: #e74c3c;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .amount-display {
        font-size: 1.2rem;
        font-weight: bold;
        color: #288ad6;
    }

    .qr-alert {
        background: #fff8e1;
        color: #f39c12;
        font-size: 0.85rem;
        padding: 12px 20px;
        display: flex;
        gap: 10px;
        align-items: center;
        line-height: 1.4;
    }

    .qr-image-box {
        text-align: center;
        padding: 30px 20px 10px;
    }

    .qr-image-box img {
        width: 220px;
        border-radius: 8px;
        border: 1px solid #eee;
        padding: 10px;
    }

    .qr-image-box p {
        color: #888;
        font-size: 0.85rem;
        margin-top: 10px;
    }

    .qr-details {
        padding: 10px 25px 25px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.95rem;
        color: #555;
    }

    .detail-row .value {
        font-weight: 600;
        color: #333;
        text-align: right;
    }

    .detail-row.highlight {
        background: #f0f7ff;
        padding: 10px;
        border-radius: 6px;
        align-items: center;
        margin-bottom: 8px;
    }

    .detail-row.highlight .value {
        color: #288ad6;
    }

    .copyable {
        cursor: pointer;
        transition: 0.2s;
    }

    .copyable:hover {
        color: #1b6cb8;
    }

    .copyable i {
        font-size: 0.85rem;
        margin-left: 5px;
        color: #aaa;
    }

    .status-row {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #eee;
        text-align: center;
        color: #f39c12;
        font-weight: 600;
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .qr-actions {
        display: flex;
        gap: 10px;
        padding: 20px;
        border-top: 1px solid #eee;
    }

    .btn-cancel,
    .btn-confirm {
        flex: 1;
        padding: 12px;
        text-align: center;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-cancel {
        background: #f1f1f1;
        color: #555;
    }

    .btn-cancel:hover {
        background: #e0e0e0;
    }

    .btn-confirm {
        background: #288ad6;
        color: #fff;
    }

    .btn-confirm:hover {
        background: #1b6cb8;
    }

    .spinner {
        width: 16px;
        height: 16px;
        border: 2px solid #f39c12;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    // Đếm ngược 15 phút
    let timeLeft = 15 * 60;
    const timerEl = document.getElementById('countdown-timer');

    const countdown = setInterval(() => {
        const m = Math.floor(timeLeft / 60);
        const s = timeLeft % 60;
        timerEl.textContent = `${m}:${s < 10 ? '0' : ''}${s}`;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            timerEl.textContent = "00:00";
            alert("Giao dịch đã hết hạn!");
            window.location.href = "<?php echo URLROOT; ?>";
        }
        timeLeft--;
    }, 1000);

    // Hàm Copy
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Đã sao chép: ' + text);
        });
    }
</script>
