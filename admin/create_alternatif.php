<?php

require_once '../asset/config/function.php';

if (isset($_POST['tambah'])) {
  if (tambahalternatif($_POST) > 0) {
    echo "<script>
          alert('Data berhasil di tambahkan');
          window.location.href = 'read_alternatif.php';
          </script>";
  } else {
    echo "<script>
          alert('Data Gagal di tambahkan');
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
        <li><a href="dashboard_admin.php">Dashboard</a></li>
        <li><a href="read_alternatif.php">Alternatif</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>

  <div class="container-input">
    <a href="read_alternatif.php">Kembali</a>
    <h1>Input Data</h1>
    <form action="" method="post">
      <ul>
        <li>
          <label>
            <b> Nip </b>
            <br>
            <input type="number" name="nip" autocomplete="off" required autofocus placeholder="Tambahkan Nip">
          </label>
        </li>
        <li>
          <label>
            <b> Nama </b>
            <br>
            <input type="text" name="nama_alternatif" autocomplete="off" required placeholder="Tambahkan Nama">
          </label>
        </li>
        <li>
          <label>
            <b> Jenis Kelamin </b>
            <br>
            <select name="jenis_kelamin">
              <option disabled selected>---</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </label>
        </li>
        <li>
          <label>
            <b> Golongan</b>
            <br>
            <select name="gol">
              <option disabled selected>---</option>
              <option value="III-A">III-A</option>
              <option value="III-B">III-B</option>
              <option value="III-C">III-C</option>
              <option value="III-D">III-D</option>
            </select>
          </label>
        </li>
        <li>
          <label>
            <b>Program Study</b>
            <br>
            <input type="text" name="program_studi" autocomplete="off" required autofocus placeholder="tambahkan program study">
          </label>
        </li>
        <li>
          <label>
            <b>Jabatan Sebelumnya</b>
            <br>
            <select name="jabatan">
              <option selected disabled>---</option>
              <option value="ada">Ada</option>
              <option value="tidak ada">Tidak ada</option>
            </select>
          </label>
        </li>
        <li>
          <button type="submit" name="tambah">Simpan</button>
        </li>
      </ul>
    </form>
  </div>
</body>

</html>