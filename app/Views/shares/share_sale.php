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
                    <h2 class="card-title mb-0">🧾 Share Sale Form</h2>


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

                <form action="<?= base_url('share-sale/save') ?>" method="post" id="shareSaleForm">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Shareholder Info Section -->
                            <div class="form-group">
                                <label for="shareholder_name">Name:</label>
                                <input type="text" id="shareholder_name" name="shareholder_name" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="shareholder_type">Type:</label>
                                <select id="shareholder_type" name="shareholder_type" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="founder">Founder</option>
                                    <option value="investor">External Investor</option>
                                    <option value="leadership">Leadership Board</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="shareholder_phone">Phone:</label>
                                <input type="text" id="shareholder_phone" name="shareholder_phone" class="form-control" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="shareholder_email">Email:</label>
                                <input type="email" id="shareholder_email" name="shareholder_email" class="form-control" required>
                            </div>

                            <!-- Policy Selection -->
                            <fieldset>
                                <legend>Policy Selection:</legend>
                                <div class="d-flex align-items-center flex-wrap gap-24">
                                    <div class="bg-primary-50 px-20 py-12 radius-8">
                                        <span class="form-check checked-primary d-flex align-items-center gap-2">
                                            <input class="form-check-input" type="radio" name="radio100" id="radio100" checked>
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio100"> Buy Back </label>
                                        </span>
                                    </div>
                                    <div class="bg-success-100 px-20 py-12 radius-8">
                                        <span class="form-check checked-success d-flex align-items-center gap-2">
                                            <input class="form-check-input" type="radio" name="radio100" id="radio100">
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio100"> External Investor </label>
                                        </span>
                                    </div>
                                </div>

                            </fieldset>


                        </div>
                        <div class="col-md-6">
                            <!-- Approved Investor Dropdown - Shown only when 'External Investor' selected -->
                            <div id="externalInvestorDropdown" style="display: none;" class="form-group mt-2">
                                <label for="approved_investor">Approved Investor:</label>
                                <input type="number" id="face_value" name="face_value" value="" class="form-control" readonly>
                            </div>

                            <!-- Share Details -->
                            <div class="form-group mt-2">
                                <label for="no_of_shares">No. of Shares to Sell:</label>
                                <input type="number" id="no_of_shares" name="no_of_shares" class="form-control" required min="1">
                            </div>

                            <div class="form-group mt-2">
                                <label for="face_value">Face Value (₹):</label>
                                <input type="number" id="face_value" name="face_value" class="form-control" value="" readonly>
                            </div>

                            <div class="form-group mt-2">
                                <strong id="calculated_msg">You will receive ₹0</strong>
                            </div>

                            <div class="form-group mt-2">
                                <label for="transaction_date">Transaction Date:</label>
                                <input type="date" id="transaction_date" name="transaction_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="remarks">Remarks:</label>
                                <textarea name="remarks" id="remarks" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                    </div>





                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="btn btn-info mt-3">💾 Submit Sale</button>
                    </div>
                </form>



            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<script>
document.querySelectorAll('input[name="policy"]').forEach(el => {
    el.addEventListener('change', function () {
        const isExternal = this.value === 'external_investor';
        document.getElementById('externalInvestorDropdown').style.display = isExternal ? 'block' : 'none';
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('shareholder_type');
    const sharesInput = document.getElementById('no_of_shares');
    const faceValueInput = document.getElementById('face_value');
    const calcMsg = document.getElementById('calculated_msg');

    let faceValue = 25; // default
    let maxSellableShares = 0;

    typeSelect.addEventListener('change', function () {
        const type = this.value;
alert(type);
        // Fetch face value and max sellable shares from backend
        fetch(`<?= base_url('share-sale/face-value') ?>/${type}`)
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    calcMsg.innerText = data.error;
                    sharesInput.value = '';
                    return;
                }

                faceValue = parseFloat(data.face_value);
                alert(faceValue);
                maxSellableShares = parseInt(data.shares_owned);

                faceValueInput.value = faceValue;
                calcMsg.innerText = `You own ${maxSellableShares} shares at ₹${faceValue}/share.`;
                calculateAmount();
            });
    });

    sharesInput.addEventListener('input', calculateAmount);

    function calculateAmount() {
        const sharesToSell = parseInt(sharesInput.value) || 0;
        if (sharesToSell > maxSellableShares) {
            calcMsg.innerText = `You cannot sell more than ${maxSellableShares} shares.`;
            sharesInput.value = maxSellableShares;
        } else if (sharesToSell > 0) {
            const total = sharesToSell * faceValue;
            calcMsg.innerText = `You will receive ₹${total} for ${sharesToSell} shares at ₹${faceValue}/share.`;
        } else {
            calcMsg.innerText = `Enter number of shares to sell.`;
        }
    }
});



// document.getElementById('no_of_shares').addEventListener('input', calculateAmount);

// function calculateAmount() {
//     const shares = parseInt(document.getElementById('no_of_shares').value || 0);
//     const faceValue = parseInt(document.getElementById('face_value').value || 0);
//     const total = shares * faceValue;
//     document.getElementById('calculated_msg').innerText = `You will receive ₹${total} for ${shares} shares at ₹${faceValue}/share`;
// }
</script>

<script>
   


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