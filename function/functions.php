<?php

function koneksi()
{
    return mysqli_connect("localhost", "root", "", "spk_jabatanguru");
}

function query($query)
{
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahkriteria($data)
{
    $conn = koneksi();

    $kodekriteria = htmlspecialchars($data['kode_kriteria']);
    $nmkriteria = htmlspecialchars($data['nm_kriteria']);
    $bobot = htmlspecialchars($data['bobot']);
    $pilihan = htmlspecialchars($data['pilihan']);

    $query = "INSERT INTO 
                kriteria
            VALUE 
                (null, '$kodekriteria', '$nmkriteria', '$bobot', '$pilihan')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function kodeautokriteria()
{
    $conn = koneksi();
    $auto = mysqli_query($conn, "SELECT max(kode_kriteria) as max_code FROM kriteria");
    $data = mysqli_fetch_array($auto);
    $code = $data['max_code'];
    $urutan = (int) substr($code, 1, 3);
    $urutan++;
    $huruf = "C";
    $kd_kat = $huruf . sprintf("%01s", $urutan);

    return $kd_kat;
}


function hapuskriteria($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function ubahkriteria($data)
{
    $conn = koneksi();

    $id = $data['id_kriteria'];
    $kodekriteria = htmlspecialchars($data['kode_kriteria']);
    $nmkriteria = htmlspecialchars($data['nm_kriteria']);
    $bobot = htmlspecialchars($data['bobot']);
    $pilihan = htmlspecialchars($data['pilihan']);

    $query = "UPDATE kriteria SET 
                kode_kriteria = '$kodekriteria',
                nm_kriteria = '$nmkriteria',
                bobot = $bobot,
                pilihan = '$pilihan'
            WHERE id_kriteria = $id";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $conn = koneksi();

    $query = "SELECT * FROM kriteria
                WHERE nm_kriteria LIKE '%$keyword%' ";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function login($data)
{
    $conn = koneksi();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    if (query("SELECT * FROM user WHERE username='$username' && password='$password'")) {
        // set session
        $_SESSION['login'] = true;
        header("Location: halaman_dashboard.php");
        exit;
    } else {
        return [
            'error' => true,
            'pesan' => 'username/password salah!'
        ];
    }
}
