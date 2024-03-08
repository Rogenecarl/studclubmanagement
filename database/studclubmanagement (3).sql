-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 06:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studclubmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `clubmembers`
--

CREATE TABLE `clubmembers` (
  `ClubID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `StudentName` varchar(200) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubmembers`
--

INSERT INTO `clubmembers` (`ClubID`, `StudentID`, `StudentName`, `Status`) VALUES
(0, 0, '', 0),
(0, 1111111, 'dfsdfsfsdf', 0),
(3, 23424, 'hhhhhhh', 2),
(3, 56783, 'Bajig rosalijos', 2),
(14, 234234, 'heheheh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clubofficers`
--

CREATE TABLE `clubofficers` (
  `ClubID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `StudentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubofficers`
--

INSERT INTO `clubofficers` (`ClubID`, `StudentID`, `Position`, `StudentName`) VALUES
(2, 9, 'Vice President', 'Liam Davis'),
(2, 10, 'Secretary', 'Zoey Adams'),
(2, 11, 'Treasurer', 'Noah Garcia'),
(3, 15, 'President', 'Benjamin Cooper'),
(3, 17, 'Secretary', 'Caleb Martinez'),
(3, 18, 'Treasurer', 'Lily Johnson'),
(3, 123, 'President', 'Sam'),
(3, 3234, 'Vice President', 'HEhehe'),
(3, 12355, 'President', 'hsdfsdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `ClubID` int(11) NOT NULL,
  `ClubLogo` varchar(255) NOT NULL,
  `ClubName` varchar(255) NOT NULL,
  `Status` enum('Accredited','Not Accredited') NOT NULL DEFAULT 'Not Accredited'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`ClubID`, `ClubLogo`, `ClubName`, `Status`) VALUES
(2, 'uploads/desktop-wallpaper-rimuru-tempest-tensei-shitara-slime-datta-ken-background-slime-anime.jpg', 'Chess Club', 'Accredited'),
(3, 'uploads/logout.png', 'Debate Club', 'Not Accredited'),
(4, 'uploads/signature (2).png', 'Art Club', 'Accredited'),
(5, '', 'Music Clubb', 'Accredited'),
(6, '', 'Drama Club', 'Accredited'),
(7, '', 'PGITS Club', 'Not Accredited'),
(8, '', 'GMITS Club', 'Not Accredited'),
(9, '', 'PSITS Club', 'Accredited'),
(10, '', 'Robotics Club', 'Accredited'),
(11, '', 'Literature Club', 'Accredited'),
(12, '', 'Film Club', 'Accredited'),
(13, '', 'Math Club', 'Not Accredited'),
(14, '', 'Sports Club', 'Not Accredited'),
(15, '', 'Cooking Club', 'Not Accredited'),
(16, '', 'Astronomy Club', 'Not Accredited'),
(17, '', 'Dance Club', 'Not Accredited'),
(18, '', 'Photography Club', 'Not Accredited'),
(19, '', 'Volunteer Club', 'Not Accredited'),
(20, '', 'Foreign Language Club', 'Not Accredited');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'sabir@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubmembers`
--
ALTER TABLE `clubmembers`
  ADD PRIMARY KEY (`ClubID`,`StudentID`);

--
-- Indexes for table `clubofficers`
--
ALTER TABLE `clubofficers`
  ADD PRIMARY KEY (`ClubID`,`StudentID`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`ClubID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clubofficers`
--
ALTER TABLE `clubofficers`
  ADD CONSTRAINT `clubofficers_ibfk_1` FOREIGN KEY (`ClubID`) REFERENCES `clubs` (`ClubID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
