<div class="container orders-page-container">
    <h2 class="page-title"><?php echo $data['title']; ?></h2>

    <div class="orders-card">
        <?php if (empty($data['orders'])) : ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                <p>Bạn chưa có đơn hàng nào.</p>
                <a href="<?php echo URLROOT; ?>/product/all" class="btn-shop-now">Mua sắm ngay</a>
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Mã Đơn</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['orders'] as $order) : ?>
                            <tr>
                                <td>
                                    <span class="order-id">#<?php echo $order['id']; ?></span>
                                </td>
                                <td>
                                    <div class="order-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo date('d/m/Y', strtotime($order['order_date'])); ?>
                                    </div>
                                    <div class="order-time"><?php echo date('H:i', strtotime($order['order_date'])); ?></div>
                                </td>
                                <td>
                                    <span class="order-total"><?php echo number_format($order['total_amount']); ?> ₫</span>
                                </td>
                                <td>
                                    <?php
                                    $statusClass = '';
                                    $statusText = '';
                                    switch ($order['status']) {
                                        case 0:
                                            $statusText = 'Chờ xử lý';
                                            $statusClass = 'status-pending';
                                            break;
                                        case 1:
                                            $statusText = 'Đã xác nhận';
                                            $statusClass = 'status-confirmed';
                                            break;
                                        case 2:
                                            $statusText = 'Đang giao';
                                            $statusClass = 'status-shipping';
                                            break;
                                        case 3:
                                            $statusText = 'Đã hoàn thành';
                                            $statusClass = 'status-completed';
                                            break;
                                        case 4:
                                            $statusText = 'Đã hủy';
                                            $statusClass = 'status-cancelled';
                                            break;
                                        default:
                                            $statusText = 'Không rõ';
                                            $statusClass = 'status-default';
                                    }
                                    ?>
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo $statusText; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/user/orderdetail/<?php echo $order['id']; ?>" class="btn-view-detail">
                                        Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    /* PAGE CONTAINER */
    .orders-page-container {
        padding: 40px 0;
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-title {
        font-size: 2rem;
        color: #1f2937;
        margin-bottom: 30px;
        font-weight: 700;
        text-align: center;
    }

    /* CARD STYLE */
    .orders-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    /* TABLE STYLES */
    .table-responsive {
        overflow-x: auto;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px; /* Prevent squishing on small screens */
    }

    .orders-table th {
        background-color: #f9fafb;
        color: #4b5563;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 16px 24px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .orders-table td {
        padding: 16px 24px;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        vertical-align: middle;
    }

    .orders-table tr:hover {
        background-color: #f9fafb;
    }

    .orders-table tr:last-child td {
        border-bottom: none;
    }

    /* COLUMN SPECIFIC */
    .order-id {
        font-weight: 600;
        color: #2563eb;
    }

    .order-date {
        color: #4b5563;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .order-time {
        font-size: 0.85rem;
        color: #9ca3af;
        margin-top: 4px;
    }

    .order-total {
        font-weight: 700;
        color: #111827;
        font-size: 1rem;
    }

    /* STATUS BADGES */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #d97706; /* Amber */
    }

    .status-confirmed {
        background-color: #dbeafe;
        color: #2563eb; /* Blue */
    }

    .status-shipping {
        background-color: #f3e8ff;
        color: #9333ea; /* Purple */
    }

    .status-completed {
        background-color: #d1fae5;
        color: #059669; /* Green */
    }

    .status-cancelled {
        background-color: #fee2e2;
        color: #dc2626; /* Red */
    }
    
    .status-default {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    /* ACTION BUTTON */
    .btn-view-detail {
        display: inline-block;
        padding: 8px 16px;
        background-color: white;
        border: 1px solid #d1d5db;
        color: #374151;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s;
        font-weight: 500;
    }

    .btn-view-detail:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
        color: #111827;
    }

    /* EMPTY STATE */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 4rem;
        color: #e5e7eb;
        margin-bottom: 20px;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 25px;
    }

    .btn-shop-now {
        background-color: #2563eb;
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    .btn-shop-now:hover {
        background-color: #1d4ed8;
    }
</style>

