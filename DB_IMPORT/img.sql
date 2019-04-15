SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ShareBNB`
--

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

DROP TABLE IF EXISTS `img`;
CREATE TABLE IF NOT EXISTS `img` (
  `img_ID` int(11) NOT NULL AUTO_INCREMENT,
  `img_residence_ID` int(11) NULL DEFAULT NULL,
  `img_link` varchar(255) NOT NULL,
  `img_description` TEXT NULL DEFAULT NULL,

  PRIMARY KEY (`img_ID`),
  FOREIGN KEY (`img_residence_ID`) REFERENCES `residence` (`residence_ID`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;