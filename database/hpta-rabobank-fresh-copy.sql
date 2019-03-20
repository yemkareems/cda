-- phpMyAdmin SQL Dump
-- version 4.6.0deb1.trusty~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2016 at 03:07 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hpta`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `radar_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `radar_id`, `name`) VALUES
(1, 1, 'mind-set'),
(2, 1, 'practices & roles'),
(3, 1, 'relationship'),
(4, 1, 'environment');

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
(1, 'HPTA');

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
(1, '000', 'dianne', 'elsinga', 'd.elsinga@prowareness.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-02-16 00:00:00', 1);

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
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_team`
--

CREATE TABLE `employee_team` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 'I am aware of my team memberâ€™s individual goals and we challenge each other on them regularly.'),
(2, 1, 'My career path is in alignment with what I want to be (long term goals).'),
(3, 2, 'I am aware of my strengths and use them, every working day, in getting my team better and better.'),
(4, 2, 'I see myself as somebody who is comfortable approaching people.'),
(5, 2, 'Every day I feel valued working in my team.'),
(6, 2, 'The work I do is meaningful to me.'),
(7, 3, 'I am fine with being vulnerable and showing my limitations.'),
(8, 3, 'I show my team mates that being open and showing my limitations does not impact my status or reputation.'),
(9, 4, 'I feel committed to the goal and outcome of the team and show this by being with my team whenever they need me.'),
(10, 4, 'I feel energized by my team and my work.'),
(11, 5, 'In the planning my team has space to innovate on new services and products.'),
(12, 6, 'In my team I notice at least one tangible improvement every sprint.'),
(13, 6, 'In our team we hold each other accountable for our performance and results.'),
(14, 6, 'In our team we take action if performance and/or results fall back.'),
(15, 7, 'In our team the people have the skills, knowledge and attitude that fits their role.'),
(16, 7, 'In our team we hold shared ownership for the results.'),
(17, 8, 'Our team has specific goals which are clear and visualized and created, supported and accepted by the whole team.'),
(18, 8, 'Our Product Owner prioritizes the work, so we do the most valuable work first.'),
(19, 8, 'We plan our work realistically, so we donâ€™t have work left when the time is up.'),
(20, 9, 'Our team meetings are efficient, time-boxed and interesting.'),
(21, 9, 'In our team we have regular meetings in place to give and receive feedback.'),
(22, 9, 'The team and stakeholders come together at least once a week to align on the expected output and outcome.'),
(23, 9, 'Our team has an effective decision making process.'),
(24, 10, 'In our team reporting improves our results.'),
(25, 10, 'We have the tools in place to achieve the results expected from us.'),
(26, 10, 'We have the proper tools to do reporting and to follow up the reports.'),
(27, 11, 'We engage in energetic and engaging communication within our team.'),
(28, 11, 'We interact with each other outside formal meetings and are engaged with each other.'),
(29, 11, 'We spread our energy to the other teams in the organization.'),
(30, 12, 'In my team nobody talks behind my back.'),
(31, 12, 'My team members respect my efforts, abilities, opinions and quirks.'),
(32, 12, 'In my team I can talk about my personal life and share my experiences.'),
(33, 12, 'If I make a mistake, it is not held against me.'),
(34, 12, 'When my team members say they will do something, they will follow through with it.'),
(35, 13, 'We laugh and joke with each other and tend to take things lightly.'),
(36, 13, 'We celebrate on every opportunity of celebration.'),
(37, 13, 'We get energy from working together.'),
(38, 14, 'In our team we have constructive conflicts to take the right decisions, without grudges.'),
(39, 14, 'I voice my opinions also at the risk of disagreement.'),
(40, 15, 'I share experiences from my personal life with my team mates.'),
(41, 15, 'I actively ask my team mates for feedback.'),
(42, 15, 'If I get feedback I consciously work on improving myself on that point.'),
(43, 15, 'The open culture within my team energizes me.'),
(44, 16, 'Our leadersâ€™ set our team up for success and then supports from the outside.'),
(45, 16, 'Our leadersâ€™ remove roadblocks for our team within the organisation.'),
(46, 16, 'Our leadersâ€™ challenge our team to reach higher performance and add higher business value'),
(47, 16, 'I can take initiatives and I get the required support from my leaders.'),
(48, 16, 'Our leaders clearly communicate our goals, values and strategy and reinforce that clarity going forward.'),
(49, 17, 'Stakeholders give the team insight in the expected outcome of the work on short and long term.'),
(50, 17, 'Stakeholders inform the team on the impact we have within the (customer) organization.'),
(51, 17, 'The team meets the stakeholder on a weekly basis.'),
(52, 18, 'My contributions to team/organization is appreciated.'),
(53, 18, 'I feel part of the organization and working here fulfils me.'),
(54, 18, 'My organization provides me with sufficient growth opportunities.'),
(55, 19, 'In our team we know what results are expected from us.'),
(56, 19, 'Feeling responsible for the results improves the teams motivation.'),
(57, 19, 'Working environment provides opportunity to define and improve the way of work.'),
(58, 20, 'We are empowered to do the work our way.'),
(59, 20, 'My organization gives me a sense of satisfaction and purpose.'),
(60, 20, 'We interact with people outside our team to explore new ideas and get a fresh perspective.'),
(61, 20, 'We are allowed to make mistakes and are expected to learn from them.'),
(62, 20, 'My work has impact on my (customer) organization.');

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
(1, 'team');

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
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 'Personal development'),
(2, 1, 'Self-awareness'),
(3, 1, 'Authenticity'),
(4, 1, 'Commitment/Dedication'),
(5, 1, 'Entrepreneurial mindset'),
(6, 2, 'Continuous improvement'),
(7, 2, 'Roles'),
(8, 2, 'Rules/Way of Work'),
(9, 2, 'Meetings'),
(10, 2, 'Reporting/Tooling'),
(11, 3, 'Communication'),
(12, 3, 'Trust & Respect'),
(13, 3, 'Celebration & Fun'),
(14, 3, 'Constructive Conflict'),
(15, 3, 'Openess & Feedback'),
(16, 4, 'Leadership'),
(17, 4, 'Stakeholders'),
(18, 4, 'Recognition & Growth opportunities'),
(19, 4, 'Responsibility to the team'),
(20, 4, 'Empowerment');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee_team`
--
ALTER TABLE `employee_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `radar`
--
ALTER TABLE `radar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rating_quarter`
--
ALTER TABLE `rating_quarter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
