-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 04:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '0e7517141fb53f21ee439b355b5a1d0a', '2021-05-06 06:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `BookingNumber`, `userEmail`, `VehicleId`, `FromDate`, `ToDate`, `message`, `Status`, `PostingDate`, `LastUpdationDate`) VALUES
(3, 743851938, 'gasteprathamesh@gmail.com', 2, '2021-05-07', '2021-05-09', NULL, 0, '2021-05-06 06:55:46', NULL),
(4, 808029617, 'gasteprathamesh@gmail.com', 2, '2021-05-06', '2021-05-06', NULL, 0, '2021-05-06 06:57:00', NULL),
(5, 265210683, 'prathameshgaste@gmail.com', 2, '2021-05-13', '2021-05-14', NULL, 1, '2021-05-08 07:43:54', '2021-05-08 07:51:50'),
(6, 562419752, 'prathameshgaste@gmail.com', 2, '2021-06-01', '2021-06-02', NULL, 1, '2021-05-09 08:55:04', '2021-05-09 10:32:49'),
(7, 828370967, 'prathameshgaste@gmail.com', 2, '2021-07-01', '2021-07-01', NULL, 1, '2021-05-09 09:02:08', '2021-05-09 10:33:14'),
(8, 257336522, 'rohanghatage@gmail.com', 9, '2021-05-18', '2021-05-19', NULL, 1, '2021-05-09 10:42:53', '2021-05-09 10:43:26'),
(9, 485967427, 'prathameshgaste@gmail.com', 2, '2021-05-18', '2021-05-19', NULL, 1, '2021-05-16 14:17:05', '2021-05-16 15:08:27'),
(10, 868083068, 'prathameshgaste@gmail.com', 2, '2021-05-23', '2021-05-24', NULL, 1, '2021-05-23 14:34:14', '2021-05-23 14:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrands`
--

CREATE TABLE `tblbrands` (
  `id` int(11) NOT NULL,
  `BrandName` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbrands`
--

INSERT INTO `tblbrands` (`id`, `BrandName`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Mercedes', '2017-06-18 16:24:34', '2021-05-06 06:47:50'),
(2, 'BMW', '2017-06-18 16:24:50', NULL),
(3, 'Audi', '2017-06-18 16:25:03', NULL),
(4, 'Hyundai', '2017-06-18 16:25:13', NULL),
(5, 'Maruti Suzuki', '2017-06-18 16:25:24', NULL),
(7, 'Volkswagon', '2017-06-19 06:22:13', '2020-07-07 14:14:09'),
(8, 'Honda', '2021-05-09 10:50:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'Abhi Bhagat', 'abhibhagat@gmail.com', '9999999999', 'I want to know your brach in Ichalkaranji..', '2020-07-07 09:34:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `gender` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `gender`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`) VALUES
(1, 'Prathamesh Gaste', 'Male', 'prathameshgaste@gmail.com', 'f91e15dbec69fc40f81f0876e7009648', '9876543210', '02/12/2000', 'Sangli'),
(2, 'Rohan Ghatage', NULL, 'rohanghatage@gmail.com', 'f91e15dbec69fc40f81f0876e7009648', '9876543210', NULL, NULL),
(3, 'Abhishek Bhagat', NULL, 'abhibhagat@gmail.com', 'f91e15dbec69fc40f81f0876e7009648', '9876543210', NULL, NULL),
(4, 'Shreyas Ghodake', NULL, 'ahreyasghodake@gmail.com', 'f91e15dbec69fc40f81f0876e7009648', '9876543210', NULL, NULL),
(5, 'Omkar Gurav', NULL, 'omgurav@gmail.com', 'f91e15dbec69fc40f81f0876e7009648', '9876543210', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicles`
--

CREATE TABLE `tblvehicles` (
  `id` int(11) NOT NULL,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext DEFAULT NULL,
  `PricePerDay` int(11) DEFAULT NULL,
  `FuelType` varchar(100) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvehicles`
--

INSERT INTO `tblvehicles` (`id`, `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `RegDate`, `UpdationDate`) VALUES
(2, 'BMW 5 Series', 2, 'BMW 5 Series price starts at ? 55.4 Lakh and goes upto ? 68.39 Lakh. The price of Petrol version for 5 Series ranges between ? 55.4 Lakh - ? 60.89 Lakh and the price of Diesel version for 5 Series ranges between ? 60.89 Lakh - ? 68.39 Lakh.', 1000, 'Petrol', 2018, 5, 'BMW-5-Series-Exterior-102005.jpg', 'BMW-5-Series-New-Exterior-89729.jpg', 'BMW-5-Series-Exterior-102006.jpg', 'BMW-5-Series-Interior-102021.jpg', 'BMW-5-Series-Interior-102022.jpg', '2020-07-07 07:12:02', '2020-07-07 07:27:44'),
(9, 'Ertiga', 5, ' Maruti Suzuki Ertiga comes with 1462cc Petrol and 1462cc CNG engines. Petrol engine provides a mileage of 19.34 Km/L and produces 103 bhp power, CNG engine provides a mileage of 26.2 Km/Kg and produces 103 bhp power. Maruti Suzuki Ertiga provides Manual and Automatic transmission.', 1100, 'Petrol', NULL, 7, '1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '2021-05-09 10:32:11', NULL),
(10, 'Creta', 4, 'For select trims, the Creta is equipped including Vehicle Stability Management (VSM), Electronic Stability Control (ESC), Hillstart Assist Control (HAC), Rear Parking Assist System, and ABS. The six airbag system provides all round protection. One for the driver, one for the front seat passenger, front and rear curtain airbags running the length of the cabin, plus front side airbags. Hyundai also claimed the vehicle is built with HIVE body structure, which signifies structural strength.', 1200, 'Petrol', NULL, 5, 'creta-exterior-right-side-view.jpeg', 'creta-exterior-front-view.jpeg', 'creta-exterior-left-rear-three-quarter.jpeg', 'creta-interior-bootspace.jpeg', 'creta-interior-dashboard.jpeg', '2021-05-09 10:48:13', NULL),
(11, 'City', 8, 'The sixth-generation City was unveiled in India on 25 November 2013 and is available with a choice of two engines; a new 1.5-litre Earth Dreams i-DTEC turbodiesel and a refined version of the 1.5-litre i-VTEC petrol. The new 1.5-litre turbodiesel engine, which also powers the Honda Amaze.', 800, 'Diesel', NULL, 5, 'h1.jpg', 'h2.jpg', 'h3.jpg', 'h4.jpg', 'h5.jpg', '2021-05-09 10:50:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbrands`
--
ALTER TABLE `tblbrands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Indexes for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblbrands`
--
ALTER TABLE `tblbrands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
