<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: halaman_dashboard.php");
  exit;
}

require_once '../function/functions.php';

// ketika tombol login ditekan
if (isset($_POST['login'])) {
  $login = login($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>S.P.K | Login</title>
  <!-- style css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- icon -->
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
  <div class="container">
    <div class="login">
      <a href="../Halaman_utama.php">Home</a>
      <form action="" method="post" class="form-login">
        <h1>Sign In</h1>

        <!-- koding login -->
        <?php if (isset($login['error'])) : ?>
          <p><?= $login['pesan']; ?></p>
        <?php endif; ?>
        <!-- end koding login -->

        <ul>
          <li><input type="text" name="username" id="username" placeholder="Username" autofokus autocomplete="off" required></li>
          <li><input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required></li>
        </ul>
        <button type="submit" name="login">Login</button>
      </form>
    </div>
    <img src="../image/undraw_sign_in_re_o58h.svg" alt="">
  </div>
</body>

</html>