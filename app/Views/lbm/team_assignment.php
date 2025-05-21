<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>
<?= "userdata" ?>
<?= $this->endSection(); ?>


<?= $this->section("content"); ?>

<div class="dashboard-main-body">

    <style>
        .text-danger:empty {
            display: none;
        }
    </style>

    <div class="card h-100 p-0 radius-12 overflow-hidden">

        <div class="card-body p-40">
            <h6 class="fw-semibold mb-3"><img src="<?= base_url('public/assets/images/follow-up.png') ?>" style="width:30px;height:30px;">Team Assignment</h6>
            <!-- <hr> -->

            <form action="<?= site_url('teamassign-form') ?>" method="post" enctype="multipart/form-data">
                <?php if (!empty($lbms)) : ?>
                    <div class="row">



                        <div class="col-xxl-4 col-lg-8">
                            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                                <div class="card-body p-24">
                                    <div class="row">
                                        <div class="col-md-12 mb-10">
                                            <label for="lbm" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Leadership Board Member <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control  form-control-sm form-select" id="lbm" name="lbm">
                                                <option selected disabled>Select Leadership Board Member</option>
                                                <?php foreach ($lbms as $lbms): ?>
                                                    <option value="<?= esc($lbms['id']); ?>"><?= esc($lbms['name']); ?></option>
                                                <?php endforeach; ?>


                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'lbm'); ?></span>



                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <label for="customers" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Customers <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control  form-control-sm form-select" id="customers" name="customers">
                                                <option selected disabled>Select Customers</option>
                                                <?php foreach ($customers as $customers): ?>
                                                    <option value="<?= esc($customers['id']); ?>"><?= esc($customers['name']); ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'customers'); ?></span>



                                        </div>
                                        <div class="col-md-12  mb-10">

                                            <label for="property" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Property <span class="text-danger-600">*</span>

                                            </label>
                                            <select class="form-control  form-control-sm form-select" id="property" name="property">
                                                <option selected disabled>Select Property</option>
                                                <?php foreach ($property as $property): ?>
                                                    <option value="<?= esc($property['id']); ?>"><?= esc($property['title']); ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'property'); ?></span>


                                        </div>
                                        <div class="col-md-12  mb-10">

                                            <label for="role" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Role/Task <span class="text-danger-600">*</span>

                                            </label>
                                            <input type="text" name="role" class="form-control" placeholder="e.g., Site Visit Coordinator">

                                            <span class="text-danger"><?= display_errors($validation ?? null, 'property'); ?></span>


                                        </div>





                                        <!-- ***************************************************** -->



                                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">

                                            <button type="submit" name="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                                                Submit
                                            </button>
                                            <button type="reset" id="cancel" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-24 py-8 radius-8">
                                                Cancel
                                            </button>
                                        </div>






                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-lg-4">
                            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                                <div class="card-body p-24">
                                    <h6 style="font-size:  0.75rem;">Customer Details</h6>
                                    <div class="table-responsive" id="custdatatable">


                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-xxl-4 col-lg-4">
                            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                                <div class="card-body p-24">
                                <h6 style="font-size:  0.75rem;">Property Details</h6>
                                    <div class="table-responsive" id="propertytable">

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-xxl-12 col-lg-12 mt-10">

                            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                                <div class="card-body p-24">

                                    <div class="table-responsive">
                                        <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Lb Member </th>
                                                    <th scope="col">Property Assigned </th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Assigned Role </th>
                                                    <th scope="col">Assigned On </th>
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
                                                            <td><?= esc($teamassign['role']) ?></td>
                                                            <td><?= esc($teamassign['assigned_at']) ?></td>
                                                            
                                                            <td>

                                                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $teamassign['id']; ?>)" title="Delete Customer"
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






                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section("scripts"); ?>

<script>
    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location.href = "<?= base_url('lbm') ?>";
            return false;
        });
    });

    function capitalizeFirstLetter(input) {
        input.value = input.value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    }

    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this teamassign Details?")) {
            window.location.href = "<?= base_url('delete-teamassign/') ?>" + id;
        }
    }


    $('#property').on('change', function() {
        var propertyTypeId = $(this).val();

        $.ajax({
            url: '<?= base_url('get-property-full-details'); ?>',
            type: 'POST',
            data: {
                id: propertyTypeId
            },
            success: function(response) {
                console.log(response),
                $('#propertytable').html(response);
            },
            error: function() {
                alert('Error fetching property details.');
            }
        });
    });

    $('#customers').on('change', function() {
        var custId = $(this).val();

        $.ajax({
            url: '<?= base_url('get-customer-details'); ?>',
            type: 'POST',
            data: {
                id: custId
            },

            success: function(response) {
                // console.log(response),
                $('#custdatatable').html(response);
            },
            error: function() {
                alert('Error fetching customer details.');
            }
        });
    });
</script>
<?= $this->endSection(); ?>