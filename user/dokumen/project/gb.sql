-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2021 pada 21.34
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
-- Database: `gb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id_bout` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `about_site` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id_bout`, `img`, `about_site`) VALUES
(1, 'logo.jfif', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum commodo purus ac elementum. Suspendisse sit amet imperdiet sapien. Suspendisse blandit hendrerit sagittis. Praesent tincidunt eget libero et aliquam. Curabitur consequat sapien lacus, in mattis leo ultrices eu. Curabitur sed cursus elit, et ultrices diam. Proin vel neque sed enim feugiat congue sit amet et dolor. Cras ac sem sed turpis bibendum blandit.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`id_akses`, `id_anggota`, `username`, `password`, `role`) VALUES
(1, 6, 'admin', 'admin', 'admin'),
(2, 1, 'agt1', 'agt1', 'anggota'),
(3, 2, 'agt2', 'agt2', 'anggota'),
(4, 3, 'agt3', 'agt3', 'anggota'),
(5, 4, 'agt4', 'agt4', 'anggota'),
(6, 5, 'agt5', 'agt5', 'anggota'),
(7, 7, 'test', '123', 'anggota'),
(8, 8, '', '', 'anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `umur` int(11) NOT NULL,
  `jk` varchar(5) NOT NULL,
  `alamat` text NOT NULL,
  `tumb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `umur`, `jk`, `alamat`, `tumb`) VALUES
(1, 'anggota1', 23, 'L', 'jaktim', 'Edit-Photoshop.jpg'),
(2, 'anggota2', 20, 'L', 'jawa timur', 'd4.jpg'),
(3, 'anggota3', 25, 'L', 'jaksel', ''),
(4, 'anggota 4', 19, 'P', 'jauh', ''),
(5, 'anggota5', 22, 'P', 'depok', ''),
(6, 'admin_gerombolanwoyo', 0, '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `carousel`
--

CREATE TABLE `carousel` (
  `id_carousel` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `caption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `carousel`
--

INSERT INTO `carousel` (`id_carousel`, `img`, `caption`) VALUES
(2, 'x.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vehicula, lectus id accumsan tincidunt, ex urna accumsan neque, id maximus risus massa id purus. Cras accumsan eleifend sem nec condimentum.'),
(3, 'g.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vehicula, lectus id accumsan tincidunt, ex urna accumsan neque, id maximus risus massa id purus. ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `id_dok` int(11) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `date` date NOT NULL,
  `preview` varchar(50) NOT NULL,
  `caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokumentasi`
--

INSERT INTO `dokumentasi` (`id_dok`, `id_akses`, `date`, `preview`, `caption`) VALUES
(6, 2, '2021-03-31', 'd2.jpg', 'Lorem Ipsum is simply dummy text of the printing a'),
(7, 2, '2021-03-31', 'd1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce condimentum tincidunt bibendum. Sed lobortis, ligula eu condimentum commodo, mi nisi maximus leo, mattis placerat risus elit a lorem.'),
(8, 3, '2021-03-31', 'd3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.'),
(9, 3, '2021-03-31', 'd4.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.'),
(10, 1, '2021-03-31', 'g.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.'),
(11, 1, '2021-03-31', 'x.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.'),
(12, 1, '2021-03-31', 'adsa.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.'),
(13, 1, '2021-03-31', 'qwe.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.'),
(14, 1, '2021-03-31', 're.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.'),
(15, 1, '2021-03-31', 'xx.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nibh velit, posuere et dui vitae, fringilla egestas tortor. Quisque felis odio, tincidunt eget dignissim non, efficitur eget lorem.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `id_info` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `judul` varchar(40) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`id_info`, `img`, `judul`, `isi`) VALUES
(1, 'info1.jpg', 'HARIIII INII 😘🤗 DI BALI YESS', '📆 : Kamis , 22 oct 2020\r\n⌚ : 19:00 wib s/d selesai\r\n.\r\n.\r\nJeje akan berdakwah bersama @pohontuacreatorium dan mas @bagusdwidanto\r\n.\r\n.\r\nSekiranya itu saja informasi yg dapat saya sampaikan 🙏🍓🍻\r\nSemoga barokah always yess 😘🍓🍻🙏\r\n.\r\nInfo lebih lanjut monggoh hub : @the_orchard_bali'),
(2, 'info2.jpg', 'Minfes Senada On Stage Vol 1 ', 'Jangan sampai kehabisan tiketnya!\r\nMari kita bergoyang bernyanyi bersama💃🏼💃🏼💃🏼\r\n.\r\nKhusus GEROMBOLANWOYOO dpt diskon tiket menjadi Rp32.400,-\r\n\r\nDengan kode :\r\n\"MUNGKEK BOLEH,SKIP JANGAN\"\r\n.\r\nUntuk informasi tiket bisa hubungi :\r\nWA : 0857-7690-6816 (April)\r\n.\r\n\r\nInfo lebih lanjut silahkan hub Instagram : @minfessenada'),
(3, 'info3.jpg', 'Stay healt and happiness', 'Menginformasikan bahwasanya gini dalam waktu yang sangat dekat jeje akan anu di daerah yang anu-kan\r\n\r\nInfo lebih lanjut masalah per-anu-annya langsung hub : 081387101051\r\n\r\nSemoga bisa berinteraksi dengan per-anu-an yang intim ini\r\n.\r\nSekiranya itu saja informasi yg dapat saya sampaikan 🙏🍻🍇🍓🍻\r\nSemoga barokah always yess 🙏\r\nSelamat jumpa 🌻\r\n.\r\n\r\nWoyoo selau dihati ❤ yomss 🍻');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parallax`
--

CREATE TABLE `parallax` (
  `id_parallax` int(11) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `parallax`
--

INSERT INTO `parallax` (`id_parallax`, `img`) VALUES
(1, 'jj.jpg'),
(2, 'logo.jfif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosmed`
--

CREATE TABLE `sosmed` (
  `id_sosmed` int(11) NOT NULL,
  `ig` varchar(50) NOT NULL,
  `fb` varchar(50) NOT NULL,
  `tw` varchar(50) NOT NULL,
  `pinterest` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sosmed`
--

INSERT INTO `sosmed` (`id_sosmed`, `ig`, `fb`, `tw`, `pinterest`) VALUES
(1, 'https://www.instagram.com/gerombolanwoyoo/', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id_bout`);

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id_carousel`);

--
-- Indeks untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`id_dok`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id_info`);

--
-- Indeks untuk tabel `parallax`
--
ALTER TABLE `parallax`
  ADD PRIMARY KEY (`id_parallax`);

--
-- Indeks untuk tabel `sosmed`
--
ALTER TABLE `sosmed`
  ADD PRIMARY KEY (`id_sosmed`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id_bout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id_carousel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `id_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `info`
--
ALTER TABLE `info`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `parallax`
--
ALTER TABLE `parallax`
  MODIFY `id_parallax` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sosmed`
--
ALTER TABLE `sosmed`
  MODIFY `id_sosmed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
