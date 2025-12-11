<div class="promo-header-banner">
    <h1>Săn Voucher & Ưu Đãi Khủng</h1>
    <p>Hàng ngàn mã giảm giá và deal hot đang chờ bạn</p>
</div>

<div class="container">

    <h2 class="section-title" style="text-align: center; margin-bottom: 30px;">🎟️ Mã Giảm Giá Độc Quyền</h2>

    <div class="voucher-grid">
        <?php if (empty($data['vouchers'])) : ?>
            <p style="text-align: center; width: 100%; color: #777;">Hiện tại chưa có mã giảm giá nào.</p>
        <?php else : ?>
            <?php foreach ($data['vouchers'] as $vc) : ?>
                <div class="voucher-ticket">
                    <div class="voucher-left">
                        <span class="voucher-icon">%</span>
                    </div>
                    <div class="voucher-right">
                        <div class="voucher-code"><?php echo htmlspecialchars($vc['code']); ?></div>
                        <div class="voucher-desc">
                            Giảm
                            <?php echo ($vc['type'] == 'percent') ? $vc['value'] . '%' : number_format($vc['value']) . 'đ'; ?>
                            <br>
                            <small>Đơn tối thiểu: <?php echo number_format($vc['min_order_value']); ?>đ</small>
                        </div>
                        <div class="voucher-action">
                            <button class="btn-copy-code" onclick="copyToClipboard('<?php echo $vc['code']; ?>')">Sao chép</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Deal Sốc section removed by user request -->

</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Đã sao chép mã: ' + text + '\nHãy dùng ở bước thanh toán!');
        }, function(err) {
            console.error('Lỗi: ', err);
        });
    }
</script>

<style>
    .voucher-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .voucher-ticket {
        display: flex;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
    }

    .voucher-ticket:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .voucher-left {
        width: 80px;
        background: linear-gradient(135deg, #ff9f00 0%, #ff6f00 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        border-right: 2px dashed #fff;
        position: relative;
    }

    .voucher-right {
        flex: 1;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .voucher-code {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .voucher-desc {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .btn-copy-code {
        background: #288ad6;
        color: #fff;
        border: none;
        padding: 5px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.85rem;
        width: fit-content;
    }

    .btn-copy-code:hover {
        background: #1b6cb8;
    }
</style>
