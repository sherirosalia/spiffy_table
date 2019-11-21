-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2019 at 06:45 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webd166_04`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `entry` text NOT NULL,
  `date_entered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `title`, `entry`, `date_entered`) VALUES
(8, 'World\'s Youngest Parents', 'The world\'s youngest parents were age 8 and 9. They lived in China and had their child in 1910', '2019-11-18 02:32:51'),
(9, 'Can\'t taste that:', 'It is physically impossible for you to lick your elbow.', '2019-11-18 02:34:29'),
(10, 'The true cause of a clogged filter:', 'Most of the dust particles in your house are dead skin.', '2019-11-18 02:36:15'),
(11, 'Anticipation, keeping me waiting', 'Catsup leaves the bottle at a rate of 25 miles per year, ergo the famous Carly Simon song used for a Heinz Ketchup commercial.', '2019-11-18 02:39:02'),
(12, 'Why women are skilled at flirtation:', 'Women blink nearly twice as often as men.', '2019-11-18 02:39:53'),
(13, 'How old was Pinnocchio?', 'Our eyes are always the same size from birth, but our nose and ears never stop growing.', '2019-11-18 02:40:44'),
(14, 'Woah Nelly!', 'Hitler was nominated for a Nobel Peace Prize in 1939.', '2019-11-18 02:41:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
