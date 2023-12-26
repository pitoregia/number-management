<?php
require_once('user_count.php');
require_once('number_count.php');
require_once('number_status_checker.php');

// Fetch updated data
$response = array(
    'whatsappData' => array(
        'number_count' => $number_count,
        'active_number' => $active_number,
        'expired_number' => $expired_number,
        'grace_period_number' => $grace_period_number,
    ),
    'userData' => array(
        'total_count' => $total_count,
        'user_count' => $user_count,
        'admin_count' => $admin_count,
    ),
);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
