<?php
session_start();
include 'koneksi.php';

// Cek Login
if (!isset($_SESSION['user'])) { header("location: login.php"); exit; }

// Hitung Statistik
$total_pasien = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pasien"));
$total_dokter = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM dokter"));
$total_booking = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM booking WHERE status='Pending'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-custom { background: linear-gradient(to right, #004d99, #007bff); }
        .card-stat { border: none; border-radius: 15px; color: white; transition: 0.3s; position: relative; overflow: hidden; }
        .card-stat:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .icon-bg { position: absolute; right: 15px; bottom: 10px; font-size: 4rem; opacity: 0.2; }
        .btn-quick { border-radius: 12px; padding: 15px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .btn-quick:hover { transform: scale(1.02); }
        .card-table { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="bi bi-hospital-fill me-2"></i> KLINIK ADMIN</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3 d-none d-md-block">Halo, <b><?= $_SESSION['user']; ?></b></span>
            <a href="logout.php" class="btn btn-light text-primary btn-sm rounded-pill fw-bold px-3">Logout</a>
        </div>
    </div>
</nav>

<div class="container pb-5">

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card card-stat bg-primary p-3 shadow-sm h-100">
                <div><h6 class="mb-0 opacity-75">Total Pasien</h6><h2 class="fw-bold mb-0"><?= $total_pasien; ?></h2></div>
                <i class="bi bi-people-fill icon-bg"></i>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-stat bg-success p-3 shadow-sm h-100">
                <div><h6 class="mb-0 opacity-75">Dokter</h6><h2 class="fw-bold mb-0"><?= $total_dokter; ?></h2></div>
                <i class="bi bi-person-badge-fill icon-bg"></i>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-stat bg-warning text-dark p-3 shadow-sm h-100">
                <div><h6 class="mb-0 opacity-75">Booking</h6><h2 class="fw-bold mb-0"><?= $total_booking; ?></h2></div>
                <i class="bi bi-bell-fill icon-bg text-dark"></i>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-2"><a href="admin_dokter.php" class="btn btn-light w-100 btn-quick text-primary d-flex flex-column align-items-center"><i class="bi bi-person-lines-fill fs-3"></i>Dokter</a></div>
        <div class="col-md-3 col-6 mb-2"><a href="tambah_pasien.php" class="btn btn-light w-100 btn-quick text-success d-flex flex-column align-items-center"><i class="bi bi-person-plus-fill fs-3"></i>Pasien Baru</a></div>
        <div class="col-md-3 col-6 mb-2"><a href="tambah_rekam_medis.php" class="btn btn-light w-100 btn-quick text-danger d-flex flex-column align-items-center"><i class="bi bi-clipboard2-pulse-fill fs-3"></i>Periksa</a></div>
        <div class="col-md-3 col-6 mb-2"><a href="index.php" target="_blank" class="btn btn-light w-100 btn-quick text-info d-flex flex-column align-items-center"><i class="bi bi-phone fs-3"></i>Halaman Web</a></div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <a href="laporan.php" class="btn btn-outline-primary w-100 fw-bold p-3 rounded-3 shadow-sm" style="border-width: 2px;">
                <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> BUKA LAPORAN REKAM MEDIS & EXPORT EXCEL
            </a>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-5 mb-4">
            <div class="card card-table h-100 bg-white">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between">
                    <h5 class="fw-bold text-dark">📅 Booking Masuk</h5>
                    <span class="badge bg-warning text-dark">Pending</span>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr><th class="ps-4">Nama</th><th>Aksi</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $booking = mysqli_query($koneksi, "SELECT * FROM booking WHERE status='Pending' ORDER BY created_at DESC LIMIT 5");
                                if(mysqli_num_rows($booking) == 0) { echo "<tr><td colspan='2' class='text-center text-muted py-3'>Kosong</td></tr>"; }
                                while($b = mysqli_fetch_array($booking)){
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold"><?= $b['nama_pemesan']; ?></div>
                                        <small class="text-muted"><?= $b['no_antrian']; ?></small><br>
                                        <small class="text-muted"><?= $b['tanggal_kunjungan']; ?></small>
                                    </td>
                                    <td>
                                        <a href="panggil.php?id=<?= $b['id']; ?>" class="btn btn-primary btn-sm rounded-circle me-1" title="Panggil Pasien">
                                            <i class="bi bi-megaphone-fill"></i>
                                        </a>

                                        <a href="terima_booking.php?id=<?= $b['id']; ?>" class="btn btn-success btn-sm rounded-circle me-1" onclick="return confirm('Proses jadi pasien?')">
                                            <i class="bi bi-check-lg"></i>
                                        </a>
                                        
                                        <a href="hapus_booking.php?id=<?= $b['id']; ?>" class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Hapus?')">
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

        <div class="col-lg-7 mb-4">
            <div class="card card-table h-100 bg-white">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold text-dark mb-0">🏥 Data Pasien</h5>
                    </div>
                    
                    <form method="GET" class="d-flex">
                        <input type="text" name="cari" class="form-control form-control-sm me-2" placeholder="Cari nama / No RM..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button>
                        <?php if(isset($_GET['cari'])) { ?>
                            <a href="dashboard.php" class="btn btn-secondary btn-sm ms-1">Reset</a>
                        <?php } ?>
                    </form>
                    </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr><th class="ps-4">No RM</th><th>Nama</th><th>Aksi</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                // LOGIKA PENCARIAN
                                if(isset($_GET['cari'])){
                                    $cari = $_GET['cari'];
                                    $query = "SELECT p.*, rm.id as id_rm FROM pasien p 
                                              LEFT JOIN (SELECT * FROM rekam_medis WHERE id IN (SELECT MAX(id) FROM rekam_medis GROUP BY pasien_id)) rm 
                                              ON p.id = rm.pasien_id 
                                              WHERE p.nama_pasien LIKE '%$cari%' OR p.no_rekam_medis LIKE '%$cari%'
                                              ORDER BY p.id DESC";
                                } else {
                                    $query = "SELECT p.*, rm.id as id_rm FROM pasien p 
                                              LEFT JOIN (SELECT * FROM rekam_medis WHERE id IN (SELECT MAX(id) FROM rekam_medis GROUP BY pasien_id)) rm 
                                              ON p.id = rm.pasien_id ORDER BY p.id DESC LIMIT 5";
                                }
                                
                                $data = mysqli_query($koneksi, $query);
                                while($row = mysqli_fetch_array($data)){
                                ?>
                                <tr>
                                    <td class="ps-4"><span class="badge bg-light text-dark border"><?= $row['no_rekam_medis']; ?></span></td>
                                    <td class="fw-bold"><?= $row['nama_pasien']; ?></td>
                                    <td>
                                        <a href="edit_pasien.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm rounded-circle" title="Edit Data"><i class="bi bi-pencil-fill text-dark"></i></a>
                                        
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-outline-danger btn-sm rounded-circle" onclick="return confirm('Hapus?')" title="Hapus"><i class="bi bi-trash"></i></a>
                                        
                                        <?php if($row['id_rm']) { ?>
                                            <a href="cetak_nota.php?id=<?= $row['id_rm']; ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle" title="Cetak"><i class="bi bi-printer"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>