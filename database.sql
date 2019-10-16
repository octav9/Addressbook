-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for addressbook
CREATE DATABASE IF NOT EXISTS `addressbook` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `addressbook`;

-- Dumping structure for table addressbook.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table addressbook.contacts: ~2 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `phone`, `email`, `date_added`) VALUES
	(1, 'Robert', 'Weber', '210-845-2681', 'RobertAWeber@teleworm.us', '2019-10-14 23:04:33'),
	(3, 'Jane', 'Adkins', '817-898-1912', 'JaneAAdkins@rhyta.com', '2019-10-14 23:06:06'),
	(4, 'Sabrina', 'Deese', '931-934-1924', 'SabrinaHDeese@teleworm.us', '2019-10-15 12:49:08'),
	(5, 'Jack', 'Burns', '330-719-1633', 'JackKBurns@armyspy.com', '2019-10-15 13:00:48'),
	(7, 'Michael', 'Frost', '156-842-1391', 'MichaelTFrost@rhyta.com', '2019-10-15 14:59:02'),
	(8, 'Autumn', 'Freeman', '203-821-3942', 'AutumnJFreeman@armyspy.com', '2019-10-15 15:02:03');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
