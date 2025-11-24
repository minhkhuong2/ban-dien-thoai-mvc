<div class="container" style="margin-top: 50px; margin-bottom: 80px; text-align: center;">

    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 50px 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">

        <div style="width: 80px; height: 80px; background: #e8f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto;">
            <i class="fas fa-check" style="font-size: 40px; color: #28a745;"></i>
        </div>

        <h1 style="color: #28a745; margin-bottom: 10px;">Đặt Hàng Thành Công!</h1>
        <p style="font-size: 1.1rem; color: #555;">Cảm ơn bạn đã mua sắm tại <strong><?php echo SITENAME; ?></strong></p>

        <div style="background: #f8f9fa; border: 1px dashed #28a745; padding: 20px; border-radius: 8px; margin: 30px 0;">
            <p style="margin: 0 0 10px 0;">Mã đơn hàng của bạn:</p>
            <strong style="font-size: 1.5rem; color: #333;">#<?php echo $data['orderId']; ?></strong>
            <p style="margin: 10px 0 0 0; font-size: 0.9rem; color: #777;">(Vui lòng lưu lại mã này để tra cứu)</p>
        </div>

        <p style="color: #555; margin-bottom: 30px; line-height: 1.6;">
            Chúng tôi đã gửi email xác nhận đơn hàng đến hộp thư của bạn.<br>
            Nhân viên sẽ sớm liên hệ để xác nhận thông tin giao hàng.
        </p>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="<?php echo URLROOT; ?>/user/orders" class="btn-buy" style="text-decoration: none; width: auto; padding: 12px 30px; background: #fff; border: 1px solid #288ad6; color: #288ad6;">
                Xem đơn hàng
            </a>
            <a href="<?php echo URLROOT; ?>/" class="btn-buy" style="text-decoration: none; width: auto; padding: 12px 30px;">
                Tiếp tục mua sắm
            </a>
        </div>

    </div>
</div>
