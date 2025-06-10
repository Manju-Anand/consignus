<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>


<?= $this->section("content"); ?>


<style>
    .mainimage-wrapper {
        width: 1174px;
        height: 454px;
        overflow: hidden;
        position: relative;
        background-color: #f0f0f0;
        /* optional */
    }

    .mainimage-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background-color: #e0e0e0;
        /* to fill blank areas */
    }

    .subimage-wrapper {
        width: 269px;
        height: 199px;
        overflow: hidden;
        position: relative;
        background-color: #f0f0f0;
        /* optional */
    }

    .subimage-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background-color: #e0e0e0;
        /* to fill blank areas */
    }

    .submainimage-wrapper {
        width: 563px;
        height: 411px;
        overflow: hidden;
        position: relative;
        background-color: #f0f0f0;
        /* optional */
    }

    .submainimage-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background-color: #e0e0e0;
        /* to fill blank areas */
    }


    /* Limits popup image size within viewport */
    .mfp-img {
        max-width: 90vw !important;
        max-height: 90vh !important;
        height: auto;
        width: auto;
        margin: 0 auto;
        display: block;
    }
</style>
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">View Property </h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Property Details</li>
        </ul>
    </div>
    <?php if (!empty($property)) : ?>
 
        <div class="card h-100 p-0 radius-12 overflow-hidden gallery-scale">
            <div class="card-body p-24">
               
                    <div class="row gy-4">
                        <?php if (count($propertyimages) == 1): ?>
                            <div class="col-md-12">
                                <div class="hover-scale-img border radius-16 overflow-hidden p-8 mainimage-wrapper">
                                    <a href="<?= base_url('public/uploads/property/' . $propertyimages[0]->image_path) ?>" class="popup-img w-100 h-100  d-flex radius-12 overflow-hidden">
                                        <img src="<?= base_url('public/uploads/property/' . $propertyimages[0]->image_path) ?>" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                    </a>
                                </div>


                            </div>
                        <?php elseif (count($propertyimages) > 1): ?>
                            <div class="col-md-6">
                                <div class="hover-scale-img border radius-16 overflow-hidden p-8 submainimage-wrapper">
                                    <a href="<?= base_url('public/uploads/property/' . $propertyimages[0]->image_path) ?>" class="popup-img w-100 h-100  d-flex radius-12 overflow-hidden object-fit-cover">
                                        <img src="<?= base_url('public/uploads/property/' . $propertyimages[0]->image_path) ?>" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <?php foreach (array_slice($propertyimages, 1) as $image): ?>
                                        <div class="col-6 mb-3 ">
                                            <div class="hover-scale-img border radius-16 overflow-hidden p-8 subimage-wrapper">
                                                <a href="<?= base_url('public/uploads/property/' . $image->image_path) ?>" class="popup-img w-100 h-100  d-flex radius-12 overflow-hidden object-fit-cover">
                                                    <img src="<?= base_url('public/uploads/property/' . $image->image_path) ?>" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
               


                <br>
                <hr>
                <div class="p-32">
                    <div class="d-flex align-items-center gap-16 justify-content-between flex-wrap mb-24">
                        <div class="d-flex align-items-center gap-8">

                        </div>
                        <div class="d-flex align-items-center gap-md-3 gap-2 flex-wrap">
                            <div class="d-flex align-items-center gap-8 text-neutral-500 text-lg fw-medium">

                                Listed On <?= esc($property['created_at']); ?>
                            </div>

                        </div>
                    </div>
                    <h3 class="mb-16"><?= esc($property['title']); ?></h3>
                    <p class="text-neutral-500 mb-16"><?= strip_tags($property['description']); ?></p>
                    <p class="text-neutral-500 mb-16">Location: <?= esc($property['location']); ?></p>
                    <p class="text-neutral-500 mb-16">Price: <?= esc($property['price']); ?></p>
                    <p class="text-neutral-500 mb-16">Purpose: <?= esc($property['purpose']); ?></p>
                    <p class="text-neutral-500 mb-16">Property Owner No: <?= esc($property['ownerno']); ?></p>
                </div>
            </div>
        </div>


    
    <?php endif; ?>
    <div class="row">

        <div class="col-md-12" style="text-align:right;">
            <button type="reset" id="cancel" class="btn btn-primary-600 radius-8 px-40 py-8">Cancel</button>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location.href = "<?= base_url('property') ?>";
            return false;
        });

        $('.popup-img').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
        })
    });
</script>


<?= $this->endSection(); ?>