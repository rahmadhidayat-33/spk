<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="sidebar">
    <div class="logo"><h1>S.P.K</h1></div>
    <div class="menu">
      <ul>
        <li><a href="halaman_dashboard.php"><i class="fi fi-rr-dashboard"></i><span>Dashboard</span></a></li>
        <li><a href="halaman_kriteria.php"><i class="fi fi-rr-box"></i><span>Data Kriteria</span> </a></li>
        <li><a href="halaman_subkriteria.php"><i class="fi fi-rr-boxes"></i><span>Data Sub Kriteria</span></a></li>
        <li><a href="halaman_alternatif.php"><i class="fi fi-rr-users"></i><span>Data Alternatif</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rs-edit"></i><span>Data Penilaian</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rr-calculator"></i><span>Data Perhitungan</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rr-chart-simple"></i><span>Data Hasil Akhir</span></a></li>
        <li><a href="halaman_penilaian.php"><i class="fi fi-rr-user-add"></i><span>Data User</span></a></li>
      </ul>
    </div>
  </div>

  <header>
    <div class="navigasi">
      <div class="dropdown">
        <button class="dropbtn"> 
          <img src="image/undraw_male_avatar_g98d.svg" alt=""> 
          <span>Rahmad Hidayat</span> 
        </button>
        <div class="dropdown-content">
          <a href="#">Profile</a>
          <a href="#">Log Out</a>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="head">
        <div class="judul">
          <h1>Dashboard</h1>
          <h4>Selamat Datang Admin</h4>
        </div>
        <img src="image/undraw_dashboard_re_3b76.svg" alt="">
      </div>
      
      <div class="conten2">
        <div class="kotak">
          <div class="kriteria">
            <img src="image/undraw_order_delivered_re_v4ab.svg" alt="">
            <div class="banyak">
              <h3>kriteria</h3>
              <h3 class="angka">10</h3>
            </div>
          </div>
        </div>

        <div class="kotak">
          <div class="subkriteria">
            <img src="image/undraw_collecting_re_lp6p.svg" alt="">
            <div class="banyak">
              <h3>sub kriteria</h3>
              <h3 class="angka">10</h3>
            </div>
          </div>
        </div>

        <div class="kotak">
          <div class="alternatif">
            <img src="image/undraw_meet_the_team_re_4h08.svg" alt="">
            <div class="banyak">
              <h3>Alternatif</h3>
              <h3 class="angka">10</h3>
            </div>
          </div>
        </div>

        <div class="kotak">
          <div class="users">
            <img src="image/undraw_people_re_8spw.svg" alt="">
            <div class="banyak">
              <h3>Users</h3>
              <h3 class="angka">10</h3>
            </div>
          </div>
        </div>

      </div>  
    </div>
  </header>

  <footer>
      <h4>copyright | Rahmad Hidayat</h4>
  </footer>
</body>
</html>