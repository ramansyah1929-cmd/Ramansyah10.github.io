<?php
include 'koneksi.php';
$id_rm = $_GET['id'];

// Ambil data detail rekam medis join dengan pasien
// Kita juga mengambil tanggal periksa untuk ditampilkan
$query = "SELECT rm.*, p.nama_pasien, p.no_rekam_medis, p.alamat, p.jenis_kelamin 
          FROM rekam_medis rm 
          JOIN pasien p ON rm.pasien_id = p.id 
          WHERE rm.id = '$id_rm'";
$data = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($data);

if (!$row) { die("Data tidak ditemukan"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pemeriksaan - <?= $row['no_rekam_medis']; ?></title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #555; /* Latar belakang gelap di browser agar kertas terlihat */
            margin: 0;
            padding: 20px;
        }

        /* KERTAS A5 (Setengah A4) */
        .page {
            width: 148mm; /* Lebar A5 */
            min-height: 210mm; /* Tinggi A5 */
            background: #fff;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            position: relative;
            box-sizing: border-box;
        }

        /* HEADER / KOP SURAT */
        .header {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-left { flex: 1; }
        .clinic-name {
            font-size: 20px;
            font-weight: bold;
            color: #3e8eddff;
            text-transform: uppercase;
            margin: 0;
        }
        .clinic-address { font-size: 10px; color: #555; margin-top: 5px; }
        .logo-placeholder {
            width: 50px; height: 50px;
            background: #5b99d7ff; color: #fff;
            border-radius: 90%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 24px;
        }

        /* INFO PASIEN */
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 0;
            font-size: 12px;
            vertical-align: top;
        }
        .label { font-weight: bold; width: 100px; color: #444; }

        /* JUDUL SECTION */
        .section-title {
            background-color: #f0f0f0;
            font-size: 12px;
            font-weight: bold;
            padding: 5px 10px;
            border-left: 4px solid #2c3e50;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        /* KOTAK RESEP & DIAGNOSA */
        .content-box {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 20px;
            min-height: 80px;
        }

        /* FOOTER & TTD */
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
        .signature-box {
            display: inline-block;
            text-align: center;
            width: 150px;
        }
        .ttd-space {
            height: 60px;
        }
        .disclaimer {
            margin-top: 30px;
            font-size: 9px;
            color: #888;
            text-align: center;
            border-top: 1px dashed #ccc;
            padding-top: 10px;
        }

        /* TOMBOL (HANYA DILAYAR) */
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-family: sans-serif;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        .btn-close { background: #6c757d; margin-left: 10px; }

        /* SETTING SAAT PRINT */
        @media print {
            body { background: white; margin: 0; padding: 0; }
            .page { box-shadow: none; margin: 0; width: 100%; height: auto; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" class="btn">🖨 Cetak Nota</button>
        <button onclick="window.close()" class="btn btn-close">❌ Tutup</button>
    </div>

    <div class="page">
        
        <div class="header">
            <div class="header-left">
                <h1 class="clinic-name">KLINIK MENDALO INDAH</h1>
                <p class="clinic-address">
                    Jl.Kolonel Abunjani No.7 Kecamatan Telanaipura, Kota Jambi<br>
                    Telp: 081994948035 | Email: Amanah_Medika@gmail.com
                </p>
            </div>
            <div class="logo-placeholder">👩🏻‍⚕️</div> </div>

        <table class="info-table">
            <tr>
                <td class="label">No. RM</td>
                <td>: <strong><?= $row['no_rekam_medis']; ?></strong></td>
                <td class="label">Tanggal</td>
                <td>: <?= date('d F Y', strtotime($row['tgl_periksa'])); ?></td>
            </tr>
            <tr>
                <td class="label">Nama Pasien</td>
                <td>: <?= strtoupper($row['nama_pasien']); ?></td>
                <td class="label">Jam</td>
                <td>: <?= date('H:i'); ?> WIB</td>
            </tr>
            <tr>
                 <td class="label">Jenis Kelamin</td>
                 <td>: <?= ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
    
                 <td class="label">Dokter</td>
                 <td>: <strong><?= $row['dokter_pemeriksa'] ? $row['dokter_pemeriksa'] : 'dr. Umum'; ?></strong></td>
            </tr>
        </table>

        <div class="section-title">Hasil Diagnosa</div>
        <div class="content-box">
            <?= nl2br($row['diagnosa']); ?>
        </div>

        <div class="section-title">Resep Obat & Tindakan</div>
        <div class="content-box" style="font-family: 'Courier New', Courier, monospace;">
            <?= nl2br($row['resep_obat']); ?>
        </div>

        <div class="footer">
             <div class="signature-box">
             <p>Jakarta, <?= date('d F Y', strtotime($row['tgl_periksa'])); ?></p>
             <div class="ttd-space"></div>
            <p style="text-decoration: underline; font-weight: bold;">
                <?= $row['dokter_pemeriksa'] ? $row['dokter_pemeriksa'] : '( Dokter Pemeriksa )'; ?>
            </p>
        </div>
</div>
        <div class="disclaimer">
            Terima kasih atas kepercayaan Anda. Semoga lekas sembuh.<br>
            <em>Dokumen ini dicetak secara otomatis oleh Sistem Informasi Klinik Mendalo Indah.</em>
        </div>

    </div>

    <script>
        // Hapus komentar di bawah jika ingin otomatis print saat dibuka
        // window.print();
    </script>
</body>
</html>