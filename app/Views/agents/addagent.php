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
      <h6 class="fw-semibold mb-3">EMPLOYEE DETAILS</h6>
      <!-- <hr> -->

      <form action="<?= site_url('staffadd-form') ?>" method="post" enctype="multipart/form-data">

        <div class="row">
          <!-- ********************************************** -->
          <div class="col-xxl-4 col-lg-6">
            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
              <div class="card-body p-24">
                <h6 class="text-md text-primary-light mb-16">Profile Image</h6>

                <!-- Upload Image Start mb-24 mt-16-->
                <div class="col-sm-2 mb-10 ">
                  <div class="avatar-upload">
                    <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                      <input type='file' name="profile_image" id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                      <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                        <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                      </label>
                    </div>
                    <div class="avatar-preview">
                      <div id="imagePreview"> </div>
                    </div>
                  </div>
                </div>
                <!-- Upload Image End -->


                <div class="col-sm-12 mb-10">
                  <label for="uname" class="form-label fw-semibold text-primary-light text-sm mb-8">User Name <span
                      class="text-danger-600">*</span></label>
                  <input type="text" class="form-control form-control-sm radius-8" id="uname" oninput="capitalizeFirstLetter(this)" placeholder="Enter Employee User Name" name="uname" value="<?= set_value('uname'); ?>">
                  <span class="text-danger"><?= display_errors($validation ?? null, 'uname'); ?></span>

                </div>

                <div class="col-md-12">
                  <label for="jdate" class="form-label fw-semibold text-primary-light text-sm">Password <span class="text-danger-600">*</span></label>
                  <div class="position-relative mb-15">
                    <div class="icon-field">
                      <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                      </span>
                      <input type="password" class="form-control form-control-sm h-56-px bg-neutral-50 radius-12" value="<?= set_value('password'); ?>" name="password" id="password" placeholder="Password">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#password"></span>

                  </div>
                  <span class="text-danger"><?= display_errors($validation ?? null, 'password'); ?></span>
                </div>

              </div>
            </div>
          </div>


          <!-- ****************************************************** -->
          <div class="col-xxl-5 col-lg-6">
            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
              <div class="card-body p-24">

                <div class="col-sm-12 mb-10">
                  <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span
                      class="text-danger-600">*</span></label>
                  <input type="text" class="form-control form-control-sm radius-8" id="aname" oninput="capitalizeFirstLetter(this)" placeholder="Enter Employee Name" name="aname" value="<?= set_value('aname'); ?>">
                  <span class="text-danger"><?= display_errors($validation ?? null, 'aname'); ?></span>

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
                    <input type="text" class="form-control form-control-sm radius-8" id="addr" placeholder="Enter Address" name="addr" value="<?= set_value('addr'); ?>">
                  </div>
                  <span class="text-danger"><?= display_errors($validation ?? null, 'addr'); ?></span>
                </div>
                <div class="col-sm-12">
                  <div class="mb-20">
                    <label for="dept" class="form-label fw-semibold text-primary-light text-sm mb-8">Department </label>
                    <input type="text" class="form-control form-control-sm radius-8" id="dept" placeholder="Enter Department" name="dept" value="<?= set_value('dept'); ?>">
                  </div>
                  <span class="text-danger"><?= display_errors($validation ?? null, 'dept'); ?></span>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xxl-3 col-lg-6">
            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
              <div class="card-body p-24">

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
                    <label for="role" class="form-label fw-semibold text-primary-light text-sm mb-8">
                      Role <span class="text-danger-600">*</span>
                    </label>
                    <select class="form-control form-control-sm radius-8 form-select" id="role" name="role">
                      <option selected disabled>Select Role</option>
                      <option value="Admin">Admin</option>
                      <option value="Manager">Manager</option>
                      <option value="Sales-Executive">Sales Executive</option>
                      <option value="Support">Support</option>
                    </select>
                    <span class="text-danger"><?= display_errors($validation ?? null, 'role'); ?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="mb-20">
                    <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">
                      Status <span class="text-danger-600">*</span>
                    </label>
                    <select class="form-control form-control-sm radius-8 form-select" id="status" name="status">
                      <option disabled>Select Status</option>
                      <option value="Active" selected>Active</option>
                      <option value="Inactive">Inactive</option>

                    </select>
                    <span class="text-danger"><?= display_errors($validation ?? null, 'status'); ?></span>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="mb-20">
                    <label for="jdate" class="form-label fw-semibold text-primary-light text-sm mb-8">Date Joined <span
                        class="text-danger-600">*</span></label>
                    <input type="date" class="form-control form-control-sm radius-8" id="jdate" oninput="capitalizeFirstLetter(this)" placeholder="Enter Password" name="jdate" value="<?= set_value('jdate'); ?>">
                  </div>
                  <span class="text-danger"><?= display_errors($validation ?? null, 'jdate'); ?></span>
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
      window.location.href = "<?= base_url('staff') ?>";
      return false;
    });
  });

  function capitalizeFirstLetter(input) {
    input.value = input.value.replace(/\b\w/g, function(char) {
      return char.toUpperCase();
    });
  }
  // ================== Image Upload Js Start ===========================
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imageUpload").change(function() {
    readURL(this);
  });
  // ================== Image Upload Js End ===========================
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