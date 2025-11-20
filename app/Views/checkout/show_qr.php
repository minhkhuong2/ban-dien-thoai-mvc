<div class="static-page-container" style="max-width: 600px; margin: 40px auto; text-align: center;">

    <h1 style="color: #2ecc71; margin-bottom: 10px;">Đặt Hàng Thành Công!</h1>
    <p>Mã đơn hàng của bạn: <strong>#<?php echo $data['order']['id']; ?></strong></p>
    <p>Vui lòng quét mã QR dưới đây để thanh toán:</p>

    <hr style="margin: 20px 0; border-top: 1px dashed #ccc;">

    <?php
    // --- CẤU HÌNH TÀI KHOẢN NGÂN HÀNG CỦA BẠN ---
    $BANK_ID = '970436';               // Mã BIN của Vietcombank
    $ACCOUNT_NO = '1056405604';           // Số tài khoản của bạn
    $TEMPLATE = 'compact2';            // Giao diện QR
    $AMOUNT = $data['order']['total_amount'];
    $DESCRIPTION = 'THANHTOAN DON ' . $data['order']['id'];
    $ACCOUNT_NAME = 'BUI VAN KHUONG';    // Tên chủ tài khoản (không dấu)
    // ----------------------------------------------------

    // Link tạo QR tự động từ VietQR
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

    <div style="margin: 20px 0;">
        <img src="<?php echo $qr_url; ?>" alt="Mã QR Thanh Toán" style="max-width: 100%; border: 1px solid #ddd; border-radius: 10px;">
    </div>

    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; text-align: left; margin-bottom: 20px;">
        <p><strong>Ngân hàng:</strong> Vietcombank (NH TMCP Ngoai thuong VN)</p>
        <p><strong>Số tài khoản:</strong> <?php echo $ACCOUNT_NO; ?></p>

        <p><strong>Chủ tài khoản:</strong> <?php echo $ACCOUNT_NAME; ?></p>

        <p><strong>Số tiền:</strong> <span style="color: #e74c3c; font-weight: bold; font-size: 1.2em;"><?php echo number_format($AMOUNT); ?> VNĐ</span></p>
        <p><strong>Nội dung chuyển khoản:</strong> <span style="color: #3498db; font-weight: bold;"><?php echo $DESCRIPTION; ?></span></p>
    </div>

    <p style="font-size: 0.9rem; color: #777;">
        * Sau khi chuyển khoản thành công, hệ thống sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.
        <br>Bạn có thể xem lại đơn hàng trong mục "Lịch sử đơn hàng".
    </p>

    <br>
    <a href="<?php echo URLROOT; ?>/" class="btn btn-primary" style="text-decoration: none; display: inline-block;">Về Trang Chủ</a>
    <a href="<?php echo URLROOT; ?>/user/orders" class="btn btn-secondary" style="text-decoration: none; display: inline-block; margin-left: 10px;">Xem Đơn Hàng</a>

</div>
