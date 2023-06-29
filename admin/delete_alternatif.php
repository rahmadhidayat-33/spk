<?php
require_once '../asset/config/function.php';

$id = $_GET['nip'];
if (hapusalternatif($id) > 0) {
  echo "<script>
          alert('Data berhasil dihapus');
          window.location.href = 'read_alternatif.php';
          </script>";
} else {
  echo "<script>
          alert('Data Gagal di dihapus');
          </script>";
}
