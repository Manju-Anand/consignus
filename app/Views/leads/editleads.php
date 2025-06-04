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
            <h6 class="fw-semibold mb-3"><img src="<?= base_url('public/assets/images/rating.png') ?>" style="width:30px;height:30px;"> CUSTOMER DETAILS EDIT</h6>
            <!-- <hr> -->

            <form action="<?= site_url('leadsedit-form') ?>" method="post" enctype="multipart/form-data">
                <?php if (!empty($custlist)) : ?>
                    <div class="row">

                        <input type="hidden" class="form-control radius-8" id="aid" name="aid" value="<?= esc($custlist['id']) ?>">
                        <!-- <input type="hidden" class="form-control radius-8" id="uid" name="uid" value=">"> -->

                        <div class="col-xxl-6 col-lg-6">
                            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                                <div class="card-body p-24">

                                    <div class="col-sm-12 mb-10">
                                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span
                                                class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control form-control-sm " id="aname" oninput="capitalizeFirstLetter(this)" placeholder="Enter Employee Name"
                                            name="aname" value="<?= esc($custlist['name']); ?>">
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'aname'); ?></span>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone No <span
                                                    class="text-danger-600">*</span></label>
                                            <input type="number" class="form-control form-control-sm " id="aphone" placeholder="Enter Phone No"
                                                name="aphone" value="<?= esc($custlist['phone']); ?>">
                                        </div>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'aphone'); ?></span>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Email
                                                <span class="text-danger-600">*</span></label>
                                            <input type="email" class="form-control form-control-sm " id="aemail" placeholder="Enter Email Id"
                                                name="aemail" value="<?= esc($custlist['email']); ?>">
                                        </div>

                                        <span class="text-danger"><?= display_errors($validation ?? null, 'aemail'); ?></span>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="addr" class="form-label fw-semibold text-primary-light text-sm mb-8">Address </label>
                                            <textarea class="form-control radius-8" id="addr" placeholder="Enter Address" name="addr">
                                            <?= esc($custlist['address']); ?></textarea>

                                        </div>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'addr'); ?></span>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="budget" class="form-label fw-semibold text-primary-light text-sm mb-8">Budget Range </label>
                                            <input type="text" class="form-control form-control-sm" id="budget" placeholder="Enter Budget Range "
                                                name="budget" value="<?= esc($custlist['budget_range']); ?>">
                                        </div>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'budget'); ?></span>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="agents" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Agents <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control form-control-sm form-select" id="agents" name="agents">
                                                <option selected disabled>Select Agent</option>
                                                <?php if (!empty($agents)) : $u = 0;
                                                    foreach ($agents as $agents) :  $u++; ?>
                                                        <option value="<?= $agents['id']; ?>" <?= ($custlist['agentid'] == $agents['id']) ? 'selected' : ''; ?>>
                                                            <?= $agents['name']; ?>
                                                        </option>

                                                    <?php endforeach; ?>

                                                <?php endif; ?>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'agents'); ?></span>
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
                                            <select class="form-control  form-control-sm form-select" id="requirement" name="requirement">
                                                <option disabled>Select Requirement</option>
                                                <option <?php if ($custlist['requirement_type'] == "Flat") { ?> selected <?php }  ?> value="Flat">Flat</option>
                                                <option <?php if ($custlist['requirement_type'] == "Villa") { ?> selected <?php }  ?> value="Villa">Villa</option>
                                                <option <?php if ($custlist['requirement_type'] == "Land") { ?> selected <?php }  ?> value="Land">Land</option>
                                                <option <?php if ($custlist['requirement_type'] == "Rental") { ?> selected <?php }  ?> value="Rental">Rental</option>
                                                <option <?php if ($custlist['requirement_type'] == "Airport Pickup") { ?> selected <?php }  ?> value="Airport Pickup">Airport Pickup</option>
                                                <option <?php if ($custlist['requirement_type'] == "Gifting") { ?> selected <?php }  ?> value="Gifting">Gifting</option>
                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'requirement'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="location" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Preferred Location <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control  form-control-sm form-select" id="location" name="location">
                                                <option disabled>Select Location</option>
                                                <option <?php if ($custlist['preferred_location'] == "Chengannur") { ?> selected <?php }  ?> value="Chengannur">Chengannur</option>
                                                <option <?php if ($custlist['preferred_location'] == "Adoor") { ?> selected <?php }  ?> value="Adoor">Adoor</option>
                                                <option <?php if ($custlist['preferred_location'] == "Thiruvalla") { ?> selected <?php }  ?> value="Thiruvalla">Thiruvalla</option>
                                                <option <?php if ($custlist['preferred_location'] == "Pathanamthitta") { ?> selected <?php }  ?> value="Pathanamthitta">Pathanamthitta</option>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'location'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="lead" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Lead Source <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control form-control-sm form-select" id="lead" name="lead">
                                                <option disabled>Select Lead</option>
                                                <option <?php if ($custlist['lead_source'] == "Website") { ?> selected <?php }  ?> value="Website">Website</option>
                                                <option <?php if ($custlist['lead_source'] == "Walk-in") { ?> selected <?php }  ?> value="Walk-in">Walk-in</option>
                                                <option <?php if ($custlist['lead_source'] == "Referral") { ?> selected <?php }  ?> value="Referral">Referral</option>
                                                <option <?php if ($custlist['lead_source'] == "Social Media") { ?> selected <?php }  ?> value="Social Media">Social Media</option>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'lead'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="edate" class="form-label fw-semibold text-primary-light text-sm mb-8">Date of Enquiry <span
                                                    class="text-danger-600">*</span></label>
                                            <input type="date" class="form-control form-control-sm " id="edate" oninput="capitalizeFirstLetter(this)" placeholder="Enter Password"
                                                name="edate" value="<?= esc($custlist['enquiry_date']); ?>">
                                        </div>
                                        <span class="text-danger"><?= display_errors($validation ?? null, 'edate'); ?></span>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="astaff" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Assigned Staff <span class="text-danger-600">*</span>
                                            </label>
                                            <select class="form-control form-control-sm form-select" id="astaff" name="astaff">
                                                <option selected disabled>Select Staff</option>
                                                <?php if (!empty($staffs)) : $u = 0;
                                                    foreach ($staffs as $staff) :  $u++; ?>
                                                        <option value="<?= $staff['id']; ?>" <?= ($custlist['assigned_staff_id'] == $staff['id']) ? 'selected' : ''; ?>>
                                                            <?= $staff['full_name']; ?>
                                                        </option>

                                                    <?php endforeach; ?>

                                                <?php endif; ?>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'astaff'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="leadstatus" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                                Lead Status
                                            </label>
                                            <select class="form-control form-control-sm form-select" id="leadstatus" name="leadstatus">
                                                <option disabled>Select Lead Status</option>
                                                <option <?php if ($custlist['leadstatus'] == "Converted") { ?> selected <?php }  ?> value="Converted">Converted</option>
                                                <option <?php if ($custlist['leadstatus'] == "Started") { ?> selected <?php }  ?> value="Started">Started</option>

                                            </select>
                                            <span class="text-danger"><?= display_errors($validation ?? null, 'leadstatus'); ?></span>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>



                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">

                            <button type="submit" name="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                                Update Change
                            </button>
                            <button type="reset" id="cancel" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-24 py-8 radius-8">
                                Cancel
                            </button>
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
    });

    function capitalizeFirstLetter(input) {
        input.value = input.value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    }
   
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
</script>
<?= $this->endSection(); ?>