<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user'])) { header("location: login.php"); exit; }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Klinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">DASHBOARD ADMIN</a>
            <a href="dashboard.php" class="btn btn-light text-primary btn-sm fw-bold rounded-pill px-3">Kembali</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="fw-bold text-primary mb-0"><i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan Rekam Medis</h4>
            </div>
            <div class="card-body">
                
                <form method="GET" class="row g-3 align-items-end mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Dari Tanggal</label>
                        <input type="date" name="tgl_awal" class="form-control" required value="<?= isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Sampai Tanggal</label>
                        <input type="date" name="tgl_akhir" class="form-control" required value="<?= isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="bi bi-filter"></i> Tampilkan</button>
                    </div>
                    
                    <?php if(isset($_GET['tgl_awal'])) { ?>
                    <div class="col-md-3">
                        <a href="export_excel.php?tgl_awal=<?= $_GET['tgl_awal']; ?>&tgl_akhir=<?= $_GET['tgl_akhir']; ?>" class="btn btn-success w-100 fw-bold" target="_blank">
                            <i class="bi bi-file-earmark-excel-fill"></i> Download Excel
                        </a>
                    </div>
                    <?php } ?>
                </form>

                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No RM</th>
                                <th>Nama Pasien</th>
                                <th>Diagnosa</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($_GET['tgl_awal'])){
                                $tgl_awal = $_GET['tgl_awal'];
                                $tgl_akhir = $_GET['tgl_akhir'];

                                // Query data berdasarkan rentang tanggal
                                $query = "SELECT rm.*, p.nama_pasien, p.no_rekam_medis 
                                          FROM rekam_medis rm 
                                          JOIN pasien p ON rm.pasien_id = p.id 
                                          WHERE rm.tgl_periksa BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                          ORDER BY rm.tgl_periksa ASC";
                                
                                $data = mysqli_query($koneksi, $query);
                                $no = 1;

                                if(mysqli_num_rows($data) > 0){
                                    while($row = mysqli_fetch_array($data)){
                            ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['tgl_periksa'])); ?></td>
                                        <td><?= $row['no_rekam_medis']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td><?= $row['diagnosa']; ?></td>
                                        <td><?= $row['dokter_pemeriksa']; ?></td>
                                    </tr>
                            <?php 
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center text-danger fw-bold py-3'>Tidak ada data pada tanggal tersebut.</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center text-muted py-3'>Silakan pilih tanggal terlebih dahulu.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
</html>