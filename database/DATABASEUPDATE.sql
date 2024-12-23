/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 8.0.30 : Database - dbpetshop2200006
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbpetshop2200006` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `dbpetshop2200006`;

/*Table structure for table `barang_keluar` */

DROP TABLE IF EXISTS `barang_keluar`;

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `id_pelanggan` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang_keluar`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barang_keluar` */

insert  into `barang_keluar`(`id_barang_keluar`,`no_faktur`,`tanggal`,`id_pelanggan`,`total_harga`,`keterangan`,`created_at`,`updated_at`) values 
(7,'BK202412230001','2024-12-23','P-001',120000.00,'Tes',NULL,NULL),
(8,'BK202412230002','2024-12-23','P-001',142000.00,'TES',NULL,NULL);

/*Table structure for table `barang_keluar_detail` */

DROP TABLE IF EXISTS `barang_keluar_detail`;

CREATE TABLE `barang_keluar_detail` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `id_barang_keluar` int NOT NULL,
  `id_produk` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_barang_keluar` (`id_barang_keluar`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `barang_keluar_detail_ibfk_1` FOREIGN KEY (`id_barang_keluar`) REFERENCES `barang_keluar` (`id_barang_keluar`),
  CONSTRAINT `barang_keluar_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barang_keluar_detail` */

insert  into `barang_keluar_detail`(`id_detail`,`id_barang_keluar`,`id_produk`,`jumlah`,`harga`,`subtotal`) values 
(7,7,'P002',2,35000.00,70000.00),
(8,7,'P004',2,25000.00,50000.00),
(9,8,'P001',2,71000.00,142000.00);

/*Table structure for table `barang_masuk` */

DROP TABLE IF EXISTS `barang_masuk`;

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `supplier` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_barang_masuk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barang_masuk` */

insert  into `barang_masuk`(`id_barang_masuk`,`no_faktur`,`tanggal`,`supplier`,`total_harga`,`keterangan`,`created_at`) values 
(1,'BM202412230001','2024-12-23','Tes',2010000.00,'tes','2024-12-23 12:09:50'),
(3,'BM202412230002','2024-12-23','Tes3',2000000.00,'Tes3','2024-12-23 12:33:02'),
(5,'BM202412230003','2024-12-23','TES',1420000.00,'TES','2024-12-23 15:50:08');

/*Table structure for table `barang_masuk_detail` */

DROP TABLE IF EXISTS `barang_masuk_detail`;

CREATE TABLE `barang_masuk_detail` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `id_barang_masuk` int DEFAULT NULL,
  `id_produk` char(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_barang_masuk` (`id_barang_masuk`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `barang_masuk_detail_ibfk_1` FOREIGN KEY (`id_barang_masuk`) REFERENCES `barang_masuk` (`id_barang_masuk`),
  CONSTRAINT `barang_masuk_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barang_masuk_detail` */

insert  into `barang_masuk_detail`(`id_detail`,`id_barang_masuk`,`id_produk`,`jumlah`,`harga`,`subtotal`) values 
(9,1,'P001',10,71000.00,710000.00),
(10,1,'P002',30,35000.00,1050000.00),
(11,1,'P004',10,25000.00,250000.00),
(22,3,'P004',80,25000.00,2000000.00),
(24,5,'P001',20,71000.00,1420000.00);

/*Table structure for table `layanan` */

DROP TABLE IF EXISTS `layanan`;

CREATE TABLE `layanan` (
  `id_layanan` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_layanan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_layanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `layanan` */

insert  into `layanan`(`id_layanan`,`nama_layanan`,`deskripsi`,`harga`) values 
('L001','Layanan Konsultasi','Konsultasi umum selama 1 jam',250000),
('L002','Perawatan Medis','Perawatan medis ringan',500000),
('L003','Layanan Kesehatan','Pemeriksaan kesehatan lengkap',750000);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pelanggan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telfon` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`nama_pelanggan`,`alamat`,`no_telfon`,`tanggal`) values 
('P-001','hana','padang','08273827','2024-11-09'),
('P-002','Muklis','Padang','0897791','2024-12-23');

/*Table structure for table `pelayanan` */

DROP TABLE IF EXISTS `pelayanan`;

CREATE TABLE `pelayanan` (
  `id_pelayanan` int NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_pelanggan` char(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pelayanan`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `pelayanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelayanan` */

insert  into `pelayanan`(`id_pelayanan`,`no_faktur`,`tanggal`,`id_pelanggan`,`total_harga`,`keterangan`,`created_at`,`updated_at`) values 
(2,'PL202412230001','2024-12-23','P-002',1250000.00,'Tes','2024-12-23 07:26:28','2024-12-23 07:26:28');

/*Table structure for table `pelayanan_detail` */

DROP TABLE IF EXISTS `pelayanan_detail`;

CREATE TABLE `pelayanan_detail` (
  `id_pelayanan_detail` int NOT NULL AUTO_INCREMENT,
  `id_pelayanan` int DEFAULT NULL,
  `id_layanan` char(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_pelayanan_detail`),
  KEY `id_pelayanan` (`id_pelayanan`),
  KEY `id_layanan` (`id_layanan`),
  CONSTRAINT `pelayanan_detail_ibfk_1` FOREIGN KEY (`id_pelayanan`) REFERENCES `pelayanan` (`id_pelayanan`),
  CONSTRAINT `pelayanan_detail_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelayanan_detail` */

insert  into `pelayanan_detail`(`id_pelayanan_detail`,`id_pelayanan`,`id_layanan`,`harga`,`subtotal`) values 
(4,2,'L003',750000.00,750000.00),
(5,2,'L002',500000.00,500000.00);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id_produk` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`id_produk`,`nama_produk`,`kategori`,`stok`,`harga`) values 
('P001','whicas tuna 1 kg','makanan kucing',128,71000),
('P002','Royal Canin Recovery sachet 50 gr','makanan kucing',78,35000),
('P003','cat choize kuning 1 kg','makanan kucing',100,25000),
('P004','kalung','berantai',98,25000);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` int DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`email`,`level`) values 
('U001','jane','$2y$10$fQNcl6tX8HHs7O.4N7LfduNZ1Gs75H8a8dRkxMAuITq67m4WmufJ2','jane@gmail.com',1),
('U002','alda','$2y$10$fQNcl6tX8HHs7O.4N7LfduNZ1Gs75H8a8dRkxMAuITq67m4WmufJ2','alda@gmail.com',2),
('U003','halim','$2y$10$tvrPRldf7XBzY1Odn0Ai9OzHCzvJy/1e38l4v/5AR7j/DiCmi5V.G','halim@gmail.com',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
