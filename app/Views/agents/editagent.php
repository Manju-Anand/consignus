<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>
<?= "userdata" ?>
<?= $this->endSection(); ?>


<?= $this->section("content"); ?>



<style>
  .text-danger:empty {
    display: none;
  }
</style>

<div class="dashboard-main-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Agents</h6>
    <ul class="d-flex align-items-center gap-2">
      <li class="fw-medium">
        <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Masters
        </a>
      </li>
      <li>-</li>
      <li class="fw-medium">Agents Details - Edit</li>
    </ul>
  </div>

  <div class="card h-100 p-0 radius-12 overflow-hidden">
    <div class="card-body p-40">

      <form action="<?= site_url('editagents-form') ?>" method="post" >
        <?php if (!empty($agent)) : ?>

          <input type="hidden" class="form-control radius-8" id="aid" name="aid" value="<?= esc($agent['id']) ?>">
      
          <div class="row">
          
            <div class="col-xxl-12 col-lg-12">
              <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                <div class="card-body p-24">

                  <div class="col-sm-12 mb-10">
                    <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span
                        class="text-danger-600">*</span></label>
                    <input type="text" class="form-control form-control-sm radius-8" id="aname" oninput="capitalizeFirstLetter(this)" placeholder="Enter Employee Name" name="aname" value="<?= esc($agent['name']); ?>">
                    <span class="text-danger"><?= display_errors($validation ?? null, 'aname'); ?></span>

                  </div>
                   <div class="col-sm-12">
                    <div class="mb-20">
                      <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone No <span
                          class="text-danger-600">*</span></label>
                      <input type="number" class="form-control form-control-sm radius-8" id="aphone" placeholder="Enter Phone No" name="aphone" value="<?= esc($agent['phoneno']); ?>">
                    </div>
                    <span class="text-danger"><?= display_errors($validation ?? null, 'aphone'); ?></span>
                  </div>

                  <div class="col-sm-12">
                    <div class="mb-20">
                      <label for="addr" class="form-label fw-semibold text-primary-light text-sm mb-8">Address </label>
                      <input type="text" class="form-control form-control-sm radius-8" id="addr" placeholder="Enter Address" name="addr" value="<?= esc($agent['address']); ?>">
                    </div>
                    <span class="text-danger"><?= display_errors($validation ?? null, 'addr'); ?></span>
                  </div>
                 
                </div>
              </div>

            </div>

           


            <!-- ********************************************************* -->



            <div class="d-flex align-items-center justify-content-center gap-3 mt-24">

              <button type="submit" name="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                Update Changes
              </button>
              <button type="reset" id="cancel"
                class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-8 radius-8">
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
      window.location.href = "<?= base_url('agents') ?>";
      return false;
    });
  });

  function capitalizeFirstLetter(input) {
    input.value = input.value.replace(/\b\w/g, function(char) {
      return char.toUpperCase();
    });
  }

  // ***************************************************************


 
</script>
<?= $this->endSection(); ?>