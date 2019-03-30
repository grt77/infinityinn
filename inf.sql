-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2019 at 03:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inf`
--

-- --------------------------------------------------------

--
-- Table structure for table `bworker`
--

CREATE TABLE `bworker` (
  `id` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `fdate` date NOT NULL,
  `tdate` date NOT NULL,
  `number` int(10) NOT NULL,
  `cphno` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fdoublebed`
--

CREATE TABLE `fdoublebed` (
  `email` varchar(25) NOT NULL,
  `fdate` date NOT NULL,
  `tdate` date NOT NULL,
  `nop` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `sharing` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fsinglebed`
--

CREATE TABLE `fsinglebed` (
  `email` varchar(25) NOT NULL,
  `fdate` date NOT NULL,
  `tdate` date NOT NULL,
  `nop` int(2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ftable`
--

CREATE TABLE `ftable` (
  `email` varchar(35) NOT NULL,
  `date` date NOT NULL,
  `time` int(2) NOT NULL,
  `event` varchar(25) NOT NULL,
  `nop` int(2) NOT NULL,
  `bdate` varchar(15) NOT NULL,
  `btime` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderfood`
--

CREATE TABLE `orderfood` (
  `email` varchar(30) NOT NULL,
  `food` varchar(500) NOT NULL,
  `totalbill` int(10) NOT NULL,
  `date` date NOT NULL,
  `worker` varchar(25) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `email` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `number` bigint(25) NOT NULL,
  `amount` bigint(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `aadhar` bigint(15) NOT NULL,
  `phno` bigint(15) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `bdate` int(4) NOT NULL,
  `wallet` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`fname`, `lname`, `email`, `pwd`, `aadhar`, `phno`, `gender`, `bdate`, `wallet`) VALUES
('anudeep', 'anudeep', 'anudeep.insvirat@gmail.com', '123', 6144, 9848517742, 'male', 1998, 0),
('teja', 'gattupalli', 'gattupalliravi1@gmail.com', '123456', 614411947541, 9848517442, 'male', 1998, 1076);

-- --------------------------------------------------------

--
-- Table structure for table `singlebed`
--

CREATE TABLE `singlebed` (
  `email` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `status` int(2) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id` varchar(4) NOT NULL,
  `email` varchar(25) NOT NULL,
  `date` varchar(25) NOT NULL,
  `time` int(15) NOT NULL,
  `cphno` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `sno` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phno` bigint(10) NOT NULL,
  `id` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`sno`, `name`, `phno`, `id`) VALUES
(1, 'Suresh', 7894561230, 'w101'),
(2, 'Naresh', 8794561230, 'w102'),
(3, 'Hafiz', 9874561230, 'w103'),
(4, 'Vignesh', 7485961230, 'w104'),
(5, 'Aadi', 7589461230, 'w105'),
(6, 'Pradeep', 756984123, 'w106'),
(7, 'Raju', 7142589630, 'w107'),
(8, 'Pavan', 724369810, 'w108'),
(9, 'Sai', 7314256980, 'w109'),
(10, 'Surya', 7612458930, 'w110');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
