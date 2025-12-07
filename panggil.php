<?php
include 'koneksi.php';

$id = $_GET['id'];

// 1. Reset semua yang statusnya 'Dipanggil' menjadi 'Selesai' (Supaya di TV cuma muncul 1 orang)
mysqli_query($koneksi, "UPDATE booking SET status_panggil='Selesai' WHERE status_panggil='Dipanggil'");

// 2. Set status orang yang dipilih menjadi 'Dipanggil'
$update = mysqli_query($koneksi, "UPDATE booking SET status_panggil='Dipanggil' WHERE id='$id'");

if($update){
    // Kembali ke dashboard
    header("location: dashboard.php");
}
?>