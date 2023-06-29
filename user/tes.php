<?php
require_once '../asset/config/function.php';

// Mengeksekusi query untuk menampilkan data
$sql = "SELECT DISTINCT tanggal, nip, id_kriteria, id_sub FROM tbl_penilaian";
$result = koneksi()->query($sql);

if ($result->num_rows > 0) {
  // Menampilkan data per baris
  while ($row = $result->fetch_assoc()) {
    $tanggal = $row["tanggal"];
    $alternatif = $row["nip"];
    $kriteria = $row["id_kriteria"];
    $subkriteria = $row["id_sub"];

    // Tampilkan data sesuai format yang diinginkan
    echo "Tanggal: " . $tanggal . "<br>";
    echo "Nama Alternatif: " . $alternatif . "<br>";
    echo "Kriteria: " . $kriteria . "<br>";
    echo "Subkriteria: " . $subkriteria . "<br>";
    echo "<br>";
  }
} else {
  echo "Tidak ada data yang ditemukan.";
}

// Menutup koneksi
$conn->close();
