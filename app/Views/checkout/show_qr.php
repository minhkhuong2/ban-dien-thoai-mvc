<div class="container" style="margin-top: 40px; margin-bottom: 60px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); overflow: hidden;">

        <div style="background: linear-gradient(135deg, #288ad6 0%, #0056b3 100%); padding: 30px; text-align: center; color: white;">
            <h2 style="margin: 0 0 10px 0;">Thanh Toán Chuyển Khoản</h2>
            <p style="margin: 0; opacity: 0.9;">Vui lòng quét mã QR bên dưới để hoàn tất đơn hàng</p>
        </div>

        <div style="padding: 30px; text-align: center;">

            <p style="font-size: 1.1rem; color: #555; margin-bottom: 20px;">
                Mã đơn hàng: <strong style="color: #288ad6;">#<?php echo $data['order']['id']; ?></strong>
            </p>

            <?php
            // CẤU HÌNH VIETQR
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

            <div style="border: 2px dashed #ddd; padding: 10px; display: inline-block; border-radius: 10px; margin-bottom: 20px;">
                <img src="<?php echo $qr_url; ?>" alt="Mã QR" style="max-width: 100%; width: 350px; display: block;">
            </div>

            <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; text-align: left; font-size: 0.95rem; line-height: 1.8;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                    <span style="color: #777;">Ngân hàng:</span>
                    <strong>Vietcombank</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                    <span style="color: #777;">Số tài khoản:</span>
                    <strong style="font-size: 1.1em;"><?php echo $ACCOUNT_NO; ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                    <span style="color: #777;">Chủ tài khoản:</span>
                    <strong><?php echo $ACCOUNT_NAME; ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                    <span style="color: #777;">Số tiền:</span>
                    <strong style="color: #d0021b; font-size: 1.2em;"><?php echo number_format($AMOUNT); ?> ₫</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #777;">Nội dung:</span>
                    <strong style="color: #288ad6;"><?php echo $DESCRIPTION; ?></strong>
                </div>
            </div>

            <p style="color: #999; font-size: 0.85rem; margin-top: 20px;">
                * Hệ thống sẽ tự động xử lý đơn hàng sau khi nhận được tiền.
            </p>

            <div style="margin-top: 30px; display: flex; gap: 15px;">
                <a href="<?php echo URLROOT; ?>/" class="btn-buy" style="text-decoration: none; flex: 1; background: #fff; color: #555; border: 1px solid #ddd;">
                    Về Trang Chủ
                </a>
                <a href="<?php echo URLROOT; ?>/user/orders" class="btn-buy" style="text-decoration: none; flex: 1;">
                    Tôi Đã Thanh Toán
                </a>
            </div>

        </div>
    </div>
</div>
