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
                    <h5 class="card-title mb-0">Services List</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                    <a href="<?= base_url(); ?>add-service"> <button type="button" class="btn btn-success-600 radius-8 px-14 py-6 text-sm right">Add New service</button></a>
                </div>
            </div>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10'  style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($services)) : $u = 0;
                            foreach ($services as $service) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($service['title']) ?></td>
                                    <td><?= esc($service['category']) ?></td>
                                    <td><?= esc($service['price']) ?></td>
                                    <td><?= esc($service['status']) ?></td>
                                    <td><?= esc($service['created_at']) ?></td>
                                    
                                    <td>

                                        <a href="javascript:void(0)" data-id="<?= $service['id']; ?>" title="View service"
                                            class="view-staff-btn w-32-px h-32-px bg-primary-light text-primary-800 rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                        </a>
                                        <a href="<?= base_url('edit-service/' . $service['id']) ?>" title="Edit service Details"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>

                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $service['id']; ?>)" title="Delete service"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                    </td>
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
                <h6 class="modal-title text-xl mb-0" id="viewstaffModalLabel">Customers View</h6>
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
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this Service Details?")) {
            window.location.href = "<?= base_url('delete-service/') ?>" + id;
        }
    }



    $(document).on('click', '.view-staff-btn', function() {
        var staffId = $(this).data('id');

        $('#staffDetailsContent').html('<p>Loading...</p>');
        $('#viewstaffModal').modal('show');

        $.ajax({
            url: "<?= base_url('customers/viewDetails') ?>",
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
                $('#staffDetailsContent').html('<p>Unable to load service details.</p>');
            }
        });
    });
</script>


<?= $this->endSection(); ?>