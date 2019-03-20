-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~trusty.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2017 at 01:34 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1-log
-- PHP Version: 7.0.14-2+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cda`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `radar_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `radar_id`, `level`, `name`) VALUES
(1, 1, 1, 'Source Code Management'),
(2, 1, 2, 'Continuous Integration'),
(3, 1, 3, 'Test Automation'),
(4, 1, 4, 'Release Management'),
(5, 1, 5, 'Fail-safes'),
(6, 1, 6, 'Team Culture');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'HPTA'),
(2, 'Prowareness'),
(3, 'Rabobank');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `emp_code` varchar(20) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_code`, `firstname`, `lastname`, `email`, `password`, `created_at`, `created_by`) VALUES
(1, '000', 'dianne', 'elsinga', 'd.elsinga@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-02-16 00:00:00', 1),
(2, 'v88fowcKO', 'Naveen', 'Choppa', 'n.choppa@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-11-24 12:57:57', 1),
(18, 'PRO102', 'Kareemullah', 'Shareef', 'm.shareef1@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-11-28 06:04:57', 2),
(19, 'PRO248', 'Sumeet', 'Madan', 's.madan@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-11-28 06:11:32', 2),
(20, 'PRO420', 'Madan', 'Sumeet', 'sumeet.madan@gmail.com', 'd017e640e7ebff88e4199d0daef4f115', '2016-11-28 06:21:35', 2),
(22, 'PRO102A', 'Kareemullah', 'Shareef', 'yemkareems@gmail.com', 'd017e640e7ebff88e4199d0daef4f115', '2016-11-28 06:42:35', 2),
(23, 'PRO456', 'Madan', 'Sumeet', 'msdnsumeet@gmail.com', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 04:57:10', 2),
(24, 'c9oKetqvq9TRa', 'GTHA', 'Admin', 'm.dehing@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:13:10', 1),
(25, 'PRO102B', 'Kareemullah', 'Shareef', 'm.shareef@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:18:45', 2),
(27, 'RABO2', 'Freek', 'van het Hoofd', 'Freek.van.het.Hoofd@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:44:26', 24),
(28, 'RABO3', 'Paul', 'Lekatompessy', 'Paul.Lekatompessy@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:48:24', 24),
(30, 'RABO5', 'Robin', 'Talsma', 'Robin.Talsma@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:49:46', 24),
(31, 'RABO6', 'Johan', 'Wierenga', 'Johan.Wierenga@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:50:08', 24),
(32, 'RABO7', 'Robin', 'Wijnants', 'Robin.Wijnants@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:50:43', 24),
(33, 'RABO8', 'Jeroen', 'Bijl', 'Jeroen.Bijl@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:51:07', 24),
(34, 'RABO9', 'John', 'Strijker', 'John.Strijker@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-05 12:51:27', 24),
(35, 'RABO1', 'Sven', 'van den Burg', 'Sven.van.den.Burg@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-07 09:51:40', 24),
(36, 'RABO4', 'Ingeborg', 'Paardekooper', 'Ingeborg.Paardekooper@rabobank.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-07 09:52:26', 24),
(37, '10', 'Sven ', 'Van den Burg (Gmail)', 'svenvdburg@gmail.com', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-07 15:13:03', 24),
(38, '12', 'Ingeborg', 'Paardekooper (hotmail)', 'ingeborgvdp@hotmail.com', 'd017e640e7ebff88e4199d0daef4f115', '2016-12-08 09:18:23', 24);

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `emp_id`, `role_id`, `company_id`) VALUES
(1, 1, 1, 1),
(16, 2, 2, 2),
(17, 18, 3, 2),
(18, 19, 3, 2),
(19, 20, 3, 2),
(21, 22, 3, 2),
(22, 23, 3, 2),
(23, 24, 2, 3),
(24, 25, 3, 2),
(26, 27, 3, 3),
(27, 28, 3, 3),
(29, 30, 3, 3),
(30, 31, 3, 3),
(31, 32, 3, 3),
(32, 33, 3, 3),
(33, 34, 3, 3),
(34, 35, 3, 3),
(35, 36, 3, 3),
(36, 37, 3, 3),
(37, 38, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_team`
--

CREATE TABLE `employee_team` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_team`
--

INSERT INTO `employee_team` (`id`, `emp_id`, `team_id`) VALUES
(1, 18, 1),
(2, 19, 2),
(3, 20, 2),
(5, 22, 1),
(6, 23, 2),
(7, 25, 1),
(9, 27, 3),
(10, 28, 3),
(12, 30, 3),
(13, 31, 3),
(14, 32, 4),
(15, 33, 4),
(16, 34, 4),
(17, 35, 4),
(18, 36, 4),
(19, 37, 4),
(20, 38, 4);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `display` varchar(100) NOT NULL,
  `weightage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `qid`, `display`, `weightage`) VALUES
(3, 1, 'Yes', 1),
(4, 2, 'Yes', 1),
(5, 3, 'Yes', 1),
(6, 4, 'Yes', 1),
(7, 5, 'Yes', 1),
(8, 6, 'Yes', 1),
(9, 7, 'Yes', 1),
(10, 8, 'Yes', 1),
(11, 9, 'Yes', 1),
(12, 10, 'Yes', 1),
(13, 11, 'Yes', 1),
(14, 12, 'Yes', 1),
(15, 13, 'Yes', 1),
(16, 14, 'Yes', 1),
(17, 15, 'Yes', 1),
(18, 16, 'Yes', 1),
(19, 17, 'Yes', 1),
(20, 18, 'Yes', 1),
(21, 19, 'Yes', 1),
(22, 20, 'Yes', 1),
(23, 21, 'Yes', 1),
(24, 22, 'Yes', 1),
(25, 23, 'Yes', 1),
(26, 24, 'Yes', 1),
(27, 25, 'Yes', 1),
(28, 26, 'Yes', 1),
(29, 27, 'Yes', 1),
(30, 28, 'Yes', 1),
(31, 29, 'Yes', 1),
(32, 30, 'Yes', 1),
(33, 31, 'Yes', 1),
(34, 32, 'Yes', 1),
(35, 33, 'Yes', 1),
(36, 34, 'Yes', 1),
(37, 35, 'Yes', 1),
(38, 36, 'Yes', 1),
(39, 37, 'Yes', 1),
(40, 38, 'Yes', 1),
(41, 39, 'Yes', 1),
(42, 40, 'Yes', 1),
(43, 41, 'Yes', 1),
(44, 42, 'Yes', 1),
(45, 43, 'Yes', 1),
(46, 44, 'Yes', 1),
(47, 45, 'Yes', 1),
(48, 46, 'Yes', 1),
(49, 47, 'Yes', 1),
(50, 48, 'Yes', 1),
(51, 49, 'Yes', 1),
(52, 50, 'Yes', 1),
(53, 51, 'Yes', 1),
(54, 52, 'Yes', 1),
(55, 53, 'Yes', 1),
(56, 54, 'Yes', 1),
(57, 55, 'Yes', 1),
(58, 56, 'Yes', 1),
(59, 57, 'Yes', 1),
(60, 58, 'Yes', 1),
(61, 59, 'Yes', 1),
(62, 60, 'Yes', 1),
(63, 61, 'Yes', 1),
(64, 62, 'Yes', 1),
(65, 63, 'Yes', 1),
(66, 64, 'Yes', 1),
(67, 65, 'Yes', 1),
(68, 66, 'Yes', 1),
(69, 67, 'Yes', 1),
(70, 68, 'Yes', 1),
(71, 69, 'Yes', 1),
(72, 70, 'Yes', 1),
(73, 71, 'Yes', 1),
(74, 72, 'Yes', 1),
(75, 73, 'Yes', 1),
(76, 74, 'Yes', 1),
(77, 75, 'Yes', 1),
(78, 76, 'Yes', 1),
(79, 77, 'Yes', 1),
(80, 78, 'Yes', 1),
(81, 79, 'Yes', 1),
(82, 80, 'Yes', 1),
(83, 81, 'Yes', 1),
(84, 82, 'Yes', 1),
(85, 83, 'Yes', 1),
(86, 84, 'Yes', 1),
(87, 85, 'Yes', 1),
(88, 86, 'Yes', 1),
(258, 1, 'No', 0),
(259, 2, 'No', 0),
(260, 3, 'No', 0),
(261, 4, 'No', 0),
(262, 5, 'No', 0),
(263, 6, 'No', 0),
(264, 7, 'No', 0),
(265, 8, 'No', 0),
(266, 9, 'No', 0),
(267, 10, 'No', 0),
(268, 11, 'No', 0),
(269, 12, 'No', 0),
(270, 13, 'No', 0),
(271, 14, 'No', 0),
(272, 15, 'No', 0),
(273, 16, 'No', 0),
(274, 17, 'No', 0),
(275, 18, 'No', 0),
(276, 19, 'No', 0),
(277, 20, 'No', 0),
(278, 21, 'No', 0),
(279, 22, 'No', 0),
(280, 23, 'No', 0),
(281, 24, 'No', 0),
(282, 25, 'No', 0),
(283, 26, 'No', 0),
(284, 27, 'No', 0),
(285, 28, 'No', 0),
(286, 29, 'No', 0),
(287, 30, 'No', 0),
(288, 31, 'No', 0),
(289, 32, 'No', 0),
(290, 33, 'No', 0),
(291, 34, 'No', 0),
(292, 35, 'No', 0),
(293, 36, 'No', 0),
(294, 37, 'No', 0),
(295, 38, 'No', 0),
(296, 39, 'No', 0),
(297, 40, 'No', 0),
(298, 41, 'No', 0),
(299, 42, 'No', 0),
(300, 43, 'No', 0),
(301, 44, 'No', 0),
(302, 45, 'No', 0),
(303, 46, 'No', 0),
(304, 47, 'No', -1),
(305, 48, 'No', 0),
(306, 49, 'No', 0),
(307, 50, 'No', 0),
(308, 51, 'No', 0),
(309, 52, 'No', 0),
(310, 53, 'No', 0),
(311, 54, 'No', 0),
(312, 55, 'No', 0),
(313, 56, 'No', 0),
(314, 57, 'No', 0),
(315, 58, 'No', 0),
(316, 59, 'No', 0),
(317, 60, 'No', 0),
(318, 61, 'No', 0),
(319, 62, 'No', 0),
(320, 63, 'No', 0),
(321, 64, 'No', 0),
(322, 65, 'No', 0),
(323, 66, 'No', 0),
(324, 67, 'No', 0),
(325, 68, 'No', 0),
(326, 69, 'No', 0),
(327, 70, 'No', 0),
(328, 71, 'No', 0),
(329, 72, 'No', 0),
(330, 73, 'No', 0),
(331, 74, 'No', 0),
(332, 75, 'No', 0),
(333, 76, 'No', 0),
(334, 77, 'No', 0),
(335, 78, 'No', 0),
(336, 79, 'No', 0),
(337, 80, 'No', 0),
(338, 81, 'No', 0),
(339, 82, 'No', 0),
(340, 83, 'No', 0),
(341, 84, 'No', 0),
(342, 85, 'No', 0),
(343, 86, 'No', 0),
(388, 131, 'Yes', 1),
(389, 131, 'No', 0),
(390, 132, 'Yes', 1),
(391, 132, 'No', 0),
(392, 133, 'Yes', 1),
(393, 133, 'No', 0),
(394, 134, 'Yes', 1),
(395, 134, 'No', 0),
(396, 135, 'Yes', 1),
(397, 135, 'No', 0),
(400, 137, 'Yes', 1),
(401, 137, 'No', 0),
(402, 138, 'Yes', 1),
(403, 138, 'No', 0),
(404, 139, 'Yes', 1),
(405, 139, 'No', 0),
(406, 140, 'Yes', 1),
(407, 140, 'No', 0),
(408, 141, 'Yes', 1),
(409, 141, 'No', 0),
(410, 142, 'Yes', 1),
(411, 142, 'No', 0),
(412, 143, 'Yes', 1),
(413, 143, 'No', 0),
(414, 144, 'Yes', 1),
(415, 144, 'No', 0),
(416, 145, 'Yes', 1),
(417, 145, 'No', 0),
(418, 146, 'Yes', 1),
(419, 146, 'No', 0),
(420, 147, 'Yes', 1),
(421, 147, 'No', 0),
(422, 148, 'Yes', 1),
(423, 148, 'No', 0),
(424, 149, 'Yes', 1),
(425, 149, 'No', 0),
(426, 150, 'Yes', 1),
(427, 150, 'No', 0),
(428, 151, 'Yes', 1),
(429, 151, 'No', 0),
(430, 152, 'Yes', 1),
(431, 152, 'No', 0),
(432, 153, 'Yes', 1),
(433, 153, 'No', 0),
(434, 154, 'Yes', 1),
(435, 154, 'No', 0),
(436, 155, 'Yes', 1),
(437, 155, 'No', 0),
(438, 156, 'Yes', 1),
(439, 156, 'No', 0),
(440, 157, 'Yes', 1),
(441, 157, 'No', 0),
(442, 158, 'Yes', 1),
(443, 158, 'No', 0),
(444, 159, 'Yes', 1),
(445, 159, 'No', 0),
(446, 160, 'Yes', 1),
(447, 160, 'No', 0),
(448, 161, 'Yes', 1),
(449, 161, 'No', 0),
(450, 162, 'Yes', 1),
(451, 162, 'No', 0),
(452, 163, 'Yes', 1),
(453, 163, 'No', 0),
(454, 164, 'Yes', 1),
(455, 164, 'No', 0),
(456, 165, 'Yes', 1),
(457, 165, 'No', 0),
(458, 166, 'Yes', 1),
(459, 166, 'No', 0),
(460, 167, 'Yes', 1),
(461, 167, 'No', 0),
(462, 168, 'Yes', 1),
(463, 168, 'No', 0),
(464, 169, 'Yes', 1),
(465, 169, 'No', 0),
(466, 170, 'Yes', 1),
(467, 170, 'No', 0),
(468, 171, 'Yes', 1),
(469, 171, 'No', 0),
(470, 172, 'Yes', 1),
(471, 172, 'No', 0),
(472, 173, 'Yes', 1),
(473, 173, 'No', 0),
(474, 174, 'Yes', 1),
(475, 174, 'No', 0),
(476, 175, 'Yes', 1),
(477, 175, 'No', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `subcategory_id`, `question`) VALUES
(1, 1, 'Is there a well-defined general coding practice for namespaces, function and variable names?'),
(2, 1, 'Is there any kind of code style enforcement tool being utilized?'),
(3, 1, 'Are there standards for code coverage of tests?'),
(4, 1, 'Are patterns & practices established for code reuse?'),
(5, 1, 'Are there any shared libraries or repositories for code reuse?'),
(6, 1, 'Are available or custom Frameworks used to solve common coding tasks?'),
(7, 1, 'Are effective code reviews carried out?'),
(8, 1, 'Are peer reviews used?'),
(9, 1, 'Are there any artifacts produced during code reviews to use as a metric for improvement?'),
(10, 1, 'Is there a well defined and thorough check-in process which includes quality checks?'),
(11, 1, 'Does your team make use of quality metrics reporting to improve code & process?'),
(12, 1, 'Are there standards in place for writing secure code?'),
(13, 2, 'Is there a versioning and branching strategy appropriate for the team and product/service being developed?'),
(14, 2, 'Does the source control system allow for development activity at different geographical sites?'),
(15, 2, 'Does the source repository structure and permissions allow for parallel development?'),
(16, 3, 'Do you have any version control mechanisms for your databases?'),
(17, 3, 'Does your database source control structure match the branching and merging plans of your application code?'),
(18, 4, 'Are different environment configs maintained in source control?'),
(19, 4, 'Application environment is maintained in source control?'),
(20, 4, 'Infrastructure configs are labelled as part of the build process?'),
(21, 4, 'Does IT manage the development infrastructure?'),
(22, 5, 'Do you maintain the build infrastructure in source control?'),
(23, 5, 'Are build/release/deploy job configs versioned?'),
(24, 5, 'Is all code managed through a source control system that provides adaquate functionality such as performance, availablity, and features?'),
(25, 6, 'Does the build process involve any manual intervention'),
(26, 6, 'Is there a consistent labeling policy?'),
(27, 6, 'Are deployment packages introduced early in testing similar to how the application is being deployed to production?'),
(28, 6, 'Build scripts can take care of all kinds of releases(major, minor, hotfixes etc)'),
(29, 6, 'Is there a library of all successful builds?'),
(30, 6, 'Do you have a person responsible for managing the builds to make sure they are kept up to date as the application evolves?'),
(31, 7, 'Are builds being triggered by changes in code base?'),
(32, 7, 'Are builds being triggered by changes in infrastructure?'),
(33, 7, 'Is there effective auditing of who makes changes to source control?'),
(34, 7, 'Is there effective auditing of why changes are made to source control?'),
(35, 7, 'Are Build failures triggering a notification or failed build that is addressed by the Developers?'),
(36, 7, 'Are database changes validated against schema before deployment?'),
(37, 8, 'Are unit failures measured and addressed?'),
(38, 8, 'Do you have automated builds of your database schema?'),
(39, 8, 'Is there effective static code analysis?'),
(40, 8, 'Has code coverage been considered where appropriate?'),
(41, 9, 'Does the build produce binaries that have a meaningful versioning scheme?'),
(42, 9, 'Is there effective tracking of builds to source control versioning?'),
(43, 9, 'Are database migration scripts created from an automated build process?'),
(44, 10, 'Do you test the deployment mechanisms at the earliest time possible?'),
(45, 10, 'Do you run sanity checks/Smoke Tests of application in the dev environment as part of the CI process?\r\n'),
(46, 11, 'Do you test individual schema elements of your database (Stored procedures, Functions etc.) prior to deployment?'),
(47, 11, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(48, 11, 'Do you have a formal set of tests that are run after every schema change?'),
(49, 11, 'Are test cases part of your application source code?'),
(50, 12, 'Are automated integration tests used?'),
(51, 12, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(52, 12, 'Integration tests(If needed) are run before checkins \r\n'),
(53, 13, 'Is there any way to track tests back to requirements?'),
(54, 13, 'Do test plans consider the simulation of different user environments?'),
(55, 13, 'Are the test exit criteria well defined and evaluated?'),
(56, 13, 'Have the areas of greatest risk been identified and tests prioritized accordingly?'),
(57, 13, 'Are the end-user or customer-acceptance criteria well defined and evaluated?'),
(58, 13, 'Do you have automated testing of your databases?'),
(59, 13, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(60, 13, 'Do you have a repeatable data set for testing?'),
(61, 13, 'Is there suitable test data to ensure application tests are valid?'),
(62, 13, 'Do you run database tests against production data or representative production data?'),
(63, 13, 'Can tests be run in parallel?'),
(64, 14, 'Are there appropriate tools available to perform automated testing?'),
(65, 14, 'Is User Acceptance Testing (UAT) used?'),
(66, 14, 'Are these tests run on environments which are most prod-like?'),
(67, 14, 'Any stress test tools?'),
(68, 14, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(69, 14, 'Any Performance Analysis tools?'),
(70, 15, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(71, 15, 'Are Access Control tests Performed?'),
(72, 15, 'Are Authentication checks are performed?'),
(73, 15, 'Is the Data is Protected?'),
(74, 15, 'Is Input Validation performed? If yes, is it server side or client side using some Js. (If client side it is not safe)\r\n'),
(75, 16, 'Deployment \"smoke tests\" are performed to validate successful deployment?'),
(76, 16, 'What percentage of the code is covered by automated testing? (<50%=0, 50-75%=1, >75%=2)'),
(77, 16, 'Are the testing environments \"production like\" in configuration?'),
(78, 17, 'Is there effective instrumentation of the application using technologies such as Event Logs, Performance Counters, etc?'),
(79, 17, 'Are deployment packages introduced early in testing similar to how the application is being deployed to production?'),
(80, 17, 'Is the overall Infrastructure Architecture well understood by the developers and testers?'),
(81, 17, 'Is a self containing, single portable application package  used throughout the deployment pipeline?'),
(82, 17, 'Do you have a deployment pipeline in place?'),
(83, 18, 'Is production the starting point for automated deployments of the application and database?'),
(84, 18, 'Are Operation Guides and Troubleshooting Guides being produced and under version control?'),
(85, 19, 'Is the Roll Back mechanism tested as part of the Deployment process?'),
(86, 19, 'Do you have rollback mechanism?'),
(131, 20, 'Is the infrastructure for testing automated?'),
(132, 20, 'Are servers and all other resources required to create the application infrastructure is provisioned automatically? NO = 0, PARTLY = 3, FULL = 6 (can be in between based on assessment) Full means all and any servers, database etc.'),
(133, 20, 'Are your releases to production installed by an automated script or automatically deployed through a Configuration Management tool?'),
(134, 20, 'Are new clients and servers installed automatically?'),
(135, 21, 'Can production environments be easily recreated?'),
(137, 21, 'Can the entire production environment be repeatable provisioned on demand in production and testing?'),
(138, 21, 'Does your infrastructure supports auto-scaling?'),
(139, 21, 'Scalability automation - can servers be added or removed from a cluster with no service interruption?'),
(140, 22, 'Is a disaster recovery process in place?'),
(141, 22, 'Is there effective management of the development environment?'),
(142, 22, 'Do you monitor your build and deployment infrastructure?'),
(143, 22, 'Do you monitor all your environments?'),
(144, 23, 'Are application metrics for all environments tracked in a central dashboard?'),
(145, 23, 'Does your source control and ALM system have an appropriate level of service level agreement (SLA) to ensure minimal impact for development teams in the event of a any single point of failure?'),
(146, 23, 'Is the source control properly secured?'),
(147, 23, 'Are you getting alerting and notifications based on application performance and errors events?'),
(148, 23, 'Is the server infrastructure monitored ? (CPU, memory, i/o, etc)'),
(149, 24, 'Are all of the project\'s intellectual property (source code, documentation etc.) under effective, secure source control?'),
(150, 24, 'Are there formal check-in criteria governing source code changes?'),
(151, 24, 'Application diagnostics â€“ is detailed diagnostics captured on application faults including performance, memory utilization and  errors'),
(152, 24, 'Application diagnostics â€“ is detailed code level execution diagnostics captured in production and can be passed to developers'),
(153, 25, 'Do you have backup mechanisms for the supporting infra'),
(154, 26, 'Do you perform monkey tests?'),
(155, 27, 'All expertise is within the team?'),
(156, 27, 'Team values each others opinions ?'),
(157, 27, 'Team members are aware of each others work ?'),
(158, 27, 'Team members hold each other accountable'),
(159, 28, 'Is pair programming effective?'),
(160, 28, 'Do you follow test driven development'),
(161, 28, 'Does the team practice behavior driven development ?'),
(162, 28, 'Is DoD defined and deliverable\'s are accepted based on the DoD ?'),
(163, 28, 'Are bugs fixed immediately?'),
(164, 28, 'Improvement points are identified every sprint and worked upon frequently'),
(165, 29, 'Team/s believes in collective code ownership?'),
(166, 29, 'Team/s stop the line on a build/test failure?'),
(167, 29, 'Team/s can take decisions on design of application themselves?'),
(168, 29, 'Team/s ensures information is radiated to the stakeholders on every sprint activity'),
(169, 30, 'Do you have all the necessary authorizations and access permissions for performing deployments of all components?'),
(170, 30, 'Release decisions are based on metrics'),
(171, 30, 'Team/s is supremely confident of the products release'),
(172, 30, 'Team/s ensures information related to the product radiated to the stakeholders'),
(173, 31, 'End user feedback is highly valued and considered as part of the developement process'),
(174, 31, 'Business relies on team\'s suggestions for product improvements'),
(175, 32, 'Is a release time-frame well defined?');

-- --------------------------------------------------------

--
-- Table structure for table `radar`
--

CREATE TABLE `radar` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radar`
--

INSERT INTO `radar` (`id`, `name`) VALUES
(1, 'CD');

-- --------------------------------------------------------

--
-- Table structure for table `rating_quarter`
--

CREATE TABLE `rating_quarter` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `quarter` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `weightage` int(11) NOT NULL,
  `comment` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_quarter`
--

INSERT INTO `rating_quarter` (`id`, `emp_id`, `question_id`, `year`, `quarter`, `answer`, `weightage`, `comment`, `datetime`) VALUES
(1, 25, 1, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(2, 25, 2, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(3, 25, 3, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(4, 25, 4, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(5, 25, 5, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(6, 25, 6, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(7, 25, 7, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(8, 25, 8, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(9, 25, 9, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(10, 25, 10, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(11, 25, 11, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(12, 25, 12, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(13, 25, 13, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(14, 25, 14, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(15, 25, 15, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(16, 25, 16, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(17, 25, 17, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(18, 25, 18, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(19, 25, 19, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(20, 25, 20, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(21, 25, 21, 2017, 2, 0, 0, '', '2017-05-25 13:27:46'),
(22, 25, 22, 2017, 2, 1, 1, '', '2017-05-25 13:27:46'),
(23, 25, 23, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(24, 25, 24, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(25, 25, 25, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(26, 25, 26, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(27, 25, 27, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(28, 25, 28, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(29, 25, 29, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(30, 25, 30, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(31, 25, 31, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(32, 25, 32, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(33, 25, 33, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(34, 25, 34, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(35, 25, 35, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(36, 25, 36, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(37, 25, 37, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(38, 25, 38, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(39, 25, 39, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(40, 25, 40, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(41, 25, 41, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(42, 25, 42, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(43, 25, 43, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(44, 25, 44, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(45, 25, 45, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(46, 25, 46, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(47, 25, 47, 2017, 2, -1, -1, '', '2017-05-25 13:27:47'),
(48, 25, 48, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(49, 25, 49, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(50, 25, 50, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(51, 25, 51, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(52, 25, 52, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(53, 25, 53, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(54, 25, 54, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(55, 25, 55, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(56, 25, 56, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(57, 25, 57, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(58, 25, 58, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(59, 25, 59, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(60, 25, 60, 2017, 2, 0, 0, '', '2017-05-25 13:27:47'),
(61, 25, 61, 2017, 2, 1, 1, '', '2017-05-25 13:27:47'),
(62, 25, 62, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(63, 25, 63, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(64, 25, 64, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(65, 25, 65, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(66, 25, 66, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(67, 25, 67, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(68, 25, 68, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(69, 25, 69, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(70, 25, 70, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(71, 25, 71, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(72, 25, 72, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(73, 25, 73, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(74, 25, 74, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(75, 25, 75, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(76, 25, 76, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(77, 25, 77, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(78, 25, 78, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(79, 25, 79, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(80, 25, 80, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(81, 25, 81, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(82, 25, 82, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(83, 25, 83, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(84, 25, 84, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(85, 25, 85, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(86, 25, 86, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(87, 25, 131, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(88, 25, 132, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(89, 25, 133, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(90, 25, 134, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(91, 25, 135, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(92, 25, 137, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(93, 25, 138, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(94, 25, 139, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(95, 25, 140, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(96, 25, 141, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(97, 25, 142, 2017, 2, 0, 0, '', '2017-05-25 13:27:48'),
(98, 25, 143, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(99, 25, 144, 2017, 2, 1, 1, '', '2017-05-25 13:27:48'),
(100, 25, 145, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(101, 25, 146, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(102, 25, 147, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(103, 25, 148, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(104, 25, 149, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(105, 25, 150, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(106, 25, 151, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(107, 25, 152, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(108, 25, 153, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(109, 25, 154, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(110, 25, 155, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(111, 25, 156, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(112, 25, 157, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(113, 25, 158, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(114, 25, 159, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(115, 25, 160, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(116, 25, 161, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(117, 25, 162, 2017, 2, 0, 0, '', '2017-05-25 13:27:49'),
(118, 25, 163, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(119, 25, 164, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(120, 25, 165, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(121, 25, 166, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(122, 25, 167, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(123, 25, 168, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(124, 25, 169, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(125, 25, 170, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(126, 25, 171, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(127, 25, 172, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(128, 25, 173, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(129, 25, 174, 2017, 2, 1, 1, '', '2017-05-25 13:27:49'),
(130, 25, 175, 2017, 2, 1, 1, '', '2017-05-25 13:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Application Code follows guidelines'),
(2, 1, 'Minimal Branching'),
(3, 1, 'Database management'),
(4, 1, 'Application Infrastructure as Code'),
(5, 1, 'Supporting Infrastructure as Code'),
(6, 2, 'Scripted build automation'),
(7, 2, 'Continuous Integration'),
(8, 2, 'Static Code Analysis,Code Coverage and Tehnical Debt'),
(9, 2, 'All artifacts versioned'),
(10, 2, 'Application Sanity Check'),
(11, 3, 'Unit Tests'),
(12, 3, 'Integration Tests'),
(13, 3, 'Functional Tests and Regression tests'),
(14, 3, 'Perf and Load Tests'),
(15, 3, 'Security Tests'),
(16, 3, 'Smoke Tests'),
(17, 4, 'Scripted Deployments'),
(18, 4, 'Uniform deployment scripts across environments'),
(19, 4, 'Roll Back Mechanism'),
(20, 4, 'Automated Provisioning'),
(21, 4, 'Automated Scaling based on metrics'),
(22, 5, 'Build and Deploy infra seperated from app envs'),
(23, 5, 'All app envs monitored for key metrics'),
(24, 5, 'Supporting Infra monitored'),
(25, 5, 'Always available Support Infra'),
(26, 5, 'Monkey Tests'),
(27, 6, 'Strong Team'),
(28, 6, 'Quality output'),
(29, 6, 'Collective responsibility'),
(30, 6, 'Product Ownership'),
(31, 6, 'Business drivers'),
(32, 6, 'Delivery Process');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `company_id`) VALUES
(1, 'HPTA', 2),
(2, 'GTHA', 2),
(3, 'Alpha', 3),
(4, 'Gaama', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `radar_id` (`radar_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `employee_team`
--
ALTER TABLE `employee_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `radar`
--
ALTER TABLE `radar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_quarter`
--
ALTER TABLE `rating_quarter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `employee_team`
--
ALTER TABLE `employee_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=478;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT for table `radar`
--
ALTER TABLE `radar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rating_quarter`
--
ALTER TABLE `rating_quarter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `qid` FOREIGN KEY (`qid`) REFERENCES `question` (`id`);

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