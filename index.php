<?php
session_start();

if (isset($_SESSION["login"])) {
  if ($_SESSION["level"] === "admin") {
    header("location: admin/dashboard_admin.php");
    exit;
  } else {
    header("location: user/dashboard_user.php");
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

      if (isset($_POST['role'])) {
        $role = $_POST['role'];
        if ($role == 'admin' && $row["level"] === "admin") {
          header("Location: admin/dashboard_admin.php");
          exit;
        } elseif ($role == 'user' && $row["level"] === "user") {
          header("Location: user/dashboard_user.php");
          exit;
        } else {
          // Cek apakah sudah ada session error_count, jika tidak maka inisialisasi dengan nilai 1
          if (!isset($_SESSION["error_count"])) {
            $_SESSION["error_count"] = 1;
          } else {
            // Jika sudah ada, increment nilai error_count
            $_SESSION["error_count"]++;
          }

          $error = "Pilihan Anda tidak valid. Silakan pilih dengan benar."; // Pesan kesalahan jika pilihan tidak sesuai
        }
      } else {
        $error = "Silakan pilih opsi Login as Admin atau Login as User."; // Pesan kesalahan jika tidak memilih opsi
      }
    } else {
      $error = "Username atau password salah.";
    }
  } else {
    $error = "Username atau password salah.";
  }

  // Cek apakah error_count lebih dari 2, jika iya maka set session login ke false
  if (isset($_SESSION["error_count"]) && $_SESSION["error_count"] > 2) {
    $_SESSION["login"] = false;
    $error = "Anda telah melakukan kesalahan melebihi batas. Silakan coba lagi nanti.";
  }
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
            <p class="error"><?php echo $error; ?></p> <!-- Menampilkan pesan kesalahan -->
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
              <div class="pilih">
                  <label>
                    <input type="radio" name="role" value="admin"> Admin
                  </label>
                  <label>
                    <input type="radio" name="role" value="user"> Guru
                  </label>
              </div>
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
