<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>
<?= $this->section("styles"); ?>
<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 14px;
        text-align: left;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 12px;
    }

    .table th {
        background-color: rgb(39, 60, 82);
        color: white;
        text-align: center;
    }

    .table input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-danger {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .btn-primary {
        margin-top: 10px;
        padding: 8px 15px;
        background-color: #28a745;
        color: white;
        border: none;
        cursor: pointer;
    }

    tfoot {
        font-weight: bold;
        background-color: #f8f9fa;
    }

    tfoot td {
        padding: 12px;
        border-top: 2px solid #000;
        text-align: right;
    }

    .total-footer {
        font-weight: bold;
        text-align: center;
        background: #e9ecef;
    }

    #editor-container {
        background-color: #f8f9fa;
        /* Light gray background */
        padding: 15px;
        /* Add some spacing */
        border-radius: 10px;
        /* Rounded corners */
    }

    #editor {
        min-height: 300px;
        /* Adjust height */
        max-height: 400px;
        /* Set a max height if needed */
        overflow-y: auto;
        /* Enable scrolling */
        border: 2px solid #007bff;
        /* Blue border */
        border-radius: 8px;
        /* Rounded corners */
        padding: 10px;
        /* Add padding inside */
        background-color: #fff;
        /* White background */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
    }
</style>

<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="dashboard-main-body">

    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Team Work Updations</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                </div>
            </div>



        </div>
        <div class="card-body">
            <form action="<?= base_url('assignwork-updation') ?>" method="post">
                <div class="row">

                    <div class="row">
                        <input type="hidden" value="<?= esc($teamassign['id']);  ?>" id="assignid" name="assignid">
                        <input type="hidden" value="<?= esc($teamassign['member_id']);  ?>" id="lbmid" name="lbmid">
                        <div class="col-sm-4">
                            <div style="margin-bottom: 5px;">
                                <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">LBM Name <span
                                        class="text-danger-600">*</span> </label>
                                <input type="text" class="form-control radius-8" id="lname" placeholder="LBM Name" name="lname" value="<?= esc($teamassign['lname']);  ?>" readonly>
                                <span class="text-danger"><?= display_errors($validation ?? null, 'project'); ?></span>
                            </div>

                        </div>



                        <div class="col-sm-3">
                            <div>
                                <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Customer Name <span
                                        class="text-danger-600">*</span></label>
                                <input type="hidden" id="cid" name="cid" value="" readonly>
                                <input type="text" class="form-control radius-8" id="cname" placeholder="Customer Name" name="cname" value="<?= esc($teamassign['cname']); ?>" readonly>
                                <span class="text-danger"><?= display_errors($validation ?? null, 'cname'); ?></span>
                            </div>

                        </div>


                        <div class="col-sm-3">
                            <div style="margin-bottom: 5px;">
                                <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Apartment Name <span
                                        class="text-danger-600">*</span></label>
                                <input type="text" class="form-control radius-8" id="aname" placeholder="" name="aname" value="<?= esc($teamassign['title']);  ?>" readonly>
                                <span class="text-danger"><?= display_errors($validation ?? null, 'qno'); ?></span>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div style="margin-bottom: 5px;">
                                <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Updation Date <span
                                        class="text-danger-600">*</span></label>
                                <input type="date" class="form-control radius-8" id="udate" placeholder="" name="udate" value="<?= date('Y-m-d'); ?>">
                                <span class="text-danger"><?= display_errors($validation ?? null, 'udate'); ?></span>
                            </div>

                        </div>

                    </div>


                    <div class="dynamic-line"></div>


                    <table class="table" id="quotationtable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Expense Type</th>
                                <th>Work Description</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="scopeOfWorkTable">
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="expense_type[]" class="form-select" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Food">Food</option>
                                        <option value="Toll">Toll</option>
                                        <option value="Travel">Travel</option>
                                        <option value="Accommodation">Accommodation</option>
                                        <option value="Mobile/Internet">Mobile/Internet</option>
                                        <option value="Miscellaneous">Miscellaneous</option>
                                    </select>
                                </td>
                                <td><input type="text" name="description[]" class="form-control" required></td>
                                <td><input type="number" name="unit_price[]" class="form-control unit_price" required></td>
                                <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
                                <td><button type="button" class="btn btn-danger removeRow">X</button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                <td><input type="text" id="grandTotal" class="form-control total-footer" readonly></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                    <button type="button" class="btn btn-primary" id="addRow">Add More Rows</button>


                    <input type="hidden" name="estimated_cost" id="estimated_cost" readonly>

                    <div class="dynamic-line"></div>



                    <div class="col-sm-4">
                        <div style="margin-bottom: 5px;">
                            <label for="worknotes" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Work Notes / Remarks <span class="text-danger-600">*</span>
                            </label>
                            <textarea id="worknotes" name="worknotes" class="form-control"></textarea>
                            <span class="text-danger"><?= display_errors($validation ?? null, 'worknotes'); ?></span>
                        </div>
                     
                    </div>
                     <div class="col-sm-4">
                        <div style="margin-bottom: 5px;">
                            <label for="involvementpercentage" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                % of Involvement <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" min="0" max="100" step="0.01" id="involvementpercentage" name="involvementpercentage" class="form-control">
                            <span class="text-danger"><?= display_errors($validation ?? null, 'involvementpercentage'); ?></span>
                        </div>
                       
                    </div>
                     <div class="col-sm-4">
                        <div style="margin-bottom: 5px;">
                            <label for="remuneration" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Remuneration <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" id="remuneration" name="remuneration" class="form-control" min="0" step="0.01">
                            <span class="text-danger"><?= display_errors($validation ?? null, 'remuneration'); ?></span>
                        </div>
                       
                    </div>

                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">

                        <button type="submit" name="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                            Save Change
                        </button>
                        <button type="reset" id="cancel" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                            Cancel
                        </button>
                    </div>
                </div>
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
      window.location.href = "<?= base_url('team-work-update') ?>";
      return false;
    });
  });
    // Add new expense row
    document.getElementById('addRow').addEventListener('click', function() {
        let table = document.getElementById('scopeOfWorkTable');
        let rowCount = table.rows.length + 1;
        let newRow = document.createElement('tr');

        newRow.innerHTML = `
        <td>${rowCount}</td>
        <td>
            <select name="expense_type[]" class="form-select" required>
                <option value="">-- Select Type --</option>
                <option value="Petrol">Petrol</option>
                <option value="Food">Food</option>
                <option value="Toll">Toll</option>
                <option value="Travel">Travel</option>
                <option value="Accommodation">Accommodation</option>
                <option value="Mobile/Internet">Mobile/Internet</option>
                <option value="Miscellaneous">Miscellaneous</option>
            </select>
        </td>
        <td><input type="text" name="description[]" class="form-control" required></td>
        <td><input type="number" name="unit_price[]" class="form-control unit_price" required></td>
        <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
        <td><button type="button" class="btn btn-danger removeRow">X</button></td>
    `;

        table.appendChild(newRow);
    });

    // Calculate total price per row (unit_price only, no quantity)
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('unit_price')) {
            let row = e.target.closest('tr');
            let unitPrice = parseFloat(row.querySelector('.unit_price').value) || 0;
            let totalPriceField = row.querySelector('.total_price');

            totalPriceField.value = unitPrice.toFixed(2); // Total = Unit Price
            updateGrandTotal();
        }
    });

    // Update Grand Total
    function updateGrandTotal() {
        let total = 0;
        document.querySelectorAll('.total_price').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('grandTotal').value = total.toFixed(2);

        // Optional: mirror to another hidden field
        let costInput = document.getElementById("estimated_cost");
        if (costInput) costInput.value = total.toFixed(2);
    }

    // Remove row and update grand total
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeRow')) {
            e.target.closest('tr').remove();
            updateGrandTotal();
        }
    });
</script>


<?= $this->endSection(); ?>