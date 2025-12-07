<?php
session_start();
include 'koneksi.php';

// Cek Login
if (!isset($_SESSION['user'])) { header("location: login.php"); exit; }

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data dokter berdasarkan ID
$data = mysqli_query($koneksi, "SELECT * FROM dokter WHERE id='$id'");
$d = mysqli_fetch_array($data);

// PROSES UPDATE
if (isset($_POST['update'])) {
    $nama      = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $hari      = $_POST['hari'];
    $jam       = $_POST['jam'];
    $ruangan   = $_POST['ruangan'];
    $foto_lama = $_POST['foto_lama'];

    // Cek apakah user mengganti foto?
    if ($_FILES['foto']['name'] != "") {
        // Jika upload foto baru
        $foto_nama = $_FILES['foto']['name'];
        $foto_tmp  = $_FILES['foto']['tmp_name'];
        $nama_file_baru = time() . '_' . $foto_nama;
        move_uploaded_file($foto_tmp, "assets/img/dokter/" . $nama_file_baru);
        
        // Update query DENGAN foto baru
        $query = "UPDATE dokter SET nama_dokter='$nama', spesialis='$spesialis', hari_praktek='$hari', jam_praktek='$jam', ruangan='$ruangan', foto='$nama_file_baru' WHERE id='$id'";
    } else {
        // Jika TIDAK upload foto (pakai foto lama)
        $query = "UPDATE dokter SET nama_dokter='$nama', spesialis='$spesialis', hari_praktek='$hari', jam_praktek='$jam', ruangan='$ruangan' WHERE id='$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data dokter berhasil diupdate!'); window.location='admin_dokter.php';</script>";
    } else {
        echo "<script>alert('Gagal update!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark fw-bold">
            ✏️ Edit Dokter: <?= $d['nama_dokter']; ?>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="foto_lama" value="<?= $d['foto']; ?>">

                <div class="mb-3">
                    <label>Nama Dokter</label>
                    <input type="text" name="nama" class="form-control" value="<?= $d['nama_dokter']; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label>Spesialis</label>
                    <input type="text" name="spesialis" class="form-control" value="<?= $d['spesialis']; ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Hari Praktek</label>
                        <input type="text" name="hari" class="form-control" value="<?= $d['hari_praktek']; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jam Praktek</label>
                        <input type="text" name="jam" class="form-control" value="<?= $d['jam_praktek']; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" value="<?= $d['ruangan']; ?>">
                </div>

                <div class="mb-3 text-center">
                    <label class="d-block mb-2 text-muted">Foto Saat Ini:</label>
                    <?php if($d['foto']) { ?>
                        <img src="assets/img/dokter/<?= $d['foto']; ?>" width="100" class="rounded-circle border">
                    <?php } else { echo "<span class='text-danger'>Belum ada foto</span>"; } ?>
                </div>

                <div class="mb-4">
                    <label class="fw-bold">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control" accept=".jpg, .jpeg, .png">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="update" class="btn btn-primary w-100 fw-bold">Simpan Perubahan</button>
                    <a href="admin_dokter.php" class="btn btn-secondary w-100">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>