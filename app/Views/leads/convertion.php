<?= $this->extend("layouts/base"); ?>

<?= $this->section("title"); ?>
<?= "meta_title;" ?>
<?= "meta_description;" ?>
<?= "userdata" ?>
<?= $this->endSection(); ?>

<?= $this->section("styles"); ?>
<style>
  .card {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  }

  .tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
  }

  .tab {
    padding: 10px 20px;
    cursor: pointer;
    border: 1px solid #007bff;
    border-radius: 5px;
    color: #007bff;
    background-color: #fff;
  }

  .tab.active {
    background-color: #007bff;
    color: white;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  .table th,
  .table td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    text-align: left;
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    font-weight: bold;
  }



  .buttons {
    margin-top: 20px;
  }

  .buttons button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
    cursor: pointer;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
  }
</style>
<?= $this->endSection(); ?>
<?= $this->section("content"); ?>

<div class="dashboard-main-body">
  <form action="<?= site_url('convertion-form') ?>" method="post" enctype="multipart/form-data">
    <div class="row">


      <input type="hidden" name="customer_id" value="<?= esc($customer_id) ?>">
      <input type="hidden" name="lead_id" value="<?= esc($leads['id']) ?>">
      <div class="card col-md-4">
        <h6>Lead Details</h6>
        <?php if (!empty($leads)) : $u = 0;
        ?>
          <p><strong>Name:</strong> <?= esc($leads['name']) ?></p>
          <p><strong>Mobile:</strong> <?= esc($leads['phone']) ?></p>
          <p><strong>Email:</strong> <?= esc($leads['email']) ?></p>
          <p><strong>Lead ID:</strong> <?= esc($leads['id']) ?></p>
          <!-- <p><strong>Conversion Date:</strong> 24-May-2025</p> -->



        <?php endif; ?>
      </div>

      <div class="card col-md-8">
        <h6>Select Property/Service</h6>
        <div class="tabs">
          <div class="tab active" onclick="showTab('properties')">Properties</div>
          <div class="tab" onclick="showTab('services')">Services</div>
        </div>

        <div id="properties" class="tab-content">
          <table class="table">
            <tr>
              <th>Select</th>
              <th>Name</th>
              <th>Type</th>
              <th>Price</th>
            </tr>
            <?php if (!empty($properties)) : $u = 0;
              foreach ($properties as $properties) :  $u++; ?>
                <tr>
                  <td><input class="form-check-input" type="radio" name="item" data-pid="<?= esc($properties['id']) ?>" value="<?= esc($properties['title']) ?>" data-type="property"></td>
                  <td><?= esc($properties['title']) ?></td>
                  <td><?= esc($properties['category']) ?></td>
                  <td>₹<?= esc($properties['price']) ?></td>
                </tr>
              <?php endforeach; ?>

            <?php endif; ?>
          </table>
        </div>

        <div id="services" class="tab-content" style="display:none;">
          <table class="table">
            <tr>
              <th>Select</th>
              <th>Name</th>
              <th>Category</th>
              <th>Price</th>
            </tr>
            <?php if (!empty($services)) : $u = 0;
              foreach ($services as $services) :  $u++; ?>
                <tr>
                  <td><input class="form-check-input" type="radio" name="item" data-sid="<?= esc($services['id']) ?>" value="<?= esc($services['title']) ?>" data-type="service"></td>
                  <td><?= esc($services['title']) ?></td>
                  <td><?= esc($services['category']) ?></td>
                  <td>₹<?= esc($services['price']) ?></td>
                </tr>
              <?php endforeach; ?>

            <?php endif; ?>
          </table>
        </div>
      </div>

      <div class="card col-md-12">

        <h6>Cash Transaction Details</h6>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="mode">Transaction Mode</label>
            <select class="form-select" id="mode" name="transaction_mode">
              <option value="" disabled selected>--Select--</option>
               <!-- Populate dynamically from DB -->
                            <?php if (!empty($paymentmode)) : $u = 0;
                                foreach ($paymentmode as $paymentmode) :  $u++; ?>
                                    <option value="<?= $paymentmode['id']; ?>"><?= $paymentmode['mode_name']; ?></option>
                                <?php endforeach; ?>

                            <?php endif; ?>
            </select>
          </div>

          <div class="form-group  col-md-4">
            <label for="pmode">Payment Stages</label>
            <select class="form-select" id="pmode" name="payment_mode">
              <option value="" disabled selected>--Select--</option>
              <option value="Advance">Advance</option>
              <option value="Intrim">Intrim</option>
              <option value="Final">Final</option>

            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="amount">Amount Paid (₹)</label>
            <input class="form-control" type="number" id="amount" name="amount_paid">
          </div>
          <div class="form-group col-md-4">
            <label for="date">Transaction Date</label>
            <input class="form-control" type="date" id="date" name="transaction_date">
          </div>
          <div class="form-group col-md-4">
            <label for="receipt">Receipt Number (optional)</label>
            <input class="form-control" type="text" id="receipt" name="receipt_number">
          </div>
          <div class="form-group col-md-4">
            <label for="upload">Upload Receipt (optional)</label>
            <input class="form-control" type="file" id="upload" name="receipt_file">
          </div>

          <input type="hidden" name="item_id" id="item_id">
          <input type="hidden" name="item_type" id="item_type">
        </div>




        <div class="buttons">
          <button class="btn-primary" type="submit">✅ Confirm Conversion</button>
          <button class="btn-secondary">❌ Cancel</button>
        </div>
      </div>
    </div>
  </form>


</div>

<?= $this->endSection(); ?>
<?= $this->section("scripts"); ?>
<!-- Include this in the <head> or before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#cancel').on('click', function() {
      window.location.href = "<?= base_url('leads') ?>";
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

  function showTab(tabId) {
    document.getElementById('properties').style.display = 'none';
    document.getElementById('services').style.display = 'none';
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.getElementById(tabId).style.display = 'block';
    event.target.classList.add('active');
  }

  document.querySelectorAll('input[name="item"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
      if (this.dataset.pid) {
        document.getElementById('item_id').value = this.dataset.pid;
        document.getElementById('item_type').value = 'property';
      } else if (this.dataset.sid) {
        document.getElementById('item_id').value = this.dataset.sid;
        document.getElementById('item_type').value = 'service';
      }
    });
  });

  // ========================= Password Show Hide Js End ===========================
</script>
<?= $this->endSection(); ?>