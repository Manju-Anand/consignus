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
                    <span class="start-date text-secondary-light"><?= date('d-m-Y', strtotime($property['created_at'])); ?></span>
                </div>
                <div class="d-flex align-items-center justify-content-between gap-10">
                    <a href="<?= base_url('view-property/' . $property['id']) ?>" title="View Property Details">
                        <button type="button" class="card-edit-button text-warning-600">
                            <iconify-icon icon="iconamoon:eye-light" class="icon text-lg line-height-1"></iconify-icon>
                        </button>
                    </a>
                    <a href="<?= base_url('edit-property/' . $property['id']) ?>" title="Edit Property Details">
                        <button type="button" class="card-edit-button text-success-600">
                            <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                        </button>
                    </a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?= $property['id']; ?>)" title="Delete Property">
                        <button type="button" class="card-delete-button text-danger-600">
                            <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
