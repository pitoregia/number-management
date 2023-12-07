$(document).ready(function () {
    $('.dropdown-item').click(function () {
        var status = $(this).text();
        var rowId = $(this).closest('tr').find('.row-id').text(); // Add a class 'row-id' to the <td> that contains the row ID

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php', // Create a separate PHP file for handling the update
            data: { id: rowId, status: status },
            success: function () {
                // Optionally, you can update the UI here if needed
                location.reload(); // Reload the page to reflect the changes
            }
        });
    });
});