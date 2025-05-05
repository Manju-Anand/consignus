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
    <h5 class="modal-title">Leadership Board Members Profile</h5>
    <div>
        <button onclick="printStaffDetails()" class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-printer"></i> Print</button>
        <!-- <button onclick="exportToPDF()" class="btn btn-sm btn-outline-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</button> -->
    </div>
</div>

<div class="print-area">
    <div class="text-center mb-4">
        <img src="<?= base_url('public/uploads/lbm' . $staff['profile_image']) ?>" alt="Profile Picture" class="profile-pic">
        <h4 class="mt-2"><?= esc($staff['name']) ?></h4>
        <p class="text-muted"><?= esc($staff['business_name']) ?></p>
    </div>

    <ul class="nav nav-tabs" id="staffTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Personal Info</button>
        </li>
     </ul>

    <div class="tab-content mt-3">
        <!-- Personal Info -->
        <div class="tab-pane fade show active" id="info" role="tabpanel">
            <p><strong>Full Name:</strong> <?= esc($staff['name']) ?></p>
            <p><strong>Phone:</strong> <?= esc($staff['contact_number']) ?></p>
            <p><strong>Email:</strong> <?= esc($staff['email']) ?></p>
            <p><strong>Address:</strong> <?= esc($staff['address']) ?></p>
            <p><strong>Business Name:</strong> <?= esc($staff['business_name']) ?></p>
           
        </div>

       
    </div>
</div>

<script>
    function printStaffDetails() {
        var printContents = document.querySelector('.print-area').innerHTML;
        var printWindow = window.open('', '', 'width=900,height=600');
        printWindow.document.write('<html><head><title>Print LBM Details</title>');
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
