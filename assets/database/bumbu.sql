-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2015 at 12:25 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bumbu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `email`, `tgl_lahir`, `alamat`) VALUES
(1, 'Ahmad Ilham', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'ilham.ahmad14@gmail.com', '14 Juni 1992', 'Sayung, Demak');

-- --------------------------------------------------------

--
-- Table structure for table `cara`
--

CREATE TABLE IF NOT EXISTS `cara` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cara_bayar` text NOT NULL,
  `cara_pesan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cara`
--

INSERT INTO `cara` (`id`, `cara_bayar`, `cara_pesan`) VALUES
(1, '<p>Cara pembayaran dilakukan dengan sistem transfer melalui bank <strong>BRI</strong> atau<strong> BNI</strong>. Nomor rekening akan kami beritahukan pada saat sms konfirmasi kami kirimkan. Barang dikirimkan dengan jasa pengiriman JNE untuk luar kota&nbsp;dan kami akan mengirimkan langsung melalui pengirim kami khusus area <strong>Demak</strong> dan <strong>Semarang</strong>, harga yang tercantum pada produk belum termasuk ongkos kirim. Jika anda ingin tanya-tanya, atau ada barang yang anda inginkan tetapi tidak ada di website ini, jangan sungkan untuk menghubungi kami.</p>\r\n<p>Terima Kasih :)</p>', '<p>Cara berbelanja Bumbu di UD Sari Alam sangat mudah...</p>\r\n<p>Bacalah petunjuk di bawah ini dan Anda siap untuk berbelanja :)</p>\r\n<p>Terlebih dahulu Anda harus login, jika Anda belum mempunyai Akun silahkan klik<strong> Buat Akun</strong> pada menu halaman website ini. Klik pada tombol <strong>Tambah Ke Keranjang</strong> pada item yang ingin Anda beli dan isi jumlah berapa yang Anda inginkan pada <strong>Qty</strong>, untuk menghapus barang yang tidak jadi isi <strong>Qty</strong> dengan angka <strong>0 </strong>terus pilih<strong> Update</strong>, jika Anda sudah selesai memilih barang, klik &ldquo;<strong>check out</strong>&rdquo; Selanjutnya, Halaman terakhir adalah untuk pengecekan mengenai informasi pembelian dan total harga barang yang Anda beli. Order Anda telah kami terima. Tunggu konfirmasi dari kami.</p>\r\n<p>Selamat berbelanja !!!!!!!!!!!!!!!!!!!</p>');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, 'Bumbu Kering'),
(2, 'Bumbu Basah');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE IF NOT EXISTS `ongkir` (
  `id_ongkir` int(15) NOT NULL AUTO_INCREMENT,
  `kota` varchar(20) DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_ongkir`),
  KEY `kota` (`kota`),
  KEY `kota_2` (`kota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kota`, `biaya`) VALUES
(1, 'Semarang', 0.00),
(2, 'Demak', 0.00),
(3, 'Surabaya', 25000.00),
(4, 'Yogyakarta', 15000.00),
(5, 'Bandung', 30000.00),
(6, 'Pati', 20000.00),
(7, 'Jepara', 15000.00);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `nama`, `email`, `pesan`, `tgl`) VALUES
(10, 'Jati', 'ajn@gmail.com', 'Barangnya udah sampe gan makasih :)', '2015-12-15 14:45:18'),
(11, 'Fikroh Jamila', 'fjamila12@gmail.com', 'Bumbunya Mantaap', '2015-12-15 14:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `alamat_kirim` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tot_harga` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tgl_pesan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(25) DEFAULT NULL,
  `baca` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kota` (`kota`),
  KEY `id_produk` (`id_produk`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=262 ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(100) DEFAULT NULL,
  `harga` int(15) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `deskripsi`, `gambar`, `harga`) VALUES
(1, 2, 'Jahe', '-', 'bumbu95.jpg', 16000),
(2, 2, 'Cabe', '<p>-</p>', 'bumbu82.jpg', 20000),
(3, 2, 'Kunyit', '<p>-</p>', 'bumbu123.jpg', 7000),
(5, 2, 'Laos', '<p>-</p>', 'bumbu101.jpg', 7000),
(6, 2, 'Bawang Putih', '<p>-</p>', 'bumbu111.jpg', 19000),
(7, 1, 'Kayu Manis', '-', 'bumbuk43.jpg', 24000),
(8, 1, 'Kapou Logo', '-', 'bumbuk32.jpg', 100000),
(9, 1, 'Asam Kandis', '-', 'bumbuk21.jpg', 70000),
(10, 1, 'Pekak', '<p>-</p>', 'bumbuk11.jpg', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tanggal_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `telp`, `alamat`, `kota`, `email`, `username`, `password`, `tanggal_daftar`) VALUES
(13, 'Fikroh Jamila', '089898778998', 'Jogo gang 4 Gorawe Sayung Demak', 'Demak', 'fjamila12@gmail.com', 'jamila', '827ccb0eea8a706c4c34a16891f84e7b', '2015-12-01 12:51:52'),
(14, 'katon riwayanto', '089529588076', 'kudu baru rt08/07', 'Semarang', 'katonsamudra17@gmail.com', 'katon', 'bec7fb62e0c7123da1141cb00a05a42b', '2015-12-02 12:27:46');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`kota`) REFERENCES `ongkir` (`kota`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
