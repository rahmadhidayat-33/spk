<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}

require_once '../asset/config/function.php';

if (isset($_POST['tambah'])) {
  tambahpenilaian($_POST);
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
        <li><a href="dashboard_user.php">Home</a></li>
        <li><a href="read_penilaian.php">Penilaian</a></li>
        <li><a href="Metode_saw.php">Metode saw</a></li>
        <li><a href="rangking.php">Rengking</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>

  <div class="container-input">
    <div class="input-head">
      <img src="../asset/img/Element 09.png" alt="">
      <a href="read_penilaian.php">Kembali</a>
      <h1>Input Data </h1>
    </div>
    <div class="container-form">
      <form action="" method="post">
        <ul>
          <li>
            <label>
              <b> Nama </b>
              <br>
              <?php $queryAlternatif = query("SELECT * FROM tbl_alternatif ORDER BY nip") ?>
              <select name="nip" id="" style="width: 100%;">
                <option value="">---</option>
                <?php foreach ($queryAlternatif as $dataAlternatif) : ?>
                  <option value="<?= $dataAlternatif['nip']; ?>"><?= $dataAlternatif['nip']; ?> - <?= $dataAlternatif['nama_alternatif']; ?></option>
                <?php endforeach; ?>
              </select>
            </label>
          </li>
          <li>
            <label>
              <b> Tanggal </b>
              <br>
              <input type="Date" name="tanggal" style="width: 100%;">
            </label>
          </li>
          <?php $querykriteria = mysqli_query(koneksi(), "SELECT * FROM tbl_kriteria ORDER BY id_kriteria"); ?>
          <?php while ($datakriteria = mysqli_fetch_array($querykriteria)) : ?>
            <?php $idk = $datakriteria['id_kriteria']; ?>
            <?php $labelk = $datakriteria['nama_kriteria']; ?>
            <li>
              <label>
                <b> <?= $labelk; ?></b>
                <br>
                <select name=" <?= $idk; ?>" style="width: 100%;">
                  <option option disabled selected>---</option>
                  <?php $d1 = mysqli_query(koneksi(), "SELECT * FROM tbl_subkriteria WHERE id_kriteria = '$idk' ORDER BY nilai_sub DESC"); ?>
                  <?php while ($d = mysqli_fetch_array($d1)) : ?>
                    <option value="<?= $d['id_sub']; ?>"><?= $d['id_sub']; ?> - <?= $d['nama_sub']; ?></option>
                  <?php endwhile; ?>
                </select>
              </label>
            </li>
          <?php endwhile; ?>

          <li>
            <button type=" submit" name="tambah">Simpan</button>
          </li>
        </ul>
      </form>
    </div>
  </div>
</body>

</html>