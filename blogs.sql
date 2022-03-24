-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 08:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `post_img` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `sub_title`, `post_img`, `body`, `created_at`) VALUES
(1, 1, 'Man must explore, and this is exploration at its greatest', 'Problems look mighty small from 150 miles up', 'post-bg.jpg', 'Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals.', '2022-03-24'),
(3, 2, 'NASA Continues Artemis I Preparations at Pad Wet Dress Rehearsal Test', '', 'post-sample-image.jpg', 'Following arrival of the Space Launch System rocket and Orion spacecraft for Artemis I at Launch Pad 39B at NASA’s Kennedy Space Center in Florida on March 18, teams have connected numerous ground support equipment elements to the rocket and spacecraft, including electrical, fuel environmental control system ducts, and cryogenic Read full post', '2022-03-24'),
(11, 1, 'Astronauts Complete Spacewalk to Install Station Upgrades', 'Work and breathe all things NASA Science.', 'EVA-80_External-high-definition-camera-installation.png', 'Expedition 66 Flight Engineers Raja Chari of NASA and Matthias Maurer of ESA (European Space Agency) concluded their spacewalk at 3:26 p.m. EDT after 6 hours and 54 minutes in preparation for upcoming solar array installation. Maurer and Chari completed their major objective for today to install hoses on a Radiator Beam ', '2022-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'Dhoha Alkhorasani', 'raihanahit2016@gmail.com', '792d641da35dcfd12de8880bf5b1638e'),
(2, 'Afnan Alkhorasani', 'Afnan@gmail.com', 'c51e57cff16a9e5891489caf18f9532c'),
(3, 'Abduljaleel_kh', 'Abduljaleel@gmail.com', 'fb1cee423ddf6c214ec04f2adc3d5d20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
