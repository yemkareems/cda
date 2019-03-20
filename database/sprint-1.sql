-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.trusty~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2016 at 03:34 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hpta`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `radar_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `radar_id`, `name`) VALUES
(1, 1, 'mindset'),
(2, 1, 'practices'),
(3, 1, 'relationship'),
(4, 1, 'environment');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'HPTA');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`id` int(11) NOT NULL,
  `emp_code` varchar(20) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_code`, `firstname`, `lastname`, `email`, `password`, `created_at`, `created_by`) VALUES
(1, '000', 'dianne', 'elsinga', 'd.elsinga@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-02-16 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE IF NOT EXISTS `employee_details` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `emp_id`, `role_id`, `company_id`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_team`
--

CREATE TABLE IF NOT EXISTS `employee_team` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `radar`
--

CREATE TABLE IF NOT EXISTS `radar` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `radar`
--

INSERT INTO `radar` (`id`, `name`) VALUES
(1, 'team');

-- --------------------------------------------------------

--
-- Table structure for table `rating_quarter`
--

CREATE TABLE IF NOT EXISTS `rating_quarter` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'hptaAdmin'),
(2, 'companyAdmin'),
(3, 'teamMember');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
`id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Personal development'),
(2, 1, 'Self-awareness'),
(3, 1, 'Commitment/dedication'),
(4, 1, 'Authenticity'),
(5, 1, 'Entrepreneurial mindset'),
(6, 2, 'Continious improvement'),
(7, 2, 'Roles'),
(8, 2, 'Rules'),
(9, 2, 'Meetings'),
(10, 2, 'Reporting'),
(11, 3, 'Trust'),
(12, 3, 'Respect'),
(13, 3, 'Celebration/Fun'),
(14, 3, 'Constructive Conflict'),
(15, 3, 'Openess/Feedback'),
(16, 4, 'Support of management'),
(17, 4, 'Active stakeholder participation'),
(18, 4, 'Compensation/Rewards/Recognition'),
(19, 4, 'Empowerment/Responsibilities to the team'),
(20, 4, 'Distributed/Remote set-up');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`), ADD KEY `radar_id` (`radar_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
 ADD PRIMARY KEY (`id`), ADD KEY `emp_id` (`emp_id`), ADD KEY `role_id` (`role_id`), ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `employee_team`
--
ALTER TABLE `employee_team`
 ADD PRIMARY KEY (`id`), ADD KEY `emp_id` (`emp_id`), ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`id`), ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `radar`
--
ALTER TABLE `radar`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_quarter`
--
ALTER TABLE `rating_quarter`
 ADD PRIMARY KEY (`id`), ADD KEY `emp_id` (`emp_id`), ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
 ADD PRIMARY KEY (`id`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
 ADD PRIMARY KEY (`id`), ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee_team`
--
ALTER TABLE `employee_team`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `radar`
--
ALTER TABLE `radar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rating_quarter`
--
ALTER TABLE `rating_quarter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`radar_id`) REFERENCES `radar` (`id`);

--
-- Constraints for table `employee_details`
--
ALTER TABLE `employee_details`
ADD CONSTRAINT `employee_details_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`),
ADD CONSTRAINT `employee_details_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
ADD CONSTRAINT `employee_details_ibfk_4` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `employee_team`
--
ALTER TABLE `employee_team`
ADD CONSTRAINT `employee_team_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`),
ADD CONSTRAINT `employee_team_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`);

--
-- Constraints for table `rating_quarter`
--
ALTER TABLE `rating_quarter`
ADD CONSTRAINT `rating_quarter_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`),
ADD CONSTRAINT `rating_quarter_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `team`
--
ALTER TABLE `team`
ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `rating_quarter` ADD `year` YEAR( 4 ) NOT NULL AFTER `question_id` ;

ALTER TABLE `rating_quarter` ADD `weightage` int( 11 ) NOT NULL AFTER `answer` ;

update rating_quarter set weightage = answer;
update rating_quarter set weightage = 5-answer where question_id = 61;