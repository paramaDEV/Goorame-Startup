-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 5.7.24-log - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk lomba_hackathon
CREATE DATABASE IF NOT EXISTS `lomba_hackathon` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lomba_hackathon`;

-- membuang struktur untuk table lomba_hackathon.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` int(11) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(300) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.admin: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.keranjang
CREATE TABLE IF NOT EXISTS `keranjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `ikan` varchar(50) NOT NULL DEFAULT '',
  `jumlah` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__user` (`id_user`),
  KEY `FK__mitra` (`id_mitra`),
  CONSTRAINT `FK__mitra` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id`),
  CONSTRAINT `FK__user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.keranjang: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `keranjang` DISABLE KEYS */;
/*!40000 ALTER TABLE `keranjang` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.komoditi
CREATE TABLE IF NOT EXISTS `komoditi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mitra` int(11) NOT NULL DEFAULT '0',
  `nama_ikan` varchar(50) NOT NULL DEFAULT '0',
  `status` enum('Tersedia','Sedang tidak tersedia') NOT NULL DEFAULT 'Tersedia',
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_komoditi_mitra` (`id_mitra`),
  CONSTRAINT `FK_komoditi_mitra` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.komoditi: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `komoditi` DISABLE KEYS */;
REPLACE INTO `komoditi` (`id`, `id_mitra`, `nama_ikan`, `status`, `stok`, `harga`, `gambar`) VALUES
	(4, 1, 'Kakap', 'Tersedia', 19, 28000, '603a79339a815.jpg'),
	(8, 1, 'Kerapu', 'Tersedia', 15, 28000, '60418e8713c7e.jpg'),
	(9, 2, 'Lele', 'Tersedia', 10, 15000, '604a12d279ad2.jpg');
/*!40000 ALTER TABLE `komoditi` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.kurir
CREATE TABLE IF NOT EXISTS `kurir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `tanggal_lahir` date NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `no_telp` varchar(50) NOT NULL DEFAULT '0',
  `alamat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.kurir: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `kurir` DISABLE KEYS */;
/*!40000 ALTER TABLE `kurir` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.mitra
CREATE TABLE IF NOT EXISTS `mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_usaha` varchar(150) NOT NULL DEFAULT '0',
  `nama_pemilik` varchar(50) NOT NULL DEFAULT '0',
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `jam_operasional` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bintang` int(11) DEFAULT '1',
  `tanggal_daftar` date DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `profile` varchar(50) DEFAULT NULL,
  `sampul` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.mitra: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `mitra` DISABLE KEYS */;
REPLACE INTO `mitra` (`id`, `nama_usaha`, `nama_pemilik`, `alamat`, `no_telepon`, `jam_operasional`, `email`, `bintang`, `tanggal_daftar`, `username`, `password`, `profile`, `sampul`) VALUES
	(1, 'Ikan Laut Mayangan Pak Aldebaran', 'Aldebaran', 'Jl Paus, Mayangan, Kota Probolinggo', '08314429091393', '08.00-17.00 WIB', 'mitra123@gmail.com', 5, '2021-02-21', 'mitra1', '$2y$10$zqpbiD0DZXddGFK1YAaq0O2/R0oxz7JaJPRirf9En/ltzN9nDjbzS', '604197c8decab.jpg', '604189bebc870.jpg'),
	(2, 'Ikan Air Tawar Pak Bayu', 'Bayu', 'Jl Cokroaminoto, Kanigaran, Kota Probolinggo', '086757577867', '08.00-18.00 WIB', 'bayureal@gmail.com', 4, '2021-03-01', 'bayu44', '$2y$10$zqpbiD0DZXddGFK1YAaq0O2/R0oxz7JaJPRirf9En/ltzN9nDjbzS', '60418b93e5be0.jpg', '603a04dd8ddba.jpg');
/*!40000 ALTER TABLE `mitra` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.pesanan
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `ikan` varchar(50) NOT NULL DEFAULT '',
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `biaya` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_pesanan_user` (`id_user`),
  KEY `FK_pesanan_mitra` (`id_mitra`),
  CONSTRAINT `FK_pesanan_mitra` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id`),
  CONSTRAINT `FK_pesanan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.pesanan: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.riwayat_mitra
CREATE TABLE IF NOT EXISTS `riwayat_mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mitra` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_riwayat_mitra_mitra` (`id_mitra`),
  CONSTRAINT `FK_riwayat_mitra_mitra` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.riwayat_mitra: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `riwayat_mitra` DISABLE KEYS */;
REPLACE INTO `riwayat_mitra` (`id`, `id_mitra`, `tanggal`, `item`, `jumlah`, `harga`) VALUES
	(1, 1, '2021-02-26', 'Kerapu', 2, 30000),
	(2, 1, '2021-03-06', 'Kepiting', 5, 10000),
	(3, 1, '2021-03-06', 'Lele', 4, 18000),
	(4, 1, '2021-03-07', 'Lele', 1, 15000);
/*!40000 ALTER TABLE `riwayat_mitra` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.riwayat_user
CREATE TABLE IF NOT EXISTS `riwayat_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `item` varchar(50) NOT NULL DEFAULT '',
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_riwayat_user_user` (`id_user`),
  CONSTRAINT `FK_riwayat_user_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.riwayat_user: ~8 rows (lebih kurang)
/*!40000 ALTER TABLE `riwayat_user` DISABLE KEYS */;
REPLACE INTO `riwayat_user` (`id`, `id_user`, `tanggal`, `item`, `jumlah`, `harga`) VALUES
	(1, 5, '2021-03-01', 'Lele', 3, 40000),
	(2, 5, '2021-03-10', 'Kerapu', 2, 56000),
	(3, 5, '2021-03-11', 'Kakap', 2, 56000),
	(4, 5, '2021-03-11', 'Kakap', 1, 28000),
	(5, 5, '2021-03-11', 'Lele', 1, 18000),
	(6, 5, '2021-03-11', 'Kakap', 1, 28000),
	(7, 5, '2021-03-11', 'Kerapu', 2, 56000),
	(8, 5, '2021-03-11', 'Lele', 2, 30000);
/*!40000 ALTER TABLE `riwayat_user` ENABLE KEYS */;

-- membuang struktur untuk table lomba_hackathon.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `kelamin` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `no_telepon` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `alamat` text,
  `level` enum('Bronze','Silver','Gold') NOT NULL DEFAULT 'Bronze',
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(350) NOT NULL DEFAULT '0',
  `profile` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel lomba_hackathon.user: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `nama`, `tanggal_lahir`, `tanggal_daftar`, `kelamin`, `no_telepon`, `email`, `alamat`, `level`, `username`, `password`, `profile`) VALUES
	(5, 'User', '2000-06-07', '2021-02-21', 'Laki-laki', '083144290139', 'user1@gmail.com', 'Jl Taman Cendana Indah no 3, Kota Probolinggo', 'Gold', 'user1', '$2y$10$FokWDQYRvwXRXYoTDBsNQea9NhefI7/VLX4b6OqBiglNPI3LEddYK', '603f8c1c7cd31.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- membuang struktur untuk trigger lomba_hackathon.hitung_stok
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `hitung_stok` AFTER INSERT ON `pesanan` FOR EACH ROW BEGIN
	UPDATE komoditi SET stok=stok-NEW.jumlah
	 WHERE id_mitra=NEW.id_mitra;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
