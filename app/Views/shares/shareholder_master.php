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
                    <h5 class="card-title mb-0">Share Holder Master</h5>


                </div>
                <div class="col-md-6 d-flex justify-content-end">



                </div>
            </div>



        </div>
        <div class="card-body">
            <div class="container">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div id="flash-message" class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('shareholder-master/save') ?>" method="post">
                    <?php
                    $types = ['founder' => 'Founder', 'investor' => 'External Investor', 'leadership' => 'Leadership Board Members'];
                    $existing = [];
                    foreach ($sharemasters as $row) {
                        $existing[$row['type']] = $row;
                    }
                    foreach ($types as $key => $label):
                    ?>
                        <div class="card mb-3 p-3 border">
                            <h5><?= $label ?></h5>
                            <input type="hidden" name="master[<?= $key ?>][type]" value="<?= $key ?>">

                            <div class="form-group">
                                <label>No. of Shares Alloted [ AS ]</label>
                                <input type="number" name="master[<?= $key ?>][no_of_shares]" class="form-control"
                                value="<?= isset($existing[$key]) ? esc($existing[$key]['no_of_shares']) : '' ?>" required min="0">
                            </div>

                            <div class="form-group mt-2">
                                <label>Face Value Per Share [ FV ]</label>
                                <input type="number" name="master[<?= $key ?>][face_value]" class="form-control" 
                                value="<?= isset($existing[$key]) ? esc($existing[$key]['face_value']) : '' ?>" step="0.01" min="0">
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" class="btn btn-primary">Save Master Shares</button>
                </form>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<script>
    setTimeout(function () {
        const msg = document.getElementById('flash-message');
        if (msg) {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500); // remove from DOM
        }
    }, 5000); // 5000ms = 5 seconds
</script>
<?= $this->endSection(); ?>