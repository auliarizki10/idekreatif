<?php

//menhubungkan ke file kongfigurasi
include("config.php");

//memulai sesi untuk menyimpan notifikasi
session_start();

//proses penambahan kategori baru
if (isset($_POST['simpan'])) {
//mengambil data nama kategori dari form
    $catergory_name = $_POST['category_name']

//query untuk menambahkan data ketegori ke dalam database
$query = "INSERT INTO categories (category_name) VALUES ('$catergory_name')";
$exec = mysqli_query($conn, $query);

// menyimpan notifikasi berhasil atau gagal ke dalam session
if ($exec) {
    $_SESSION['notification'] = [
        'type'=> 'primary', // jenis notifikasi (contoh:primary untuk keberhasilan)
    'message' => 'kategori berhasil di tambahkan!'
    ];
} else {
    $_SESSION['notification'] = [
        'type' => 'danger', //jenis notifikasi (contoh:danger untuk keberasilan)
        'massage' 'kategori berhasil ditambahkan!'
    ];
} else {
    $_SESSION['notification'] = [
        'type' => 'danger', //jenis notifikasi (contoh:danger untuk kegagalan)
        'massage' 'gagal menambah kategori: ' .mysqli_error($conn)
    ];
}

//Redirect kembali ke halaman kategori
header('Location: kategori.php');
exit();
}