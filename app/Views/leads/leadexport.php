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


<!-- Add Task Modal -->
<div class="modal fade" id="viewstaffModal" tabindex="-1" aria-labelledby="viewstaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-xl mb-0" id="viewstaffModalLabel">Leads View</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="staffDetailsContent">

            </div>
            <div class="modal-footer justify-content-center gap-3">
                <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8" data-bs-dismiss="modal">
                    Cancel
                </button>

            </div>
        </div>
    </div>
</div>




<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>



<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this Leads Details?")) {
            window.location.href = "<?= base_url('delete-leads/') ?>" + id;
        }
    }



    $(document).on('click', '.view-staff-btn', function() {
        var staffId = $(this).data('id');

        $('#staffDetailsContent').html('<p>Loading...</p>');
        $('#viewstaffModal').modal('show');

        $.ajax({
            url: "<?= base_url('leads/viewDetails') ?>",
            method: "POST",
            data: {
                id: staffId
            },
            success: function(viewHtml) {
                $('#staffDetailsContent').html(viewHtml);
                // var viewstaffModal = new bootstrap.Modal(document.getElementById('viewstaffModal'));
                // viewstaffModal.show();
            },
            error: function() {
                $('#staffDetailsContent').html('<p>Unable to load Customer details.</p>');
            }
        });
    });
</script>
<!-- Excel Export Dependencies -->

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