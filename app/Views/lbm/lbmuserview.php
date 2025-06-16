<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>

<?= $this->section("styles"); ?>
<style>
    /* body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('public/assets/images/hideout.svg');
  background-repeat: repeat;
  background-size: 80px; 
  background-position: 0 0;
  opacity: 0.05;
  z-index: -1;
  pointer-events: none;
  animation: driftDots 60s linear infinite;
}

@keyframes driftDots {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 200px 200px;
  }
} */
</style>


<?= $this->endSection(); ?>
<?= $this->section("content"); ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Leadership Board Members - User Details</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="<?= base_url(); ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Masters
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Lbm</li>
        </ul>
    </div>
    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Leadership Board Members List - User Details</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                </div>
            </div>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <!-- <th scope="col">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lbmsusers)) : $u = 0;
                            foreach ($lbmsusers as $lbms) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td> <?= esc($lbms['username']) ?> </td>
                                    <td><?= esc($lbms['email']) ?></td>
                                    <td><?= esc($lbms['cmded']) ?></td>

                                    <!-- <td>
                                        <a href="javascript:void(0)" data-id="<?= $lbms['id']; ?>"
                                            class="view-lbms-btn w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                        </a>
                                        <a href="<?= base_url('edit-lbm/' . $lbms['id']) ?>"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>

                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $lbms['id']; ?>)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                    </td> -->
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
<!-- <div class="modal fade" id="viewstaffModal" tabindex="-1" aria-labelledby="viewstaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-xl mb-0" id="viewstaffModalLabel">Leadership Board Members Details View</h6>
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
</div> -->

<script>
    window.addEventListener('scroll', function() {
        const scrollY = window.scrollY;
        document.body.style.setProperty('--scrollY', `${scrollY}px`);
    });
</script>





<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this Leadership Board Members Details?")) {
            window.location.href = "<?= base_url('delete-lbm/') ?>" + id;
        }
    }



    // $(document).on('click', '.view-lbms-btn', function() {
    //     var staffId = $(this).data('id');

    //     $('#staffDetailsContent').html('<p>Loading...</p>');
    //     $('#viewstaffModal').modal('show');

    //     $.ajax({
    //         url: "<?= base_url('lbm/viewDetails') ?>",
    //         method: "POST",
    //         data: {
    //             id: staffId
    //         },
    //         success: function(viewHtml) {
    //             $('#staffDetailsContent').html(viewHtml);
    //             // var viewstaffModal = new bootstrap.Modal(document.getElementById('viewstaffModal'));
    //             // viewstaffModal.show();
    //         },
    //         error: function() {
    //             $('#staffDetailsContent').html('<p>Unable to load lbms details.</p>');
    //         }
    //     });
    // });
</script>
<!--  -->






<?= $this->endSection(); ?>