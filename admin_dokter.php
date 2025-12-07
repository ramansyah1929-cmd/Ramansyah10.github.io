<?php
session_start();
include 'koneksi.php';
// Cek Login
if (!isset($_SESSION['user'])) { header("location: login.php"); exit; }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Data Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: sans-serif; }
        .card-table { border: none; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .foto-sm { width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 2px solid #eee; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">
            <i class="bi bi-hospital-fill me-2"></i> DASHBOARD ADMIN
        </a>
        <a href="dashboard.php" class="btn btn-light text-primary btn-sm fw-bold rounded-pill px-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</nav>

<div class="container">
    <div class="card card-table">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-person-lines-fill text-primary"></i> Data Dokter & Jadwal</h5>
            <a href="tambah_dokter.php" class="btn btn-success btn-sm rounded-pill fw-bold">
                <i class="bi bi-plus-lg"></i> Tambah Dokter
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Foto</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>Jadwal Praktek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM dokter");
                        
                        // Cek jika data kosong
                        if(mysqli_num_rows($query) == 0) {
                            echo "<tr><td colspan='5' class='text-center text-muted py-4'>Belum ada data dokter.</td></tr>";
                        }

                        while($row = mysqli_fetch_array($query)){
                            // Logika Foto: Cek apakah ada file foto atau pakai default
                            $path_foto = "assets/img/dokter/" . $row['foto'];
                            if ($row['foto'] != "" && file_exists($path_foto)) {
                                $foto_tampil = $path_foto;
                            } else {
                                $foto_tampil = "https://cdn-icons-png.flaticon.com/512/3774/3774299.png"; // Gambar Default
                            }
                        ?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= $foto_tampil; ?>" class="foto-sm">
                            </td>
                            <td class="fw-bold"><?= $row['nama_dokter']; ?></td>
                            <td><span class="badge bg-info text-dark"><?= $row['spesialis']; ?></span></td>
                            <td>
                                <div><?= $row['hari_praktek']; ?></div>
                                <small class="text-danger fw-bold"><?= $row['jam_praktek']; ?></small>
                                <div class="text-muted small">Ruang: <?= $row['ruangan']; ?></div>
                            </td>
                            <td>
                                <a href="edit_dokter.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm rounded-circle" title="Edit Data">
                                    <i class="bi bi-pencil-fill text-dark"></i>
                                </a>

                                <a href="hapus_dokter.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm rounded-circle ms-1" onclick="return confirm('Yakin ingin menghapus dokter ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>