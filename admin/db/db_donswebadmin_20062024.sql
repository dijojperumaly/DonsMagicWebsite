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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
	(22, 1, 4, '2024-06-20 14:14:00', 3, NULL, NULL, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_product` (`id`, `producttype_id`, `product_code`, `title`, `aboutproduct`, `MRP`, `offerprice`, `isfeatured`, `image_1`, `image_2`, `image_3`, `image_4`, `orderno`, `availablesizes`, `label`, `color`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
	(1, 2, 'CW51641', '', '', 450, 399, 0, '240620121150000000515165.jpg', NULL, NULL, NULL, 3, NULL, '', '', '2024-06-20 12:11:00', 3, '2024-06-20 14:14:00', 3, 'SoldOut', 0),
	(2, 2, 'CW25522', '', '', 450, 399, 0, '240620121318000000253903.jpg', NULL, NULL, NULL, 6, NULL, '', '', '2024-06-20 12:13:00', 3, '2024-06-20 13:04:00', 3, 'SoldOut', 0),
	(3, 2, 'CW61943', '', '', 450, 0, 1, '240620121643000000617924.jpg', NULL, NULL, NULL, 0, NULL, '', '', '2024-06-20 12:16:00', 3, '2024-06-20 14:13:00', 3, 'SoldOut', 0),
	(4, 4, 'KF22704', '', '', 450, 0, 1, '240620121900000000225830.jpg', NULL, NULL, NULL, 5, NULL, '', '', '2024-06-20 12:19:00', 3, '2024-06-20 14:14:00', 3, 'SoldOut', 0),
	(5, 2, 'CW70215', '', '', 450, 399, 0, '240620122336000000700832.jpg', NULL, NULL, NULL, 6, NULL, '', '', '2024-06-20 12:23:00', 3, '2024-06-20 13:02:00', 3, 'SoldOut', 1),
	(6, 2, 'CW19076', '', '', 450, 399, 0, '240620124053000000189148.jpg', NULL, NULL, NULL, 1, NULL, '', '', '2024-06-20 12:40:00', 3, '2024-06-20 12:57:00', 3, 'Active', 0),
	(7, 1, 'OW27807', '', '', 590, 0, 0, '240620125541000000276709.jpg', NULL, NULL, NULL, 2, NULL, '', '', '2024-06-20 12:55:00', 3, NULL, NULL, 'Active', 0),
	(8, 1, 'OW45718', '', '', 650, 0, 0, '240620125944000000455827.jpg', NULL, NULL, NULL, 4, NULL, '', '', '2024-06-20 12:59:00', 3, NULL, NULL, 'Active', 0),
	(9, 1, 'OW8819', '', '', 590, 0, 0, '24062013060200000087065.jpg', NULL, NULL, NULL, 7, NULL, '', '', '2024-06-20 13:06:00', 3, NULL, NULL, 'Active', 0),
	(10, 1, 'OW854710', '', '', 590, 0, 0, '240620130738000000853482.jpg', NULL, NULL, NULL, 0, NULL, '', '', '2024-06-20 13:07:00', 3, '2024-06-20 14:13:00', 3, 'Active', 0),
	(11, 1, 'OW653811', '', '', 590, 0, 0, '240620130826000000652532.jpg', NULL, NULL, NULL, 8, NULL, '', '', '2024-06-20 13:08:00', 3, NULL, NULL, 'Active', 0);

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
