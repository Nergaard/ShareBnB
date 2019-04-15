SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ShareBNB`
--

-- --------------------------------------------------------

--
-- Table structure for table `residence`
--

DROP TABLE IF EXISTS `residence`;
CREATE TABLE IF NOT EXISTS `residence` (
  `residence_ID` int(11) NOT NULL AUTO_INCREMENT,
  `residence_address` varchar(255) NOT NULL,
  `residence_zipcode` int(4) NOT NULL,
  `residence_city` varchar(255) NOT NULL,
  `residence_contry` varchar(255) NOT NULL,
  `residence_type` int(1) NOT NULL,
  `residence_price` int(11) NOT NULL,
  `residence_size` int(11) NOT NULL,
  `residence_bedrooms` int(4) NOT NULL,
  `residence_main_sleeps` int(4) NOT NULL,
  `residence_extra_sleeps` int(4) NULL,
  `residence_headline` varchar(255) NOT NULL,
  `residence_description` varchar(255) NOT NULL,
  `residence_main_img_ID` int(11) NULL,
  `residence_owner_user_ID` int(11) NOT NULL,
  `residence_subleaser_user_ID` int(11) NULL,
  `residence_active_status` tinyint(1) NOT NULL DEFAULT 0,
  `residence_rating` float(11) NOT NULL DEFAULT 0,
  `residence_rating_count` int(11) NOT NULL DEFAULT 0,

  PRIMARY KEY (`residence_ID`),
  FOREIGN KEY (`residence_main_img_ID`) REFERENCES `img` (`img_ID`),
  FOREIGN KEY (`residence_owner_user_ID`) REFERENCES `user` (`user_ID`),
  FOREIGN KEY (`residence_subleaser_user_ID`) REFERENCES `user` (`user_ID`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;