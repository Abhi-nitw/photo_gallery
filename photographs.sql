-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2017 at 07:31 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo_gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `photographs`
--

CREATE TABLE `photographs` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photographs`
--

INSERT INTO `photographs` (`id`, `filename`, `type`, `size`, `caption`) VALUES
(2, '45452-sakura-haruno-from-naruto-1920x1080-anime-wallpaper.jpg', 'image/jpeg', 287697, 'sakura'),
(5, '30314-naruto-uzumaki-naruto-1920x1080-anime-wallpaper.jpg', 'image/jpeg', 136294, 'naruto'),
(6, 'best_naruto_wallpaper_for_desktop_19.jpg', 'image/jpeg', 591460, 'kakashi'),
(7, 'Kajal-Agarwal-Businessman-wallpaper1600x900.jpg', 'image/jpeg', 172639, 'kajal'),
(8, '4272213-9837057861-Hyuug.jpg', 'image/jpeg', 683683, 'hinata'),
(9, 'blue-background-dakota-johnson-hd-wallpapers-celebrities-images-dakota-johnson-wallpaper.jpg', 'image/jpeg', 157180, 'dakota johnson'),
(10, 'pixie-lott-blonde-girl-happy-fashion-singer-hd-wallpaper-1920x1080.jpg', 'image/jpeg', 445672, 'happy girl'),
(11, 'anime_172846.jpg', 'image/jpeg', 172846, 'anime'),
(12, 'Emily-Rudd-Actress-Model-Blue-Eyes-Desktop-Wallpaper.jpg', 'image/jpeg', 597187, 'emily'),
(14, 'thumb-1920-673958.jpg', 'image/jpeg', 289454, 'anime'),
(15, 'thumb-1920-681368.jpg', 'image/jpeg', 460582, 'girl'),
(16, 'thumb-1920-484256.jpg', 'image/jpeg', 174075, 'anime_girl'),
(17, 'thumb-1920-677412.jpg', 'image/jpeg', 328275, 'sexy girls'),
(18, 'kWpyncH.jpg', 'image/jpeg', 277019, 'dean'),
(19, 'kate-in-underworld_4.jpg', 'image/jpeg', 94024, 'kate'),
(21, '12106701_867074446722713_3922493529910244420_n.png', 'image/png', 358130, 'girl on summer'),
(22, 'kajal-agarwal-hot-wallpapers-for-desktop-background-1280x1024.jpg', 'image/jpeg', 215099, 'kajal'),
(23, '003.jpg', 'image/jpeg', 86139, 'nature beauty'),
(24, 'Wallpaper 1080p (12).jpg', 'image/jpeg', 774862, 'ocean'),
(25, 'Gooogle Wallpaper2..jpg', 'image/jpeg', 921292, 'google'),
(26, 'YouTube Wallpaper1.jpg', 'image/jpeg', 137995, 'youtube'),
(27, 'GoT - Jon Snow.png', 'image/png', 99740, 'jon snow'),
(28, 'GoT - Ned Stark.png', 'image/png', 32830, 'ned'),
(29, '123.jpg', 'image/jpeg', 29949, '123'),
(30, 'scholarsshipp.png', 'image/png', 99886, 'scholarship'),
(31, '4k-ultra-hd-game-thrones-wallpapers-5.jpg', 'image/jpeg', 857192, 'hd'),
(32, '403408.jpg', 'image/jpeg', 554385, 'nothing'),
(33, 'Dayanand.jpg', 'image/jpeg', 137702, 'dyanand'),
(34, 'vanille_in_final_fantasy-normal.jpg', 'image/jpeg', 269842, 'vanille');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photographs`
--
ALTER TABLE `photographs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photographs`
--
ALTER TABLE `photographs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
