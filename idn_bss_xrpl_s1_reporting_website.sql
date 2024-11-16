-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 01:53 PM
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
-- Database: `idn_bss_xrpl_s1_reporting_website`
--
CREATE DATABASE IF NOT EXISTS `idn_bss_xrpl_s1_reporting_website` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `idn_bss_xrpl_s1_reporting_website`;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `issuer_id` int(128) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date_of_reporting` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `issuer_id`, `subject`, `message`, `date_of_reporting`) VALUES
(5, 1, 'THEY GOT HEPATITIS', 'BRUHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH', '2024-11-11 14:47:41'),
(6, 1, 'THEY GOT HEPATITIS', 'i think you guys should do something', '2024-11-11 14:47:41'),
(9, 1, 'holy shid', 'yeah', '2024-11-11 14:47:41'),
(10, 1, 'MOFO', 'god', '2024-11-11 14:47:41'),
(11, 4, 'I need lycaon plz', 'Can you guys like submit sumn to Pubsec so they can clone him or sumn, i really need one of him for \"proxy\" purposes', '2024-11-11 14:47:41'),
(13, 4, 'URGENT Request: Lycaon Clone Program', 'We know this is a big ask, but we need something like Von Lycaon in our arsenal—someone with that strength, that presence. He’s got a... let’s call it a unique talent for inspiring order just by existing. Imagine: a PubSec division enhanced with Lycaon’s caliber. That’s right, we\'re asking (humbly, desperately) for a clone initiative. We’re confident this would be a game-changer, maybe the game-changer for our operations.\r\n\r\nPlease, just consider it. PubSec will owe you one—big time.', '2024-11-11 15:05:46'),
(14, 4, 'RE: Lycaon Clone Request – We Really Need This', 'Look, I know you’ve got a lot on your plate, but I just need one more moment of your time because—have you seen this Lycaon guy? We’re talking about a unit that’s all power and precision, with shoulders that look like they could carry the whole department. Legs like hydraulic pillars, abs that—frankly—could deflect bullets, and claws that say, “I dare you to start something.”\r\n\r\nThis isn’t just a “big guy” we’re talking about; he’s an absolute wall of muscle that commands instant compliance. No one would think twice about stepping out of line if we had a Lycaon clone in PubSec. This isn’t just about security—it’s about inspiration. About walking around knowing that, at any moment, this absolute behemoth has our back.', '2024-11-11 15:08:54'),
(15, 5, 'what the actual fuck', 'why they so obsessed in me brah', '2024-11-12 10:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `role` varchar(32) NOT NULL,
  `pw_hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `pw_hash`) VALUES
(1, 'muftipoll', 'muftiarifudintaqy0@gmail.com', 'user', 'f953abd51c33d158f46e9034b1937b3c3890b0cc'),
(2, 'admin', 'admin@gmail.com', 'admin', 'cd5ea73cd58f827fa78eef7197b8ee606c99b2e6'),
(4, 'tamu', 'tamu@gmail.com', 'user', 'd5c9214540af1b0f8e28ccdef041a74e4cf899ae'),
(5, 'vonlycaon', 'von.lycaon@zenless.hoyoverse.com', 'user', 'b0399d2029f64d445bd131ffaa399a42d2f8e7dc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reporter` (`issuer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `FK_reporter` FOREIGN KEY (`issuer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;