-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 06:57 PM
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
-- Database: `aquasensedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `nh3readings`
--

CREATE TABLE `nh3readings` (
  `ID` int(11) NOT NULL,
  `POND_ID` int(11) NOT NULL,
  `NH3Level` decimal(3,3) NOT NULL,
  `Date_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o2readings`
--

CREATE TABLE `o2readings` (
  `ID` int(11) NOT NULL,
  `POND_ID` int(11) NOT NULL,
  `O2Level` decimal(3,3) NOT NULL,
  `Date_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phreadings`
--

CREATE TABLE `phreadings` (
  `ID` int(11) NOT NULL,
  `POND_ID` int(11) NOT NULL,
  `PHLevel` decimal(3,3) NOT NULL,
  `Date_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tempreadings`
--

CREATE TABLE `tempreadings` (
  `ID` int(11) NOT NULL,
  `POND_ID` int(11) NOT NULL,
  `TEMPLevel` decimal(3,3) NOT NULL,
  `Date_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userpond`
--

CREATE TABLE `userpond` (
  `POND_ID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `MinimO2` decimal(3,3) NOT NULL,
  `MinimNH3` decimal(3,3) NOT NULL,
  `MaxNH3` decimal(3,3) NOT NULL,
  `MinimPH` decimal(3,3) NOT NULL,
  `MaxPH` decimal(3,3) NOT NULL,
  `Mintemp_Celsius` decimal(3,3) NOT NULL,
  `Maxtemp_Celsius` decimal(3,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USERID` int(11) NOT NULL,
  `USERNAME` varchar(25) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `CONTACT` varchar(11) DEFAULT NULL,
  `DATECREATED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USERID`, `USERNAME`, `PASSWORD`, `CONTACT`, `DATECREATED`) VALUES
(1, 'japet', '$2y$10$eRkjdfg2sU1Z3aQz9E1ySOy3n9CefWkL9f8KLad7ZFoUdPYkpFZam\r\n', '09123456789', '2024-11-25 18:52:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nh3readings`
--
ALTER TABLE `nh3readings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `POND_ID` (`POND_ID`);

--
-- Indexes for table `o2readings`
--
ALTER TABLE `o2readings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `POND_ID` (`POND_ID`);

--
-- Indexes for table `phreadings`
--
ALTER TABLE `phreadings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `POND_ID` (`POND_ID`);

--
-- Indexes for table `tempreadings`
--
ALTER TABLE `tempreadings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `POND_ID` (`POND_ID`);

--
-- Indexes for table `userpond`
--
ALTER TABLE `userpond`
  ADD PRIMARY KEY (`POND_ID`),
  ADD KEY `USERID` (`USERID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nh3readings`
--
ALTER TABLE `nh3readings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o2readings`
--
ALTER TABLE `o2readings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phreadings`
--
ALTER TABLE `phreadings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tempreadings`
--
ALTER TABLE `tempreadings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userpond`
--
ALTER TABLE `userpond`
  MODIFY `POND_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nh3readings`
--
ALTER TABLE `nh3readings`
  ADD CONSTRAINT `nh3readings_ibfk_1` FOREIGN KEY (`POND_ID`) REFERENCES `userpond` (`POND_ID`);

--
-- Constraints for table `o2readings`
--
ALTER TABLE `o2readings`
  ADD CONSTRAINT `o2readings_ibfk_1` FOREIGN KEY (`POND_ID`) REFERENCES `userpond` (`POND_ID`);

--
-- Constraints for table `phreadings`
--
ALTER TABLE `phreadings`
  ADD CONSTRAINT `phreadings_ibfk_1` FOREIGN KEY (`POND_ID`) REFERENCES `userpond` (`POND_ID`);

--
-- Constraints for table `tempreadings`
--
ALTER TABLE `tempreadings`
  ADD CONSTRAINT `tempreadings_ibfk_1` FOREIGN KEY (`POND_ID`) REFERENCES `userpond` (`POND_ID`);

--
-- Constraints for table `userpond`
--
ALTER TABLE `userpond`
  ADD CONSTRAINT `userpond_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `users` (`USERID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
