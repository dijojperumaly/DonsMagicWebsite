/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `db_donswebadmin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_donswebadmin`;

CREATE TABLE IF NOT EXISTS `tbl_availablesizes` (
  `availablesize_id` int NOT NULL AUTO_INCREMENT,
  `size_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `createdby` int DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `isdeleted` tinyint DEFAULT '0',
  PRIMARY KEY (`availablesize_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_availablesizes` (`availablesize_id`, `size_id`, `product_id`, `createdat`, `createdby`, `updatedat`, `updatedby`, `isdeleted`) VALUES
	(8, 2, 7, '2024-06-20 12:55:00', 3, NULL, NULL, 0),
	(10, 1, 6, '2024-06-20 12:57:00', 3, NULL, NULL, 0),
	(11, 3, 8, '2024-06-20 12:59:00', 3, NULL, NULL, 0),
	(13, NULL, 5, '2024-06-20 13:02:00', 3, NULL, NULL, 0),
	(15, 1, 2, '2024-06-20 13:04:00', 3, NULL, NULL, 0),
	(16, 4, 9, '2024-06-20 13:06:00', 3, NULL, NULL, 0),
	(18, 4, 11, '2024-06-20 13:08:00', 3, NULL, NULL, 0),
	(19, 1, 10, '2024-06-20 14:13:00', 3, NULL, NULL, 0),
	(20, 1, 3, '2024-06-20 14:13:00', 3, NULL, NULL, 0),
	(21, 1, 1, '2024-06-20 14:14:00', 3, NULL, NULL, 0),
	(22, 1, 4, '2024-06-20 14:14:00', 3, NULL, NULL, 0),
	(23, 4, 12, '2024-07-11 10:16:00', 3, NULL, NULL, 0),
	(24, 3, 13, '2024-07-11 10:17:00', 3, NULL, NULL, 0),
	(25, NULL, 14, '2024-07-11 11:49:00', 3, NULL, NULL, 0),
	(26, NULL, 15, '2024-07-11 11:49:00', 3, NULL, NULL, 0),
	(27, NULL, 16, '2024-07-11 11:49:00', 3, NULL, NULL, 0),
	(28, NULL, 17, '2024-07-11 11:50:00', 3, NULL, NULL, 0),
	(29, NULL, 18, '2024-07-11 11:50:00', 3, NULL, NULL, 0),
	(30, NULL, 19, '2024-07-11 11:51:00', 3, NULL, NULL, 0),
	(31, NULL, 20, '2024-07-11 16:28:00', 3, NULL, NULL, 0),
	(32, NULL, 21, '2024-07-11 16:29:00', 3, NULL, NULL, 0),
	(33, NULL, 22, '2024-07-11 16:29:00', 3, NULL, NULL, 0),
	(34, NULL, 23, '2024-07-11 16:31:00', 3, NULL, NULL, 0),
	(35, NULL, 24, '2024-07-11 16:31:00', 3, NULL, NULL, 0),
	(36, NULL, 25, '2024-07-11 16:34:00', 3, NULL, NULL, 0),
	(37, NULL, 26, '2024-07-11 16:34:00', 3, NULL, NULL, 0),
	(38, NULL, 27, '2024-07-11 16:35:00', 3, NULL, NULL, 0),
	(39, NULL, 28, '2024-07-11 16:35:00', 3, NULL, NULL, 0),
	(40, NULL, 29, '2024-07-11 16:36:00', 3, NULL, NULL, 0),
	(41, NULL, 30, '2024-07-11 16:36:00', 3, NULL, NULL, 0),
	(42, NULL, 31, '2024-07-11 16:37:00', 3, NULL, NULL, 0),
	(43, NULL, 32, '2024-07-11 16:37:00', 3, NULL, NULL, 0),
	(44, NULL, 33, '2024-07-11 16:37:00', 3, NULL, NULL, 0),
	(45, NULL, 34, '2024-07-12 13:08:00', 3, NULL, NULL, 0),
	(46, NULL, 35, '2024-07-12 13:09:00', 3, NULL, NULL, 0),
	(47, NULL, 36, '2024-07-12 13:09:00', 3, NULL, NULL, 0),
	(48, NULL, 37, '2024-07-12 13:10:00', 3, NULL, NULL, 0),
	(49, NULL, 38, '2024-07-12 13:15:00', 3, NULL, NULL, 0),
	(50, NULL, 39, '2024-07-12 13:16:00', 3, NULL, NULL, 0),
	(51, NULL, 40, '2024-07-12 13:16:00', 3, NULL, NULL, 0),
	(52, NULL, 41, '2024-07-12 13:17:00', 3, NULL, NULL, 0),
	(55, NULL, 43, '2024-07-17 14:10:00', 3, NULL, NULL, 0),
	(56, NULL, 42, '2024-07-18 15:32:00', 3, NULL, NULL, 0);

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `contact_id` int NOT NULL AUTO_INCREMENT,
  `contact` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1',
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Active',
  `isdeleted` int DEFAULT '0',
  `createdby` int DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_contact` (`contact_id`, `contact`, `type`, `status`, `isdeleted`, `createdby`, `createdat`, `updatedby`, `updatedat`) VALUES
	(1, '00919744187391', 'PRIMARY', 'Active', 0, 3, '2024-06-20 11:40:00', 3, '2024-06-20 11:41:00');

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `user_Id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_login` (`user_Id`, `username`, `password`, `role`, `status`) VALUES
	(3, 'admin', '123456', '1', 'Active');

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `producttype_id` int NOT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `title` text,
  `aboutproduct` text,
  `MRP` int NOT NULL,
  `offerprice` int DEFAULT NULL,
  `isfeatured` smallint DEFAULT '0',
  `image_1` text,
  `image_2` text,
  `image_3` text,
  `image_4` text,
  `orderno` int DEFAULT '0',
  `availablesizes` varchar(300) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `createdby` int DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `isdeleted` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_product` (`id`, `producttype_id`, `product_code`, `title`, `aboutproduct`, `MRP`, `offerprice`, `isfeatured`, `image_1`, `image_2`, `image_3`, `image_4`, `orderno`, `availablesizes`, `label`, `color`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
	(39, 1, 'OW440439', '', '', 34, 0, 0, '240712131608000000439220.jpg', NULL, NULL, NULL, 0, NULL, '', '', '2024-07-12 13:16:00', 3, NULL, NULL, 'Active', 0),
	(40, 2, 'CW359640', '', '', 45, 0, 0, '240712131623000000358597.jpg', NULL, NULL, NULL, 0, NULL, '', '', '2024-07-12 13:16:00', 3, '2024-07-12 13:56:00', 3, 'Active', 0),
	(41, 3, 'MW971341', '', '', 34, 0, 0, '240712131704000000970138.jpg', NULL, NULL, NULL, 0, NULL, '', '', '2024-07-12 13:17:00', 3, NULL, NULL, 'Active', 0),
	(42, 4, 'KF986742', '', '', 34, 0, 0, '240712131752000000985659.jpg', '2407181532140000005553960.jpg', '2407181532140000005559331.jpg', '', 0, NULL, '', '', '2024-07-12 13:17:00', 3, '2024-07-18 15:32:00', 3, 'Active', 0),
	(43, 1, 'OW124143', '', '', 23, 0, 0, '2407171410390000005254760.jpg', '2407171410390000005349571.jpg', '', '', 0, NULL, '', '', '2024-07-12 16:09:00', 3, '2024-07-17 14:10:00', 3, 'Active', 0);

CREATE TABLE IF NOT EXISTS `tbl_producttype` (
  `producttype_id` int NOT NULL AUTO_INCREMENT,
  `producttype` varchar(250) DEFAULT NULL,
  `typecode` varchar(11) NOT NULL,
  `abouttype` text,
  `orderno` int DEFAULT '0',
  `createdat` datetime DEFAULT NULL,
  `createdby` int DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `isdeleted` smallint DEFAULT '0',
  PRIMARY KEY (`producttype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_producttype` (`producttype_id`, `producttype`, `typecode`, `abouttype`, `orderno`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
	(1, 'Outdoor Wear', 'OW', NULL, 1, NULL, NULL, NULL, NULL, 'Active', 0),
	(2, 'Comfort Wear', 'CW', NULL, 2, NULL, NULL, NULL, NULL, 'Active', 0),
	(3, 'Maternity Wear', 'MW', NULL, 3, NULL, NULL, NULL, NULL, 'Active', 0),
	(4, 'Kaftans', 'KF', NULL, 4, NULL, NULL, NULL, NULL, 'Active', 0);

CREATE TABLE IF NOT EXISTS `tbl_size` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size` varchar(50) DEFAULT NULL,
  `aboutsize` text,
  `orderno` int DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `createdby` int DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `isdeleted` tinyint DEFAULT '0',
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_size` (`size_id`, `size`, `aboutsize`, `orderno`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
	(1, 'Free Size', '', 0, '2024-06-20 12:08:00', 3, NULL, NULL, 'Active', 0),
	(2, 'S', '', 0, '2024-06-20 12:45:00', 3, NULL, NULL, 'Active', 0),
	(3, 'M', '', 0, '2024-06-20 12:45:00', 3, NULL, NULL, 'Active', 0),
	(4, 'L', '', 0, '2024-06-20 12:45:00', 3, NULL, NULL, 'Active', 0);

CREATE TABLE IF NOT EXISTS `tbl_useraccount` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Active',
  `isdeleted` int DEFAULT '0',
  `createdby` int DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_useraccount` (`userid`, `name`, `phone`, `email`, `password`, `status`, `isdeleted`, `createdby`, `createdat`, `updatedby`, `updatedat`) VALUES
	(1, 'manoj', '9497562467', 'manojf@vjcet.org', '123456', 'Active', 0, NULL, '2024-07-27 16:03:00', NULL, NULL),
	(2, 'manoj', '9497562467', 'manojf@vjcet.org', '123456', 'Active', 0, NULL, '2024-07-27 16:03:00', NULL, NULL),
	(3, 'asds', '6546545642', 'mmm@gmail.com', '123455', 'Active', 0, NULL, '2024-07-27 16:05:00', NULL, NULL),
	(4, 'dijo', '9788452234', 'dijo@vjcet.org', '123456', 'Active', 0, NULL, '2024-07-27 16:08:00', NULL, NULL),
	(5, 'justin', '9887542532', 'justin@gmail.com', '123456', 'Active', 0, NULL, '2024-07-27 16:12:00', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
