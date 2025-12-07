<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['user'])) { header("location: login.php"); exit; }

if (isset($_POST['simpan_rm'])) {
    $id_pasien = $_POST['id_pasien'];
    $dokter    = $_POST['dokter']; // Ambil data dokter
    $tgl       = $_POST['tgl'];
    $keluhan   = $_POST['keluhan'];
    $diagnosa  = $_POST['diagnosa'];
    $obat      = $_POST['obat'];

    // Query Simpan (Sekarang menyertakan dokter_pemeriksa)
    $query = "INSERT INTO rekam_medis (pasien_id, dokter_pemeriksa, tgl_periksa, keluhan, diagnosa, resep_obat) 
              VALUES ('$id_pasien', '$dokter', '$tgl', '$keluhan', '$diagnosa', '$obat')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rekam Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .main-container { margin-top: 100px; padding-bottom: 50px; }
        .card-form { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .form-label { font-weight: 600; color: #555; }
        .form-control, .form-select { padding: 10px; border-radius: 8px; border: 1px solid #ddd; }
        .form-control:focus { border-color: #0d6efd; box-shadow: 0 0 0 4px rgba(13,110,253,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">
                <i class="bi bi-hospital-fill"></i> DASHBOARD ADMIN
            </a>
            <a href="dashboard.php" class="btn btn-light text-primary btn-sm fw-bold rounded-pill px-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    <div class="container main-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-form">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h4 class="fw-bold text-primary mb-0"><i class="bi bi-clipboard-pulse"></i> Catat Pemeriksaan</h4>
                        <p class="text-muted small mb-0">Masukkan hasil diagnosa dokter</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST">
                            
                            <div class="mb-3">
                                <label class="form-label">Cari Pasien</label>
                                <select name="id_pasien" class="form-select select2" required>
                                    <option value="">-- Ketik Nama Pasien / No RM --</option>
                                    <?php
                                    $pasien = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id DESC");
                                    while ($p = mysqli_fetch_array($pasien)) {
                                        echo "<option value='$p[id]'>$p[no_rekam_medis] - $p[nama_pasien]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Dokter Pemeriksa</label>
                                <select name="dokter" class="form-select select2" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    <?php
                                    $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                                    while ($d = mysqli_fetch_array($dokter)) {
                                        echo "<option value='$d[nama_dokter]'>$d[nama_dokter] ($d[spesialis])</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Periksa</label>
                                    <input type="date" name="tgl" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Keluhan Pasien</label>
                                    <input type="text" name="keluhan" class="form-control" placeholder="Contoh: Demam tinggi..." required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Diagnosa</label>
                                <textarea name="diagnosa" class="form-control" rows="2" placeholder="Hasil diagnosa..." required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-danger">Resep Obat</label>
                                <textarea name="obat" class="form-control bg-light" rows="3" placeholder="Tulis resep..." required></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="simpan_rm" class="btn btn-primary fw-bold py-2">
                                    <i class="bi bi-save-fill me-2"></i> SIMPAN DATA
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // Mengaktifkan fitur pencarian di semua dropdown yang punya class 'select2'
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });
    </script>

</body>
</html>