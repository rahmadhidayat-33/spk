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
      <div class="jud">
      <h2>Pondok Pesantren Diniyah Limo Jurai Sungai pua</h2>
      <p>Tabel Perengkingan Kenaikan Jabatan tahun <?= date('Y');?></p>
      </div>
    </header>
    
    <hr color="black">
    <br>
    <p><?= $tanggal; ?></p>
    <table class="tbl1">
      <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Nilai</th>
        <th>Keterangan</th>
      </tr>
      <?php $no = 1; ?>
      <?php foreach ($rengkingQuery as $row) : ?>
        <?php
          $keterangan = ($no <= 3) ? 'Rekomendasi' : 'Tidak direkomendasikan';
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['nip']; ?></td>
          <td><?= $row['nama_alternatif']; ?></td>
          <td><?= $row['nilai']; ?></td>
          <td><?= $keterangan; ?></td>
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
        <?php 
          $p = mysqli_query(koneksi(), "SELECT nama_pimpinan FROM tbl_pimpinan");
          $pimpinan = mysqli_fetch_assoc($p);
          ?>
        <p><?= $pimpinan['nama_pimpinan']; ?></p>
      </div>
    </div>
    <script>
      window.print();
    </script>
  </div>
</body>

</html>
