-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 06:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `pass`) VALUES
(3, 'sam@email.com', 'ef302021');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `bookpic` varchar(25) NOT NULL,
  `bookname` varchar(25) NOT NULL,
  `bookdetail` varchar(110) NOT NULL,
  `bookaudor` varchar(25) NOT NULL,
  `bookpub` varchar(25) NOT NULL,
  `branch` varchar(110) NOT NULL,
  `bookprice` varchar(25) NOT NULL,
  `bookquantity` varchar(25) NOT NULL,
  `bookava` int(11) NOT NULL,
  `bookrent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `bookpic`, `bookname`, `bookdetail`, `bookaudor`, `bookpub`, `branch`, `bookprice`, `bookquantity`, `bookava`, `bookrent`) VALUES
(4, 'arrow.jpg', 'David Copperfields', '1st edition', 'Charles Dickens', 'Penguin', 'history', '800', '12', 8, 4),
(5, 'logo.png', 'Hamlet', '1st edition', 'Shakespeare', 'Dover', 'Drama', '1000', '15', 12, 3),
(6, 'arrow.png', 'Sun also Rises', '1st edition', 'Hemingway', 'Scribner', 'history', '900', '12', 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `issuename` varchar(25) NOT NULL,
  `issuebook` varchar(25) NOT NULL,
  `issuetype` varchar(25) NOT NULL,
  `issuedays` int(11) NOT NULL,
  `issuedate` varchar(25) NOT NULL,
  `issuereturn` varchar(25) NOT NULL,
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuebook`
--

INSERT INTO `issuebook` (`id`, `userid`, `issuename`, `issuebook`, `issuetype`, `issuedays`, `issuedate`, `issuereturn`, `fine`) VALUES
(2, 1, 'Ali', 'Hamlet', 'student', 3, '30/03/2021', '02/04/2021', 1800),
(3, 2, 'Sara', 'Sun also Rises', 'teacher', 4, '30/03/2021', '03/04/2021', 0),
(6, 1, 'Ali', 'David Copperfields', 'student', 7, '30/03/2021', '06/04/2021', 1800),
(9, 5, 'Noah', 'Hamlet', 'student', 21, '30/03/2021', '20/04/2021', 0),
(10, 1, 'Ali', 'Sun also Rises', 'student', 7, '01/04/2021', '08/04/2021', 0),
(11, 1, 'Ali', 'harry', 'student', 7, '01/04/2021', '08/04/2021', 0),
(12, 1, 'Ali', 'Scott Gallagher', 'student', 6, '16/07/2023', '22/07/2023', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requestbook`
--

CREATE TABLE `requestbook` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `usertype` varchar(25) NOT NULL,
  `bookname` varchar(25) NOT NULL,
  `issuedays` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `email`, `pass`, `type`) VALUES
(1, 'Ali', 'idno22382@gmail.com', '123', 'student'),
(2, 'Sara', 'voqo@mailinator.com', 'Ratione nulla dolore', 'teacher'),
(3, 'Sam', 'sam@email.com', 'ef302021', 'teacher'),
(5, 'Noah', 'noah@email.com', 'gh402021', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_fk` (`userid`);

--
-- Indexes for table `requestbook`
--
ALTER TABLE `requestbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_fk_book` (`bookid`),
  ADD KEY `pk_fk_users` (`userid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requestbook`
--
ALTER TABLE `requestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD CONSTRAINT `pk_fk` FOREIGN KEY (`userid`) REFERENCES `userdata` (`id`);

--
-- Constraints for table `requestbook`
--
ALTER TABLE `requestbook`
  ADD CONSTRAINT `pk_fk_users` FOREIGN KEY (`userid`) REFERENCES `userdata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
