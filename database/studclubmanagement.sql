-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 07:26 AM
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
(2, 59788, 'Olivia Anderson', 0),
(2, 59789, 'Ethan Johnson', 0),
(2, 598099, 'Charlotte Lewis', 0),
(3, 59790, 'Liam Davis', 0),
(3, 59791, 'Ava Thompson', 0),
(4, 59792, 'Sophia Martinez', 0),
(4, 59793, 'Jackson Taylor', 0),
(6, 59794, 'Emma Brown', 0),
(6, 59795, 'Noah White', 0),
(7, 59796, 'Isabella Garcia', 0),
(7, 59797, 'Aiden Smith', 0),
(7, 597991, 'Elijah Clark', 0),
(8, 597988, 'Mia Miller', 0),
(8, 597989, 'Lucas Harris', 0),
(9, 597990, 'Harper Wilson', 0),
(9, 597991, 'Charlotte Lewis', 0),
(10, 597993, 'Benjamin Turner', 0),
(10, 597994, 'Abigail Hall', 0),
(11, 597995, 'Henry Wright', 0),
(11, 597996, 'Charlotte Lewis', 0),
(12, 597997, 'Benjamin Turner', 0),
(12, 597998, 'Abigail Hall', 0),
(13, 597999, 'Henry Wright', 0);

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
(2, 'uploads/chess.jpg', 'Chess Club', 'Accredited'),
(3, 'uploads/debate.jfif', 'Debate Club', 'Not Accredited'),
(4, 'uploads/art club.jfif', 'Art Club', 'Accredited'),
(5, 'uploads/music logo.jfif', 'Music Club', 'Accredited'),
(6, 'uploads/dramaclub.jfif', 'Drama Club', 'Accredited'),
(7, 'uploads/pgits.jfif', 'PGITS Club', 'Not Accredited'),
(8, 'uploads/gmits.jfif', 'GMITS Club', 'Not Accredited'),
(9, 'uploads/psits.jfif', 'PSITS Club', 'Accredited'),
(10, 'uploads/robotics.jfif', 'Robotics Club', 'Accredited'),
(11, 'uploads/Literature.jfif', 'Literature Club', 'Accredited'),
(12, 'uploads/film club.jfif', 'Film Club', 'Accredited'),
(13, 'uploads/math.jfif', 'Math Club', 'Not Accredited'),
(14, 'uploads/sports.jfif', 'Sports Club', 'Not Accredited'),
(15, 'uploads/cooking.jfif', 'Cooking Club', 'Not Accredited'),
(16, 'uploads/astronomy.jfif', 'Astronomy Club', 'Not Accredited'),
(17, 'uploads/dance.jfif', 'Dance Club', 'Not Accredited'),
(18, 'uploads/photography.jfif', 'Photography Club', 'Not Accredited'),
(19, 'uploads/volunteer.jfif', 'Volunteer Club', 'Not Accredited'),
(20, 'uploads/foregin.jfif', 'Foreign Language Club', 'Not Accredited');

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
