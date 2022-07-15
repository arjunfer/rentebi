-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 01:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentcar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id_activity` int(11) NOT NULL,
  `user_activity` int(11) NOT NULL,
  `date_activity` date NOT NULL,
  `time_activity` time NOT NULL,
  `activity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id_activity`, `user_activity`, `date_activity`, `time_activity`, `activity`) VALUES
(17, 15, '2022-02-24', '06:45:03', 'Menambah data biaya'),
(18, 15, '2022-02-24', '06:45:46', 'Menambah data biaya'),
(19, 15, '2022-02-24', '06:46:05', 'Menambah data biaya'),
(20, 15, '2022-02-24', '06:52:25', 'Mengubah data management user'),
(24, 16, '2022-03-12', '06:40:03', 'Delete Activity'),
(25, 16, '2022-03-18', '06:20:40', 'Meyelesaikan Nota dengan No Nota SW220310001'),
(26, 16, '2022-03-18', '06:46:42', 'Membuat Nota dengan No Nota SW220318003'),
(27, 16, '2022-03-18', '07:03:08', 'menginputkan detail nota'),
(28, 24, '2022-03-19', '12:31:19', 'Mengubah profil akun'),
(29, 24, '2022-03-19', '12:33:02', 'Mengubah profil akun'),
(30, 24, '2022-03-19', '12:33:07', 'Mengubah profil akun'),
(31, 24, '2022-03-24', '06:40:20', 'Membuat Nota dengan No Nota SW220324004'),
(32, 16, '2022-03-24', '06:51:31', 'menginputkan detail nota'),
(33, 16, '2022-03-24', '06:53:03', 'Meyelesaikan Nota dengan No Nota SW220324004');

-- --------------------------------------------------------

--
-- Table structure for table `detail_nota`
--

CREATE TABLE `detail_nota` (
  `id_detail` int(11) NOT NULL,
  `nota_id` int(11) NOT NULL,
  `biaya_id` int(11) NOT NULL,
  `harga_biaya` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_nota`
--

INSERT INTO `detail_nota` (`id_detail`, `nota_id`, `biaya_id`, `harga_biaya`, `qty`, `sub_total`) VALUES
(3, 2, 1, 40000, 1, 40000),
(4, 2, 3, 700000, 1, 700000),
(5, 5, 1, 40000, 1, 40000),
(6, 6, 1, 40000, 1, 40000),
(7, 7, 1, 40000, 1, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `mst_biaya`
--

CREATE TABLE `mst_biaya` (
  `id_biaya` int(11) NOT NULL,
  `nama_biaya` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `status_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_biaya`
--

INSERT INTO `mst_biaya` (`id_biaya`, `nama_biaya`, `nominal`, `status_biaya`) VALUES
(1, 'Overtime 1/2 jam', 40000, 1),
(2, 'Overtime 1 Jam', 70000, 1),
(3, 'Kerusakan Minor', 700000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_mobil`
--

CREATE TABLE `mst_mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` text NOT NULL,
  `warna_mobil` text NOT NULL,
  `tahun_mobil` int(11) NOT NULL,
  `jml_mobil` int(11) NOT NULL,
  `kapasitas_mobil` int(11) NOT NULL,
  `bbm` text NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `status_mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_mobil`
--

INSERT INTO `mst_mobil` (`id_mobil`, `nama_mobil`, `warna_mobil`, `tahun_mobil`, `jml_mobil`, `kapasitas_mobil`, `bbm`, `gambar`, `harga_sewa`, `status_mobil`) VALUES
(1, 'Daihatsu Xenia', 'Putih', 2019, 4, 7, 'Bensin', 'xenia3.jpg', 300000, 1),
(2, 'Isuzu ELF', 'Kuning', 2020, 5, 18, 'Solar', 'elf.jpg', 900000, 1),
(3, 'Mitsubishi Expander', 'Silver', 2020, 10, 7, 'Bensin', 'xpander.jpg', 350000, 1),
(4, 'Toyota Avanza', 'Putih', 2021, 1, 7, 'Bensin', 'avanza.jpeg', 300000, 1),
(5, 'Honda Jazz', 'Merah', 2019, 1, 5, 'Bensin', 'jazz.jpg', 350000, 1),
(6, 'Toyota Kijang Innova', 'Silver', 2017, 9, 7, 'Solar', 'inova.JPG', 450000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id_user` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL,
  `date_created` date NOT NULL,
  `image` text NOT NULL,
  `is_active` int(2) NOT NULL,
  `register` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id_user`, `nama`, `email`, `password`, `level`, `date_created`, `image`, `is_active`, `register`) VALUES
(15, 'Donny Kurniawan', 'admin@gmail.com', '$2y$10$1CGoPtKRjQXU.kjmLiIoueroxm6TSleJ8NjyIKTKeDzOqvmyJcYwW', 'Admin', '2022-02-22', 'avatar5.png', 1, NULL),
(16, 'Adonia Vincent N', 'user@gmail.com', '$2y$10$bPLw0rPYbJ/7B6IrsiNYGOUzvQKnufxymmfSWD6e9vx7tq81M6NTO', 'User', '2022-02-22', 'avatar04.png', 1, NULL),
(24, 'Ratna Damayanti', 'ratna@gmail.com', '$2y$10$zfcT62LdbgsBC62pTrh4tuG85lTtGHk1M1LE14ocfnWIrdHpAH1oe', 'Customer', '2022-03-19', 'avatar2.png', 1, 0),
(25, 'Arnold Jumangin', 'arnold@gmail.com', '$2y$10$vFGIoFtIqUytKZAQ2n70h.yv9dWFQ0hUEURpgMekZm8qXAk1J3Fpq', 'Customer', '2022-03-24', 'default.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(11) NOT NULL,
  `user_id_customer` int(11) NOT NULL,
  `nama_customer` text NOT NULL,
  `alamat_customer` text NOT NULL,
  `telp_customer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `user_id_customer`, `nama_customer`, `alamat_customer`, `telp_customer`) VALUES
(1, 24, 'Ratna Damayanti', 'Jl. Budi Haryo No 45', '08112818682');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nota`
--

CREATE TABLE `tb_nota` (
  `id_nota` int(11) NOT NULL,
  `tgl_nota` date NOT NULL,
  `no_nota` text NOT NULL,
  `user_id_nota` int(11) DEFAULT NULL,
  `nama_pelanggan` text NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `no_telp` text NOT NULL,
  `jaminan` text NOT NULL,
  `jml_sewa` int(11) NOT NULL,
  `tgl_sewa1` date NOT NULL,
  `tgl_sewa2` date NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `tot_bayar` int(11) NOT NULL,
  `status_nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nota`
--

INSERT INTO `tb_nota` (`id_nota`, `tgl_nota`, `no_nota`, `user_id_nota`, `nama_pelanggan`, `alamat_pelanggan`, `no_telp`, `jaminan`, `jml_sewa`, `tgl_sewa1`, `tgl_sewa2`, `mobil_id`, `tot_bayar`, `status_nota`) VALUES
(2, '2022-03-10', 'SW220310001', NULL, 'Adonia Vincent Natanael', 'Jl. Majela Raya no 112', '08995625604', 'STNK Motor', 1, '2022-03-10', '2022-03-11', 1, 300000, 0),
(5, '2022-03-12', 'SW220312002', NULL, 'Arnold Jumangin', 'Jl. Ambarukomo Plaza No 65 ', '08995625604', 'Sepeda Motor Supra 125', 3, '2022-03-13', '2022-03-16', 4, 900000, 0),
(6, '2022-03-18', 'SW220318003', NULL, 'Harjo Winangun', 'Jl. Sutra Dewa 14', '08995625604', 'STNK Motor', 2, '2022-03-18', '2022-03-19', 6, 900000, 1),
(7, '2022-03-24', 'SW220324004', 24, 'Ratna Damayanti', 'Jl. Budi Haryo No 45', '08112818682', 'Sepeda Motor Supra', 3, '2022-03-24', '2022-03-27', 2, 2700000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nota_selesai`
--

CREATE TABLE `tb_nota_selesai` (
  `id_nota_selesai` int(11) NOT NULL,
  `nota_id_sewa` int(11) NOT NULL,
  `nota_no_sewa` text NOT NULL,
  `tot_bayar_sewa` int(11) NOT NULL,
  `tot_bayar_tambahan` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nota_selesai`
--

INSERT INTO `tb_nota_selesai` (`id_nota_selesai`, `nota_id_sewa`, `nota_no_sewa`, `tot_bayar_sewa`, `tot_bayar_tambahan`, `grand_total`) VALUES
(2, 5, 'SW220312002', 900000, 40000, 940000),
(3, 2, 'SW220310001', 300000, 740000, 1040000),
(4, 7, 'SW220324004', 2700000, 40000, 2740000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activity`);

--
-- Indexes for table `detail_nota`
--
ALTER TABLE `detail_nota`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `mst_biaya`
--
ALTER TABLE `mst_biaya`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `mst_mobil`
--
ALTER TABLE `mst_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `tb_nota_selesai`
--
ALTER TABLE `tb_nota_selesai`
  ADD PRIMARY KEY (`id_nota_selesai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `detail_nota`
--
ALTER TABLE `detail_nota`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_biaya`
--
ALTER TABLE `mst_biaya`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_mobil`
--
ALTER TABLE `mst_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_nota`
--
ALTER TABLE `tb_nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_nota_selesai`
--
ALTER TABLE `tb_nota_selesai`
  MODIFY `id_nota_selesai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
