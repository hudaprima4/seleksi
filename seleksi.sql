--- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 03:56 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seleksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`id`, `nama`, `stok`, `harga`) VALUES
(1, 'nasi goreng abal2', 4, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `minuman`
--

CREATE TABLE `minuman` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `minuman`
--

INSERT INTO `minuman` (`id`, `nama`, `stok`, `harga`) VALUES
(1, 'kopi', 5, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(15) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `tanggal_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `no_pesanan`, `no_meja`, `tanggal_order`, `status`) VALUES
(3, 'stt', 13, '2019-02-26 06:55:07', 'Delive'),
(4, 'stt', 1, '2019-02-26 00:20:32', 'Ready');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_makanan`
--

CREATE TABLE `pesanan_makanan` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_makanan` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_makanan`
--

INSERT INTO `pesanan_makanan` (`id`, `id_pesanan`, `id_makanan`, `jumlah_pesan`) VALUES
(1, 3, 1, 2),
(2, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_minuman`
--

CREATE TABLE `pesanan_minuman` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_minuman` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_minuman`
--

INSERT INTO `pesanan_minuman` (`id`, `id_pesanan`, `id_minuman`, `jumlah_pesan`) VALUES
(1, 3, 1, 3),
(2, 4, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minuman`
--
ALTER TABLE `minuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_makanan`
--
ALTER TABLE `pesanan_makanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_minuman`
--
ALTER TABLE `pesanan_minuman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `minuman`
--
ALTER TABLE `minuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan_makanan`
--
ALTER TABLE `pesanan_makanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan_minuman`
--
ALTER TABLE `pesanan_minuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
