<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>



<?= $this->section("content"); ?>
<div class="dashboard-main-body">
    
    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Leads List</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button id="excelExport" class="btn btn-success mb-3">Export to Excel</button>
                </div>
            </div>



        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Name</th>

                            <th scope="col">Phone</th>
                            <th scope="col">Requirement</th>
                            <th scope="col">Location</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Referer Name</th>
                            <th scope="col">Assigned Staff</th>
                            <th scope="col">Lead Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($leads)) : $u = 0;
                            foreach ($leads as $customer) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($customer['name']) ?></td>
                                    <td><?= esc($customer['phone']) ?></td>
                                    <td><?= esc($customer['requirement_type']) ?></td>
                                    <td><?= esc($customer['preferred_location']) ?></td>
                                    <td><?= esc($customer['budget_range']) ?></td>
                                    <td><?= esc($customer['agentname']) ?></td>
                                    <td><?= esc($customer['referername']) ?></td>
                                    <td><?= esc($customer['sname']) ?></td>
                                    <td><?= esc($customer['leadstatus']) ?></td>

                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>


                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>







<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>




<!-- Excel Export Dependencies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {
        // Get the existing table instance
        let table = $('#dataTable').DataTable();

        // Add the export button manually
        new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: 'excelHtml5',
                title: 'Leads Data',
                text: 'Download Excel',
                className: 'btn btn-sm btn-primary'
            }]
        });

        // Attach export to your custom button
        $('#excelExport').on('click', function() {
            table.button('.buttons-excel').trigger();
        });
    });
</script>





<!-- -->



<?= $this->endSection(); ?>