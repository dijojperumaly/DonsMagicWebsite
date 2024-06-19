-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 08:10 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_donswebadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_availablesizes`
--

CREATE TABLE `tbl_availablesizes` (
  `availablesize_id` int(11) NOT NULL,
  `size_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isdeleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_availablesizes`
--

INSERT INTO `tbl_availablesizes` (`availablesize_id`, `size_id`, `product_id`, `createdat`, `createdby`, `updatedat`, `updatedby`, `isdeleted`) VALUES
(79, 2, 27, '2024-06-16 14:45:00', 3, NULL, NULL, 0),
(80, 1, 27, '2024-06-16 14:45:00', 3, NULL, NULL, 0),
(84, 2, 23, '2024-06-17 00:01:00', 3, NULL, NULL, 0),
(85, 1, 23, '2024-06-17 00:01:00', 3, NULL, NULL, 0),
(86, 2, 26, '2024-06-17 00:21:00', 3, NULL, NULL, 0),
(87, 1, 26, '2024-06-17 00:21:00', 3, NULL, NULL, 0),
(89, 1, 24, '2024-06-17 00:23:00', 3, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `contact_id` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '1',
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `isdeleted` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_id`, `contact`, `type`, `status`, `isdeleted`, `createdby`, `createdat`, `updatedby`, `updatedat`) VALUES
(3, '00919497326073', 'PRIMARY', 'Active', 0, 3, '2024-06-06 12:25:00', 3, '2024-06-06 12:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `user_Id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`user_Id`, `username`, `password`, `role`, `status`) VALUES
(3, 'admin', '123456', '1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `producttype_id` int(11) NOT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `title` text,
  `aboutproduct` text,
  `MRP` int(11) NOT NULL,
  `offerprice` int(11) DEFAULT NULL,
  `isfeatured` smallint(6) DEFAULT '0',
  `image_1` text,
  `image_2` text,
  `image_3` text,
  `image_4` text,
  `orderno` int(11) DEFAULT '0',
  `availablesizes` varchar(300) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `isdeleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `producttype_id`, `product_code`, `title`, `aboutproduct`, `MRP`, `offerprice`, `isfeatured`, `image_1`, `image_2`, `image_3`, `image_4`, `orderno`, `availablesizes`, `label`, `color`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
(23, 2, 'CW152323', 'dsfg', 'sfds', 234, 324, 1, '240615002537000000312291.jpg', NULL, NULL, NULL, 43, NULL, '', '', '2024-06-13 16:13:00', 1, '2024-06-17 00:01:00', 3, 'Active', 0),
(24, 1, 'OW205824', '', 'tiyu', 100, 0, 1, '240615002623000000289921.jpg', NULL, NULL, NULL, 1, NULL, 'New', '', '2024-06-13 16:15:00', 1, '2024-06-17 00:23:00', 3, 'Active', 0),
(26, 3, 'MW284626', 'Trending', 'gfd', 500, 340, 1, '240615004035000000262651.jpg', NULL, NULL, NULL, 3, NULL, 'New', 'blue white', '2024-06-15 00:40:00', 3, '2024-06-17 00:21:00', 3, 'Active', 0),
(27, 4, 'KF931027', 'free styel kaftans', 'd gf sdfs sd f sf sdf \r\nsd sd sdf sdsd', 450, 399, 0, '240616144358000000908073.jpg', NULL, NULL, NULL, 1, NULL, 'New', 'coffee black', '2024-06-16 14:43:00', 3, '2024-06-16 14:45:00', 3, 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_producttype`
--

CREATE TABLE `tbl_producttype` (
  `producttype_id` int(11) NOT NULL,
  `producttype` varchar(250) DEFAULT NULL,
  `typecode` varchar(11) NOT NULL,
  `abouttype` text,
  `orderno` int(11) DEFAULT '0',
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `isdeleted` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_producttype`
--

INSERT INTO `tbl_producttype` (`producttype_id`, `producttype`, `typecode`, `abouttype`, `orderno`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
(1, 'Outdoor Wear', 'OW', NULL, 1, NULL, NULL, NULL, NULL, 'Active', 0),
(2, 'Comfort Wear', 'CW', NULL, 2, NULL, NULL, NULL, NULL, 'Active', 0),
(3, 'Maternity Wear', 'MW', NULL, 3, NULL, NULL, NULL, NULL, 'Active', 0),
(4, 'Kaftans', 'KF', NULL, 4, NULL, NULL, NULL, NULL, 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

CREATE TABLE `tbl_size` (
  `size_id` int(11) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `aboutsize` text,
  `orderno` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `isdeleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size`, `aboutsize`, `orderno`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
(1, 'S', 'Small Size', 1, '2024-06-10 15:32:00', 3, NULL, NULL, 'Active', 0),
(2, 'M', 'Medium Size', 2, '2024-06-10 15:33:00', 3, NULL, NULL, 'Active', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_availablesizes`
--
ALTER TABLE `tbl_availablesizes`
  ADD PRIMARY KEY (`availablesize_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`user_Id`) USING BTREE;

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_producttype`
--
ALTER TABLE `tbl_producttype`
  ADD PRIMARY KEY (`producttype_id`);

--
-- Indexes for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`size_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_availablesizes`
--
ALTER TABLE `tbl_availablesizes`
  MODIFY `availablesize_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_producttype`
--
ALTER TABLE `tbl_producttype`
  MODIFY `producttype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
