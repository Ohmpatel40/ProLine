-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 05:36 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proline`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `AID` varchar(255) NOT NULL,
  `Semester` varchar(255) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`AID`, `Semester`, `Content`, `Date`) VALUES
('4392', 'ALL', 'There will be an Holiday tommorow i.e 10/02/2022', '2022-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `CID` varchar(255) NOT NULL,
  `Class_Name` varchar(255) NOT NULL,
  `Division` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`CID`, `Class_Name`, `Division`) VALUES
('F3FC5D49', 'FYBCA', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `Rank` int(11) NOT NULL,
  `CID` varchar(255) NOT NULL,
  `C_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`Rank`, `CID`, `C_Name`) VALUES
(1, '2fr4', 'Bachelor in Computer Application'),
(2, '36D1', 'Bachelor in Commerce'),
(3, 'g5hd', 'Bachelor in Business Management'),
(4, 'l8wg', 'Masters in Business Management'),
(5, 'r73b', 'Masters in Computer Application');

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `BID` varchar(255) NOT NULL,
  `Book_Path` varchar(255) NOT NULL,
  `Semester` varchar(255) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`BID`, `Book_Path`, `Semester`, `Date`) VALUES
('23C2', 'ieltsfever-academic-reading-practice-test-18-pdf.pdf', 'Fifth', '2022-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `pname`, `description`, `price`, `category`) VALUES
(2, 'Vada pav', 'Vada pav', '25', 'Snack'),
(4, 'Thums Up', 'Thums Up Tin', '40', 'Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `SID` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Entry_Time` time NOT NULL,
  `Exit_Time` time NOT NULL,
  `flags` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`SID`, `Date`, `Entry_Time`, `Exit_Time`, `flags`) VALUES
('D78A3224', '2022-02-03', '08:45:00', '08:53:00', 1),
('D78A3224', '2022-02-03', '08:51:00', '08:53:00', 1),
('D78A3224', '2022-02-03', '08:52:00', '08:53:00', 1),
('D78A3224', '0000-00-00', '08:52:00', '08:53:00', 1),
('D78A3224', '0000-00-00', '08:54:00', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `RID` varchar(255) NOT NULL,
  `SID` varchar(255) NOT NULL,
  `CID` varchar(255) NOT NULL,
  `SemID` varchar(255) NOT NULL,
  `SubID` varchar(255) NOT NULL,
  `Marks` int(11) NOT NULL,
  `ExamType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`RID`, `SID`, `CID`, `SemID`, `SubID`, `Marks`, `ExamType`) VALUES
('06FE', 'D78A3224', '2fr4', 'D983', 'F4D9', 59, 'External'),
('09AC', 'D78A3224', '2fr4', 'D983', '0AC8', 63, 'External'),
('13D0', 'D78A3224', '2fr4', 'D983', '5122', 42, 'Internal'),
('21BF', 'D78A3224', '2fr4', 'D983', 'F4D9', 58, 'Internal'),
('8380', 'D78A3224', '2fr4', 'D983', 'B1B1', 53, 'Internal'),
('A3B9', 'D78A3224', '2fr4', 'D983', '0AC8', 63, 'Internal'),
('B9F9', 'D78A3224', '2fr4', 'D983', 'B1B1', 48, 'External'),
('D103', 'D78A3224', '2fr4', 'D983', '5122', 52, 'External');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `Rank` int(11) NOT NULL,
  `SID` varchar(255) NOT NULL,
  `S_Name` varchar(255) NOT NULL,
  `S_Division` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`Rank`, `SID`, `S_Name`, `S_Division`) VALUES
(1, '2E84', 'First', 'A'),
(2, '5E3C', 'Second', 'A'),
(3, '6377', 'Third', 'A'),
(4, '70D8', 'Fourth', 'A'),
(5, 'B3AB', 'Fifth', 'A'),
(6, 'D983', 'Sixth', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE `staff_details` (
  `SID` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Middle_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Phone_Number` varchar(255) NOT NULL,
  `Other_Number` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Aadhar_Number` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Blood_Group` varchar(255) NOT NULL,
  `POB` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Current_Add` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PinCode` varchar(255) NOT NULL,
  `Graduation` varchar(255) NOT NULL,
  `GMedium` varchar(255) NOT NULL,
  `GUName` varchar(255) NOT NULL,
  `GYear` int(11) NOT NULL,
  `GPercentage` int(11) NOT NULL,
  `GGrade` varchar(255) NOT NULL,
  `GRecognized` varchar(255) NOT NULL,
  `GRemark` varchar(255) NOT NULL,
  `PostGraduation` varchar(255) NOT NULL,
  `PMedium` varchar(255) NOT NULL,
  `PUName` varchar(255) NOT NULL,
  `PYear` int(11) NOT NULL,
  `PPercentage` int(11) NOT NULL,
  `PGrade` varchar(255) NOT NULL,
  `PRecognized` varchar(255) NOT NULL,
  `PRemark` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_details`
--

INSERT INTO `staff_details` (`SID`, `Photo`, `First_Name`, `Middle_Name`, `Last_Name`, `Phone_Number`, `Other_Number`, `Email`, `Aadhar_Number`, `Gender`, `DOB`, `Blood_Group`, `POB`, `Religion`, `Category`, `Current_Add`, `Country`, `State`, `City`, `PinCode`, `Graduation`, `GMedium`, `GUName`, `GYear`, `GPercentage`, `GGrade`, `GRecognized`, `GRemark`, `PostGraduation`, `PMedium`, `PUName`, `PYear`, `PPercentage`, `PGrade`, `PRecognized`, `PRemark`, `Course`) VALUES
('737F7D25', '737F7D25.jpg', 'Patel', 'Patelbhai', 'Patel', '6542310215', '6542310210', 'abcg@gmail.com', '542163214210', 'Male', '1985-01-02', 'A+', 'Kamrej', 'Hindu', 'General', ' Surat', 'India', 'Gujarat', 'Surat', '394320', 'BCA', 'English', 'VNSGU', 2000, 80, 'A', 'Yes', '', 'MCA', 'English', 'VNSGU', 2002, 85, 'A', 'Yes', '', 'Bachelor in Computer Application');

-- --------------------------------------------------------

--
-- Table structure for table `stud_details`
--

CREATE TABLE `stud_details` (
  `SID` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Middle_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Phone_Number` varchar(255) NOT NULL,
  `Guardians_Number` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Aadhar_Number` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Blood_Group` varchar(255) NOT NULL,
  `POB` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Current_Add` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PinCode` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Year` varchar(255) NOT NULL,
  `Semester` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stud_details`
--

INSERT INTO `stud_details` (`SID`, `Photo`, `First_Name`, `Middle_Name`, `Last_Name`, `Phone_Number`, `Guardians_Number`, `Email`, `Aadhar_Number`, `Gender`, `DOB`, `Blood_Group`, `POB`, `Religion`, `Category`, `Current_Add`, `Country`, `State`, `City`, `PinCode`, `Course`, `Year`, `Semester`) VALUES
('466CF5F8', '466CF5F8.jpg', 'Mihir', 'Mihirbhai', 'Patel', '6351595354', '6351595354', 'mihirpatel@gmail.com', '654216542131', 'Male', '2001-11-02', 'B+', 'Surat', 'Hindu', 'General', '   Dhatva', 'India', 'Gujarat', 'Surat', '394320', 'Bachelor in Business Management', 'Third Year', 'Sixth'),
('D78A3224', 'D78A3224.jpg', 'Shyam', 'Shyambhai', 'Patel', '6351595354', '6351595354', 'shyampatel@gmail.com', '654216542131', 'Male', '2001-11-02', 'A+', 'Kamrej', 'Hindu', 'General', 'Ena', 'India', 'Gujarat', 'Surat', '394320', 'Bachelor in Computer Application', 'Third Year', 'Sixth');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubID` varchar(255) NOT NULL,
  `Sub_Code` int(11) NOT NULL,
  `Sub_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubID`, `Sub_Code`, `Sub_Name`) VALUES
('07AA', 106, 'Practical'),
('0AC8', 603, 'Project'),
('194D', 101, 'Communication Skills'),
('1ACC', 203, 'OS-1'),
('1D74', 502, 'UNIX'),
('1DF6', 305, 'Web Designing-1'),
('2743', 102, 'Mathematics'),
('3CA0', 405, 'Mobile App Development-2'),
('4189', 303, 'Database handling using Python'),
('4D57', 404, '.Net Programming'),
('4E1C', 301, 'Statistical Methods'),
('5122', 601, 'Computer Graphics'),
('5747', 505, 'ASP.NET'),
('58E8', 503, 'Network Technologies'),
('598B', 406, 'Practical'),
('59BC', 105, 'DMA'),
('61CB', 201, 'Introduction to Internet and HTML'),
('6206', 206, 'Practical'),
('6BF7', 205, 'Concept of RDBMS'),
('6BFE', 401, 'Information System'),
('785D', 305, 'Mobile App Development-1'),
('82A4', 306, 'Practical'),
('8B39', 504, 'OS-2'),
('8DCE', 403, 'Java Programming Language'),
('9B06', 405, 'Web Designing-2'),
('AEAE', 204, 'Programming Skills'),
('B1B1', 602, 'E-Commerce and Cyber Security'),
('B37D', 304, 'OOPs and Data Structure'),
('B750', 103, 'Introduction to Computers'),
('BFDC', 402, 'IoT'),
('C5DC', 202, 'ET & IT'),
('D651', 104, 'CPPM'),
('E952', 302, 'Software Engineering'),
('EA7B', 501, 'PHP & MySQL'),
('F1B6', 506, 'Practical'),
('F4D9', 604, 'Seminar');

-- --------------------------------------------------------

--
-- Table structure for table `subject_link`
--

CREATE TABLE `subject_link` (
  `LID` varchar(255) NOT NULL,
  `SID` varchar(255) NOT NULL,
  `CID` varchar(255) NOT NULL,
  `SubID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_link`
--

INSERT INTO `subject_link` (`LID`, `SID`, `CID`, `SubID`) VALUES
('0FBE', '70D8', '2fr4', '4D57'),
('176D', '2E84', '2fr4', '59BC'),
('1B2A', '2E84', '2fr4', 'D651'),
('1DEC', '2E84', '2fr4', 'F09D'),
('2B0D', '2E84', '2fr4', 'B750'),
('2CB6', '70D8', '2fr4', 'BFDC'),
('2FDA', '70D8', '2fr4', '9B06'),
('3401', '5E3C', '2fr4', 'AEAE'),
('34A7', '5E3C', '2fr4', '6BF7'),
('402A', '6377', '2fr4', '4189'),
('4E6E', 'B3AB', '2fr4', 'F1B6'),
('5493', 'D983', '2fr4', '0AC8'),
('5857', 'D983', '2fr4', 'F4D9'),
('5905', '5E3C', '2fr4', '61CB'),
('5E3A', '5E3C', '2fr4', 'C5DC'),
('5EB2', '6377', '2fr4', 'E952'),
('6C85', '5E3C', '2fr4', '1ACC'),
('6E65', '6377', '2fr4', '4E1C'),
('73E8', 'B3AB', '2fr4', 'EA7B'),
('7E46', 'B3AB', '2fr4', '1D74'),
('8F03', 'B3AB', '2fr4', '8B39'),
('9704', '2E84', '2fr4', '2743'),
('AC26', 'B3AB', '2fr4', '58E8'),
('AC3E', '70D8', '2fr4', '6BFE'),
('B0E3', '6377', '2fr4', 'B37D'),
('B473', 'B3AB', '2fr4', '5747'),
('BDF6', '2E84', '2fr4', '194D'),
('BFDE', '5E3C', '2fr4', '6206'),
('C166', '70D8', '2fr4', '598B'),
('CB44', 'D983', '2fr4', 'B1B1'),
('D98F', '2E84', '2fr4', '07AA'),
('E158', '6377', '2fr4', '1DF6'),
('EABE', '70D8', '2fr4', '3CA0'),
('EC44', '6377', '2fr4', '82A4'),
('EFDF', 'D983', '2fr4', '5122');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `SID` varchar(255) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Last_Update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`SID`, `Amount`, `Last_Update`) VALUES
('D78A3224', 390, '2022-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction`
--

CREATE TABLE `wallet_transaction` (
  `Rank` int(11) NOT NULL,
  `TID` varchar(255) NOT NULL,
  `SID` varchar(255) NOT NULL,
  `Particular` varchar(255) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_transaction`
--

INSERT INTO `wallet_transaction` (`Rank`, `TID`, `SID`, `Particular`, `Amount`, `Type`, `Date`, `Time`) VALUES
(1, '03ED49', 'D78A3224', 'Money added to Wallet', 100, 'Credit', '2022-02-08', '01:48 PM'),
(2, '3D4911', 'D78A3224', 'Money added to Wallet', 100, 'Credit', '2022-02-19', '10:36 AM'),
(10, '4873B3', 'D78A3224', 'Paid to Canteen', 90, 'Debit', '2022-03-23', '09:58 AM'),
(9, '51B13B', 'D78A3224', 'Paid to Canteen', 40, 'Debit', '2022-03-23', '12:06 AM'),
(8, '600C13', 'D78A3224', 'Paid to Canteen', 250, 'Debit', '2022-03-23', '12:05 AM'),
(3, '8CC2F2', 'D78A3224', 'Money added to Wallet', 100, 'Credit', '2022-02-08', '01:49 PM'),
(4, '9978B2', 'D78A3224', 'Money added to Wallet', 500, 'Credit', '2022-02-08', '09:01 AM'),
(5, '9978B9', 'D78A3224', 'Paid to Canteen', 100, 'Debit', '2022-02-08', '09:44 AM'),
(6, 'AB7B05', 'D78A3224', 'Money added to Wallet', 100, 'Credit', '2022-02-14', '08:59 PM'),
(7, 'F40AF5', 'D78A3224', 'Paid to Canteen', 130, 'Debit', '2022-03-22', '11:22 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CID`),
  ADD UNIQUE KEY `CID` (`Rank`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`BID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`SID`),
  ADD UNIQUE KEY `SID` (`Rank`);

--
-- Indexes for table `stud_details`
--
ALTER TABLE `stud_details`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SubID`);

--
-- Indexes for table `subject_link`
--
ALTER TABLE `subject_link`
  ADD PRIMARY KEY (`LID`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  ADD PRIMARY KEY (`TID`),
  ADD UNIQUE KEY `TID` (`Rank`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `Rank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `Rank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  MODIFY `Rank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
