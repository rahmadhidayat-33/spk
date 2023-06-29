<?php
require_once '../asset/config/function.php';
$query = query("SELECT * FROM tbl_alternatif ORDER BY nip ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
        <li><a href="dashboard_admin.php">Dashboard</a></li>
        <li><a href="read_alternatif.php">Alternatif</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div class="container">
      <div class="container-head">
        <h1>Alternatif</h1>
      </div>
      <div class="container-body">
        <a href="create_alternatif.php">Tambah</a>
        <div class="tabel">

          <table id="example" class="display dataTable" style="width:100%" aria-describedby="example_info">
            <thead>
              <tr>
                <th>NO</th>
                <th>NIP</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>GOL</th>
                <th>PROGRAM STUDY</th>
                <th>JABATAN SEBELUMNYA</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <?php $no = 1; ?>
                <?php foreach ($query as $data) : ?>

                  <td><?= $no; ?></td>
                  <td><?= $data['nip']; ?></td>
                  <td><?= $data['nama_alternatif']; ?></td>
                  <td><?= $data['jenis_kelamin']; ?></td>
                  <td><?= $data['gol']; ?></td>
                  <td><?= $data['program_studi']; ?></td>
                  <td><?= $data['jabatan']; ?></td>
                  <td>
                    <a href="update_alternatif.php?nip=<?= $data['nip']; ?>">edit</a>
                    <a href="delete_alternatif.php?nip=<?= $data['nip']; ?>" onclick="return confirm('apakah yakin mau di hapus?')">hapus</a>
                  </td>
              </tr>
              <?php $no++; ?>
            <?php endforeach; ?>

            </tbody>
          </table>
        </div>
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