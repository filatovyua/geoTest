-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.50 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных main
CREATE DATABASE IF NOT EXISTS `main` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `main`;


-- Дамп структуры для таблица main.coords
CREATE TABLE IF NOT EXISTS `coords` (
  `ind` int(11) NOT NULL AUTO_INCREMENT,
  `coordinates` point DEFAULT NULL,
  `text` char(50) DEFAULT NULL,
  PRIMARY KEY (`ind`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы main.coords: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `coords` DISABLE KEYS */;
REPLACE INTO `coords` (`ind`, `coordinates`, `text`) VALUES
	(8, _binary 0x0000000001010000006826A0151AE14B40804E081DC8CF4240, 'Это красивая метка');
/*!40000 ALTER TABLE `coords` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
