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
    
    $kodekriteria =htmlspecialchars($data['kode_kriteria']) ;
    $nmkriteria = htmlspecialchars($data['nm_kriteria']);
    $bobot = htmlspecialchars($data['bobot']);
    $pilihan = htmlspecialchars($data['pilihan']);

    $query="INSERT INTO 
                kriteria
            VALUE 
                (null, '$kodekriteria', '$nmkriteria', '$bobot', '$pilihan')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
