<?php

function koneksi()
{
  return mysqli_connect("localhost", "root", "", "spk_jabatanguru");
}

function query($query)
{
  $conn = koneksi();

  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

  $rows = [];
  while ($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
  }

  return $rows;
}

// function tambah
function tambahalternatif($data)
{
  $conn = koneksi();
  $nip = htmlspecialchars($data['nip']);
  $nama = htmlspecialchars($data['nama_alternatif']);
  $jk = htmlspecialchars($data['jenis_kelamin']);
  $gol = htmlspecialchars($data['gol']);
  $program = htmlspecialchars($data['program_studi']);
  $jabatan = htmlspecialchars($data['jabatan']);

  // Periksa apakah NIP sudah ada
  $query_check_nip = query("SELECT COUNT(*) AS total FROM tbl_alternatif WHERE nip = '$nip'");
  $result_check_nip = $query_check_nip[0]['total'];

  if ($result_check_nip > 0) {
    return 0; // NIP sudah ada, kembalikan nilai 0 untuk menandakan gagal menambahkan data
  } else {
    $query = "INSERT INTO tbl_alternatif VALUES ('$nip', '$nama', '$jk', '$gol', '$program', '$jabatan')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
  }
}

function tambahpenilaian($data)
{
  $conn = koneksi();
  $nip = htmlspecialchars($data['nip']);
  $tanggal = $data['tanggal'];

  // Melakukan pengecekan terhadap nip dan tanggal sebelum melakukan penambahan data
  $query_check_nip_tanggal = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_penilaian WHERE nip = '$nip' AND tanggal = '$tanggal'");
  $result_check_nip_tanggal = mysqli_fetch_assoc($query_check_nip_tanggal)['total'];

  if ($result_check_nip_tanggal > 0) {
    // Notifikasi jika data sudah ada
    echo "<script>alert('Data dengan NIP dan tanggal yang sama sudah ada.');</script>";
    return;
  }

  $queryKriteria = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
  while ($rowKriteria = mysqli_fetch_array($queryKriteria)) {
    $idk = $rowKriteria['id_kriteria'];

    // Check if the subcriteria value exists in the $data array
    if (isset($data[$idk])) {
      $ids = $data[$idk];

      $query = "INSERT INTO tbl_penilaian(nip, tanggal, id_kriteria, id_sub) VALUES ('$nip', '$tanggal', '$idk', '$ids')";
      mysqli_query($conn, $query) or die(mysqli_error($conn));
    }
  }

  $affectedRows = mysqli_affected_rows($conn);
  if ($affectedRows > 0) {
    // Notifikasi jika berhasil disimpan
    echo "<script>
          alert('Data berhasil disimpan.');
          window.location.href = 'read_penilaian.php';
          </script>";
  } else {
    // Notifikasi jika gagal disimpan
    echo "<script>alert('Data gagal disimpan.');</script>";
  }
}


// function hapus

function hapusalternatif($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM tbl_alternatif WHERE nip=$id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function hapuspenilaian($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM tbl_penilaian WHERE nip=$id ") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

// function ubah

function ubahalternatif($data)
{
  $conn = koneksi();
  $nip = htmlspecialchars($data['nip']);
  $nama = htmlspecialchars($data['nama_alternatif']);
  $jk = htmlspecialchars($data['jenis_kelamin']);
  $gol = htmlspecialchars($data['gol']);
  $program = htmlspecialchars($data['program_studi']);
  $jabatan = htmlspecialchars($data['jabatan']);

  $query = "UPDATE tbl_alternatif SET 
            nama_alternatif = '$nama',
            jenis_kelamin = '$jk',
            gol = '$gol',
            program_studi = '$program',
            jabatan = '$jabatan'
            WHERE nip = $nip";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubahpenilaian($data)
{
  $conn = koneksi();
  $nip = htmlspecialchars($data['nip']);
  $tanggal = $data['tanggal'];

  $query1 = "DELETE FROM tbl_penilaian WHERE nip = '$nip'";
  $result = mysqli_query($conn, $query1);

  $hasil = mysqli_query(koneksi(), "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
  while ($baris = mysqli_fetch_array($hasil)) {
    $idk = $baris['id_kriteria'];
    $ids = $_POST["$idk"];
    $query = "INSERT INTO tbl_penilaian(nip, tanggal, id_kriteria, id_sub) VALUES ('$nip','$tanggal', '$idk', '$ids')";
    $result = mysqli_query(koneksi(), $query);
  }
  $affectedRows = mysqli_affected_rows($conn);
  if ($affectedRows > 0) {
    // Notifikasi jika berhasil disimpan
    echo "<script>
          alert('Data berhasil diubah.');
          window.location.href = 'read_penilaian.php';
          </script>";
  } else {
    // Notifikasi jika gagal disimpan
    echo "<script>alert('Data gagal diubah.');</script>";
  }
}
