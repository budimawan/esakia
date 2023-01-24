-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 01:29 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_esakia`
--

-- --------------------------------------------------------

--
-- Table structure for table `rincian`
--

CREATE TABLE `rincian` (
  `rinci_id` int(11) NOT NULL,
  `rinci_skp_id` int(11) NOT NULL,
  `rinci_kegiatan` text NOT NULL,
  `rinci_target` double(10,2) NOT NULL DEFAULT 0.00,
  `rinci_realisasi` double(10,2) NOT NULL DEFAULT 0.00,
  `rinci_mutu` double(10,2) NOT NULL DEFAULT 0.00,
  `rinci_satuan` varchar(100) NOT NULL,
  `rinci_jumlah` double(10,2) NOT NULL DEFAULT 0.00,
  `rinci_koreksi` text NOT NULL DEFAULT 'tidak ada koreksi !'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rincian`
--

INSERT INTO `rincian` (`rinci_id`, `rinci_skp_id`, `rinci_kegiatan`, `rinci_target`, `rinci_realisasi`, `rinci_mutu`, `rinci_satuan`, `rinci_jumlah`, `rinci_koreksi`) VALUES
(62, 9, 'kegiatan 1', 12.00, 11.00, 80.00, 'perjalanan', 82.56, 'tidak ada koreksi !'),
(63, 9, 'kegitan 2', 6.00, 5.00, 80.00, 'fullboard', 79.78, 'tidak ada koreksi !'),
(64, 9, 'kegiatan 3', 6.00, 6.00, 80.00, 'laporan', 85.33, 'tidak ada koreksi !'),
(65, 27, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan\r\n', 4.00, 4.00, 80.00, 'Dokumen', 85.33, 'tidak ada koreksi !'),
(66, 27, 'Mengkoordinasikan Pemantauan, evaluasi dan pealaporan program strategis dan kegiatan pertanahan\r\n', 6.00, 6.00, 80.00, 'Laporan', 85.33, 'tidak ada koreksi !'),
(67, 28, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan\r\n', 4.00, 4.00, 90.00, 'Dokumen', 88.67, 'tidak ada koreksi'),
(68, 23, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan\r\n', 4.00, 4.00, 80.00, 'Dokumen', 85.33, 'tidak ada koreksi !'),
(69, 23, 'Mengkoordinasikan Pemantauan, evaluasi dan pealaporan program strategis dan kegiatan pertanahan\r\n', 6.00, 6.00, 80.00, 'Laporan', 85.33, 'tidak ada koreksi !'),
(70, 23, 'Melakukan upacara setiap hari senin', 48.00, 48.00, 80.00, 'Kegiatan', 85.33, 'tidak ada koreksi !'),
(91, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 1.00, 1.00, 80.00, 'Laporan', 85.33, 'tidak ada koreksi !'),
(92, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 2.00, 2.00, 90.00, 'Dokumen', 88.67, 'tidak ada koreksi !'),
(93, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 3.00, 3.00, 80.00, 'Kegiatan', 85.33, 'tidak ada koreksi !'),
(94, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 4.00, 4.00, 90.00, 'Laporan', 88.67, 'tidak ada koreksi !'),
(95, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 5.00, 5.00, 80.00, 'Kegiatan', 85.33, 'tidak ada koreksi !'),
(96, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 6.00, 6.00, 90.00, 'Dokumen', 88.67, 'tidak ada koreksi !'),
(97, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 7.00, 7.00, 80.00, 'Laporan', 85.33, 'tidak ada koreksi !'),
(98, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 8.00, 8.00, 90.00, 'Kegiatan', 88.67, 'tidak ada koreksi !'),
(99, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 9.00, 9.00, 90.00, 'Hasil', 88.67, 'tidak ada koreksi !'),
(100, 31, 'Memfasilitasi Penyusunan Rencana, Program dan Anggaran, serta pelaporan', 10.00, 9.00, 80.00, 'Hasil', 82.00, 'tidak ada koreksi !'),
(261, 30, 'qwqwe', 4.00, 4.00, 80.00, 'nn', 85.33, 'tidak ada koreksi !'),
(262, 30, 'qweqwe', 6.00, 6.00, 80.00, 'nn', 85.33, 'tidak ada koreksi !'),
(263, 30, 'qweqwe', 2.00, 2.00, 50.00, 'bb', 75.33, 'tidak ada koreksi !'),
(264, 30, 'qweqwe', 4.00, 4.00, 80.00, 'bb', 85.33, 'tidak ada koreksi !'),
(265, 30, 'qweqwe', 1.00, 1.00, 50.00, 'bb', 75.33, 'tidak ada koreksi !'),
(266, 30, 'qweqwe', 6.00, 6.00, 80.00, 'vv', 85.33, 'tidak ada koreksi !'),
(267, 30, 'qweqwe', 1.00, 1.00, 20.00, 'vv', 65.33, 'tidak ada koreksi !'),
(268, 30, 'qweqew', 6.00, 6.00, 80.00, 'vv', 85.33, 'tidak ada koreksi !'),
(269, 30, 'qweqwe', 2.00, 1.00, 80.00, 'vv', 68.67, 'tidak ada koreksi !'),
(270, 30, 'qweqew', 2.00, 1.00, 80.00, 'vv', 68.67, 'tidak ada koreksi !');

-- --------------------------------------------------------

--
-- Table structure for table `skp`
--

CREATE TABLE `skp` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `penilai_id` int(11) NOT NULL,
  `atasan_id` int(11) NOT NULL,
  `tgl_ajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `orientasi` double(10,2) NOT NULL,
  `integritas` double(10,2) NOT NULL,
  `komitmen` double(10,2) NOT NULL,
  `disiplin` double(10,2) NOT NULL,
  `kerjasama` double(10,2) NOT NULL,
  `kepemimpinan` double(10,2) NOT NULL,
  `status_skp` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0. Diajukan; 1. Valid; 2. Ilegal ',
  `nilai_total` double(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skp`
--

INSERT INTO `skp` (`id`, `pegawai_id`, `penilai_id`, `atasan_id`, `tgl_ajuan`, `orientasi`, `integritas`, `komitmen`, `disiplin`, `kerjasama`, `kepemimpinan`, `status_skp`, `nilai_total`) VALUES
(9, 2, 1, 0, '2021-09-24 13:00:40', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 82.56),
(23, 1, 2, 0, '2021-09-26 15:11:35', 85.00, 85.00, 82.00, 82.00, 82.00, 85.00, 0, 85.33),
(27, 10, 5, 0, '2021-09-28 03:21:15', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 85.33),
(28, 10, 5, 0, '2021-09-28 03:34:12', 82.00, 82.00, 82.00, 82.00, 82.00, 82.00, 2, 86.00),
(30, 1, 6, 5, '2021-09-30 15:16:15', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 78.00),
(31, 1, 7, 5, '2021-10-01 10:50:03', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 86.67);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `nama` varchar(268) NOT NULL DEFAULT '-',
  `nip` varchar(268) NOT NULL DEFAULT '-',
  `password` varchar(268) NOT NULL DEFAULT '-',
  `jabatan` varchar(268) NOT NULL DEFAULT '-',
  `pangkat_golongan` varchar(268) NOT NULL DEFAULT '-',
  `unit_kerja` varchar(268) NOT NULL DEFAULT '-',
  `nilai_kinerja` varchar(268) DEFAULT '-',
  `nilai_prilaku` varchar(268) DEFAULT '-',
  `nilai_prestasi` varchar(268) DEFAULT '-',
  `is_active` int(128) DEFAULT NULL,
  `role_id` int(128) DEFAULT NULL,
  `image` varchar(268) NOT NULL DEFAULT 'user2-160x160.jpg',
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `pendidikan` text NOT NULL DEFAULT 'belum_update_pendidikan',
  `alamat` text NOT NULL DEFAULT 'belum_update_alamat',
  `skill` text NOT NULL DEFAULT 'belum_update_skill',
  `moto` varchar(268) NOT NULL DEFAULT '''belum_update_moto'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `nip`, `password`, `jabatan`, `pangkat_golongan`, `unit_kerja`, `nilai_kinerja`, `nilai_prilaku`, `nilai_prestasi`, `is_active`, `role_id`, `image`, `tgl_update`, `pendidikan`, `alamat`, `skill`, `moto`) VALUES
(1, 'Budi Dharmawan P', '112233', '$2y$10$foS2cov8HW9cH4BFiXqPG.xO5QJXHFf1k/QvGn0DA3mK08JedgK.q', 'Kepala Bagian Pengadaan Tanah', 'IV.B/Pembina', 'Kanwil BPN Provinsi Sulawesi Tenggara', '85', '85', '85', 1, 1, 'avatar6.png', '2021-10-02 04:58:16', 'S-1 Teknik Informatika, Konsentrasi Rekayasa Perangkat Lunak', 'Jl. Ld. Hadi Lr. Al-Ikhlas No. 13 Kel. Wowawanggu Kec. Kadia Kota Kendari Prov. Sulwesi Tenggara', 'S-1 Teknik Informatika, Konsentrasi Rekayasa Perangkat Lunak', 'Maju Terus Asal Benar'),
(2, 'Mr. Tampan dan Berani', '123456789', '$2y$10$Uo0q9qJlFIpSMat6612B7eubxvY/owAhROJEQWDilOSWKRQjaGsxC', 'tes', '3Coba', 'coba coba', '-', '-', '-', 1, 1, 'user2-160x160.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(3, 'Budi Dharmawan (ADMIN)', 'admin1234', '$2y$10$YBjEdM5OkhUyhNcnKRhPJO235e1f.NsusPshjbbsGb9iB9ZLfk5YS', 'Administrator', 'Administrator', 'Administrator', '-', '-', '-', 1, 2, 'user2-160x160.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(4, 'H. Moh. Jafar Hamid. SH., MM', '196208011985031016', '$2y$10$Uo0q9qJlFIpSMat6612B7eubxvY/owAhROJEQWDilOSWKRQjaGsxC', 'Sekretaris Daerah', 'SEKDA_PANGKAT', 'Sekretaris Daerah Kabupaten Morowali', '-', '-', '-', 1, 3, 'user2-160x160.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(5, 'H. Zainal, SE., MM', '196503061989031018', '$2y$10$VWcSOP.W0PpbyaKxI5DLDuitmlzBrnt98Ruj4WNLRlj8kOSbZ51Ni', 'Kepala Dinas', '-', 'Dinas Perdagangan dan Perindustrian Daerah Kab. Morowali', '-', '-', '89', 1, 1, 'user8-128x128.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(6, 'Yusfatan Janad, SH', '196905132007011030', '$2y$10$VWcSOP.W0PpbyaKxI5DLDuitmlzBrnt98Ruj4WNLRlj8kOSbZ51Ni', 'Sekretaris', '-', 'Dinas Perdagangan dan Perindustrian Daerah Kab. Morowali', '-', '-', '-', 1, 1, 'user6-128x128.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(7, 'I Ketut Suarsa, S.E', '197010092000121003', '$2y$10$VWcSOP.W0PpbyaKxI5DLDuitmlzBrnt98Ruj4WNLRlj8kOSbZ51Ni', 'Kepala Bidang Perindustrian', '-', 'Dinas Perdagangan dan Perindustrian Daerah Kab. Morowali', '-', '-', '-', 1, 1, 'user3-128x128.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(8, 'Drs. Hasim Bakar, MM', '196604132001121004', '$2y$10$VWcSOP.W0PpbyaKxI5DLDuitmlzBrnt98Ruj4WNLRlj8kOSbZ51Ni', 'Kepala Bidang Promosi Perlindungan Konsumen', '-', 'Dinas Perdagangan dan Perindustrian Daerah Kab. Morowali', '-', '-', '-', 1, 1, 'user4-128x128.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(9, 'Chairil Amni, S.E', '196607252005022001', '$2y$10$VWcSOP.W0PpbyaKxI5DLDuitmlzBrnt98Ruj4WNLRlj8kOSbZ51Ni', 'Kepala Bidang Perizinan dan Sarana Distribusi Perdagangan', '-', 'Dinas Perdagangan dan Perindustrian Daerah Kab. Morowali', '-', '-', '-', 1, 1, 'user1-128x128.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto'),
(10, 'Marumpe S.Sos', '197008102007011041', '$2y$10$VWcSOP.W0PpbyaKxI5DLDuitmlzBrnt98Ruj4WNLRlj8kOSbZ51Ni', 'Kepala Seksi Sarana Distribusi Perdagangan', '-', 'Dinas Perdagangan dan Perindustrian Daerah Kab. Morowali', '-', '-', '-', 1, 1, 'user7-128x128.jpg', '2021-09-28 09:16:19', 'belum_update_pendidikan', 'belum_update_alamat', 'belum_update_skill', 'belum_update_moto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rincian`
--
ALTER TABLE `rincian`
  ADD PRIMARY KEY (`rinci_id`),
  ADD KEY `rincian_to_skp` (`rinci_skp_id`);

--
-- Indexes for table `skp`
--
ALTER TABLE `skp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rincian`
--
ALTER TABLE `rincian`
  MODIFY `rinci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `skp`
--
ALTER TABLE `skp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rincian`
--
ALTER TABLE `rincian`
  ADD CONSTRAINT `rincian_to_skp` FOREIGN KEY (`rinci_skp_id`) REFERENCES `skp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
