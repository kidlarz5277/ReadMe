-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 01:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `readme_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `birthdate`) VALUES
(1, 'AD', 'MIN', 'admin123@gmail.com', '$2y$10$kbguKOPRAj.d/H5K3kIoneiR2sy5/nUdcveMm9Qwnnza6Mrdx/pL.', '2001-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(3, 'Allan Moore'),
(1, 'Jeph Loeb'),
(6, 'John Reppion'),
(2, 'Joshua Williamson'),
(7, 'Mark Verheiden'),
(4, 'Mark Waid'),
(5, 'Scott Snyder ');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `comicID` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `userID`, `comicID`, `added_at`) VALUES
(18, 2, 2, '2025-05-18 04:53:37'),
(19, 2, 9, '2025-05-18 05:57:35'),
(20, 2, 6, '2025-05-18 13:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

CREATE TABLE `comics` (
  `id` int(11) NOT NULL,
  `comicName` varchar(255) NOT NULL,
  `authorID` int(11) NOT NULL,
  `genreID` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comics`
--

INSERT INTO `comics` (`id`, `comicName`, `authorID`, `genreID`, `price`, `description`, `file_path`, `cover_image`, `uploaded_at`) VALUES
(2, 'Batman and Robin - Year 1 (2024) ', 4, 1, 99.00, 'While Bruce Wayne adjusts to the realities of adopting orphan Dick Grayson, a mysterious new crime boss called the General has come to Gotham to claim the city by disrupting and destroying its other mobs.', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747213316_Batman & Robin - Year One 001 (2024) (Webrip) (The Last Kryptonian-DCP).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747213316_coverpage(BRY1).jpeg', '2025-05-14 09:01:56'),
(3, 'Absolute Batman #8 (2025)', 5, 1, 79.00, 'Batman is in the fight for his life against this icy new threat. But in the end, what terrifying truth will be unearthed about Ark M and…Joker?', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747288174_Absolute Batman 008 (2025) (Webrip) (The Last Kryptonian-DCP).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747288174_Absolute-Batman-8-1.jpg', '2025-05-15 05:49:34'),
(4, 'Sherlock Holmes – The Vanishing Man #4 (2018)', 6, 2, 59.00, 'The mystery of Michael Williams comes to its shocking conclusion. But will Holmes and Watson survive the deep running conspiracy gripping London from its very core? And even if they do, are they safe from the machinations of their greatest foe, the all-too-clever Moriarty? ', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747288533_Sherlock Holmes - The Vanishing Man 004 (2018) (digital) (Son of Ultron-Empire).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747288533_images.jpg', '2025-05-15 05:55:33'),
(6, 'Archie #4 (2015)', 4, 4, 3.99, 'The biggest comic series of the year continues! What was the &#34;lipstick incident&#34; that pushed Archie and Betty apart? And can the smartest boy in Riverdale fix it? The spotlight is on Dilton and Moose as, together, they show what friendship is really all about! We&#39;re pleased to welcome Annie Wu (Black Canary, Hawkeye) to Riverdale, as she takes over art duties in this brand-new issue!', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747370331_Archie 004 (2016) GetComics.INFO.pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747370331_archie-2015-4.jpg', '2025-05-16 04:38:51'),
(7, 'Evil Dead #1 (2008)', 7, 5, 59.99, 'Five friends from suburban Michigan travel to the backwoods of Tennessee for a weekend trip to a secluded cabin in the woods. Upon their arrival, the group discover the belongings of the cabin&#39;s previous renter (who, according to local legend, went crazy and killed his wife before mysteriously disappearing), one of which being a strange old book. After listening to a recording left behind by the last inhabitant, ancient demonic spirits are awakened, consuming the souls of the group until only one man remains.', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747493996_Evil Dead 01 (of 04) (2008) (Minutemen-ReZone).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747493996_EvilDead2008-1.jpg', '2025-05-17 14:59:56'),
(8, 'Evil Dead #2 (2008)', 7, 5, 59.99, 'Five friends from suburban Michigan travel to the backwoods of Tennessee for a weekend trip to a secluded cabin in the woods. Upon their arrival, the group discover the belongings of the cabin&#39;s previous renter (who, according to local legend, went crazy and killed his wife before mysteriously disappearing), one of which being a strange old book. After listening to a recording left behind by the last inhabitant, ancient demonic spirits are awakened, consuming the souls of the group until only one man remains.', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747494048_Evil Dead 02 (of 04) (2008) (Minutemen-Zone).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747494048_EvilDead2008-2.jpg', '2025-05-17 15:00:48'),
(9, 'Evil Dead #3 (2008)', 7, 5, 59.99, 'Five friends from suburban Michigan travel to the backwoods of Tennessee for a weekend trip to a secluded cabin in the woods. Upon their arrival, the group discover the belongings of the cabin&#39;s previous renter (who, according to local legend, went crazy and killed his wife before mysteriously disappearing), one of which being a strange old book. After listening to a recording left behind by the last inhabitant, ancient demonic spirits are awakened, consuming the souls of the group until only one man remains.', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747494151_Evil Dead 03 (of 04) (2008) (Minutemen-ReZone).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747494151_EvilDead2008-3.jpg', '2025-05-17 15:02:31'),
(10, 'Evil Dead #4 (2008)', 7, 5, 59.99, 'Five friends from suburban Michigan travel to the backwoods of Tennessee for a weekend trip to a secluded cabin in the woods. Upon their arrival, the group discover the belongings of the cabin&#39;s previous renter (who, according to local legend, went crazy and killed his wife before mysteriously disappearing), one of which being a strange old book. After listening to a recording left behind by the last inhabitant, ancient demonic spirits are awakened, consuming the souls of the group until only one man remains.', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747494192_Evil Dead 04 (2008) (RacerX-DCP).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747494192_EvilDead2008-4.jpg', '2025-05-17 15:03:12'),
(11, 'Sherlock Holmes – The Vanishing Man #2 (2018)', 6, 2, 45.00, 'Holmes and Watson continue their investigation into the disappearance of Michael Williams, discovering that they are not the only ones tracking him. This indicates that a third party is also interested in Williams&#39;s fate, adding an element of mystery to the case. The search for Williams intensifies, with Holmes and Watson facing new challenges and uncovering further clues along the way. ', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747494887_Sherlock Holmes - The Vanishing Man 002 (2018) (digital) (Son of Ultron-Empire).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747494887_91AmSQRtfiL._UF1000,1000_QL80_.jpg', '2025-05-17 15:14:47'),
(12, 'Sherlock Holmes – The Vanishing Man #3 (2018)', 6, 2, 49.99, 'Holmes&#39; investigation into the disappearance of Michael Williams intensifies, bringing him closer to danger and exposing Moriarty&#39;s sinister plot. As Holmes delves deeper into the case, he faces increased risks, and the story likely continues to explore the complex relationship between Holmes and his arch-nemesis, Moriarty. The synopsis suggests that the issue will further unravel the secrets surrounding Williams&#39; disappearance and Moriarty&#39;s manipulative scheme. ', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/comics/1747495274_Sherlock Holmes - The Vanishing Man 003 (2018) (digital) (Son of Ultron-Empire).pdf', 'C:\\xampp\\htdocs\\ReadMe Comics/uploads/covers/1747495274_5162KdOU9FL._AC_SY200_QL15_.jpg', '2025-05-17 15:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`email`, `message`, `user_id`) VALUES
('ampi@gmail.com', 'BOBO', 2),
('ampi@gmail.com', 'lyka pangit AHSHAHSAHSH', 2);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Action'),
(5, 'Horror'),
(2, 'Mystery'),
(4, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `birthdate`, `email`, `password`) VALUES
(2, 'Jasper', 'Manayaga', '2001-05-30', 'ampi@gmail.com', '$2y$10$XC6c4cBSijdkgKV.ild47u7CPyczV53uFx.S04sT/VAe23unQxRWy'),
(3, 'Jan Kris', 'Avila', '1998-12-25', 'avila@gmail.com', '$2y$10$LWq6Rbh0tWYV87k5yntK/OMJWyQkpKwgTl5u1FRVUHUyx8PkVKE7e'),
(4, 'Geizle', 'Ellevera', '2003-02-23', 'geizle@gmail.com', '$2y$10$ZUtvUoNE9KRSkc2S43G24eumn4C8kdotAEPZ3J7IyMgwSAmXXYvQu'),
(5, 'Diosdado', 'Bastida', '2005-07-29', 'bastida@gmail.com', '$2y$10$hsnlJV5o5iqZQEdthRr93eG.PvA4arBYavY2nQ5TgNHDcxMzBK3o.'),
(6, 'Paul', 'Valcorza', '2006-07-21', 'paul@gmail.com', '$2y$10$Y9gFCsENA17vllZC8KMNKujfggcqUyE6VOxexXvlojliDnZ/dTzfy'),
(7, 'Clyde', 'Lumandong', '2001-02-21', 'cyde@gmail.com', '$2y$10$71UYeCRvkcZwbyg0F7N.fuMblgSGjoTAx4a89h6YCkY9chVhQkrUa'),
(8, 'James', 'Manayaga', '1977-07-21', 'james@gmail.com', '$2y$10$IEcjTvbCsubqey6vRmWjAODlvPP3RIjvI7K3n6FjXgWrCaj6uCdXq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `idx_authorName` (`name`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `comicID` (`comicID`);

--
-- Indexes for table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorID` (`authorID`),
  ADD KEY `genreID` (`genreID`),
  ADD KEY `idx_comicName` (`comicName`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `idx_genreName` (`name`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`comicID`) REFERENCES `comics` (`id`);

--
-- Constraints for table `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `comics_ibfk_1` FOREIGN KEY (`authorID`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comics_ibfk_2` FOREIGN KEY (`genreID`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
