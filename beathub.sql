-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2019 at 11:33 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beathub`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Divide', 1, 1, 'assets/images/album/edsheeran.jpg'),
(2, 'Fifty Shades of Grey', 2, 1, 'assets/images/album/lovemelikeyoudo.jpg'),
(3, 'Hell\'s Kitchen Angel', 3, 1, 'assets/images/album/lightsdownlow.png'),
(4, 'Yang Patah Tumbuh Yang Hilang Berganti', 5, 2, 'assets/images/album/bandaneira/bandaneira1.jpg'),
(5, 'Telisik', 6, 2, 'assets/images/album/DanillaR/Danilla telisik.png'),
(6, 'Ego & Fungsi Otak', 4, 2, 'assets/images/album/fourtwnty/ego.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`, `username`) VALUES
(1, 'Ed Sheeran', 'edsheeran'),
(2, 'Ellie Goulding', ''),
(3, 'MAX', ''),
(4, 'Arifour Twnty', 'fourtwnty'),
(5, 'Banda Neira', 'bandaneira'),
(6, 'Danilla Riyadi', 'DanillaR');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Pop'),
(2, 'Indie'),
(3, 'Country'),
(4, 'Blues'),
(5, 'Classic'),
(6, 'EDM'),
(7, 'RnB');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `date`) VALUES
(1, 'test', 'fourtwnty', '2019-05-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistssongs`
--

CREATE TABLE `playlistssongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistssongs`
--

INSERT INTO `playlistssongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `playCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `playCount`) VALUES
(1, 'Shape of You', 1, 1, 1, '3:55', 'assets/music/Shape of You.mp3', 1, 51),
(2, 'Love Me Like You Do', 2, 2, 1, '4:10', 'assets/music/Love Me Like You Do.mp3', 1, 26),
(3, 'Lights Down Low', 3, 3, 1, '3:51', 'assets/music/Lights Down Low.mp3', 1, 51),
(4, 'Sing', 1, 1, 1, '3:55', 'assets/music/Sing.mp3', 2, 20),
(5, 'Castle on The Hill', 1, 1, 1, '4:20', 'assets/music/Castle On The Hill.mp3', 3, 19),
(6, 'Yang Patah Tumbuh Yang Hilang Berganti', 5, 4, 2, '6:33', 'assets/music/bandaneira/4/Yang-Patah-Tumbuh-yang-Hilang-Berganti.mp3', 1, 3),
(7, 'Matahari Pagi', 5, 4, 2, '5:01', 'assets/music/bandaneira/4/Banda Neira - Matahari Pagi (Official Music Video) [wapka.blog] [Mp3Convert.Tube].mp3', 2, 3),
(8, 'Sebagai Kawan', 5, 4, 2, '4:47', 'assets/music/bandaneira/4/Banda Neira feat. Jeremia Kimosabe - Sebagai Kawan (Lirik) [wapka.blog] [Mp3Convert.Tube].mp3', 3, 2),
(9, 'Wahai Kau', 6, 5, 2, '4:26', 'assets/music/DanillaR/5/Danilla  - Wahai Kau.mp3', 1, 0),
(10, 'Ada Disana', 6, 5, 2, '3:24', 'assets/music/DanillaR/5/Danilla - Ada Disana.mp3', 2, 0),
(11, 'Berdistraksi', 6, 5, 2, '3:33', 'assets/music/DanillaR/5/Danilla - Berdistraksi.mp3', 3, 1),
(12, 'Bilur', 6, 5, 2, '4:56', 'assets/music/DanillaR/5/Danilla - Bilur.mp3', 4, 0),
(13, 'Buaian', 6, 5, 2, '4:07', 'assets/music/DanillaR/5/Danilla - Buaian.mp3', 5, 0),
(14, 'Junko Furuta', 6, 5, 2, '4:29', 'assets/music/DanillaR/5/Danilla - Junko Furuta.mp3', 6, 0),
(15, 'Oh No! Trembling Story', 6, 5, 2, '4:07', 'assets/music/DanillaR/5/Danilla - Oh No! Trembling Story.mp3', 7, 0),
(16, 'Reste Avec Moi', 6, 5, 2, '3:34', 'assets/music/DanillaR/5/Danilla - Reste Avec Moi.mp3', 8, 0),
(17, 'Senja Diambang Pilu', 6, 5, 2, '5:02', 'assets/music/DanillaR/5/Danilla - Senja Diambang Pilu.mp3', 9, 0),
(18, 'Terpaut Oleh Waktu', 6, 5, 2, '4:01', 'assets/music/DanillaR/5/Danilla - Terpaut Oleh Waktu.mp3', 10, 1),
(19, 'Pangeran Kecil', 5, 4, 2, '07:05', 'assets/music/bandaneira/4/Banda Neira - Pangeran Kecil.mp3', 4, 2),
(20, 'Benderang', 5, 4, 2, '06:58', 'assets/music/bandaneira/4/Banda Neira - Benderang (Lirik).mp3', 5, 0),
(21, 'Biru', 5, 4, 2, '05:54', 'assets/music/bandaneira/4/Banda Neira - Biru (Menampilkan Layur).mp3', 6, 0),
(22, 'Bunga', 5, 4, 2, '07:03', 'assets/music/bandaneira/4/Banda Neira - Bunga.mp3', 7, 1),
(23, 'Derai Derai Cemara', 5, 4, 2, '06:43', 'assets/music/bandaneira/4/Banda Neira - Derai Derai Cemara (musikalisasi puisi Chairil Anwar).mp3', 8, 0),
(24, 'Langit dan Laut', 5, 4, 2, '05:45', 'assets/music/bandaneira/4/Banda Neira - Langit dan Laut.mp3', 9, 0),
(25, 'Mewangi', 5, 4, 2, '06:04', 'assets/music/bandaneira/4/Banda Neira - Mewangi.mp3', 10, 1),
(26, 'Sampai Jadi Debu', 5, 4, 2, '06:49', 'assets/music/bandaneira/4/BANDA NEIRA - SAMPAI JADI DEBU.mp3', 11, 2),
(27, 'Tini dan Yanti', 5, 4, 2, '05:19', 'assets/music/bandaneira/4/Banda Neira - Tini dan Yanti.mp3', 12, 0),
(28, 'Utarakan', 5, 4, 2, '03:34', 'assets/music/bandaneira/4/Banda Neira - Utarakan.mp3', 13, 1),
(29, 'Kita Pasti Tua', 4, 6, 2, '05:00', 'assets/music/fourtwnty/6/Fourtwnty - Kita Pasti Tua (Lyric Video).mp3', 1, 1),
(30, 'Kusut', 4, 6, 2, '04:38', 'assets/music/fourtwnty/6/Fourtwnty - Kusut (Lyric Video).mp3', 2, 1),
(31, 'Nyanyian Surau', 4, 6, 2, '05:22', 'assets/music/fourtwnty/6/Fourtwnty - Nyanyian Surau (Ego & Fungsi Otak).mp3', 3, 1),
(32, 'Realita', 4, 6, 2, '03:23', 'assets/music/fourtwnty/6/Fourtwnty - Realita (Lyric Video).mp3', 4, 1),
(33, 'Segelas Berdua', 4, 6, 2, '05:09', 'assets/music/fourtwnty/6/Fourtwnty - Segelas Berdua (Lyric Video).mp3', 5, 0),
(34, 'Trilogi', 4, 6, 2, '04:10', 'assets/music/fourtwnty/6/Fourtwnty - Trilogi Lirik (Ego dan Fungsi Otak).mp3', 6, 0),
(35, 'Zona Nyaman', 4, 6, 2, '04:19', 'assets/music/fourtwnty/6/Fourtwnty - Zona Nyaman OST. Filosofi Kopi 2 Ben & Jody (Lyric Video).mp3', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signup_date` datetime NOT NULL,
  `profile_pic` varchar(500) NOT NULL,
  `playCount` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `signup_date`, `profile_pic`, `playCount`, `role`) VALUES
(11, 'hxrrisk', 'Harris', 'Kristanto', 'harriskristanto9a@gmail.com', '6a204bd89f3c8348afd5c77c717a097a', '2019-05-05 00:24:08', 'assets/images/profile-pictures/hxrrisk/FB_IMG_1473606462900.jpg', 2, 'user'),
(13, 'edsheeran', 'Edward', 'Sheeran', 'edsheeran@gmail.com', 'a64982a01f551e2050a42b933cadbbb2', '2019-05-07 14:03:15', 'assets/images/profile-pictures/edsheeran/download.jpg', 1, 'artist'),
(14, 'elgould', 'Ellie', 'Goulding', 'elliegoulding@gmail.com', 'd245c7c988275837f8cd00e4fe97a0e5', '2019-05-07 14:11:28', 'assets/images/profile-pictures/hxrrisk/FB_IMG_1473606462900.jpg', 0, 'artist'),
(15, 'maxmax', 'Maxima', 'Bouttiere', 'max@gmail.com', '04a3009ccff12bfec55aa003aa2a234a', '2019-05-07 14:15:09', 'assets/images/profile-pictures/hxrrisk/FB_IMG_1473606462900.jpg', 0, 'artist'),
(16, 'bandaneira', 'Banda', 'Neira', 'bandaneira@gmail.com', '77a16cb0e9c60986994b80cde73f8b51', '2019-05-07 14:17:12', 'assets/images/profile-pictures/bandaneira/bandaneira1.jpg', 16, 'artist'),
(19, 'fourtwnty', 'Arifour', 'Twnty', 'fourtwnty@gmail.com', 'f9f50177f6dbfbaf99ffa438bba0b912', '2019-05-07 14:26:21', 'assets/images/profile-pictures/hxrrisk/FB_IMG_1473606462900.jpg', 5, 'artist'),
(20, 'DanillaR', 'Danilla', 'Riyadi', 'Danilla@gmail.com', '2b3dd2d38d207db59fb30671b240a14d', '2019-05-11 12:08:37', 'assets/images/profile-pictures/DanillaR/Danilla telisik.png', 3, 'artist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistssongs`
--
ALTER TABLE `playlistssongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `playlistssongs`
--
ALTER TABLE `playlistssongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
