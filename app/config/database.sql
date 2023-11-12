-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 06:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mundocripto`
--

-- --------------------------------------------------------

--
-- Table structure for table `changes`
--

CREATE TABLE `changes` (
  `idchange` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `entityid` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `entity` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `changes`
--

INSERT INTO `changes` (`idchange`, `iduser`, `entityid`, `action`, `entity`, `date`) VALUES
(32, 11, 27, 'new', 'post', '2023-11-11 01:40:50'),
(33, 11, 14, 'new', 'content', '2023-11-11 01:40:50'),
(34, 11, 15, 'new', 'content', '2023-11-11 01:40:50'),
(35, 11, 27, 'publish', 'post', '2023-11-11 01:40:50'),
(36, 13, 28, 'new', 'post', '2023-11-11 01:42:32'),
(37, 13, 16, 'new', 'content', '2023-11-11 01:42:32'),
(38, 13, 17, 'new', 'content', '2023-11-11 01:42:32'),
(39, 13, 28, 'publish', 'post', '2023-11-11 01:42:32'),
(40, 13, 13, 'new', 'user', '2023-11-11 01:50:57'),
(41, 11, 11, 'new', 'user', '2023-11-11 01:51:09'),
(42, 14, 14, 'new', 'user', '2023-11-11 02:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `idcomment` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `idcontent` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `paragraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`idcontent`, `idpost`, `paragraph`) VALUES
(14, 27, 'Es una prueba de juan'),
(15, 27, 'Probando el sistemita'),
(16, 28, 'Hola soy Agus'),
(17, 28, 'mucho gusto desde capital');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `idpost` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`idpost`, `iduser`, `title`, `status`) VALUES
(27, 11, 'Prueba 1', 1),
(28, 13, 'Probando desde otro user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iduser`, `nickname`, `email`, `password`) VALUES
(11, 'Juancho43', 'bravojuan43@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$WUpiMW5VSVA3Y1RUQjNRdg$qhfm4m8xYlzwg+ToTF4zS9Og7BhNL4DrwXDvX6gXnIc'),
(13, 'agus', 'agus@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$VzY4MjkydjFybDdYZm5Vdg$uh5GtucPJjm3XxssHLDDaJ2RKdtb0LUqlCH6nwhG6gQ'),
(14, 'nahuez', 'zubiri@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$VTMvOEd4aXVqOGJhcllOcg$oOMAyCxfBq5D7MwHpv9SLuGuurrygQKW1PbAB7xe8ac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `changes`
--
ALTER TABLE `changes`
  ADD PRIMARY KEY (`idchange`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idcomment`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idpost` (`idpost`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`idcontent`),
  ADD KEY `idpost` (`idpost`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `changes`
--
ALTER TABLE `changes`
  MODIFY `idchange` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `idcomment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `idcontent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `changes`
--
ALTER TABLE `changes`
  ADD CONSTRAINT `changes_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idpost`) REFERENCES `posts` (`idpost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`idpost`) REFERENCES `posts` (`idpost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
