<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $ruangan = $_POST['ruangan'];

    // --- LOGIKA UPLOAD FOTO ---
    $foto_nama = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    
    // Cek apakah user upload foto?
    if($foto_nama != "") {
        // Beri nama unik agar tidak bentrok (misal: 170023_drbudi.jpg)
        $nama_file_baru = time() . '_' . $foto_nama;
        $folder_tujuan = "assets/img/dokter/" . $nama_file_baru;
        
        // Pindahkan file ke folder tujuan
        move_uploaded_file($foto_tmp, $folder_tujuan);
    } else {
        $nama_file_baru = ""; // Kosong jika tidak upload
    }

    // Simpan ke Database
    $query = "INSERT INTO dokter (nama_dokter, spesialis, hari_praktek, jam_praktek, ruangan, foto) 
              VALUES ('$nama', '$spesialis', '$hari', '$jam', '$ruangan', '$nama_file_baru')";
    
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>alert('Berhasil menambah dokter!'); window.location='admin_dokter.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-success text-white">Form Dokter Baru</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label>Nama Dokter (beserta gelar)</label>
                    <input type="text" name="nama" class="form-control" placeholder="Contoh: dr. Budi Santoso, Sp.A" required>
                </div>
                
                <div class="mb-3">
                    <label>Spesialis</label>
                    <input type="text" name="spesialis" class="form-control" placeholder="Contoh: Spesialis Anak" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Hari Praktek</label>
                        <input type="text" name="hari" class="form-control" placeholder="Senin - Rabu">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jam Praktek</label>
                        <input type="text" name="jam" class="form-control" placeholder="08:00 - 12:00">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" placeholder="Lantai 2, Poli Anak">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Upload Foto Dokter</label>
                    <input type="file" name="foto" class="form-control" accept=".jpg, .jpeg, .png">
                    <small class="text-muted">Format: JPG/PNG. Maksimal 2MB.</small>
                </div>

                <button type="submit" name="simpan" class="btn btn-success w-100">Simpan Data</button>
                <a href="admin_dokter.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>