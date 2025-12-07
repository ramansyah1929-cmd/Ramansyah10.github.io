<?php
include 'koneksi.php';

// Proses simpan data
if (isset($_POST['kirim_booking'])) {
    $nama = $_POST['nama'];
    $hp = $_POST['hp'];
    $jk = $_POST['jk']; 
    $tgl = $_POST['tgl'];
    $keluhan = $_POST['keluhan'];

    // --- LOGIKA NOMOR ANTRIAN OTOMATIS ---
    // 1. Hitung berapa orang yang sudah daftar di TANGGAL ITU
    $cek_urutan = mysqli_query($koneksi, "SELECT count(*) as total FROM booking WHERE tanggal_kunjungan = '$tgl'");
    $data_urutan = mysqli_fetch_assoc($cek_urutan);
    
    // 2. Urutannya ditambah 1
    $urutan_baru = $data_urutan['total'] + 1;
    
    // 3. Format jadi "A-001"
    // str_pad berfungsi menambah angka 0 di depan (misal 1 jadi 001)
    $no_antrian = "A-" . str_pad($urutan_baru, 3, "0", STR_PAD_LEFT);

    // Simpan ke database (Sertakan no_antrian)
    $query = "INSERT INTO booking (no_antrian, nama_pemesan, no_hp, jenis_kelamin, tanggal_kunjungan, keluhan) 
              VALUES ('$no_antrian', '$nama', '$hp', '$jk', '$tgl', '$keluhan')";
    
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        $sukses = true;
        $nomor_kamu = $no_antrian; // Simpan untuk ditampilkan di notifikasi
    } else {
        $error = "Gagal mengirim data. Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f4f8; }
        .booking-container { margin-top: 80px; margin-bottom: 50px; }
        .card-booking { border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .left-side { background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%); color: white; padding: 40px; }
        .btn-submit { background-color: #ffc107; border: none; padding: 12px; border-radius: 10px; width: 100%; font-weight: bold; transition: 0.3s; }
        .btn-submit:hover { background-color: #ffca2c; transform: translateY(-2px); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="index.php"><i class="bi bi-hospital-fill"></i> KLINIK MENDALO INDAH</a>
            <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 btn-sm fw-bold">Kembali</a>
        </div>
    </nav>

    <div class="container booking-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-booking">
                    <div class="row g-0">
                        <div class="col-md-5 left-side d-none d-md-flex flex-column justify-content-center">
                            <h2 class="fw-bold mb-3">Daftar Tanpa Antri</h2>
                            <p class="opacity-75">Isi formulir untuk mendapatkan nomor antrian prioritas.</p>
                        </div>

                        <div class="col-md-7 bg-white p-4 p-md-5">
                            <h3 class="fw-bold text-primary mb-4">Form Registrasi</h3>
                            
                            <?php if(isset($sukses)) { ?>
                                <div class="alert alert-success text-center border-0 shadow-sm">
                                    <h1 class="display-4 fw-bold"><?= $nomor_kamu; ?></h1>
                                    <h5 class="alert-heading fw-bold">Berhasil Terdaftar!</h5>
                                    <p>Ini adalah Nomor Antrian Anda. Silakan screenshot halaman ini.</p>
                                    <hr>
                                    <a href="cek_antrian.php" class="btn btn-outline-success btn-sm">Cek Status Antrian</a>
                                    <a href="booking.php" class="btn btn-success btn-sm">Daftar Lagi</a>
                                </div>
                                <style> form { display: none; } </style>
                            <?php } ?>

                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">No. WhatsApp</label>
                                        <input type="text" name="hp" class="form-control" required placeholder="Gunakan nomor aktif">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Jenis Kelamin</label>
                                        <select name="jk" class="form-select" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tanggal Kunjungan</label>
                                    <input type="date" name="tgl" class="form-control" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Keluhan</label>
                                    <textarea name="keluhan" class="form-control" rows="2"></textarea>
                                </div>
                                <button type="submit" name="kirim_booking" class="btn btn-submit">AMBIL ANTRIAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>