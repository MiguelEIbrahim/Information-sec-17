-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 06:34 PM
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
-- Database: `upler`
--

-- --------------------------------------------------------

--
-- Table structure for table `bohemian`
--

CREATE TABLE `bohemian` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `AnonymizedIP` varchar(255) NOT NULL,
  `HashedMAC` varchar(255) NOT NULL,
  `EncryptedMessage` varbinary(4096) NOT NULL,
  `IV` varbinary(16) NOT NULL,
  `Email` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pokes`
--

CREATE TABLE `pokes` (
  `Bohemian_ID` int(11) DEFAULT NULL,
  `Yondora_Name` varchar(550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yondora`
--

CREATE TABLE `yondora` (
  `Name` varchar(550) NOT NULL,
  `Elder` int(11) NOT NULL,
  `Num_Times_Poked` int(11) NOT NULL,
  `Evil_Plan` varchar(6600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yondora`
--

INSERT INTO `yondora` (`Name`, `Elder`, `Num_Times_Poked`, `Evil_Plan`) VALUES
('Adalyn Keller', 29, 6, 'Adalyn focuses on environmental sustainability and the promotion of green energy.'),
('Alice Johnson', 45, 10, 'Alice aims to implement comprehensive education reforms that focus on reducing disparities, increasing access to quality education, and integrating technology in classrooms.'),
('Arthur Morgan', 36, 7, 'Arthur aims to protect natural resources and promote conservation.'),
('Bob Smith', 52, 15, 'Bob is focused on himself, he says bamboos are very tasty.'),
('Circe', 870, 6, 'Circe has a large hate in her heart but shes a good person, she promises to be a good chemist'),
('Diana Prince', 5000, 20, 'Diana focuses on global peacekeeping and the promotion of justice around the world.'),
('Elon Musk', 49, 25, 'Elon aims to colonize Mars and revolutionize transportation on Earth.'),
('Frodo Baggins', 33, 12, 'Frodo is committed to destroying powerful artifacts to save Middle-earth.'),
('James Bond', 40, 28, 'James is focused on protecting the world from global threats using his espionage skills.'),
('Katherine Pierce', 32, 11, 'Katherine seeks to enhance public education and teacher support.'),
('Merida', 40, 6, 'Penny advocates for educational equity and access to quality education.'),
('Quincy Adams', 37, 9, 'Quincy works on technological advancements and digital security.'),
('Thor', 1500, 5, 'Thor is quite focused on protecting human rights, he says he wants to bring his mjolnir down on justice, no idea what that means.'),
('Tony Stark', 48, 27, 'Tony uses his genius to develop advanced technologies and defend the Earth from various threats.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bohemian`
--
ALTER TABLE `bohemian`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pokes`
--
ALTER TABLE `pokes`
  ADD KEY `Bohemian_ID` (`Bohemian_ID`),
  ADD KEY `Yondora_Name` (`Yondora_Name`);

--
-- Indexes for table `yondora`
--
ALTER TABLE `yondora`
  ADD PRIMARY KEY (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bohemian`
--
ALTER TABLE `bohemian`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pokes`
--
ALTER TABLE `pokes`
  ADD CONSTRAINT `pokes_ibfk_1` FOREIGN KEY (`Bohemian_ID`) REFERENCES `bohemian` (`ID`),
  ADD CONSTRAINT `pokes_ibfk_2` FOREIGN KEY (`Yondora_Name`) REFERENCES `yondora` (`Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
