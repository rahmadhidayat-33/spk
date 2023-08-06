<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}

require_once '../asset/config/function.php';

$id = $_GET['id'];
$a = query("SELECT * FROM tbl_pimpinan WHERE id = '$id'")[0];

if (isset($_POST['tambah'])) {
  if (ubahpimpinan($_POST) > 0) {
    echo "<script>
          alert('Data berhasil di ubah');
          window.location.href = 'pemimpin.php';
          </script>";
  } else {
    echo "<script>
          alert('Data Gagal di ubah');
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pendukung Keputusan</title>
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
        <li><a href="dashboard_admin.php">Home</a></li>
        <li><a href="read_alternatif.php">Alternatif</a></li>
        <li><a href="pemimpin.php">Pimpinan</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>

  <div class="container-input">
    <div class="input-head">
      <img src="../asset/img/Element 09.png" alt="">
      <a href="read_alternatif.php">Kembali</a>
      <h1> Update Data </h1>
    </div>
    <div class="container-form">
      <form action="" method="post">
        <input type="hidden" name="id" value="<?= $a['id']; ?>">
        <ul>
          <li>
            <label>
              <b> Nama </b>
              <br>
              <input type="text" name="nama_pimpinan" autocomplete="off" required placeholder="Tambahkan Nama" style="width: 100%;" value="<?= $a['nama_pimpinan']; ?>">
            </label>
          </li>
          <li>
            <button type="submit" name="tambah">Simpan</button>
          </li>
        </ul>
      </form>
    </div>
  </div>

  <footer>
    Rahmad Hidayat
  </footer>
  <script>
    $('#example').DataTable();
  </script>


</body>

</html>