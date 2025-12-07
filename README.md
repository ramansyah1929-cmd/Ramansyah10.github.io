# website_klinik-mendalo-indah
Kelompok 8:
Ridho Al fitrah Anugrah
Raffiramansyah
Pardiyansyah



Deskripsi: Website ini adalah aplikasi layanan kesehatan digital yang dirancang untuk mempermudah proses operasional klinik yang sebelumnya dilakukan secara manual. Dibangun menggunakan teknologi PHP Native dan database MySQL, sistem ini menghubungkan pasien, dokter, dan administrator dalam satu platform terintegrasi.

Fungsi Utama: Sistem ini memungkinkan Pasien untuk melakukan pendaftaran, melihat jadwal dokter, dan melakukan booking (reservasi) antrian berobat secara online dari rumah. Di sisi lain, Admin memiliki kendali penuh untuk mengelola semua data(dokter & pasien), memvalidasi status pendaftaran, serta memantau jadwal kunjungan secara real-time.

Tujuan: Tujuan utama website ini adalah meningkatkan efisiensi pelayanan klinik dengan mengurangi antrian fisik, meminimalisir kesalahan pencatatan data pasien, dan menyediakan akses informasi jadwal dokter yang transparan dan mudah diakses kapan saja.

Teknolgi yang digunakan yang pertama yaitu menggunakan visual studi code sebagai software dalam pengembangan sebuah aplikasi. Selanjutnya menggunakan bahasa pemerograman php,mengguakan mysql untuk menyimpan data, kemudian ada html dan csss. Aplikasi ini dapat di akses menggukan berbagai browser.

Cara menjalankannya pertama Aktifkan Server (XAMPP)
Yang ke 2 Siapkan Folder Proyek uka File Explorer, lalu masuk ke folder instalasi XAMPP (biasanya di C:\xampp).Cari dan buka folder bernama htdocs. (Ini adalah folder "wajib" untuk menyimpan semua file web). Di dalam htdocs, buat folder baru, beri nama misalnya: klinik_kita.Simpan semua file kodinganmu (index.php, login.php, style.css, dll) di dalam folder klinik_kita ini.Langkah 3: Siapkan Database Buka browser (Chrome/Edge), ketik alamat: localhost/phpmyadmin.Klik tab Databases (atau "Basis Data").Pada kolom "Create database", ketik nama database, misalnya: db_klinik. Klik Create.Setelah database jadi, kamu harus memasukkan tabel-tabel (SQL) yang sesuai dengan desain kita sebelumnya (Tabel User, Dokter, Booking).Langkah 4: Koneksi Database buat file koneksi untuk menghubungkan aplikasi ke database.

selanjutnya buat file koneksi.php di visual studiocode

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_klinik"; // Sesuai nama database di Langkah 3

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>

Trakhir jalankan di BrowserKetik di address bar: localhost/klinik_kita (sesuaikan dengan nama folder )Tekan Enter.


Link Demo Video [ https://drive.google.com/file/d/1gdeQAvhu5FpqO5IWaxKxXrvPhIZ8S2Y4/view?usp=drive_link ]

gambar halaman utama
<img width="827" height="516" alt="image" src="https://github.com/user-attachments/assets/6c26f0dc-7161-43ca-916c-430e677b861e" />

catatan tambahan : pasien tidak bisa mengedit data jika terjadi kesalahan input saat registrasi, yang harus dilakukan menghubungi admin/kontak klinik



Tugas Final Project Mata Kuliah Rekayasa Perangkat Lunak Dosen Pengampu: Dila Nurlaila, M.Kom Universitas: UIN Sulthan Thaha Saifuddin Jambi
