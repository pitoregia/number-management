$(document).ready(function() {
    // Submit the form using AJAX when the button is clicked
    $('#notifyButton').click(function() {
        $.ajax({
            type: 'POST',
            url: '../function/check_dates_and_notify.php',
            data: { notifyButton: true }, // Add any additional data if needed
            success: function(response) {
                console.log('Notification triggered successfully:', response);
                // You can handle the response or update the UI as needed
            },
            error: function(error) {
                console.error('Error triggering notification:', error);
            }
        });
    });
});