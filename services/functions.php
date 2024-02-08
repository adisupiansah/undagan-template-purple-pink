<?php 
$koneksi = mysqli_connect("localhost", "root", "", "pernikahan_dian&nur");

function koneksi($query) {
    global $koneksi;

    $simpan = mysqli_query($koneksi, $query);
    $dataKosong = [];
    while ($db = mysqli_fetch_assoc($simpan) ) {
        $dataKosong []= $db;
    }
    return $dataKosong;
}

function inputKomentar($komentar) {
    global $koneksi;

    $nama = htmlspecialchars($komentar['nama']);
    $ucapan = htmlspecialchars($komentar['ucapan']);
    $status = htmlspecialchars($komentar['status']);

    $dataTamu = "INSERT INTO komentar (nama, ucapan, status) VALUES ('$nama', '$ucapan', '$status')";

    mysqli_query($koneksi, $dataTamu);
}



?>