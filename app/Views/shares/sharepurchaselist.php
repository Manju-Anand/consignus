<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>

<?= $this->endSection(); ?>


<?= $this->section("content"); ?>
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Share Purchase List</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="<?= base_url(); ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Masters
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Share Purchase</li>
        </ul>
    </div>
    <div class="card basic-data-table">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Share Purchase List</h5>

                </div>
                <div class="col-md-6 d-flex justify-content-end">

                    <a href="<?= base_url(); ?>share-purchase"> <button type="button" class="btn btn-success-600 radius-8 px-14 py-6 text-sm right">Add New Share Purchase</button></a>
                </div>
            </div>



        </div>
        <?php if (session()->getFlashdata('success')): ?>
            <script>
                Swal.fire({
                    title: '🎉 Success!',
                    html: '<strong><?= session()->getFlashdata('success') ?></strong>',
                    icon: 'success',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                    timer: 4000,
                    timerProgressBar: true,
                    background: '#f0f9ff',
                    color: '#2b2e4a',
                    iconColor: '#28a745',
                    showConfirmButton: false
                });
            </script>
            <!-- Include Animate.css for animation effects -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <?php endif; ?>




        <div class="card-body">
            <div class="table-responsive">
                <table class="table  border-primary-table mb-0" id="dataTable" data-page-length='10' style="font-size:  0.875rem;">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">shareholder_type</th>

                            <th scope="col">member_name</th>
                            <th scope="col">amount_invested</th>
                            <th scope="col">shares_allocated</th>
                            <th scope="col">transaction_date</th>
                            <th scope="col">Action</th>
                            <th scope="col">memberPhoneno</th>
                            <th scope="col">memberEmail</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($purchaselist)) : $u = 0;
                            foreach ($purchaselist as $purchaselist) :  $u++; ?>
                                <tr>

                                    <td><a href="javascript:void(0)" class="text-primary-600"><?= esc($u) ?></a></td>
                                    <td><?= esc($purchaselist['shareholder_type']) ?></td>
                                    <td><?= esc($purchaselist['member_name']) ?></td>
                                    <td><?= esc($purchaselist['amount_invested']) ?></td>
                                    <td><?= esc($purchaselist['shares_allocated']) ?></td>
                                    <td><?= esc($purchaselist['transaction_date']) ?></td>

                                    <td>
                                        <a href="javascript:void(0)" data-id="<?= $purchaselist['id']; ?>" title="Add Shares"
                                            data-id="<?= $purchaselist['id'] ?>"
                                            data-name="<?= $purchaselist['member_name'] ?>"
                                            data-type="<?= $purchaselist['shareholder_type'] ?>"
                                            class="add-shares-btn w-32-px h-32-px bg-primary-light text-primary-800 rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mdi:database-plus"></iconify-icon>




                                        </a>
                                        <a href="<?= base_url('edit-purchaselist/' . $purchaselist['id']) ?>" title="Edit purchaselist Details"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>

                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $purchaselist['id']; ?>)" title="Delete purchaselist"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                    </td>
                                    <td><?= esc($purchaselist['memberPhoneno']) ?></td>
                                    <td><?= esc($purchaselist['memberEmail']) ?></td>
                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Add Task Modal -->
<!-- Modal -->
<div class="modal fade" id="addSharesModal" tabindex="-1" aria-labelledby="addSharesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="topUpShareForm" method="post" action="<?= base_url('share-transactions/add-shares') ?>">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSharesModalLabel">Add Shares</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="shareholder_id" id="modalShareholderId" value="">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Name:</label>
                            <input type="text" id="modalName" name="shareholder_name" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Shareholder Type:</label>
                            <input type="text" id="modalType" name="shareholder_type" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Face Value of Share:</label>
                            <input type="text" id="modalfv" class="form-control" readonly>
                        </div>

                    </div>
                    <br>
                    <div class="alert alert-info d-flex align-items-center p-2 rounded-3 shadow-sm mt-2" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <span class="fw-semibold">Tip:</span>&nbsp; Add either&nbsp;&nbsp; <strong>No. of Shares</strong>&nbsp; or &nbsp;<strong>Amount Invested</strong>&nbsp;&nbsp; to see the calculation details.
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Shares to Add:</label>
                            <input type="number" min="1" id="modalSharesInput" name="shares_to_add" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Amount Invested:</label>
                            <input type="number" min="1" id="modalamountinvested" name="amount_invested" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Total Shares Purchased:</label>
                            <input type="number" min="1" id="modaltotalSharesInput" name="total_shares_purcased" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Total Amount Invested:</label>
                            <input type="number" min="1" id="modaltotalamountinvested" name="total_amount_invested" class="form-control" readonly>
                        </div>

                    </div>

                    <div>
                        <span class="text-danger fw-bold blink-text" id="modalAvailableShares"></span><br>
                        <span id="modalCurrentShares"></span><br>
                        <span id="modalNewTotalValue"></span>
                        <span id="modalNewFaceValue"></span>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Shares</button>
                </div>
            </div>
        </form>
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




<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this Sharepurchase Details?")) {
            window.location.href = "<?= base_url('delete-purchaselist/') ?>" + id;
        }
    }



    document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('addSharesModal'));
        const addButtons = document.querySelectorAll('.add-shares-btn');

        const nameInput = document.getElementById('modalName');
        const typeInput = document.getElementById('modalType');
        const fvInput = document.getElementById('modalfv');

        const idInput = document.getElementById('modalShareholderId');
        const sharesInput = document.getElementById('modalSharesInput');
        const amountinvested = document.getElementById('modalamountinvested');

        const totalsharesInput = document.getElementById('modaltotalSharesInput');
        const totalamountinvested = document.getElementById('modaltotalamountinvested');

        const availableLabel = document.getElementById('modalAvailableShares');
        const currentSharesLabel = document.getElementById('modalCurrentShares');
        const totalValueLabel = document.getElementById('modalNewTotalValue');
        const faceValueLabel = document.getElementById('modalNewFaceValue');

        let faceValue = 25;
        let availableShares = 0;
        let currentShares = 0;

        addButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const type = this.getAttribute('data-type');
                // alert (id);
                nameInput.value = name;
                typeInput.value = type;
                idInput.value = id;

                // Fetch data via AJAX
                fetch(`<?= base_url('share-transactions/share-summary') ?>/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        faceValue = data.face_value;
                        availableShares = data.available_shares;
                        currentShares = data.owned_shares;

                        fvInput.value = faceValue;

                        availableLabel.innerText = `Available Shares: ${availableShares}`;
                        currentSharesLabel.innerText = `Current Shares: ${currentShares}`;
                        totalValueLabel.innerText = '';
                        sharesInput.value = '';
                        amountinvested.value = '';
                        totalsharesInput.value = '';
                        totalamountinvested.value = '';
                    });

                modal.show();
            });
        });

        sharesInput.addEventListener('input', function() {
            const newShares = parseInt(this.value) || 0;

            if (newShares > availableShares) {
                availableLabel.innerText = `Only ${availableShares} shares are available!`;
                this.value = availableShares;
            } else {
                availableLabel.innerText = `Available Shares: ${availableShares}`;
            }

            const totalShares = currentShares + newShares;
            const totalValue = totalShares * faceValue;
            const amountInvested = newShares * faceValue;
            amountinvested.value = amountInvested;

            totalsharesInput.value = totalShares;
            totalamountinvested.value = totalValue;

            totalValueLabel.innerText = `Total Shares After Purchase: ${totalShares}, Total Value: ₹${totalValue}`;

        });

        amountinvested.addEventListener('input', function() {
            calculateShares();
        });

        function calculateShares() {
            const amount = parseFloat(amountinvested.value);
            const faceValue = parseFloat(fvInput.value);
            if (isNaN(amount) || faceValue <= 0) return;

            let eligibleShares = Math.floor(amount / faceValue);
            sharesInput.value = eligibleShares;

            const totalShares = currentShares + eligibleShares;
            const totalValue = totalShares * faceValue;

            totalsharesInput.value = totalShares;
            totalamountinvested.value = totalValue;

            totalValueLabel.innerText = `Total Shares After Purchase: ${totalShares}, Total Value: ₹${totalValue}`;

        }
    });
</script>


<?= $this->endSection(); ?>