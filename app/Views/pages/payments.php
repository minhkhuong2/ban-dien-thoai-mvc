<!-- Gọi Header và Menu phụ -->
<?php require_once APPROOT . '/Views/pages/support_nav.php'; ?>

<!-- Nội dung Tab Thanh toán -->
<div class="support-content-box">
    <h3><?php echo $data['title']; ?></h3>
    <div class="about-grid-2"> <!-- Tái sử dụng grid 2 cột -->
        <div class="feature-box" style="text-align: left;">
            <div class="feature-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M1 3h15v13H1z"></path>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg></div>
            <h4>Thanh toán khi nhận hàng (COD)</h4>
            <p>Khách hàng nhận hàng, kiểm tra sản phẩm và thanh toán tiền mặt trực tiếp cho nhân viên giao hàng.</p>
        </div>
        <div class="feature-box" style="text-align: left;">
            <div class="feature-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <line x1="2" y1="10" x2="22" y2="10"></line>
                </svg></div>
            <h4>Thẻ tín dụng/Thẻ ATM</h4>
            <p>Chấp nhận thanh toán qua Visa, Mastercard, JCB và thẻ ATM nội địa qua cổng thanh toán an toàn.</p>
        </div>
        <div class="feature-box" style="text-align: left;">
            <div class="feature-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M17 1H7c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zM7 19V5h10v14H7z"></path>
                    <path d="M12 18h.01"></path>
                </svg></div>
            <h4>Ví điện tử</h4>
            <p>Hỗ trợ thanh toán nhanh chóng và tiện lợi qua các ví điện tử phổ biến như Momo, ZaloPay, ShopeePay...</p>
        </div>
        <div class="feature-box" style="text-align: left;">
            <div class="feature-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M5 1v22h14V1H5zm12 17H7V6h10v12z"></path>
                    <path d="M10 10h4v2h-4z"></path>
                </svg></div>
            <h4>Trả góp 0%</h4>
            <p>Chúng tôi hỗ trợ trả góp 0% lãi suất qua thẻ tín dụng của nhiều ngân hàng liên kết.</p>
        </div>
    </div>
</div>
