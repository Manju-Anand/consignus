<?= $this->extend("lbmpanel/base"); ?>

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
        <div class="col-xxl-6">
          
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

                                
                            </div>
                            <div id="new-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                         </div>
                    </div>

        </div>
        <!-- Revenue Growth start -->
        <div class="col-xxl-6">

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



   
  

   
    

   
</script>



<?= $this->endSection(); ?>