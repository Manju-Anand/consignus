<style>
    .profile-pic {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #007bff;
    }
    .print-area {
        padding: 15px;
    }
</style>

<div class="d-flex justify-content-between align-items-center">
    <h5 class="modal-title">Customer Profile</h5>
    <div>
        <button onclick="printStaffDetails()" class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-printer"></i> Print</button>
        <!-- <button onclick="exportToPDF()" class="btn btn-sm btn-outline-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</button> -->
    </div>
</div>

<div class="print-area">
        

    <div class="row">
        <!-- Personal Info -->
        <div class="col-md-6 active" id="info" >
            <p><strong>Full Name:</strong> <?= esc($cust['name']) ?></p>
            <p><strong>Phone:</strong> <?= esc($cust['phone']) ?></p>
            <p><strong>Email:</strong> <?= esc($cust['email']) ?></p>
            <p><strong>Address:</strong> <?= esc($cust['address']) ?></p>
            <p><strong>Role:</strong> <?= esc($cust['requirement_type']) ?></p>
            <p><strong>Department:</strong> <?= esc($cust['budget_range']) ?></p>
        </div>
        <div class="col-md-6 active" id="info1" >
            <p><strong>Username:</strong> <?= esc($cust['preferred_location']) ?></p>
            <p><strong>Status:</strong> <?= esc($cust['lead_source']) ?></p>
            <p><strong>Date Joined:</strong> <?= esc($cust['enquiry_date']) ?></p>
            <p><strong>Last Login:</strong> <?= esc($cust['assigned_staff_id']) ?></p>
      
            <p><strong>Created At:</strong> <?= esc($cust['created_at']) ?></p>
            <!-- You can include system info, logs or access permissions -->
        </div>
    </div>
</div>

<script>
    function printStaffDetails() {
        var printContents = document.querySelector('.print-area').innerHTML;
        var printWindow = window.open('', '', 'width=900,height=600');
        printWindow.document.write('<html><head><title>Print cust Details</title>');
        printWindow.document.write('<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">');
        printWindow.document.write('</head><body>' + printContents + '</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

    function exportToPDF() {
        const element = document.querySelector('.print-area');
        html2pdf().from(element).save('StaffProfile.pdf');
    }
</script>

<!-- Include html2pdf.js via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
