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
            <h6 class="fw-semibold mb-3"><img src="<?= base_url('public/assets/images/rating.png') ?>" style="width:30px;height:30px;"> LEADS DETAILS</h6>
            <!-- <hr> -->

            <form action="<?= site_url('leadsadd-form') ?>" method="post" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-xxl-6 col-lg-6">
                        <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                            <div class="card-body p-24">

                                <div class="col-sm-12 mb-10">
                                    <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control form-control-sm radius-8" id="aname" oninput="capitalizeFirstLetter(this)" placeholder="Enter Client Name" name="aname" value="<?= set_value('aname'); ?>">
                                    <span class="text-danger"><?= display_errors($validation ?? null, 'aname'); ?></span>

                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone No <span
                                                class="text-danger-600">*</span></label>
                                        <input type="number" class="form-control form-control-sm radius-8" id="aphone" placeholder="Enter Phone No" name="aphone" value="<?= set_value('aphone'); ?>">
                                    </div>
                                    <span class="text-danger"><?= display_errors($validation ?? null, 'aphone'); ?></span>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Email
                                            <span class="text-danger-600">*</span></label>
                                        <input type="email" class="form-control form-control-sm radius-8" id="aemail" placeholder="Enter Email Id" name="aemail" value="<?= set_value('aemail'); ?>">
                                    </div>

                                    <span class="text-danger"><?= display_errors($validation ?? null, 'aemail'); ?></span>

                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="addr" class="form-label fw-semibold text-primary-light text-sm mb-8">Address </label>
                                        <textarea class="form-control form-control-sm radius-8" id="addr" placeholder="Enter Address" name="addr"><?= set_value('addr'); ?></textarea>

                                    </div>
                                    <span class="text-danger"><?= display_errors($validation ?? null, 'addr'); ?></span>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="budget" class="form-label fw-semibold text-primary-light text-sm mb-8">Budget Range </label>
                                        <input type="text" class="form-control form-control-sm radius-8" id="budget" placeholder="Enter Budget Range " name="budget" value="<?= set_value('dept'); ?>">
                                    </div>
                                    <span class="text-danger"><?= display_errors($validation ?? null, 'budget'); ?></span>
                                </div>

                                  <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="agents" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Agents
                                        </label>
                                        <select class="form-control form-control-sm radius-8 form-select" id="agents" name="agents">
                                            <option selected disabled>Select Agent</option>
                                            <?php if (!empty($agents)) : $u = 0;
                                                foreach ($agents as $agents) :  $u++; ?>
                                                    <option value="<?= $agents['id']; ?>"><?= $agents['name']; ?></option>
                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </select>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'agents'); ?></span>
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="lpurpose" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Lead Purpose <span class="text-danger-600">*</span>
                                        </label>
                                        <select class="form-control form-control-sm radius-8 form-select" id="lpurpose" name="lpurpose">
                                            <option disabled>Select Lead Purpose</option>
                                            <option value="Rental">Rental</option>
                                            <option value="Buyer">Buyer</option>
                                            

                                        </select>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'lpurpose'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xxl-6 col-lg-6">
                        <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                            <div class="card-body p-24">



                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="requirement" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Type of Requirement <span class="text-danger-600">*</span>
                                        </label>
                                        <select class="form-control form-control-sm radius-8 form-select" id="requirement" name="requirement">
                                            <option selected disabled>Select Requirement</option>
                                            <option value="Flat">Flat</option>
                                            <option value="Villa">Villa</option>
                                            <option value="Land">Land</option>
                                            <option value="House">House</option>
                                           
                                        </select>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'requirement'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="location" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Preferred Location <span class="text-danger-600">*</span>
                                        </label>
                                        <select class="form-control form-control-sm radius-8 form-select" id="location" name="location">
                                            <option disabled>Select Location</option>
                                            <option value="Chengannur">Chengannur</option>
                                            <option value="Adoor">Adoor</option>
                                            <option value="Thiruvalla">Thiruvalla</option>
                                            <option value="Pathanamthitta">Pathanamthitta</option>

                                        </select>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'location'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="lead" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Lead Source <span class="text-danger-600">*</span>
                                        </label>
                                        <select class="form-control form-control-sm radius-8 form-select" id="lead" name="lead">
                                            <option disabled>Select Lead</option>
                                            <option value="Website">Website</option>
                                            <option value="Walk-in">Walk-in</option>
                                            <option value="Referral">Referral</option>
                                            <option value="Social Media">Social Media</option>

                                        </select>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'lead'); ?></span>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="refername" class="form-label fw-semibold text-primary-light text-sm mb-8">Referer Name </label>
                                        <input type="text" class="form-control form-control-sm radius-8" id="refername" placeholder="Enter Referer Name " name="refername" value="<?= set_value('refername'); ?>" readonly>
                                    </div>
                                    <span class="text-danger"><?= display_errors($validation ?? null, 'refername'); ?></span>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="edate" class="form-label fw-semibold text-primary-light text-sm mb-8">Date of Enquiry <span
                                                class="text-danger-600">*</span></label>
                                        <input type="date" class="form-control form-control-sm radius-8" id="edate" placeholder="Enter Password" name="edate" value="<?= set_value('edate'); ?>">
                                    </div>
                                    <span class="text-danger"><?= display_errors($validation ?? null, 'edate'); ?></span>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="astaff" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Assigned Staff <span class="text-danger-600">*</span>
                                        </label>
                                        <select class="form-control form-control-sm radius-8 form-select" id="astaff" name="astaff">
                                            <option selected disabled>Select Staff</option>
                                            <?php if (!empty($staffs)) : $u = 0;
                                                foreach ($staffs as $staff) :  $u++; ?>
                                                    <option value="<?= $staff['id']; ?>"><?= $staff['full_name']; ?></option>
                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </select>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'astaff'); ?></span>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>



                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">

                        <button type="submit" name="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                            Save Change
                        </button>
                        <button type="reset" id="cancel"
                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-24 py-8 radius-8">
                            Cancel
                        </button>
                    </div>
                </div>
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
    });

    function capitalizeFirstLetter(input) {
        input.value = input.value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    }
    // ================== Image Upload Js Start ===========================
   


    $(document).ready(function () {
        $('#lead').on('change', function () {
            const selected = $(this).val();

            if (selected === 'Referral') {
                $('#refername').prop('readonly', false);
            } else {
                $('#refername').val(''); // clear input
                $('#refername').prop('readonly', true);
            }
        });

        // Optional: trigger once on load to set correct initial state
        $('#lead').trigger('change');
    });


</script>
<?= $this->endSection(); ?>