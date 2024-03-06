-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for laundry
CREATE DATABASE IF NOT EXISTS `laundry` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `laundry`;

-- Dumping structure for table laundry.detail_transaksi
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `harga_paket` int(11) DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_paket` (`id_paket`),
  KEY `foreign_transaksi` (`id_transaksi`),
  CONSTRAINT `foreign_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `foreign_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table laundry.detail_transaksi: ~4 rows (approximately)
INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `keterangan`, `harga_paket`, `total_harga`) VALUES
	(22, 23, 4, 10, 'Jangan memakai mesin cuci', 12000, 120000),
	(23, 24, 1, 1, '', 30000, 30000),
	(24, 24, 4, 5, '', 12000, 60000),
	(29, 27, 1, 4, '-', 30000, 120000);

-- Dumping structure for table laundry.member
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `telp` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table laundry.member: ~2 rows (approximately)
INSERT INTO `member` (`id`, `nama`, `alamat`, `kelamin`, `telp`) VALUES
	(1, 'Nyoman Bledor', 'Jl. Mawar', 'P', '089162547812'),
	(3, 'Putu Made', 'Jl. Melati 103', 'L', '089647686375');

-- Dumping structure for table laundry.outlet
CREATE TABLE IF NOT EXISTS `outlet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL DEFAULT '',
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table laundry.outlet: ~2 rows (approximately)
INSERT INTO `outlet` (`id`, `nama`, `alamat`, `telp`) VALUES
	(1, 'Sudriman Pusat Hassanudin', 'Jl. Melati', '612387612386'),
	(2, 'Pusat Ahmad Rafi', 'Jl. Melati No. 23', '9876478900');

-- Dumping structure for table laundry.paket
CREATE TABLE IF NOT EXISTS `paket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_outlet` int(11) DEFAULT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') DEFAULT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_forPaket_outlet` (`id_outlet`),
  CONSTRAINT `foreign_forPaket_outlet` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table laundry.paket: ~2 rows (approximately)
INSERT INTO `paket` (`id`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
	(1, 1, 'selimut', 'Hemat Modar', '30000'),
	(4, 1, 'bed_cover', 'Fast Hand', '12000');

-- Dumping structure for table laundry.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_outlet` int(11) DEFAULT NULL,
  `kode_invoice` varchar(100) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `biaya_tambahan` int(11) unsigned DEFAULT NULL,
  `diskon` double unsigned DEFAULT NULL,
  `pajak` int(11) unsigned DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `status` enum('baru','proses','selesai','diambil') DEFAULT NULL,
  `dibayar` enum('dibayar','belum_bayar') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_forTransaksi_outlet` (`id_outlet`) USING BTREE,
  KEY `foreign_member` (`id_member`),
  KEY `foreign_user` (`id_user`),
  CONSTRAINT `foreign_forTransaksi_outlet` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `foreign_member` FOREIGN KEY (`id_member`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `foreign_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table laundry.transaksi: ~3 rows (approximately)
INSERT INTO `transaksi` (`id`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `deadline`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `kembalian`, `status`, `dibayar`, `id_user`) VALUES
	(23, 1, '1001002240222074328', 1, '2024-02-22 07:43:28', '2024-02-24 14:30:00', '0000-00-00 00:00:00', 10000, 0, 1200, -161200, 'baru', 'belum_bayar', 2),
	(24, 1, '1001002240222075910', 1, '2024-02-22 07:59:10', '2024-02-29 11:00:00', '0000-00-00 00:00:00', 0, 0, 675, -90675, 'baru', 'belum_bayar', 2),
	(27, 1, '1001002240222080622', 1, '2024-02-22 08:06:22', '2024-02-24 12:00:00', '2024-02-23 22:50:12', 10000, 0, 975, 0, 'proses', 'dibayar', 2);

-- Dumping structure for table laundry.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `id_outlet` int(11) DEFAULT NULL,
  `role` enum('admin','kasir','owner') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_outlet` (`id_outlet`),
  CONSTRAINT `foreign_outlet` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table laundry.user: ~9 rows (approximately)
INSERT INTO `user` (`id`, `nama`, `username`, `password`, `id_outlet`, `role`) VALUES
	(2, 'admin', 'admin', '$2y$10$0n5LlFbd0fGVleWzA8HsyuoW2wLMyDFwzVbAgOB6PKPwa036lu73C', 1, 'admin'),
	(4, 'Manta Yuana', '12345', '$2y$10$ps26zhcvb0KPPPC6NwYMquIaIbY87lo/RInstN4eLFF651zVpkpGW', 1, 'kasir'),
	(5, 'Udin', 'Kasir1', '$2y$10$72Pu9ujYA/GcJi2ML/tI0ug6rWK470twaYUvTzKsrZXr9.v1AcsSW', 1, 'kasir'),
	(6, 'udin', 'udin', '$2y$10$HKESK6ZzICr0p.ZBmkuUsearn9VLaTh/QrDu4w4P8xNXTPMSXU/T6', 1, 'kasir'),
	(7, 'Ahmad Rafi', 'AhmadR', '$2y$10$rMw50oYuTuoYAyuNANLq3OuvOhV1JTjKMvMmR9TxC3QaU.GE/l2qq', 1, 'owner'),
	(8, 'Ahmad1', 'Ahmad3', '$2y$10$No.ZUZmtgtwqmKP/QbWVBuNzHcaLi6sNruz97KbBF.23ACNlsz6ju', 1, 'kasir'),
	(12, 'Nyoman Bledor', 'Kasir1', '$2y$10$POib/gz5OsNV8MIgM96eHeRzj0EkTEs4MlqkOrmK5uGw9ZjSmiw/K', 2, 'kasir'),
	(13, 'Kasir2', 'Kasir3', '$2y$10$I8bzlBS4biPDp53dJWqhDeQo0J9lRw3oQQg.x/n6Xg8vk4qwxng3q', 1, 'kasir'),
	(16, 'Made Nyoman', 'MNyo', '$2y$10$atx93UiHrYe83zq3sU/M7uMWGDi1y5g5WC9maOmp5WV3N8hOUGJGq', 1, 'kasir');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
