<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Status Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f4f8; }
        .hero-mini { background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%); padding: 100px 0 60px; color: white; text-align: center; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; }
        .search-box { margin-top: -40px; }
        .card-status { border: none; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: 0.3s; }
        .card-status:hover { transform: translateY(-5px); }
        .status-badge { font-size: 0.9rem; padding: 8px 15px; border-radius: 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-hospital-fill"></i> KLINIK MENDALO INDAH</a>
            <a href="index.php" class="btn btn-light text-primary btn-sm rounded-pill px-3 fw-bold">Home</a>
        </div>
    </nav>

    <div class="hero-mini">
        <div class="container">
            <h1 class="fw-bold">Cek Antrian Anda</h1>
            <p class="opacity-75">Masukkan nomor WhatsApp yang Anda gunakan saat mendaftar</p>
        </div>
    </div>

    <div class="container search-box">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow p-4 rounded-4 bg-white">
                    <form method="GET">
                        <div class="input-group input-group-lg">
                            <input type="text" name="hp" class="form-control border-primary" placeholder="Contoh: 08123456789" required value="<?= isset($_GET['hp']) ? $_GET['hp'] : '' ?>">
                            <button class="btn btn-warning fw-bold px-4" type="submit">CARI</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <?php
                if (isset($_GET['hp'])) {
                    $hp = $_GET['hp'];
                    // Cari data berdasarkan No HP
                    $query = mysqli_query($koneksi, "SELECT * FROM booking WHERE no_hp LIKE '%$hp%' ORDER BY created_at DESC");
                    
                    if (mysqli_num_rows($query) > 0) {
                        echo "<h5 class='mb-4 text-center text-muted'>Ditemukan " . mysqli_num_rows($query) . " riwayat booking:</h5>";
                        
                        while ($d = mysqli_fetch_array($query)) {
                            // Tentukan warna status
                            $badge_color = ($d['status'] == 'Pending') ? 'bg-warning text-dark' : 'bg-success text-white';
                            $status_text = ($d['status'] == 'Pending') ? '⏳ Menunggu Antrian' : '✅ Selesai / Diterima';
                ?>
                    
                    <div class="card card-status mb-3">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    <small class="text-muted d-block">Nomor Antrian</small>
                                    <h1 class="fw-bold text-primary m-0"><?= $d['no_antrian'] ? $d['no_antrian'] : '-'; ?></h1>
                                </div>
                                <div class="col-md-6 mb-3 mb-md-0 border-start border-end ps-md-4">
                                    <h5 class="fw-bold mb-1"><?= $d['nama_pemesan']; ?></h5>
                                    <p class="text-muted mb-1"><i class="bi bi-calendar-event me-2"></i> <?= date('d F Y', strtotime($d['tanggal_kunjungan'])); ?></p>
                                    <p class="text-muted mb-0"><i class="bi bi-whatsapp me-2"></i> <?= $d['no_hp']; ?></p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <span class="badge status-badge <?= $badge_color; ?> mb-2"><?= $status_text; ?></span>
                                    <br>
                                    <small class="text-muted">Keluhan: <?= $d['keluhan']; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php 
                        } 
                    } else {
                        echo "<div class='alert alert-danger text-center rounded-4 p-4'>
                                <i class='bi bi-emoji-frown fs-1 d-block mb-2'></i>
                                <strong>Data tidak ditemukan!</strong><br>
                                Pastikan nomor WhatsApp yang Anda masukkan benar.
                              </div>";
                    }
                }
                ?>

            </div>
        </div>
    </div>

</body>
</html>