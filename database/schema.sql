-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Sty 15, 2025 at 10:34 PM
-- Wersja serwera: 8.0.40
-- Wersja PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `albums`
--

CREATE TABLE `albums` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `song_list` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `user_id`, `name`, `description`, `image_url`, `song_list`) VALUES
(12, 1, 'Highway 61 Revisited', 'Bob Dylan', 'https://upload.wikimedia.org/wikipedia/en/9/95/Bob_Dylan_-_Highway_61_Revisited.jpg', '[\"Like a Rolling Stone\", \"Tombstone Blues\"]'),
(13, 2, 'Remain in Light', 'Talking Heads', 'https://upload.wikimedia.org/wikipedia/en/2/2d/TalkingHeadsRemaininLight.jpg', '[\"Once in a Lifetime\", \"Houses in Motion\"]'),
(14, 1, 'Meddle', 'Pink Floyd', 'https://upload.wikimedia.org/wikipedia/en/d/d4/MeddleCover.jpeg', '[\"Echoes\", \"One of These Days\"]'),
(15, 2, 'Abbey Road', 'The Beatles', 'https://upload.wikimedia.org/wikipedia/en/4/42/Beatles_-_Abbey_Road.jpg', '[\"Come Together\", \"Here Comes the Sun\"]');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'user', 'user@mail.com', '$2y$10$giTxihcjH6clh./JTnTgserOQqj5TVHdoxyGzrRVxJ8.rFl1O3M1O', 'user', '2025-01-11 15:42:02'),
(2, 'user2', 'user2@email.com', '$2y$10$f64fz7lv4q1w3yyEDaszpu48Uko5GfSsTGahifF5Nktfnma.7UEPy', 'user', '2025-01-12 13:47:22'),
(5, 'admin', 'admin@mail.com', '$2y$10$ETSY8TKZcK6P.NolekyOr.3oFtrdlNdX6A3MqUakLbk/n858X3ulG', 'admin', '2025-01-12 20:52:57'),
(6, 'user3', 'user3@mail.com', '$2y$10$4Cx.7febZQ0spKPMxrKQDuLNUlWZGN3uhVWHAKJ4TRfXkYmorR5WW', 'user', '2025-01-14 22:43:22');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
