-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for blunder_car
CREATE DATABASE IF NOT EXISTS `blunder_car` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `blunder_car`;

-- Dumping structure for table blunder_car.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `IDClient` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Phone_number` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Country` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Postal_code` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `City` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDClient`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.clients: ~2 rows (approximately)
INSERT INTO `clients` (`IDClient`, `Name`, `Email`, `Phone_number`, `Country`, `Address`, `Postal_code`, `City`) VALUES
	(1, 'Tobi', 'tobi258@blunder.com', '+420 774 555 555', 'Czechia', 'Blunder Adresa 14', '18744', 'Prague'),
	(2, 'Frog', 'frog258@blunder.com', '+420 771 222 222', 'Estonia', 'The Pond 123', '15500', 'FrogLand');

-- Dumping structure for table blunder_car.client_login
CREATE TABLE IF NOT EXISTS `client_login` (
  `IDClientlogin` int(11) NOT NULL AUTO_INCREMENT,
  `ClientID` int(11) NOT NULL,
  `Password` char(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDClientlogin`),
  KEY `ClientID` (`ClientID`),
  CONSTRAINT `FK_client_login_clients` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`IDClient`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.client_login: ~0 rows (approximately)
INSERT INTO `client_login` (`IDClientlogin`, `ClientID`, `Password`) VALUES
	(1, 1, 'bobi');

-- Dumping structure for table blunder_car.gear_type
CREATE TABLE IF NOT EXISTS `gear_type` (
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.gear_type: ~2 rows (approximately)
INSERT INTO `gear_type` (`type`) VALUES
	('Automatic'),
	('Manual');

-- Dumping structure for table blunder_car.items
CREATE TABLE IF NOT EXISTS `items` (
  `IDItem` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDItem`),
  KEY `FK_items_item_type` (`item_type`),
  KEY `FK_items_vehicles` (`vehicle_id`),
  CONSTRAINT `FK_items_item_type` FOREIGN KEY (`item_type`) REFERENCES `item_type` (`Type`) ON UPDATE CASCADE,
  CONSTRAINT `FK_items_vehicles` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`IDVehicles`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.items: ~5 rows (approximately)
INSERT INTO `items` (`IDItem`, `name`, `description`, `item_type`, `price`, `in_stock`, `stock_quantity`, `vehicle_id`) VALUES
	(1, 'Performance Machine Supra Real Wheel', 'Wheel xd', 'Parts', 250, 1, 2, NULL),
	(2, 'SXT Car Heater MS092101 12V 2KW ', 'Independent car heater - 12 V, 2000 W, diesel combustion circuit, built-in fan, 27A battery required', 'Accessory', 34000, 1, 10, NULL),
	(3, 'Hello Kitty Air Freshener', 'A Hello Kitty car air freshener is a small, decorative item designed to hang from the rearview mirro', 'Accessory', 3, 1, 54, NULL),
	(4, 'PHILIPS H7/H1 replacement set 12V', 'Philips car bulb set, range covers 90% of the fleet, bulbs H7, H1, P21W, PY21W, W5W, Fest. T10.5x43,', 'Parts', 25, 1, 5, NULL),
	(5, 'Karoq', 'The Skoda Karoq is a compact SUV that offers a stylish and practical solution for drivers who requir', 'Vehicle', 34000, 1, 2, 1);

-- Dumping structure for table blunder_car.item_type
CREATE TABLE IF NOT EXISTS `item_type` (
  `Type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.item_type: ~3 rows (approximately)
INSERT INTO `item_type` (`Type`) VALUES
	('Accessory'),
	('Parts'),
	('Vehicle');

-- Dumping structure for table blunder_car.newsletter
CREATE TABLE IF NOT EXISTS `newsletter` (
  `IDNewsletter` int(11) NOT NULL AUTO_INCREMENT,
  `Email` char(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDNewsletter`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.newsletter: ~2 rows (approximately)
INSERT INTO `newsletter` (`IDNewsletter`, `Email`) VALUES
	(1, 'andorelouise@gmail.com'),
	(2, 'tobi258@post.cz');

-- Dumping structure for table blunder_car.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `Role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.roles: ~4 rows (approximately)
INSERT INTO `roles` (`Role`) VALUES
	('Administrator'),
	('Manager'),
	('Seller'),
	('Technician');

-- Dumping structure for table blunder_car.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `IDSales` int(11) NOT NULL AUTO_INCREMENT,
  `ClientID` int(11) NOT NULL,
  `ItemID` int(11) DEFAULT NULL,
  `Total_price` float NOT NULL,
  `Sale_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `EmployeeID` int(11) DEFAULT NULL,
  `More_information` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IDSales`),
  KEY `FKItemID` (`ItemID`),
  KEY `FKEmployeeID` (`EmployeeID`),
  KEY `FKClientID` (`ClientID`),
  CONSTRAINT `FKEmployeeID` FOREIGN KEY (`EmployeeID`) REFERENCES `users` (`IDUsers`) ON UPDATE CASCADE,
  CONSTRAINT `FKItemID` FOREIGN KEY (`ItemID`) REFERENCES `items` (`IDItem`) ON UPDATE CASCADE,
  CONSTRAINT `FK_sales_clients` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`IDClient`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.sales: ~3 rows (approximately)
INSERT INTO `sales` (`IDSales`, `ClientID`, `ItemID`, `Total_price`, `Sale_date`, `EmployeeID`, `More_information`) VALUES
	(1, 1, 1, 500, '2023-03-18 16:01:19', 1, 'First Sale ever wiooooho'),
	(2, 1, 3, 1275, '2023-04-11 16:08:22', 1, NULL),
	(3, 1, 4, 33, '2023-02-11 18:28:15', 1, NULL);

-- Dumping structure for table blunder_car.users
CREATE TABLE IF NOT EXISTS `users` (
  `IDUsers` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDUsers`),
  KEY `Role` (`Role`),
  CONSTRAINT `FK_users_roles` FOREIGN KEY (`Role`) REFERENCES `roles` (`Role`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.users: ~0 rows (approximately)
INSERT INTO `users` (`IDUsers`, `Name`, `Email`, `Password`, `Role`) VALUES
	(1, 'Phelps', 'tatemae@gmail.ru', 'nhlx', 'Manager');

-- Dumping structure for table blunder_car.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `IDVehicles` int(11) NOT NULL AUTO_INCREMENT,
  `Model` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Brand` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Vehicle_condition` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Vehicle_max_speed` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Weight` float NOT NULL,
  `Constumption` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Gear_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Fuel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Ready_to_ship` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`IDVehicles`),
  KEY `FK_vehicles_gear_type` (`Gear_type`),
  CONSTRAINT `FK_vehicles_gear_type` FOREIGN KEY (`Gear_type`) REFERENCES `gear_type` (`type`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blunder_car.vehicles: ~3 rows (approximately)
INSERT INTO `vehicles` (`IDVehicles`, `Model`, `Brand`, `Vehicle_condition`, `Vehicle_max_speed`, `Weight`, `Constumption`, `Gear_type`, `Fuel`, `Ready_to_ship`) VALUES
	(1, 'Karoq', 'Skoda', 'New', '300km/h', 1250, '7L/100km', 'Automatic', 'Gasoline', 0),
	(2, 'Fabia', 'Skoda', 'Used', '250km/h', 1000, '5,5L/115km', 'Manual', 'Gasoline', 1),
	(3, 'Jumper', 'Citroen', 'New', '200km/h', 2500, '8,5L/100km', 'Manual', 'Diesel', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
