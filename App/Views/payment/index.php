<?php

$totalRevenue     = $totalRevenue ?? 0;
$totalPayments    = $totalPayments ?? 0;
$totalBusinesses  = $totalBusinesses ?? 0;

$payments         = $payments ?? [];
$businesses       = $businesses ?? [];

?>

<h3 class="mb-4">Payments Dashboard</h3>

<div class="row mb-4">

<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body d-flex justify-content-between">
<div>
<h6 class="text-muted">Total Revenue</h6>
<h3>$<?= number_format($totalRevenue,2) ?></h3>
</div>
<div style="font-size:30px">💰</div>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body d-flex justify-content-between">
<div>
<h6 class="text-muted">Total Payments</h6>
<h3><?= $totalPayments ?></h3>
</div>
<div style="font-size:30px">💳</div>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body d-flex justify-content-between">
<div>
<h6 class="text-muted">Total Businesses</h6>
<h3><?= $totalBusinesses ?></h3>
</div>
<div style="font-size:30px">🏢</div>
</div>
</div>
</div>

</div>


<div class="card shadow-sm mb-4">

<div class="card-header">
<b>Filter Payments</b>
</div>

<div class="card-body">

<form method="GET" class="row g-3">

<input type="hidden" name="controller" value="payment">
<input type="hidden" name="action" value="index">

<div class="col-md-4">

<select name="business_id" class="form-select">

<option value="">All Businesses</option>

<?php foreach($businesses as $b): ?>

<option value="<?= $b['id'] ?>">

<?= $b['business_name'] ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-md-3">

<input type="date" name="from_date" class="form-control">

</div>

<div class="col-md-3">

<input type="date" name="to_date" class="form-control">

</div>

<div class="col-md-2">

<button class="btn btn-primary w-100">Apply</button>

</div>

</form>

</div>

</div>


<div class="card-header d-flex justify-content-between align-items-center">

<b>Payment History</b>

<div>

<a href="index.php?controller=payment&action=exportCSV"
class="btn btn-success btn-sm">

⬇ Export CSV

</a>

</div>

</div>

<div class="card-body p-0">

<div class="table-responsive">

<table class="table table-striped table-hover mb-0">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Business</th>
<th>Amount</th>
<th>Method</th>
<th>Status</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php if(!empty($payments)): ?>

<?php foreach($payments as $p): ?>

<tr>

<td>#<?= $p['id'] ?></td>

<td><?= $p['business_name'] ?? 'N/A' ?></td>

<td>

<strong>$<?= number_format($p['amount'],2) ?></strong>

</td>

<td><?= $p['payment_method'] ?></td>

<td>

<?php if($p['status']=="success" || $p['status']=="completed"): ?>

<span class="badge bg-success">Success</span>

<?php else: ?>

<span class="badge bg-danger">Failed</span>

<?php endif; ?>

</td>

<td><?= date('d M Y',strtotime($p['created_at'])) ?></td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6" class="text-center text-muted">

No payment records found

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>
