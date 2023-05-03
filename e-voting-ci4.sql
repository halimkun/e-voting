-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Mar 2023 pada 12.53
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-voting-ci4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`, `foto_profile`) VALUES
('e3de0ea6-d7a2-3447-ab50-208480ff587c', 'admin', '$2y$10$gXjhkUPVqumi0fyP9l5dou/PCzFUEONf8uDx2FXRxCre1pcKXgRUK', 'ADMIN', 'admin.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `candidate`
--

CREATE TABLE `candidate` (
  `id_candidate` varchar(150) NOT NULL,
  `no_urut` int(2) NOT NULL,
  `ketua` varchar(255) NOT NULL,
  `wakil` varchar(255) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `slogan` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `candidate`
--

INSERT INTO `candidate` (`id_candidate`, `no_urut`, `ketua`, `wakil`, `visi`, `misi`, `slogan`, `foto`) VALUES
('6f1c8648-7b41-30f7-95b2-09f1e23e207d', 2, 'AGUS SANTOSO', 'BURHAN', '<p>1. Menjadikan bumi ini semakin indah</p><p>2. Menolong sesama manusia</p><p>3. Saling pengertian</p><p>4. Saling menghormati</p>', '<p>1. Menjadikan bumi ini semakin indah</p><p>2. Menolong sesama manusia</p><p>3. Saling pengertian</p><p>4. Saling menghormati</p>', 'Jika ada yg sulit, kenapa harus memilih yg mudah', 'candidate2.jpg'),
('d262109b-2eee-3e58-9811-1070a7034c64', 1, 'BUDI BUDIMANS', 'SANTI PUJIASTUTI', '<p>1. Menjadikan bumi ini semakin indah</p><p>2. Menolong sesama manusia</p><p>3. Saling pengertian</p>', '<p>1. Menjadikan bumi ini semakin indah</p><p>2. Menolong sesama manusia</p><p>3. Saling pengertian</p>', 'Tetap putus asa dan jangan pernah semangat', 'candidate1.jpg'),
('fe663ba4-35b4-3ce0-8500-da0c2d0f766b', 3, 'DHIMAS PUTRA', 'AJENG NUR', '<p>1. Menjadikan bumi ini semakin indah</p><p>2. Menolong sesama manusia</p><p>3. Saling pengertian</p>', '<p>1. Menjadikan bumi ini semakin indah</p><p>2. Menolong sesama manusia</p><p>3. Saling pengertian</p><p>4. Saling menghormati</p>', 'Jaga rebahanmu karena itu sangat berguna', 'candidate3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `general`
--

CREATE TABLE `general` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `logo_sekolah` varchar(255) NOT NULL,
  `email_sekolah` varchar(255) NOT NULL,
  `alamat_sekolah` varchar(255) NOT NULL,
  `foto_sekolah` varchar(255) NOT NULL,
  `status_acara` enum('1','0','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `general`
--

INSERT INTO `general` (`id_sekolah`, `nama_sekolah`, `logo_sekolah`, `email_sekolah`, `alamat_sekolah`, `foto_sekolah`, `status_acara`) VALUES
(1, 'SMA NEGERI 1 KESESI', 'logo.png', 'admin@smankesesi.sch.id', 'Jl. Kaibahan-klairan, kec.Kesesi, Kab.Pekalongan', 'foto_sekolah.jpg', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_candidate` varchar(150) NOT NULL,
  `id_peserta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_candidate`, `id_peserta`) VALUES
(1, 'd262109b-2eee-3e58-9811-1070a7034c64', '57b7af6d-4bc2-3f91-b62a-eddcb16c39b1'),
(2, '6f1c8648-7b41-30f7-95b2-09f1e23e207d', '621157b1-c137-339a-ad82-55aeb6b740d7'),
(4, 'd262109b-2eee-3e58-9811-1070a7034c64', 'b722f774-3e74-3875-8039-cc28eb684723'),
(5, 'd262109b-2eee-3e58-9811-1070a7034c64', '2f28f93d-8eb1-3561-b407-fb134d9480fc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(16, '2021-03-22-092416', 'App\\Database\\Migrations\\Candidate', 'default', 'App', 1616680164, 1),
(17, '2021-03-22-093138', 'App\\Database\\Migrations\\Hasil', 'default', 'App', 1616680164, 1),
(18, '2021-03-22-095539', 'App\\Database\\Migrations\\General', 'default', 'App', 1616680164, 1),
(19, '2021-03-24-004434', 'App\\Database\\Migrations\\Peserta', 'default', 'App', 1616680164, 1),
(20, '2021-03-24-004625', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1616680164, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` varchar(150) NOT NULL,
  `username` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `status_pilihan` enum('1','0') NOT NULL DEFAULT '0',
  `waktu_pilih` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `username`, `password`, `nama`, `kelas`, `jurusan`, `status_pilihan`, `waktu_pilih`) VALUES
('19633f0b-5dfd-3b4b-b77c-4abfdb036628', 10000, 'pswrd', 'Abc', 'X', 'IPA', '0', NULL),
('2f28f93d-8eb1-3561-b407-fb134d9480fc', 14525, 'SDMOP3239', 'Puji Aryani', 'XI', 'IPA', '1', '2023-03-21 15:04:42'),
('45f857c0-f5c6-3d7f-9d18-2a3d00794926', 14590, 'jlpVNLx0mIf', 'Putri Lestari', 'X', 'IPS', '', NULL),
('57b7af6d-4bc2-3f91-b62a-eddcb16c39b1', 2602, 'YYYY040900', 'Dinda', 'XII', 'IPA', '1', '2022-12-14 14:22:54'),
('621157b1-c137-339a-ad82-55aeb6b740d7', 1234, 'RU1234', 'azkar', 'XII ', 'IPS', '1', '2022-12-28 19:16:26'),
('b722f774-3e74-3875-8039-cc28eb684723', 17809, 'FTRUBK55462', 'Budi', 'XII', 'IPS', '1', '2022-12-28 19:18:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id_candidate`),
  ADD UNIQUE KEY `no_urut` (`no_urut`);

--
-- Indeks untuk tabel `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `hasil_id_candidate_foreign` (`id_candidate`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_id_candidate_foreign` FOREIGN KEY (`id_candidate`) REFERENCES `candidate` (`id_candidate`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
