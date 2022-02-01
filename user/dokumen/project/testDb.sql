-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jan 2022 pada 14.54
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
(1, 'Admin', 'AdminDefault', '', '', 'ADMIN_DEFAULT', ''),
(2, 'admin2', 'Mahasiswa', '08123456', '', 'wahidariesta@gmail.com', '');

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
  `is_verif` tinyint(1) NOT NULL DEFAULT 0,
  `is_confirm` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`id_akses`, `id_admin`, `id_author`, `nip`, `password`, `role`, `verif_code`, `is_verif`, `is_confirm`) VALUES
(1, 1, 0, '0000', 'admin', 'admin', 'DEFAULT_ADMIN', 1, 0),
(5, 2, 0, '0001', 'admin2', 'admin', 'b3acc2891470f1aa4170f798f5d54bac', 1, 0),
(6, 0, 1, '12345', 'user', 'Mahasiswa', '19c7e513478a861df05cddf94859c6bd', 1, 1),
(7, 0, 2, '54321', 'dosen', 'Dosen', 'd70bf0610bd64c197e82acd3a059a775', 1, 1),
(13, 0, 8, '545454', 'wawa', 'Mahasiswa', '0db079700f30f8a7e949c6442fc90775', 1, 1);

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
(1, 'user 1', 'satuwahiddun@gmail.com', 'Teknik Informatika', 2, '', '', 'Mahasiswa', ''),
(2, 'Dosen 1', 'savemny.app@gmail.com', '', 1, '', '', 'Dosen', ''),
(8, 'Muhamad Abdul Wahid', 'wahidariesta@gmail.com', 'Agroekoteknologi', 3, '', '', 'Mahasiswa', '');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_file_project`
--

CREATE TABLE `data_file_project` (
  `id_data_file` int(11) NOT NULL,
  `id_info_doc` int(11) NOT NULL,
  `file_project` varchar(100) NOT NULL,
  `file_database` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `id_info_doc` int(11) NOT NULL,
  `id_jurnal` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
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
  `nama_penulis_2` varchar(100) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `dospem` varchar(100) NOT NULL,
  `dospem_2` varchar(100) DEFAULT NULL,
  `abstrak` text NOT NULL,
  `dafpus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `nama_tipe_jurnal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tipe_jurnal`
--

INSERT INTO `tipe_jurnal` (`id_tipe_jurnal`, `nama_tipe_jurnal`) VALUES
(2, 'Jurnal Bisnis, Manajemen dan Teknososiopreneur'),
(3, 'Journal of Business Economics Accounting and Talent Management'),
(4, 'Singularity: Jurnal dan Industri Kreatif'),
(5, 'Jurnal Sistem Informasi dan Sains Teknologi'),
(6, 'Jurnal Kesejahteraan Sosial'),
(7, 'Jurnal Bioindustri (Journal of Bioindustry)'),
(8, 'Jurnal Caksana: Pendidikan Anak Usia Dini'),
(9, 'Jurnal Ilmiah Pendidikan Guru Sekolah Dasar'),
(10, 'Jurnal Pengabdian Masyarakat Ilmu Keguruan dan Pendidikan (JPM-IKP)'),
(11, 'JISA (Jurnal Informatika dan Sains)'),
(12, 'E-Prosiding Akuntansi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `views`
--

CREATE TABLE `views` (
  `id_views` int(11) NOT NULL,
  `id_info_doc` int(11) NOT NULL,
  `id_jurnal` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `jml` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `views`
--

INSERT INTO `views` (`id_views`, `id_info_doc`, `id_jurnal`, `judul`, `jml`) VALUES
(20, 35, 0, 'asdareawefasd', 8),
(21, 34, 0, 'test wahidun 2adsdasdasd', 3),
(22, 33, 0, 'Increasing Corporate Competitive Advantages  in Customer Loyalty Using Electronic  Applications Laun', 9),
(23, 30, 0, 'test zip gasi', 1);

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
(1, '<p><strong>VISI</strong></p>\r\n\r\n<p>Menjadi Fakultas Ekonomi dan Bisnis yang inovatif dengan mengembangkan Keteknopreneuran, Kolaborasi, dan Kemandirian berdasarkan nilai-nilai Pancasila pada Tahun 2027</p>\r\n\r\n<p><strong>MISI</strong></p>\r\n\r\n<ol>\r\n	<li>Menyelenggarakan pendidikan inovatif di Bidang Ekonomi dan Bisnis dengan basis Teknopreneur, Kolaborasi, dan Kemandirian dalam lingkungan ekonomi biru berlandaskan nilai-nilai Pancasila, serta mampu berkontribusi pada pembangunan nasional yang berkelanjutan</li>\r\n	<li>Melaksanakan penelitian guna mengembangkan pengetahuan dalam Bidang Ilmu Ekonomi dan Bisnis</li>\r\n	<li>Melaksanakan pengabdian kepada masyarakat guna memberikan kontribusi pada pembangunan nasional yang berkelanjutan sehingga dapat meningkatkan kesejahteraan masyarakat</li>\r\n	<li>Melaksanakan tata kelola penyelenggaraan pendidikan tinggi di Fakultas Ekonomi dan Bisnis secara transparan, akuntanbel, bertanggungjawab, independen, dan berkeadilan</li>\r\n</ol>\r\n', 1),
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
-- Indeks untuk tabel `data_file_project`
--
ALTER TABLE `data_file_project`
  ADD PRIMARY KEY (`id_data_file`);

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
-- Indeks untuk tabel `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id_views`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_dokumen`
--
ALTER TABLE `data_dokumen`
  MODIFY `id_data_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT untuk tabel `data_file_project`
--
ALTER TABLE `data_file_project`
  MODIFY `id_data_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `info_doc`
--
ALTER TABLE `info_doc`
  MODIFY `id_info_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tipe_jurnal`
--
ALTER TABLE `tipe_jurnal`
  MODIFY `id_tipe_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `views`
--
ALTER TABLE `views`
  MODIFY `id_views` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id_vm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
