<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}
require_once '../asset/config/function.php';

$id = $_GET['nip'];
$a = query("SELECT * FROM tbl_penilaian WHERE nip = '$id'")[0];


if (isset($_POST['update'])) {
  ubahpenilaian($_POST);
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
      <h1>Update Data </h1>
    </div>
    <div class="container-form">
      <form action="" method="post">
        <ul>
          <li>
            <label>
              <b> Nama </b>
              <?php $nip = $_GET['nip']; ?>
              <?php $queryAlt = mysqli_query(koneksi(), "SELECT * FROM tbl_alternatif WHERE nip=$nip"); ?>
              <?php $datalt = mysqli_fetch_array($queryAlt) ?>
              <br>
              <select name="nip" id="" style="width: 100%;">
                <option selected value="<?= $datalt['nip']; ?>"><?= $datalt['nip']; ?> - <?= $datalt['nama_alternatif']; ?></option>
                <?php $queryAlternatif = query("SELECT * FROM tbl_alternatif ORDER BY nip") ?>
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
              <input type="Date" name="tanggal" required style="width: 100%;">
            </label>
          </li>
          <?php $querykriteria = mysqli_query(koneksi(), "SELECT * FROM tbl_kriteria ORDER BY id_kriteria"); ?>
          <?php while ($datakriteria = mysqli_fetch_array($querykriteria)) : ?>
            <?php $idk = $datakriteria['id_kriteria']; ?>
            <?php $labelk = $datakriteria['nama_kriteria']; ?>
            <?php $nip = $_GET['nip']; ?>
            <?php $querysub = mysqli_query(koneksi(), "SELECT s.id_sub, s.nama_sub FROM tbl_penilaian p
                                                      INNER JOIN tbl_subkriteria s
                                                      ON p.id_sub = s.id_sub
                                                      WHERE p.id_kriteria = '$idk' AND nip = '$nip'"); ?>
            <?php $datasub = mysqli_fetch_array($querysub) ?>
            <?php $sub = $datasub['id_sub']; ?>
            <?php $nmsub = $datasub['nama_sub']; ?>
            <li>
              <label>
                <b> <?= $labelk; ?></b>
                <br>
                <select name=" <?= $idk; ?>" style="width: 100%;">
                  <option selected value="<?= $sub; ?>"><?= $sub; ?> - <?= $nmsub; ?></option>
                  <?php $d1 = mysqli_query(koneksi(), "SELECT * FROM tbl_subkriteria WHERE id_kriteria = '$idk' ORDER BY nilai_sub DESC"); ?>
                  <?php while ($d = mysqli_fetch_array($d1)) : ?>
                    <?php if ($d['id_sub'] == $sub) : ?>
                      <option value="<?= $d['id_sub']; ?>"><?= $d['id_sub']; ?> - <?= $d['nama_sub']; ?></option>
                    <?php else : ?>
                      <option value="<?= $d['id_sub']; ?>"><?= $d['id_sub']; ?> - <?= $d['nama_sub']; ?></option>
                    <?php endif; ?>

                  <?php endwhile; ?>
                </select>
              </label>
            </li>
          <?php endwhile; ?>

          <li>
            <button type=" submit" name="update">Simpan</button>
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