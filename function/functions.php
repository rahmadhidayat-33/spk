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

// tambah data

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

function tambahsubkriteria($data)
{
    $conn = koneksi();

    $kodesubkriteria = htmlspecialchars($data['kode_subkriteria']);
    $nmsubkriteria = htmlspecialchars($data['nm_subkriteria']);
    $nilai = htmlspecialchars($data['nilai']);
    $idkriteria = htmlspecialchars($data['id_kriteria']);

    $query = "INSERT INTO 
                subkriteria
            VALUE
                (null, '$kodesubkriteria', '$nmsubkriteria', '$nilai', '$idkriteria')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function tambahalternatif($data)
{
    $conn = koneksi();
    $kodealternatif = htmlspecialchars($data['kode_alternatif']);
    $nmalternatif = htmlspecialchars($data['nm_alternatif']);


    $query = "INSERT INTO
                alternatif
            VALUE
                (null, '$kodealternatif', '$nmalternatif', '0', '0')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

// end tambah data

// auto number

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

function kodeautosubkriteria()
{
    $conn = koneksi();
    $auto = mysqli_query($conn, "SELECT max(kode_subkriteria) as max_code FROM subkriteria");
    $data = mysqli_fetch_array($auto);
    $code = $data['max_code'];
    $urutan = (int) substr($code, 1, 3);
    $urutan++;
    $huruf = "D";
    $kd_kat = $huruf . sprintf("%02s", $urutan);

    return $kd_kat;
}

function kodeautoalternatif()
{
    $conn = koneksi();
    $auto = mysqli_query($conn, "SELECT max(kode_alternatif) as max_code FROM alternatif");
    $data = mysqli_fetch_array($auto);
    $code = $data['max_code'];
    $urutan = (int) substr($code, 1, 3);
    $urutan++;
    $huruf = "A";
    $kd_kat = $huruf . sprintf("%01s", $urutan);

    return $kd_kat;
}

// end auto number

// hapus
function hapuskriteria($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function hapussubkriteria($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM subkriteria WHERE id_sub = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function hapusalternatif($id)
{
    $conn  = koneksi();
    mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

// end hapus

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

function ubahsubkriteria($data)
{
    $conn = koneksi();

    $id = $data['id_sub'];
    $kodesubkriteria = htmlspecialchars($data['kode_subkriteria']);
    $nmsubkriteria = htmlspecialchars($data['nm_subkriteria']);
    $nilai = htmlspecialchars($data['nilai']);
    $idkriteria = htmlspecialchars($data['id_kriteria']);

    $query = "UPDATE subkriteria SET 
                kode_subkriteria = '$kodesubkriteria',
                nm_subkriteria = '$nmsubkriteria',
                nilai = '$nilai',
                id_kriteria = '$idkriteria'
            WHERE id_sub = $id";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function ubahalternatif($data)
{
    $conn = koneksi();
    $id = $data['id_alternatif'];
    $kodealternatif = htmlspecialchars($data['kode_alternatif']);
    $nmalternatif = htmlspecialchars($data['nm_alternatif']);

    $query = "UPDATE alternatif SET
                kode_alternatif = '$kodealternatif',
                nm_alternatif = '$nmalternatif' 
            WHERE id_alternatif = $id";

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
