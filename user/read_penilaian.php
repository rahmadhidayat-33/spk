<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}
require_once '../asset/config/function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pendukung Keputusan</title>
  <link rel="stylesheet" href="../asset/css/style.css">
  <link rel="stylesheet" href="../datatables/datatables.css">
  <script src="../datatables/datatables.js"></script>

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
  <main>
    <h1>- -Penilaian- -</h1>
    <div class="container">
      <div class="container-body">
        <div class="container-head">
          <a href="create_penilaian.php" class="tambah">Tambah</a>
        </div>

        <div class="tabel">
          <table id="example" class="display dataTable" style="width:100%" aria-describedby="example_info">
            <thead>
              <tr>
                <th>NO</th>
                <th>NIP</th>
                <th>NAMA</th>
                <th>TANGGAL</th>
                <?php $kriteriaQuery = query("SELECT * FROM tbl_kriteria") ?>
                <?php foreach ($kriteriaQuery as $kriteria) : ?>
                  <th><?= $kriteria['id_kriteria']; ?></th>
                <?php endforeach; ?>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php $alternatifQuery = query("SELECT DISTINCT  a.nip, a.nama_alternatif, p.tanggal
                                      FROM tbl_alternatif a
                                      INNER JOIN tbl_penilaian p ON a.nip = p.nip ORDER BY nip") ?>
              <?php $no = 1; ?>
              <?php foreach ($alternatifQuery as $altquery) : ?>
                <tr>
                  <?php $nama = $altquery['nama_alternatif']; ?>
                  <td><?= $no++; ?></td>
                  <td><?= $altquery['nip']; ?></td>
                  <td><?= $altquery['nama_alternatif']; ?></td>
                  <td><?= $altquery['tanggal']; ?></td>
                  <?php $subquery = query("SELECT s.id_sub as sub FROM tbl_penilaian p 
                        INNER JOIN tbl_subkriteria s ON p.id_sub = s.id_sub
                        WHERE tanggal='" . $altquery['tanggal'] . "' AND nip='" . $altquery['nip'] . "'") ?>
                  <?php foreach ($subquery as $sub) : ?>
                    <td><?= $sub['sub']; ?></td>
                  <?php endforeach; ?>
                  <td>
                    <a href="update_penilaian.php?nip=<?= $altquery['nip']; ?>" class="aksi edit">edit</a>
                    <a href="delete_penilaian.php?nip=<?= $altquery['nip']; ?>" onclick="return confirm('apakah yakin mau di hapus?')" class="aksi hapus">hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
  </main>


</body>


<script>
  $('#example').DataTable();
</script>



</html>