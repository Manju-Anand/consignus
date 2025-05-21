<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>


<?= $this->section("content"); ?>
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Account Heads List Details</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="<?= base_url(); ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Masters
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Account Heads</li>
        </ul>
    </div>
    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Account Heads List</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">



                    <button type="button" class="add-accounts-buttons btn btn-success-600 radius-8 px-14 py-6 text-sm right">Add New Account Heads</button>
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
                            <th scope="col">Head Name</th>
                            <th scope="col">Head Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created</th>
                            <th scope="col">Modified</th>
                            <th scope="col">Action</th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($accountheads)) : $u = 0;
                            foreach ($accountheads as $accountheads) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($accountheads['head_name']) ?></td>
                                    <td><?= esc($accountheads['head_type']) ?></td>
                                    <td><?= esc($accountheads['description']) ?></td>
                                    <td><?= esc($accountheads['is_active']) ?></td>
                                    <td><?= esc($accountheads['created_at']) ?></td>
                                    <td><?= esc($accountheads['updated_at']) ?></td>
                                    <td>

                                        <a href="javascript:void(0)" title="Edit accountheads Details"
                                            data-id="<?= $accountheads['id'] ?>"
                                            data-headname="<?= $accountheads['head_name'] ?>"
                                            data-headtype="<?= $accountheads['head_type'] ?>"
                                            data-status="<?= $accountheads['is_active'] ?>"
                                            data-desp="<?= $accountheads['description'] ?>"
                                            class="edit-accounts-buttons w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>

                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $accountheads['id']; ?>)" title="Delete accountheads"
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


        <form action="<?= base_url('/accounting/add-head') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mb-4">Add Account Head</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-4 shadow rounded">


                        <!-- Head Name -->
                        <div class="mb-3">
                            <label for="head_name" class="form-label">Account Head Name</label>
                            <input type="text" class="form-control" id="head_name" name="head_name" required placeholder="e.g. Share Capital">
                        </div>

                        <!-- Head Type -->
                        <div class="mb-3">
                            <label for="head_type" class="form-label">Account Type</label>
                            <select class="form-select" id="head_type" name="head_type" required>
                                <option value="" disabled>-- Select Type --</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                                <option value="asset">Asset</option>
                                <option value="liability">Liability</option>
                                <option value="equity">Equity</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add a short description..."></textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Save Account Head</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="editheadsModal" tabindex="-1" aria-labelledby="editheadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">


        <form action="<?= base_url('/accounting/edit-head') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mb-4">Edit Account Head Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-4 shadow rounded">

                        <input type="hidden" class="form-control" id="head_id" name="head_id" value="">
                        <!-- Head Name -->
                        <div class="mb-3">
                            <label for="head_name" class="form-label">Account Head Name</label>
                            <input type="text" class="form-control" id="edithead_name" name="edithead_name" required placeholder="e.g. Share Capital">
                        </div>

                        <!-- Head Type -->
                        <div class="mb-3">
                            <label for="head_type" class="form-label">Account Type</label>
                            <select class="form-select" id="edithead_type" name="edithead_type" required>
                                <option value="" disabled>-- Select Type --</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                                <option value="asset">Asset</option>
                                <option value="liability">Liability</option>
                                <option value="equity">Equity</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" id="editdescription" name="editdescription" rows="3" placeholder="Add a short description..."></textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="editis_active" name="editis_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Update Account Head</button>
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
        if (confirm("Are you sure you want to delete this Sharepurchase Details?")) {
            window.location.href = "<?= base_url('delete-accountheads/') ?>" + id;
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
                const headname = this.getAttribute('data-headname');
                const headtype = this.getAttribute('data-headtype');
                const status = this.getAttribute('data-status');
                const desp = this.getAttribute('data-desp');

                const head_id = document.getElementById('head_id');
                const edithead_name = document.getElementById('edithead_name');
                const edithead_type = document.getElementById('edithead_type');
                const editdescription = document.getElementById('editdescription');
                const editis_active = document.getElementById('editis_active');

                // // alert (id);
                head_id.value = id;
                edithead_name.value = headname;
                edithead_type.value = headtype;
                editdescription.value = desp;
                editis_active.value = status;


                editmodal.show();
            });
        });




    });
</script>


<?= $this->endSection(); ?>