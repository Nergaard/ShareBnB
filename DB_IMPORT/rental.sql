SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ShareBNB`
--

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

DROP TABLE IF EXISTS `rental`;
CREATE TABLE IF NOT EXISTS `rental` (
  `rental_ID` int(11) NOT NULL AUTO_INCREMENT,
  `rental_time_from` DATETIME NOT NULL,
  `rental_time_to` DATETIME NOT NULL,
  `rental_rented_by` int(11) NOT NULL,
  `rental_residence_ID` int(11) NOT NULL,
  `rental_approved_by` int(11) NULL DEFAULT NULL,
  `rental_approved_by_user` int(11) NULL DEFAULT NULL,
  `rental_admin_ID` int(11) NOT NULL,
  `rental_contract` varchar(255) NULL DEFAULT NULL,


  PRIMARY KEY (`rental_ID`),
  FOREIGN KEY (`rental_residence_ID`) REFERENCES residence (`residence_ID`),
  FOREIGN KEY (`rental_rented_by`) REFERENCES user (`user_ID`),
  FOREIGN KEY (`rental_approved_by`) REFERENCES user (`user_ID`),
  FOREIGN KEY (`rental_approved_by_user`) REFERENCES user (`user_ID`),
  FOREIGN KEY (`rental_admin_ID`) REFERENCES user (`user_ID`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;
