<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>


<?= $this->section("content"); ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Property List</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Property List</li>
        </ul>
    </div>

    <?php
    $groupedProperties = [];

    foreach ($properties as $property) {
        $category = $property['category'];
        if (!isset($groupedProperties[$category])) {
            $groupedProperties[$category] = [];
        }
        $groupedProperties[$category][] = $property;
    }
    ?>

    <div class="card h-100 p-0 radius-12 overflow-hidden">
        <div class="card-header border-bottom-0 pb-0 pt-0 px-0">

            <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">

                <!-- Nav Pills on Left -->
                <ul class="nav border-gradient-tab nav-pills border-top-0 mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all"
                            type="button" role="tab" aria-controls="pills-all" aria-selected="true">
                            All
                        </button>
                    </li>

                    <?php foreach ($groupedProperties as $category => $items): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-<?= strtolower($category) ?>-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-<?= strtolower($category) ?>" type="button" role="tab">
                                <?= ucfirst($category) ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Search Bar on Right -->
                <form class="navbar-search" onsubmit="return false;">
                    <input type="text" id="searchInput" placeholder="Search">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>



            </div>


        </div>
        <div class="card-body p-24">


            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab"
                    tabindex="0">
                    <div class="row gy-4" id="propertyListContainer">
                        <?php foreach ($properties as $property): ?>
                            <div class="col-xxl-3 col-md-4 col-sm-6">
                                <div class="hover-scale-img border radius-16 overflow-hidden">
                                    <div class="max-h-266-px overflow-hidden">
                                        <img src="<?= base_url(); ?>public/uploads/property/<?= $property['image_path']; ?>" alt=""
                                            class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                    </div>
                                    <div class="py-16 px-24">
                                        <h6 class="mb-4" style="font-size:18px !important;"><?= $property['title']; ?></h6>
                                        <p class="mb-0 text-sm text-secondary-light"><?= $property['category']; ?></p>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between gap-10 py-16 px-24">
                                        <div class="d-flex align-items-center justify-content-between gap-10">
                                            <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                            <span class="start-date text-secondary-light"><?= date('d-m-Y', strtotime($property['created_at'])); ?>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-10">
                                            <a href="<?= base_url('view-property/' . $property['id']) ?>" title="View Property Details"> <button type="button" class="card-edit-button text-warning-600">
                                                    <iconify-icon icon="iconamoon:eye-light" class="icon text-lg line-height-1"></iconify-icon>
                                                </button></a>
                                            <a href="<?= base_url('edit-property/' . $property['id']) ?>" title="Edit Customer Details" title="Edit Property Details"> <button type="button" class="card-edit-button text-success-600">
                                                    <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                </button></a>
                                            <a href="javascript:void(0);" onclick="confirmDelete(<?= $property['id']; ?>)" title="Delete Property"> <button type="button" class="card-delete-button text-danger-600">
                                                    <iconify-icon icon="fluent:delete-24-regular"
                                                        class="icon text-lg line-height-1"></iconify-icon>
                                                </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php foreach ($groupedProperties as $category => $items): ?>
                    <div class="tab-pane fade" id="pills-<?= strtolower($category) ?>" role="tabpanel" tabindex="0">
                        <div class="row gy-4">
                            <?php foreach ($items as $property): ?>
                                <!-- Render property card here -->

                                <div class="col-xxl-3 col-md-4 col-sm-6">
                                    <div class="hover-scale-img border radius-16 overflow-hidden">
                                        <div class="max-h-266-px overflow-hidden">
                                            <img src="<?= base_url(); ?>public/uploads/property/<?= $property['image_path']; ?>" alt=""
                                                class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="py-16 px-24">
                                            <h6 class="mb-4" style="font-size:18px !important;">dfgdsf<?= $property['title']; ?></h6>
                                            <p class="mb-0 text-sm text-secondary-light"><?= $property['category']; ?></p>
                                            <h6 class="mb-4" style="font-size:18px !important;"><?= $property['property_listing']; ?></h6>
                                            <p class="mb-0 text-sm text-secondary-light"><?= $property['property_verify']; ?></p>
                                        </div>
                                      

                                        <div class="d-flex align-items-center justify-content-between gap-10 py-16 px-24">
                                            <div class="d-flex align-items-center justify-content-between gap-10">
                                                <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                <span class="start-date text-secondary-light"><?= date('d-m-Y', strtotime($property['created_at'])); ?>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between gap-10">
                                                <a href="<?= base_url('view-property/' . $property['id']) ?>" title="View Property Details"> <button type="button" class="card-edit-button text-warning-600">
                                                        <iconify-icon icon="iconamoon:eye-light" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button></a>
                                                <a href="<?= base_url('edit-property/' . $property['id']) ?>" title="Edit Property Details"> <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button></a>
                                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $property['id']; ?>)" title="Delete Property"> <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular"
                                                            class="icon text-lg line-height-1"></iconify-icon>
                                                    </button></a>
                                            </div>

                                            <!-- <div class="d-flex align-items-center justify-content-between gap-10">
                                                <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                <span class="start-date text-secondary-light"><?= esc($property['property_listing']); ?>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between gap-10">
                                                <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                <span class="start-date text-secondary-light"><?= esc($property['property_verify']); ?>
                                                </span>
                                            </div> -->
                                        </div>
                                       
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this Property Details?")) {
            window.location.href = "<?= base_url('delete-property/') ?>" + id;
        }
    }
</script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const search = this.value;

        fetch('<?= base_url('ajax-search-property') ?>?search=' + encodeURIComponent(search))
            .then(response => response.text())
            .then(html => {
                document.getElementById('propertyListContainer').innerHTML = html;
            });
    });
</script>


<?= $this->endSection(); ?>