<!-- File: app/Views/pages/support_nav.php -->
<div class="support-header-banner">
    <h1>Hỗ Trợ Khách Hàng</h1>
    <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn với mọi thắc mắc về sản phẩm và dịch vụ</p>
</div>

<div class="support-sub-nav">
    <!-- Kiểm tra $data['title'] để active đúng tab -->
    <a href="<?php echo URLROOT; ?>/page/warranty"
        class="<?php echo (strpos($data['title'], 'Bảo hành') !== false) ? 'active' : ''; ?>">
        Chính sách bảo hành
    </a>
    <a href="<?php echo URLROOT; ?>/page/returns"
        class="<?php echo (strpos($data['title'], 'Đổi trả') !== false) ? 'active' : ''; ?>">
        Chính sách đổi mới
    </a>
    <a href="<?php echo URLROOT; ?>/page/shipping"
        class="<?php echo (strpos($data['title'], 'Mua hàng') !== false) ? 'active' : ''; ?>">
        Hướng dẫn mua hàng
    </a>
    <a href="<?php echo URLROOT; ?>/page/payments"
        class="<?php echo (strpos($data['title'], 'Thanh toán') !== false) ? 'active' : ''; ?>">
        Phương thức thanh toán
    </a>
    <a href="<?php echo URLROOT; ?>/page/faq"
        class="<?php echo (strpos($data['title'], 'FAQ') !== false) ? 'active' : ''; ?>">
        Tư vấn (FAQ)
    </a>
</div>
