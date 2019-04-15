SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ShareBNB`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_phone` int(11) NULL,
  `user_registration_time` int(11) NOT NULL,
  `user_residence_owner` tinyint(1) NOT NULL DEFAULT 0,
  `user_residence_sublets` tinyint(1) NOT NULL DEFAULT 0,

  PRIMARY KEY (`user_ID`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;