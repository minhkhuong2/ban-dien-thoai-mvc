<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-info h3 {
        font-size: 2em;
        margin: 0;
        color: #2c3e50;
    }

    .stat-info p {
        margin: 5px 0 0;
        color: #7f8c8d;
        font-size: 0.9em;
    }

    .stat-icon {
        font-size: 2.5em;
        opacity: 0.2;
    }

    /* Phần biểu đồ */
    .chart-container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    /* Bảng đơn hàng */
    .recent-orders {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.85em;
        color: #fff;
    }
</style>

<h2>Tổng quan kinh doanh</h2>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3><?php echo number_format($data['revenue']); ?>₫</h3>
            <p>Doanh thu tổng</p>
        </div>
        <div class="stat-icon" style="color: #2ecc71;">💰</div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3><?php echo $data['total_orders']; ?></h3>
            <p>Đơn hàng</p>
        </div>
        <div class="stat-icon" style="color: #3498db;">📦</div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3><?php echo $data['total_products']; ?></h3>
            <p>Sản phẩm</p>
        </div>
        <div class="stat-icon" style="color: #e67e22;">📱</div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3><?php echo $data['total_users']; ?></h3>
            <p>Khách hàng</p>
        </div>
        <div class="stat-icon" style="color: #9b59b6;">👥</div>
    </div>
</div>

<div class="chart-container">
    <h3 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px;">Biểu đồ doanh thu (30 ngày gần nhất)</h3>
    <canvas id="revenueChart" height="100"></canvas>
</div>

<div class="recent-orders">
    <h3 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px;">Đơn hàng mới nhất</h3>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa; text-align: left;">
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Khách hàng</th>
                <th style="padding: 12px;">Tổng tiền</th>
                <th style="padding: 12px;">Trạng thái</th>
                <th style="padding: 12px;">Ngày đặt</th>
                <th style="padding: 12px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['recent_orders'])): ?>
                <tr>
                    <td colspan="6" style="padding: 15px; text-align: center;">Chưa có đơn hàng nào.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data['recent_orders'] as $order): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;">#<?php echo $order['id']; ?></td>
                        <td style="padding: 12px;"><?php echo htmlspecialchars($order['full_name']); ?></td>
                        <td style="padding: 12px; font-weight: bold; color: #e74c3c;"><?php echo number_format($order['total_amount']); ?>₫</td>
                        <td style="padding: 12px;">
                            <?php
                            switch ($order['status']) {
                                case 0:
                                    echo '<span class="status-badge" style="background:#f1c40f;">Chờ xử lý</span>';
                                    break;
                                case 1:
                                    echo '<span class="status-badge" style="background:#3498db;">Đã xác nhận</span>';
                                    break;
                                case 2:
                                    echo '<span class="status-badge" style="background:#9b59b6;">Đang giao</span>';
                                    break;
                                case 3:
                                    echo '<span class="status-badge" style="background:#2ecc71;">Hoàn thành</span>';
                                    break;
                                case 4:
                                    echo '<span class="status-badge" style="background:#e74c3c;">Đã hủy</span>';
                                    break;
                            }
                            ?>
                        </td>
                        <td style="padding: 12px; color: #777;"><?php echo date('d/m H:i', strtotime($order['order_date'])); ?></td>
                        <td style="padding: 12px;">
                            <a href="<?php echo URLROOT; ?>/admin/orderdetail/<?php echo $order['id']; ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8em;">Xem</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chuẩn bị dữ liệu từ PHP sang JS
    const chartData = <?php echo json_encode($data['chart_data']); ?>;

    const labels = chartData.map(item => item.date); // Mảng ngày
    const totals = chartData.map(item => item.total); // Mảng doanh thu

    const ctx = document.getElementById('revenueChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ: Cột (bar) hoặc Đường (line)
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: totals,
                backgroundColor: 'rgba(52, 152, 219, 0.6)',
                borderColor: 'rgba(52, 152, 219, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += new Intl.NumberFormat('vi-VN').format(context.raw) + ' ₫';
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
