document.addEventListener("DOMContentLoaded", function () {
    // Add a click event listener to all buttons with class "notifyButton"
    var buttons = document.querySelectorAll(".notifyButton");
    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            // Get the number from the data attribute
            var number = button.getAttribute("data-number");
            var description = button.getAttribute("data-description");

            // Your JSON data with the dynamic number
            var jsonData = JSON.stringify({
                "number": number,
                "message": description
            });

            // Your target URL
            var targetUrl = "http://localhost:3000/notificationBanned";

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure it: POST-request, URL, async
            xhr.open('POST', targetUrl, true);

            // Set the request header to indicate JSON data
            xhr.setRequestHeader('Content-Type', 'application/json');

            // Set up the callback function to handle the response
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Request was successful, handle the response if needed
                    console.log(xhr.responseText);
                } else {
                    // Request failed
                    console.error('Request failed with status ' + xhr.status);
                }
            };

            // Send the request with the JSON data
            xhr.send(jsonData);
        });
    });
});
