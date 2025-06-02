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
                <?php
                $shownRemunerations = []; // To track which TWU IDs have already had remuneration shown
                $totalAmount = 0;
                ?>

                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                    <thead>
                        <tr style="background:#f2f2f2;">
                            <th>LBM Member</th>
                            <th>Customer</th>
                            <th>Property</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Expense Type</th>
                            <th>Amount (₹)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($liabilityList as $row): ?>
                            <?php
                            // Remuneration: show only once per twu_id
                            if (!empty($row['remuneration']) && $row['work_status'] !== 'completed' && !in_array($row['twu_id'], $shownRemunerations)) {
                                $shownRemunerations[] = $row['twu_id'];
                                $totalAmount += (float) $row['remuneration'];
                            ?>
                                <tr>
                                    <td><?= esc($row['lname']) ?></td>
                                    <td><?= esc($row['cname']) ?></td>
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
                                    <td><?= esc($row['lname']) ?></td>
                                    <td><?= esc($row['cname']) ?></td>
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

            </div>
        </div>
    </div>
</div>







<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>

<script>




</script>


<?= $this->endSection(); ?>