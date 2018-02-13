-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 Feb 2018 pada 14.26
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ukk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `nama_bagian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `nama_bagian`) VALUES
(1, 'Maketing'),
(2, 'Human Resources'),
(3, 'Financial'),
(4, 'Administrasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `tanggal_disposisi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `catatan` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_disposisi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `id_surat_masuk`, `id_penerima`, `id_pengirim`, `tanggal_disposisi`, `catatan`, `status`, `id_disposisi_id`) VALUES
(5, 3, 2, 4, '2018-02-14 00:00:00', 'dxgfchm', 0, NULL),
(6, 5, 3, 4, '2018-02-06 00:00:00', 'dxgfchgv', 0, NULL),
(7, 6, 1, 4, '2018-02-13 00:00:00', 'ertyjhk', 0, NULL),
(8, 6, 1, 4, '2018-02-09 00:00:00', 'dfghjk', 0, NULL),
(9, 6, 3, 4, '2018-02-12 00:00:00', 'ggfhjk', 0, NULL),
(10, 5, 1, 4, '2018-02-12 00:00:00', 'sfdxgchjbkn', 0, NULL),
(11, 3, 3, 4, '2018-02-12 00:00:00', 'chj', 0, NULL),
(12, 3, 1, 4, '2018-02-12 00:00:00', 'wretdrftgjy', 0, NULL),
(13, 5, 1, 4, '2018-02-21 00:00:00', 'qewrsdftgkh', 0, NULL),
(14, 5, 2, 4, '2018-02-19 00:00:00', 'sfdghjk', 0, NULL),
(15, 6, 6, 4, '2018-02-13 10:59:42', 'coba', 0, NULL),
(16, 3, 1, 2, '2018-02-13 11:43:46', 'aaaaa', 0, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `level`) VALUES
(1, 'Pegawai', 1),
(2, 'Supervisor', 2),
(3, 'Manager', 3),
(5, 'Admin', 4),
(6, 'direktur', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id_jenis_surat`, `jenis_surat`) VALUES
(1, 'resmi'),
(2, 'dinas'),
(3, 'setengah resmi'),
(4, 'keluarga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `password` tinytext NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nik`, `nama_depan`, `nama_belakang`, `password`, `id_jabatan`, `id_bagian`) VALUES
(1, 111, 'Kirana', 'Asheeqa', '81dc9bdb52d04dc20036dbd8313ed055', 1, 2),
(2, 112, 'Daffa', 'Kevin', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1),
(3, 113, 'Deby', 'Destyananda', '81dc9bdb52d04dc20036dbd8313ed055', 3, 3),
(4, 114, 'Rafi', 'Fathansyah', '5fd0b37cd7dbbb00f97ba6ce92bf5add', 5, 4),
(5, 110, 'Aa', 'Bb', '5f93f983524def3dca464469d2cf9f3e', 1, 1),
(6, 220, 'aku', 'kamu', 'ec8ce6abb3e952a85b8551ba726a1227', 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(15) NOT NULL,
  `nomor_agenda` varchar(15) NOT NULL,
  `nomor_surat` varchar(15) NOT NULL,
  `id_jenis_surat` int(15) NOT NULL,
  `pengirim` int(15) NOT NULL,
  `penerima` text NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `perihal` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(15) NOT NULL,
  `nomor_surat` varchar(15) NOT NULL,
  `id_jenis_surat` int(11) NOT NULL,
  `pengirim` text NOT NULL,
  `penerima` text NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `tanggal_penerima` date NOT NULL,
  `perihal` text NOT NULL,
  `file_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `nomor_surat`, `id_jenis_surat`, `pengirim`, `penerima`, `tanggal_kirim`, `tanggal_penerima`, `perihal`, `file_surat`) VALUES
(3, 'NA/02/002/2018', 4, 'adek', '', '2018-02-05', '2018-02-27', 'izin', 'petunjuk_siswa2.pdf'),
(5, 'esrdfhgj', 3, 'Daffa Kevin', '', '2018-02-06', '2018-02-07', 'srdtfgh', 'SuratBebasTunggakan-1107-DEBY_DESTYANANDA_WINDASARI_R_.pdf'),
(6, 'ggjhm', 2, 'fchgvj', '', '2018-01-29', '2018-02-01', 'gjh,', 'Vivin_Apriyanti-Sublime_Text_Editor.pdf'),
(7, 'jk', 3, 'fchgvjh', '', '2018-02-11', '2018-02-15', 'gvjhkbj', '03-materi-w26c.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `id_surat_masuk` (`id_surat_masuk`),
  ADD KEY `id_disposisi_id` (`id_disposisi_id`),
  ADD KEY `id_penerima` (`id_penerima`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id_jenis_surat`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat_keluar` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_surat_masuk`) REFERENCES `surat_masuk` (`id_surat_masuk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_ibfk_3` FOREIGN KEY (`id_disposisi_id`) REFERENCES `disposisi` (`id_disposisi`),
  ADD CONSTRAINT `disposisi_ibfk_4` FOREIGN KEY (`id_penerima`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengguna_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_ibfk_1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `jenis_surat` (`id_jenis_surat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `jenis_surat` (`id_jenis_surat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
