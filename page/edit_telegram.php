<?php
require_once '../function/dbconnect.php';
require_once '../function/helper.php';
session_start();

// Fetch data
if (isset($_GET['q']) && $_GET['q'] == 'edit') {
    $query = mysqli_query($conn, "SELECT * FROM bot_token WHERE bot_id = '$_GET[id]'");
    $data = mysqli_fetch_array($query);
    if ($data) {
        $botname = $data['bot_name'];
        $telegramBotToken = $data['telegram_bot_token'];
        $groupChatId = $data['group_chat_id'];
        $message = $data['message'];
    }
}

// Save edited data
if (isset($_POST['bsave'])) {
    $botname = $_POST['bot_name'];
    $telegramBotToken = $_POST['telegram_bot_token'];
    $groupChatId = $_POST['group_chat_id'];
    $message = $_POST['message'];

    // Edit
    if (isset($_GET['q']) && $_GET['q'] == 'edit') {
        $query = mysqli_query($conn, "UPDATE bot_token SET bot_name = '$botname', telegram_bot_token = '$telegramBotToken', group_chat_id = '$groupChatId', message = '$message' WHERE bot_id = '$_GET[id]'");
        if ($query) {
            echo "<script>alert('Data berhasil diubah!');
            document.location='telegram_master.php';
            </script>";
        } else {
            echo "<script>alert('Data gagal diubah!')
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
    <title>Dashboard | Edit Bot Token</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('../components/sidebar.php'); ?>

        <!-- Page Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php include('../components/topbar.php'); ?>

            <div id="content">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow">
                                <h5 class="card-header bg-secondary text-light text-center">Edit Bot Token</h5>
                                <div class="card-body">
                                    <form action="" method="POST">
                                    <div class="mb-3">
                                            <label class="form-label">Bot Name</label>
                                            <input type="text" name="bot_name" value="<?= $botname ?>" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Telegram Bot Token</label>
                                            <input type="text" name="telegram_bot_token" value="<?= $telegramBotToken ?>" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Group Chat ID</label>
                                            <input type="text" name="group_chat_id" value="<?= $groupChatId ?>" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <input type="text" name="message" value="<?= $message ?>" class="form-control" />
                                        </div>
                                        <div class="text-center">
                                            <hr />
                                            <button class="btn w-100 btn-primary text-center" name="bsave" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </form>
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
