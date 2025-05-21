<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>


<?= $this->section("content"); ?>
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Share Sales List</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="<?= base_url(); ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Masters
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Share Sales</li>
        </ul>
    </div>
    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Share Sales List</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                    <a href="<?= base_url(); ?>share-sale"> <button type="button" class="btn btn-success-600 radius-8 px-14 py-6 text-sm right">Add New Share Sale</button></a>
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
                            <th scope="col">shareholder_type</th>

                            <th scope="col">shareholder_name</th>
                            <th scope="col">shares_sold</th>
                            <th scope="col">sale_amount</th>
                            <th scope="col">sale_policy</th>
                            <th scope="col">sold_to</th>
                            <th scope="col">transaction_date</th>
                            <th scope="col">Action</th>
                            <th scope="col">phone_number</th>
                            <th scope="col">email</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($saleslist)) : $u = 0;
                            foreach ($saleslist as $saleslist) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($saleslist['shareholder_type']) ?></td>
                                    <td><?= esc($saleslist['shareholder_name']) ?></td>
                                    <td><?= esc($saleslist['shares_sold']) ?></td>
                                    <td><?= esc($saleslist['sale_amount']) ?></td>
                                    <td><?= esc($saleslist['sale_policy']) ?></td>
                                    <td><?= esc($saleslist['sold_to']) ?></td>
                                    <td><?= esc($saleslist['transaction_date']) ?></td>
                         

                                    <td>
                                        <!-- <a href="javascript:void(0)" data-id="<?= $saleslist['id']; ?>" title="View saleslist"
                                            class="view-staff-btn w-32-px h-32-px bg-primary-light text-primary-800 rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                        </a> -->
                                        <!-- <a href="<?= base_url('edit-saleslist/' . $saleslist['id']) ?>" title="Edit saleslist Details"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a> -->

                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $saleslist['id']; ?>)" title="Delete saleslist"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                    </td>
                                    <td><?= esc($saleslist['phone_number']) ?></td>
                                    <td><?= esc($saleslist['email']) ?></td>
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
        if (confirm("Are you sure you want to delete this Sharepurchase Details?")) {
            window.location.href = "<?= base_url('delete-saleslist/') ?>" + id;
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
                $('#staffDetailsContent').html('<p>Unable to load saleslist details.</p>');
            }
        });
    });
</script>


<?= $this->endSection(); ?>