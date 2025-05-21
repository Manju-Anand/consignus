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
                    <h5 class="card-title mb-0">Payment Modes List</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">



                    <button type="button" class="add-accounts-buttons btn btn-success-600 radius-8 px-14 py-6 text-sm right">Add New Payment Mode</button>
                </div>
            </div>



        </div>
        <?php if (session()->getFlashdata('success')): ?>
            <script>
                Swal.fire({
                    title: '🎉 Success!',
                    html: '<strong><?= session()->getFlashdata('success') ?></strong>',
                    icon: 'success',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                    timer: 4000,
                    timerProgressBar: true,
                    background: '#f0f9ff',
                    color: '#2b2e4a',
                    iconColor: '#28a745',
                    showConfirmButton: false
                });
            </script>
            <!-- Include Animate.css for animation effects -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <?php endif; ?>




        <div class="card-body">
            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Payment Mode</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created</th>
                            <th scope="col">Modified</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($paymentmodel)) : $u = 0;
                            foreach ($paymentmodel as $paymentmodel) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($paymentmodel['mode_name']) ?></td>
                                   
                                    <td><?= esc($paymentmodel['description']) ?></td>
                                    
                                    <td><?= esc($paymentmodel['created_at']) ?></td>
                                    <td><?= esc($paymentmodel['updated_at']) ?></td>
                                    <td>

                                        <a href="javascript:void(0)" title="Edit paymentmodel Details"
                                            data-id="<?= $paymentmodel['id'] ?>"
                                            data-modename="<?= $paymentmodel['mode_name'] ?>"
                                            data-desp="<?= $paymentmodel['description'] ?>"
                                            class="edit-accounts-buttons w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>

                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $paymentmodel['id']; ?>)" title="Delete paymentmodel"
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
<!-- Modal -->
<div class="modal fade" id="addheadsModal" tabindex="-1" aria-labelledby="addheadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">


        <form action="<?= base_url('accounting/save-payment-mode') ?>" method="post" id="paymentModeForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Add Payment Mode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="modeName" class="form-label">Payment Mode Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modeName" name="mode_name" placeholder="e.g., Cash, Bank Transfer, UPI" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="details" class="form-label">Additional Details (Optional)</label>
                        <textarea class="form-control" id="details" name="details" rows="3" placeholder="Enter any bank account info, UPI ID, etc. if applicable..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Save Payment Mode</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="editheadsModal" tabindex="-1" aria-labelledby="editheadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">


        <form action="<?= base_url('/accounting/edit-payment-mode') ?>" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mb-4">Edit Payment Mode Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="pmid" id="pmid" value="" >
                <div class="form-group mb-3">
                        <label for="modeName" class="form-label">Payment Mode Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editmodeName" name="editmode_name" placeholder="e.g., Cash, Bank Transfer, UPI" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="details" class="form-label">Additional Details (Optional)</label>
                        <textarea class="form-control" id="editdetails" name="editdetails" rows="3" placeholder="Enter any bank account info, UPI ID, etc. if applicable..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Update Payment Mode</button>
                </div>
            </div>
        </form>

    </div>
</div>



<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this Payment Mode Details?")) {
            window.location.href = "<?= base_url('delete-paymentmode/') ?>" + id;
        }
    }



    document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('addheadsModal'));
        const addButtons = document.querySelectorAll('.add-accounts-buttons');
        const editButtons = document.querySelectorAll('.edit-accounts-buttons');
        const editmodal = new bootstrap.Modal(document.getElementById('editheadsModal'));



        addButtons.forEach(button => {
            button.addEventListener('click', function() {

                modal.show();
            });
        });



        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const modename = this.getAttribute('data-modename');
                const desp = this.getAttribute('data-desp');

                const mode_id = document.getElementById('pmid');
                const editmodename = document.getElementById('editmodeName');
                const editdescription = document.getElementById('editdetails');


                // // alert (id);
                mode_id.value = id;
                editmodename.value = modename;
                editdetails.value = desp;



                editmodal.show();
            });
        });




    });
</script>


<?= $this->endSection(); ?>