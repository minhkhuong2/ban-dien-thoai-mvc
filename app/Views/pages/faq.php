<!-- Gọi Header và Menu phụ -->
<?php require_once APPROOT . '/Views/pages/support_nav.php'; ?>

<!-- Nội dung Tab FAQ -->
<div class="support-content-box">
    <h3><?php echo $data['title']; ?></h3>
    <div class="faq-accordion">
        <details>
            <summary>Làm thế nào để kiểm tra bảo hành điện thoại?</summary>
            <div class="faq-answer">
                <p>Bạn có thể kiểm tra bảo hành bằng cách nhập số IMEI trên website của chúng tôi (trong mục Tài khoản) hoặc liên hệ hotline 1900 1234 để được hỗ trợ.</p>
            </div>
        </details>
        <details>
            <summary>Thời gian giao hàng là bao lâu?</summary>
            <div class="faq-answer">
                <p>Thời gian giao hàng nội thành TP.HCM là 2-4 giờ. Các tỉnh thành khác từ 1-3 ngày làm việc.</p>
            </div>
        </details>
        <details>
            <summary>Có hỗ trợ trả góp không?</summary>
            <div class="faq-answer">
                <p>Có, chúng tôi hỗ trợ trả góp 0% lãi suất qua thẻ tín dụng của nhiều ngân hàng liên kết, và trả góp qua các công ty tài chính.</p>
            </div>
        </details>
        <details>
            <summary>Sản phẩm có phải hàng chính hãng không?</summary>
            <div class="faq-answer">
                <p>100% sản phẩm tại PhoneStore là hàng chính hãng, nguyên seal, đầy đủ giấy tờ và bảo hành theo đúng tiêu chuẩn của nhà sản xuất.</p>
            </div>
        </details>
        <details>
            <summary>Làm sao để theo dõi đơn hàng?</summary>
            <div class="faq-answer">
                <p>Sau khi đăng nhập, bạn có thể vào mục "Tài khoản" -> "Lịch sử đơn hàng" để xem trạng thái chi tiết của đơn hàng.</p>
            </div>
        </details>
    </div>
</div>
