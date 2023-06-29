<?php
require_once '../asset/config/function.php';
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('YY-mm-dd');


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
        <li><a href="read_penilaian.php">Penilaian</a></li>
        <li><a href="Metode_saw.php">Metode saw</a></li>
        <li><a href="rangking.php">Rengking</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div class="container">
      <div class="container-head">
        <h1>Rangking</h1>
        <form method="get" action="">
          <label for="tanggal">Pilih Tanggal:</label>
          <input type="date" id="tanggal" name="tanggal" value="<?= $tanggal ?>">
          <input type="submit" value="Filter">
        </form>
        <form method="post" action="">
          <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
          <input type="submit" name="proses" value="Proses">
        </form>
      </div>
      <div class="container-body">
        <div class="tabel">
          <table>
            <thead>
              <tr>
                <th>NO</th>
                <th>NIP</th>
                <th>NAMA</th>
                <th>TANGGAL</th>
                <th>NILAI BOBOT</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $alternatifQuery = query("SELECT DISTINCT a.nip, a.nama_alternatif, p.tanggal
                            FROM tbl_alternatif a
                            INNER JOIN tbl_penilaian p ON a.nip = p.nip
                            WHERE p.tanggal = '$tanggal' ORDER BY nip");
              ?>
              <?php $no = 1; ?>
              <?php foreach ($alternatifQuery as $altquery) : ?>
                <?php $vi = 0; ?>
                <tr>
                  <?php $nama = $altquery['nama_alternatif']; ?>
                  <td><?= $no++; ?></td>
                  <td><?= $altquery['nip']; ?></td>
                  <td><?= $altquery['nama_alternatif']; ?></td>
                  <td><?= $altquery['tanggal']; ?></td>
                  <?php
                  $subquery = query("SELECT s.nilai_sub as sub , k.kategori as kategori, k.id_kriteria as id_kriteria
                          FROM tbl_penilaian p 
                          INNER JOIN tbl_subkriteria s ON p.id_sub = s.id_sub
                          INNER JOIN tbl_kriteria k ON p.id_kriteria = k.id_kriteria
                          WHERE tanggal='" . $altquery['tanggal'] . "' AND nip='" . $altquery['nip'] . "' ");
                  ?>
                  <?php foreach ($subquery as $sub) : ?>
                    <?php
                    // memanggil nilai max
                    $query1 = mysqli_query(koneksi(), "SELECT MAX(s.nilai_sub) AS nmax
                                          FROM tbl_subkriteria s
                                          INNER JOIN tbl_penilaian p ON s.id_sub = p.id_sub
                                          INNER JOIN tbl_alternatif a ON p.nip = a.nip
                                          WHERE p.tanggal = '$tanggal' AND s.id_kriteria = '" . $sub['id_kriteria'] . "'");
                    $result1 = mysqli_fetch_array($query1);
                    $tmax = $result1['nmax'];

                    // memanggil nilai min
                    $query2 = mysqli_query(koneksi(), "SELECT MIN(s.nilai_sub) AS nmin
                                          FROM tbl_subkriteria s
                                          INNER JOIN tbl_penilaian p ON s.id_sub = p.id_sub
                                          INNER JOIN tbl_alternatif a ON p.nip = a.nip
                                          WHERE p.tanggal = '$tanggal' AND s.id_kriteria = '" . $sub['id_kriteria'] . "'");
                    $result2 = mysqli_fetch_array($query2);
                    $tmin = $result2['nmin'];

                    // menentukan kategori
                    $kategori = $sub['kategori'];

                    // membuat keputusan sesuai kategori
                    if ($kategori == 'Benefit') {
                      $val = $sub['sub'] / $tmax;
                    } else {
                      $val = $tmin / $sub['sub'];
                    }
                    ?>
                    <?php $val = round($val, 2); ?>

                    <!-- panggil nilai bobot -->

                    <?php $query4 = mysqli_query(koneksi(), "SELECT bobot FROM tbl_kriteria WHERE id_kriteria = '" . $sub['id_kriteria'] . "'") ?>
                    <?php $result4 = mysqli_fetch_array($query4); ?>

                    <?php $bobotval = $result4['bobot']; ?>

                    <!-- perkalian bobot -->
                    <?php $valbobot = ($val * $bobotval); ?>
                    <?php $nbobot = round($valbobot, 2); ?>
                    <?php $vi += $valbobot; ?>
                    <?php $nvi = round($vi, 2); ?>

                  <?php endforeach; ?>
                  <td><?= $nvi ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>


    <!-- bagian proses  -->

    <!-- normalisasi -->
    <?php if (isset($_POST['proses'])) : ?>
      <?php $tanggal = $_POST['tanggal']; ?>
      <?php $filteredQuery = query("SELECT DISTINCT a.nip, a.nama_alternatif, p.tanggal
                          FROM tbl_alternatif a
                          INNER JOIN tbl_penilaian p ON a.nip = p.nip
                          WHERE p.tanggal = '$tanggal'"); ?>

      <!-- nilai bobot -->
      <?php
      $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');

      // Memproses perengkingan dan menyimpan hasil ke dalam tabel tbl_rengking
      if (isset($_POST['proses'])) {
        $tanggal = $_POST['tanggal'];

        // Menghapus data yang ada di tabel tbl_rengking sebelum melakukan perengkingan baru
        mysqli_query(koneksi(), "TRUNCATE TABLE tbl_rengking");

        $alternatifQuery = query("SELECT DISTINCT a.nip, a.nama_alternatif, p.tanggal
                            FROM tbl_alternatif a
                            INNER JOIN tbl_penilaian p ON a.nip = p.nip
                            WHERE p.tanggal = '$tanggal' ORDER BY nip");

        foreach ($alternatifQuery as $altquery) {
          $nip = $altquery['nip'];
          $nama_alternatif = $altquery['nama_alternatif'];

          $vi = 0;
          $subquery = query("SELECT s.nilai_sub as sub , k.kategori as kategori, k.id_kriteria as id_kriteria
                      FROM tbl_penilaian p 
                      INNER JOIN tbl_subkriteria s ON p.id_sub = s.id_sub
                      INNER JOIN tbl_kriteria k ON p.id_kriteria = k.id_kriteria
                      WHERE tanggal='" . $altquery['tanggal'] . "' AND nip='" . $altquery['nip'] . "' ");

          foreach ($subquery as $sub) {
            // memanggil nilai max
            $query1 = mysqli_query(koneksi(), "SELECT MAX(s.nilai_sub) AS nmax
                                        FROM tbl_subkriteria s
                                        INNER JOIN tbl_penilaian p ON s.id_sub = p.id_sub
                                        INNER JOIN tbl_alternatif a ON p.nip = a.nip
                                        WHERE p.tanggal = '$tanggal' AND s.id_kriteria = '" . $sub['id_kriteria'] . "'");
            $result1 = mysqli_fetch_array($query1);
            $tmax = $result1['nmax'];

            // memanggil nilai min
            $query2 = mysqli_query(koneksi(), "SELECT MIN(s.nilai_sub) AS nmin
                                        FROM tbl_subkriteria s
                                        INNER JOIN tbl_penilaian p ON s.id_sub = p.id_sub
                                        INNER JOIN tbl_alternatif a ON p.nip = a.nip
                                        WHERE p.tanggal = '$tanggal' AND s.id_kriteria = '" . $sub['id_kriteria'] . "'");
            $result2 = mysqli_fetch_array($query2);
            $tmin = $result2['nmin'];

            // menentukan kategori
            $kategori = $sub['kategori'];

            // membuat keputusan sesuai kategori
            if ($kategori == 'Benefit') {
              $val = $sub['sub'] / $tmax;
            } else {
              $val = $tmin / $sub['sub'];
            }

            $val = round($val, 2);

            // panggil nilai bobot
            $query4 = mysqli_query(koneksi(), "SELECT bobot FROM tbl_kriteria WHERE id_kriteria = '" . $sub['id_kriteria'] . "'");
            $result4 = mysqli_fetch_array($query4);
            $bobotval = $result4['bobot'];

            // perkalian bobot
            $valbobot = ($val * $bobotval);
            $nbobot = round($valbobot, 2);
            $vi += $valbobot;
            $nvi = round($vi, 2);
          }

          // Memasukkan hasil perengkingan ke dalam tabel tbl_rengking
          $peringkatQuery = "INSERT INTO tbl_rengking (nip, nama_alternatif, nilai) VALUES ('$nip', '$nama_alternatif', $nvi)";
          mysqli_query(koneksi(), $peringkatQuery);
        }
      }

      $rengkingQuery = query("SELECT r.*, a.nama_alternatif, p.tanggal
                    FROM tbl_rengking r
                    INNER JOIN tbl_alternatif a ON r.nip = a.nip
                    INNER JOIN tbl_penilaian p ON r.nip = p.nip
                    WHERE p.tanggal = '$tanggal'
                    GROUP BY a.nip
                    ORDER BY r.nilai DESC");
      ?>

      <!-- Bagian HTML -->

      <h2>Tabel Perengkingan</h2>

      <table>
        <tr>
          <th>NIP</th>
          <th>Nama Alternatif</th>
          <th>Tanggal</th>
          <th>Nilai</th>
          <th>NO</th>
        </tr>
        <?php $nama = ""; ?>
        <?php $rangking = 1; ?>
        <?php foreach ($rengkingQuery as $row) : ?>
          <?php if ($nama != $row['nama_alternatif']) : ?>
            <tr>
              <td><?php echo $row['nip']; ?></td>
              <td><?php echo $row['nama_alternatif']; ?></td>
              <td><?php echo $row['tanggal']; ?></td>
              <td><?php echo $row['nilai']; ?></td>
              <td><?= $rangking; ?></td>
            </tr>
          <?php endif; ?>
          <?php $nama = $row['nama_alternatif']; ?>
          <?php $rangking++; ?>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
  </main>

  <footer>
    <h4>rahmad hidayat</h4>
  </footer>
</body>

<script>
  $('#example').DataTable();
</script>

</html>