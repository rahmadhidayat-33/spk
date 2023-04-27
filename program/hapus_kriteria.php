<?php

require_once '../function/functions.php';

$id = $_GET['id_kriteria'];

if (hapuskriteria($id) > 0) {
  echo "<script>
          alert ('Data Berhasil di Hapus');
          document.location.href = 'halaman_kriteria.php';
        </script>";
} else {
  echo "<script>
          alert ('Data Gagal di Hapus');
        </script>";
}
