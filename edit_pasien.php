<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user'])) { header("location: login.php"); exit; }

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id='$id'");
$p = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama   = $_POST['nama'];
    $jk     = $_POST['jk'];
    $alamat = $_POST['alamat'];

    // Update data (Kecuali No RM, karena No RM tidak boleh berubah)
    $update = mysqli_query($koneksi, "UPDATE pasien SET nama_pasien='$nama', jenis_kelamin='$jk', alamat='$alamat' WHERE id='$id'");
    
    if($update){
        echo "<script>alert('Data berhasil diperbaiki!'); window.location='dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark fw-bold">
                ✏️ Edit Data Pasien: <?= $p['no_rekam_medis']; ?>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama" class="form-control" value="<?= $p['nama_pasien']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-select">
                            <option value="L" <?= ($p['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="P" <?= ($p['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3"><?= $p['alamat']; ?></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" name="update" class="btn btn-primary w-100">Simpan Perubahan</button>
                        <a href="dashboard.php" class="btn btn-secondary w-100">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>