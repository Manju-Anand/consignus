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
                    <h5 class="card-title mb-0">Company Liability List</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                </div>
            </div>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- -->
                <style>
                    .row-check {
                        transform: scale(1.2);
                    }
                </style>
                <?php
                $shownRemunerations = []; // To track which TWU IDs have already had remuneration shown
                $totalAmount = 0;
                ?>

                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                    <thead>
                        <tr style="background:#f2f2f2;">
                            <th scope="col">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                    <label class="form-check-label">
                                        S.L
                                    </label>
                                </div>
                            </th>
                            <!-- <th><input type="checkbox" id="selectAll"></th>  -->
                            <th>LBM Member</th>
                            <th>Property</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Expense Type</th>
                            <th>Amount (₹)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($liabilityList as $index => $row): ?>
                            <?php
                            // Remuneration: show only once per twu_id
                            if (!empty($row['remuneration']) && $row['work_status'] !== 'completed' && !in_array($row['twu_id'], $shownRemunerations)) {
                                $shownRemunerations[] = $row['twu_id'];
                                $totalAmount += (float) $row['remuneration'];
                            ?>
                                <tr>
                                    <!-- <td></td>
                                    <td>
                                        <input type="checkbox" class="row-check" name="selected_rows[]" value="<?= $index ?>" >
                                    </td> -->
                                    <td>
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input row-check" type="checkbox" name="selected_rows[]" value="<?= $index ?>" data-row='<?= json_encode($row) ?>'>
                                            <label class="form-check-label">
                                                01
                                            </label>
                                        </div>
                                    </td>
                                    <td><?= esc($row['lname']) ?></td>
                                    <td><?= esc($row['title']) ?></td>
                                    <td><?= esc($row['role']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($row['remuneration_date'])) ?></td>
                                    <td><strong>Remuneration</strong></td>
                                    <td><?= number_format((float)$row['remuneration'], 2) ?></td>
                                    <td><span style="color:red;">Pending</span></td>
                                </tr>
                            <?php } ?>

                            <?php if (!empty($row['expense_amount']) && strtolower($row['expense_status']) !== 'paid'): ?>
                                <?php $totalAmount += (float) $row['expense_amount']; ?>
                                <tr>
                                    <td>
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input row-check" type="checkbox" name="selected_rows[]" value="<?= $index ?>" data-row='<?= json_encode($row) ?>'>
                                            <label class="form-check-label">
                                                01
                                            </label>
                                        </div>
                                    </td>
                                    <td><?= esc($row['lname']) ?></td>

                                    <td><?= esc($row['title']) ?></td>
                                    <td><?= esc($row['role']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($row['expense_date'])) ?></td>
                                    <td><?= esc($row['expense_type']) ?></td>
                                    <td><?= number_format((float)$row['expense_amount'], 2) ?></td>
                                    <td><span style="color:red;"><?= ucfirst($row['expense_status']) ?: 'Unpaid' ?></span></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="font-weight:bold; background:#e0e0e0;">
                            <td colspan="6" style="text-align:right;">Total Liability:</td>
                            <td><?= number_format($totalAmount, 2) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <button id="submitSelected" class="btn btn-primary mt-3">Save Selected</button>
            </div>
        </div>
    </div>
</div>







<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>

<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.row-check');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    document.getElementById('submitSelected').addEventListener('click', function() {
        const selectedRows = [];
        document.querySelectorAll('.row-check:checked').forEach(cb => {
            const rowData = JSON.parse(cb.dataset.row);
            selectedRows.push(rowData);
        });

        if (selectedRows.length === 0) {
            alert('Please select at least one row.');
            return;
        }

        fetch('<?= base_url("liability/saveSelected") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' // optional
                },
                body: JSON.stringify({
                    data: selectedRows
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    alert("Saved successfully!");
                    location.reload();
                } else {
                    alert("Something went wrong.");
                }
            })
            .catch(err => {
                console.error(err);
                alert("Error saving data.");
            });
    });
</script>

<?= $this->endSection(); ?>