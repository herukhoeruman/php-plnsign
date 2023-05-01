-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2023 at 12:21 PM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plnr6871_callback`
--

-- --------------------------------------------------------

--
-- Table structure for table `callback`
--

CREATE TABLE `callback` (
  `id` int(11) NOT NULL,
  `json` varchar(500) NOT NULL,
  `status` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `document_id` varchar(255) NOT NULL,
  `signer_email` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `document_file_name` varchar(255) NOT NULL,
  `document_owner_name` varchar(255) NOT NULL,
  `document_owner_email` varchar(255) NOT NULL,
  `download_url` varchar(255) NOT NULL,
  `signer_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `callback`
--

INSERT INTO `callback` (`id`, `json`, `status`, `code`, `document_id`, `signer_email`, `email`, `url`, `document_file_name`, `document_owner_name`, `document_owner_email`, `download_url`, `signer_name`, `created_at`, `updated_at`) VALUES
(1, '{\"status\":true,\"code\":\"DOCUMENT_SIGN_COMPLETE\",\"timestamp\":\"2023-04-18T08:36:22+07:00\",\"message\":null,\"data\":{\"document_id\":\"98f38810-90e6-4824-ab14-a5206277e9cf\",\"document_file_name\":\"Foto.pdf\",\"document_owner_name\":\"Dadang Sutriaman\",\"document_owner_email\":\"dadang.sutriaman@gsp.co.id\",\"download_url\":\"https://doc.sandbox-111094.com/download/signed/eyJpdiI6IlYyOFAzaWNab1o1SU5Fek9yOVJrZmc9PSIsInZhbHVlIjoiOVcwbEVPLzRXbEo5bnJlNlFmdkI3KzhTbU9FZXBFTGVBYjdNMmNwTUtPQ3RtZWErQ1FOZ0VXdlBTUDJFMVAwYiIsIm1hY', '1', 'DOCUMENT_SIGN_COMPLETE', '98f38810-90e6-4824-ab14-a5206277e9cf', 'heru@gsp.co.id', '', '', 'Foto.pdf', 'Dadang Sutriaman', 'dadang.sutriaman@gsp.co.id', 'https://doc.sandbox-111094.com/download/signed/eyJpdiI6IlYyOFAzaWNab1o1SU5Fek9yOVJrZmc9PSIsInZhbHVlIjoiOVcwbEVPLzRXbEo5bnJlNlFmdkI3KzhTbU9FZXBFTGVBYjdNMmNwTUtPQ3RtZWErQ1FOZ0VXdlBTUDJFMVAwYiIsIm1hYyI6ImM4NDgxZmEwN2ZhOTMwZTg1MTI4ZmM0MzA2YjUzNmRlOTM0MDc5OTA0', 'heru hoeruman', '2023-04-18 01:36:24', '2023-04-18 01:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `req_setposisi`
--

CREATE TABLE `req_setposisi` (
  `id` int(11) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `ematerai` varchar(255) NOT NULL,
  `estamp` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_ref_num` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `req_setposisi`
--

INSERT INTO `req_setposisi` (`id`, `kode`, `file_name`, `file_path`, `signature`, `ematerai`, `estamp`, `client_id`, `client_ref_num`, `timestamp`, `trx_id`, `created_at`, `updated_at`) VALUES
(30, '00', '643cf8717401d_Foto.pdf', 'dokumen/643cf8717401d_Foto.pdf', '[{\"email\": \"herui@gsp.co.id\",\"detail\": [{\"p\": 1,\"x\": 35,\"y\": 100,\"w\": 34,\"h\": 16}]}]', '', '', 'amj6Oqx234ON0kxFoFGt8wQeIRIapIby', '24681012', '2023-04-10T10:04:06+07:00', 'd9f49616-640e-4516-9b12-05adedc4c358', '2023-04-17 07:42:41', '2023-04-17 07:42:41'),
(31, '00', '643cfa1247532_Foto.pdf', 'dokumen/643cfa1247532_Foto.pdf', '[{\"email\": \"herui@gsp.co.id\",\"detail\": [{\"p\": 1,\"x\": 35,\"y\": 100,\"w\": 34,\"h\": 16}]}]', '', '', 'amj6Oqx234ON0kxFoFGt8wQeIRIapIby', '24681012', '2023-04-10T10:04:06+07:00', 'eceb7c26-e885-467b-969a-0b32cb1895ab', '2023-04-17 07:49:38', '2023-04-17 07:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `res_setposisi`
--

CREATE TABLE `res_setposisi` (
  `id` int(11) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `json` varchar(500) NOT NULL,
  `document_id` varchar(255) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `res_setposisi`
--

INSERT INTO `res_setposisi` (`id`, `kode`, `json`, `document_id`, `trx_id`, `created_at`, `updated_at`) VALUES
(1, '10', '{\"status\":\"OK\",\"ref_id\":\"98f38810-650c-4dd2-9796-7b73e75b2fc9\",\"code\":null,\"timestamp\":\"2023-04-17T14:41:12+07:00\",\"message\":null,\"data\":{\"id\":\"98f38810-90e6-4824-ab14-a5206277e9cf\",\"stamp\":[],\"sign\":[{\"teken_id\":\"HH283D00\",\"email\":\"heru@gsp.co.id\",\"url\":', '98f38810-90e6-4824-ab14-a5206277e9cf', 'be89f488-61a9-49f0-8b43-b35f4aa3ae52', '2023-04-17 07:41:12', '2023-04-17 07:41:12'),
(2, '10', '{\"status\":\"ERROR\",\"ref_id\":\"98f38b14-1740-46da-a31b-a3fbc975e62a\",\"code\":\"USER_UNREGISTER\",\"timestamp\":\"2023-04-17T14:49:38+07:00\",\"message\":[\"herui@gsp.co.id belum terdaftar.\"],\"data\":null}', '', 'eceb7c26-e885-467b-969a-0b32cb1895ab', '2023-04-17 07:49:38', '2023-04-17 07:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `trx_files`
--

CREATE TABLE `trx_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `response_upload` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `trx_files`
--

INSERT INTO `trx_files` (`id`, `file_name`, `file_path`, `response_upload`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', '2023-04-05 01:56:53', '2023-04-05 01:56:53'),
(2, '642cd7863237c_Dokumen1.7.pdf', 'dokumen/642cd7863237c_Dokumen1.7.pdf', '{\"status\":\"OK\",\"ref_id\":\"98daec5c-9a8c-496b-9830-755b78ed7525\",\"code\":null,\"timestamp\":\"2023-04-05T09:05:57+07:00\",\"message\":null,\"data\":{\"id\":\"98daec5c-c77a-44c3-bb06-57d2d17e2a56\",\"stamp\":[],\"sign\":[{\"teken_id\":\"HH283D00\",\"email\":\"heru@gsp.co.id\",\"url\":\"https://ttd.sandbox-111094.com/9awsNUnz1edLilM2\"}]}}', '2023-04-05 02:05:58', '2023-04-05 02:05:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `callback`
--
ALTER TABLE `callback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_setposisi`
--
ALTER TABLE `req_setposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `res_setposisi`
--
ALTER TABLE `res_setposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_files`
--
ALTER TABLE `trx_files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `callback`
--
ALTER TABLE `callback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `req_setposisi`
--
ALTER TABLE `req_setposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `res_setposisi`
--
ALTER TABLE `res_setposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trx_files`
--
ALTER TABLE `trx_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
