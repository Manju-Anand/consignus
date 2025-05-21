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
                    <h5 class="card-title mb-0">Edit Share Purchase</h5>


                </div>
                <div class="col-md-6 d-flex justify-content-end">



                </div>
            </div>



        </div>
        <style>
            .blink-text {
                animation: blink 1s step-start 0s infinite;
            }

            @keyframes blink {
                50% {
                    opacity: 0;
                }
            }
        </style>
        <div class="card-body">
            <div class="container">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('error')) : ?>
                    <div id="flash-message" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('share-transactions/edit') ?>" id="shareForm">

                    <?php if (!empty($purchaseitem)) : ?>

                        <input type="hidden" value="<?= esc($purchaseitem['id']); ?>" id="pid" name="pid">
                        <div class="form-group">
                            <label>Shareholder Type</label>
                            <select name="shareholder_type" id="shareholderType" class="form-control" required>
                                <option value="">Select</option>
                                <option <?php if ($purchaseitem['shareholder_type'] == "founder") { ?> selected <?php }  ?> value="founder">Founder</option>
                                <option <?php if ($purchaseitem['shareholder_type'] == "investor") { ?> selected <?php }  ?> value="investor">External Investor</option>
                                <option <?php if ($purchaseitem['shareholder_type'] == "leadership") { ?> selected <?php }  ?> value="leadership">Leadership Board</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label>Member Name</label>
                            <input type="text" name="member_name" value="<?= esc($purchaseitem['member_name']); ?>" class="form-control" required>
                        </div>

                        <div class="form-group mt-2">
                            <label>Member Contact No</label>
                            <input type="number" name="member_phno" class="form-control" value="<?= esc($purchaseitem['memberPhoneno']); ?>" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Member Email Address</label>
                            <input type="email" name="member_email" class="form-control" value="<?= esc($purchaseitem['memberEmail']); ?>" required>
                        </div>

                        <div class="form-group mt-2">
                            <label>Amount Invested (₹)</label>
                            <input type="number" name="amount_invested" id="amountInvested" class="form-control" value="<?= esc($purchaseitem['amount_invested']); ?>" min="0" required>
                        </div>

                        <div class="form-group mt-2">
                            <label>Shares Allocated</label>
                            <input type="number" name="shares_allocated" id="sharesAllocated" class="form-control" value="<?= esc($purchaseitem['shares_allocated']); ?>" readonly required>
                            <small id="shareInfo" class="text-danger fw-bold blink-text"></small>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-success mt-3">Save Transaction</button>
                </form>


            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amountInvested');
        const allocatedInput = document.getElementById('sharesAllocated');
        const typeSelect = document.getElementById('shareholderType');
        const shareInfo = document.getElementById('shareInfo');

        let faceValue = 25;
        let availableShares = 0;

        typeSelect.addEventListener('change', function() {
            const type = this.value;

            // Fetch available shares from backend (you can adjust this to use AJAX)
            fetch(`<?= base_url('share-transactions/available-shares') ?>/${type}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        shareInfo.innerText = data.error;
                        allocatedInput.value = '';
                        return;
                    }
                    availableShares = data.remaining;
                    faceValue = data.face_value;
                    shareInfo.innerText = `Remaining Shares: ${availableShares}`;
                    calculateShares();
                });
        });

        amountInput.addEventListener('input', calculateShares);

        function calculateShares() {
            const amount = parseFloat(amountInput.value);
            if (isNaN(amount) || faceValue <= 0) return;

            let eligibleShares = Math.floor(amount / faceValue);
            allocatedInput.value = eligibleShares;

            if (eligibleShares > availableShares) {
                shareInfo.innerText = `Only ${availableShares} shares available.`;
                allocatedInput.value = availableShares;
            } else {
                shareInfo.innerText = `Eligible for ${eligibleShares} shares. Remaining: ${availableShares}`;
            }
        }
    });


    setTimeout(function() {
        const msg = document.getElementById('flash-message');
        if (msg) {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500); // remove from DOM
        }
    }, 5000); // 5000ms = 5 seconds
</script>

<?= $this->endSection(); ?>