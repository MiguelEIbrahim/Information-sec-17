-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 10:48 AM
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
  `IV` varbinary(16) NOT NULL
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
('Beatrice Hayes', 48, 10, 'Beatrice advocates for disability rights and inclusion.'),
('Benedict Clark', 54, 9, 'Benedict aims to modernize the healthcare system and make it more accessible.'),
('Bob Smith', 52, 15, 'Bob is focused on himself, he says bamboos are very tasty.'),
('Caleb Pierce', 29, 6, 'Caleb works on improving educational outcomes and reducing student debt.'),
('Cassandra Blake', 33, 14, 'Cassandra works on criminal justice reform and reducing incarceration rates.'),
('Charles Brown', 38, 7, 'Charles plans to reduce crime rates by increasing community policing and funding social programs.'),
('Damien Thorn', 45, 2, 'Damien seeks to manipulate global politics to his advantage.'),
('Delilah Moore', 31, 11, 'Delilah promotes gender equality and women empowerment.'),
('Diana Prince', 5000, 20, 'Diana focuses on global peacekeeping and the promotion of justice around the world.'),
('Elias Bennett', 45, 8, 'Elias focuses on rural development and agricultural innovation.'),
('Elon Musk', 49, 25, 'Elon aims to colonize Mars and revolutionize transportation on Earth.'),
('Evangeline Lee', 38, 12, 'Evangeline promotes mental health awareness and support.'),
('Fiona Clark', 38, 12, 'Fiona works on environmental protection and wildlife conservation.'),
('Frederick OConnell', 50, 13, 'Frederick focuses on economic policies to reduce poverty and unemployment.'),
('Frodo Baggins', 33, 12, 'Frodo is committed to destroying powerful artifacts to save Middle-earth.'),
('Gandalf the Grey', 2019, 30, 'Gandalf works tirelessly to balance the forces of good and evil in Middle-earth.'),
('Gillian Parker', 41, 7, 'Gillian advocates for womens rights and gender equality.'),
('Gregory Scott', 50, 9, 'Gregory advocates for comprehensive healthcare reform and universal coverage.'),
('Hannah Ellis', 33, 5, 'Hannah promotes mental health awareness and support services.'),
('Harrison Wells', 49, 5, 'Harrison works on advanced scientific research and innovation.'),
('Harry Potter', 18, 18, 'Harry is dedicated to fighting dark forces and ensuring the safety of the wizarding world.'),
('Indiana Jones', 42, 22, 'Indiana seeks to recover and preserve ancient artifacts while thwarting nefarious plots.'),
('Isaac Turner', 41, 13, 'Isaac works on criminal justice reform and reducing incarceration rates.'),
('Isla Donovan', 36, 10, 'Isla promotes cultural heritage and the arts.'),
('James Bond', 40, 28, 'James is focused on protecting the world from global threats using his espionage skills.'),
('Jasper King', 29, 8, 'Jasper aims to improve infrastructure and public transportation systems.'),
('Juliet Hayes', 30, 7, 'Juliet focuses on public safety and emergency preparedness.'),
('Katherine Pierce', 32, 11, 'Katherine seeks to enhance public education and teacher support.'),
('Katniss Everdeen', 17, 13, 'Katniss aims to overthrow oppressive regimes and bring justice to her people.'),
('Kieran Hart', 46, 8, 'Kieran promotes technological innovation and digital literacy.'),
('Lara Croft', 35, 19, 'Lara explores ancient tombs and seeks to uncover historical truths.'),
('Lena Clark', 35, 6, 'Lena advocates for public transportation improvements and sustainable urban development.'),
('Leonardo Silva', 47, 9, 'Leonardo works on immigration reform and integration policies.'),
('Luke Skywalker', 53, 21, 'Luke works to rebuild the Jedi Order and maintain peace in the galaxy.'),
('Madeline Hart', 30, 7, 'Madeline promotes renewable energy and climate change mitigation.'),
('Miles Reed', 39, 11, 'Miles works on reducing carbon emissions and promoting green energy.'),
('Nathaniel Wright', 53, 15, 'Nathaniel focuses on national security and defense strategies.'),
('Neo', 36, 16, 'Neo is committed to freeing humanity from virtual enslavement.'),
('Nina Walker', 28, 9, 'Nina focuses on affordable housing and homelessness prevention.'),
('Ophelia Grant', 40, 6, 'Ophelia advocates for social justice and human rights.'),
('Optimus Prime', 5000, 26, 'Optimus leads the Autobots in their fight against the Decepticons to protect Earth.'),
('Oscar King', 53, 14, 'Oscar promotes international cooperation and peacebuilding.'),
('Penny Morris', 40, 6, 'Penny advocates for educational equity and access to quality education.'),
('Percival Black', 35, 4, 'Percival aims to develop urban areas and reduce homelessness.'),
('Peter Parker', 23, 14, 'Peter uses his powers to fight crime and protect the citizens of New York City.'),
('Quentin Tarantino', 60, 4, 'Quentin aims to create groundbreaking films that challenge societal norms.'),
('Quincy Adams', 37, 9, 'Quincy works on technological advancements and digital security.'),
('Quinn Reed', 34, 7, 'Quinn works on public health initiatives and disease prevention.'),
('Rebecca Lee', 44, 10, 'Rebecca promotes public health initiatives and disease prevention.'),
('Rick Sanchez', 70, 34, 'Rick seeks to explore and understand the multiverse while creating advanced technologies.'),
('Riley Black', 38, 12, 'Riley focuses on social justice and human rights advocacy.'),
('Samantha Young', 32, 10, 'Samantha promotes economic development and job creation.'),
('Sarah Connor', 45, 23, 'Sarah is focused on preventing the rise of Skynet and protecting humanity from machines.'),
('Sebastian Clarke', 52, 12, 'Sebastian focuses on foreign policy and international relations.'),
('Tabitha Collins', 31, 8, 'Tabitha works on improving public transportation and reducing traffic congestion.'),
('Thomas Gray', 47, 13, 'Thomas works on infrastructure improvements and urban planning.'),
('Thor', 1500, 5, 'Thor is quite focused on protecting human rights, he says he wants to bring his mjolnir down on justice, no idea what that means.'),
('Tony Stark', 48, 27, 'Tony uses his genius to develop advanced technologies and defend the Earth from various threats.'),
('Ultron', 5, 3, 'Ultron aims to bring about the evolution of artificial intelligence.'),
('Ulysses Grant', 55, 11, 'Ulysses advocates for veteran support and military families.'),
('Ursula Dean', 41, 9, 'Ursula advocates for environmental sustainability and climate action.'),
('Victoria Hale', 43, 13, 'Victoria promotes access to clean water and sanitation in underserved areas.'),
('Vince Hale', 45, 8, 'Vince focuses on national security and defense strategies.'),
('Vito Corleone', 60, 8, 'Vito works to maintain and expand his crime family influence and power.'),
('Walter White', 50, 17, 'Walter seeks to build a drug empire while battling terminal illness.'),
('Wesley Kane', 39, 6, 'Wesley works on criminal justice reform and reducing recidivism rates.'),
('Willow Brooks', 36, 6, 'Willow promotes cultural heritage and the arts.'),
('Xander Brooks', 28, 7, 'Xander focuses on cybersecurity and protecting personal data.'),
('Xavier Lane', 28, 7, 'Xavier works on digital security and cybersecurity initiatives.'),
('Xena', 30, 12, 'Xena travels the world seeking redemption and fighting for justice.'),
('Yasmine Ali', 34, 5, 'Yasmine promotes affordable housing and urban development.'),
('Yoda', 900, 29, 'Yoda trains new generations of Jedi and imparts wisdom on the forces of the universe.'),
('Zachary Quinn', 42, 9, 'Zachary works on economic policies to boost small businesses and entrepreneurship.'),
('Zorro', 35, 11, 'Zorro fights for justice and defends the common people from corruption.');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
