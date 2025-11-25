<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div style="margin-bottom: 30px;">
    <h2 style="margin-top: 0; color: #2d3748; border-bottom: none;">Tổng Quan Kinh Doanh</h2>
    <p style="color: #718096;">Chào mừng quay trở lại, Administrator!</p>
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; margin-bottom: 30px;">

    <div style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #48bb78; position: relative; overflow: hidden;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #a0aec0; font-size: 0.85em; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Doanh thu</div>
                <div style="font-size: 1.8em; font-weight: bold; color: #2d3748; margin-top: 5px;">
                    <?php echo number_format($data['revenue']); ?> ₫
                </div>
            </div>
            <div style="background: #f0fff4; color: #48bb78; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>

    <div style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #4299e1; position: relative;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #a0aec0; font-size: 0.85em; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Đơn hàng</div>
                <div style="font-size: 1.8em; font-weight: bold; color: #2d3748; margin-top: 5px;">
                    <?php echo number_format($data['total_orders']); ?>
                </div>
            </div>
            <div style="background: #ebf8ff; color: #4299e1; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #ecc94b; position: relative;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #a0aec0; font-size: 0.85em; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Sản phẩm</div>
                <div style="font-size: 1.8em; font-weight: bold; color: #2d3748; margin-top: 5px;">
                    <?php echo number_format($data['total_products']); ?>
                </div>
            </div>
            <div style="background: #fffff0; color: #ecc94b; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-box-open"></i>
            </div>
        </div>
    </div>

    <div style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #ed64a6; position: relative;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #a0aec0; font-size: 0.85em; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Khách hàng</div>
                <div style="font-size: 1.8em; font-weight: bold; color: #2d3748; margin-top: 5px;">
                    <?php echo number_format($data['total_users']); ?>
                </div>
            </div>
            <div style="background: #fff5f7; color: #ed64a6; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">

    <div style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h4 style="margin-top: 0; margin-bottom: 20px; color: #2d3748; font-size: 1.1rem;">Biểu đồ doanh thu (30 ngày gần nhất)</h4>
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <div style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h4 style="margin-top: 0; margin-bottom: 20px; color: #2d3748; font-size: 1.1rem;">Đơn hàng mới nhất</h4>

        <?php if (empty($data['recent_orders'])): ?>
            <p style="color: #777;">Chưa có đơn hàng nào.</p>
        <?php else: ?>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <?php foreach ($data['recent_orders'] as $order): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 15px; border-bottom: 1px solid #edf2f7;">
                        <div>
                            <div style="font-weight: bold; color: #2d3748;">#<?php echo $order['id']; ?> - <?php echo htmlspecialchars($order['full_name']); ?></div>
                            <div style="font-size: 0.85em; color: #a0aec0; margin-top: 3px;">
                                <i class="far fa-clock"></i> <?php echo date('d/m H:i', strtotime($order['order_date'])); ?>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-weight: bold; color: #2d3748;"><?php echo number_format($order['total_amount']); ?> ₫</div>
                            <?php
                            $stt_color = '#ecc94b';
                            $stt_text = 'Chờ xử lý';
                            if ($order['status'] == 1) {
                                $stt_color = '#4299e1';
                                $stt_text = 'Đã xác nhận';
                            }
                            if ($order['status'] == 2) {
                                $stt_color = '#805ad5';
                                $stt_text = 'Đang giao';
                            }
                            if ($order['status'] == 3) {
                                $stt_color = '#48bb78';
                                $stt_text = 'Hoàn thành';
                            }
                            if ($order['status'] == 4) {
                                $stt_color = '#f56565';
                                $stt_text = 'Đã hủy';
                            }
                            ?>
                            <span style="font-size: 0.75em; padding: 2px 8px; border-radius: 10px; background-color: <?php echo $stt_color; ?>20; color: <?php echo $stt_color; ?>; font-weight: 600;">
                                <?php echo $stt_text; ?>
                            </span>
                        </div>
                        <a href="<?php echo URLROOT; ?>/admin/orderdetail/<?php echo $order['id']; ?>" style="color: #a0aec0; margin-left: 10px; transition: 0.3s;" title="Xem chi tiết">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="<?php echo URLROOT; ?>/admin/orders" style="text-decoration: none; color: #667eea; font-weight: 600; font-size: 0.9rem;">
                    Xem tất cả đơn hàng &rarr;
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

        // Tạo Gradient màu xanh đẹp mắt
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(66, 153, 225, 0.5)'); // Xanh đậm ở trên
        gradient.addColorStop(1, 'rgba(66, 153, 225, 0)'); // Trong suốt ở dưới

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: values,
                    backgroundColor: gradient,
                    borderColor: '#4299e1',
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4299e1',
                    pointHoverBackgroundColor: '#4299e1',
                    pointHoverBorderColor: '#fff',
                    fill: true,
                    tension: 0.4 // Đường cong mềm mại
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }, // Ẩn chú thích
                    tooltip: {
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
                            borderDash: [2, 4],
                            color: '#edf2f7'
                        },
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('en-US', {
                                    notation: "compact",
                                    compactDisplay: "short"
                                }).format(value) + 'đ';
                            },
                            color: '#a0aec0',
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#a0aec0',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    });
</script>
