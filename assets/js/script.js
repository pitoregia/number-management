// USER MANAGEMENT
// ROLE SELECTION
$(document).ready(function () {
    $('.role-item').click(function () {
        var role_id = $(this).data('role-id');
        var rowId = $(this).closest('tr').find('.row-id').text();

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php',
            data: { id: rowId, role_id: role_id },
            success: function () {
                location.reload();
            }
        });
    });
});

//
// NUMBER MANAGEMENT
// Number Status Update
$(document).ready(function () {
    $('.status-item').click(function () {
        var status = $(this).text();
        var rowId = $(this).closest('tr').find('.row-id').text();

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php',
            data: { id: rowId, status: status },
            success: function () {
                location.reload();
            }
        });
    });
});

// Device Update
$(document).ready(function () {
    $('.device-item').click(function () {
        var device_id = $(this).data('device-id');
        var rowId = $(this).closest('tr').find('.row-id').text();

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php',
            data: { id: rowId, device_id: device_id },
            success: function () {
                location.reload();
            }
        });
    });
});

// PIC Update
$(document).ready(function () {
    $('.pic-item').click(function () {
        var pic_id = $(this).data('pic-id');
        var rowId = $(this).closest('tr').find('.row-id').text();

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php',
            data: { id: rowId, pic_id: pic_id },
            success: function () {
                location.reload();
            }
        });
    });
});

// Current Application Update
$(document).ready(function () {
    $('.current-application-item').click(function () {
        var current_application_id = $(this).data('current-application-id');
        var rowId = $(this).closest('tr').find('.row-id').text();

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php',
            data: { id: rowId, current_application_id: current_application_id },
            success: function () {
                location.reload();
            }
        });
    });
});

// Whatsapp Status Update
$(document).ready(function () {
    $('.wa-status-item').click(function () {
        var wa_status = $(this).text();
        var rowId = $(this).closest('tr').find('.row-id').text();

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php',
            data: { id: rowId, wa_status: wa_status },
            success: function () {
                location.reload();
            }
        });
    });
});

// Scanned Status Update
$(document).ready(function () {
    $('.scanned-item').click(function () {
        var scanned = $(this).text();
        var rowId = $(this).closest('tr').find('.row-id').text();

        $.ajax({
            type: 'POST',
            url: '../function/update_status.php',
            data: { id: rowId, scanned: scanned },
            success: function () {
                location.reload();
            }
        });
    });
});