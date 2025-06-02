<table class="table table-bordered"  id="custdatatable" style="font-size:  0.75rem;">
    <tr><th>Name</th><td><?= esc($customer['name']); ?></td></tr>
    <tr><th>Contact No</th><td><?= esc($customer['phone']); ?></td></tr>
    <tr><th>Email</th><td><?= esc($customer['email']); ?></td></tr>
    <tr><th>Address</th><td><?= esc($customer['address']); ?></td></tr>
    <tr><th>Property id</th><td><?= esc($customer['propertyid']); ?></td></tr>
    <tr><th>Property Booked</th><td><?= esc($customer['property_booked']); ?></td></tr>
    <tr><th>Booking Date</th><td><?= esc($customer['booking_date']); ?> sq.ft.</td></tr>
    <tr><th>Payment Status</th><td><?= esc($customer['payment_status']); ?> sq.ft.</td></tr>
    <tr><th>Amount Paid</th><td><?= esc($customer['amount_paid']); ?></td></tr>
   
</table>
