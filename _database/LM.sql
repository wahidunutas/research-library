-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jan 2022 pada 16.20
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repositoryweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` varchar(15) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `jabatan`, `no_telepon`, `alamat`, `email`, `profile`) VALUES
(1, 'Admin', 'AdminDefault', '', '', 'ADMIN_DEFAULT', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` varchar(15) NOT NULL,
  `verif_code` text NOT NULL,
  `is_verif` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`id_akses`, `id_admin`, `id_author`, `nip`, `password`, `role`, `verif_code`, `is_verif`) VALUES
(1, 1, 0, '0000', 'admin', 'admin', 'ADMIN_DEFAULT', 1),
(2, 0, 1, '54321', 'dosen1', 'Dosen', '65a180f2dc6a140257ed297e1a1adb1e', 1),
(3, 0, 2, '12345', 'wawa', 'Mahasiswa', '17a4c4d0aa419407ccf97256143b53f9', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `author`
--

CREATE TABLE `author` (
  `id_author` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `author`
--

INSERT INTO `author` (`id_author`, `nama`, `email`, `jurusan`, `id_fakultas`, `alamat`, `no_telepon`, `status`, `img`) VALUES
(1, 'Dosen 1', 'satuwahiddun@gmail.com', '', 2, 'jalan dosen 1', '08123456', 'Dosen', 'GG.jpg'),
(2, 'Mahasiswa 1', 'savemny.app@gmail.com', 'Agroekoteknologi', 3, 'jakarta', '089214731', 'Mahasiswa', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `isi_berita`, `tgl_upload`) VALUES
(2, '1.800 Orang Telah Melakukan Vaksinasi di Gerai Vaksin Presisi Universitas Trilogi', '<p><span style=\"font-weight: bolder; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Jakarta</span><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">&nbsp;â€“ Gerai Vaksin Presisi Trilogi yang berlangsung atas kerjasama POLRI, TNI, Kelurahan Duren Tiga, Puskesmas Kecamatan Pancoran dan Universitas Trilogi ini memasuki hari ke-9. Direktur Reserse Narkoba Polda Metro Jaya Kombes Pol. Mukti Juharsa dan Lurah Duren Tiga Muhammad Mursid, S.IP, MM melakukan kunjungan guna memantau kegiatan tersebut.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Disambut langsung oleh Rektor Universitas Trilogi Prof. Mudrajad Kuncoro, kunjungan Direktur Reserse Narkoba Polda Metro Jaya Kombes Pol. Mukti Juharsa dan Lurah Duren Tiga Muhammad Mursid, S.IP, MM dilaksanakan di ruang Seminar Eksekutif lt. 2 Gedung Perkuliahaan Universitas Trilogi. Muhammad Mursid, S.IP, MM. mengatakan terkejut dengan animo masyarakat yang tinggi dalam melakukan vaksinasi di Universitas Trilogi ini. â€œAwalnya 300 vaksin sudah tercapai perharinya, sekarang akan ditambah 400 vaksin perharinya.â€ Sambung Lurah Duren Tiga.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Dalam kesempatan yang sama Direktur Reserse Narkoba Polda Metro Jaya Kombes Pol. Mukti Juharsa menyampaikan apresiasi kepada Universitas Trilogi atas pelaksanaan Gerai Vaksin di wilayah Universitas Trilogi yang telah memberikan vaksin gratis kepada 1.800 orang. Beliau menambahkan â€œSaya harapkan pada tanggal 17 Agustus 2021 kita semua bisa bebas merdeka dari virus corona, salam presisi!â€</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Kegiatan yang berlangsung sejak 28 Juli 2021 ini sejatinya telah memberikan vaksin gratis setidaknya kepada 1.800 orang. Vaksin yang diberikan merupakan jenis vaksin Sinovac, yang dapat diberikan kepada seluruh warga khususnya masyarakat sekitar universitas trilogi dengan rentan usia 12 tahun â€“ lansia. Hanya dengan membawa KTP, kartu vaksin (jika sudah mendapatkan vaksin pertama) warga bisa mendapatkan vaksin gratis di Gerai Vaksin Universitas Trilogi dan warga yang telah melakukan vaksinasi akan mendapatkan beras 5 Kg dari TNI-POLRI.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Rektor Universitas Trilogi Prof. Mudrajad Kuncoro, Ph.D. menyampaikan â€œSampai sejauh ini pelaksanaan vaksinasi sudah melebihi target, sebelumnya hanya 200 orang perhari kini sudah lebih dari 300 orang perhariâ€ Pada akhir sesi kunjungan hari ini Rektor Universitas Trilogi mengajak dosen, tenaga pendidik, mahasiswa Universitas Trilogi serta warga sekitar Universitas Trilogi untuk melakukan vaksinasi di Universitas Trilogi sampai dengan 17 Agustus 2021.</span></p>', '2021-09-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_dokumen`
--

CREATE TABLE `data_dokumen` (
  `id_data_dokumen` int(11) NOT NULL,
  `id_info_doc` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `files` varchar(255) NOT NULL,
  `named_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_dokumen`
--

INSERT INTO `data_dokumen` (`id_data_dokumen`, `id_info_doc`, `id_doc`, `files`, `named_file`) VALUES
(33, 5, 5, 'LAMPIRAN.pdf', '61d703463551b.pdf'),
(34, 5, 5, 'DAFTAR PUSTAKA.pdf', '61d703464b021.pdf'),
(35, 5, 5, 'BAB 5.pdf', '61d703465dfe1.pdf'),
(36, 5, 5, 'BAB 4.pdf', '61d703467bd5d.pdf'),
(37, 5, 5, 'BAB 3.pdf', '61d70346999c1.pdf'),
(38, 5, 5, 'BAB 2.pdf', '61d70346a74fd.pdf'),
(39, 5, 5, 'BAB 1.pdf', '61d70346ac97e.pdf'),
(40, 5, 5, 'contoh1.pdf', '61d704c357a65.pdf'),
(41, 6, 6, 'COVER.pdf', '61d7041b8e430.pdf'),
(42, 6, 6, 'BAB 1.pdf', '61d7041ba14dc.pdf'),
(43, 6, 6, 'BAB 2.pdf', '61d7041bb4972.pdf'),
(44, 6, 6, 'BAB 3.pdf', '61d7041bc88fe.pdf'),
(45, 6, 6, 'BAB 4.pdf', '61d7041bd2255.pdf'),
(46, 6, 6, 'BAB 5.pdf', '61d7041be56de.pdf'),
(47, 6, 6, 'DAFTAR PUSTAKA.pdf', '61d7041c04457.pdf'),
(48, 6, 6, 'LAMPIRAN.pdf', '61d7041c0da17.pdf'),
(49, 7, 7, 'contoh1.pdf', '61d7046a7e13c.pdf'),
(50, 7, 7, 'contoh1.pdf', '61d7046a891ce.pdf'),
(51, 7, 7, 'contoh1.pdf', '61d7046aa1915.pdf'),
(52, 7, 7, 'contoh1.pdf', '61d7046ab74a6.pdf'),
(53, 7, 7, 'contoh1.pdf', '61d7046ac7139.pdf'),
(54, 7, 7, 'contoh1.pdf', '61d7046ada9ac.pdf'),
(55, 7, 7, 'contoh1.pdf', '61d7046aeab5f.pdf'),
(56, 7, 7, 'contoh1.pdf', '61d7046aeff5a.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id_doc` int(11) NOT NULL,
  `id_info_doc` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `tgl_upload` date NOT NULL,
  `status_doc` varchar(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `notes` text NOT NULL,
  `tgl_acc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`id_doc`, `id_info_doc`, `id_author`, `tgl_upload`, `status_doc`, `id_admin`, `notes`, `tgl_acc`) VALUES
(5, 5, 1, '2022-01-06', 'Disetujui', 1, '', '2022-01-06'),
(6, 6, 2, '2022-01-06', 'Disetujui', 1, '', '2022-01-06'),
(7, 7, 2, '2022-01-06', 'Disetujui', 1, '', '2022-01-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `id_info_doc` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `fakul` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `fakul`) VALUES
(1, 'Ekonomi dan Bisnis '),
(2, 'Industri Kreatif dan Telematika '),
(3, 'Bioindustri '),
(5, 'Keguruan dan Ilmu Pendidikan ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_doc`
--

CREATE TABLE `info_doc` (
  `id_info_doc` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `nama_penulis` varchar(30) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `dospem` varchar(100) NOT NULL,
  `dospem_2` varchar(100) DEFAULT NULL,
  `abstrak` text NOT NULL,
  `dafpus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `info_doc`
--

INSERT INTO `info_doc` (`id_info_doc`, `judul`, `nama_penulis`, `id_tipe`, `id_fakultas`, `id_jurusan`, `dospem`, `dospem_2`, `abstrak`, `dafpus`) VALUES
(5, 'laporan penelitian dosen 1', 'Dosen 1', 7, 2, 2, '', '', '<p>Penelitian deskriptif merupakan metode penelitian yang berusaha menggambarkan objek atau subyek yang diteliti secara objektif, dan bertujuan menggambarkan fakta secara sistematis dan karakteristik objek serta frekuensi yang diteliti secara tepat. Pada umumnya, temuan dari penelitian deskriptif adalah dalam, luas dan terperinci. Luas karena penelitian deskriptif dilakukan tidak hanya terhadap masalah tetapi juga variabel-variabel lain yang berhubungan dengan masalah itu. Pelaksanaan penelitian deskriptif terstruktur, sistematis, dan terkontrol karena peneliti memulai dengan subjek yang telah jelas dan mengadakan penelitian atas populasi atau sampel dari subyek tersebut untuk menggambarkannya secara akurat.</p>\r\n', '<p>Radliya, N. R., Sidik, R., Studi, P., Informasi, S., & Teknik, F. (2018). RANCANG BANGUN SISTEM REPOSITORY AKREDITASI PROGRAM STUDI MANAJEMEN INFORMATIKA. <em>Jurnal Manajemen Informatika (JAMIKA)</em>, <em>8</em>(2), 1–10.</p>\r\n\r\n<p>Rodianto, & Andani, E. S. (2019). <em>SISTEM INFORMASI ADMINISTRASI AKADEMIK PADA BIMBINGAN BELAJAR BERBASIS WEB ( STUDI KASUS DILA SAMAWA )</em>. <em>1</em>(1), 1–10.</p>\r\n\r\n<p>Rosa, A. ., & M, S. (2018). <em>Rekayasa Perangkat Lunak Terstruktur dan Berorientasi Objek</em>. Edisi revisi. Bandung: Informatika Bandung.</p>\r\n\r\n<p>Ruhiawati, I. Y., Gunawan, W., & Faniya, N. (2020). Aplikasi Repository Pada Perpustakaan Universitas Banten Jaya. <em>Jurnal Sistem Informasi Dan Informatika (Simika)</em>, <em>3</em>(2), 110–126. https://doi.org/10.47080/simika.v3i2.1012</p>\r\n\r\n<p>Sugiarti, Y. (2018). <em>Dasar Pemrograman Java Netbeans</em>. Bandung: PT. Remaja Rosdakarya.</p>\r\n\r\n<p>Sugiyono. (2016). <em>Metode penelitian kuantitatif, kualitatif, dan kombinasi (mixed methods)</em>. Alfabeta.</p>\r\n'),
(6, 'Skripsi Mahasiswa 1', 'Mahasiswa 1', 5, 2, 2, 'Rudi Setiawan, S.Kom., M.Cs', '', '<p>Untuk mengatasi permasalahan mahasiswa yang terkadang sering tidak ada waktu untuk mengunjungi perpustakaan serta ketika di perpustakaan mahasiswa sering mengalami kesulitan dalam pencarian referensi-referensi bacaan dan juga mahasiswa minim mendapatkan infomasi terkait informasi terbaru perihal pembaruan peraturan kampus dan perkuliahan. Penulis bermaksud membuat sebuah aplikasi berbasis <em>website</em> pada Universitas Trilogi yang bertujuan untuk menampung dokumen skripsi, laporan magang, thesis, dan jurnal sehingga dokumen tersebut dapat diakses oleh siapapun. Selain menampung dokumen skripsi, laporan magang, thesis, dan jurnal, aplikasi <em>research library</em> ini juga dapat bermanfaat bagi pembaca dalam mencari referensi dan bacaan. Maka dari itu dibutuhkan suatu penelitian yang berfokus pada pembuatan aplikasi <em>research library.</em></p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Metode yang digunakan dalam melakukan pengembangan sistem ini yaitu menggunakan model air terjun (<em>waterfall</em>). Model <em>Waterfall</em> menyediakan pendekatan alur hidup perangkat lunak secara skuensial atau terurut dimulai dari analisis, desain, pengkodean, pengujian, serta tahap pemeliharaan. Hasil penelitian yang dilakukan yaitu aplikasi <em>research library </em>berbasis <em>website</em>, yang selanjutnya akan diimplementasikan pada perpustakaan Universitas Trilogi.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Kata Kunci: <em>Research Library</em><em>, </em>Akreditasi, Mahasiswa, <em>Waterfall</em><em>, Website</em></p>\r\n', '<p>Adrianto, S., &amp; Wahyuni, K. (2019). <em>PERANCANGAN APLIKASI PERPUSTAKAAN DIGITAL</em>. <em>10</em>, 1&ndash;8.</p>\r\n\r\n<p>AMBRIANI, D., &amp; IWAN NURHIDAYAT, A. (2019). Rancang Bangun Repository Publikasi Ilmiah Dosen Berbasis Web Menggunakan Framework Laravel. <em>Jurnal Manajemen Informatika</em>, <em>10</em>(1), 58&ndash;66.</p>\r\n\r\n<p>Amuda, S., Larasati, P. D., &amp; Irawan, A. (2018). Rancang Bangun Sistem Aplikasi E-Library. <em>&hellip; Komputer Dan Kecerdasan Buatan &hellip;</em>, <em>II</em>(1). http://jurnal.tau.ac.id/index.php/siskom-kb/article/view/14</p>\r\n\r\n<p>Anggraeni, E. Y., &amp; Irviani, R. (2017). <em>Pengantar Sistem Informasi</em> (E. Risanto (ed.)). Yogyakarta: Penerbit Andi.</p>\r\n\r\n<p>Anwar, S., &amp; Setiawan, D. (2020). <em>SUKSESI AKREDITASI SEBAGAI STANDAR NASIONAL PENDIDIKAN TINGGI</em>. <em>2</em>(2), 88&ndash;103.</p>\r\n\r\n<p>Arif, A. (2016). <em>RANCANG BANGUN DIGITAL LIBRARY PADA SEKOLAH TINGGI TEKNOLOGI PAGARALAM MENGGUNAKAN PHP DAN MYSQL</em>. <em>07</em>(01), 1&ndash;8.</p>\r\n\r\n<p>Ayu, F., &amp; Permatasari, N. (2018). <em>PERANCANGAN SISTEM INFORMASI PENGOLAHAN DATA PRAKTEK KERJA LAPANGAN (PKL) PADA DEVISI HUMAS PT. PEGADAIAN</em>. <em>2</em>(2), 12&ndash;26.</p>\r\n\r\n<p>Christian, A. (2020). <em>Pengembangan Aplikasi Sistem Informasi Repositori Karya Ilmiah Pada STMIK Prabumulih</em>. <em>22</em>(2), 225&ndash;230.</p>\r\n\r\n<p>Faisal. (2018). <em>STRATEGY PROMOTES GOOD BUREAUCRACY AVOID CONFLICT RESOLUTIONS</em>. 1&ndash;10. http://prosiding.iainponorogo.ac.id/index.php/icis/article/view/1</p>\r\n\r\n<p>Faisal, P., &amp; Kisman, Z. (2020). <em>Information and communication technology utilization effectiveness in distance education systems</em>. <em>12</em>, 1&ndash;9. https://doi.org/10.1177/1847979020911872</p>\r\n\r\n<p>Fitriani, H., Nurmiati, S., &amp; Utomo, A. N. (2016). <em>PENGEMBANGAN APLIKASI WEBSITE PERPUSTAKAAN DENGAN SMS GATEWAY</em>. <em>5</em>(1), 14&ndash;23.</p>\r\n\r\n<p>Hidayat, A., &amp; Buana, A. (2018). <em>SISTEM INFORMASI PERPUSTAKAAN DIGITAL BERBASIS WEB MENGGUNAKAN FRAMEWORK SLIM CENDANA Akik</em>. <em>5</em>(1), 1&ndash;10.</p>\r\n\r\n<p>Muhammad Tesar Sandikapura, &amp; Eko Maulana Sukendar. (2018). Sub Sistem Informasi Pembayaran Uang Semester di Sekolah Tinggi Ilmu Kesehatan Mitra Kencana Kampus 2 Tasikmalaya. <em>Teknik Informatika</em>, <em>6</em>(2), 41&ndash;50. http://jurnal.stmik-dci.ac.id/index.php/jutekin/article/download/332/406</p>\r\n\r\n<p>Nuphus, F. N., Rahmatulloh, A., &amp; Sulastri, H. (2019). <em>Sistem Informasi Akreditasi Perguruan Tinggi ( SIAP ) untuk Pengisian Borang Standar 3 BAN-PT</em>. <em>7</em>(2), 130&ndash;138.</p>\r\n\r\n<p>Permana, A. (2018). Rancang Bangun Sistem Informasi Perpustakaan Berbasis Web (Studi Kasus: Universitas Kuningan). <em>Jurnal Cloud Information</em>, <em>3</em>(2), 36&ndash;40.</p>\r\n\r\n<p>Puspitasari, D. (2016). <em>SISTEM INFORMASI PERPUSTAKAAN SEKOLAH BERBASIS WEB</em>. <em>2</em>, 227&ndash;240.</p>\r\n\r\n<p>Radliya, N. R., Sidik, R., Studi, P., Informasi, S., &amp; Teknik, F. (2018). RANCANG BANGUN SISTEM REPOSITORY AKREDITASI PROGRAM STUDI MANAJEMEN INFORMATIKA. <em>Jurnal Manajemen Informatika (JAMIKA)</em>, <em>8</em>(2), 1&ndash;10.</p>\r\n\r\n<p>Rodianto, &amp; Andani, E. S. (2019). <em>SISTEM INFORMASI ADMINISTRASI AKADEMIK PADA BIMBINGAN BELAJAR BERBASIS WEB ( STUDI KASUS DILA SAMAWA )</em>. <em>1</em>(1), 1&ndash;10.</p>\r\n\r\n<p>Rosa, A. ., &amp; M, S. (2018). <em>Rekayasa Perangkat Lunak Terstruktur dan Berorientasi Objek</em>. Edisi revisi. Bandung: Informatika Bandung.</p>\r\n\r\n<p>Ruhiawati, I. Y., Gunawan, W., &amp; Faniya, N. (2020). Aplikasi Repository Pada Perpustakaan Universitas Banten Jaya. <em>Jurnal Sistem Informasi Dan Informatika (Simika)</em>, <em>3</em>(2), 110&ndash;126. https://doi.org/10.47080/simika.v3i2.1012</p>\r\n\r\n<p>Sugiarti, Y. (2018). <em>Dasar Pemrograman Java Netbeans</em>. Bandung: PT. Remaja Rosdakarya.</p>\r\n\r\n<p>Sugiyono. (2016). <em>Metode penelitian kuantitatif, kualitatif, dan kombinasi (mixed methods)</em>. Alfabeta.</p>\r\n'),
(7, 'test thesis', 'Mahasiswa 1', 2, 5, 11, 'Rudi Setiawan, M.Cs.', 'dosen 2', '<p>Untuk mengatasi permasalahan mahasiswa yang terkadang sering tidak ada waktu untuk mengunjungi perpustakaan serta ketika di perpustakaan mahasiswa sering mengalami kesulitan dalam pencarian referensi-referensi bacaan dan juga mahasiswa minim mendapatkan infomasi terkait informasi terbaru perihal pembaruan peraturan kampus dan perkuliahan. Penulis bermaksud membuat sebuah aplikasi berbasis <em>website</em> pada Universitas Trilogi yang bertujuan untuk menampung dokumen skripsi, laporan magang, thesis, dan jurnal sehingga dokumen tersebut dapat diakses oleh siapapun. Selain menampung dokumen skripsi, laporan magang, thesis, dan jurnal, aplikasi <em>research library</em> ini juga dapat bermanfaat bagi pembaca dalam mencari referensi dan bacaan. Maka dari itu dibutuhkan suatu penelitian yang berfokus pada pembuatan aplikasi <em>research library.</em></p>\r\n', '<p>Adrianto, S., &amp; Wahyuni, K. (2019). <em>PERANCANGAN APLIKASI PERPUSTAKAAN DIGITAL</em>. <em>10</em>, 1&ndash;8.</p>\r\n\r\n<p>AMBRIANI, D., &amp; IWAN NURHIDAYAT, A. (2019). Rancang Bangun Repository Publikasi Ilmiah Dosen Berbasis Web Menggunakan Framework Laravel. <em>Jurnal Manajemen Informatika</em>, <em>10</em>(1), 58&ndash;66.</p>\r\n\r\n<p>Amuda, S., Larasati, P. D., &amp; Irawan, A. (2018). Rancang Bangun Sistem Aplikasi E-Library. <em>&hellip; Komputer Dan Kecerdasan Buatan &hellip;</em>, <em>II</em>(1). http://jurnal.tau.ac.id/index.php/siskom-kb/article/view/14</p>\r\n\r\n<p>Anggraeni, E. Y., &amp; Irviani, R. (2017). <em>Pengantar Sistem Informasi</em> (E. Risanto (ed.)). Yogyakarta: Penerbit Andi.</p>\r\n\r\n<p>Anwar, S., &amp; Setiawan, D. (2020). <em>SUKSESI AKREDITASI SEBAGAI STANDAR NASIONAL PENDIDIKAN TINGGI</em>. <em>2</em>(2), 88&ndash;103.</p>\r\n\r\n<p>Arif, A. (2016). <em>RANCANG BANGUN DIGITAL LIBRARY PADA SEKOLAH TINGGI TEKNOLOGI PAGARALAM MENGGUNAKAN PHP DAN MYSQL</em>. <em>07</em>(01), 1&ndash;8.</p>\r\n\r\n<p>Ayu, F., &amp; Permatasari, N. (2018). <em>PERANCANGAN SISTEM INFORMASI PENGOLAHAN DATA PRAKTEK KERJA LAPANGAN (PKL) PADA DEVISI HUMAS PT. PEGADAIAN</em>. <em>2</em>(2), 12&ndash;26.</p>\r\n\r\n<p>Christian, A. (2020). <em>Pengembangan Aplikasi Sistem Informasi Repositori Karya Ilmiah Pada STMIK Prabumulih</em>. <em>22</em>(2), 225&ndash;230.</p>\r\n\r\n<p>Faisal. (2018). <em>STRATEGY PROMOTES GOOD BUREAUCRACY AVOID CONFLICT RESOLUTIONS</em>. 1&ndash;10. http://prosiding.iainponorogo.ac.id/index.php/icis/article/view/1</p>\r\n\r\n<p>Faisal, P., &amp; Kisman, Z. (2020). <em>Information and communication technology utilization effectiveness in distance education systems</em>. <em>12</em>, 1&ndash;9. https://doi.org/10.1177/1847979020911872</p>\r\n\r\n<p>Fitriani, H., Nurmiati, S., &amp; Utomo, A. N. (2016). <em>PENGEMBANGAN APLIKASI WEBSITE PERPUSTAKAAN DENGAN SMS GATEWAY</em>. <em>5</em>(1), 14&ndash;23.</p>\r\n\r\n<p>Hidayat, A., &amp; Buana, A. (2018). <em>SISTEM INFORMASI PERPUSTAKAAN DIGITAL BERBASIS WEB MENGGUNAKAN FRAMEWORK SLIM CENDANA Akik</em>. <em>5</em>(1), 1&ndash;10.</p>\r\n\r\n<p>Muhammad Tesar Sandikapura, &amp; Eko Maulana Sukendar. (2018). Sub Sistem Informasi Pembayaran Uang Semester di Sekolah Tinggi Ilmu Kesehatan Mitra Kencana Kampus 2 Tasikmalaya. <em>Teknik Informatika</em>, <em>6</em>(2), 41&ndash;50. http://jurnal.stmik-dci.ac.id/index.php/jutekin/article/download/332/406</p>\r\n\r\n<p>Nuphus, F. N., Rahmatulloh, A., &amp; Sulastri, H. (2019). <em>Sistem Informasi Akreditasi Perguruan Tinggi ( SIAP ) untuk Pengisian Borang Standar 3 BAN-PT</em>. <em>7</em>(2), 130&ndash;138.</p>\r\n\r\n<p>Permana, A. (2018). Rancang Bangun Sistem Informasi Perpustakaan Berbasis Web (Studi Kasus: Universitas Kuningan). <em>Jurnal Cloud Information</em>, <em>3</em>(2), 36&ndash;40.</p>\r\n\r\n<p>Puspitasari, D. (2016). <em>SISTEM INFORMASI PERPUSTAKAAN SEKOLAH BERBASIS WEB</em>. <em>2</em>, 227&ndash;240.</p>\r\n\r\n<p>Radliya, N. R., Sidik, R., Studi, P., Informasi, S., &amp; Teknik, F. (2018). RANCANG BANGUN SISTEM REPOSITORY AKREDITASI PROGRAM STUDI MANAJEMEN INFORMATIKA. <em>Jurnal Manajemen Informatika (JAMIKA)</em>, <em>8</em>(2), 1&ndash;10.</p>\r\n\r\n<p>Rodianto, &amp; Andani, E. S. (2019). <em>SISTEM INFORMASI ADMINISTRASI AKADEMIK PADA BIMBINGAN BELAJAR BERBASIS WEB ( STUDI KASUS DILA SAMAWA )</em>. <em>1</em>(1), 1&ndash;10.</p>\r\n\r\n<p>Rosa, A. ., &amp; M, S. (2018). <em>Rekayasa Perangkat Lunak Terstruktur dan Berorientasi Objek</em>. Edisi revisi. Bandung: Informatika Bandung.</p>\r\n\r\n<p>Ruhiawati, I. Y., Gunawan, W., &amp; Faniya, N. (2020). Aplikasi Repository Pada Perpustakaan Universitas Banten Jaya. <em>Jurnal Sistem Informasi Dan Informatika (Simika)</em>, <em>3</em>(2), 110&ndash;126. https://doi.org/10.47080/simika.v3i2.1012</p>\r\n\r\n<p>Sugiarti, Y. (2018). <em>Dasar Pemrograman Java Netbeans</em>. Bandung: PT. Remaja Rosdakarya.</p>\r\n\r\n<p>Sugiyono. (2016). <em>Metode penelitian kuantitatif, kualitatif, dan kombinasi (mixed methods)</em>. Alfabeta.</p>\r\n\r\n<p>Sukamto, Ariani, R., &amp; M, S. (2016). <em>Rekayasa Perangkat Lunak</em>. Bandung: Informasi Bandung.</p>\r\n\r\n<p>Tersiana, A. (2018). <em>Metode Penelitian</em>. Yogyakarta: Anak Hebat Indonesia.</p>\r\n\r\n<p>Theo, F. F., Tulenan, V., &amp; Sambul, A. (2020). <em>Rancang Bangun Aplikasi Digital Library Universitas Sam Ratulangi</em>. <em>15</em>(4).</p>\r\n\r\n<p>Widarma, A., &amp; Rahayu, S. (2018). PERANCANGAN APLIKASI GAJI KARYAWAN PADA PT. PP LONDON SUMATRA INDONESIA Tbk. GUNUNG MALAYU ESTATE - KABUPATEN ASAHAN. <em>Jurnal Teknologi Informasi</em>, <em>1</em>(2), 166. https://doi.org/10.36294/jurti.v1i2.303</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `tipe_jurnal` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tgl_upload_jurnal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `daftar_pustaka` text NOT NULL,
  `file` varchar(100) NOT NULL,
  `name_file` varchar(100) NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `status_jurnal` varchar(25) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `id_author`, `tipe_jurnal`, `judul`, `tgl_upload_jurnal`, `deskripsi`, `daftar_pustaka`, `file`, `name_file`, `posted_by`, `link`, `status_jurnal`, `note`) VALUES
(1, 1, 9, 'Jurnal Dosen 1', '2022-01-06', '<p>Penelitian deskriptif merupakan metode penelitian yang berusaha menggambarkan objek atau subyek yang diteliti secara objektif, dan bertujuan menggambarkan fakta secara sistematis dan karakteristik objek serta frekuensi yang diteliti secara tepat. Pada umumnya, temuan dari penelitian deskriptif adalah dalam, luas dan terperinci. Luas karena penelitian deskriptif dilakukan tidak hanya terhadap masalah tetapi juga variabel-variabel lain yang berhubungan dengan masalah itu. Pelaksanaan penelitian deskriptif terstruktur, sistematis, dan terkontrol karena peneliti memulai dengan subjek yang telah jelas dan mengadakan penelitian atas populasi atau sampel dari subyek tersebut untuk menggambarkannya secara akurat.</p>\r\n', '<p>Adrianto, S., &amp; Wahyuni, K. (2019). <em>PERANCANGAN APLIKASI PERPUSTAKAAN DIGITAL</em>. <em>10</em>, 1&ndash;8.</p>\r\n\r\n<p>AMBRIANI, D., &amp; IWAN NURHIDAYAT, A. (2019). Rancang Bangun Repository Publikasi Ilmiah Dosen Berbasis Web Menggunakan Framework Laravel. <em>Jurnal Manajemen Informatika</em>, <em>10</em>(1), 58&ndash;66.</p>\r\n\r\n<p>Amuda, S., Larasati, P. D., &amp; Irawan, A. (2018). Rancang Bangun Sistem Aplikasi E-Library. <em>&hellip; Komputer Dan Kecerdasan Buatan &hellip;</em>, <em>II</em>(1). http://jurnal.tau.ac.id/index.php/siskom-kb/article/view/14</p>\r\n', '61d6fc8caa1ea.pdf', 'BAB 2.pdf', 'Dosen 1', 'https://jurnaldiakom.kominfo.go.id/index.php/mediakom/article/view/20', 'Disetujui', ''),
(2, 2, 2, 'jurnal mahasiswa 1', '2022-01-06', '<p>Penelitian deskriptif merupakan metode penelitian yang berusaha menggambarkan objek atau subyek yang diteliti secara objektif, dan bertujuan menggambarkan fakta secara sistematis dan karakteristik objek serta frekuensi yang diteliti secara tepat. Pada umumnya, temuan dari penelitian deskriptif adalah dalam, luas dan terperinci. Luas karena penelitian deskriptif dilakukan tidak hanya terhadap masalah tetapi juga variabel-variabel lain yang berhubungan dengan masalah itu. Pelaksanaan penelitian deskriptif terstruktur, sistematis, dan terkontrol karena peneliti memulai dengan subjek yang telah jelas dan mengadakan penelitian atas populasi atau sampel dari subyek tersebut untuk menggambarkannya secara akurat.</p>\r\n', '<ol>\r\n	<li>Andre. (2019, 07 22). <em>pengertian-dan-fungsi-php-dalam-pemograman-web</em>. https://www.duniailkom.com/pengertian-dan-fungsi-php-dalam-pemograman-web/ .Di akses pada tanggal&nbsp; 17 Juli 2020</li>\r\n	<li>Andre, P. (2014, May 5). https://www.andre.web.id/struktur-navigasi-website/</li>\r\n	<li>Anonim. (2013, November 20). <em>pengertian-dan-fungsi-html-hypertext</em>. http://mypctutorel.blogspot.com/2013/11/pengertian-dan-fungsi-html-hypertext.html .Di akses pada tanggal 17 Juli 2020</li>\r\n	<li>Anonim. (2020, Februari 16 ). <em>PhpMyAdmin</em>. https://id.wikipedia.org/wiki/PhpMyAdmin . Di akses pada tanggal 17 Juli 2020</li>\r\n	<li>Anonim. (2020, Juni 18 ). <em>XAMPP</em>. https://id.wikipedia.org/wiki/XAMPP .Di akses pada tanggal 14 Juli 2020</li>\r\n	<li>Anonim. (n.d.). <em>Black Box Testing</em>. https://www.kamuskomputer.com/definisi/black-box/ .Di akses pada tanggal 4 Agustus 2020</li>\r\n	<li>Ansori. (2020, maret 29). <em>Pengertian UML (Unified Modeling Language) : Jenis, Tujuan, Notasi, dan Contohnya</em>. https://www.ansoriweb.com/2020/03/pengertian-uml.html .Di akses pada tanggal 4 Agustus 2020</li>\r\n	<li>Ariona, R. (2013). Struktur File HTML. <em>Belajar HTML dan CSS</em>, 13.</li>\r\n	<li>Dewaweb. (2018, 09 26). <em>Pengertian internet</em>. https://www.dewaweb.com/blog/pengertian-internet/ .Di akses pada tanggal 17 Juli 2020</li>\r\n	<li>Dewaweb. (2018, August 10). <em>User interface</em>. https://www.dewaweb.com/blog/user-interface/ .Di akses pada tanggal 29 Juli 2020</li>\r\n</ol>\r\n', '61d6e555c7df5.pdf', 'BAB 2.pdf', 'Mahasiswa 1', 'https://kursuswebprogramming.com/bagaimana-cara-mengecek-nilai-null-pada-php/', 'Disetujui', ''),
(3, 3, 6, 'jurnal mahasiswa 2', '2022-01-06', '<p>Penelitian deskriptif merupakan metode penelitian yang berusaha menggambarkan objek atau subyek yang diteliti secara objektif, dan bertujuan menggambarkan fakta secara sistematis dan karakteristik objek serta frekuensi yang diteliti secara tepat. Pada umumnya, temuan dari penelitian deskriptif adalah dalam, luas dan terperinci. Luas karena penelitian deskriptif dilakukan tidak hanya terhadap masalah tetapi juga variabel-variabel lain yang berhubungan dengan masalah itu. Pelaksanaan penelitian deskriptif terstruktur, sistematis, dan terkontrol karena peneliti memulai dengan subjek yang telah jelas dan mengadakan penelitian atas populasi atau sampel dari subyek tersebut untuk menggambarkannya secara akurat.</p>\r\n', '<p>Radliya, N. R., Sidik, R., Studi, P., Informasi, S., &amp; Teknik, F. (2018). RANCANG BANGUN SISTEM REPOSITORY AKREDITASI PROGRAM STUDI MANAJEMEN INFORMATIKA. <em>Jurnal Manajemen Informatika (JAMIKA)</em>, <em>8</em>(2), 1&ndash;10.</p>\r\n\r\n<p>Rodianto, &amp; Andani, E. S. (2019). <em>SISTEM INFORMASI ADMINISTRASI AKADEMIK PADA BIMBINGAN BELAJAR BERBASIS WEB ( STUDI KASUS DILA SAMAWA )</em>. <em>1</em>(1), 1&ndash;10.</p>\r\n\r\n<p>Rosa, A. ., &amp; M, S. (2018). <em>Rekayasa Perangkat Lunak Terstruktur dan Berorientasi Objek</em>. Edisi revisi. Bandung: Informatika Bandung.</p>\r\n\r\n<p>Ruhiawati, I. Y., Gunawan, W., &amp; Faniya, N. (2020). Aplikasi Repository Pada Perpustakaan Universitas Banten Jaya. <em>Jurnal Sistem Informasi Dan Informatika (Simika)</em>, <em>3</em>(2), 110&ndash;126. https://doi.org/10.47080/simika.v3i2.1012</p>\r\n\r\n<p>Sugiarti, Y. (2018). <em>Dasar Pemrograman Java Netbeans</em>. Bandung: PT. Remaja Rosdakarya.</p>\r\n\r\n<p>Sugiyono. (2016). <em>Metode penelitian kuantitatif, kualitatif, dan kombinasi (mixed methods)</em>. Alfabeta.</p>\r\n', '61d6fd199f74c.pdf', 'BAB 1.pdf', 'mahasiswa 2', 'https://jurnaldiakom.kominfo.go.id/index.php/mediakom/article/view/20', 'Disetujui', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `jur` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `id_fakultas`, `jur`) VALUES
(1, 1, 'Manajemen'),
(2, 2, 'Desain Komunikasi Visual'),
(3, 2, 'Desain Produk Industri'),
(4, 2, 'Teknik Informatika'),
(5, 2, 'Sistem Informasi'),
(6, 1, 'Akuntansi'),
(7, 1, 'Ekonomi Pembangunan'),
(8, 3, 'Agribisnis'),
(9, 3, 'Agroekoteknologi'),
(10, 3, 'Ilmu dan Teknologi Pangan'),
(11, 5, 'PGPAUD'),
(12, 5, 'PGSD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komen` int(11) NOT NULL,
  `id_info_doc` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tgl_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe`
--

CREATE TABLE `tipe` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tipe`
--

INSERT INTO `tipe` (`id_tipe`, `nama_tipe`) VALUES
(2, 'Thesis'),
(3, 'Tugas Akhir'),
(5, 'Skripsi'),
(6, 'Jurnal'),
(7, 'Laporan Penelitian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_jurnal`
--

CREATE TABLE `tipe_jurnal` (
  `id_tipe_jurnal` int(11) NOT NULL,
  `nama_tipe_jurnal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tipe_jurnal`
--

INSERT INTO `tipe_jurnal` (`id_tipe_jurnal`, `nama_tipe_jurnal`) VALUES
(2, 'Jurnal Bisnis, Manajemen dan Teknososiopreneur'),
(3, 'Journal of Business Economics Accounting and Talen'),
(4, 'Singularity: Jurnal dan Industri Kreatif'),
(5, 'Jurnal Sistem Informasi dan Sains Teknologi'),
(6, 'Jurnal Kesejahteraan Sosial'),
(7, 'Jurnal Bioindustri (Journal of Bioindustry)'),
(8, 'Jurnal Caksana: Pendidikan Anak Usia Dini'),
(9, 'Jurnal Ilmiah Pendidikan Guru Sekolah Dasar'),
(10, 'Jurnal Pengabdian Masyarakat Ilmu Keguruan dan Pen'),
(11, 'JISA (Jurnal Informatika dan Sains)'),
(12, 'E-Prosiding Akuntansi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id_vm` int(11) NOT NULL,
  `visi` text NOT NULL,
  `id_fakultas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `visi_misi`
--

INSERT INTO `visi_misi` (`id_vm`, `visi`, `id_fakultas`) VALUES
(1, '<p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n36.0pt;text-align:justify;line-height:150%;vertical-align:baseline\"><b><span lang=\"EN-US\" style=\"font-size:11.0pt;\r\nline-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:black\">VISI<o:p></o:p></span></b></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n36.0pt;text-align:justify;line-height:150%;vertical-align:baseline\"><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Menjadi Fakultas Ekonomi dan Bisnis yang inovatif dengan\r\nmengembangkan Keteknopreneuran, Kolaborasi, dan Kemandirian berdasarkan\r\nnilai-nilai Pancasila pada Tahun 2027<o:p></o:p></span></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n36.0pt;text-align:justify;line-height:150%;vertical-align:baseline\"><b><span lang=\"EN-US\" style=\"font-size:11.0pt;\r\nline-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:black\">MISI<o:p></o:p></span></b></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Menyelenggarakan pendidikan inovatif di Bidang Ekonomi dan Bisnis\r\ndengan basis Teknopreneur, Kolaborasi, dan Kemandirian dalam lingkungan ekonomi\r\nbiru berlandaskan nilai-nilai Pancasila, serta mampu berkontribusi pada\r\npembangunan nasional yang berkelanjutan<o:p></o:p></span></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Melaksanakan penelitian guna mengembangkan pengetahuan dalam\r\nBidang Ilmu Ekonomi dan Bisnis<o:p></o:p></span></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">3.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Melaksanakan pengabdian kepada masyarakat guna memberikan\r\nkontribusi pada pembangunan nasional yang berkelanjutan sehingga dapat\r\nmeningkatkan kesejahteraan masyarakat<o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">4.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Melaksanakan tata kelola penyelenggaraan pendidikan tinggi di\r\nFakultas Ekonomi dan Bisnis secara transparan, akuntanbel, bertanggungjawab,\r\nindependen, dan berkeadilan<o:p></o:p></span></p>', 1),
(2, '<p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n36.0pt;text-align:justify;line-height:150%;vertical-align:baseline\"><b><span lang=\"EN-US\" style=\"font-size:11.0pt;\r\nline-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:black\">VISI<o:p></o:p></span></b></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n36.0pt;text-align:justify;line-height:150%;vertical-align:baseline\"><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Menjadi Fakultas Industri Kreatif dan Telematika yang inovatif\r\ndengan basis Teknopreneur, Kolaborasi, dan Kemandirian berdasarkan nilai-nilai\r\nPancasila 2027<o:p></o:p></span></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n36.0pt;text-align:justify;line-height:150%;vertical-align:baseline\"><b><span lang=\"EN-US\" style=\"font-size:11.0pt;\r\nline-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:black\">MISI<o:p></o:p></span></b></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Menyelenggarakan pendidikan yang unggul dan inovatif dalam bidang\r\nindustri kreatif dan teknologi, sehingga dapat menghasilkan lulusan dengan\r\nkeunggulan kompetitif<o:p></o:p></span></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Melakukan penelitian, publikasi, serta kepemilikan Hak Atas\r\nKekayaan Intelektual (HAKI) sebagai upaya pengembangan Ilmu Pengetahuan,\r\nKreativitas, dan Teknologi<o:p></o:p></span></p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">3.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Melaksanakan pengabdian kepada mesyarakat berbasis pemberdayaan\r\ndan partisipatif sebagai kontribusi penuh dalam membantu memecahkan persoalan\r\nmasyarakat sebagai upaya implementasi dan pengembangan Ilmu Pengetahuan,\r\nKreativitas, dan Teknologi<o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p style=\"margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:\r\n54.0pt;text-align:justify;text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1;\r\nvertical-align:baseline\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\nmso-fareast-font-family:Arial;color:black\">4.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;\r\ncolor:black\">Melakukan evaluasi berbasis continuous improvement dalam rangka\r\nmeningkatkan kualitas, profesionalisme, kapabilitas, akuntabilitas, dan\r\ntransparansi tata kelola serta kemandirian dalam penyelenggaraan institusi<o:p></o:p></span></p>', 2),
(3, '<p style=\"margin: 12pt 0cm 12pt 36pt; text-align: justify; line-height: 24px; vertical-align: baseline;\"><span style=\"font-weight: bolder;\"><span lang=\"EN-US\" arial\",sans-serif;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Visi<o:p></o:p></span></span></p><p style=\"margin: 12pt 0cm 12pt 36pt; text-align: justify; line-height: 24px; vertical-align: baseline;\"><span lang=\"EN-US\" arial\",sans-serif;=\"\" color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Menjadi Fakultas Bioindustri yang Unggul dan Inovatif dalam Bidang Pangan dan Bioenergi dengan mengembangkan Keteknopreneuran, Kolaborasi, dan Kemandirian berdasarkan nilai-nilai Pancasila pada Tahun 2027<o:p></o:p></span></p><p style=\"margin: 12pt 0cm 12pt 36pt; text-align: justify; line-height: 24px; vertical-align: baseline;\"><span style=\"font-weight: bolder;\"><span lang=\"EN-US\" arial\",sans-serif;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">MISI<o:p></o:p></span></span></p><p style=\"margin: 12pt 0cm 12pt 54pt; text-align: justify; text-indent: -18pt; line-height: 24px; vertical-align: baseline;\"><span lang=\"EN-US\" arial\",sans-serif;=\"\" mso-fareast-font-family:arial;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">1.<span times=\"\" new=\"\" roman\";\"=\"\" style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal;\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span lang=\"EN-US\" arial\",sans-serif;=\"\" color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Menyelenggarakan pendidikan tinggi di bidang Bioindustri khususnya bidang Pangan dan Bioenergi yang berkualitas untuk menghasilkan lulusan yang berdaya saing tinggi<o:p></o:p></span></p><p style=\"margin: 12pt 0cm 12pt 54pt; text-align: justify; text-indent: -18pt; line-height: 24px; vertical-align: baseline;\"><span lang=\"EN-US\" arial\",sans-serif;=\"\" mso-fareast-font-family:arial;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">2.<span times=\"\" new=\"\" roman\";\"=\"\" style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal;\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span lang=\"EN-US\" arial\",sans-serif;=\"\" color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Mengembangkan keilmuan Bioindustri melalui penyelenggaraan riset yang dapat dimanfaatkan masyarakat dan industri untuk menjawab tantangan nasional utamanya pangan dan energi<o:p></o:p></span></p><p style=\"margin: 12pt 0cm 12pt 54pt; text-align: justify; text-indent: -18pt; line-height: 24px; vertical-align: baseline;\"><span lang=\"EN-US\" arial\",sans-serif;=\"\" mso-fareast-font-family:arial;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">3.<span times=\"\" new=\"\" roman\";\"=\"\" style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal;\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span lang=\"EN-US\" arial\",sans-serif;=\"\" color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Melaksanakan pengabdian kepada masyarakat berbasis pemberdayaan serta partisipasi aktif masyarakat melalui kepakaran yang dimiliki serta inovasi yang dihasilkan untuk berkontribusi pada pembangunan nasional yang berkelanjutan sehingga dapat meningkatkan kesejahteraan masyarakat<o:p></o:p></span></p><p style=\"margin: 12pt 0cm 12pt 54pt; text-align: justify; text-indent: -18pt; line-height: 24px; vertical-align: baseline;\"><span lang=\"EN-US\" arial\",sans-serif;=\"\" mso-fareast-font-family:arial;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">4.<span times=\"\" new=\"\" roman\";\"=\"\" style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal;\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span lang=\"EN-US\" arial\",sans-serif;=\"\" color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Mengembangkan Fakultas Bioindustri Universitas Trilogi menjadi organisasi yang sehat dengan sistem tata kelola yang baik<o:p></o:p></span></p><p></p><p style=\"margin: 12pt 0cm 12pt 54pt; text-align: justify; text-indent: -18pt; line-height: 24px; vertical-align: baseline;\"><span lang=\"EN-US\" arial\",sans-serif;=\"\" mso-fareast-font-family:arial;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">5.<span times=\"\" new=\"\" roman\";\"=\"\" style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal;\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span lang=\"EN-US\" arial\",sans-serif;=\"\" color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Mengembangkan kerja sama dengan Pemerintah, Industri, serta Perguruan Tinggi lain di tingkat Nasional maupun Internasional</span></p>', 3),
(5, '                                <p style=\"margin: 12pt 0cm 12pt 36pt; text-align: justify; line-height: 24px; vertical-align: baseline;\"><span style=\"font-weight: bolder;\"><span lang=\"EN-US\" arial\",sans-serif;=\"\" color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Visi<o:p></o:p></span></span></p><p style=\"margin: 12pt 0cm 12pt 36pt; text-align: justify; line-height: 24px; vertical-align: baseline;\"><span lang=\"EN-US\" arial\",sans-serif;color:black\"=\"\" style=\"font-size: 11pt; line-height: 22px;\">Menjadi Fakultas Keguruan dan Ilmu Pendidikan yang unggul dengan mengembangkan Keteknopreneuran, Kolaborasi, dan Kemandirian berdasarkan nilai-nilai Pancasila pada Tahun 2029</span></p>                        ', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `data_dokumen`
--
ALTER TABLE `data_dokumen`
  ADD PRIMARY KEY (`id_data_dokumen`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indeks untuk tabel `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indeks untuk tabel `info_doc`
--
ALTER TABLE `info_doc`
  ADD PRIMARY KEY (`id_info_doc`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komen`);

--
-- Indeks untuk tabel `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indeks untuk tabel `tipe_jurnal`
--
ALTER TABLE `tipe_jurnal`
  ADD PRIMARY KEY (`id_tipe_jurnal`);

--
-- Indeks untuk tabel `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id_vm`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_dokumen`
--
ALTER TABLE `data_dokumen`
  MODIFY `id_data_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `info_doc`
--
ALTER TABLE `info_doc`
  MODIFY `id_info_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tipe_jurnal`
--
ALTER TABLE `tipe_jurnal`
  MODIFY `id_tipe_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id_vm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
