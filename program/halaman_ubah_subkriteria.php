<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: halaman_login.php");
  exit;
}

require_once '../function/functions.php';

$id = $_GET["id_sub"];

$skta = query("SELECT * FROM subkriteria, kriteria WHERE subkriteria.id_kriteria=kriteria.id_kriteria and id_sub=$id")[0];
$kriteria = query("SELECT * FROM kriteria");


if (isset($_POST['ubah'])) {
  if (ubahsubkriteria($_POST) > 0) {
    echo "<script>
            alert ('Data Berhasil Diubah');
            document.location.href = 'halaman_subkriteria.php';
          </script>";
  } else {
    echo "<script>
            alert ('Data Gagal Diubah');
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
          <h2>Ubah Data Kriteria</h2>
          <a href="halaman_subkriteria.php">Kembali</a>
        </div>
        <div class="form-input">
          <form action="" method="post">
            <input type="hidden" name="id_sub" value="<?= $skta['id_sub']; ?>">
            <ul>
              <li>
                <label>
                  Kode Kriteria
                  <br>
                  <input type="text" name="kode_subkriteria" placeholder="Masukkan Kode Kriteria" autofocus required value="<?= $skta['kode_subkriteria']; ?>" readonly>
                </label>
              </li>
              <li>
                <label>
                  Nama sub Kriteria
                  <br>
                  <input type="text" name="nm_subkriteria" placeholder="Masukkan Nama Kriteria" required value="<?= $skta['nm_subkriteria']; ?>">
                </label>
              </li>
              <li>
                <label>
                  nilai
                  <br>
                  <input type="text" name="nilai" placeholder="Masukkan Bobot Kriteria" required value="<?= $skta['nilai']; ?>">
                </label>
              </li>
              <li>
                <label>
                  kriteria
                  <br>
                  <select name="id_kriteria" required>
                    <option value="<?= $skta['id_kriteria']; ?>"><?= $skta['nm_kriteria']; ?></option>
                    <?php foreach ($kriteria as $kta) : ?>
                      <option value="<?= $kta['id_kriteria']; ?>"><?= $kta['nm_kriteria']; ?></option>
                    <?php endforeach; ?>

                  </select>
                </label>
              </li>
              <button type="submit" name="ubah">Ubah</button>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </header>

</body>

</html>