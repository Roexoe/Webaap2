-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 03, 2024 at 05:52 PM
-- Server version: 5.7.44
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Klanteninformatie`
--

-- --------------------------------------------------------

--
-- Table structure for table `Boekingen`
--

CREATE TABLE `Boekingen` (
  `id` int(11) NOT NULL,
  `reisID` text NOT NULL,
  `klantID` text NOT NULL,
  `Vertrekdatum` date NOT NULL,
  `Terugkomstdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Klanteninformatie`
--

CREATE TABLE `Klanteninformatie` (
  `id` int(11) NOT NULL,
  `Voornaam` text NOT NULL,
  `Achternaam` text NOT NULL,
  `Geboortedatum` date NOT NULL,
  `Mailadres` text NOT NULL,
  `Gebruikersnaam` text NOT NULL,
  `Wachtwoord` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Klanteninformatie`
--

INSERT INTO `Klanteninformatie` (`id`, `Voornaam`, `Achternaam`, `Geboortedatum`, `Mailadres`, `Gebruikersnaam`, `Wachtwoord`) VALUES
(1, 'Max', 'van Rooijen', '1993-09-15', 'bruh@gmail.com', 'Autisme', 'burh'),
(4, 'Atusime ', 'adol', '2075-10-10', 'kanus@gmail.com', 'Burhmoemn', 'bruhmoment'),
(5, 'Atusime ', 'adol', '2075-10-10', 'kanus@gmail.com', 'Burhmoemn', 'bruhmoment'),
(6, 'Atusime ', 'adol', '2075-10-10', 'kanus@gmail.com', 'Burhmoemn', 'bruhmoment'),
(7, 'Atusime ', 'adol', '2075-10-10', 'kanus@gmail.com', 'Burhmoemn', 'bruhmoment'),
(8, 'Atusime ', 'adol', '2075-10-10', 'kanus@gmail.com', 'Burhmoemn', 'bruhmoment'),
(9, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(10, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(11, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(12, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(13, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(14, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(15, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(16, 'Pim', 'Melchers', '2007-11-26', 'pimmelchers1@gmail.com', 'Pimmelchers', 'dikkebmw'),
(17, 'fbdfd', 'dbdfbfd', '2024-05-01', 'shd2@h', 'bfdb', 'dfbd'),
(18, 'fbdfd', 'dbdfbfd', '2024-05-01', 'shd2@h', 'bfdb', 'dfbd'),
(19, 'fsdfdsf', 'sfddsfds', '2024-05-08', '2@sdfdsfs', 'sfefs', 'seffse'),
(20, 'fsdfdsf', 'sfddsfds', '2024-05-08', '2@sdfdsfs', 'sfefs', 'seffse'),
(21, 'fsdfdsf', 'sfddsfds', '2024-05-08', '2@sdfdsfs', 'sfefs', 'refwses'),
(22, 'fsdfdsf', 'sfddsfds', '2024-05-08', '2@sdfdsfs', 'sfefs', 'refwses'),
(23, 'fsdfdsf', 'sfddsfds', '2024-05-08', '2@sdfdsfs', 'sfefs', 'fdsgsdg'),
(24, 'fsdfdsf', 'sfddsfds', '2024-05-08', '2@sdfdsfs', 'sfefs', 'fdsgsdg'),
(25, 'autisme', 'jhsdbmgdkj', '2024-05-22', 'grsdgsd@grsd', 'sgsdg', 'sdgds'),
(26, 'sdgd', 'sdgdsg', '2024-05-09', 'sdg@fsd', 'gdsgds', 'afaa'),
(27, 'sdgd', 'sdgdsg', '2024-05-09', 'sdg@fsd', 'gdsgds', 'afaa'),
(28, 'sdgd', 'sdgdsg', '2024-05-09', 'sdg@fsd', 'gdsgds', 'afaa'),
(29, 'sdgd', 'sdgdsg', '2024-05-09', 'sdg@fsd', 'gdsgds', 'afaa'),
(30, 'sdgd', 'sdgdsg', '2024-05-09', 'sdg@fsd', 'gdsgds', 'sgfgds'),
(31, 'sdgd', 'sdgdsg', '2024-05-09', 'sdg@fsd', 'gdsgds', 'sgfgds'),
(32, 'gsdgs', 'sfddsfds', '2024-05-03', '2@sdfdsfs', 'gdsgds', 'gsdgsd'),
(33, 'gsdgs', 'sfddsfds', '2024-05-03', '2@sdfdsfs', 'gdsgds', 'gsdgsd'),
(34, 'gsdgs', 'sfddsfds', '2024-05-03', '2@sdfdsfs', 'gdsgds', 'gsdgsd'),
(35, 'gsdgs', 'sfddsfds', '2024-05-03', '2@sdfdsfs', 'gdsgds', 'gsdgsd'),
(36, 'gsdgs', 'sfddsfds', '2024-05-03', '2@sdfdsfs', 'gdsgds', 'gsdgsd'),
(37, 'gsdgs', 'sfddsfds', '2024-05-03', '2@sdfdsfs', 'gdsgds', 'gsdgsd'),
(38, 'sgds', 'sdgdsg', '2024-05-08', 'shd2@h', 'Burhmoemn', 'kebab'),
(39, 'sgds', 'sds', '2024-05-10', 'shd2@h', 'gdsgds', 'vbdfhfdsh'),
(40, 'sdgd', 'sdgdsg', '2024-05-09', 'kanus@gmail.com', 'Burhmoemn', 'antfdkugjfsbkcj'),
(41, 'sgdgsg', 'gdsgdsg', '2024-05-09', '2@sdfdsfs', 'sfefs', 'gshdsdhs'),
(42, 'sgdgsg', 'gdsgdsg', '2024-05-09', '2@sdfdsfs', 'sfefs', 'gfdsgsd'),
(43, 'sgds', 'gdsgdsg', '2024-05-10', 'kanus@gmail.com', 'Burhmoemn', 'fgdnfd'),
(44, 'sgds', 'gdsgdsg', '2024-05-10', 'kanus@gmail.com', 'Burhmoemn', 'drgsg'),
(45, 'sgds', 'gdsgdsg', '2024-05-10', 'kanus@gmail.com', 'Burhmoemn', 'gdsdg'),
(46, 'sgds', 'gdsgdsg', '2024-05-10', 'kanus@gmail.com', 'Burhmoemn', 'gdsdg'),
(47, 'dhff', 'sfddsfds', '2024-05-16', 'kanus@gmail.com', 'gdsgds', 'hdfhd'),
(48, 'dhff', 'sfddsfds', '2024-05-16', 'kanus@gmail.com', 'gdsgds', 'hdfhd'),
(49, 'dfgdffgd', 'fdgfd', '2024-05-18', 'dfgdfdd2@gdff', 'fgfddfg', 'gddfgf'),
(50, 'dfgdffgd', 'fdgfd', '2024-05-18', 'dfgdfdd2@gdff', 'fgfddfg', 'gddfgf'),
(51, 'dfgdffgd', 'fdgfd', '2024-05-18', 'dfgdfdd2@gdff', 'fgfddfg', 'srhs'),
(52, 'dfgdffgd', 'fdgfd', '2024-05-18', 'dfgdfdd2@gdff', 'fgfddfg', 'f,hjmgfdsa'),
(53, 'dfgdffgd', 'fdgfd', '2024-05-18', 'dfgdfdd2@gdff', 'fgfddfg', 'gdfhfd'),
(54, '123', '123', '2024-05-21', '123@123', '123', '123'),
(55, 'gsgs', 'gsdsg', '2024-04-30', 'pimmelchers1@gmail.com', 'Burhmoemn', 'fes123'),
(56, '1233', '1233', '2024-06-01', '123@1233', '1233', '1233');

-- --------------------------------------------------------

--
-- Table structure for table `Reizen`
--

CREATE TABLE `Reizen` (
  `id` int(11) NOT NULL,
  `Reisnaam` varchar(255) NOT NULL,
  `Omschrijving` text NOT NULL,
  `Personen` varchar(255) NOT NULL,
  `Stad` varchar(255) NOT NULL,
  `Prijs` double NOT NULL,
  `Tijdsduur` varchar(255) NOT NULL,
  `reisfoto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reizen`
--

INSERT INTO `Reizen` (`id`, `Reisnaam`, `Omschrijving`, `Personen`, `Stad`, `Prijs`, `Tijdsduur`, `reisfoto`) VALUES
(7, 'wegsfgd', 'rzdfxg', '3 personen', 'rxdgfnhcvn', 11.5, '2024-06-12', ''),
(8, 'gfdgdfg', 'fdgfdgfgfd', 'gfdgfdgdg', 'gfdggfdgfd', 2345, '2024-06-11', 'gffdgdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Boekingen`
--
ALTER TABLE `Boekingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Klanteninformatie`
--
ALTER TABLE `Klanteninformatie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Reizen`
--
ALTER TABLE `Reizen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Boekingen`
--
ALTER TABLE `Boekingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Klanteninformatie`
--
ALTER TABLE `Klanteninformatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `Reizen`
--
ALTER TABLE `Reizen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
