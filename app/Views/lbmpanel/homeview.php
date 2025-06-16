<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>
<?= "userdata" ?>
<?= $this->endSection(); ?>


<?= $this->section("content"); ?>


<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Dashboard</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">CRM</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-xxl-8">
            <div class="row gy-4">

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-1">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                        <iconify-icon icon="fluent:building-24-filled" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Properties Listed</span>
                                        <h6 class="fw-semibold"><?= esc($propertyCount); ?></h6>
                                    </div>
                                </div>

                                <div id="new-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <!-- <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-2">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-success-main flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="mingcute:user-follow-fill" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Customers Registered</span>
                                        <h6 class="fw-semibold"><?= esc($customercount); ?></h6>
                                    </div>
                                </div>

                                <div id="active-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <!-- <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-3">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-yellow text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="material-symbols:home-repair-service" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Services Offered</span>
                                        <h6 class="fw-semibold"><?= esc($servicecount); ?></h6>
                                    </div>
                                </div>

                                <div id="total-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <!-- <p class="text-sm mb-0">Increase by <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">-$10k</span> this week</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-4">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-purple text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="ph:users-three-fill" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Core Team Members</span>
                                        <h6 class="fw-semibold"><?= esc($lbmcount); ?></h6>
                                    </div>
                                </div>

                                <div id="conversion-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <!-- <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+5%</span> this week</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-5">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-pink text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="mdi:chart-pie" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Shareholders</span>
                                        <h6 class="fw-semibold">1,00,000</h6>
                                    </div>
                                </div>

                                <div id="leads-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <!-- <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+20</span> this week</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-6">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-cyan text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="streamline:bag-dollar-solid" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Transactions </span>
                                        <h6 class="fw-semibold"><?= esc($transactioncount); ?></h6>
                                    </div>
                                </div>

                                <div id="total-profit-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <!-- <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+$15k</span> this week</p> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Revenue Growth start -->
        <div class="col-xxl-4">

            <div class="card h-100 radius-8 border">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Properties Listing</h6>
                </div>
                <div class="card-body p-24">
                    <div class="col-md-12">


                        <div id="propertyTypeChart"></div>



                    </div>

                </div>
            </div>
        </div>
        <!-- Revenue Growth End -->

        <!-- Earning Static start -->
        <div class="col-xxl-7">
            <div class="card h-100 radius-8 border-0">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <div>
                            <h6 class="mb-2 fw-bold text-lg">Properties Listed per Month</h6>
                            <span class="text-sm fw-medium text-secondary-light"></span>
                        </div>

                    </div>

                    <div id="monthlyPropertyChart"></div>

                    <!-- <div id="barChart" class="barChart"></div> -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="monthlyShareSalesChart"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="monthlyShareTransactionsChart"></div>
                    </div>
                </div>




            </div>
        </div>
        <!-- Earning Static End -->

        <!-- Campaign Static start -->
        <div class="col-xxl-5">
            <div class="row gy-4">
                <div class="col-xxl-12 col-sm-6">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <?php
                            $months = array_keys($customerRegistrations);
                            $counts = array_values($customerRegistrations);
                            ?>
                            <div id="customerRegistrationChart"></div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-sm-6">
                    <div class="card h-100 radius-8 border-0 overflow-hidden">
                        <div class="card-body p-24">
                            <div id="shareholdingChart"></div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Campaign Static End -->





        <div class="col-xxl-12">
            <div class="card h-100">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Leadership Board Members</h6>
                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">No. of Customers Handled</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($coreTeamStats as $member): ?>
                                    <tr>
                                        <td><?= esc($member['name']) ?></td>
                                        <td><?= esc($member['role']) ?></td>
                                        <td><?= $member['customers_handled'] ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Performance End -->
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<script src="<?= base_url(); ?>public/assets/js/lib/apexcharts.min.js"></script>
<script src="<?= base_url(); ?>public/assets/js/homeTwoChart.js"></script>
<script src="<?= base_url(); ?>public/assets/js/pieChartPageChart.js"></script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            series: <?= json_encode(array_map('intval', array_column($typeDistribution, 'count'))) ?>,
            chart: {
                type: 'pie',
                height: 350
            },
            labels: <?= json_encode(array_column($typeDistribution, 'category')) ?>,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            legend: {
                position: 'right'
            }
        };

        var chart = new ApexCharts(document.querySelector("#propertyTypeChart"), options);
        chart.render();
    });



    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            series: [{
                name: 'Properties Listed',
                data: <?= json_encode(array_map('intval', array_column($monthlyPropertyStats, 'count'))) ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    distributed: true, // <- enables different colors for each bar
                    borderRadius: 4,
                    columnWidth: '50%'
                }
            },
            xaxis: {
                categories: <?= json_encode(array_column($monthlyPropertyStats, 'month')) ?>
            },
            colors: ['#00b894', '#6c5ce7', '#fd79a8', '#e17055', '#0984e3', '#fab1a0'], // Add more if needed
            title: {
                text: 'Monthly Properties Listed',
                align: 'center'
            }
        };

        var chart = new ApexCharts(document.querySelector("#monthlyPropertyChart"), options);
        chart.render();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            series: [50000, 10000, 40000],
            chart: {
                type: 'donut',
                height: 350
            },
            labels: ['Founder', 'Leadership', 'External Investor'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '25%' // Increase from default 50% to make it thicker
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            title: {
                text: 'Shareholding Distribution',
                align: 'center'
            },
            colors: ['#2ecc71', '#f1c40f', '#e74c3c']
        };

        var chart = new ApexCharts(document.querySelector("#shareholdingChart"), options);
        chart.render();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            chart: {
                type: 'line',
                height: 350
            },
            series: [{
                name: 'Customers',
                data: <?= json_encode($counts) ?>
            }],
            xaxis: {
                categories: <?= json_encode($months) ?>
            },
            title: {
                text: 'Customer Enquiries (Last 6 Months)',
                align: 'center'
            },
            stroke: {
                curve: 'smooth'
            },
            colors: ['#1abc9c']
        };

        var chart = new ApexCharts(document.querySelector("#customerRegistrationChart"), options);
        chart.render();
    });
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            series: [{
                name: 'Shares Sold',
                data: <?= json_encode(array_map('intval', array_column($monthlyShareSales, 'count'))) ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: <?= json_encode(array_column($monthlyShareSales, 'month')) ?>
            },
            colors: ['#e17055'],
            title: {
                text: 'Monthly Share Sales',
                align: 'center'
            }
        };

        var chart = new ApexCharts(document.querySelector("#monthlyShareSalesChart"), options);
        chart.render();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            series: [{
                    name: 'Purchases',
                    data: <?= json_encode(array_map('intval', array_column($monthlySharetransactions, 'purchases'))) ?>
                },
                {
                    name: 'Sales',
                    data: <?= json_encode(array_map('intval', array_column($monthlySharetransactions, 'sales'))) ?>
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: <?= json_encode(array_column($monthlySharetransactions, 'month')) ?>
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '45%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            colors: ['#00b894', '#d63031'], // green for purchases, red for sales
            legend: {
                position: 'top'
            },
            title: {
                text: 'Share Transactions Per Month',
                align: 'center'
            }
        };

        var chart = new ApexCharts(document.querySelector("#monthlyShareTransactionsChart"), options);
        chart.render();
    });
</script>



<?= $this->endSection(); ?>