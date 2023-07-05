<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}
require_once '../asset/config/function.php';

// Ambil id dari URL
$nipin = $_GET['nip'];
$a = query("SELECT * FROM tbl_alternatif WHERE nip = '$nipin'")[0];

if (isset($_POST['ubah'])) {
  if (ubahalternatif($_POST) > 0) {
    echo "<script>
          alert('Data berhasil diubah');
          window.location.href = 'read_alternatif.php';
          </script>";
  } else {
    echo "<script>
          alert('Data Gagal diubah');
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
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>

  <div class="container-input">
    <div class="input-head">
      <img src="../asset/img/Element 09.png" alt="">
      <a href="read_alternatif.php">Kembali</a>
      <h1>Update Data</h1>

    </div>
    <div class="container-form">
      <form action="" method="post">
        <ul>
          <input type="hidden" name="nip" value="<?= $a['nip']; ?>">
          <li>
            <label>
              <b>Nip</b>
              <br>
              <input type="number" name="nip" autocomplete="off" required autofocus placeholder="Tambahkan Nip" value="<?= $a['nip']; ?>" style="width: 100%;">
            </label>
          </li>
          <li>
            <label>
              <b>Nama</b>
              <br>
              <input type="text" name="nama_alternatif" autocomplete="off" required placeholder="Tambahkan Nama" value="<?= $a['nama_alternatif']; ?>" style="width: 100%;">
            </label>
          </li>
          <li>
            <label>
              <b>Jenis Kelamin</b>
              <br>
              <select name="jenis_kelamin" style="width: 100%;">
                <option selected value="<?= $a['jenis_kelamin']; ?>"><?= $a['jenis_kelamin']; ?></option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
            </label>
          </li>
          <li>
            <label>
              <b>Golongan</b>
              <br>
              <select name="gol" style="width: 100%;">
                <option selected value="<?= $a['gol']; ?>"><?= $a['gol']; ?></option>
                <option value="III-A">III-A</option>
                <option value="III-B">III-B</option>
                <option value="III-C">III-C</option>
                <option value="III-D">III-D</option>
              </select>
            </label>
          </li>
          <li>
            <label>
              <b>Program Studi</b>
              <br>
              <input type="text" name="program_studi" autocomplete="off" required autofocus placeholder="Tambahkan Program Studi" value="<?= $a['program_studi']; ?>" style="width: 100%;">
            </label>
          </li>
          <li>
            <label>
              <b>Jabatan Sebelumnya</b>
              <br>
              <select name="jabatan" style="width: 100%;">
                <option selected value="<?= $a['jabatan']; ?>"><?= $a['jabatan']; ?></option>
                <option value="ada">Ada</option>
                <option value="tidak ada">Tidak ada</option>
              </select>
            </label>
          </li>
          <li>
            <button type="submit" name="ubah">Update</button>
          </li>
        </ul>
      </form>
    </div>
  </div>
  <footer>
    <h4>rahmad hidayat</h4>
  </footer>

</body>

</html>