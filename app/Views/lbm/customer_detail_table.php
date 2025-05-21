<table class="table table-bordered"  style="font-size:  0.75rem;">
    <tr><th>Name</th><td><?= esc($customer['name']); ?></td></tr>
    <tr><th>Contact No</th><td><?= esc($customer['phone']); ?></td></tr>
    <tr><th>Email</th><td><?= esc($customer['email']); ?></td></tr>
    <tr><th>Address</th><td><?= esc($customer['address']); ?></td></tr>
    <tr><th>Requirement Type</th><td><?= esc($customer['requirement_type']); ?></td></tr>
    <tr><th>Budget Range</th><td><?= esc($customer['budget_range']); ?> sq.ft.</td></tr>
    <tr><th>Preferred Location</th><td><?= esc($customer['preferred_location']); ?> sq.ft.</td></tr>
    <tr><th>Lead Source</th><td><?= esc($customer['lead_source']); ?></td></tr>
    <tr><th>Enquiry Date</th><td><?= esc($customer['enquiry_date']); ?></td></tr>
</table>
