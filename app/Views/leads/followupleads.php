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
            <h6 class="fw-semibold mb-3"><img src="<?= base_url('public/assets/images/follow-up.png') ?>" style="width:30px;height:30px;"> LEAD FOLLOWUP DETAILS</h6>
            <!-- <hr> -->

            
            <form id="followupForm" method="post">
                <?php if (!empty($customers)) : ?>
                    <div class="row">

                        <input type="hidden" class="form-control radius-8" id="aid" name="aid" value="<?= esc($customers['id']) ?>">


                        <div class="col-xxl-8 col-lg-8">
                            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                                <div class="card-body p-24">
                                    <div class="row">
                                        <div class="col-md-6 mb-10">
                                            <label for="fdate" class="form-label fw-semibold text-primary-light text-sm mb-8">Follow-Up Date <span
                                                    class="text-danger-600">*</span></label>
                                            <input type="date" class="form-control form-control-sm " id="fdate"
                                                name="fdate" value="">
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'fdate'); ?></span>

                                        </div>
                                        <div class="col-md-6 mb-10">
                                            <label for="nfdate" class="form-label fw-semibold text-primary-light text-sm mb-8">Next Follow-Up Date <span
                                                    class="text-danger-600">*</span></label>
                                            <input type="date" class="form-control form-control-sm" id="nfdate"
                                                name="nfdate" value="">
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'nfdate'); ?></span>

                                        </div>
                                        <div class="col-md-12  mb-10">

                                            <label for="notes" class="form-label fw-semibold text-primary-light text-sm mb-8">Follow-Up Notes </label>
                                            <textarea class="form-control radius-8" id="notes" placeholder="Enter Address" name="notes">
                                          </textarea>

                                            <span class="text-danger"><?= display_errors($validation ?? null, 'addr'); ?></span>
                                        </div>
                                        <div class="col-md-6 mb-10">

                                            <label for="communication" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Communication Mode <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control  form-control-sm form-select" id="communication" name="communication">
                                                <option selected disabled>Select Communication Mode</option>
                                                <option value="Call">Call</option>
                                                <option value="WhatsApp">WhatsApp</option>
                                                <option value="Email">Email</option>
                                                <option value="Visit">Visit</option>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'communication'); ?></span>

                                        </div>
                                        <div class="col-md-6 mb-10">

                                            <label for="fstatus" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Follow-Up Status <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control  form-control-sm form-select" id="fstatus" name="fstatus">
                                                <option selected disabled>Select Follow-Up Status</option>
                                                <option value="Interested">Interested</option>
                                                <option value="Not Interested">Not Interested</option>
                                                <option value="Waiting">Waiting</option>
                                                <!-- <option value="Closed">Closed</option> -->
                                                <option value="Converted">Converted</option>
                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'communication'); ?></span>

                                        </div>

                                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">

                                            <button type="submit" id="convertionBtn" class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8" style="display: none;">
                                                Convertion
                                            </button>


                                            <button type="submit" id="followupBtn" name="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                                                Submit Followup
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

                                    <h6>Customer Details <img src="<?= base_url('public/assets/images/rating.png') ?>" style="width:30px;height:30px;"></h6>
                                    <table class="table table-bordered  table-sm" style="font-size:  0.75rem;"> <!-- 0.875rem = small text -->
                                        <tbody>
                                            <tr>
                                                <th>Full Name </th>
                                                <td><?= esc($customers['name']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Phone No </th>
                                                <td><?= esc($customers['phone']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email </th>
                                                <td><?= esc($customers['email']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td><?= esc($customers['address']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Budget Range</th>
                                                <td><?= esc($customers['budget_range']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Requirement Type</th>
                                                <td><?= esc($customers['requirement_type']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Preferred Location </th>
                                                <td><?= esc($customers['preferred_location']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Lead Source </th>
                                                <td><?= esc($customers['lead_source']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date of Enquiry</th>
                                                <td><?= esc($customers['enquiry_date']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Assigned Staff </th>
                                                <td><?= esc($customers['assigned_staff_id']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>





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
                                                    <th scope="col">Follow-Up Date </th>
                                                    <th scope="col">Next Follow-Up Date </th>
                                                    <th scope="col">Communication Mode</th>
                                                    <th scope="col">Follow-Up Notes </th>
                                                    <th scope="col">Follow-Up Status </th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($followups)) : $u = 0;
                                                    foreach ($followups as $followup) :  $u++; ?>
                                                        <tr>

                                                            <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                                            <td><?= esc($followup['follow_up_date']) ?></td>
                                                            <td><?= esc($followup['next_follow_up_date']) ?></td>
                                                            <td><?= esc($followup['communication_mode']) ?></td>
                                                            <td><?= esc($followup['notes']) ?></td>
                                                            <td><?= esc($followup['status']) ?></td>

                                                            <td>

                                                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $followup['id']; ?>)" title="Delete Customer"
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
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location.href = "<?= base_url('leads') ?>";
            return false;
        });

       

        // Show/hide the right button based on status selection
    $('#fstatus').on('change', function () {
        var status = $(this).val();
   
        if (status === 'Converted') {
            $('#followupBtn').hide();
            $('#convertionBtn').show();
        } else {
            $('#followupBtn').show();
            $('#convertionBtn').hide();
        }
    });

    // Handle form submit
    $('#followupForm').on('submit', function (e) {
        var status = $('#fstatus').val();

        if (status === 'Converted') {
            // Submit to convertion
            var aid = $('#aid').val(); 
            $(this).attr('action', '<?= base_url('convertion') ?>/' + aid);
        } else {
            // Submit to normal follow-up save
            $(this).attr('action', '<?= base_url('save-followup') ?>');
        }

        // Allow the form to continue submitting
    });

    });



    function capitalizeFirstLetter(input) {
        input.value = input.value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    }

    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this FollowUp Details?")) {
            window.location.href = "<?= base_url('delete-followup/') ?>" + id;
        }
    }
</script>
<?= $this->endSection(); ?>