<!-- Gọi Header và Menu phụ -->
<?php require_once APPROOT . '/Views/pages/support_nav.php'; ?>

<!-- Nội dung Tab Mua hàng -->
<div class="support-content-box">
    <h3><?php echo $data['title']; ?></h3>

    <div class="shipping-steps">
        <div class="step-item">
            <div class="step-icon"><svg viewBox="0 0 24 24" class="icon">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg></div>
            <h5>1. Tìm kiếm sản phẩm</h5>
            <p>Sử dụng thanh tìm kiếm hoặc bộ lọc để tìm sản phẩm ưng ý.</p>
        </div>
        <div class="step-item">
            <div class="step-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg></div>
            <h5>2. Thêm vào giỏ</h5>
            <p>Chọn đúng phiên bản (Màu, Dung lượng) và thêm vào giỏ hàng.</p>
        </div>
        <div class="step-item">
            <div class="step-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg></div>
            <h5>3. Điền thông tin</h5>
            <p>Nhập thông tin giao hàng và chọn phương thức thanh toán.</p>
        </div>
        <div class="step-item">
            <div class="step-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg></div>
            <h5>4. Hoàn tất</h5>
            <p>Xác nhận đơn hàng và chờ giao hàng tận nơi.</p>
        </div>
    </div>

    <hr style="border-top: 1px dashed #ccc; margin: 30px 0;">

    <h3>Chính sách Vận chuyển</h3>
    <table class="specs-table">
        <thead>
            <tr>
                <th>Khu vực</th>
                <th>Thời gian</th>
                <th>Phí ship</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nội thành TP.HCM</td>
                <td>2-4 giờ</td>
                <td style="color: green; font-weight: bold;">Miễn phí</td>
            </tr>
            <tr>
                <td>Các tỉnh lân cận</td>
                <td>1-2 ngày</td>
                <td>30.000 VNĐ</td>
            </tr>
            <tr>
                <td>Toàn quốc</td>
                <td>2-3 ngày</td>
                <td>50.000 VNĐ</td>
            </tr>
        </tbody>
    </table>
</div>
