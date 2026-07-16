
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (1,'admin','admin','admin');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `balas_pesan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balas_pesan` (
  `id_balas` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_balas`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `balas_pesan` WRITE;
/*!40000 ALTER TABLE `balas_pesan` DISABLE KEYS */;
INSERT INTO `balas_pesan` VALUES (19,10,30,'hai, ada yang bisa kami bantu?','notyet','2023-10-22 13:18:35'),(20,10,31,'boleh dong','notyet','2023-10-22 13:20:10'),(21,10,32,'iyaa, gimana?','notyet','2023-11-05 17:24:18');
/*!40000 ALTER TABLE `balas_pesan` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `gejala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL AUTO_INCREMENT,
  `kd_gejala` varchar(5) NOT NULL,
  `kd_penyakit` varchar(5) NOT NULL,
  `nama_gejala` text NOT NULL,
  `cf_pakar` decimal(3,2) NOT NULL DEFAULT 0.80,
  PRIMARY KEY (`id_gejala`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `gejala` WRITE;
/*!40000 ALTER TABLE `gejala` DISABLE KEYS */;
INSERT INTO `gejala` VALUES (1,'G01','K01','Mengalami Perubahan Emosi',0.80),(2,'G02','K01','Lelah',0.70),(3,'G03','K01','Sedih',0.60),(4,'G04','K02','Penurunan Minat Dalam Aktivitas yang Biasanya Dinikmati',0.55),(5,'G05','K02','Memiliki Gagasan Tentang Rasa Bersalah atau Tidak Berguna',0.80),(6,'G06','K02','Ketidakpercayaan Pada Diri Sendiri atau Kurang nya Rasa Harga Diri',0.70),(7,'G07','K02','Gangguan Tidur ',0.70),(8,'G08','K02','Gangguan Pola Makan',0.80),(9,'G09','K03','Mengalami Gangguan Kesehatan',0.50),(10,'G10','K03','Memiliki Perasaan Lelah yang Mendalam',0.75),(11,'G11','K03','Hilang nya Minat Dalam Aktivitas Sosial',0.80),(12,'G12','K03','Memiliki Perasaan Putus Asa atau Ingin Mengakhiri Hidup',1.00),(16,'G13','K03','Memiliki Pandangan Masa Depan yang Suram atau Pesimis',0.80),(20,'G14','K03','Mengalami Waham atau Halusinasi',0.80);
/*!40000 ALTER TABLE `gejala` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `hasil_konsultasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hasil_konsultasi` (
  `id_hasilkonsultasi` int(11) NOT NULL AUTO_INCREMENT,
  `no_konsul` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `kd_penyakit` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cf1` double NOT NULL,
  `cf2` double NOT NULL,
  `cf3` double NOT NULL,
  `cf4` double NOT NULL,
  `max` double NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id_hasilkonsultasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `hasil_konsultasi` WRITE;
/*!40000 ALTER TABLE `hasil_konsultasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `hasil_konsultasi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `konsultasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT,
  `no_konsul` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `kd_gejala` varchar(5) NOT NULL,
  `cf` double NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_konsultasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `konsultasi` WRITE;
/*!40000 ALTER TABLE `konsultasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `konsultasi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(15) NOT NULL,
  `jk` varchar(6) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL DEFAULT '0000-00-00',
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (4,'doromerouno','pria','doromerouno','1999-01-01','doromerouno','doromerouno'),(10,'admin','pria','jakarta','1999-06-04','admin','admin'),(11,'ilham','pria','cogreg','1998-01-01','ilham','ilham');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `penyakit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penyakit` varchar(5) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `penanggulangan` text NOT NULL,
  PRIMARY KEY (`id_penyakit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `penyakit` WRITE;
/*!40000 ALTER TABLE `penyakit` DISABLE KEYS */;
INSERT INTO `penyakit` VALUES (1,'K01','Depresi Sandwich Generation Rendah','Mengalami depresi dalam Sandwich Generation tingkatan rendah','Melakukan aktifitas atau kegiatan positif<br />menjaga komunikasi, serta jaga Kesehatan fisik dan pikiran.'),(2,'K02','Depresi Sandwich Generation Sedang','Mengalami depresi dalam Sandwich Generation dengan tingkatan sedang','Tentukan makna dan tujuan hidup, lakukan <br />komunikasi dengan teman terdekat atau keluarga lain, dan imbangi dengan aktifitas positif.'),(3,'K03','Depresi Sandwich Generation Berat','Mengalami depresi dalam Sandwich Generation dengan tingkatan Berat','Jangan ragu untuk berbicara dengan keluarga <br>atau teman terdekat tentang apa yang anda  alami mereka dapat memberikan dukungan  emosional <br />yang sangat dibutuhkan.Dan ingatlah, untuk merawat diri sendiri. Sisihkan waktu untuk istirahat, <br />aktivitas menyenangkan yang positif dan olahraga, banyak beribadah dan bertaqwa pada tuhan YME. <br />Jika saran sudah coba dilakukan tetapi belum berdampak pada depresi silahkan, datang ke psikologi <br /> untuk konsultasi atau terapi  secara langsung');
/*!40000 ALTER TABLE `penyakit` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pesanm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesanm` (
  `id_pesanm` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_balas` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_pesanm`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pesanm` WRITE;
/*!40000 ALTER TABLE `pesanm` DISABLE KEYS */;
INSERT INTO `pesanm` VALUES (30,10,0,'halo','ok','2023-10-22 13:17:59'),(31,10,0,'mau tanya boleh dok?','ok','2023-10-22 13:19:55'),(32,10,0,'haii dok','ok','2023-11-05 17:24:03');
/*!40000 ALTER TABLE `pesanm` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

