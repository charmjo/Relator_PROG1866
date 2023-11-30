-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for assignment3
CREATE DATABASE IF NOT EXISTS `assignment3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `assignment3`;

-- Dumping structure for table assignment3.access_level
CREATE TABLE IF NOT EXISTS `access_level` (
  `access_id` int NOT NULL AUTO_INCREMENT,
  `access_level_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table assignment3.access_level: ~0 rows (approximately)

-- Dumping structure for table assignment3.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `ordered_by` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_month` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_year` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` double unsigned NOT NULL,
  `sales_tax` double unsigned NOT NULL,
  `grand_total` double unsigned NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table assignment3.orders: ~1 rows (approximately)
INSERT IGNORE INTO `orders` (`order_id`, `ordered_by`, `email`, `phone`, `postcode`, `city`, `address`, `credit_num`, `credit_month`, `credit_year`, `province`, `subtotal`, `sales_tax`, `grand_total`, `order_date`) VALUES
	(9, 'John Doe', 'john@test.com', '1231231234', 'A1B2C3', 'Waterloo', '101 redfox grove', '1234-1234-1234-1234', 'JAN', '2030', 'ON', 32.5, 4.225, 36.725, '2023-11-29 20:36:09');

-- Dumping structure for table assignment3.prod_ordered
CREATE TABLE IF NOT EXISTS `prod_ordered` (
  `product_id` int DEFAULT NULL,
  `product_name` int DEFAULT NULL,
  `unit_price` int DEFAULT NULL,
  `product_qty` int DEFAULT NULL,
  `total_price` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  KEY `FK_prod_ordered_orders` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table assignment3.prod_ordered: 0 rows
/*!40000 ALTER TABLE `prod_ordered` DISABLE KEYS */;
/*!40000 ALTER TABLE `prod_ordered` ENABLE KEYS */;

-- Dumping structure for table assignment3.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level` int NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table assignment3.user: ~2 rows (approximately)
INSERT IGNORE INTO `user` (`fname`, `lname`, `email`, `password`, `access_level`) VALUES
	('Admin1', 'Admin1', 'admin1@admin.com', '$2y$10$9ai/idDMyIYmKVYFsc5m3OTVIdUUQA6eSaKW4HW.CTsh.PCy4KHrC', 1),
	('charm', 'relator', 'charm@test.com', '$2y$10$.FH6Fy66t6VY.z9VDsVtMetWqbksJuEUC7w76s4oq8l1yTdEamR1C', 2);

-- Dumping structure for table assignment3.user_login
CREATE TABLE IF NOT EXISTS `user_login` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_logged_in` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table assignment3.user_login: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
