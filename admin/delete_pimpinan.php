<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../index.php");
  exit;
}
require_once '../asset/config/function.php';

$id = $_GET['id'];
if (hapuspimpinan($id) > 0) {
  echo "<script>
          alert('Data berhasil dihapus');
          window.location.href = 'pemimpin.php';
          </script>";
} else {
  echo "<script>
          alert('Data Gagal di dihapus');
          </script>";
}
