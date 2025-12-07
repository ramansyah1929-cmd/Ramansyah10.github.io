<?php
include 'koneksi.php';

// Ambil tanggal dari URL
$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];

// FUNGSI HEADER: Memberitahu browser bahwa ini adalah file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Klinik_$tgl_awal-sd-$tgl_akhir.xls");
?>

<h3>LAPORAN REKAM MEDIS KLINIK MENDALO INDAH</h3>
<p>Periode: <?= $tgl_awal; ?> s/d <?= $tgl_akhir; ?></p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr style="background-color: yellow; font-weight: bold;">
            <th>No</th>
            <th>Tanggal Periksa</th>
            <th>No RM</th>
            <th>Nama Pasien</th>
            <th>Diagnosa Dokter</th>
            <th>Resep Obat</th>
            <th>Dokter Pemeriksa</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT rm.*, p.nama_pasien, p.no_rekam_medis 
                  FROM rekam_medis rm 
                  JOIN pasien p ON rm.pasien_id = p.id 
                  WHERE rm.tgl_periksa BETWEEN '$tgl_awal' AND '$tgl_akhir'
                  ORDER BY rm.tgl_periksa ASC";
        
        $data = mysqli_query($koneksi, $query);
        $no = 1;

        while($row = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td align="center"><?= $no++; ?></td>
            <td><?= $row['tgl_periksa']; ?></td>
            <td><?= $row['no_rekam_medis']; ?></td>
            <td><?= $row['nama_pasien']; ?></td>
            <td><?= $row['diagnosa']; ?></td>
            <td><?= $row['resep_obat']; ?></td>
            <td><?= $row['dokter_pemeriksa']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>