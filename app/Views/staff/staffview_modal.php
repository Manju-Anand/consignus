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
    <h5 class="modal-title">Staff Profile</h5>
    <div>
        <button onclick="printStaffDetails()" class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-printer"></i> Print</button>
        <!-- <button onclick="exportToPDF()" class="btn btn-sm btn-outline-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</button> -->
    </div>
</div>

<div class="print-area">
    <div class="text-center mb-4">
        <img src="<?= base_url('public/uploads/' . $staff['profile_pic']) ?>" alt="Profile Picture" class="profile-pic">
        <h4 class="mt-2"><?= esc($staff['full_name']) ?></h4>
        <p class="text-muted"><?= esc($staff['role']) ?>, <?= esc($staff['department']) ?></p>
    </div>

    <ul class="nav nav-tabs" id="staffTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Personal Info</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab">Account</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="system-tab" data-bs-toggle="tab" data-bs-target="#system" type="button" role="tab">System</button>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- Personal Info -->
        <div class="tab-pane fade show active" id="info" role="tabpanel">
            <p><strong>Full Name:</strong> <?= esc($staff['full_name']) ?></p>
            <p><strong>Phone:</strong> <?= esc($staff['phone']) ?></p>
            <p><strong>Email:</strong> <?= esc($staff['email']) ?></p>
            <p><strong>Address:</strong> <?= esc($staff['address']) ?></p>
            <p><strong>Role:</strong> <?= esc($staff['role']) ?></p>
            <p><strong>Department:</strong> <?= esc($staff['department']) ?></p>
        </div>

        <!-- Account -->
        <div class="tab-pane fade" id="account" role="tabpanel">
            <p><strong>Username:</strong> <?= esc($staff['username']) ?></p>
            <p><strong>Status:</strong> <?= esc($staff['status']) ?></p>
            <p><strong>Date Joined:</strong> <?= esc($staff['date_joined']) ?></p>
            <p><strong>Last Login:</strong> <?= esc($staff['last_login']) ?></p>
        </div>

        <!-- System -->
        <div class="tab-pane fade" id="system" role="tabpanel">
            <p><strong>Created At:</strong> <?= esc($staff['created_at']) ?></p>
            <!-- You can include system info, logs or access permissions -->
        </div>
    </div>
</div>

<script>
    function printStaffDetails() {
        var printContents = document.querySelector('.print-area').innerHTML;
        var printWindow = window.open('', '', 'width=900,height=600');
        printWindow.document.write('<html><head><title>Print Staff Details</title>');
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
