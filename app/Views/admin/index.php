<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem; margin-bottom: 8px;">Tổng Quan Kinh Doanh</h2>
    <p style="color: var(--text-light);">Chào mừng quay trở lại, Administrator!</p>
</div>

<!-- Stats Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px;">

    <!-- Revenue -->
    <div class="card" style="margin-bottom: 0; padding: 24px; border-left: 4px solid var(--success-color);">
        <div class="flex-between">
            <div>
                <div style="color: var(--text-light); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Doanh thu</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main);">
                    <?php echo number_format($data['revenue']); ?> ₫
                </div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background-color: #d1fae5; color: var(--success-color); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>

    <!-- Orders -->
    <div class="card" style="margin-bottom: 0; padding: 24px; border-left: 4px solid var(--info-color);">
        <div class="flex-between">
            <div>
                <div style="color: var(--text-light); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Đơn hàng</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main);">
                    <?php echo number_format($data['total_orders']); ?>
                </div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background-color: #dbeafe; color: var(--info-color); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="card" style="margin-bottom: 0; padding: 24px; border-left: 4px solid var(--warning-color);">
        <div class="flex-between">
            <div>
                <div style="color: var(--text-light); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Sản phẩm</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main);">
                    <?php echo number_format($data['total_products']); ?>
                </div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background-color: #fef3c7; color: var(--warning-color); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-box-open"></i>
            </div>
        </div>
    </div>

    <!-- Customers -->
    <div class="card" style="margin-bottom: 0; padding: 24px; border-left: 4px solid var(--danger-color);">
        <div class="flex-between">
            <div>
                <div style="color: var(--text-light); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Khách hàng</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main);">
                    <?php echo number_format($data['total_users']); ?>
                </div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; background-color: #fee2e2; color: var(--danger-color); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">

    <!-- Chart -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Biểu đồ doanh thu (30 ngày gần nhất)</h4>
        </div>
        <div style="position: relative; height: 350px; width: 100%;">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Đơn hàng mới nhất</h4>
        </div>

        <?php if (empty($data['recent_orders'])): ?>
            <p style="color: var(--text-light); text-align: center; padding: 20px;">Chưa có đơn hàng nào.</p>
        <?php else: ?>
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <?php foreach ($data['recent_orders'] as $order): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                        <div>
                            <div style="font-weight: 600; color: var(--text-main); margin-bottom: 4px;">#<?php echo $order['id']; ?> - <?php echo htmlspecialchars($order['full_name']); ?></div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                                <i class="far fa-clock"></i> <?php echo date('d/m H:i', strtotime($order['order_date'])); ?>
                            </div>
                        </div>
                        <div class="text-right">
                            <div style="font-weight: 600; color: var(--text-main); margin-bottom: 4px;"><?php echo number_format($order['total_amount']); ?> ₫</div>
                            <?php
                            $badge_class = 'badge-warning';
                            $stt_text = 'Chờ xử lý';
                            if ($order['status'] == 1) {
                                $badge_class = 'badge-info';
                                $stt_text = 'Đã xác nhận';
                            }
                            if ($order['status'] == 2) {
                                $badge_class = 'badge-info';
                                $stt_text = 'Đang giao';
                            }
                            if ($order['status'] == 3) {
                                $badge_class = 'badge-success';
                                $stt_text = 'Hoàn thành';
                            }
                            if ($order['status'] == 4) {
                                $badge_class = 'badge-danger';
                                $stt_text = 'Đã hủy';
                            }
                            ?>
                            <span class="badge <?php echo $badge_class; ?>">
                                <?php echo $stt_text; ?>
                            </span>
                        </div>
                        <a href="<?php echo URLROOT; ?>/admin/orderdetail/<?php echo $order['id']; ?>" class="btn-icon" style="width: 32px; height: 32px; font-size: 0.8rem;" title="Xem chi tiết">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center; margin-top: 24px;">
                <a href="<?php echo URLROOT; ?>/admin/orders" style="text-decoration: none; color: var(--primary-color); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 6px;">
                    Xem tất cả đơn hàng <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy dữ liệu JSON từ PHP
        const chartData = <?php echo json_encode($data['chart_data']); ?>;

        // Xử lý dữ liệu
        const labels = chartData.map(item => {
            const d = new Date(item.date);
            return d.getDate() + '/' + (d.getMonth() + 1); // Format ngày/tháng
        });
        const values = chartData.map(item => item.total);

        const ctx = document.getElementById('revenueChart').getContext('2d');

        // Tạo Gradient màu
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.2)'); 
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0)'); 

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: values,
                    backgroundColor: gradient,
                    borderColor: '#4f46e5',
                    borderWidth: 2,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { family: 'Inter', size: 13 },
                        bodyFont: { family: 'Inter', size: 13 },
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('vi-VN', {
                                        style: 'currency',
                                        currency: 'VND'
                                    }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [4, 4],
                            color: '#e2e8f0',
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('en-US', {
                                    notation: "compact",
                                    compactDisplay: "short"
                                }).format(value);
                            },
                            color: '#64748b',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Inter', size: 11 }
                        }
                    }
                }
            }
        });
    });
</script>
