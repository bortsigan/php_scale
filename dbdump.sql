-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 19, 2024 at 09:11 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phptest`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `body` mediumtext,
  `created_at` datetime DEFAULT NULL,
  `news_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `body`, `created_at`, `news_id`) VALUES
(1, 'i like this news', '2016-11-30 14:21:23', 1),
(2, 'i have no opinion about that', '2016-11-30 14:24:08', 1),
(3, 'are you kidding me ?', '2016-11-30 14:28:06', 1),
(4, 'this is so true', '2016-11-30 17:21:23', 2),
(5, 'trolololo', '2016-11-30 17:39:25', 2),
(6, 'luke i am your father', '2016-11-30 14:34:06', 3),
(9, '1740828422568344914nth - test', '2024-09-19 08:15:22', 2),
(10, '1424521938164993430nth - test', '2024-09-19 08:18:10', 2),
(11, '904513579166577405nth - test', '2024-09-19 08:20:03', 1),
(12, '3249310693460959056nth - test', '2024-09-19 08:35:28', 1),
(13, '2767612321254775050nth - test', '2024-09-19 08:37:30', 1),
(14, '3548331412604207983nth - test', '2024-09-19 08:40:31', 1),
(15, '2896105093675632190nth - test', '2024-09-19 08:40:43', 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `title` varchar(511) DEFAULT NULL,
  `body` mediumtext,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `body`, `created_at`) VALUES
(1, 'news 1', 'this is the description of our fist news', '2016-11-30 14:18:23'),
(2, 'news 2', 'this is the description of our second news', '2016-11-30 14:24:23'),
(3, 'news 3', 'this is the description of our third news', '2016-12-01 04:33:23'),
(4, 'touch', 'katseye', '2024-09-19 00:00:00'),
(5, 'bini', 'mikha', '2024-09-19 04:55:35'),
(10, 'title', 'body', '2024-09-19 07:29:46'),
(31, 'Sining', 'Dionela Ft Jr', '2024-09-19 07:55:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
