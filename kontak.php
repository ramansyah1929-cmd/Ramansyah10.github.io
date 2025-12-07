<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Klinik Mendalo Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        
        /* Header Biru */
        .page-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            color: white;
            padding: 80px 0 50px;
            margin-bottom: -40px; /* Agar konten naik ke atas */
        }

        /* Kartu Kontak */
        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        /* Ikon Bulat */
        .icon-box {
            width: 60px;
            height: 60px;
            background: #e7f1ff;
            color: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            flex-shrink: 0;
        }

        /* Peta */
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            height: 100%;
            min-height: 400px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
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
                    <li class="nav-item"><a class="nav-link mx-2" href="jadwal.php">Jadwal Dokter</a></li>
                    <li class="nav-item"><a class="nav-link mx-2 active fw-bold text-primary" href="kontak.php">Kontak</a></li> 
                    <li class="nav-item">
                        <a class="btn btn-warning rounded-pill px-4 ms-3 fw-bold text-dark" href="booking.php">Daftar Online</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header text-center">
        <div class="container">
            <h1 class="fw-bold">Hubungi Kami Jika Ada Pertanyaan</h1>
            <p class="opacity-75">Kami siap melayani pertanyaan dan kebutuhan kesehatan Anda.</p>
        </div>
    </div>

    <div class="container pb-5" style="margin-top: 80px;">
        <div class="row g-4">
            
            <div class="col-lg-5">
                <div class="contact-card">
                    <h4 class="fw-bold mb-4">Informasi Klinik</h4>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat Lokasi</h6>
                            <p class="text-muted mb-0">Jl.Kolonel Abunjani No.7 Kecamatan Telanaipura, Kota Jambi</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-box"><i class="bi bi-whatsapp"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">WhatsApp / Telepon</h6>
                            <p class="text-muted mb-0">
                                <a href="https://wa.me/6281234567890" class="text-decoration-none text-muted">0812-3456-7890</a>
                            </p>
                            <small class="text-success fw-bold">Online dari jam 07:00 - 21:30</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Email Resmi</h6>
                            <p class="text-muted mb-0">Mendalo_Indah@gmail.com</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="icon-box"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Jam Operasional</h6>
                            <p class="text-muted mb-0">Senin - Sabtu: 08:00 - 22:00</p>
                            <p class="text-muted mb-0">Minggu Libur</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-7">
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55254.23778864868!2d103.53233591197278!3d-1.5932688380527358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e25884c8e4a74f3%3A0x2228933863494c5d!2sKec.%20Telanaipura%2C%20Kota%20Jambi%2C%20Jambi!5e1!3m2!1sid!2sid!4v1764422060305!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0; min-height: 450px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </div>

    <footer class="text-center py-4 mt-5 text-muted small">
        &copy; 2018 Klinik Mendalo Indah.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>