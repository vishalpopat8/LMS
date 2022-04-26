-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 07:11 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first`, `last`, `username`, `password`, `email`, `contact`, `pic`, `status`) VALUES
(1, 'vishal', 'popat', 'vishalpopat8', 'v123', 'vishalpopat8@gmail.com', '9978132688', 'IMG_2626.JPG', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `authors` varchar(100) NOT NULL,
  `edition` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `name`, `authors`, `edition`, `status`, `quantity`, `department`) VALUES
(1, 'Handbook of Satisfiability', 'Armin Biere, M. Heule', '1st', 'Available', 15, 'Guide'),
(3, 'City of Thieves', 'David Benioff', '18th', 'Available', 13, 'Historical fiction'),
(4, 'The Mountain of the Moon', 'Bibhūtibhūshaṇa Bandyopādhyāẏa', '1st', 'Available', 20, 'Action and adventure'),
(5, 'Angels & Demons', 'Dan Brown', '3rd', 'Available', 10, 'Suspense');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `comment`) VALUES
(1, 'ADMIN', 'Hello'),
(2, 'cp1', 'hello'),
(3, '', 'hhy7'),
(4, 'ADMIN', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `history_issue`
--

CREATE TABLE `history_issue` (
  `username` varchar(100) NOT NULL,
  `enrol` varchar(100) NOT NULL,
  `bid` int(100) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `authors` varchar(100) NOT NULL,
  `edition` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_issue`
--

INSERT INTO `history_issue` (`username`, `enrol`, `bid`, `bname`, `authors`, `edition`, `issue`) VALUES
('cp1', 'c101', 1, 'Handbook of Satisfiability', 'Armin Biere, M. Heule', '1st', '2021-06-13'),
('cp1', 'c101', 2, 'Witches Steeped in Gold', 'Ciannon Smart', '7th', '2021-06-13'),
('cp1', 'c101', 1, 'Handbook of Satisfiability', 'Armin Biere, M. Heule', '1st', '2021-06-18'),
('cp1', 'c101', 1, 'Handbook of Satisfiability', 'Armin Biere, M. Heule', '1st', '2021-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `history_return`
--

CREATE TABLE `history_return` (
  `username` varchar(100) NOT NULL,
  `enrol` varchar(100) NOT NULL,
  `bid` int(100) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `authors` varchar(100) NOT NULL,
  `edition` varchar(100) NOT NULL,
  `return` varchar(100) NOT NULL,
  `fine_paid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_return`
--

INSERT INTO `history_return` (`username`, `enrol`, `bid`, `bname`, `authors`, `edition`, `return`, `fine_paid`) VALUES
('cp1', 'c101', 2, 'Witches Steeped in Gold', 'Ciannon Smart', '7th', '2021-06-13', '-'),
('cp1', 'c101', 1, 'Handbook of Satisfiability', 'Armin Biere, M. Heule', '1st', '2021-06-13', '-'),
('cp1', 'c101', 1, 'Handbook of Satisfiability', 'Armin Biere, M. Heule', '1st', '2021-06-19', '-'),
('cp1', 'c101', 1, 'Handbook of Satisfiability', 'Armin Biere, M. Heule', '1st', '2021-06-20', '-');

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

CREATE TABLE `issue_book` (
  `username` varchar(100) NOT NULL,
  `bid` int(100) NOT NULL,
  `approve` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `return` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`username`, `bid`, `approve`, `issue`, `return`) VALUES
('cp1', 1, 'PENDING', '--', '--'),
('cp1', 3, 'PENDING', '--', '--'),
('cp1', 4, 'PENDING', '--', '--');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `username`, `message`, `status`, `sender`) VALUES
(1, 'cp1', 'hi there', 'YES', 'STUDENT'),
(2, 'cp1', 'yes how can i help u?', 'YES', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `username` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `enrol` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`fname`, `lname`, `username`, `password`, `enrol`, `email`, `phone`, `pic`) VALUES
('chintan', 'popat', 'cp1', 'cp123', 'c101', 'chintan.cp54@gmail.com', '9429124647', 'user.jpg'),
('Vishal', 'Popat', 'v1', 'v123', 'v101', 'vishalpopat7@gmail.com', '9978132688', 'user.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
