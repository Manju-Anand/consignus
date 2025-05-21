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
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Company Valuation</h5>
                    <span style="font-size:  0.875rem;"> If you want to delete a finacial year - Just press the Delete Button and save again to save data to database</span>

                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-success mt-3" id="addRowBtn">Add Row</button>


                </div>
            </div>



        </div>
        <div class="card-body">
            <form method="post" action="<?= site_url('valuation/saveAll') ?>" id="valuationForm">
                <div class="table-responsive">
                    <table class="table  border-primary-table mb-0 w-50" id="companyvaluation" data-page-length='10' style="font-size:  0.875rem;">
                        <thead>
                            <tr>

                                <th scope="col">#</th>
                                <th scope="col">Financial Year</th>
                                <th scope="col">Valuation</th>
                                <th scope="col">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($fy)) : $u = 0;
                                foreach ($fy as $index => $fy) : $u++; ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                        <td><?= esc($fy['financial_year']) ?>
                                            <input type="hidden" name="rows[<?= $index ?>][financial_year]" value="<?= esc($fy['financial_year']) ?>">
                                        </td>

                                        <?php if ($index === 0): ?>
                                            <!-- First row: read-only -->
                                            <td><?= esc($fy['valuation']) ?>
                                                <input type="hidden" name="rows[<?= $index ?>][valuation]" value="<?= esc($fy['valuation']) ?>">
                                            </td>
                                            <td></td>
                                        <?php else: ?>
                                            <!-- Other rows: editable -->
                                            <td contenteditable="true" class="editable-valuation" data-id="<?= esc($fy['id']) ?>" data-index="<?= $index ?>">
                                                <?= esc($fy['valuation']) ?>
                                                <input type="hidden" name="rows[<?= $index ?>][valuation]" id="valuation-<?= $index ?>" value="<?= esc($fy['valuation']) ?>">
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-sm deleteRowBtn">Delete</button></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>


                        </tbody>
                    </table>


                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Save All</button>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<script>
    document.getElementById('valuationForm').addEventListener('submit', function() {
        document.querySelectorAll('.editable').forEach(function(cell) {
            let index = cell.getAttribute('data-index');
            let value = cell.textContent.trim();
            document.getElementById('valuation-' + index).value = value;
        });
    });



    document.getElementById('addRowBtn').addEventListener('click', function() {
        const tableBody = document.querySelector('#companyvaluation tbody');
        const lastRow = tableBody.lastElementChild;
        const newIndex = tableBody.children.length;

        // Get last financial year
        const lastYearInput = lastRow.querySelector('input[name*="[financial_year]"]');
        const lastFY = lastYearInput ? lastYearInput.value.trim() : '2023-2024';

        // Calculate next financial year
        const yearParts = lastFY.split('-');
        let startYear = parseInt(yearParts[0]);
        let endYear = parseInt(yearParts[1]);

        if (!isNaN(startYear) && !isNaN(endYear)) {
            startYear++;
            endYear++;
        } else {
            startYear = new Date().getFullYear();
            endYear = startYear + 1;
        }

        const nextFY = `${startYear}-${endYear}`;

        // Create new row HTML
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td>${newIndex + 1}</td>
        <td>
            ${nextFY}
            <input type="hidden" name="rows[${newIndex}][financial_year]" value="${nextFY}">
        </td>
        <td contenteditable="true" class="editable" data-index="${newIndex}">
        <input type="hidden" name="rows[${newIndex}][valuation]" id="valuation-${newIndex}" value="0"></td>
         <td><button type="button" class="btn btn-danger btn-sm deleteRowBtn">Delete</button></td>
    `;

        tableBody.appendChild(newRow);
    });


    // Delete button event using event delegation
    document.querySelector('#companyvaluation tbody').addEventListener('click', function(e) {
        if (e.target.classList.contains('deleteRowBtn')) {
            const row = e.target.closest('tr');
            row.remove();

            // Reorder row numbers
            const rows = document.querySelectorAll('#dataTable tbody tr');
            rows.forEach((tr, index) => {
                tr.children[0].textContent = index + 1; // update serial #
            });
        }
    });
</script>
<?= $this->endSection(); ?>