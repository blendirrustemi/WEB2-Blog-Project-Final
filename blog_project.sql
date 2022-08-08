-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 11:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_project`
--

CREATE DATABASE IF NOT EXISTS `blog_project`;
use `blog_project`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `C_ID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `P_ID` int(11) DEFAULT NULL,
  -- `U_ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`C_ID`, `Comment`, `P_ID`, `username`) VALUES
(16, 'WOOO COOl', 28, 'detib'),
(17, 'Nice Blog Man', 26,'detib'),
(18, 'NICE ONE', 28, 'blendi'),
(19, 'GOOD TO KNOW', 27, 'blendi'),
(20, 'JavaScript is used to develop interactive web applications. JavaScript can power featured like interactive images, carousels, and forms. The language can be used with back-end frameworks like Node. js to power the mechanics behind a web page, such as form processing and payments', 28, 'dea'),
(21, 'i love python', 27, 'dea'),
(22, 'wowowoow', 26, 'dea');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `P_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`P_ID`, `Title`, `Content`, `Date`) VALUES
(26, 'PHP', 'PHP is a general-purpose scripting language geared toward web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is now produced by The PHP Group. ', '2022-04-25 21:52:54'),
(27, 'Django', 'Django is a Python-based free and open-source web framework that follows the model&ndash;template&ndash;views architectural pattern. It is maintained by the Django Software Foundation, an independent organization established in the US as a 501 non-profit. ', '2022-04-25 21:53:05'),
(28, 'JavaScript', 'JavaScript, often abbreviated JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. Over 97% of websites use JavaScript on the client side for web page behavior, often incorporating third-party libraries. ', '2022-04-25 21:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `U_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT 0,
  `Registered_User` tinyint(1) NOT NULL DEFAULT 0,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `Name`, `Surname`, `Email`, `Username`, `Password`, `Gender`, `DOB`, `Admin`, `Registered_User`, `Date`) VALUES
(59, 'Blendi', 'Rrustemi', 'blendi@gmail.com', 'blendi', 'blendi321', 'male', '2022-04-20', 1, 1, '2022-04-25 21:52:24'),
(60, 'Deti', 'Baholli', 'deti@gmail.com', 'detib', 'detideti', 'male', '2022-03-28', 0, 1, '2022-04-25 21:53:35'),
(61, 'Dea', 'Nixha', 'dea@gmail.com', 'dea', 'deadeade', 'female', '2022-04-07', 0, 1, '2022-04-25 21:53:54'),
(62, 'Ermir', 'Rogova', 'ermir@gmail.com', 'ermiri', 'ermierimeir', 'male', '2022-03-29', 0, 0, '2022-04-25 21:54:06'),
(63, 'Agnesa', 'Tahiiri', 'agnesa@gmail.com', 'agn', 'agensadasd', 'female', '2022-04-06', 0, 1, '2022-04-25 21:54:23'),
(64, 'Ema', 'Krasniqi', 'ema@gmail.com', 'ema', 'adsadsadas', 'female', '2022-03-28', 0, 0, '2022-04-25 21:54:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `P_ID` (`P_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`U_ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `posts` (`P_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
