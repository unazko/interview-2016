/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quotes`
--
CREATE DATABASE IF NOT EXISTS `quotes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `quotes`;

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE IF NOT EXISTS `quote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quote` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`id`, `quote`) VALUES
(1, 'Faith has to do with things that are not seen and hope with things that are not at hand.'),
(2, 'My little dog - a heartbeat at my feet.'),
(3, 'Painting seems like some kind of peculiar miracle that I need to have again and again.'),
(4, 'Nothing says holidays, like a cheese log.'),
(5, 'All are but parts of one stupendous whole, Whose body Nature is, and God the soul.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
