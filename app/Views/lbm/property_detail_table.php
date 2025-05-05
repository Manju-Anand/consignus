<table class="table table-bordered" style="font-size: 0.75rem;">
  <tr><th>Title</th><td><?= esc($property->title); ?></td></tr>
  <tr><th>Purpose</th><td><?= esc($property->purpose); ?></td></tr>
  <tr><th>Price</th><td><?= esc($property->price); ?></td></tr>
  <tr><th>Location</th><td><?= esc($property->location); ?></td></tr>
  <tr><th>Description</th><td><?= strip_tags($property->prodesp); ?></td></tr>

  <!-- Section Divider -->
  <tr>
    <td colspan="2" class="table-active text-center fw-bold">Property Type Details</td>
  </tr>

  <tr><th>Property Type</th><td><?= esc($property->name); ?></td></tr>
  <tr><th>Category</th><td><?= esc($property->category); ?></td></tr>
  <tr><th>Bedrooms</th><td><?= esc($property->bedrooms); ?></td></tr>
  <tr><th>Bathrooms</th><td><?= esc($property->bathrooms); ?></td></tr>
  <tr><th>Balconies</th><td><?= esc($property->balconies); ?></td></tr>
  <tr><th>Super Built-up Area</th><td><?= esc($property->super_builtup_area); ?> sq.ft.</td></tr>
  <tr><th>Carpet Area</th><td><?= esc($property->carpet_area); ?> sq.ft.</td></tr>
  <tr><th>Description</th><td><?= esc($property->pydesp); ?></td></tr>
</table>

