<?php
require 'dbconnect.php';

if (isset($_POST['bsave'])) {
  $number = $_POST['number'];
  $description = $_POST['description'];
  $status = $_POST['status'];
  $tanggal_aktif = $_POST['tanggal-aktif'];
  $tanggal_expired = $_POST['tanggal-expired'];



  // edit
  if (isset($_GET['q']) == 'edit') {
    $query = mysqli_query($conn, "UPDATE tnumber SET nomor_telp = '$number', status = '$status', tanggal_aktif = '$tanggal_aktif', tanggal_expired = '$tanggal_expired', deskripsi = '$description' WHERE id = '$_GET[id]'");
    if ($query) {
      echo "<script>alert('Data berhasil diubah!');
            document.location='index.php';
            </script>";
    } else {
      echo "<script>alert('Data gagal diubah!')
            document.location='index.php';
            </script>";
    }
  } else {
    // save
    $query = mysqli_query($conn, "INSERT INTO tnumber (nomor_telp, status, tanggal_aktif, tanggal_expired, deskripsi) VALUES ('$number', '$status', '$tanggal_aktif', '$tanggal_expired', '$description')");

    if ($query) {
      echo "<script>alert('Data berhasil disimpan!');
          document.location='index.php';
          </script>";
    } else {
      echo "<script>alert('Data gagal disimpan!')
          document.location='index.php';
          </script>";
    }
  }
}

$phone_number = '';
$description = '';
$status = '';
$tanggal_aktif = '';
$tanggal_expired = '';

if (isset($_GET['q'])) {
  if ($_GET['q'] == 'edit') {
    $query = mysqli_query($conn, "SELECT * FROM tnumber WHERE id = '$_GET[id]'");
    $data = mysqli_fetch_array($query);
    if ($data) {
      $phone_number = $data['nomor_telp'];
      $description = $data['deskripsi'];
      $status = $data['status'];
      $tanggal_aktif = $data['tanggal_aktif'];
      $tanggal_expired = $data['tanggal_expired'];
    }
  } else if ($_GET['q'] == 'delete') {
    $query = mysqli_query($conn, "DELETE FROM tnumber WHERE id = '$_GET[id]'");
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');
            document.location='index.php';
            </script>";
    } else {
      echo "<script>alert('Data gagal dihapus!')
            document.location='index.php';
            </script>";
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Number Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- <div class="container">
    <h3 class="text-center">Simulation Page</h3>

    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="card shadow">
          <div class="card-header bg-secondary text-light">Input</div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="number" value="<?= $phone_number ?>" class="form-control" />
              </div>
              <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" value="<?= $description ?>" class="form-control" />
              </div>
              <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                  <option value="<?= $status ?>" selected hidden><?= $status ?></option>
                  <option value="Hidup">Hidup</option>
                  <option value="Tenggang">Tenggang</option>
                  <option value="Mati">Mati</option>
                </select>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Tanggal Masa Aktif</label>
                    <input type="date" name="tanggal-aktif" value="<?= $tanggal_aktif ?>" class="form-control" />
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Tanggal Masa Expired</label>
                    <input type="date" name="tanggal-expired" value="<?= $tanggal_expired ?>" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="text-center">
                <hr />
                <button class="btn w-100 btn-primary text-center" name="bsave" type="submit">
                  Save
                </button>
              </div>
            </form>
          </div>
          <div class="card-footer bg-secondary"></div>
        </div>
      </div>
    </div>
  </div> -->


  <div class="card col-8 mt-4 mx-auto shadow">
    <div class="card-header bg-secondary text-light">Data Phone Number</div>
    <div class="card-body">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col">
            <form method="POST">
              <div class="input-group mb-3">
                <input type="text" name="tsearch" class="form-control" placeholder="Search" />
                <button class="btn btn-primary" name="bsearch" type="submit">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </div>
            </form>
          </div>
          <div class="col-auto">
            <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNumberModal">
              <i class="fa-solid fa-plus"></i>
            </button>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="addNumberModal" tabindex="-1" aria-labelledby="addNumberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addNumberModalLabel">Add new number</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="POST">
                <div class="mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="text" name="number" value="<?= $phone_number ?>" class="form-control" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <input type="text" name="description" value="<?= $description ?>" class="form-control" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select class="form-select" name="status">
                    <option value="<?= $status ?>" selected hidden><?= $status ?></option>
                    <option value="Hidup">Hidup</option>
                    <option value="Tenggang">Tenggang</option>
                    <option value="Mati">Mati</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label">Tanggal Masa Aktif</label>
                      <input type="date" name="tanggal-aktif" value="<?= $tanggal_aktif ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label">Tanggal Masa Expired</label>
                      <input type="date" name="tanggal-expired" value="<?= $tanggal_expired ?>" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <hr />
                  <button class="btn w-100 btn-primary text-center" name="bsave" type="submit">
                    Save
                  </button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-striped table-hover table-bordered">
        <tr>
          <th>No.</th>
          <th>Nomor</th>
          <th>Status</th>
          <th>Tanggal Masa Aktif</th>
          <th>Tanggal Masa Expired</th>
          <th>Deskripsi</th>
          <th>Action</th>
        </tr>
        <?php
        $no = 1;

        if (isset($_POST['bsearch'])) {
          $search = $_POST['tsearch'];
          $query = mysqli_query($conn, "SELECT * FROM tnumber WHERE nomor_telp LIKE '%$search%' or status LIKE '%$search%' or tanggal_aktif LIKE '%$search%' or tanggal_expired LIKE '%$search%' or deskripsi LIKE '%$search%'");
        } else
          $query = mysqli_query($conn, "SELECT * FROM tnumber order by id asc");

        while ($row = mysqli_fetch_array($query)) {
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nomor_telp'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['tanggal_aktif'] ?></td>
            <td><?= $row['tanggal_expired'] ?></td>
            <td><?= $row['deskripsi'] ?></td>
            <td>
              <a href="index.php?q=edit&id=<?= $row['id'] ?>" name="bedit" class="btn btn-warning "><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="index.php?q=delete&id=<?= $row['id'] ?>" name="bdelete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>

        <?php } ?>
      </table>
    </div>
    <div class="card-footer bg-secondary"></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>