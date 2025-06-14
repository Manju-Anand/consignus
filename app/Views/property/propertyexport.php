<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>



<?= $this->section("content"); ?>
<div class="dashboard-main-body">

    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7">
                    <h5 class="card-title mb-0">PROPERTY List</h5>

                </div>
                <div class="col-md-5 d-flex justify-content-end">
                    <div class="row">
                        <div class="col-md-5 justify-content-end">
                            <select id="categoryFilter" class="form-select mb-3">
                                <option value="">All Categories</option> <!-- All option -->
                                <option value="Flat">Flat</option>
                                <option value="Villa">Villa</option>
                                <option value="Land">Land</option>
                                <option value="Rental">Rental</option>
                                <option value="House">House</option>
                            </select>

                        </div>
                        <div class="col-md-7">

                            <button id="excelExport" class="btn btn-success mb-3">Export to Excel</button>
                        </div>
                    </div>



                </div>

            </div>



        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Title</th>

                            <th scope="col">Location</th>
                            <th scope="col">House Type</th>
                            <th scope="col">Land Area</th>
                            <th scope="col">Asking Price</th>
                            <th scope="col">Verified By</th>
                            <th scope="col">Listing</th>
                            <th scope="col">More Info</th>
                            <th scope="col">Owner No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ptype)) : $u = 0;
                            foreach ($ptype as $ptype) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($ptype->title) ?></td>
                                    <td><?= esc($ptype->location) ?></td>
                                    <td><?= esc($ptype->orgcategory) ?></td>
                                    <td><?= esc($ptype->super_builtup_area) ?></td>
                                    <td><?= esc($ptype->price) ?></td>
                                    <td></td>
                                    <td><?= esc($ptype->property_listing) ?></td>
                                    <td><?= esc(strip_tags($ptype->description)) ?></td>
                                    <td><?= esc($ptype->ownerno) ?></td>
                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>


                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>







<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>




<!-- Excel Export Dependencies -->

<script>
    $(document).ready(function() {
        // Get the existing table instance
        let table = $('#dataTable').DataTable();


        // Filter by category
        $('#categoryFilter').on('change', function() {
            let selectedCategory = $(this).val();
            // If 'All' selected, clear filter
            table.column(3).search(selectedCategory).draw();
        });

        // Add the export button manually
        new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: 'excelHtml5',
                title: 'Property List',
                text: 'Download Excel',
                className: 'btn btn-sm btn-primary'
            }]
        });

        // Attach export to your custom button
        $('#excelExport').on('click', function() {
            table.button('.buttons-excel').trigger();
        });
    });
</script>





<!-- -->



<?= $this->endSection(); ?>