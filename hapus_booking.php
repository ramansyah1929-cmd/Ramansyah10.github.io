<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data dari tabel booking
$hapus = mysqli_query($koneksi, "DELETE FROM booking WHERE id='$id'");

// Kembali ke dashboard
if($hapus){
    header("location: dashboard.php");
}
?>