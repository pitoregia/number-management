<?php

$currentDate = date('Y-m-d');

$statusClass = '';
switch ($row['status']) {
    case 'TENGGANG':
        $statusClass = 'btn-warning';
        break;
    case 'MATI':
        $statusClass = 'btn-danger';
        break;
    default:
        $statusClass = 'btn-success';
        break;
}

$statusClass = '';
switch ($row['status']) {
    case 'TENGGANG':
        // $statusClass = 'bg-warning';
        $statusClass = 'btn-warning';
        break;
    case 'MATI':
        $statusClass = 'btn-danger';
        break;
    default:
        $statusClass = 'btn-success';
        break;
}
$currentDate = date('Y-m-d');
if ($row['tanggal_expired'] < $currentDate) {
    $expiredDateClass = 'text-danger'; // Date is in the past
} elseif (date('Y-m', strtotime($row['tanggal_expired'])) == date('Y-m', strtotime($currentDate))) {
    $expiredDateClass = 'text-warning'; // Date is still in the current month
} else {
    $expiredDateClass = 'text-success'; // Date is in the future months
}

if ($row['tanggal_aktif'] < $currentDate) {
    $activeDateClass = 'text-danger'; // Date is in the past
} elseif (date('Y-m', strtotime($row['tanggal_aktif'])) == date('Y-m', strtotime($currentDate))) {
    $activeDateClass = 'text-warning'; // Date is still in the current month
} else {
    $activeDateClass = 'text-success'; // Date is in the future months
}
