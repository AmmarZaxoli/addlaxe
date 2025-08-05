<div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    :root {
        --card-border-width: 4px;
        --card-spacing: 1rem;
        --stat-icon-size: 1.75rem;
    }
    
    body {
        background-color: #f8f9fa;
    }
    
    .dashboard-header {
        margin-bottom: 2rem;
    }
    
    .card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        height: 100%;
        margin-bottom: var(--card-spacing);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    
    .card-border-primary {
        border-left: var(--card-border-width) solid #4e73df !important;
    }
    
    .card-border-success {
        border-left: var(--card-border-width) solid #1cc88a !important;
    }
    
    .card-border-danger {
        border-left: var(--card-border-width) solid #e74a3b !important;
    }
    
    .card-border-info {
        border-left: var(--card-border-width) solid #36b9cc !important;
    }
    
    .card-border-warning {
        border-left: var(--card-border-width) solid #f6c23e !important;
    }
    
    .card-border-secondary {
        border-left: var(--card-border-width) solid #858796 !important;
    }
    
    .card-body {
        padding: 1.25rem;
    }
    
    .metric-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }
    
    .metric-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #5a5c69;
        margin-bottom: 0;
    }
    
    .stat-icon {
        font-size: var(--stat-icon-size);
        opacity: 0.7;
    }
    
    .mini-chart {
        height: 40px;
        width: 100%;
        margin-top: 1rem;
    }
    
    .main-chart-container {
        height: 400px;
        position: relative;
    }
    
    @media (max-width: 768px) {
        :root {
            --stat-icon-size: 1.5rem;
        }
        
        .metric-value {
            font-size: 1.25rem;
        }
    }
    
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }
    }
</style>
        <div class="row">
            <!-- Today's Sales -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card card-border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="metric-title">Today's Sales</div>
                                <div class="metric-value" id="todaySalesValue">IQD <?php echo e($todaySales); ?></div>
                            </div>
                            <div class="stat-icon text-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <canvas id="todaySalesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Profit -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card card-border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="metric-title">Today's Profit</div>
                                <div class="metric-value" id="todayProfitValue">IQD <?php echo e($todayProfit); ?></div>
                            </div>
                            <div class="stat-icon text-success">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <canvas id="todayProfitChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Dept -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card card-border-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="metric-title">Total Dept</div>
                                <div class="metric-value" id="totalDeptValue">IQD <?php echo e($totalDept); ?></div>
                            </div>
                            <div class="stat-icon text-danger">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <canvas id="totalDeptChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Delivery -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card card-border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="metric-title">Today's Delivery</div>
                                <div class="metric-value" id="todayDeliveryValue"><?php echo e($todayDelivery); ?></div>
                            </div>
                            <div class="stat-icon text-info">
                                <i class="fas fa-truck"></i>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <canvas id="todayDeliveryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Orders -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card card-border-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="metric-title">Today's Orders</div>
                                <div class="metric-value" id="todayOrdersValue"><?php echo e($todayOrders); ?></div>
                            </div>
                            <div class="stat-icon text-warning">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <canvas id="todayOrdersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Delivery -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card card-border-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="metric-title">Pending Delivery</div>
                                <div class="metric-value" id="pendingDeliveryValue"><?php echo e($pendingDelivery); ?></div>
                            </div>
                            <div class="stat-icon text-secondary">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="mini-chart">
                            <canvas id="pendingDeliveryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 7-Day Sales Chart -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="m-0 font-weight-bold text-primary">7-Day Sales Performance</h5>
                    </div>
                    <div class="card-body">
                        <div class="main-chart-container">
                            <canvas id="sevenDaySalesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function createMiniChart(id, color, dataPoints, isCurrency = false) {
            const ctx = document.getElementById(id).getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Array(dataPoints.length).fill(''),
                    datasets: [{
                        data: dataPoints,
                        borderColor: color,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: false,
                        pointRadius: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            createMiniChart('todaySalesChart', '#4e73df', [2200, 2300, 2400, 2350, 2450, 2500, 2540], true);
            createMiniChart('todayProfitChart', '#1cc88a', [1000, 1100, 1150, 1200, 1220, 1230, 1240], true);
            createMiniChart('totalDeptChart', '#e74a3b', [3000, 3100, 3200, 3300, 3350, 3400, 3420], true);
            createMiniChart('todayDeliveryChart', '#36b9cc', [15, 18, 20, 22, 23, 24, 24], false);
            createMiniChart('todayOrdersChart', '#f6c23e', [30, 35, 38, 40, 41, 42, 42], false);
            createMiniChart('pendingDeliveryChart', '#858796', [10, 9, 8, 8, 8, 8, 8], false);

            // Main 7-day sales chart
            const salesCtx = document.getElementById('sevenDaySalesChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Today'],
                    datasets: [{
                        label: 'Sales ($)',
                        data: [1250, 1890, 1820, 2350, 1930, 2490, 2540],
                        backgroundColor: 'rgba(78, 115, 223, 0.5)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1,
                        borderRadius: 4
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
                            callbacks: {
                                label: function(context) {
                                    return '$' + context.raw.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div><?php /**PATH C:\Users\Malta Computer\Desktop\forhost\resources\views/livewire/dashboards/show.blade.php ENDPATH**/ ?>