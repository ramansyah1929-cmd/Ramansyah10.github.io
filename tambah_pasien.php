<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $rm = $_POST['no_rm'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];

    $simpan = mysqli_query($koneksi, "INSERT INTO pasien (no_rekam_medis, nama_pasien, jenis_kelamin, alamat) VALUES ('$rm', '$nama', '$jk', '$alamat')");

    if ($simpan) {
        header("location: dashboard.php");
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 500px;">
    <div class="card">
        <div class="card-header">Tambah Pasien Baru</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>No Rekam Medis</label>
                    <input type="text" name="no_rm" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jk" class="form-select">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>