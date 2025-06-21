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
                    <h6 class="text-xl mb-0">Add New Property Type</h6>
                </div>
                <div class="card-body p-24">
                    <form action="<?= site_url('property-type-add-form') ?>" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-20">
                        <div class="row">

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900" for="title">Property Type Title: </label>
                                <input type="text" class="form-control border border-neutral-200 radius-8" id="ptitle" name="ptitle"
                                    placeholder="Enter Property Type Title" value="<?= set_value('ptitle'); ?>">
                                <span class="text-danger"><?= display_errors($validation ?? null, 'ptitle'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900">Category: </label>
                                <select class="form-control form-select border border-neutral-200 radius-8" id="pcategory" name="pcategory">
                                    <option value="Flat">Flat</option>
                                    <option value="Villa">Villa</option>
                                    <option value="Land">Land</option>
                                    <option value="Rental">Rental</option>
                                    <option value="House">House</option>
                                    <option value="Home-Stay">Home-Stay</option>
                                </select>
                                <span class="text-danger"><?= display_errors($validation ?? null, 'pcategory'); ?></span>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900" for="bedroom">Bedrooms: </label>
                                <input type="text" class="form-control border border-neutral-200 radius-8" id="bedroom" name="bedroom"
                                    placeholder="Enter No of Bedrooms" value="<?= set_value('bedroom'); ?>">
                                <span class="text-danger"><?= display_errors($validation ?? null, 'bedroom'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900" for="bathroom">Bathrooms: </label>
                                <input type="text" class="form-control border border-neutral-200 radius-8" id="bathroom" name="bathroom"
                                    placeholder="Enter No of Bathrooms" value="<?= set_value('bathroom'); ?>">
                                <span class="text-danger"><?= display_errors($validation ?? null, 'bathroom'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900" for="balconies">Balconies: </label>
                                <input type="text" class="form-control border border-neutral-200 radius-8" id="balconies" name="balconies"
                                    placeholder="Enter No of Balconies" value="<?= set_value('balconies'); ?>">
                                <span class="text-danger"><?= display_errors($validation ?? null, 'balconies'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900" for="sarea">Super_Builtup_Area: </label>
                                <input type="text" class="form-control border border-neutral-200 radius-8" id="sarea" name="sarea"
                                    placeholder="Enter Super_Builtup_Area" value="<?= set_value('sarea'); ?>">
                                <span class="text-danger"><?= display_errors($validation ?? null, 'sarea'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900" for="carea">Carpet_Area: </label>
                                <input type="text" class="form-control border border-neutral-200 radius-8" id="carea" name="carea"
                                    placeholder="Enter Carpet_Area" value="<?= set_value('carea'); ?>">
                                <span class="text-danger"><?= display_errors($validation ?? null, 'carea'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-neutral-900">Property Status:</label>

                                <select class="form-control form-select border border-neutral-200 radius-8" id="pstatus" name="pstatus">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>

                                </select>
                                <span class="text-danger"><?= display_errors($validation ?? null, 'pstatus'); ?></span>
                            </div>







                        </div>
                        <!-- ******************************************************************** -->

                        <div>
                            <label class="form-label fw-bold text-neutral-900">Property Description </label>
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




                        <div class="row">
                            <div class="col-md-6 text-end">
                                <button type="submit" name="submit" class="btn btn-primary-600 radius-8 px-60 py-8 w-100">Submit</button>

                            </div>
                            <div class="col-md-6">
                                <button type="reset" id="cancel" class="btn btn-warning-600 radius-8 px-60 py-8 w-100">Cancel</button>
                            </div>
                        </div>


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

    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location.href = "<?= base_url('property-type') ?>";
            return false;
        });
    });
</script>

<?= $this->endSection(); ?>