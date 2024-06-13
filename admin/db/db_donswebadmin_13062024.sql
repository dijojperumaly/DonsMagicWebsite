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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_availablesizes` (`availablesize_id`, `size_id`, `product_id`, `createdat`, `createdby`, `updatedat`, `updatedby`, `isdeleted`) VALUES
	(25, 1, 23, '2024-06-13 16:13:00', 1, NULL, NULL, 0),
	(26, 2, 23, '2024-06-13 16:13:00', 1, NULL, NULL, 0),
	(27, 2, 24, '2024-06-13 16:15:00', 1, NULL, NULL, 0),
	(28, 1, 24, '2024-06-13 16:15:00', 1, NULL, NULL, 0);

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `contact_id` int NOT NULL AUTO_INCREMENT,
  `contact` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '1',
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `isdeleted` int NOT NULL DEFAULT '0',
  `createdby` int NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedby` int NOT NULL,
  `updatedat` datetime NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_contact` (`contact_id`, `contact`, `type`, `status`, `isdeleted`, `createdby`, `createdat`, `updatedby`, `updatedat`) VALUES
	(3, '00919497326073', 'PRIMARY', 'Active', 0, 3, '2024-06-06 12:25:00', 3, '2024-06-06 12:41:00');

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
  `createdat` datetime DEFAULT NULL,
  `createdby` int DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `isdeleted` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_product` (`id`, `producttype_id`, `product_code`, `title`, `aboutproduct`, `MRP`, `offerprice`, `isfeatured`, `image_1`, `image_2`, `image_3`, `image_4`, `orderno`, `availablesizes`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
	(23, 2, 'CW152323', 'dsfg', 'sfds', 234, 324, 0, '', NULL, NULL, NULL, 43, NULL, '2024-06-13 16:13:00', 1, NULL, NULL, 'Active', 0),
	(24, 1, 'OW205824', 'ouotot', 'tiyu', 100, 40, 1, '240613161554000000204648.png', NULL, NULL, NULL, 1, NULL, '2024-06-13 16:15:00', 1, NULL, NULL, 'Active', 0);

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
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Active',
  `isdeleted` tinyint DEFAULT '0',
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tbl_size` (`size_id`, `size`, `aboutsize`, `orderno`, `createdat`, `createdby`, `updatedat`, `updatedby`, `status`, `isdeleted`) VALUES
	(1, 'S', 'Small Size', 1, '2024-06-10 15:32:00', 3, NULL, NULL, 'Active', 0),
	(2, 'M', 'Medium Size', 2, '2024-06-10 15:33:00', 3, NULL, NULL, 'Active', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
