<?php
session_start();

if (isset($_SESSION["login"])) {
  if ($_SESSION["level"] === "admin") {
    header("location: admin.php");
    exit;
  } else {
    header("location: user.php");
    exit;
  }
}
require_once 'asset/config/function.php';

if (isset($_POST['login'])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query(koneksi(), "SELECT * FROM tbl_akun WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($password == $row["password"]) {
      // set session 
      $_SESSION["login"] = true;
      $_SESSION["username"] = $row["username"];
      $_SESSION["level"] = $row["level"];
      $_SESSION["nama_lengkap"] = $row["nama_lengkap"]; // Tambahkan ini untuk menyimpan nama lengkap

      if ($row["level"] === "admin") {
        header("Location: admin/dashboard_admin.php");
        exit;
      } else {
        header("Location: user/dashboard_user.php");
        exit;
      }
    }
  }

  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pendukung Keputusan</title>
  <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
  <main>
    <div class="container-login">
      <h1>Welcome</h1>

      <div class="container-form">
        <div class="form-login">
          <?php if (isset($error)) : ?>
            <p>Username atau password salah</p>
          <?php endif; ?>
          <form action="" method="post">
            <ul>
              <li>
                <label>
                  <input type="text" name="username" placeholder="Username" required autocomplete="off" autofocus>
                </label>
              </li>
              <li>
                <label>
                  <input type="password" name="password" placeholder="Password">
                </label>
              </li>
              <li>
                <button type="submit" name="login">Login</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </main>


</body>

</html>