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
            <!-- <h6 class="fw-semibold mb-3"><img src="<?= base_url('public/assets/images/rating.png') ?>" style="width:30px;height:30px;"> Transaction Details</h6> -->
            <!-- <hr> -->

           <!-- app/Views/accounts/income_expenditure.php -->
<div class="container mt-4">
    <h3 class="fw-semibold mb-3">Income & Expenditure Statement</h3>

    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" class="form-control" name="start_date" value="<?= esc($start_date) ?>">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" class="form-control" name="end_date" value="<?= esc($end_date) ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <?php if (!empty($summary)): ?>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Type</th>
                <th>Total Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($summary as $row): ?>
                <tr>
                    <td><?= ucfirst($row['transaction_type']) ?></td>
                    <td><?= number_format($row['total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No records found for the selected date range.</p>
    <?php endif; ?>
</div>


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