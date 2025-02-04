-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2023 at 06:28 PM
-- Server version: 8.0.35-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multipa3_mpayy`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `category` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `sort` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `sort`) VALUES
(15, 'Games', 1),
(18, 'Pulsa', 2),
(19, 'Premium', 3);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `title`, `content`) VALUES
(2, 'Cara mendaftar di MULTIPAYH2H', 'Anda dapat mengunjungi Halaman Home lalu klik tombol daftar.dan isi saldo untuk melakuka transaksi tersimpan.');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `brand` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `images` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `target` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `sort` bigint NOT NULL,
  `validasi_status` enum('Y','N') COLLATE utf8mb4_general_ci NOT NULL,
  `validasi_kode` varchar(55) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `brand`, `slug`, `images`, `category`, `content`, `target`, `sort`, `validasi_status`, `validasi_kode`) VALUES
(1, 'Mobile Legends', 'MOBILE LEGENDS', 'mobile-legend', '1692983101_78f0de51ff763a1cc9f9.jpeg', '15', '<p>Top Up Diamond MLBB hanya dalam hitungan detik! Cukup masukkan ID User MLBB Anda, pilih jumlah Diamond yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun MLBB Anda.</p>\r\n', 'B', 1, 'Y', ''),
(5, 'Free Fire', 'FREE FIRE', 'free-fire', '1692983066_dc2c5a4904df35a94ab1.jpeg', '15', '<p>Top Up Game hanya dalam hitungan detik! Cukup masukkan ID User Anda, pilih jumlah Nominal yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun game Anda.</p>\r\n', 'A', 1, 'Y', ''),
(7, 'Valorant', 'Valorant', 'valorant', '1692983356_1587a7f9d5ba1a6e92fd.jpeg', '15', '<p>Top Up Game hanya dalam hitungan detik! Cukup masukkan ID User Anda, pilih jumlah Nominal yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun game Anda.</p>\r\n', 'A', 8, 'Y', ''),
(10, 'Genshin Impact', 'Genshin Impact', 'genshin-impact', '1692983327_6d48157ec1f30f6ea27d.jpeg', '15', '<p>Top Up Game hanya dalam hitungan detik! Cukup masukkan ID User Anda, pilih jumlah Nominal yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun game Anda.</p>\r\n', 'C', 7, 'Y', ''),
(12, 'Call Of Duty Mobile', 'Call Of Duty MOBILE', 'call-of-duty-mobile', '1692983287_8a1d68619f1df3bf445b.jpeg', '15', '<p>Top Up Game hanya dalam hitungan detik! Cukup masukkan ID User Anda, pilih jumlah Nominal yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun game Anda.</p>\r\n', 'A', 6, 'N', ''),
(13, 'PUBG Mobile', 'PUBG MOBILE', 'pubg-mobile', '1692983036_770ca86a91c6718ef3be.jpeg', '15', '<p>Top Up Game hanya dalam hitungan detik! Cukup masukkan ID User Anda, pilih jumlah Nominal yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun game Anda.</p>\r\n', 'A', 1, 'N', ''),
(53, 'Point Blank', 'POINT BLANK', 'point-blank', '1692983203_2d2ecb2e49c98b1ad0f4.jpeg', '15', '<p>Top Up Game hanya dalam hitungan detik! Cukup masukkan ID User Anda, pilih jumlah Nominal yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun game Anda.</p>\r\n', 'A', 2, 'Y', ''),
(92, 'AOV', 'ARENA OF VALOR', 'aov', '1692982971_ca2333898df0750b5882.jpeg', '15', '<p>Top Up Game hanya dalam hitungan detik! Cukup masukkan ID User Anda, pilih jumlah Nominal yang ingin Anda beli, selesaikan pembayaran, dan Diamond akan segera ditambahkan ke akun game Anda.</p>\r\n', 'A', 1, 'Y', ''),
(103, 'Vidio Premier', '', 'VIDEOPREMIER', '1700321530_ef2d174421d2e68bc403.png', '19', '', 'D', 11, 'N', ''),
(104, 'Netflix', '', 'netflix-prem', '1700320981_2a29509508162115ca1f.jpeg', '19', '', 'D', 10, 'N', ''),
(105, 'We TV', '', 'wetv', '1700320922_978b7a79bab2aea94d86.jpeg', '19', '', 'D', 9, 'N', ''),
(106, 'Axis', 'AXIS', 'axis', '1700322404_773ab8d793d9544da8f9.jpeg', '18', '', 'D', 1, 'N', ''),
(107, 'Telkomsel', 'TELKOMSEL', 'telkomsel', '1700322675_85aef62f1adf7229f396.jpeg', '18', '', 'A', 1, 'N', ''),
(108, 'XL', 'XL', 'xl', '1700322522_7b00e4f00b108de11835.jpeg', '18', '', 'D', 1, 'N', ''),
(109, 'Tri', 'TRI', 'tri', '1700322270_6552449475efb8fda171.png', '18', '', 'D', 1, 'N', ''),
(110, 'Indosat', 'INDOSAT', 'indosat', '1700322285_c896e8b13bc45354f47e.jpeg', '18', '', 'D', 1, 'N', ''),
(111, 'iQIYI', '', 'iqiyi', '1700322007_11bcc239eeeeb4441707.png', '19', '', 'D', 1, 'N', ''),
(112, 'Disney+ Hotstar', '', 'disneyu', '1700321495_46d01a2d4849eac7ea10.jpeg', '19', '', 'D', 1, 'N', ''),
(113, 'Canva', '', 'canva', '1700321127_2308c5b5ae21e5341125.jpeg', '19', '', 'D', 1, 'N', ''),
(114, 'Youtube Premium', '', 'yt-prem', '1700321515_dd98953d345290206dac.jpeg', '19', '', 'D', 1, 'N', ''),
(115, 'Spotify', '', 'spotify-prem', '1700320937_524cc310ec4a8e99b649.jpeg', '19', '', 'D', 1, 'N', ''),
(116, 'VIU', '', 'viu-tv', '1700321680_f37bbc074db79baf37fe.jpeg', '19', '', 'D', 1, 'N', ''),
(117, 'Alight Motion', '', 'alight-motion', '1700321780_abf37ed83ddb291d49bd.jpeg', '19', '', 'D', 1, 'N', ''),
(118, 'Prime Video', '', 'prime-video', '1700321880_40fa160bb92bd8734574.jpeg', '19', '', 'D', 1, 'N', ''),
(119, 'PicsArt Pro', '', 'picsart', '1700322024_9a29bdc986f2ab6e1b61.jpeg', '19', '', 'D', 1, 'N', ''),
(120, 'Smartfren', 'SMARTFREN', 'smartfren', '1700322330_c9af1b55e542cfb1d60a.jpeg', '18', '', 'D', 1, 'N', ''),
(121, 'League of Legends: Wild Rift', 'League of Legends Wild Rift', 'lol-wild-rift', '1700336969_baae1b269359e318f55f.jpg', '15', '', 'A', 1, 'N', ''),
(122, 'Ragnarok M: Eternal Love', 'Ragnarok M: Eternal Love', 'ragnarokm-eternallove', '1700337082_5e89bd689579ca2dc12f.jpg', '15', '', 'C', 1, 'N', '');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id` int NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `images` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `provider` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`id`, `name`, `images`, `code`, `provider`) VALUES
(29, 'QRIS', '1700224418_dac569a9de4a11344f38.png', 'QRIS2', 'Tripay'),
(30, 'Indomaret', '1700224741_88067b44efae9c0b44fe.png', 'INDOMARET', 'Tripay'),
(31, 'Alfamart', '1700224684_6f3c636a50db9e248fa6.png', 'ALFAMART', 'Tripay'),
(32, 'Alfamidi', '1700224694_450b09da359955cb823f.png', 'ALFAMIDI', 'Tripay');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `order_id` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `games_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `games_img` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `product` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `sku` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `note` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `price` bigint NOT NULL,
  `profit` bigint DEFAULT NULL,
  `target` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `data_no` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_zone` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `provider_order_id` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `method_id` int NOT NULL,
  `payment_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_url` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','Processing','Completed','Canceled') COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `provider` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `whatsapp`, `games_id`, `games_img`, `product`, `sku`, `note`, `price`, `profit`, `target`, `data_no`, `data_zone`, `provider_order_id`, `method_id`, `payment_code`, `payment_url`, `status`, `ip`, `provider`, `date_create`, `date_update`) VALUES
(1, '85420138', '6285718017762', '1', '1692983101_78f0de51ff763a1cc9f9.jpeg', 'MOBILELEGEND - 44 Diamond', '', 'Menunggu Pembayaran', 12360, 10, '851484972224', '', '', '', 29, '', 'https://tripay.co.id/checkout/T27115121509459CYXX', 'Canceled', '103.56.204.66', 'DF', '2023-11-19 06:17:25', '2023-11-19 06:17:25'),
(2, '63653583', '6285718017762', '115', '1700320937_524cc310ec4a8e99b649.jpeg', 'Spotify Famplan 1B Garansi', 'SP1BG', 'Menunggu Pembayaran', 7000, 0, 'grandymaulana@gmail.com', '', '', '', 29, '', 'https://tripay.co.id/checkout/T2711512157825UAW5S', 'Canceled', '103.56.204.66', 'DF', '2023-11-19 16:51:23', '2023-11-19 16:51:23'),
(3, '55507902', '6281906600118', '1', '1692983101_78f0de51ff763a1cc9f9.jpeg', 'MOBILELEGEND - 19 Diamond', '', 'Menunggu Pembayaran', 5671, 10, '851484972224', '', '', '', 29, '', 'https://tripay.co.id/checkout/T2711512163274AFCWG', 'Canceled', '103.56.204.66', 'DF', '2023-11-20 00:10:45', '2023-11-20 00:10:45'),
(4, '14984893', '628123456255', '1', '1692983101_78f0de51ff763a1cc9f9.jpeg', 'MOBILELEGEND - 2010 Diamond', '', 'Menunggu Pembayaran', 505890, 10, '128187283215211', '', '', '', 29, '', 'https://tripay.co.id/checkout/T2711512168907N4AT8', 'Canceled', '103.56.204.66', 'DF', '2023-11-20 13:24:38', '2023-11-20 13:24:38'),
(5, '14751615', '6289644554444', '109', '1700322270_6552449475efb8fda171.png', 'Three 25.000', '', 'Menunggu Pembayaran', 27218, 10, '0896333443', '', '', '', 29, '', 'https://tripay.co.id/checkout/T2711512334217X8PEK', 'Pending', '103.56.204.66', 'DF', '2023-11-29 19:07:36', '2023-11-29 19:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int NOT NULL,
  `method_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `price` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `games_id` bigint NOT NULL,
  `product` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `price` bigint NOT NULL,
  `profit` bigint DEFAULT NULL,
  `sku` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `provider` varchar(55) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `games_id`, `product`, `price`, `profit`, `sku`, `provider`) VALUES
(1, 92, 'AOV 24050 Vouchers', 4633778, 10, '', 'DF'),
(2, 92, 'AOV 40 Vouchers', 9576, 10, '', 'DF'),
(3, 92, 'AOV 48200 Vouchers', 9267528, 10, '', 'DF'),
(4, 92, 'AOV 90 Vouchers', 19151, 10, '', 'DF'),
(5, 106, 'Axis 10.000', 11930, 10, '', 'DF'),
(6, 106, 'Axis 100.000', 108625, 10, '', 'DF'),
(7, 106, 'Axis 1.000.000', 1089055, 10, '', 'DF'),
(8, 106, 'Axis 15.000', 16456, 10, '', 'DF'),
(9, 106, 'Axis 20.000', 21219, 10, '', 'DF'),
(10, 106, 'Axis 200.000', 218411, 10, '', 'DF'),
(11, 106, 'Axis 25.000', 27368, 10, '', 'DF'),
(12, 106, 'Axis 5.000', 6501, 10, '', 'DF'),
(13, 106, 'Axis 50.000', 54863, 10, '', 'DF'),
(14, 12, 'Call of Duty Mobile 10560 CP', 1936000, 10, '', 'DF'),
(15, 12, 'Call of Duty Mobile 127 CP', 19171, 10, '', 'DF'),
(16, 12, 'Call of Duty Mobile 15312 CP', 1980000, 10, '', 'DF'),
(17, 12, 'Call of Duty Mobile 2059 CP', 309100, 10, '', 'DF'),
(18, 12, 'Call of Duty Mobile 2750 CP', 352193, 10, '', 'DF'),
(19, 12, 'Call of Duty Mobile 31 CP', 4895, 10, '', 'DF'),
(20, 12, 'Call of Duty Mobile 320 CP', 47846, 10, '', 'DF'),
(21, 12, 'Call of Duty Mobile 38280 CP', 4755958, 10, '', 'DF'),
(22, 12, 'Call of Duty Mobile 3564 CP', 463403, 10, '', 'DF'),
(23, 12, 'Call of Duty Mobile 5618 CP', 676555, 10, '', 'DF'),
(24, 12, 'Call of Duty Mobile 62 CP', 10175, 10, '', 'DF'),
(25, 12, 'Call of Duty Mobile 645 CP', 96828, 10, '', 'DF'),
(26, 12, 'Call of Duty Mobile 7656 CP', 926778, 10, '', 'DF'),
(27, 12, 'Call of Duty Mobile 800 CP', 111221, 10, '', 'DF'),
(28, 5, 'Free Fire 12 Diamond', 1997, 10, '', 'DF'),
(29, 5, 'Free Fire 140 Diamond', 18568, 10, '', 'DF'),
(30, 5, 'Free Fire 1450 Diamond', 186915, 10, '', 'DF'),
(31, 5, 'Free Fire 2180 Diamond', 276893, 10, '', 'DF'),
(32, 5, 'Free Fire 355 Diamond', 46508, 10, '', 'DF'),
(33, 5, 'Free Fire 3640 Diamond', 465589, 10, '', 'DF'),
(34, 5, 'Free Fire 36500 Diamond', 4510028, 10, '', 'DF'),
(35, 5, 'Free Fire 5 Diamond', 869, 10, '', 'DF'),
(36, 5, 'Free Fire 50 Diamond', 6751, 10, '', 'DF'),
(37, 5, 'Free Fire 70 Diamond', 9301, 10, '', 'DF'),
(38, 5, 'Free Fire 720 Diamond', 92934, 10, '', 'DF'),
(39, 5, 'Free Fire 7290 Diamond', 927135, 10, '', 'DF'),
(40, 5, 'Free Fire 73100 Diamond', 9207028, 10, '', 'DF'),
(41, 5, 'Free Fire BP Card', 42158, 10, '', 'DF'),
(42, 5, 'Free Fire Level Up Pass', 13992, 10, '', 'DF'),
(43, 10, 'Genshin Impact Blessing of the Welkin Moon', 60385, 10, '', 'DF'),
(44, 10, 'Genshin Impact 1980+260 Genesis Crystals', 394018, 10, '', 'DF'),
(45, 10, 'Genshin Impact 300+30 Genesis Crystals', 61864, 10, '', 'DF'),
(46, 10, 'Genshin Impact 3280+600 Genesis Crystals', 606330, 10, '', 'DF'),
(47, 10, 'Genshin Impact 60 Genesis Crystals', 11839, 10, '', 'DF'),
(48, 10, 'Genshin Impact 6480+1600 Genesis Crystals', 1239593, 10, '', 'DF'),
(49, 10, 'Genshin Impact 980+110 Genesis Crystals', 181500, 10, '', 'DF'),
(50, 110, 'Indosat 10.000', 11358, 10, '', 'DF'),
(51, 110, 'Indosat 100.000', 107003, 10, '', 'DF'),
(52, 110, 'Indosat 1.000.000', 1017308, 10, '', 'DF'),
(53, 110, 'Indosat 15.000', 16390, 10, '', 'DF'),
(54, 110, 'Indosat 150.000', 158428, 10, '', 'DF'),
(55, 110, 'Indosat 20.000', 21901, 10, '', 'DF'),
(56, 110, 'Indosat 25.000', 27280, 10, '', 'DF'),
(57, 110, 'Indosat 250.000', 255448, 10, '', 'DF'),
(58, 110, 'Indosat 5.000', 6265, 10, '', 'DF'),
(59, 110, 'Indosat 50.000', 54093, 10, '', 'DF'),
(60, 110, 'Indosat 500.000', 508844, 10, '', 'DF'),
(61, 121, 'League of Legends Wild Rift 105 Wild Cores', 15126, 10, '', 'DF'),
(62, 121, 'League of Legends Wild Rift 1135 Wild Cores', 149600, 10, '', 'DF'),
(63, 121, 'League of Legends Wild Rift 1660 Wild Cores', 211266, 10, '', 'DF'),
(64, 121, 'League of Legends Wild Rift 3010 Wild Cores', 362164, 10, '', 'DF'),
(65, 121, 'League of Legends Wild Rift 350 Wild Cores', 49500, 10, '', 'DF'),
(66, 121, 'League of Legends Wild Rift 585 Wild Cores', 79200, 10, '', 'DF'),
(67, 121, 'League of Legends Wild Rift 6210 Wild Cores', 754501, 10, '', 'DF'),
(68, 1, 'MOBILELEGEND - 3 Diamond', 1260, 10, '', 'DF'),
(69, 1, 'MOBILELEGEND - 5 Diamond', 1540, 10, '', 'DF'),
(70, 1, 'MOBILELEGEND - 12 Diamond', 3883, 10, '', 'DF'),
(71, 1, 'MOBILELEGEND - 170 Diamond', 48070, 10, '', 'DF'),
(72, 1, 'MOBILELEGEND - 19 Diamond', 5671, 10, '', 'DF'),
(73, 1, 'MOBILELEGEND - 2010 Diamond', 505912, 10, '', 'DF'),
(74, 1, 'MOBILELEGEND - 240 Diamond', 66550, 10, '', 'DF'),
(75, 1, 'MOBILELEGEND - 28 Diamond', 8099, 10, '', 'DF'),
(76, 1, 'MOBILELEGEND - 296 Diamond', 81950, 10, '', 'DF'),
(77, 1, 'MOBILELEGEND - 408 Diamond', 112606, 10, '', 'DF'),
(78, 1, 'MOBILELEGEND - 44 Diamond', 12360, 10, '', 'DF'),
(79, 1, 'MOBILELEGEND - 4830 Diamond', 1226748, 10, '', 'DF'),
(80, 1, 'MOBILELEGEND - 568 Diamond', 151966, 10, '', 'DF'),
(81, 1, 'MOBILELEGEND - 59 Diamond', 16467, 10, '', 'DF'),
(82, 1, 'MOBILELEGEND - 85 Diamond', 24134, 10, '', 'DF'),
(83, 1, 'MOBILELEGEND - 875 Diamond', 235368, 10, '', 'DF'),
(84, 53, '12000 PB Cash', 96855, 10, '', 'DF'),
(85, 53, '1200 PB Cash', 9691, 10, '', 'DF'),
(86, 53, '24000 PB Cash', 193655, 10, '', 'DF'),
(87, 53, '2400 PB Cash', 19415, 10, '', 'DF'),
(88, 53, '36000 PB Cash', 290565, 10, '', 'DF'),
(89, 53, '60000 PB Cash', 484028, 10, '', 'DF'),
(90, 53, '6000 PB Cash', 48455, 10, '', 'DF'),
(91, 13, 'Pubg Elite Pass Plus', 401099, 10, '', 'DF'),
(92, 13, 'PUBG MOBILE 1925 UC', 355971, 10, '', 'DF'),
(93, 13, 'PUBG MOBILE 375 UC', 77138, 10, '', 'DF'),
(94, 13, 'PUBG MOBILE 4000 UC', 688025, 10, '', 'DF'),
(95, 13, 'PUBG MOBILE 50 UC', 11556, 10, '', 'DF'),
(96, 13, 'PUBG MOBILE 73 UC', 14091, 10, '', 'DF'),
(97, 13, 'PUBG MOBILE 750 UC', 155100, 10, '', 'DF'),
(98, 13, 'PUBG MOBILE 8750 UC', 1424121, 10, '', 'DF'),
(99, 120, 'Smartfren 10.000', 10769, 10, '', 'DF'),
(100, 120, 'Smartfren 100.000', 105529, 10, '', 'DF'),
(101, 120, 'Smartfren 1.000.000', 1073628, 10, '', 'DF'),
(102, 120, 'Smartfren 15.000', 16198, 10, '', 'DF'),
(103, 120, 'Smartfren 20.000', 21571, 10, '', 'DF'),
(104, 120, 'Smartfren 200.000', 216453, 10, '', 'DF'),
(105, 120, 'Smartfren 25.000', 27128, 10, '', 'DF'),
(106, 120, 'Smartfren 5.000', 5390, 10, '', 'DF'),
(107, 120, 'Smartfren 50.000', 54038, 10, '', 'DF'),
(108, 120, 'Smartfren 500.000', 536828, 10, '', 'DF'),
(109, 109, 'Three 10.000', 11497, 10, '', 'DF'),
(110, 109, 'Three 100.000', 107482, 10, '', 'DF'),
(111, 109, 'Three 15.000', 16316, 10, '', 'DF'),
(112, 109, 'Three 20.000', 21879, 10, '', 'DF'),
(113, 109, 'Three 200.000', 214623, 10, '', 'DF'),
(114, 109, 'Three 25.000', 27218, 10, '', 'DF'),
(115, 109, 'Three 5.000', 6078, 10, '', 'DF'),
(116, 109, 'Three 50.000', 54203, 10, '', 'DF'),
(117, 109, 'Three 500.000', 535686, 10, '', 'DF'),
(118, 107, 'Telkomsel 10.000', 11193, 10, '', 'DF'),
(119, 107, 'Telkomsel 100.000', 106975, 10, '', 'DF'),
(120, 107, 'Telkomsel 1.000.000', 1090716, 10, '', 'DF'),
(121, 107, 'Telkomsel 15.000', 16286, 10, '', 'DF'),
(122, 107, 'Telkomsel 20.000', 21890, 10, '', 'DF'),
(123, 107, 'Telkomsel 200.000', 218928, 10, '', 'DF'),
(124, 107, 'Telkomsel 25.000', 27346, 10, '', 'DF'),
(125, 107, 'Telkomsel 300.000', 328378, 10, '', 'DF'),
(126, 107, 'Telkomsel 5.000', 5759, 10, '', 'DF'),
(127, 107, 'Telkomsel 50.000', 54643, 10, '', 'DF'),
(128, 7, 'Valorant 1375 Points', 151485, 10, '', 'DF'),
(129, 7, 'Valorant 125 Points', 15069, 10, '', 'DF'),
(130, 7, 'Valorant 2400 Points', 252475, 10, '', 'DF'),
(131, 7, 'Valorant 4000 Points', 403960, 10, '', 'DF'),
(132, 7, 'Valorant 420 Points', 50496, 10, '', 'DF'),
(133, 7, 'Valorant 700 Points', 80792, 10, '', 'DF'),
(134, 7, 'Valorant 8150 Points', 807919, 10, '', 'DF'),
(135, 108, 'Xl 10.000', 11908, 10, '', 'DF'),
(136, 108, 'Xl 100.000', 108680, 10, '', 'DF'),
(137, 108, 'Xl 1.000.000', 1084270, 10, '', 'DF'),
(138, 108, 'Xl 15.000', 16456, 10, '', 'DF'),
(139, 108, 'Xl 20.000', 21324, 10, '', 'DF'),
(140, 108, 'Xl 200.000', 218763, 10, '', 'DF'),
(141, 108, 'Xl 25.000', 27379, 10, '', 'DF'),
(142, 108, 'Xl 5.000', 6463, 10, '', 'DF'),
(143, 108, 'Xl 50.000', 54698, 10, '', 'DF'),
(144, 108, 'Xl 500.000', 545936, 10, '', 'DF');

-- --------------------------------------------------------

--
-- Table structure for table `product_smm`
--

CREATE TABLE `product_smm` (
  `id` int NOT NULL,
  `category` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(225) NOT NULL,
  `price` bigint NOT NULL,
  `profit` bigint DEFAULT NULL,
  `min` varchar(225) NOT NULL,
  `max` varchar(225) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `refill` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `masa_refill` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `average_time` varchar(225) NOT NULL,
  `provider` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `id` int NOT NULL,
  `provider` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `saldo` text COLLATE utf8mb4_general_ci,
  `api_id` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `api_key` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('On','Off') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id`, `provider`, `saldo`, `api_id`, `api_key`, `status`) VALUES
(1, 'DF', NULL, NULL, NULL, 'On'),
(2, 'MANUAL', NULL, NULL, NULL, 'On');

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE `topup` (
  `id` int NOT NULL,
  `topup_id` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `metode` varchar(250) NOT NULL,
  `metode_id` int NOT NULL,
  `quantity` bigint NOT NULL,
  `balance` bigint NOT NULL,
  `target` varchar(250) NOT NULL,
  `status` enum('Pending','Success','Canceled') NOT NULL,
  `date_create` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `balance` bigint NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('Member','Admin') COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('On','Off') COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `last_ip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `whatsapp`, `balance`, `password`, `level`, `status`, `ip`, `date_create`, `last_ip`, `last_login`) VALUES
(47, 'Admin', '6285718017762', 998493, '$2y$10$xDNpxWaQzDu1mkWxNmQi7e7cTOf9GK5GaLmlvcjaJcO3DX0GlYLP2', 'Admin', 'On', '', '2023-09-20 01:25:22', '103.56.204.66', '2023-11-29 21:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `utility`
--

CREATE TABLE `utility` (
  `id` int NOT NULL,
  `u_key` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `u_value` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utility`
--

INSERT INTO `utility` (`id`, `u_key`, `u_value`) VALUES
(1, 'web-title', 'MULTIPAYH2H'),
(2, 'web-icon', 'https://multipayh2h.my.id/assets/images/mph2h.png'),
(3, 'web-logo', 'https://multipayh2h.my.id/assets/images/mph2h.png'),
(4, 'web-author', 'TopUp Games & Premium Apps No #1 Indonesia'),
(5, 'web-keywords', 'top up game'),
(6, 'web-description', 'Beli semua kebutuhan games & streaming kamu  dengan harga terjangkau dan kualitas terbaik hanya disini.Layanan Realtime 24 Jam'),
(7, 'tripay_api', 'l98KO4EmoLONvQCOLbRq2yLrEU8In8Uj3MpcxliT'),
(8, 'tripay_private', 'WyTJU-xtfbz-8oqZM-g0ZZK-eVS5X'),
(9, 'tripay_merchant', 'T27115'),
(10, 'slide-1', 'https://multipayh2h.my.id/assets/images/slide/slide-s1.png'),
(11, 'slide-2', 'https://multipayh2h.my.id/assets/images/slide/slide-s2.png'),
(12, 'slide-3', 'https://multipayh2h.my.id/assets/images/slide/slide-s3.png'),
(13, 'digi_user', 'bunoleDVxGOg'),
(14, 'digi_key', '24d17349-d33b-53c0-a2dd-8db3b932f612'),
(15, 'doc_tutor', '<ol>\n	<li>Silahkan masuk ke menu <a href=\"/\">Top Up</a></li>\n	<li>Pilih Games</li>\n	<li>Masukan ID Akun</li>\n	<li>Pilih nominal Top Up</li>\n	<li>Pilih metode pembayaran</li>\n	<li>Lakukan pembayaran</li>\n	<li>Selesai</li>\n</ol>\n'),
(16, 'doc_terms', '<p>Semua Sistim kami Online &amp; Realtime 24 jam dan apabila ada kendala Hub Admin</p>\r\n\r\n<p>HINDARI ORDER DI JAM 00.00 - 00.30</p>\r\n\r\n<p>Periksa Input sebelum melakukan Pesanan , Kesalahan Pengisian bukan tanggung jawab kami.</p>\r\n'),
(17, 'help_email', 'multipayh2h@gmail.com'),
(18, 'help_telpon', '+6285718017762'),
(19, 'profit', '10'),
(21, 'pay-saldo', 'On'),
(23, 'v_id', ''),
(24, 'v_key', '-'),
(25, 's_host', 'mail.multipayh2h.my.id'),
(26, 's_user', 'cs@multipayh2h.my.id'),
(27, 's_pass', 'kt3aMqN4]V}9'),
(28, 's_port', '465');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_smm`
--
ALTER TABLE `product_smm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utility`
--
ALTER TABLE `utility`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `product_smm`
--
ALTER TABLE `product_smm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `topup`
--
ALTER TABLE `topup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `utility`
--
ALTER TABLE `utility`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
