-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2025 at 03:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_to`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` text,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `create_at`) VALUES
(1, 1, 'Digital lahir dari sebuah Analog', 'Orang bilang Analog tua, kuno, sudah tidak relevan di masa sekarang.Mereka lupa dari Analog lah Digital ada', '2025-05-07 10:25:54'),
(3, 2, 'TryOut UAS', 'Ternyata bikin Web mudah kalau pakai ChatGpt hehe:) aku gangerti nyusun kodenya tapi paham alurnya. Pertama-tama aku buat file koneksi dulu, baru buat authnya, baru beranda, dashboard, terakhir fitur lanjutan kaya tambah edit hapus.Sejauh ini aku masih suka ngoding, gatau nanti.Ini juga salah satu tugas buat web yang guruku kasih, karena sebelumnya aku udah buat web jadi pas dikasi tugas ini aku lumayan ngerti.Aku ngerti dari bagian auth sampai bikin navbar, selanjutnya aku nanya ChatGpt:) Semoga kedepannya aku bisa nyusun kodenya sendiri tanpa buka file lama :))))', '2025-05-07 11:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Sea Turtle', 'vitaminsea@gmail.com', '$2y$10$n4CxfjHBZYJnvvhcZc6FAufx0kNTmAFeDCACt8gpCdyOPq341UTES'),
(2, 'Andi', 'andirifki@yahoo.com', '$2y$10$0tGsMvFqP4byjvW5HueKducMrgHEy3xV/nKm8AugT/D.vncbDk0ti');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_post` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_user_post` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
