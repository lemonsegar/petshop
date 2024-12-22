/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.28-MariaDB : Database - dbpetshop2200006
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbpetshop2200006` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `dbpetshop2200006`;

/*Table structure for table `layanan` */

DROP TABLE IF EXISTS `layanan`;

CREATE TABLE `layanan` (
  `id_layanan` char(7) NOT NULL,
  `nama_layanan` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_layanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `layanan` */

insert  into `layanan`(`id_layanan`,`nama_layanan`,`deskripsi`,`harga`) values ('L001','Layanan Konsultasi','Konsultasi umum selama 1 jam',250000),('L002','Perawatan Medis','Perawatan medis ringan',500000),('L003','Layanan Kesehatan','Pemeriksaan kesehatan lengkap',750000);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(7) NOT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `no_telfon` char(15) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`nama_pelanggan`,`alamat`,`no_telfon`,`tanggal`) values ('P-001','hana','padang','08273827','2024-11-09'),('P-002','hanani','padang','08273827','2024-11-11');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id_produk` char(7) NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`id_produk`,`nama_produk`,`kategori`,`stok`,`harga`) values ('P001','whicas tuna 1 kg','makanan kucing',100,71000),('P002','Royal Canin Recovery sachet 50 gr','makanan kucing',50,35000),('P003','cat choize kuning 1 kg','makanan kucing',100,25000),('P004','kalung','berantai',10,25000);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` char(7) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`email`,`level`) values ('U001','jane','$2y$10$fQNcl6tX8HHs7O.4N7LfduNZ1Gs75H8a8dRkxMAuITq67m4WmufJ2','jane@gmail.com',1),('U002','alda','$2y$10$fQNcl6tX8HHs7O.4N7LfduNZ1Gs75H8a8dRkxMAuITq67m4WmufJ2','alda@gmail.com',2),('U003','halim','$2y$10$tvrPRldf7XBzY1Odn0Ai9OzHCzvJy/1e38l4v/5AR7j/DiCmi5V.G','halim@gmail.com',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
