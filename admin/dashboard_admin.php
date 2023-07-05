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
        <li><a href="dashboard_admin.php">Home</a></li>
        <li><a href="read_alternatif.php">Alternatif</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div class="container-dash">
      <div class="label">
        <h1>SISTEM PENDUKUNG </h1>
        <h1 class="b">KEPUTUSAN</h1>
        <h3>Welcome, <?php echo $_SESSION["nama_lengkap"]; ?></h3> <!-- Tampilkan nama pengguna -->
      </div>
      <div class="label2">
        <img src="../asset/img/Group 1.png" alt="">
      </div>
    </div>
  </main>

  <footer>
    <h4>rahmad hidayat</h4>
  </footer>

</body>


<script>
  $('#example').DataTable();
</script>

</html>