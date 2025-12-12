<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $data['title']; ?></h3>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Khách hàng</th>
                    <th style="width: 120px;">Đánh giá</th>
                    <th>Bình luận</th>
                    <th style="width: 120px;">Ngày đăng</th>
                    <th class="text-right" style="width: 80px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['reviews'])) : ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 32px; color: var(--text-light);">
                            Chưa có đánh giá nào.
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['reviews'] as $review) : ?>
                        <tr>
                            <td>
                                <a href="<?php echo URLROOT; ?>/product/detail/<?php echo $review['product_id']; ?>" target="_blank" style="font-weight: 600; color: var(--primary-color); text-decoration: none;">
                                    <?php echo htmlspecialchars($review['product_name']); ?>
                                </a>
                            </td>
                            <td>
                                <div style="font-weight: 500; color: var(--text-main);"><?php echo htmlspecialchars($review['user_name']); ?></div>
                            </td>
                            <td>
                                <div style="color: #f59e0b; font-weight: 600;">
                                    <?php echo $review['rating']; ?> <i class="fas fa-star" style="font-size: 0.8rem;"></i>
                                </div>
                            </td>
                            <td>
                                <div style="font-style: italic; color: var(--text-light); font-size: 0.9rem;">
                                    "<?php echo nl2br(htmlspecialchars($review['comment'])); ?>"
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem; color: var(--text-light);">
                                    <?php echo date('d/m/Y', strtotime($review['created_at'])); ?>
                                </div>
                            </td>
                            <td class="text-right">
                                <a href="<?php echo URLROOT; ?>/admin/deleteReview/<?php echo $review['id']; ?>"
                                    class="btn-icon"
                                    title="Xóa"
                                    style="color: var(--danger-color); border-color: var(--danger-color);"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        <?php echo $data['pagination'] ?? ''; ?>
    </div>
</div>
