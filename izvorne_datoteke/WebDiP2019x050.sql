-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 06:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2019x050`
--

-- --------------------------------------------------------

--
-- Table structure for table `dijete`
--

CREATE TABLE `dijete` (
  `OIB_dijete` char(11) NOT NULL,
  `ime` varchar(45) DEFAULT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `skupina_id` int(11) DEFAULT NULL,
  `roditelj_OIB` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dijete`
--

INSERT INTO `dijete` (`OIB_dijete`, `ime`, `prezime`, `skupina_id`, `roditelj_OIB`) VALUES
('0324175869', 'Kazimir', 'Pavlić', 4, '7982640135'),
('0391687245', 'Karla', 'Pavlić', 3, '7982640135'),
('1324807659', 'Lucija', 'Prkić', 4, '9135806742'),
('1936270845', 'Ivan', 'Ilić', 3, '6957248031'),
('1942658730', 'Matej', 'Ilić', 4, '6957248031'),
('3420716895', 'Luka', 'Prkić', 4, '9135806742'),
('3741508962', 'Lana', 'Prkić', 3, '9135806742'),
('4728153906', 'Marko', 'Ilić', 1, '6957248031'),
('7365980142', 'Laura', 'Prkić', 1, '9135806742'),
('9520467183', 'Karlo', 'Pavlić', 3, '7982640135');

-- --------------------------------------------------------

--
-- Table structure for table `dijete_prijavljeno`
--

CREATE TABLE `dijete_prijavljeno` (
  `OIB_dijete` char(11) NOT NULL,
  `prijava_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dijete_prijavljeno`
--

INSERT INTO `dijete_prijavljeno` (`OIB_dijete`, `prijava_id`) VALUES
('0324175869', 38),
('0324175869', 40),
('0391687245', 4),
('0391687245', 35),
('0391687245', 37),
('1324807659', 9),
('1324807659', 39),
('1942658730', 8),
('3420716895', 7),
('4728153906', 2),
('7365980142', 1),
('9520467183', 3),
('9520467183', 36);

-- --------------------------------------------------------

--
-- Table structure for table `djecji_vrtic`
--

CREATE TABLE `djecji_vrtic` (
  `djecji_vrtic_id` int(11) NOT NULL,
  `naziv_djecjeg_vrtica` varchar(45) DEFAULT NULL,
  `adresa` varchar(45) DEFAULT NULL,
  `galerija` varchar(30) NOT NULL,
  `OIB_korisnik_admin` char(11) DEFAULT NULL,
  `OIB_korisnik_mod` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `djecji_vrtic`
--

INSERT INTO `djecji_vrtic` (`djecji_vrtic_id`, `naziv_djecjeg_vrtica`, `adresa`, `galerija`, `OIB_korisnik_admin`, `OIB_korisnik_mod`) VALUES
(1, 'Zrno', 'Braće Radić 1a, Zagreb', 'zrno', '10293847561', '2486507931'),
(2, 'Prvomajsko sunce', 'Trg slobode 7, Varaždin', 'prvomajsko', '10293847561', '4738295061'),
(3, 'Sunašce', 'Trg kralja Tomislava 2a, Zagreb', 'sunasce', '10293847561', '4752036189'),
(4, 'Srećica', 'Dužice 4, Zagreb', 'srecica', '10293847561', '5948067213'),
(5, 'Kolačići', 'Braće Radić 67, Split', 'kolacici', '10293847561', '6452783910'),
(6, 'Pahulje', 'Trg kralja Tomislava 3e, Čakovec', 'pahulje', '10293847561', '7506238194'),
(7, 'Kockice', 'Marka Marulića 47, Čakovec', 'kockice', '10293847561', '8017465392'),
(8, 'Duga', 'Trg slobode 2c, Koprivnica', 'duga', '10293847561', '9123487065'),
(9, 'Cvijetić', 'Ljudevita Gaja 33, Zagreb', 'cvijetic', '10293847561', '56473829101'),
(10, 'Trokutići', 'Gorička 32, Zagreb', 'trokutici', '10293847561', '76472192153'),
(11, 'Tikvica', 'Trg bana Josipa Jelačića 56, Virje', 'Tikvica', '10293847561', '63817284921');

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `vrijeme` datetime DEFAULT NULL,
  `OIB_korisnik` char(11) DEFAULT NULL,
  `tip_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `vrijeme`, `OIB_korisnik`, `tip_id`) VALUES
(1, '2019-11-05 07:12:37', '10293847561', 4),
(2, '2019-11-05 08:42:57', '10293847561', 4),
(3, '2019-11-05 12:02:12', '10293847561', 4),
(4, '2019-11-05 12:48:27', '10293847561', 4),
(5, '2020-04-22 12:48:23', '9135806742', 4),
(6, '2020-04-22 12:51:22', '9135806742', 4),
(7, '2020-04-22 12:54:17', '9135806742', 4),
(8, '2020-01-01 00:00:00', '10293847561', 4),
(9, '2020-02-01 00:00:00', '10293847561', 4),
(10, '2020-03-01 00:00:00', '10293847561', 4),
(11, '2020-06-09 00:00:00', '10293847561', 2),
(12, '2020-06-09 17:21:44', '10293847561', 1),
(13, '2020-06-09 00:00:00', '10293847561', 2),
(14, '2020-06-09 17:25:22', '10293847561', 2),
(15, '2020-06-09 17:25:27', '10293847561', 1),
(16, '2020-06-09 17:27:05', '10293847561', 2),
(17, '2020-06-09 17:27:09', '7982640135', 1),
(18, '2020-06-09 17:33:10', '7982640135', 3),
(19, '2020-06-09 17:36:15', '10293847561', 2),
(20, '2020-06-09 17:36:19', '7982640135', 1),
(21, '2020-06-09 17:36:28', '7982640135', 2),
(22, '2020-06-09 17:36:33', '2486507931', 1),
(23, '2020-06-09 17:36:44', '2486507931', 3),
(24, '2020-06-09 17:36:46', '2486507931', 3),
(25, '2020-06-09 17:36:48', '2486507931', 2),
(26, '2020-06-09 17:36:53', '10293847561', 1),
(27, '2020-06-09 17:41:47', '10293847561', 4),
(28, '2020-06-09 17:43:18', '10293847561', 4),
(29, '2020-06-09 17:45:00', '10293847561', 2),
(30, '2020-06-09 17:45:05', '10293847561', 1),
(31, '2020-06-09 17:45:23', '7982640135', 3),
(32, '2020-06-09 17:45:29', '7982640135', 3),
(33, '2020-06-09 17:50:17', '7982640135', 2),
(34, '2020-06-09 17:50:20', '2486507931', 1),
(35, '2020-06-09 17:50:23', '2486507931', 2),
(36, '2020-06-09 17:50:32', '2486507931', 2),
(37, '2020-06-09 17:51:08', '2486507931', 3),
(38, '2020-06-09 17:51:51', '2486507931', 4),
(39, '2020-06-09 17:59:21', '2486507931', 3),
(40, '2020-06-09 17:59:22', '2486507931', 3),
(41, '2020-06-09 17:59:28', '2486507931', 2),
(42, '2020-06-09 17:59:33', '7982640135', 1),
(43, '2020-06-09 17:59:39', '7982640135', 3),
(44, '2020-06-09 17:59:54', '7982640135', 3),
(45, '2020-06-09 17:59:56', '7982640135', 3),
(46, '2020-06-09 18:00:14', '7982640135', 3),
(47, '2020-06-09 18:06:05', '10293847561', 3);

-- --------------------------------------------------------

--
-- Table structure for table `evidencija`
--

CREATE TABLE `evidencija` (
  `evidencija_id` int(11) NOT NULL,
  `mjesec` varchar(45) DEFAULT NULL,
  `djecji_vrtic_id` int(11) DEFAULT NULL,
  `OIB_korisnik_mod` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evidencija`
--

INSERT INTO `evidencija` (`evidencija_id`, `mjesec`, `djecji_vrtic_id`, `OIB_korisnik_mod`) VALUES
(1, 'Siječanj, 2020.', 1, '2486507931'),
(2, 'Veljača, 2020.', 1, '2486507931'),
(3, 'Ožujak, 2020.', 1, '2486507931'),
(4, 'Travanj, 2020.', 1, '2486507931'),
(5, 'Svibanj, 2020.', 1, '2486507931'),
(6, 'Lipanj, 2020.', 1, '2486507931'),
(7, 'Srpanj, 2020.', 1, '2486507931'),
(8, 'Kolovoz, 2020.', 1, '2486507931'),
(9, 'Rujan, 2020.', 1, '2486507931'),
(10, 'Listopad, 2020.', 1, '2486507931'),
(13, 'Studeni, 2020.', 1, '2486507931');

-- --------------------------------------------------------

--
-- Table structure for table `evidentirano`
--

CREATE TABLE `evidentirano` (
  `evidencija_id` int(11) NOT NULL,
  `OIB_dijete` char(11) NOT NULL,
  `broj_dolazaka` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evidentirano`
--

INSERT INTO `evidentirano` (`evidencija_id`, `OIB_dijete`, `broj_dolazaka`) VALUES
(1, '0324175869', '20'),
(1, '0391687245', '20'),
(1, '1324807659', '15'),
(2, '0324175869', '18'),
(2, '0391687245', '20'),
(2, '1324807659', '17'),
(3, '0324175869', '17'),
(3, '0391687245', '19'),
(3, '1324807659', '16'),
(4, '0324175869', '16'),
(13, '0324175869', '3');

-- --------------------------------------------------------

--
-- Table structure for table `javni_poziv`
--

CREATE TABLE `javni_poziv` (
  `javni_poziv_id` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `broj_prijava` int(11) DEFAULT NULL,
  `OIB_korisnik` char(11) DEFAULT NULL,
  `djecji_vrtic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `javni_poziv`
--

INSERT INTO `javni_poziv` (`javni_poziv_id`, `datum`, `broj_prijava`, `OIB_korisnik`, `djecji_vrtic_id`) VALUES
(1, '2020-06-16', 19, '2486507931', 1),
(2, '2020-04-17', 15, '4738295061', 2),
(3, '2020-04-24', 15, '4752036189', 3),
(4, '2020-04-24', 20, '5948067213', 4),
(5, '2020-04-21', 10, '6452783910', 5),
(6, '2020-06-11', 6, '2486507931', 6),
(7, '2020-04-29', 20, '8017465392', 7),
(8, '2020-04-30', 20, '9123487065', 8),
(9, '2020-05-01', 20, '56473829101', 9),
(10, '2020-04-01', 15, '76472192153', 10),
(11, '2020-06-12', 5, '2486507931', 1),
(13, '2020-07-31', 25, '2486507931', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `OIB_korisnik` char(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinka_sha1` char(40) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `uvjeti` datetime DEFAULT NULL,
  `vrijeme_registracije` datetime DEFAULT NULL,
  `aktiviran` tinyint(4) DEFAULT NULL,
  `uloga_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`OIB_korisnik`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `lozinka_sha1`, `email`, `uvjeti`, `vrijeme_registracije`, `aktiviran`, `uloga_id`) VALUES
('10293847561', 'Stjepan', 'Marković', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'smarkovic@hotmail.com', '2020-04-01 05:31:10', '2020-04-01 05:29:20', 1, 1),
('10462837461', 'kor1', 'kor1', 'kor123', 'Lozinka987', 'b85a27d985c9a28e5f619ba3ea37aa69aca54b12', 'kor@kor.hr', NULL, '2020-06-09 00:00:00', 1, 3),
('1234567890', 'da', 'da', 'da98', 'da', 'cdd4f874095045f4ae6670038cbbd05fac9d4802', 'da98@mail.com', NULL, '2020-06-08 14:26:58', 0, 3),
('2486507931', 'Bogdan', 'Milić', 'mod', 'mod', '7dd30f0a95d522bfc058be4e75847f8b6df9f76b', 'bmile98@gmail.com', '2020-04-10 09:19:05', '2020-04-10 06:37:06', 1, 2),
('4738295061', 'Jurica', 'Livitić', 'jurlivit', 'jurlivit456', '8043db6cc66c7a61808bac48060728c76a32effe', 'jurlivit@hotmail.com', '2020-04-08 13:25:11', '2020-04-08 10:22:28', 0, 2),
('4752036189', 'Daria', 'Jurišević', 'dariaj', 'vrtićnovilozinka1', 'd946a82646f7dd56f223a19f736363d4ee1b2f6c', 'dariaj@net.hr', '2020-04-10 09:03:03', '2020-04-10 08:23:11', 1, 2),
('56473829101', 'Jakob', 'Kuliman', 'jkuliman80', 'osamdesetlozinka', 'a2f16fad12c662832345dc5577f7e13d409f4813', 'kulimanj@gmail.com', '2020-04-06 09:15:15', '2020-04-05 08:59:37', 1, 2),
('5948067213', 'Goran', 'Filipović', 'gfile', 'grillfile8', 'e1276407e8dc5f86630c6ded26d95c15f9727751', 'gfile@gmail.com', '2020-04-13 14:04:24', '2020-04-13 13:17:05', 1, 2),
('62718452672', 'Ivo', 'Ivić', 'ivoivic4', 'Lozinkaivo1', '640457dea9a7a4f3ea9ff09835f0662a8f2b9ef0', 'ivoivic4@mail.info', NULL, '2020-06-09 16:52:52', 0, 3),
('63817284921', 'mod1', 'mod1', 'mod1', 'mod1lozinka1', '727a5b89d1a291e125e48a6eab436f743db59429', 'mod1@mod1.info', NULL, '2020-06-09 00:00:00', 1, 2),
('6452783910', 'Julian', 'Markovski', 'jmark', 'lozinkazavrtic1', 'ed753cd35409b3b7e6a966f096a2da8f4e6df191', 'jmark@net.hr', '2020-04-07 08:24:48', '2020-04-07 08:13:09', 1, 2),
('6957248031', 'Lucia', 'Ilić', 'lilic333', 'loziNKA098', '7a6b7a24db009f1cfa0fff0a6fdacd276ceddbf3', 'lilic@hotmail.com', '2020-04-16 04:05:01', '2020-04-05 07:15:05', 1, 3),
('7506238194', 'Marija', 'Tunjak', 'tunjakmar', 'lozinkavrtic4', '2d164a1a8dd111fd560dc586dc7c7fd3fa064df8', 'matunjak@yahoo.com', '2020-04-07 09:13:59', '2020-04-07 09:13:17', 1, 2),
('76472192153', 'Anja', 'Mirović', 'amirovic', 'lozinka123', 'cdca8723933a3ca36c5707a04ed0d7abbbd40c6a', 'amirovic82@gmail.com', '2020-04-06 13:31:17', '2020-04-06 13:22:44', 0, 2),
('7982640135', 'Dunja', 'Pavlić', 'reg', 'reg', 'e06b95860a6082ae37ef08874f8eb5fade2549da', 'dpavelic@gmail.com', '2020-04-15 03:14:45', '2020-04-13 03:11:04', 1, 3),
('8017465392', 'Mirko', 'Manojlović', 'mmanojle', 'robinhud123', '81ccfcfc240b2bd4a0bc7231e9cf2d221f20e511', 'mmanoj@gmail.com', '2020-04-08 13:36:12', '2020-04-08 13:28:07', 1, 2),
('9123487065', 'Marijan', 'Juraj', 'jurajm', 'vrticmojlozinka', 'df724576e8152eb3450100adea317c31fc3be020', 'mjuraj@hotmail.com', '2020-04-06 11:02:16', '2020-04-06 10:11:59', 1, 2),
('9135806742', 'Lucija', 'Prkić', 'lprkic231', 'lOzInKa123', 'ba2378092f8bdc241ecf5e83a5e305f3d89f1498', 'lprkic@hotmail.com', '2020-04-15 10:03:07', '2020-04-15 09:18:06', 1, 3),
('94728164527', 'Prile', 'Prilika', 'prikaprile12', 'lozinkaprikaprile12', '926d3ab2d0e22a9df10d5698f59d0c2cd884be76', 'prileprika@mail.hr', NULL, '2020-06-09 00:00:00', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ocjena_mjesecno`
--

CREATE TABLE `ocjena_mjesecno` (
  `OIB_korisnik_admin` char(11) NOT NULL,
  `djecji_vrtic_id` int(11) NOT NULL,
  `mjesec/godina` date NOT NULL,
  `ocjena` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ocjena_mjesecno`
--

INSERT INTO `ocjena_mjesecno` (`OIB_korisnik_admin`, `djecji_vrtic_id`, `mjesec/godina`, `ocjena`) VALUES
('10293847561', 1, '2019-07-01', 8),
('10293847561', 1, '2019-08-01', 8),
('10293847561', 1, '2019-09-01', 7),
('10293847561', 1, '2019-10-01', 8),
('10293847561', 1, '2019-11-01', 7),
('10293847561', 1, '2020-01-01', 8),
('10293847561', 1, '2020-02-01', 7),
('10293847561', 1, '2020-03-01', 8),
('10293847561', 1, '2020-04-01', 9),
('10293847561', 1, '2020-05-01', 10),
('10293847561', 1, '2020-06-09', 5),
('10293847561', 2, '2020-06-09', 5);

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE `prijava` (
  `prijava_id` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `odobrena` tinyint(1) NOT NULL,
  `prihvaceno` tinyint(1) NOT NULL,
  `OIB_korisnik_rod` char(11) DEFAULT NULL,
  `skupina_id` int(11) DEFAULT NULL,
  `javni_poziv_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`prijava_id`, `datum`, `odobrena`, `prihvaceno`, `OIB_korisnik_rod`, `skupina_id`, `javni_poziv_id`) VALUES
(1, '2020-04-22', 1, 1, '9135806742', 1, 2),
(2, '2020-04-23', 1, 1, '6957248031', 1, 3),
(3, '2020-04-22', 1, 1, '6957248031', 3, 4),
(4, '2020-04-22', 1, 1, '9135806742', 3, 5),
(7, '2020-04-23', 1, 1, '9135806742', 4, 8),
(8, '2020-04-23', 1, 1, '9135806742', 4, 9),
(9, '2020-04-23', 0, 0, '6957248031', 4, 10),
(35, '2020-06-08', 1, 0, '7982640135', 4, 11),
(36, '2020-06-08', 1, 0, '7982640135', 3, 11),
(37, '2020-06-08', 0, 0, '7982640135', 3, 6),
(38, '2020-06-08', 1, 0, '2486507931', 4, 6),
(39, '2020-06-08', 0, 0, '2486507931', 3, 6),
(40, '2020-06-08', 0, 0, '2486507931', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `racun_id` int(11) NOT NULL,
  `mjesec` date DEFAULT NULL,
  `iznos` decimal(10,0) DEFAULT NULL,
  `placen` tinyint(1) NOT NULL,
  `OIB_korisnik_mod` char(11) DEFAULT NULL,
  `OIB_korisnik_rod` char(11) DEFAULT NULL,
  `evidencija_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`racun_id`, `mjesec`, `iznos`, `placen`, `OIB_korisnik_mod`, `OIB_korisnik_rod`, `evidencija_id`) VALUES
(1, '2020-02-05', '125', 1, '2486507931', '7982640135', 1),
(2, '2020-02-05', '150', 1, '2486507931', '7982640135', 1),
(3, '2020-02-05', '105', 0, '2486507931', '9135806742', 1),
(4, '2020-03-05', '125', 1, '2486507931', '7982640135', 2),
(5, '2020-03-05', '150', 1, '2486507931', '7982640135', 2),
(6, '2020-03-05', '105', 0, '2486507931', '9135806742', 2),
(7, '2020-04-07', '125', 1, '2486507931', '7982640135', 3),
(8, '2020-04-07', '150', 0, '2486507931', '7982640135', 3),
(9, '2020-04-07', '105', 0, '2486507931', '9135806742', 3),
(10, '2020-05-07', '105', 0, '2486507931', '7982640135', 4),
(11, '2020-06-08', '200', 1, '2486507931', '7982640135', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skupina`
--

CREATE TABLE `skupina` (
  `skupina_id` int(11) NOT NULL,
  `naziv_skupine` varchar(45) DEFAULT NULL,
  `cijena` int(11) DEFAULT NULL,
  `OIB_korisnik` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skupina`
--

INSERT INTO `skupina` (`skupina_id`, `naziv_skupine`, `cijena`, `OIB_korisnik`) VALUES
(1, 'Mlađa jaslička', 100, '2486507931'),
(2, 'Starija jaslička', 120, '2486507931'),
(3, 'Mlađa vrtićka', 150, '2486507931'),
(4, 'Starija vrtićka', 155, '2486507931');

-- --------------------------------------------------------

--
-- Table structure for table `skupina_pripada`
--

CREATE TABLE `skupina_pripada` (
  `djecji_vrtic_id` int(11) NOT NULL,
  `skupina_id` int(11) NOT NULL,
  `broj_djece` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skupina_pripada`
--

INSERT INTO `skupina_pripada` (`djecji_vrtic_id`, `skupina_id`, `broj_djece`) VALUES
(1, 1, 5),
(1, 2, 10),
(1, 3, 25),
(1, 4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tip_promjene`
--

CREATE TABLE `tip_promjene` (
  `tip_promjene_id` int(11) NOT NULL,
  `naziv_promjene` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_promjene`
--

INSERT INTO `tip_promjene` (`tip_promjene_id`, `naziv_promjene`) VALUES
(1, 'login'),
(2, 'logout'),
(3, 'pretrazivanje'),
(4, 'dodavanje sadrzaja');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `iduloga` int(11) NOT NULL,
  `naziv_uloge` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`iduloga`, `naziv_uloge`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Registrirani korisnik'),
(4, 'Neregistrirani korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dijete`
--
ALTER TABLE `dijete`
  ADD PRIMARY KEY (`OIB_dijete`),
  ADD KEY `skupina_id_idx` (`skupina_id`),
  ADD KEY `fk_roditelj` (`roditelj_OIB`);

--
-- Indexes for table `dijete_prijavljeno`
--
ALTER TABLE `dijete_prijavljeno`
  ADD PRIMARY KEY (`OIB_dijete`,`prijava_id`),
  ADD KEY `prijava_id_idx` (`prijava_id`);

--
-- Indexes for table `djecji_vrtic`
--
ALTER TABLE `djecji_vrtic`
  ADD PRIMARY KEY (`djecji_vrtic_id`),
  ADD KEY `OIB_korisnik_admin_idx` (`OIB_korisnik_admin`),
  ADD KEY `OIB_korisnik_mod_idx` (`OIB_korisnik_mod`);

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`),
  ADD KEY `tip_promjene_id_idx` (`tip_id`),
  ADD KEY `OIB_korisnika_idx` (`OIB_korisnik`);

--
-- Indexes for table `evidencija`
--
ALTER TABLE `evidencija`
  ADD PRIMARY KEY (`evidencija_id`),
  ADD KEY `OIB_korisnik_mod_idx` (`OIB_korisnik_mod`),
  ADD KEY `djecji_vrtic_id_idx` (`djecji_vrtic_id`);

--
-- Indexes for table `evidentirano`
--
ALTER TABLE `evidentirano`
  ADD PRIMARY KEY (`evidencija_id`,`OIB_dijete`),
  ADD KEY `OIB_dijete_idx` (`OIB_dijete`);

--
-- Indexes for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  ADD PRIMARY KEY (`javni_poziv_id`),
  ADD KEY `OIB_korisnik_mod_idx` (`OIB_korisnik`),
  ADD KEY `djecji_vrtic_id_idx` (`djecji_vrtic_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`OIB_korisnik`),
  ADD KEY `uloga_id_idx` (`uloga_id`);

--
-- Indexes for table `ocjena_mjesecno`
--
ALTER TABLE `ocjena_mjesecno`
  ADD PRIMARY KEY (`OIB_korisnik_admin`,`mjesec/godina`,`djecji_vrtic_id`),
  ADD KEY `djecji_vrtic_id_idx` (`djecji_vrtic_id`);

--
-- Indexes for table `prijava`
--
ALTER TABLE `prijava`
  ADD PRIMARY KEY (`prijava_id`),
  ADD KEY `OIB_korisnik_rod_idx` (`OIB_korisnik_rod`),
  ADD KEY `skupina_id_idx` (`skupina_id`),
  ADD KEY `javni_poziv_id_idx` (`javni_poziv_id`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`racun_id`),
  ADD KEY `OIB_korisnik_mod_idx` (`OIB_korisnik_mod`),
  ADD KEY `OIB_korisnik_rod_idx` (`OIB_korisnik_rod`),
  ADD KEY `evidencija_id_idx` (`evidencija_id`);

--
-- Indexes for table `skupina`
--
ALTER TABLE `skupina`
  ADD PRIMARY KEY (`skupina_id`),
  ADD KEY `OIB_korisnik_mod_idx` (`OIB_korisnik`);

--
-- Indexes for table `skupina_pripada`
--
ALTER TABLE `skupina_pripada`
  ADD PRIMARY KEY (`djecji_vrtic_id`,`skupina_id`),
  ADD KEY `skupina_id_idx` (`skupina_id`);

--
-- Indexes for table `tip_promjene`
--
ALTER TABLE `tip_promjene`
  ADD PRIMARY KEY (`tip_promjene_id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`iduloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `djecji_vrtic`
--
ALTER TABLE `djecji_vrtic`
  MODIFY `djecji_vrtic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `evidencija`
--
ALTER TABLE `evidencija`
  MODIFY `evidencija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  MODIFY `javni_poziv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `prijava`
--
ALTER TABLE `prijava`
  MODIFY `prijava_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `racun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `skupina`
--
ALTER TABLE `skupina`
  MODIFY `skupina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tip_promjene`
--
ALTER TABLE `tip_promjene`
  MODIFY `tip_promjene_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `iduloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dijete`
--
ALTER TABLE `dijete`
  ADD CONSTRAINT `fk_roditelj` FOREIGN KEY (`roditelj_OIB`) REFERENCES `korisnik` (`OIB_korisnik`),
  ADD CONSTRAINT `skupina_id_d` FOREIGN KEY (`skupina_id`) REFERENCES `skupina` (`skupina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dijete_prijavljeno`
--
ALTER TABLE `dijete_prijavljeno`
  ADD CONSTRAINT `OIB_dijete_dp` FOREIGN KEY (`OIB_dijete`) REFERENCES `dijete` (`OIB_dijete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prijava_id_dp` FOREIGN KEY (`prijava_id`) REFERENCES `prijava` (`prijava_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `djecji_vrtic`
--
ALTER TABLE `djecji_vrtic`
  ADD CONSTRAINT `OIB_korisnik_admin` FOREIGN KEY (`OIB_korisnik_admin`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `OIB_korisnik_mod` FOREIGN KEY (`OIB_korisnik_mod`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `OIB_korisnika` FOREIGN KEY (`OIB_korisnik`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tip_promjene_id` FOREIGN KEY (`tip_id`) REFERENCES `tip_promjene` (`tip_promjene_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evidencija`
--
ALTER TABLE `evidencija`
  ADD CONSTRAINT `OIB_korisnik_mod_ev` FOREIGN KEY (`OIB_korisnik_mod`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `djecji_vrtic_id_ev` FOREIGN KEY (`djecji_vrtic_id`) REFERENCES `djecji_vrtic` (`djecji_vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evidentirano`
--
ALTER TABLE `evidentirano`
  ADD CONSTRAINT `OIB_dijete_ev` FOREIGN KEY (`OIB_dijete`) REFERENCES `dijete` (`OIB_dijete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evidencija_id_ev` FOREIGN KEY (`evidencija_id`) REFERENCES `evidencija` (`evidencija_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  ADD CONSTRAINT `OIB_korisnik_mod_jp` FOREIGN KEY (`OIB_korisnik`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `djecji_vrtic_id_jp` FOREIGN KEY (`djecji_vrtic_id`) REFERENCES `djecji_vrtic` (`djecji_vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `uloga_id` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`iduloga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ocjena_mjesecno`
--
ALTER TABLE `ocjena_mjesecno`
  ADD CONSTRAINT `OIB_korisnik_admin_om` FOREIGN KEY (`OIB_korisnik_admin`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `djecji_vrtic_id_om` FOREIGN KEY (`djecji_vrtic_id`) REFERENCES `djecji_vrtic` (`djecji_vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `OIB_korisnik_rod_p` FOREIGN KEY (`OIB_korisnik_rod`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `javni_poziv_id_p` FOREIGN KEY (`javni_poziv_id`) REFERENCES `javni_poziv` (`javni_poziv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `skupina_id_p` FOREIGN KEY (`skupina_id`) REFERENCES `skupina` (`skupina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `OIB_korisnik_mod_ra` FOREIGN KEY (`OIB_korisnik_mod`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `OIB_korisnik_rod_ra` FOREIGN KEY (`OIB_korisnik_rod`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evidencija_id_ra` FOREIGN KEY (`evidencija_id`) REFERENCES `evidencija` (`evidencija_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skupina`
--
ALTER TABLE `skupina`
  ADD CONSTRAINT `OIB_korisnik_mod_sk` FOREIGN KEY (`OIB_korisnik`) REFERENCES `korisnik` (`OIB_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skupina_pripada`
--
ALTER TABLE `skupina_pripada`
  ADD CONSTRAINT `djecji_vrtic_id` FOREIGN KEY (`djecji_vrtic_id`) REFERENCES `djecji_vrtic` (`djecji_vrtic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `skupina_id` FOREIGN KEY (`skupina_id`) REFERENCES `skupina` (`skupina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
