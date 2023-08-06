<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}
require_once '../asset/config/function.php';
$query = query("SELECT * FROM tbl_pimpinan ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pendukung Keputusan</title>
  <link rel="stylesheet" href="../asset/css/style.css">
  <link rel="stylesheet" href="../datatables/datatables.css">
  <script src="../datatables/datatables.js"></script>

  <link rel="stylesheet" href="../asset/css/style.css">

  <!-- datatable -->
  <link rel="stylesheet" href="../datatables/datatables.css">
  <script src="../datatables/datatables.js"></script>
</head>

<body>
  <header>
    <div class="logo">
      <h1>SPK</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="dashboard_admin.php" class="dash">Home</a></li>
        <li><a href="read_alternatif.php">Alternatif</a></li>
        <li><a href="pemimpin.php">Pimpinan</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>
  <main>
    <h1>PIMPINAN</h1>
    <div class="container">
      <div class="container-body">
        <div class="tabel">
          <table id="example" class="cell-border" style="width:100%" aria-describedby="example_info">
            <thead>
              <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php $no = 1; ?>
                <?php foreach ($query as $data) : ?>

                  <td><?= $no; ?></td>
                  <td><?= $data['nama_pimpinan']; ?></td>
                  <td>
                    <a href="update_pimpinan.php?id=<?= $data['id']; ?>" class="aksi edit">edit</a>
                  </td>
              </tr>
              <?php $no++; ?>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>


<script>
  $('#example').DataTable();
</script>

</html>