<!-- Gọi Header và Menu phụ -->
<?php require_once APPROOT . '/Views/pages/support_nav.php'; ?>

<!-- Nội dung Tab Đổi trả -->
<div class="support-content-box">
    <h3><?php echo $data['title']; ?></h3>
    <h4>Thời gian đổi trả:</h4>
    <ul>
        <li><strong>7 ngày đầu:</strong> 1 đổi 1 (hoàn tiền hoặc đổi sản phẩm mới) nếu máy có lỗi phần cứng do nhà sản xuất.</li>
        <li><strong>30 ngày đầu:</strong> Đổi máy tương đương (likenew) nếu có lỗi phần mềm nghiêm trọng không thể khắc phục.</li>
    </ul>
    <h4>Điều kiện đổi trả:</h4>
    <ul>
        <li>Sản phẩm không bị trầy xước, cấn móp, vào nước.</li>
        <li>Còn đầy đủ hộp, sách hướng dẫn, phụ kiện đi kèm và hóa đơn mua hàng.</li>
        <li>Không có dấu hiệu can thiệp phần cứng hoặc root/jailbreak.</li>
    </ul>
    <p style="background: #fffbe6; border: 1px solid #ffe58f; padding: 10px; border-radius: 5px;">
        <strong>Lưu ý quan trọng:</strong> Sản phẩm đã qua sử dụng quá 7 ngày sẽ không được đổi trả, chỉ được áp dụng chính sách bảo hành.
    </p>
</div>
