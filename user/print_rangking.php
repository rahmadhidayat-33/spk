<?php
session_start();


if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}
require_once '../asset/config/function.php';
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('d F Y');

$rengkingQuery = query("SELECT r.*, a.nip, a.nama_alternatif
                  FROM tbl_rengking r
                  INNER JOIN tbl_alternatif a ON r.nip = a.nip
                  INNER JOIN tbl_penilaian p ON r.nip = p.nip
                  WHERE p.tanggal = '$tanggal'
                  GROUP BY a.nip
                  ORDER BY r.nilai DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pendukung Keputusan</title>
  <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>
  <div class="container-report">
    <header class="kop">
      <img src="../asset/img/logo-min.png" alt="logo">
      <h2>Pondok Pesantren Diniyah Limo Jurai Sungai pua</h2>
    </header>
    <hr color="black">
    <br>
    <!-- <?php $t = $_GET['tanggal']; ?> -->
    <p><?= $tanggal; ?></p>
    <table class="tbl1">
      <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Nilai</th>
      </tr>
      <?php $no = 1; ?>
      <?php foreach ($rengkingQuery as $row) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['nip']; ?></td>
          <td><?= $row['nama_alternatif']; ?></td>
          <td><?= $row['nilai']; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <div class="container-ttd">
      <div class="ttd">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $date = date('d F Y');
        ?>
        <p>Bukittinggi, <?= $date; ?> </p>
      </div>

      <div class="nama">
        <p>Drs. Metriadi</p>
      </div>
    </div>
    <script>
      window.print();
    </script>
  </div>
</body>

</html>