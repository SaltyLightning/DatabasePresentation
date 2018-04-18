-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 12:02 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `overwatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_stats`
--

CREATE TABLE `cat_stats` (
  `tag` varchar(40) NOT NULL,
  `hero` varchar(40) NOT NULL,
  `elims` int(11) DEFAULT NULL,
  `deaths` int(11) DEFAULT NULL,
  `final_blows` float DEFAULT NULL,
  `healing` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_stats`
--

INSERT INTO `cat_stats` (`tag`, `hero`, `elims`, `deaths`, `final_blows`, `healing`) VALUES
('trollfat-1153', 'widowmaker', 3, 2, 0, 0),
('trollfat-1153', 'winston', 25, 9, 0.32, 0),
('trollfat-1153', 'pharah', 0, 1, 0, 0),
('trollfat-1153', 'reaper', 11, 9, 0.727273, 0),
('trollfat-1153', 'reinhardt', 20, 16, 0.5, 0),
('DogeMafia-11452', 'orisa', 8, 1, 0.25, 0),
('DogeMafia-11452', 'ana', 5, 7, 0, 6074),
('DogeMafia-11452', 'd.va', 0, 4, 0, 0),
('DogeMafia-11452', 'soldier:_76', 22, 7, 0.469697, 1358),
('DogeMafia-11452', 'junkrat', 3, 6, 0.666667, 0),
('DogeMafia-11452', 'winston', 7, 1, 0, 0),
('DogeMafia-11452', 'widowmaker', 28, 9, 0.642857, 0),
('DogeMafia-11452', 'genji', 23, 13, 0.652174, 0),
('DogeMafia-11452', 'roadhog', 0, 2, 0, 0),
('DogeMafia-11452', 'mccree', 30, 9, 0.56044, 0),
('DogeMafia-11452', 'pharah', 33, 10, 0.454545, 0),
('DogeMafia-11452', 'reinhardt', 4, 4, 0, 0),
('DogeMafia-11452', 'tracer', 35, 9, 0.423077, 0),
('trollfat-1153', 'roadhog', 22, 11, 0.454545, 0),
('trollfat-1153', 'zarya', 25, 8, 0.217105, 0),
('trollfat-1153', 'd.va', 32, 7, 0.406157, 0),
('trollfat-1153', 'ana', 0, 1, 0, 2796),
('trollfat-1153', 'orisa', 19, 10, 0.241379, 0),
('trollfat-1153', 'moira', 11, 3, 0.272727, 7736),
('Xay-11653', 'reaper', 11, 2, 0.727273, 0),
('Xay-11653', 'tracer', 28, 11, 0.42487, 0),
('Xay-11653', 'mercy', 0, 4, 0, 3314),
('Xay-11653', 'hanzo', 0, 2, 0, 0),
('Xay-11653', 'reinhardt', 19, 8, 0.558442, 0),
('Xay-11653', 'pharah', 11, 4, 0.454545, 0),
('Xay-11653', 'winston', 26, 8, 0.442308, 0),
('Xay-11653', 'widowmaker', 21, 11, 0.532258, 0),
('Xay-11653', 'bastion', 16, 9, 0.25, 0),
('Xay-11653', 'zenyatta', 6, 9, 0.5, 4583),
('Xay-11653', 'genji', 32, 12, 0.539683, 0),
('Xay-11653', 'mccree', 24, 10, 0.551515, 0),
('Xay-11653', 'junkrat', 23, 10, 0.661765, 0),
('Xay-11653', 'zarya', 32, 6, 0.3125, 0),
('Xay-11653', 'soldier:_76', 30, 8, 0.449153, 1450),
('Xay-11653', 'lÃºcio', 0, 2, 0, 122),
('Xay-11653', 'd.va', 28, 10, 0.428571, 0),
('Xay-11653', 'sombra', 10, 10, 0.5, 0),
('Xay-11653', 'doomfist', 10, 8, 0.8, 0),
('Xay-11653', 'orisa', 17, 6, 0.32, 0),
('Xay-11653', 'moira', 5, 2, 0, 2365),
('dafran-21192', 'reaper', 45, 9, 0.511111, 0),
('dafran-21192', 'tracer', 34, 8, 0.545771, 0),
('dafran-21192', 'hanzo', 12, 13, 0.75, 0),
('dafran-21192', 'torbjÃ¶rn', 25, 8, 0.447154, 0),
('dafran-21192', 'reinhardt', 27, 16, 0.325, 0),
('dafran-21192', 'pharah', 17, 7, 0.588235, 0),
('dafran-21192', 'winston', 18, 6, 0.428571, 0),
('dafran-21192', 'widowmaker', 32, 12, 0.748031, 0),
('dafran-21192', 'bastion', 13, 2, 0.461538, 0),
('dafran-21192', 'symmetra', 8, 8, 0.25, 0),
('dafran-21192', 'zenyatta', 0, 1, 0, 63),
('dafran-21192', 'genji', 31, 9, 0.530035, 0),
('dafran-21192', 'roadhog', 30, 7, 0.494505, 0),
('dafran-21192', 'mccree', 24, 7, 0.468085, 0),
('dafran-21192', 'junkrat', 20, 6, 0.5, 0),
('dafran-21192', 'zarya', 32, 5, 0.369338, 0),
('dafran-21192', 'soldier:_76', 30, 7, 0.502901, 2674),
('dafran-21192', 'lÃºcio', 3, 2, 1, 5035),
('dafran-21192', 'd.va', 0, 2, 0, 0),
('dafran-21192', 'mei', 28, 9, 0.474104, 0),
('dafran-21192', 'sombra', 31, 8, 0.384259, 0),
('dafran-21192', 'doomfist', 2, 6, 1, 0),
('dafran-21192', 'ana', 16, 9, 0.255319, 8684),
('dafran-21192', 'orisa', 3, 3, 0, 0),
('NikkiSavvy-1100', 'd.va', 32, 7, 0.31746, 0),
('NikkiSavvy-1100', 'mercy', 2, 7, 0.322581, 13714),
('NikkiSavvy-1100', 'zenyatta', 15, 8, 0.2, 6700),
('NikkiSavvy-1100', 'lÃºcio', 0, 1, 0, 0),
('NikkiSavvy-1100', 'moira', 27, 8, 0.1955, 12519),
('Doughboy-1500', 'reinhardt', 7, 1, 0.714286, 0),
('Doughboy-1500', 'winston', 4, 4, 0, 0),
('Doughboy-1500', 'zenyatta', 14, 8, 0.276364, 7168),
('Doughboy-1500', 'roadhog', 17, 8, 0.352941, 0),
('Doughboy-1500', 'lÃºcio', 20, 10, 0.138686, 11011),
('Doughboy-1500', 'mei', 0, 1, 0, 0),
('Doughboy-1500', 'ana', 11, 9, 0.218978, 6211),
('Doughboy-1500', 'orisa', 44, 5, 0.318182, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dps_stats`
--

CREATE TABLE `dps_stats` (
  `name` varchar(50) NOT NULL,
  `final_blows` int(11) DEFAULT NULL,
  `damage_done` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_stats`
--

CREATE TABLE `general_stats` (
  `sid` int(12) NOT NULL,
  `losses` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `winrate` float NOT NULL,
  `games_played` int(11) NOT NULL,
  `hero` varchar(15) DEFAULT NULL,
  `tag` varchar(24) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_stats`
--

INSERT INTO `general_stats` (`sid`, `losses`, `wins`, `winrate`, `games_played`, `hero`, `tag`) VALUES
(1029, 0, 7, 84, 9, 'zarya', 'dafran-21192'),
(1030, 0, 14, 83, 17, 'soldier:_76', 'dafran-21192'),
(1031, 0, 0, 0, 1, 'lÃºcio', 'dafran-21192'),
(1032, 0, 0, 100, 0, 'd.va', 'dafran-21192'),
(1033, 0, 6, 69, 9, 'mei', 'dafran-21192'),
(1034, 0, 16, 81, 21, 'sombra', 'dafran-21192'),
(1035, 0, 0, 81, 0, 'doomfist', 'dafran-21192'),
(1036, 0, 3, 77, 3, 'ana', 'dafran-21192'),
(1037, 0, 0, 100, 0, 'orisa', 'dafran-21192'),
(1044, 30, 33, 52, 64, NULL, 'NikkiSavvy-1100'),
(1045, 0, 6, 49, 13, 'mercy', 'NikkiSavvy-1100'),
(1046, 0, 2, 73, 2, 'zenyatta', 'NikkiSavvy-1100'),
(1047, 0, 0, 0, 0, 'lÃºcio', 'NikkiSavvy-1100'),
(1048, 0, 2, 92, 2, 'd.va', 'NikkiSavvy-1100'),
(1049, 0, 23, 50, 47, 'moira', 'NikkiSavvy-1100'),
(1050, 21, 20, 48, 42, NULL, 'Doughboy-1500'),
(1051, 0, 0, 97, 0, 'reinhardt', 'Doughboy-1500'),
(1052, 0, 0, 0, 0, 'winston', 'Doughboy-1500'),
(1053, 0, 10, 54, 19, 'zenyatta', 'Doughboy-1500'),
(1054, 0, 0, 0, 1, 'roadhog', 'Doughboy-1500'),
(1055, 0, 3, 43, 7, 'lÃºcio', 'Doughboy-1500'),
(1056, 0, 0, 0, 0, 'mei', 'Doughboy-1500'),
(1057, 0, 6, 47, 12, 'ana', 'Doughboy-1500'),
(1058, 0, 1, 58, 1, 'orisa', 'Doughboy-1500'),
(1012, 0, 0, 0, 0, 'moira', 'Xay-11653'),
(1013, 54, 131, 69, 189, NULL, 'dafran-21192'),
(1014, 0, 1, 63, 1, 'reaper', 'dafran-21192'),
(1015, 0, 67, 72, 94, 'tracer', 'dafran-21192'),
(1016, 0, 1, 24, 3, 'hanzo', 'dafran-21192'),
(1017, 0, 3, 68, 5, 'torbjÃ¶rn', 'dafran-21192'),
(1018, 0, 1, 38, 3, 'reinhardt', 'dafran-21192'),
(1019, 0, 0, 58, 1, 'pharah', 'dafran-21192'),
(1020, 0, 0, 0, 2, 'winston', 'dafran-21192'),
(1021, 0, 3, 79, 4, 'widowmaker', 'dafran-21192'),
(1022, 0, 0, 41, 0, 'bastion', 'dafran-21192'),
(1023, 0, 0, 0, 1, 'symmetra', 'dafran-21192'),
(1024, 0, 0, 100, 0, 'zenyatta', 'dafran-21192'),
(1025, 0, 5, 58, 9, 'genji', 'dafran-21192'),
(1026, 0, 2, 61, 3, 'roadhog', 'dafran-21192'),
(1027, 0, 1, 63, 2, 'mccree', 'dafran-21192'),
(1028, 0, 0, 10, 1, 'junkrat', 'dafran-21192'),
(983, 0, 2, 86, 2, 'winston', 'trollfat-1153'),
(984, 0, 0, 0, 0, 'widowmaker', 'trollfat-1153'),
(985, 0, 1, 42, 2, 'roadhog', 'trollfat-1153'),
(986, 0, 3, 58, 6, 'zarya', 'trollfat-1153'),
(987, 0, 17, 56, 31, 'd.va', 'trollfat-1153'),
(988, 0, 0, 0, 0, 'ana', 'trollfat-1153'),
(989, 0, 1, 40, 3, 'orisa', 'trollfat-1153'),
(990, 0, 0, 0, 0, 'moira', 'trollfat-1153'),
(991, 26, 22, 45, 49, NULL, 'Xay-11653'),
(992, 0, 0, 100, 0, 'reaper', 'Xay-11653'),
(993, 0, 2, 34, 7, 'tracer', 'Xay-11653'),
(994, 0, 0, 0, 0, 'mercy', 'Xay-11653'),
(995, 0, 0, 0, 0, 'hanzo', 'Xay-11653'),
(996, 0, 2, 52, 4, 'reinhardt', 'Xay-11653'),
(997, 0, 0, 83, 1, 'pharah', 'Xay-11653'),
(998, 0, 2, 53, 4, 'winston', 'Xay-11653'),
(999, 0, 1, 49, 3, 'widowmaker', 'Xay-11653'),
(1000, 0, 0, 43, 0, 'bastion', 'Xay-11653'),
(1001, 0, 0, 0, 1, 'zenyatta', 'Xay-11653'),
(1002, 0, 3, 54, 6, 'genji', 'Xay-11653'),
(1003, 0, 4, 64, 7, 'mccree', 'Xay-11653'),
(1004, 0, 2, 49, 3, 'junkrat', 'Xay-11653'),
(1005, 0, 0, 56, 1, 'zarya', 'Xay-11653'),
(1006, 0, 2, 49, 4, 'soldier:_76', 'Xay-11653'),
(1007, 0, 0, 0, 0, 'lÃºcio', 'Xay-11653'),
(1008, 0, 0, 30, 1, 'd.va', 'Xay-11653'),
(1009, 0, 0, 8, 1, 'sombra', 'Xay-11653'),
(1010, 0, 0, 0, 0, 'doomfist', 'Xay-11653'),
(1011, 0, 2, 32, 6, 'orisa', 'Xay-11653'),
(982, 0, 0, 0, 0, 'pharah', 'trollfat-1153'),
(979, 22, 24, 51, 47, NULL, 'trollfat-1153'),
(980, 0, 0, 0, 1, 'reaper', 'trollfat-1153'),
(981, 0, 0, 0, 1, 'reinhardt', 'trollfat-1153'),
(965, 9, 8, 47, 17, NULL, 'DogeMafia-11452'),
(966, 0, 2, 63, 3, 'tracer', 'DogeMafia-11452'),
(967, 0, 0, 0, 0, 'reinhardt', 'DogeMafia-11452'),
(968, 0, 1, 53, 1, 'pharah', 'DogeMafia-11452'),
(969, 0, 0, 100, 0, 'winston', 'DogeMafia-11452'),
(970, 0, 1, 83, 1, 'widowmaker', 'DogeMafia-11452'),
(971, 0, 1, 75, 1, 'genji', 'DogeMafia-11452'),
(972, 0, 0, 0, 0, 'roadhog', 'DogeMafia-11452'),
(973, 0, 1, 35, 3, 'mccree', 'DogeMafia-11452'),
(974, 0, 0, 20, 0, 'junkrat', 'DogeMafia-11452'),
(975, 0, 2, 53, 3, 'soldier:_76', 'DogeMafia-11452'),
(976, 0, 0, 0, 0, 'd.va', 'DogeMafia-11452'),
(977, 0, 0, 0, 1, 'ana', 'DogeMafia-11452'),
(978, 0, 0, 0, 0, 'orisa', 'DogeMafia-11452');

-- --------------------------------------------------------

--
-- Table structure for table `hero_friendly`
--

CREATE TABLE `hero_friendly` (
  `api_name` varchar(50) NOT NULL,
  `friendly_name` varchar(50) NOT NULL,
  `catagory` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hero_friendly`
--

INSERT INTO `hero_friendly` (`api_name`, `friendly_name`, `catagory`) VALUES
('ana', 'Ana', 'Support'),
('bastion', 'Bastion', 'DPS'),
('brigitte', 'Brigitte', 'Support'),
('d.va', 'D.Va', 'Tank'),
('doomfist', 'Doomfist', 'DPS'),
('genji', 'Genji', 'DPS'),
('hanzo', 'Hanzo', 'DPS'),
('junkrat', 'Junkrat', 'DPS'),
('lÃºcio', 'Lucio', 'Support'),
('mccree', 'Mccree', 'DPS'),
('mei', 'Mei', 'DPS'),
('mercy', 'Mercy', 'Support'),
('moira', 'Moira', 'Support'),
('orisa', 'Orisa', 'Tank'),
('pharah', 'Pharah', 'DPS'),
('reaper', 'Reaper', 'DPS'),
('reinhardt', 'Reinhardt', 'Tank'),
('roadhog', 'Roadhog', 'Tank'),
('soldier:_76', 'Soldier 76', 'DPS'),
('sombra', 'Sombra', 'DPS'),
('symmetra', 'Symmetra', 'DPS'),
('torbjÃ¶rn', 'Torbjorn', 'DPS'),
('tracer', 'Tracer', 'DPS'),
('widowmaker', 'Widowmaker', 'DPS'),
('winston', 'Winston', 'Tank'),
('zarya', 'Zarya', 'Tank'),
('zenyatta', 'Zenyatta', 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `hero_stats`
--

CREATE TABLE `hero_stats` (
  `name` varchar(50) NOT NULL,
  `elems` int(11) DEFAULT NULL,
  `deaths` int(11) DEFAULT NULL,
  `o_time` int(11) DEFAULT NULL,
  `o_kills` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `tag` varchar(40) NOT NULL,
  `sr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`tag`, `sr`) VALUES
('dafran-21192', 4705),
('DogeMafia-11452', 2407),
('Doughboy-1500', 2586),
('Icebergs2-1358', 2871),
('Kabaji-2184', 4411),
('NikkiSavvy-1100', 2845),
('trollfat-1153', 2885),
('Xay-11653', 2643);

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `sr` int(11) NOT NULL,
  `rank` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`sr`, `rank`) VALUES
(1000, 'Bronze'),
(1500, 'Silver'),
(2000, 'Gold'),
(2500, 'Platinum'),
(3000, 'Diamond'),
(3500, 'Master'),
(4000, 'GM');

-- --------------------------------------------------------

--
-- Table structure for table `support_stats`
--

CREATE TABLE `support_stats` (
  `name` varchar(50) NOT NULL,
  `healing` int(11) DEFAULT NULL,
  `assists` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_leader` varchar(50) NOT NULL,
  `mem2` varchar(50) DEFAULT NULL,
  `mem3` varchar(50) DEFAULT NULL,
  `mem4` varchar(50) DEFAULT NULL,
  `mem5` varchar(50) DEFAULT NULL,
  `mem6` varchar(50) DEFAULT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_leader`, `mem2`, `mem3`, `mem4`, `mem5`, `mem6`, `team_id`) VALUES
('', NULL, NULL, NULL, NULL, NULL, 1),
('', NULL, NULL, NULL, NULL, NULL, 2),
('Xay-11653', NULL, NULL, NULL, NULL, NULL, 3),
('', NULL, NULL, NULL, NULL, NULL, 4),
('', NULL, NULL, NULL, NULL, NULL, 5),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 6),
('Kabaji-2184', NULL, NULL, NULL, NULL, NULL, 7),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 8),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 9),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 10),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 11),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 12),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 13),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 14),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 15),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 16),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 17),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 18),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 19),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 20),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 21),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 22),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 23),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 24),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 25),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 26),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 27),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 28),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 29),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 30),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 31),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 32),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 33),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 34),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 35),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 36),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 37),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 38),
('trollfat-1153', NULL, NULL, NULL, NULL, NULL, 39),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 40),
('Xay-11653', NULL, NULL, NULL, NULL, NULL, 41),
('Xay-11653', NULL, NULL, NULL, NULL, NULL, 42),
('DogeMafia-11452', NULL, NULL, NULL, NULL, NULL, 43),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 44),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 45),
('Xay-11653', NULL, NULL, NULL, NULL, NULL, 46),
('dafran-21192', NULL, NULL, NULL, NULL, NULL, 47),
('Xay-11653', NULL, NULL, NULL, NULL, NULL, 48),
('NikkiSavvy-1100', NULL, NULL, NULL, NULL, NULL, 49),
('NikkiSavvy-1100', NULL, NULL, NULL, NULL, NULL, 50),
('Doughboy-1500', NULL, NULL, NULL, NULL, NULL, 51);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_stats`
--
ALTER TABLE `cat_stats`
  ADD PRIMARY KEY (`tag`,`hero`),
  ADD KEY `hero` (`hero`);

--
-- Indexes for table `dps_stats`
--
ALTER TABLE `dps_stats`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `general_stats`
--
ALTER TABLE `general_stats`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `hero_friendly`
--
ALTER TABLE `hero_friendly`
  ADD PRIMARY KEY (`api_name`);

--
-- Indexes for table `hero_stats`
--
ALTER TABLE `hero_stats`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`tag`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`rank`);

--
-- Indexes for table `support_stats`
--
ALTER TABLE `support_stats`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `mem2` (`mem2`),
  ADD KEY `mem3` (`mem3`),
  ADD KEY `mem4` (`mem4`),
  ADD KEY `mem5` (`mem5`),
  ADD KEY `mem6` (`mem6`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `general_stats`
--
ALTER TABLE `general_stats`
  MODIFY `sid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1059;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dps_stats`
--
ALTER TABLE `dps_stats`
  ADD CONSTRAINT `dps_stats_ibfk_1` FOREIGN KEY (`name`) REFERENCES `hero_friendly` (`api_name`);

--
-- Constraints for table `hero_stats`
--
ALTER TABLE `hero_stats`
  ADD CONSTRAINT `hero_stats_ibfk_1` FOREIGN KEY (`name`) REFERENCES `hero_friendly` (`api_name`);

--
-- Constraints for table `support_stats`
--
ALTER TABLE `support_stats`
  ADD CONSTRAINT `support_stats_ibfk_1` FOREIGN KEY (`name`) REFERENCES `hero_friendly` (`api_name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
