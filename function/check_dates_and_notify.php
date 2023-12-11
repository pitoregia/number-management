<?php

require_once('dbconnect.php');
require_once('helper.php');

// Function to send notification without API key
function sendNotification($phoneNumber, $notificationMessage) {
    // Replace this URL with the actual URL of your notification API
    $apiUrl = 'http://localhost:3000/notificationTele';

    // Data to be sent in the request
    $data = array(
        'number' => $phoneNumber,
        'message' => $notificationMessage,
        // Add any additional data needed by your API
    );

    $ch = curl_init($apiUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        // Add any additional headers needed by your API
    ));

    // Execute cURL and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Process the API response (if needed)
    // Note: You may want to add more error handling and logging here

    return $response;
}


