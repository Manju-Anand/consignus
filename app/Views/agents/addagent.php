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
      <h6 class="fw-semibold mb-3">AGENT DETAILS</h6>
      <!-- <hr> -->

      <form action="<?= site_url('agentsadd-form') ?>" method="post" >

        <div class="row">
         
          <div class="col-xxl-12 col-lg-12">
            <div class="card h-100 border shadow-none radius-8 overflow-hidden">
              <div class="card-body p-24">

                <div class="col-sm-12 mb-10">
                  <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span
                      class="text-danger-600">*</span></label>
                  <input type="text" class="form-control form-control-sm radius-8" id="aname" oninput="capitalizeFirstLetter(this)" placeholder="Enter Agent Name" name="aname" value="<?= set_value('aname'); ?>">
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
                    <label for="addr" class="form-label fw-semibold text-primary-light text-sm mb-8">Address </label>
                    <input type="text" class="form-control form-control-sm radius-8" id="addr" placeholder="Enter Address" name="addr" value="<?= set_value('addr'); ?>">
                  </div>
                  <span class="text-danger"><?= display_errors($validation ?? null, 'addr'); ?></span>
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
      window.location.href = "<?= base_url('agents') ?>";
      return false;
    });
  });

  function capitalizeFirstLetter(input) {
    input.value = input.value.replace(/\b\w/g, function(char) {
      return char.toUpperCase();
    });
  }
 
</script>
<?= $this->endSection(); ?>