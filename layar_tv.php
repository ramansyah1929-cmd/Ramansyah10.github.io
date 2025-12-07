<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Layar Antrian Klinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #5795f2ff; /* Biru Full Layar */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: sans-serif;
            overflow: hidden;
        }
        .box-antrian {
            background: white;
            color: #333;
            width: 80%;
            max-width: 900px;
            padding: 50px;
            border-radius: 30px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .judul { font-size: 2rem; font-weight: bold; color: #555; text-transform: uppercase; margin-bottom: 20px; }
        .nomor-besar { font-size: 8rem; font-weight: bold; color: #0d6efd; line-height: 1; }
        .nama-pasien { font-size: 3rem; margin-top: 20px; font-weight: 600; }
        .poli { font-size: 1.5rem; margin-top: 20px; background: #ffc107; color: black; display: inline-block; padding: 10px 30px; border-radius: 50px; font-weight: bold;}
        
        /* Animasi Berkedip saat dipanggil */
        .blink { animation: blinker 1s linear infinite; }
        @keyframes blinker { 50% { opacity: 0.5; } }
    </style>
</head>
<body>

    <div class="box-antrian">
        <div class="judul">Nomor Antrian Dipanggil</div>
        
        <?php
        // Cari pasien yang status_panggil nya 'Dipanggil'
        $query = mysqli_query($koneksi, "SELECT * FROM booking WHERE status_panggil='Dipanggil' ORDER BY id DESC LIMIT 1");
        $data = mysqli_fetch_array($query);

        if($data) {
        ?>
            <div class="nomor-besar blink"><?= $data['no_antrian']; ?></div>
            <div class="nama-pasien"><?= $data['nama_pemesan']; ?></div>
            <div class="poli">SILAKAN MASUK KE RUANGAN DOKTER</div>
        <?php 
        } else { 
        ?>
            <div class="nomor-besar text-muted">-</div>
            <div class="nama-pasien text-muted">Belum ada panggilan</div>
        <?php } ?>
    </div>

    <script>
        setInterval(function(){
            location.reload();
        }, 3000); // 3000 ms = 3 detik
    </script>

</body>
</html>