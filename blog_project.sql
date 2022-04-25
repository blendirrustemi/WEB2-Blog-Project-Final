drop database if exists blog_project;

create database blog_project;

use blog_project;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `Users` (
  `U_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT 0,
  `Registered_User` tinyint(1) NOT NULL DEFAULT 0,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`U_ID`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Username` (`Username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Posts` (
    `P_ID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Title` varchar(255) NOT NULL,
    `Content` text NOT NULL,
    `Date` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE IF NOT EXISTS `comments` (
    `C_ID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Comment` text NOT NULL,
    `P_ID` int,
    FOREIGN KEY (`P_ID`) REFERENCES `Posts` (`P_ID`)
);


INSERT INTO `users` (`U_ID`, `Name`, `Surname`, `Email`, `Username`, `Password`, `Gender`, `DOB`, `Admin`, `Registered_User`, `Date`) VALUES ('1', 'Blendi', 'Rrustemi', 'blendi@gmail.com', 'blendi', 'blendi321', 'male', '2001-01-13', '1', '1', current_timestamp());
INSERT INTO `users` (`U_ID`, `Name`, `Surname`, `Email`, `Username`, `Password`, `Gender`, `DOB`, `Admin`, `Registered_User`, `Date`) VALUES ('2', 'Blerina', 'Zenelaj', 'blerina@gmail.com', 'blerina', 'blerina321', 'female', '2001-04-19', '1', '1', current_timestamp());