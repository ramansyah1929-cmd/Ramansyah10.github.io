<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Amanah Medika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fbfd;
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .nav-link {
            font-weight: 500;
            color: #333 !important;
        }
        .nav-link:hover {
            color: #0d6efd !important;
        }

        /* HERO SECTION (GAMBAR UTAMA) */
        .hero {
            background: linear-gradient(rgba(0, 80, 200, 0.8), rgba(0, 150, 255, 0.6)), 
                        url('https://images.unsplash.com/photo-1538108149393-fbbd81895907?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            height: 85vh; /* Tinggi hampir semayar penuh */
            display: flex;
            align-items: center;
            color: white;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .hero-btn {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            padding: 15px 40px;
            border-radius: 50px;
            transition: 0.3s;
            border: none;
        }
        .hero-btn:hover {
            transform: translateY(-5px);
            background-color: #ffca2c;
            box-shadow: 0 10px 20px rgba(255, 193, 7, 0.4);
        }

        /* SERVICE CARDS */
        .service-card {
            border: none;
            border-radius: 20px;
            padding: 30px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
            text-align: center;
            height: 100%;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .icon-box {
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            background: #e7f1ff;
            color: #0d6efd;
            font-size: 2rem;
            margin: 0 auto 20px;
        }

        /* FOOTER */
        footer {
            background-color: #0b1c3c;
            color: #aaa;
            padding: 50px 0;
        }
        footer h5 { color: white; font-weight: 700; margin-bottom: 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="#">
                <i class="bi bi-hospital-fill"></i> KLINIK MENDALO INDAH
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link mx-2" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="jadwal.php">Jadwal Dokter</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="kontak.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="cek_antrian.php">Cek Status</a></li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4 ms-3 fw-bold shadow-sm" href="booking.php">Daftar Online</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-3 text-warning fw-bold small" href="login.php">
                            <i class="bi bi-lock-fill"></i> Staff
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill mb-3 fw-bold">🏥 Melayani Sepenuh Hati dan Amanah</span>
                    <h1 class="display-3 fw-bold mb-4">Solusi Kesehatan Keluarga Anda</h1>
                    <p class="lead mb-5 opacity-75">Kami menyediakan layanan medis terbaik dengan dokter spesialis yang berpengalaman dibidangnya dan fasilitas modern dengan menggunakan pendaftaran secara online yang mudah dan cepat.</p>
                    <a href="booking.php" class="hero-btn text-decoration-none">
                        Buat Janji Sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section class="py-5" style="margin-top: -80px; position: relative; z-index: 10;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="icon-box"><i class="bi bi-heart-pulse-fill"></i></div>
                        <h4>Poli Umum</h4>
                        <p class="text-muted">Pemeriksaan kesehatan menyeluruh untuk mendeteksi penyakit sejak dini.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="icon-box" style="background: #fff4e6; color: #ff9800;"><i class="bi bi-emoji-smile-fill"></i></div>
                        <h4>Poli Gigi</h4>
                        <p class="text-muted">Perawatan gigi estetik, pembersihan karang, dan pencabutan tanpa sakit.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="icon-box" style="background: #e6fffa; color: #00b894;"><i class="bi bi-capsule"></i></div>
                        <h4>Tersedia Berbagai Spesialis</h4>
                        <p class="text-muted">Layanan dokter spesialis yang lengkap dan berpengalaman dibidangnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <h2 class="fw-bold text-primary display-4">15+</h2>
                    <p class="fw-bold text-uppercase text-secondary">Dokter Spesialis</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h2 class="fw-bold text-primary display-4">24h</h2>
                    <p class="fw-bold text-uppercase text-secondary">Layanan Darurat</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h2 class="fw-bold text-primary display-4">5k+</h2>
                    <p class="fw-bold text-uppercase text-secondary">Pasien Puas</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h2 class="fw-bold text-primary display-4">100%</h2>
                    <p class="fw-bold text-uppercase text-secondary">Fasilitas Modern</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>KLINIK MENDALO INDAH</h5>
                    <p>Menjadi mitra kesehatan terpercaya bagi keluarga Indonesia dengan pelayanan yang ramah dan profesional.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary">Home</a></li>
                        <li><a href="jadwal.php" class="text-decoration-none text-secondary">Jadwal Dokter</a></li>
                        <li><a href="booking.php" class="text-decoration-none text-secondary">Daftar Online</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <p><i class="bi bi-geo-alt-fill me-2"></i> Jl.Kolonel Abunjani No.7 Kecamatan Telanaipura, Kota Jambi</p>
                    <p><i class="bi bi-telephone-fill me-2"></i> 081994948035</p>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <div class="text-center small">
                &copy; 2018 Klinik Mendalo Indah. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>