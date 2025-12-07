<?php
include 'koneksi.php';

$id_booking = $_GET['id'];

// 1. Ambil data dari tabel booking
$data_booking = mysqli_query($koneksi, "SELECT * FROM booking WHERE id='$id_booking'");
$b = mysqli_fetch_array($data_booking);

if ($b) {
    $nama   = $b['nama_pemesan'];
    // --- PERBAIKAN DISINI ---
    // Sekarang kita ambil jenis kelamin dari data booking, bukan hardcode "L" lagi
    $jk     = $b['jenis_kelamin']; 
    
    $alamat = "Data dari Booking Online"; 
    $no_rm  = "RM" . date("ymdHis"); 

    // Pindahkan ke tabel PASIEN
    $insert_pasien = mysqli_query($koneksi, "INSERT INTO pasien (no_rekam_medis, nama_pasien, jenis_kelamin, alamat) VALUES ('$no_rm', '$nama', '$jk', '$alamat')");

    // Update status jadi Selesai
    mysqli_query($koneksi, "UPDATE booking SET status='Selesai' WHERE id='$id_booking'");

    if ($insert_pasien) {
        echo "<script>alert('Berhasil! Pasien terdaftar dengan No: $no_rm'); window.location='dashboard.php';</script>";
    }
}
?>