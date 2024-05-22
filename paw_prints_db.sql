-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 06:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paw_prints_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_requests`
--

CREATE TABLE `adoption_requests` (
  `requestID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `status` enum('not processed yet','accepted','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `userID` int(11) NOT NULL,
  `petID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationID` int(11) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationID`, `location`) VALUES
(1, 'Beirut'),
(2, 'Byblos'),
(3, 'Sidon'),
(4, 'Tyre'),
(5, 'Tripoli');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `petID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `species` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `size` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`petID`, `userID`, `name`, `species`, `breed`, `color`, `gender`, `size`, `age`, `locationID`, `description`, `status`, `image_path`) VALUES
(1, 3, 'tom', 'cat', 'persian', 'white', 'male', 'medium', 3, 5, 'Smart Cat', 1, './backend/pets_images/1714760338594.jpg'),
(2, 3, 'rex', 'DOG', 'Border Collie', 'White', 'male', 'Medium', 4, 5, 'Quite and cute dog', 0, './backend/pets_images/IMG_66328ea60d12b5.88098211.jpeg'),
(3, 3, 'max', 'DOG', 'Golden Retriever', 'Black', 'female', 'Large', 1, 1, 'Very nice Dog', 0, './backend/pets_images/1714760338585.jpg'),
(4, 4, 'Carl', 'Puppy', 'Chiwawa', 'Red', 'female', 'medium', 15, 2, 'Cute little dog', 0, './backend/pets_images/IMG_66352adf369bb8.04652326.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed`
--

CREATE TABLE `recently_viewed` (
  `userID` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recently_viewed`
--

INSERT INTO `recently_viewed` (`userID`, `petID`, `timestamp`) VALUES
(3, 2, '2024-05-01 20:00:12'),
(3, 2, '2024-05-01 20:00:39'),
(3, 2, '2024-05-01 20:00:40'),
(3, 1, '2024-05-01 20:10:18'),
(3, 2, '2024-05-01 20:10:23'),
(3, 1, '2024-05-01 20:10:27'),
(3, 2, '2024-05-01 20:10:31'),
(3, 2, '2024-05-01 20:26:54'),
(3, 2, '2024-05-01 20:27:03'),
(3, 2, '2024-05-01 20:27:22'),
(3, 2, '2024-05-01 20:27:27'),
(3, 2, '2024-05-01 20:27:27'),
(3, 2, '2024-05-01 20:28:58'),
(3, 2, '2024-05-01 20:29:24'),
(3, 2, '2024-05-01 20:29:33'),
(3, 2, '2024-05-01 20:37:15'),
(3, 2, '2024-05-01 20:37:46'),
(3, 2, '2024-05-01 20:39:02'),
(3, 2, '2024-05-01 20:39:05'),
(3, 2, '2024-05-01 20:39:16'),
(3, 2, '2024-05-01 20:39:16'),
(3, 2, '2024-05-01 20:39:17'),
(3, 2, '2024-05-01 20:39:17'),
(3, 2, '2024-05-01 20:39:17'),
(3, 2, '2024-05-01 20:39:17'),
(3, 2, '2024-05-01 20:39:17'),
(3, 2, '2024-05-01 20:39:17'),
(3, 2, '2024-05-01 20:40:31'),
(3, 2, '2024-05-01 20:42:01'),
(3, 2, '2024-05-01 20:42:33'),
(3, 2, '2024-05-01 20:42:40'),
(3, 2, '2024-05-01 20:44:14'),
(3, 2, '2024-05-01 20:44:41'),
(3, 2, '2024-05-01 20:46:24'),
(3, 2, '2024-05-03 13:29:09'),
(3, 2, '2024-05-03 13:30:29'),
(3, 2, '2024-05-03 13:30:37'),
(3, 2, '2024-05-03 13:30:40'),
(3, 2, '2024-05-03 13:31:41'),
(3, 2, '2024-05-03 13:32:56'),
(3, 2, '2024-05-03 13:33:04'),
(3, 2, '2024-05-03 13:33:13'),
(3, 2, '2024-05-03 13:33:16'),
(3, 2, '2024-05-03 13:33:18'),
(3, 2, '2024-05-03 13:33:18'),
(3, 2, '2024-05-03 13:33:23'),
(3, 2, '2024-05-03 13:34:05'),
(3, 2, '2024-05-03 13:36:22'),
(3, 2, '2024-05-03 13:36:38'),
(3, 2, '2024-05-03 13:36:52'),
(3, 2, '2024-05-03 13:36:53'),
(3, 2, '2024-05-03 13:36:53'),
(3, 2, '2024-05-03 13:37:14'),
(3, 2, '2024-05-03 13:37:57'),
(3, 2, '2024-05-03 13:38:27'),
(3, 2, '2024-05-03 13:38:37'),
(3, 2, '2024-05-03 13:38:56'),
(3, 2, '2024-05-03 13:39:00'),
(3, 2, '2024-05-03 13:39:04'),
(3, 2, '2024-05-03 13:39:07'),
(3, 2, '2024-05-03 13:39:15'),
(3, 2, '2024-05-03 13:39:18'),
(3, 2, '2024-05-03 13:39:23'),
(3, 2, '2024-05-03 13:43:25'),
(3, 2, '2024-05-03 13:43:28'),
(3, 2, '2024-05-03 13:44:56'),
(3, 2, '2024-05-03 13:45:47'),
(3, 2, '2024-05-03 13:46:50'),
(3, 2, '2024-05-03 13:46:52'),
(3, 2, '2024-05-03 13:46:53'),
(3, 1, '2024-05-03 13:54:46'),
(3, 1, '2024-05-03 13:54:50'),
(3, 1, '2024-05-03 13:55:30'),
(3, 1, '2024-05-03 13:55:48'),
(3, 1, '2024-05-03 13:55:56'),
(3, 1, '2024-05-03 13:55:57'),
(3, 1, '2024-05-03 13:56:11'),
(3, 1, '2024-05-03 13:56:16'),
(3, 1, '2024-05-03 13:56:50'),
(3, 1, '2024-05-03 13:56:54'),
(3, 1, '2024-05-03 13:57:44'),
(3, 1, '2024-05-03 13:57:45'),
(3, 1, '2024-05-03 13:58:50'),
(3, 1, '2024-05-03 13:58:51'),
(3, 1, '2024-05-03 13:58:51'),
(3, 1, '2024-05-03 13:58:58'),
(3, 1, '2024-05-03 13:59:02'),
(3, 1, '2024-05-03 13:59:04'),
(3, 1, '2024-05-03 13:59:05'),
(3, 1, '2024-05-03 13:59:07'),
(3, 1, '2024-05-03 13:59:10'),
(3, 2, '2024-05-03 13:59:12'),
(3, 2, '2024-05-03 13:59:16'),
(3, 2, '2024-05-03 13:59:19'),
(3, 2, '2024-05-03 16:09:56'),
(3, 1, '2024-05-03 16:10:38'),
(3, 1, '2024-05-03 16:11:47'),
(3, 2, '2024-05-03 16:11:49'),
(3, 1, '2024-05-03 16:11:51'),
(3, 1, '2024-05-03 16:11:54'),
(3, 1, '2024-05-03 16:13:39'),
(3, 2, '2024-05-03 16:13:43'),
(3, 1, '2024-05-03 16:14:00'),
(3, 1, '2024-05-03 16:14:36'),
(3, 2, '2024-05-03 16:15:37'),
(3, 2, '2024-05-03 16:29:56'),
(3, 1, '2024-05-03 16:30:35'),
(3, 2, '2024-05-03 16:34:04'),
(3, 2, '2024-05-03 16:34:43'),
(3, 1, '2024-05-03 16:34:47'),
(3, 1, '2024-05-03 16:37:18'),
(3, 2, '2024-05-03 16:37:28'),
(3, 1, '2024-05-03 16:39:55'),
(3, 2, '2024-05-03 16:39:59'),
(3, 2, '2024-05-03 16:45:16'),
(3, 2, '2024-05-03 17:42:38'),
(3, 1, '2024-05-03 17:47:33'),
(3, 2, '2024-05-03 17:48:17'),
(3, 2, '2024-05-03 17:49:37'),
(3, 2, '2024-05-03 17:49:57'),
(3, 2, '2024-05-03 17:54:05'),
(3, 2, '2024-05-03 17:54:26'),
(3, 2, '2024-05-03 17:55:57'),
(3, 2, '2024-05-03 17:56:01'),
(3, 2, '2024-05-03 17:56:29'),
(3, 2, '2024-05-03 17:56:39'),
(3, 1, '2024-05-03 17:56:43'),
(3, 1, '2024-05-03 17:56:49'),
(3, 2, '2024-05-03 17:56:52'),
(3, 3, '2024-05-03 18:02:20'),
(3, 2, '2024-05-03 18:02:57'),
(3, 3, '2024-05-03 18:03:01'),
(3, 3, '2024-05-03 18:03:07'),
(3, 1, '2024-05-03 18:03:12'),
(4, 1, '2024-05-03 18:16:11'),
(4, 4, '2024-05-03 18:20:20'),
(4, 1, '2024-05-03 22:32:38'),
(4, 4, '2024-05-03 22:32:42'),
(4, 1, '2024-05-03 22:38:22'),
(4, 1, '2024-05-03 22:38:30'),
(3, 3, '2024-05-06 16:33:18'),
(3, 1, '2024-05-06 16:33:23'),
(3, 1, '2024-05-06 16:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `locationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `locationID`) VALUES
(3, 'test', '$2y$10$c5PrPIaFrF2gH7VQRBq59.n8.lGf/kPUAyvjDeVE.201T5H9Rxuam', 'test@gmail.com', 5),
(4, 'test1', '$2y$10$ffLbX7NoGa4I3nHYhLgM6e5gb5NQVDhlif2FIPmgjE5qryiUXZpV2', 'test1@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `petID` (`petID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`userID`,`petID`),
  ADD KEY `petID` (`petID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`petID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `locationID` (`locationID`);

--
-- Indexes for table `recently_viewed`
--
ALTER TABLE `recently_viewed`
  ADD KEY `userID` (`userID`),
  ADD KEY `petID` (`petID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `locationID` (`locationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`petID`) REFERENCES `pets` (`petID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adoption_requests_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`petID`) REFERENCES `pets` (`petID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_3` FOREIGN KEY (`petID`) REFERENCES `pets` (`petID`),
  ADD CONSTRAINT `favorites_ibfk_4` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pets_ibfk_2` FOREIGN KEY (`locationID`) REFERENCES `locations` (`locationID`);

--
-- Constraints for table `recently_viewed`
--
ALTER TABLE `recently_viewed`
  ADD CONSTRAINT `recently_viewed_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `recently_viewed_ibfk_2` FOREIGN KEY (`petID`) REFERENCES `pets` (`petID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `locations` (`locationID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
