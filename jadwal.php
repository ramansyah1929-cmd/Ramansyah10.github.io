<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter - Klinik Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }
        
        /* Navbar (Konsisten dengan Home) */
        .navbar { background: white; box-shadow: 0 2px 15px rgba(0,0,0,0.05); }
        .nav-link { font-weight: 500; color: #555 !important; }
        .nav-link:hover { color: #0d6efd !important; }
        .nav-link.active { color: #0d6efd !important; font-weight: 700; }

        /* Header Page */
        .page-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            color: white;
            padding: 60px 0 40px;
            margin-bottom: 50px;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
        }

        /* Card Dokter */
        .card-dokter {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: 0.3s;
            overflow: hidden;
            position: relative;
        }
        .card-dokter:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        .top-bg {
            height: 80px;
            background: #e7f1ff;
        }
        .foto-wrapper {
            margin-top: -50px;
            text-align: center;
        }
        .foto-dokter {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .spesialis-badge {
            background-color: #0d6efd;
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        /* Info Jadwal */
        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 8px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }
        .info-icon {
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            margin-right: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="index.php">
                <i class="bi bi-hospital-fill"></i> KLINIK MENDALO INDAH
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link mx-2" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link mx-2 active" href="jadwal.php">Jadwal Dokter</a></li>
                    <li class="nav-item">
                        <a class="btn btn-warning rounded-pill px-4 ms-3 fw-bold text-dark" href="booking.php">Daftar Online</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-header text-center pt-5 mt-5">
        <div class="container">
            <h1 class="fw-bold mb-2">Jadwal Praktik Dokter</h1>
            <p class="opacity-75">Temukan dokter spesialis terbaik kami yang siap melayani Anda</p>
        </div>
    </section>

    <div class="container pb-5">
        <div class="row g-4">
            
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM dokter");
            while($d = mysqli_fetch_array($query)){
                // Logika Foto
                $path_foto = "assets/img/dokter/" . $d['foto'];
                $foto = (!empty($d['foto']) && file_exists($path_foto)) ? $path_foto : "https://cdn-icons-png.flaticon.com/512/3774/3774299.png";
            ?>

            <div class="col-md-6 col-lg-4">
                <div class="card card-dokter h-100">
                    <div class="top-bg"></div>
                    
                    <div class="foto-wrapper">
                        <img src="<?= $foto; ?>" class="foto-dokter" alt="Foto Dokter">
                    </div>

                    <div class="card-body text-center pt-2">
                        <h5 class="fw-bold text-dark mb-1"><?= $d['nama_dokter']; ?></h5>
                        <span class="badge spesialis-badge mb-4"><?= $d['spesialis']; ?></span>

                        <div class="text-start px-2">
                            <div class="info-box">
                                <div class="info-icon"><i class="bi bi-calendar-week"></i></div>
                                <div><small class="text-muted d-block">Hari Praktik</small><strong><?= $d['hari_praktek']; ?></strong></div>
                            </div>
                            <div class="info-box">
                                <div class="info-icon text-danger"><i class="bi bi-clock-fill"></i></div>
                                <div><small class="text-muted d-block">Jam Operasional</small><strong><?= $d['jam_praktek']; ?></strong></div>
                            </div>
                            <div class="info-box">
                                <div class="info-icon text-success"><i class="bi bi-geo-alt-fill"></i></div>
                                <div><small class="text-muted d-block">Ruangan</small><strong><?= $d['ruangan']; ?></strong></div>
                            </div>
                        </div>

                        <div class="mt-4 mb-2">
                            <a href="booking.php" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                Buat Janji Temu <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>