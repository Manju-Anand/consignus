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
                    <h5 class="card-title mb-0">Customer vs LBM Contribution</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                  </div>
            </div>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10'  style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Customer</th>

                            <th scope="col">Property</th>
                            <th scope="col">LBM Name</th>
                            <th scope="col">% Involvement</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Remuneration</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($teamassign)) : $u = 0;
                            foreach ($teamassign as $teamassign) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($teamassign['cname']) ?></td>
                                    <td><?= esc($teamassign['title']) ?></td>
                                    <td><?= esc($teamassign['lname']) ?></td>
                                    <td><?= esc($teamassign['perinvolvement']) ?></td>
                                    <td><?= esc($teamassign['work_notes']) ?></td>
                                    <td><?= esc($teamassign['remuneration']) ?></td>
                                   
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

<script>




</script>


<?= $this->endSection(); ?>