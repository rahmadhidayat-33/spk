<?php

require_once 'function/functions.php';
$kriteria = query("SELECT * FROM kriteria");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kriteria</title>
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css">
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
          <img src="image/undraw_male_avatar_g98d.svg" alt="">
          <span>Rahmad Hidayat</span>
        </button>
        <div class="dropdown-content">
          <a href="#">Profile</a>
          <a href="#">Log Out</a>
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
          <h2>Tabel Data Kriteria</h2>
          <a href="">Tambah</a>
        </div>
        <div class="table">
          <table>
            <tr>
              <th>No</th>
              <th>Kode Kriteria</th>
              <th>Nama Kriteria</th>
              <th>Bobot</th>
              <th>Pilihan</th>
              <th>Aksi</th>
            </tr>

            <?php $i=1; ?>
            <?php foreach ($kriteria as $kta): ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $kta["kode_kriteria"]; ?></td>
              <td><?= $kta['nm_kriteria']; ?></td>
              <td><?= $kta['bobot']; ?></td>
              <td><?= $kta['pilihan']; ?></td>
              <td>
                <a href="" class="edit"><i class="fi fi-rr-edit" ></i></a> 
                <a href="" class="delete"><i class="fi fi-rr-trash"></i></a>
              </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>


  </header>

  <!-- <footer>
      <h4>copyright | Rahmad Hidayat</h4>
  </footer> -->
</body>

</html>