-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 12:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_bumberger_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_bumberger_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_bumberger_petadoption`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animalID` int(11) NOT NULL,
  `animalName` varchar(30) DEFAULT NULL,
  `img` varchar(600) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `size` enum('small','large') DEFAULT 'small',
  `age` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animalID`, `animalName`, `img`, `gender`, `size`, `age`, `description`, `city`, `zip`, `address`) VALUES
(1, 'Lea', 'https://s3.amazonaws.com/cdn-origin-etr.akc.org/wp-content/uploads/2017/11/12223307/Vizsla-On-White-01.jpg', 'male', 'small', 1, 'A lovely little 1 year old dog', 'NY', '98248', 'Highway Blv 3'),
(2, 'Anna', 'https://s3.amazonaws.com/cdn-origin-etr.akc.org/wp-content/uploads/2017/11/12223307/Vizsla-On-White-01.jpg', 'male', 'small', 2, 'A lovely little 2 year old dog', 'NY', '98248', 'Highway Blv 3'),
(3, 'Bruce', 'https://dogtime.com/assets/uploads/2011/01/file_22998_weimaraner.jpg', 'male', 'small', 0, 'Bruce by day, Batman by night\'s', 'Boston', '980', 'Anthony Rd. 7'),
(5, 'Alfred', 'https://dogtime.com/assets/uploads/2011/01/file_23024_greyhound-460x290.jpg', 'male', 'large', 9, 'Fast and Faster', 'Goerge Town', '7987', 'Bible Str. 87'),
(6, 'Tom', 'https://dogtime.com/assets/uploads/2011/01/file_23024_greyhound-460x290.jpg', 'male', 'large', 9, '2 Fast 2 Furious ', 'Goerge Town', '7987', 'Bible Str. 87'),
(7, 'Elisa', 'https://img3.goodfon.com/wallpaper/nbig/8/2b/kot-kotenok-seryy-belyy-fon.jpg', 'male', 'small', 12, 'Don\'t touch it', 'Washington DC', '840', 'Abe Road 7'),
(8, 'Ella', 'https://photosfine.files.wordpress.com/2012/04/fish-white-background-4.jpg', 'female', 'small', 15, 'Who am I?', 'Washington DC', '8978', 'Clinton Blv. 7'),
(9, 'Echo', 'https://image.freepik.com/free-photo/puppy-newfoundland-dog-front-white-background_87557-16723.jpg', 'male', 'large', 2, 'Big or Bigger', 'Anchorage', '849A', 'Accka Street 97'),
(10, 'Bicko', 'https://image.freepik.com/free-photo/puppy-newfoundland-dog-front-white-background_87557-16723.jpg', 'male', 'large', 1, 'Large or Larger', 'Anchorage', '849A', 'Accka Street 97');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userType` enum('superadmin','admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userPass`, `userType`) VALUES
(2, 'aaa', 'aa@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'superadmin'),
(3, 'bbb', 'bb@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'admin'),
(5, 'ccc', 'cc@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animalID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
