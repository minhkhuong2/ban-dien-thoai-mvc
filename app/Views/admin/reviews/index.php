<h2><?php echo $data['title']; ?></h2>

<div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa; text-align: left;">
                <th style="padding: 12px; border-bottom: 2px solid #eee;">Sản phẩm</th>
                <th style="padding: 12px; border-bottom: 2px solid #eee;">Khách hàng</th>
                <th style="padding: 12px; border-bottom: 2px solid #eee; width: 100px;">Đánh giá</th>
                <th style="padding: 12px; border-bottom: 2px solid #eee;">Bình luận</th>
                <th style="padding: 12px; border-bottom: 2px solid #eee; width: 120px;">Ngày đăng</th>
                <th style="padding: 12px; border-bottom: 2px solid #eee; width: 80px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['reviews'])) : ?>
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center;">Chưa có đánh giá nào.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($data['reviews'] as $review) : ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;">
                            <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $review['product_id']; ?>" target="_blank" style="font-weight: bold; color: #3498db; text-decoration: none;">
                                <?php echo htmlspecialchars($review['product_name']); ?>
                            </a>
                        </td>
                        <td style="padding: 12px;">
                            <?php echo htmlspecialchars($review['user_name']); ?>
                        </td>
                        <td style="padding: 12px;">
                            <span style="color: #f1c40f; font-weight: bold;">
                                <?php echo $review['rating']; ?> ★
                            </span>
                        </td>
                        <td style="padding: 12px; font-style: italic; color: #555;">
                            "<?php echo nl2br(htmlspecialchars($review['comment'])); ?>"
                        </td>
                        <td style="padding: 12px; font-size: 0.85em; color: #777;">
                            <?php echo date('d/m/Y', strtotime($review['created_at'])); ?>
                        </td>
                        <td style="padding: 12px;">
                            <a href="<?php echo URLROOT; ?>/admin/deleteReview/<?php echo $review['id']; ?>"
                                class="btn btn-danger"
                                style="padding: 5px 10px; font-size: 0.8em;"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
