SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ShareBNB`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_message_ID` int(11) NOT NULL AUTO_INCREMENT,
  `chat_from_user_ID` int(11) NOT NULL,
  `chat_to_user_ID` int(11) NOT NULL,
  `chat_timestamp` int(11) NOT NULL,
  `chat_message` text NOT NULL,


  PRIMARY KEY (`chat_message_ID`),
  FOREIGN KEY (`chat_from_user_ID`) REFERENCES user (`user_ID`),
  FOREIGN KEY (`chat_to_user_ID`) REFERENCES user (`user_ID`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;