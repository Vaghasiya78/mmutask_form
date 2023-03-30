-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 06:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(11) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `profilepic` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `joiningdate` date NOT NULL,
  `hobby` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `ename`, `email`, `salary`, `department`, `lang`, `profilepic`, `description`, `joiningdate`, `hobby`, `password`) VALUES
(35, 'mehul', 'vd78@gmail.com', 78000, 'HR', 'hindi', '5.jpeg', 'This is nice value xfhdgncvndghcb', '2022-03-12', 'Singing,Other', '$2y$12$29Rn0QYI0jL5ik8L7SLDWOMy/AXDGGRMjTAanzjXtUk3KuBmlBeAC'),
(37, 'vaibhav', 'vd@gmail.com', 78000, 'HR', 'english', 'baju8.jpg', 'This is nice one for me', '2022-11-12', 'Coding,Other', '$2y$12$ELzHqfiJnehMWMB4BI5TieN0OEp8VDyg4WhaeC8UTLsnVMxpdNORG'),
(40, 'vaibhav', 'vd@gmail.com', 7874, 'HR', 'english', 'baju3.jpg', 'this is nice coding for all', '2023-03-01', 'Coding,Other', '$2y$12$.eFM/brmYxjDFIcN3y.YM.7pojXbHx9X9.Us7udnYZjJWjQjR0/Ja'),
(45, 'Vaibhav', 'vd@gmail.com', 234234, 'Devloper', 'hindi', '5.jpeg', '123456789iuyhgvccvghjkjnb', '2023-03-03', 'Coding,Teaching,Singing', ''),
(46, 'vaibhav Vaghasiya', 'vd@gmail.com', 234234, 'Devloper', 'english', '5.jpeg', 'snvzkhvzcbhvkvbhvdfkv', '2023-03-10', 'Coding', ''),
(47, 'vaibhav', 'vd@gmail.com', 234234, 'HR', 'english', 'WhatsApp Image 2023-03-09 at 09.27.05.jpg', '1234567890', '2023-03-11', 'Coding,Teaching', ''),
(49, 'vaibhav', 'Raj@gmail.com', 7874, 'HR', 'english', 'WhatsApp Image 2023-03-09 at 09.27.05.jpg', '2345678UYGV', '2023-03-08', 'Teaching', ''),
(50, 'vaibhav', 'test@gmail.com', 787400, 'HR', 'english', 's3.jpeg', '123456789', '2023-03-10', 'Teaching,Other', ''),
(51, 'mehul', 'vd78@gmail.com', 78000, 'HR', 'hindi', '', 'This is nice value xfhdgncvndghcb', '2022-03-12', 'Singing,Other', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
