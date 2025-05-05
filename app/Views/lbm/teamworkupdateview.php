<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>


<?= $this->section("content"); ?>
<div class="dashboard-main-body">
    <!-- <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Team Work Updations</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Masters
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Team Work</li>
        </ul>
    </div> -->
    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Team Work Updations</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                  </div>
            </div>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10'  style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">LBM</th>

                            <th scope="col">Property</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Work Notes</th>
                            <th scope="col">submitted_at</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($teamassign)) : $u = 0;
                            foreach ($teamassign as $teamassign) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($teamassign['lname']) ?></td>
                                    <td><?= esc($teamassign['title']) ?></td>
                                    <td><?= esc($teamassign['cname']) ?></td>
                                    <td><?= esc($teamassign['work_notes']) ?></td>
                                    <td><?= esc($teamassign['submitted_at']) ?></td>
                                    <td><?= esc($teamassign['orgstatus']) ?></td>
                                    <td>

                                        <a href="<?= base_url('followup-teamassign/' . $teamassign['id']) ?>" data-id="<?= $teamassign['id']; ?>" title="Follow-Up"
                                            class="w-32-px h-32-px bg-warning-light text-warning-800 rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mdi:message-reply-text-outline"></iconify-icon>
                                        </a>

                                        <a href="javascript:void(0)" data-id="<?= $teamassign['id']; ?>" title="View teamassign"
                                            class="view-staff-btn w-32-px h-32-px bg-primary-light text-primary-800 rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                        </a>
                                        <a href="<?= base_url('edit-teamassign/' . $teamassign['id']) ?>" title="Edit teamassign Details"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>

                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $teamassign['updateid']; ?>)" title="Delete teamassign"
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
                <h6 class="modal-title text-xl mb-0" id="viewstaffModalLabel">teamassign View</h6>
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
        if (confirm("Are you sure you want to delete this teamassign Details?")) {
            window.location.href = "<?= base_url('delete-teamassign/') ?>" + id;
        }
    }



    $(document).on('click', '.view-staff-btn', function() {
        var staffId = $(this).data('id');

        $('#staffDetailsContent').html('<p>Loading...</p>');
        $('#viewstaffModal').modal('show');

        $.ajax({
            url: "<?= base_url('teamassign/viewDetails') ?>",
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
                $('#staffDetailsContent').html('<p>Unable to load teamassign details.</p>');
            }
        });
    });
</script>


<?= $this->endSection(); ?>