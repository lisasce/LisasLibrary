-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 04:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr10_lisa_biglibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorID`, `firstName`, `lastName`) VALUES
(1, 'Louisa May', 'Alcott'),
(2, 'Joanne Kathleen', 'Rowling'),
(3, 'Dan', 'Brown');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `mediaID` int(11) NOT NULL,
  `publishDate` year(4) NOT NULL,
  `imageLink` varchar(500) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `available` enum('yes','no') DEFAULT 'yes',
  `category` enum('Novel','Fiction','Biography','Horror','Children','Manga','Comic','Health','Education','Diverse') DEFAULT 'Diverse',
  `type` enum('Book','CD','DVD') NOT NULL,
  `fk_userID` int(11) DEFAULT NULL,
  `fk_publisherID` int(11) DEFAULT NULL,
  `fk_authorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`mediaID`, `publishDate`, `imageLink`, `description`, `ISBN`, `title`, `available`, `category`, `type`, `fk_userID`, `fk_publisherID`, `fk_authorID`) VALUES
(2, 1998, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-2', 'Harry Potter 2', 'yes', 'Children', 'Book', NULL, 1, 1),
(3, 1999, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-1', 'Harry Potter 3', 'yes', 'Comic', 'Book', NULL, 1, 1),
(4, 2000, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-4', 'Harry Potter 4', 'yes', 'Manga', 'Book', NULL, 1, 1),
(5, 1997, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-3', 'Harry Potter 1', 'yes', 'Novel', 'Book', NULL, 2, 1),
(6, 1998, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-2', 'Harry Potter 2', 'yes', 'Biography', 'Book', NULL, 2, 1),
(7, 1999, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-1', 'Harry Potter 3', 'yes', 'Fiction', 'Book', NULL, 2, 1),
(8, 2000, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-4', 'Harry Potter 4', 'yes', 'Horror', 'Book', NULL, 2, 1),
(9, 1997, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-3', 'Harry Potter 1', 'yes', 'Novel', 'Book', NULL, 3, 1),
(10, 1998, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-2', 'Harry Potter 2', 'yes', 'Education', 'Book', NULL, 3, 1),
(11, 1999, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-1', 'Harry Potter 3', 'yes', 'Health', 'Book', NULL, 3, 1),
(12, 2000, 'https://cdn.pixabay.com/photo/2012/05/04/10/55/pdf-47199_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', '978-2-07-061241-4', 'Harry Potter 4', 'yes', 'Diverse', 'Book', NULL, 3, 1),
(13, 2006, 'https://cdn.pixabay.com/photo/2012/04/11/12/48/dvd-28066_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', 'not a book', 'The Da Vinci Code', 'yes', 'Diverse', 'DVD', NULL, 2, 3),
(14, 2016, 'https://cdn.pixabay.com/photo/2012/04/11/12/48/dvd-28066_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', 'not a book', 'Inferno', 'yes', 'Diverse', 'DVD', NULL, 1, 3),
(15, 2009, 'https://cdn.pixabay.com/photo/2012/04/11/12/48/dvd-28066_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', 'not a book', 'Illuminati', 'yes', 'Diverse', 'DVD', NULL, 2, 3),
(16, 2020, 'https://cdn.pixabay.com/photo/2012/04/11/12/48/dvd-28066_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', 'not a book', 'The lost Symbol', 'yes', 'Diverse', 'DVD', NULL, 3, 3),
(17, 2015, 'https://cdn.pixabay.com/photo/2016/03/31/21/09/cd-1296225_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', 'not a book', 'Little Women', 'yes', 'Diverse', 'CD', NULL, 2, 2),
(18, 2016, 'https://cdn.pixabay.com/photo/2016/03/31/21/09/cd-1296225_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', 'not a  book', 'les 4 filles du dr march', 'yes', 'Diverse', 'CD', NULL, 1, 2),
(19, 2020, 'https://cdn.pixabay.com/photo/2016/03/31/21/09/cd-1296225_960_720.png', 'Lorem ipsum dolor sit amet, consectetur adipisici elit', 'not a  book', 'Betty und ihre Schwestern', 'yes', 'Diverse', 'CD', NULL, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisherID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `adress` varchar(200) DEFAULT NULL,
  `size` enum('big','medium','small') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisherID`, `name`, `adress`, `size`) VALUES
(1, 'Éditions Gallimard Jeunesse', 'adresse 1, paris', 'medium'),
(2, 'Carlsen Verlag GmbH', 'adresse 2, Hamburg', 'big'),
(3, 'Bloomsbury Publishing', 'adresse 3, london', 'small'),
(4, 'Éditions peuimporte', 'adresse 4, paris', 'medium'),
(5, 'Insel Verlag GmbH', 'adresse 5, Hamburg', 'big'),
(6, 'Orchard Books', 'adresse 6, london', 'small'),
(7, 'Éditions tralala', 'adresse 7, paris', 'medium'),
(8, 'Xenos Verlag GmbH', 'adresse 8, Hamburg', 'big'),
(9, 'Penguin Books', 'adresse 9, london', 'small'),
(10, 'Éditions Véritable', 'adresse 10, paris', 'medium'),
(11, 'Österreich Verlag GmbH', 'adresse 11, Hamburg', 'big'),
(12, 'USA Publishing', 'adresse 12, NYC', 'small'),
(13, 'Lisa Scelli', 'Mautner-Markhof-Gasse, 28/1/12', 'big');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `nickName` varchar(50) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `userStatus` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `nickName`, `userPass`, `email`, `userStatus`) VALUES
(1, 'lisa', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'lisa.66@hotmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorID`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`mediaID`),
  ADD KEY `fk_userID` (`fk_userID`),
  ADD KEY `fk_publisherID` (`fk_publisherID`),
  ADD KEY `fk_authorID` (`fk_authorID`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisherID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `authorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `mediaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_ibfk_1` FOREIGN KEY (`fk_userID`) REFERENCES `users` (`userID`) ON DELETE SET NULL,
  ADD CONSTRAINT `medias_ibfk_2` FOREIGN KEY (`fk_publisherID`) REFERENCES `publishers` (`publisherID`) ON DELETE SET NULL,
  ADD CONSTRAINT `medias_ibfk_3` FOREIGN KEY (`fk_authorID`) REFERENCES `author` (`authorID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
