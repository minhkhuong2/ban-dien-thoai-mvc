<!-- Gọi Header và Menu phụ -->
<?php require_once APPROOT . '/Views/pages/support_nav.php'; ?>

<!-- Nội dung Tab Bảo hành -->
<div class="support-content-box">
    <h3><?php echo $data['title']; ?></h3>
    <h4>Thời gian bảo hành:</h4>
    <ul>
        <li>Điện thoại: 12 tháng.</li>
        <li>Phụ kiện: 6 tháng.</li>
        <li>Bảo hành 1 đổi 1 trong 7 ngày đầu.</li>
    </ul>
    <h4>Điều kiện bảo hành:</h4>
    <ul>
        <li>Sản phẩm còn trong thời gian bảo hành.</li>
        <li>Lỗi do nhà sản xuất, không phải lỗi người dùng.</li>
        <li>Tem bảo hành, số IMEI còn nguyên vẹn.</li>
    </ul>
    <h4>Quy trình bảo hành:</h4>
    <div class="shipping-steps">
        <div class="step-item">
            <div class="step-icon">1</div>
            <h5>Mang đến cửa hàng</h5>
        </div>
        <div class="step-item">
            <div class="step-icon">2</div>
            <h5>Tiếp nhận &amp; kiểm tra</h5>
        </div>
        <div class="step-item">
            <div class="step-icon">3</div>
            <h5>Sửa chữa/Thay thế</h5>
        </div>
        <div class="step-item">
            <div class="step-icon">4</div>
            <h5>Giao máy cho khách</h5>
        </div>
    </div>
</div>
