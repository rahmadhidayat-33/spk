<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: halaman_login.php");
  exit;
}
require_once '../function/functions.php';

// membuat kode otomatis
$kodeauto = kodeautokriteria();
// end

if (isset($_POST['tambah'])) {
  if (tambahkriteria($_POST) > 0) {
    echo "<script>
            alert ('Data Berhasil Di tambahkan');
            document.location.href = 'halaman_kriteria.php';
          </script>";
  } else {
    echo "<script>
            alert ('Data Gagal Di tambahkan');
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kriteria</title>
  <!-- style css -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="sidebar">
    <div class="logo">
      <h1>S.P.K</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="halaman_dashboard.php"><i class="fi fi-rr-dashboard"></i><span>Dashboard</span></a></li>
        <li><a href="halaman_kriteria.php"><i class="fi fi-rr-box"></i><span>Data Kriteria</span> </a></li>
        <li><a href="halaman_subkriteria.php"><i class="fi fi-rr-boxes"></i><span>Data Sub Kriteria</span></a></li>
        <li><a href="halaman_alternatif.php"><i class="fi fi-rr-users"></i><span>Data Alternatif</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rs-edit"></i><span>Data Penilaian</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rr-calculator"></i><span>Data Perhitungan</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rr-chart-simple"></i><span>Data Hasil Akhir</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rr-user-add"></i><span>Data User</span></a></li>
      </ul>
    </div>
  </div>

  <header>
    <div class="navigasi">
      <div class="dropdown">
        <button class="dropbtn">
          <img src="../image/undraw_male_avatar_g98d.svg" alt="">
          <span>Rahmad Hidayat</span>
        </button>
        <div class="dropdown-content">
          <a href="#">Profile</a>
          <a href="logout.php">Log Out</a>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="head-menu">
        <div class="judul">
          <h1>Data Kriteria</h1>
        </div>
      </div>

      <div class="kelola">
        <div class="sub">
          <h2>Input Data Kriteria</h2>
          <a href="halaman_kriteria.php">Kembali</a>
        </div>
        <div class="form-input">
          <form action="" method="post">
            <ul>
              <li>
                <label>
                  Kode Kriteria
                  <br>
                  <input type="text" name="kode_kriteria" autofocus value="<?= $kodeauto; ?>" readonly>
                </label>
              </li>
              <li>
                <label>
                  Nama Kriteria
                  <br>
                  <input type="text" name="nm_kriteria" placeholder="Masukkan Nama Kriteria" required>
                </label>
              </li>
              <li>
                <label>
                  Bobot
                  <br>
                  <input type="text" name="bobot" placeholder="Masukkan Bobot Kriteria" required>
                </label>
              </li>
              <li>
                <label>
                  Pilihan
                  <br>
                  <select name="pilihan" required>
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                  </select>
                </label>
              </li>
              <button type="submit" name="tambah">Simpan</button>
            </ul>
            <img src="../image/undraw_forms_re_pkrt.svg" alt="">
          </form>
        </div>
      </div>
    </div>
  </header>

</body>

</html>