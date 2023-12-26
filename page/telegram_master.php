<?php
session_start();
require_once '../function/dbconnect.php';
require_once '../function/helper.php';

if (!in_array("edit_user", $_SESSION['role_permission'])) {
    header("Location: " . BASE_URL . "index.php");
    exit();
}

// Check if the user is logged in
if ($_SESSION['role_id'] == null) {
    header("Location: " . BASE_URL);
    exit();
}

// Handle bot token data insertion
if (isset($_POST['bsave_token'])) {
    $namebot = $_POST['bot_name'];
    $telegramBotToken = $_POST['telegram_bot_token'];
    $groupChatId = $_POST['group_chat_id'];
    $message = $_POST['message'];

    $query = mysqli_query($conn, "INSERT INTO bot_token (bot_name, telegram_bot_token, group_chat_id, message) VALUES ('$namebot', '$telegramBotToken', '$groupChatId', '$message')");

    if ($query) {
        echo "<script>alert('Bot token data saved successfully!');
                document.location='telegram_master.php';
                </script>";
    } else {
        echo "<script>alert('Failed to save bot token data!')
                document.location='telegram_master.php';
                </script>";
    }
}

// Handle bot token deletion
if (isset($_GET['q_token'])) {
    if ($_GET['q_token'] == 'delete') {
        // Delete bot token data from the 'bot_token' table
        $query = mysqli_query($conn, "DELETE FROM bot_token WHERE bot_id = '$_GET[id]'");
        if ($query) {
            header("Location: " . BASE_URL . "page/telegram_master.php");
        } else {
            echo "<script>alert('Failed to delete bot token data!')
            document.location='telegram_master.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../components/header.php'); ?>
    <title>Bot Token Management</title>

    <style>
        .table td,
        .table th {
            text-align: center;
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('../components/sidebar.php'); ?>

        <!-- Page Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php include('../components/topbar.php'); ?>
            <div id="content">
                <div class="container">
                    <div class="card col-12 mt-4 mx-auto shadow">
                        <div class="card-body">
                            <div class="container">
                                <!-- Search and Add Bot Token Form -->
                                <div class="row justify-content-between">
                                    <div class="col">
                                        <form method="POST">
                                            <div class="input-group mb-3">
                                                <input type="text" name="tsearch_token" class="form-control" placeholder="Search" />
                                                <button class="btn btn-primary" name="bsearch_token" type="submit">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTokenModal">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal for add Token -->
                                <div class="modal fade" id="addTokenModal" tabindex="-1" aria-labelledby="addTokenModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="addTokenModalLabel">Add new bot token</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                <div class="mb-3">
                                                        <label class="form-label">Bot Name</label>
                                                        <input type="text" name="bot_name" class="form-control" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Telegram Bot Token</label>
                                                        <input type="text" name="telegram_bot_token" class="form-control" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Group Chat ID</label>
                                                        <input type="text" name="group_chat_id" class="form-control" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Message</label>
                                                        <input type="text" name="message" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" name="bsave_token" type="submit">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table Bot Token -->
                                <div class="table-wrap card-shadow mb-4">
                                    <table class="table text-align-center table-responsive-xl table-bordered">
                                        <tr>
                                            <th>No.</th>
                                            <th>Bot Name</th>
                                            <th>Telegram Bot Token</th>
                                            <th>Group Chat ID</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        $no = 1;

                                        if (isset($_POST['bsearch_token'])) {
                                            $search = $_POST['tsearch_token'];
                                            $query = mysqli_query($conn, "SELECT * FROM bot_token WHERE telegram_bot_token LIKE '%$search%' or group_chat_id LIKE '%$search%' or message LIKE '%$search%'");
                                        } else
                                            $query = mysqli_query($conn, "SELECT * FROM bot_token order by bot_id asc");

                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['bot_name'] ?></td>
                                                <td><?= $row['telegram_bot_token'] ?></td>
                                                <td><?= $row['group_chat_id'] ?></td>
                                                <td><?= $row['message'] ?></td>
                                                <td>
                                                    <a href="edit_telegram.php?q=edit&id=<?= $row['bot_id'] ?>" name="bedit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a href="telegram_master.php?q_token=delete&id=<?= $row['bot_id'] ?>" name="bdelete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this bot token?')"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include('../components/footer.php'); ?>

        </div>
    </div>
</body>

</html>
