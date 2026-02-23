-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 10:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pernikahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `terbit` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `alias`, `terbit`) VALUES
(54, 'Maningkir Tangga  dan Paulak Une', 'Maningkir Tangga  dan Paulak Une', '1'),
(55, 'Mangulosi', 'Mangulosi', '1'),
(56, 'Manjalo Tumpak', 'Manjalo Tumpak', '1'),
(59, 'Memasuki Gedung Pesta  ', 'Memasuki Gedung Pesta  ', '1'),
(60, 'Manjalo Pasu-pasu Parbagason ', 'Manjalo Pasu-pasu Parbagason ', '1'),
(61, 'Marsibuha-buhai  ', 'Marsibuha-buhai  ', '1'),
(62, 'Martonggo Raja  ', 'Martonggo Raja  ', '1'),
(63, 'Martumpol ', 'Martumpol ', '1'),
(64, ' Marhata Sinamot', 'Marhata Sinamot', '1'),
(65, 'Patua Hata dan Marhusip', 'Patua Hata dan Marhusip', '1'),
(66, ' Marhori-hori dinding ', 'Marhori-hori dinding', '1');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id` int(5) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Tax` varchar(100) NOT NULL,
  `Isi` varchar(255) NOT NULL,
  `Link` varchar(100) NOT NULL,
  `Tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id`, `Nama`, `Tax`, `Isi`, `Link`, `Tipe`) VALUES
(2, 'yyyyyyyyyyyyyyy', 'yyyyy', 'yyyyyy', 'localhost/pernikahan/Gabe Horas', 'konfigurasi');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_kontak`
--

CREATE TABLE `pesan_kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('Baru','Dibalas') NOT NULL,
  `balasan` text NOT NULL,
  `tanggal_balasan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan_kontak`
--

INSERT INTO `pesan_kontak` (`id`, `nama`, `email`, `pesan`, `tanggal`, `status`, `balasan`, `tanggal_balasan`) VALUES
(15, 'zzzzzzzzz', 'zzzz@gmail.com', 'cccccccccc', '2024-08-29 21:19:04', 'Dibalas', 'zzzzzzzzz', '2024-08-30 02:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `prosesi`
--

CREATE TABLE `prosesi` (
  `id` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `updateby` varchar(50) NOT NULL,
  `viewnum` varchar(20) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `terbit` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prosesi`
--

INSERT INTO `prosesi` (`id`, `judul`, `kategori`, `isi`, `gambar`, `tanggal`, `updateby`, `viewnum`, `post_type`, `terbit`) VALUES
(56, 'Tahap Marhori-hori dinding', 'Marhori-hori dinding', '<p>Marhori-hori Dinding adalah salah satu prosesi dalam rangkaian upacara adat pernikahan Batak Toba. Marhori-hori dinding merupakan tahapan di mana keluarga calon pengantin pria datang ke rumah calon pengantin wanita untuk membicarakan secara informal rencana pernikahan mereka.&nbsp;Tujuannya adalah untuk memastikan bahwa kedua belah pihak sudah sepakat dan siap untuk melanjutkan ke tahap pernikahan yang lebih formal.<br></p>', 'photo/Tahap_Marhori_hori_dinding.png', '2024-08-30 08:00:13', 'admin', '8', 'prosesi', '1'),
(57, 'Tahap Patua Hata/Marhusip', 'Patua Hata dan Marhusip', '<p><span style=\"font-weight: bold;\">&nbsp; &nbsp; &nbsp; &nbsp;<span style=\"font-weight: normal;\">Patua Hata</span></span> atau Marhusip adalah salah satu tahap dalam proses adat pernikahan Batak Toba yang penting sebelum upacara pernikahan dilangsungkan. Tahap ini dikenal sebagai tahap negosiasi secara tertutup dan informal antara kedua keluarga, terutama mengenai hal-hal yang berhubungan dengan mahar (Sinamot), adat, dan hal-hal penting lainnya terkait pernikahan.&nbsp;</p><p><span style=\"font-size: 1.25rem;\">&nbsp; &nbsp; &nbsp; &nbsp;Setelah kesepakatan tercapai pada tahap Marhusip, barulah kedua keluarga akan melanjutkan ke tahap perundingan yang lebih besar dan terbuka, yaitu </span><span style=\"font-size: 1.25rem;\">Marhata Sinamot</span><span style=\"font-size: 1.25rem;\">, di mana kesepakatan yang sudah dicapai dalam Marhusip diumumkan kepada keluarga besar dan masyarakat.</span></p>', 'photo/Tahap_Patua_Hata_Marhusip.png', '2024-08-28 07:27:23', 'admin', '4', 'prosesi', '1'),
(59, 'Tahap Martumpol', 'Martumpol ', '<p>Martumpol adalah salah satu tahapan penting dalam upacara adat pernikahan Batak Toba. Martumpol merupakan prosesi pertunangan atau pemberkatan janji nikah di gereja, yang biasanya dilakukan beberapa minggu sebelum upacara pernikahan adat. Pada upacara Martumpol, pasangan calon pengantin secara resmi mengumumkan niat mereka untuk menikah di hadapan keluarga besar, masyarakat, dan gereja.<br></p>', 'photo/Martumpol.png', '2024-08-19 14:16:37', 'admin', '2', 'prosesi', '1'),
(60, ' Tahap Martonggo Raja/ marria raja ', 'Martonggo Raja  ', '<p>Martonggo Raja atau Marria Raja adalah salah satu tahap penting dalam upacara pernikahan adat Batak Toba. Pada tahap ini, keluarga besar dari kedua belah pihak (pihak mempelai pria dan wanita) berkumpul untuk membahas dan mempersiapkan seluruh rangkaian acara adat pernikahan. Pertemuan ini dikenal juga dengan istilah \"musyawarah adat.\"</p><p>Martonggo Raja biasanya dihadiri oleh tokoh-tokoh adat, para tetua (raja), serta perwakilan keluarga besar. Pada tahap ini, mereka akan membicarakan dan memutuskan hal-hal penting seperti:</p><ol><li>Waktu dan tempat pelaksanaan acara adat pernikahan.</li><li>Tata cara dan urutan upacara adat yang akan dilaksanakan.</li><li>Pembagian tugas dan peran dalam pelaksanaan adat (misalnya siapa yang akan menjadi juru bicara, penyelenggara, dll.).</li><li>Pembahasan Sinamot (mahar) yang telah disepakati pada tahap sebelumnya, serta pembagian adat.</li><li>Jumlah tamu undangan dan pihak-pihak yang terlibat dalam upacara adat.</li></ol><p><br></p><p>Tahap ini bertujuan untuk memastikan bahwa segala persiapan teknis dan adat telah dipersiapkan dengan matang sehingga upacara adat pernikahan dapat berjalan dengan lancar sesuai dengan tradisi Batak Toba.<br></p>', 'photo/_Tahap_Martonggo_Raja__marria_raja_.png', '2024-08-19 14:16:55', 'admin', '1', 'prosesi', '1'),
(61, 'Tahap Manjalo Pasu-pasu Parbagason  ', 'Manjalo Pasu-pasu Parbagason ', '<p>Tahap <strong>Manjalo Pasu-pasu Parbagason</strong> dalam adat pernikahan Batak Toba adalah upacara pemberian berkat (pasu-pasu) kepada pengantin oleh para pemuka adat, tetua, dan keluarga. Tahap ini sangat penting karena menandai bahwa pasangan pengantin telah menerima restu dan doa dari keluarga dan masyarakat untuk kehidupan baru mereka sebagai suami istri.<br></p>', 'photo/Tahap_Manjalo_Pasu_pasu_Parbagason__.png', '2024-08-16 19:29:04', 'admin', '0', 'prosesi', '1'),
(62, 'Tahap Memasuki Gedung Pesta', 'Memasuki Gedung Pesta  ', '<p>Tahap Memasuki Gedung Pesta adalah bagian dari rangkaian prosesi pernikahan adat Batak Toba yang memiliki makna simbolis dan seremonial. Pada tahap ini, pasangan pengantin bersama keluarga besar mereka memasuki gedung pesta atau tempat resepsi pernikahan. Momen ini menandakan dimulainya acara resepsi pernikahan secara resmi dan diiringi dengan berbagai adat istiadat yang khas.<br></p>', 'photo/Tahap_Memasuki_Gedung_Pesta.png', '2024-08-19 14:17:05', 'admin', '1', 'prosesi', '1'),
(65, 'Tahap Manjalo Tumpak', 'Manjalo Tumpak', '<p>Manjalo Tumpak adalah tahap dalam upacara pernikahan adat Batak Toba yang mencakup ritual pengucapan selamat dan doa dari keluarga besar dan masyarakat kepada pasangan pengantin.</p><p>Berikut adalah elemen-elemen utama dari Manjalo Tumpak:</p><ol><li><p>Ucapan Selamat dan Doa: Pada tahap ini, pasangan pengantin menerima ucapan selamat dan doa dari keluarga besar dan tetua adat. Ucapan ini biasanya disampaikan dalam bentuk kata-kata yang mengandung harapan dan doa agar pasangan pengantin menjalani kehidupan pernikahan yang bahagia dan sejahtera.</p></li><li><p>Tumpak: Dalam konteks adat Batak Toba, \"tumpak\" bisa merujuk pada pemberian benda atau hadiah simbolis kepada pengantin sebagai tanda ucapan selamat dan berkat. Hadiah ini seringkali berupa barang-barang tradisional atau makanan khas yang memiliki makna khusus dalam budaya Batak.</p></li><li><p>Pemberian Berkat: Selain ucapan selamat, pemberian berkat juga dilakukan. Ini bisa berupa doa-doa adat yang dipanjatkan oleh para pemuka adat atau tetua untuk memastikan agar pasangan pengantin mendapatkan kebahagiaan dan keberkahan dalam hidup baru mereka.</p></li><li><p>Tradisi dan Simbolisme: Tahap ini biasanya diiringi dengan ritual adat seperti pemakaian ulos (kain tradisional Batak) atau simbol adat lainnya. Pemberian ulos, misalnya, merupakan simbol perlindungan dan restu dari keluarga dan leluhur.</p></li><li><p>Keterlibatan Keluarga dan Masyarakat: Manjalo Tumpak melibatkan keterlibatan aktif dari keluarga besar dan masyarakat sekitar dalam merayakan pernikahan. Ini merupakan momen penting di mana semua pihak bersatu untuk memberikan dukungan dan doa terbaik kepada pasangan pengantin.</p></li></ol><p>Manjalo Tumpak adalah momen yang sangat berarti dalam adat pernikahan Batak Toba, karena menegaskan dukungan dan restu dari keluarga dan masyarakat kepada pasangan pengantin, serta mengokohkan ikatan mereka dalam komunitas dan adat.</p>', 'photo/Tahap_Manjalo_Tumpak.png', '2024-08-30 08:01:39', 'admin', '1', 'prosesi', '1'),
(67, 'Tahap Maningkir Tangga dan Paulak Une', 'Maningkir Tangga  dan Paulak Une', '<ol><li><span style=\"font-size: 1.25rem;\">Maningkir Tangga</span><span style=\"font-size: 1.25rem;\"> adalah tahap di mana pengantin, biasanya pengantin wanita, diangkat atau \"dinaikkan\" ke atas tangga yang telah disiapkan. Dalam konteks adat Batak Toba, proses ini melambangkan transisi atau perubahan status dari seorang gadis menjadi seorang istri.</span><br></li><li><span style=\"background-color: rgb(255, 255, 255);\">Simbol Perubahan Status: Maningkir Tangga merupakan simbol bahwa pengantin wanita telah siap memasuki fase baru dalam hidupnya sebagai istri dan bagian dari keluarga baru.</span></li><li><span style=\"background-color: rgb(255, 255, 255);\">Proses: Pengantin wanita biasanya akan diangkat atau dipandu menaiki tangga oleh anggota keluarga atau tetua adat, yang melambangkan penerimaan dan dukungan mereka terhadap perubahan tersebut.</span></li><li><span style=\"background-color: rgb(255, 255, 255);\"><br></span>Makna: Proses ini melambangkan bahwa pengantin wanita akan memasuki kehidupan rumah tangga yang baru dengan dukungan dan restu dari keluarga besar.</li></ol><h3><br></h3><p><span style=\"background-color: rgb(255, 255, 255);\">Paulak Une adalah tahap di mana pengantin, biasanya pengantin pria, melakukan prosesi kembali ke rumah orang tua setelah acara pernikahan atau sebagai bagian dari upacara penutup.</span></p><ul><li><span style=\"background-color: rgb(255, 255, 255);\">Kembali ke Rumah Orang Tua: Paulak Une berarti \"kembali\" dan sering kali melibatkan pengantin pria yang kembali ke rumah orang tua untuk beberapa waktu setelah upacara pernikahan.</span></li><li><span style=\"background-color: rgb(255, 255, 255);\">Simbol Kesatuan Keluarga: Prosesi ini melambangkan bahwa meskipun pengantin pria sudah menikah, dia tetap menjaga hubungan yang baik dan keharmonisan dengan keluarga orang tuanya.</span></li><li><span style=\"background-color: rgb(255, 255, 255);\">Acara Penutup: Paulak Une sering kali merupakan bagian dari penutup upacara pernikahan, di mana pengantin pria kembali untuk menerima restu terakhir atau melakukan ritual penutup.</span></li></ul>', 'photo/Tahap_Maningkir_Tangga_dan_Paulak_Une.png', '2024-08-19 14:16:12', 'admin', '4', 'prosesi', '1'),
(68, 'Tahap Marhata Sinamot', 'Marhata Sinamot', '<p>Marhata Sinamot adalah salah satu tahap penting dalam upacara pernikahan adat Batak Toba. Pada tahap ini, keluarga calon mempelai pria dan wanita berkumpul untuk secara resmi membahas dan menyepakati Sinamot, yaitu mahar atau harta yang akan diberikan oleh pihak pria kepada pihak wanita sebagai syarat pernikahan.</p><p>Tahapan Marhata Sinamot biasanya dilakukan setelah tahap Marhusip, di mana pembicaraan informal dan awal mengenai Sinamot sudah dilakukan. Dalam Marhata Sinamot, pembicaraan berlangsung lebih terbuka dengan melibatkan lebih banyak pihak, termasuk keluarga besar dan para tokoh adat.</p>', 'photo/Tahap_Marhata_Sinamot_1724997648.png', '2024-08-30 08:01:00', 'admin', '1', 'prosesi', '1'),
(69, 'Tahap Marsibuha-buhai', 'Marsibuha-buhai  ', '<p>Marsibuha-buhai dalam konteks makan bersama adalah sebuah tradisi di mana keluarga besar kedua mempelai, beserta para undangan, berkumpul untuk mengawali acara pernikahan dengan makan bersama. Momen ini biasanya dilakukan pada awal prosesi adat sebagai simbol kebersamaan dan ucapan syukur kepada Tuhan atas keberlangsungan acara.<br></p>', 'photo/Tahap_Marsibuha_buhai.png', '2024-08-30 08:01:26', 'admin', '3', 'prosesi', '1'),
(79, 'Tahap Pasahatton Tudu-tudu Sipanganon', 'Pasahat Tudu-tudu Sipanganon  ', '', 'photo/Tahap_Pasahatton_Tudu_tudu_Sipanganon_1723868343.png', '2024-08-17 06:19:03', 'admin', '3', 'prosesi', '1'),
(80, 'Tahap Mangulosi', 'Mangulosi', 'Mangulosi adalah tahap dalam upacara pernikahan adat Batak Toba yang sangat penting dan penuh makna. Pada tahap ini, pasangan pengantin menerima ulos, yaitu kain tenun tradisional Batak, yang diberikan oleh keluarga dan tetua adat. Ulos ini merupakan simbol dari restu, perlindungan, dan harapan baik untuk kehidupan baru pasangan pengantin.\r\n', 'photo/Tahap_Mangulosi_1723868413.png', '2024-08-19 14:14:22', 'admin', '6', 'prosesi', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `Nama` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `email`, `Nama`, `username`, `password`) VALUES
(9, 'revaldy@gmail.com', 'Revaldy Jules', 'revaldy', '123'),
(20, 'julesrevaldy@gmail.com', 'Revaldy Jules Marasi Manalu', 'Manalu', '555'),
(23, 'admin@gmail.com', 'admin', 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prosesi`
--
ALTER TABLE `prosesi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prosesi`
--
ALTER TABLE `prosesi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
