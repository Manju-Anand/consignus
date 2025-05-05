<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>


<?= $this->section("content"); ?>
<div class="dashboard-main-body">

  <style>
    .text-danger:empty {
      display: none;
    }
  </style>
  <!-- <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add Blog</h6>
    <ul class="d-flex align-items-center gap-2">
      <li class="fw-medium">
        <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard
        </a>
      </li>
      <li>-</li>
      <li class="fw-medium">Add Blog</li>
    </ul>
  </div> -->

  <div class="row gy-4">
    <div class="col-lg-12">
      <div class="card mt-24">
        <div class="card-header border-bottom">
          <h6 class="text-xl mb-0">Add New Property</h6>
        </div>
        <div class="row">
          <div class="col-md-6">

          </div>
        </div>
        <div class="card-body p-24">
          <form action="<?= site_url('propertyadd-form') ?>" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-20">
            <div class="row">

              <div class="col-md-6">
                <label class="form-label fw-bold text-neutral-900" for="title">Property Title: </label>
                <input type="text" class="form-control border border-neutral-200 radius-8" id="ptitle" name="ptitle"
                  placeholder="Enter Post Title" value="<?= set_value('ptitle'); ?>">
                <span class="text-danger"><?= display_errors($validation ?? null, 'ptitle'); ?></span>
                <!-- ******************************************************** -->
                <label class="form-label fw-bold text-neutral-900">Category: </label>
                <select class="form-control form-select border border-neutral-200 radius-8" id="pcategory" name="pcategory">
                  <option value="Flat">Flat</option>
                  <option value="Villa">Villa</option>
                  <option value="Land">Land</option>
                  <option value="Rental">Rental</option>
                </select>
                <span class="text-danger"><?= display_errors($validation ?? null, 'pcategory'); ?></span>
                <!-- ***************************** -->
                <label class="form-label fw-bold text-neutral-900">Purpose: </label>
                <select class="form-control form-select border border-neutral-200 radius-8" id="purpose" name="purpose">
                  <option value="Sale">Sale</option>
                  <option value="Rent">Rent</option>

                </select>
                <span class="text-danger"><?= display_errors($validation ?? null, 'purpose'); ?></span>
                <!-- *********************************************** -->
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label fw-bold text-neutral-900" for="price">Price: </label>
                    <input type="text" class="form-control border border-neutral-200 radius-8" id="price" name="price"
                      placeholder="Enter Price" value="<?= set_value('price'); ?>">
                    <span class="text-danger"><?= display_errors($validation ?? null, 'price'); ?></span>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold text-neutral-900" for="propertyno">No of Properties: </label>
                    <input type="text" class="form-control border border-neutral-200 radius-8" id="propertyno" name="propertyno"
                      placeholder="Enter No of Properties" value="<?= set_value('propertyno'); ?>">
                    <span class="text-danger"><?= display_errors($validation ?? null, 'propertyno'); ?></span>
                  </div>
                </div>
                <!-- ********************************************** -->
                <label class="form-label fw-bold text-neutral-900" for="location">Location: </label>
                <input type="text" class="form-control border border-neutral-200 radius-8" id="location" name="location"
                  placeholder="Enter Location" value="<?= set_value('location'); ?>">
                <span class="text-danger"><?= display_errors($validation ?? null, 'location'); ?></span>



              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold text-neutral-900">Property Type: </label>
                <select class="form-control form-select border border-neutral-200 radius-8" id="ptype" name="ptype">
                  <option selected disabled>Select Property Type</option>
                  <?php foreach ($ptype as $ptype): ?>
                    <option value="<?= esc($ptype['id']); ?>"><?= esc($ptype['name']); ?></option>
                  <?php endforeach; ?>

                </select>
                <span class="text-danger"><?= display_errors($validation ?? null, 'ptype'); ?></span>

                <!-- Table Placeholder -->
                <div id="propertyDetailsTable" class="mt-3"></div>
              </div>




            </div>
            <!-- ******************************************************************** -->

            <div>
              <label class="form-label fw-bold text-neutral-900">Property Amenities & other Description </label>
              <div class="border border-neutral-200 radius-8 overflow-hidden">
                <div class="height-200">
                  <!-- Editor Toolbar Start -->
                  <div id="toolbar-container">
                    <span class="ql-formats">
                      <select class="ql-font"></select>
                      <select class="ql-size"></select>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-bold"></button>
                      <button class="ql-italic"></button>
                      <button class="ql-underline"></button>
                      <button class="ql-strike"></button>
                    </span>
                    <span class="ql-formats">
                      <select class="ql-color"></select>
                      <select class="ql-background"></select>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-script" value="sub"></button>
                      <button class="ql-script" value="super"></button>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-header" value="1"></button>
                      <button class="ql-header" value="2"></button>
                      <button class="ql-blockquote"></button>
                      <button class="ql-code-block"></button>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-list" value="ordered"></button>
                      <button class="ql-list" value="bullet"></button>
                      <button class="ql-indent" value="-1"></button>
                      <button class="ql-indent" value="+1"></button>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-direction" value="rtl"></button>
                      <select class="ql-align"></select>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-link"></button>
                      <button class="ql-image"></button>
                      <button class="ql-video"></button>
                      <button class="ql-formula"></button>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-clean"></button>
                    </span>
                  </div>
                  <!-- Editor Toolbar Start -->

                  <!-- Editor start -->
                  <div id="editor">
                    <p class=""></p>
                    <p><br></p>
                  </div>
                  <!-- Edit End -->
                </div>
              </div>
            </div>

            <textarea name="editor_content" id="editor_content" style="display: none;"></textarea>

            <div>
              <label class="form-label fw-bold text-neutral-900">Upload Property Images </label>
              <div class="col-md-12">
                <div class="card h-100 p-0">

                  <div class="card-body p-24">

                    <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                      <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>

                      <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file-multiple">
                        <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                        <span class="fw-semibold text-secondary-light">Upload</span>
                        <input id="upload-file-multiple" name="upload-file-multiple[]" type="file" hidden multiple>
                      </label>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label class="form-label fw-bold text-neutral-900">Property Status:</label>

                <select class="form-control form-select border border-neutral-200 radius-8" id="pstatus" name="pstatus">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>

                </select>
                <span class="text-danger"><?= display_errors($validation ?? null, 'pstatus'); ?></span>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold text-neutral-900">Featured Property </label>

                <select class="form-control form-select border border-neutral-200 radius-8" id="featured" name="featured">
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>

                </select>
                <span class="text-danger"><?= display_errors($validation ?? null, 'featured'); ?></span>
              </div>

            </div>



            <button type="submit" name="submit" class="btn btn-primary-600 radius-8">Submit</button>
            <!-- <button type="reset" id="cancel" class="btn btn-primary-600 radius-8">Cancel</button> -->


          </form>
        </div>
      </div>
    </div>

    <!-- Sidebar Start -->

  </div>
</div>





<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>


<script src="<?= base_url(); ?>public/assets/js/editor.highlighted.min.js"></script>
<script src="<?= base_url(); ?>public/assets/js/editor.quill.js"></script>
<script src="<?= base_url(); ?>public/assets/js/editor.katex.min.js"></script>
<script>
  // Editor Js Start
  const quill = new Quill('#editor', {
    modules: {
      syntax: true,
      toolbar: '#toolbar-container',
    },
    placeholder: 'Compose an epic...',
    theme: 'snow',
  });

  // Ensure content updates automatically in hidden input
  quill.on('text-change', function() {
    document.querySelector("#editor_content").value = quill.root.innerHTML;
  });

  // Editor Js End
  // ================================================ Upload Multiple image js Start here ================================================
  const fileInputMultiple = document.getElementById("upload-file-multiple");
  const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

  fileInputMultiple.addEventListener("change", (e) => {
    const files = e.target.files;

    Array.from(files).forEach(file => {
      const src = URL.createObjectURL(file);

      const imgContainer = document.createElement('div');
      imgContainer.classList.add('position-relative', 'h-120-px', 'w-120-px', 'border', 'input-form-light', 'radius-8', 'overflow-hidden', 'border-dashed', 'bg-neutral-50');

      const removeButton = document.createElement('button');
      removeButton.type = 'button';
      removeButton.classList.add('uploaded-img__remove', 'position-absolute', 'top-0', 'end-0', 'z-1', 'text-2xxl', 'line-height-1', 'me-8', 'mt-8', 'd-flex');
      removeButton.innerHTML = '<iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>';

      const imagePreview = document.createElement('img');
      imagePreview.classList.add('w-100', 'h-100', 'object-fit-cover');
      imagePreview.src = src;

      imgContainer.appendChild(removeButton);
      imgContainer.appendChild(imagePreview);
      uploadedImgsContainer.appendChild(imgContainer);

      removeButton.addEventListener('click', () => {
        URL.revokeObjectURL(src);
        imgContainer.remove();
      });
    });

    // Clear the file input so the same file(s) can be uploaded again if needed
    // fileInputMultiple.value = '';
  });

  $('#ptype').on('change', function() {
    var propertyTypeId = $(this).val();

    $.ajax({
      url: '<?= base_url('get-property-details'); ?>',
      type: 'POST',
      data: {
        id: propertyTypeId
      },
      success: function(response) {
        $('#propertyDetailsTable').html(response);
      },
      error: function() {
        alert('Error fetching property details.');
      }
    });
  });
</script>

<?= $this->endSection(); ?>