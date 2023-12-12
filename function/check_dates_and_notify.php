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

// Function to handle rate limiting
function checkRateLimit() {
    session_start();

    // Set the rate limit details
    $limit = 20; // Number of requests allowed
    $interval = 40; // Time interval in seconds

    // Check if the session variables are set
    if (!isset($_SESSION['request_count'])) {
        $_SESSION['request_count'] = 1;
        $_SESSION['last_request_time'] = time();
    } else {
        // Increment the request count
        $_SESSION['request_count']++;

        // Check if the rate limit has been reached
        if ($_SESSION['request_count'] > $limit) {
            // Check if the time interval has passed
            $elapsedTime = time() - $_SESSION['last_request_time'];
            if ($elapsedTime < $interval) {
                // Rate limit exceeded, wait for the remaining time
                $remainingTime = $interval - $elapsedTime;
                die("Rate limit exceeded. Please wait for {$remainingTime} seconds before trying again.");
            }

            // Reset the counters if the time interval has passed
            $_SESSION['request_count'] = 1;
            $_SESSION['last_request_time'] = time();
        }
    }
}

// Check rate limit before processing notifications
checkRateLimit();

if (isset($_POST['notifyButton'])) { 
    $query = mysqli_query($conn, "SELECT * FROM tnumber order by id asc");
    while ($row = mysqli_fetch_array($query)) {
        $currentDate = date('Y-m-d');

        // Check if the expiration date has passed
        if ($row['tanggal_expired'] < $currentDate) {
            // Prepare and send notification for expiration
            $notificationMessage = 'Phone number has expired!';
            sendNotification($row['nomor_telp'], $notificationMessage);
        }

        // Check if the active period date has passed
        if ($row['tanggal_aktif'] < $currentDate) {
            // Prepare and send notification for active period
            $notificationMessage = 'Phone number has entering the grace period!';
            sendNotification($row['nomor_telp'], $notificationMessage);
        }
    }
}

