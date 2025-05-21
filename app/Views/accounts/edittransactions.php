<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>
<?= "userdata" ?>
<?= $this->endSection(); ?>


<?= $this->section("content"); ?>

<div class="dashboard-main-body">

    <style>
        .text-danger:empty {
            display: none;
        }
    </style>

    <div class="card h-100 p-0 radius-12 overflow-hidden">

        <div class="card-body p-40">
            <h6 class="fw-semibold mb-3"><img src="<?= base_url('public/assets/images/rating.png') ?>" style="width:30px;height:30px;"> Transaction Details</h6>
            <!-- <hr> -->

            <form action="<?= base_url('accounting/update-transaction') ?>" method="post" class="p-4">
            <?php if (!empty($transactionitem)) : ?>

                <input type="hidden" class="form-control radius-8" id="tid" name="tid" value="<?= esc($transactionitem['id']) ?>">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" id="date" name="date" value="<?= esc($transactionitem['date']) ?>" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="transaction_type" class="form-label">Transaction Type</label>
                        <select id="transaction_type" name="transaction_type" class="form-select" required>
                            <option value="">Select</option>
                            <option <?php if ($transactionitem['transaction_type'] == "income") { ?> selected <?php }  ?> value="income">Income</option>
                            <option <?php if ($transactionitem['transaction_type'] == "expense") { ?> selected <?php }  ?> value="expense">Expense</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="account_head_id" class="form-label">Account Head</label>
                        <select id="account_head_id" name="account_head_id" class="form-select" required>
                            <option value="">Select Account Head</option>
                            <?php if (!empty($accountshead)) : $u = 0;
                                foreach ($accountshead as $accountshead) :  $u++; ?>
                                    <option <?php if ($transactionitem['account_head_id'] == $accountshead['id']) { ?> selected <?php } ?>  value="<?= $accountshead['id']; ?>"><?= $accountshead['head_name']; ?></option>
                                <?php endforeach; ?>

                            <?php endif; ?>
                            <!-- Populate dynamically from DB -->
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="amount" class="form-label">Amount (₹)</label>
                        <input type="number" id="amount" name="amount" value="<?= esc($transactionitem['amount']) ?>" class="form-control" min="0" step="0.01" required>
                    </div>

                    <div class="col-md-4">
                        <label for="mode_id" class="form-label">Payment Mode</label>
                        <select id="mode_id" name="mode_id" class="form-select" required>
                            <option value="">Select Payment Mode</option>
                            <!-- Populate dynamically from DB -->
                            <?php if (!empty($paymentmode)) : $u = 0;
                                foreach ($paymentmode as $paymentmode) :  $u++; ?>
                                    <option <?php if ($transactionitem['mode_id'] == $paymentmode['id']) { ?> selected <?php } ?> value="<?= $paymentmode['id']; ?>"><?= $paymentmode['mode_name']; ?></option>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="reference_no" class="form-label">Reference No (Optional)</label>
                        <input type="text" value="<?= esc($transactionitem['reference_no']) ?>" id="reference_no" name="reference_no" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="payer_payee" class="form-label">Payer / Payee (Optional)</label>
                    <input type="text" value="<?= esc($transactionitem['created_by']) ?>" id="payer_payee" name="payer_payee" class="form-control" placeholder="Enter name if applicable">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description / Notes</label>
                    <textarea id="description" name="description" class="form-control" rows="3"><?= esc($transactionitem['description']) ?></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Update Entry</button>
                </div>

                <?php endif; ?>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section("scripts"); ?>
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location.href = "<?= base_url('customers') ?>";
            return false;
        });
    });

    function capitalizeFirstLetter(input) {
        input.value = input.value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    }
    // ================== Image Upload Js Start ===========================
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    // ================== Image Upload Js End ===========================
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
</script>
<?= $this->endSection(); ?>