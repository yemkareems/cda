-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~trusty.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2017 at 02:47 PM
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

-- CREATE DATABASE IF NOT EXISTS `cda` COLLATE 'utf8_general_ci' ;

-- GRANT ALL ON `cda`.* TO 'default'@'%' ;

-- FLUSH PRIVILEGES ;

-- USE `cda` ;

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
(5, 1, 5, 'Fail Safes'),
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
(1, 'Devon');

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
(1, '000', 'CDA', 'Admin', 'cdaadmin@devon.nl', 'd017e640e7ebff88e4199d0daef4f115', '2016-02-16 00:00:00', 1);

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

--
-- Dumping data for table `employee_team`
--

INSERT INTO `employee_team` (`id`, `emp_id`, `team_id`) VALUES
(1, 1, 1);

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
  `comment` text,
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
(1, 'CDA', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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



INSERT INTO `subcategory` (`category_id`, `name`) VALUES
(1, 'Application Code follows guidelines'),
(1, 'Effective use of Version Control'),
(1, 'Database management'),
(1, 'Application Infrastructure as Code'),
(1, 'Supporting Infrastructure as Code'),
(2, 'Scripted build automation'),
(2, 'CI'),
(2, 'Code Quality'),
(2, 'All artifacts versioned'),
(2, 'Application Sanity Check'),
(3, 'Unit Tests'),
(3, 'Integration Tests'),
(3, 'Functional Tests and Regression tests'),
(3, 'Perf and Load Tests'),
(3, 'Security Tests'),
(4, 'Scripted Deployments'),
(4, 'Uniform deployment scripts across environments'),
(4, 'Roll Back Mechanism'),
(4, 'Automated Provisioning'),
(4, 'Automated Scaling based on metrics'),
(5, 'Build and Deploy infra seperated from app envs'),
(5, 'All app envs monitored for key metrics'),
(5, 'Supporting Infra monitored'),
(5, 'Application Monitoring'),
(5, 'Testing in Production'),
(6, 'Strong Team'),
(6, 'Quality output'),
(6, 'Collective responsibility'),
(6, 'Product Ownership'),
(6, 'Business drivers');



INSERT INTO `question` (`subcategory_id`, `question`) VALUES
(1, 'Is there a well-defined general coding practice for namespaces, functions and variable names?'),
(1, 'Is there any kind of code style enforcement tool being utilized?'),
(1, 'Is there effective auditing of files changed in the source control?'),
(1, 'Are patterns & practices established for code reuse?'),
(1, 'Are there any guidelines for doing code reviews?'),
(1, 'Is there a well defined and thorough check-in process which includes quality checks?'),
(1, 'Does your team make use of quality metrics reporting to improve code & process?'),
(1, 'Are there standards in place for writing secure code?'),
(2, 'How many long-lived branches you have at a given point of time?'),
(2, 'Does the source repository structure and permissions allow for parallel development?'),
(2, 'Is all code managed through a source control system that provides adequate functionality such as performance, availablity, and features?'),
(3, 'Do you have any version control mechanisms for your databases?'),
(3, 'Does your database source control structure match the branching and merging plans of your application code?'),
(4, 'Application environment definitions is maintained in source control?'),
(4, 'Is there any automated process to deploy your infrastructure changes?'),
(5, 'Do you maintain the build infrastructure definitions in source control?'),
(5, 'Are build/release/deploy job configs versioned?'),
(6, 'Does the build process involve any manual intervention?'),
(6, 'Is there a consistent labeling policy?'),
(6, 'Are deployment packages introduced early in testing similar to how the application is being deployed to production?'),
(6, 'Build scripts can take care of all kinds of releases(major, minor, hotfixes etc)'),
(6, 'Is there a retention policy for all your builds?'),
(6, 'Do you have a person responsible for managing the builds to make sure they are kept up to date as the application evolves?'),
(7, 'Are builds being triggered by changes in code base?'),
(7, 'Are builds being triggered by changes in infrastructure?'),
(7, 'Is there effective auditing of who makes changes to build system?'),
(7, 'Are Build failures triggering a notification or failed build that is addressed by the Developers?'),
(7, 'Do you have automated builds of your database schema?'),
(8, 'Are you running static code analysis during automated builds?'),
(8, 'Are there standards for code coverage of tests?'),
(8, 'Are you failing the builds if the code quality is below a certain threshold?'),
(8, 'Are unit test failures measured and addressed?'),
(9, 'Does the build produce binaries that have a meaningful versioning scheme?'),
(9, 'Is there effective tracking of builds to source control versioning?'),
(10, 'Do you test the deployments at the earliest time possible?'),
(10, 'Do you run sanity checks/smoke tests of application in the dev environment as part of the CI process?'),
(11, 'Do you test individual schema elements of your database (Stored Procedures, Functions etc.) prior to deployment?'),
(11, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(11, 'Are test cases part of your application source code?'),
(12, 'Are automated integration tests used?'),
(12, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(12, 'How frequently you''re running integration tests?'),
(13, 'Is there any way to track tests back to requirements?'),
(13, 'Do test plans consider the simulation of different user environments?'),
(13, 'Are the test entry and exit criteria well defined and evaluated?'),
(13, 'Have the areas of greatest risk been identified and tests prioritized accordingly?'),
(13, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(13, 'Do you have a repeatable data set for testing?'),
(13, 'Do you run database tests against production data or representative production data?'),
(13, 'Can tests be run in parallel?'),
(14, 'Are there appropriate tools available to perform automated testing?'),
(14, 'Are these tests run on environments which are most production-like?'),
(14, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(15, 'Are the testing environments \"production like\" in configuration?'),
(15, 'Are testing failures triggering a notification or failed build that is addressed by the Developers?'),
(15, 'Are Access Control tests Performed?'),
(15, 'Are Authentication checks performed?'),
(15, 'Is the Data Protected?'),
(15, 'Is Input Validation performed? If yes, is it server side or client side using some Javascript.'),
(16, 'Is the overall Infrastructure Architecture well understood by the developers and testers?'),
(16, 'Do you have a deployment pipeline in place?'),
(16, 'Is a self containing, single portable application package used throughout the deployment process?'),
(17, 'Is production the starting point for automated deployments of the application and database?'),
(17, 'Are Operation Guides and Troubleshooting Guides being produced and under version control?'),
(17, 'Is the deployment mechanism uniform across all environments?'),
(18, 'Do you have rollback mechanism?'),
(18, 'Is the Roll Back mechanism tested as part of the Deployment process?'),
(19, 'Are servers and all other resources required to create the application infrastructure provisioned automatically?'),
(19, 'Are you using any configuration management tool?'),
(19, 'Can production environments be easily recreated?'),
(20, 'Does your infrastructure supports auto-scaling?'),
(20, 'Scalability automation - can servers be added or removed from a cluster with no service interruption?'),
(21, 'Is a disaster recovery process in place?'),
(21, 'Do you monitor your build and deployment infrastructure?'),
(21, 'Do you monitor all your environments?'),
(22, 'Are application metrics for all environments tracked in a central dashboard?'),
(22, 'Does your source control and ALM system have an appropriate level of service level agreement (SLA) to ensure minimal impact for development teams in the event of a any single point of failure?'),
(22, 'Are you getting alerting and notifications based on application performance and errors events?'),
(22, 'Is the server infrastructure monitored? (CPU, Memory, I/O, etc)'),
(23, 'Application diagnostics â€“ is detailed diagnostics captured on application faults including performance, memory utilization and errors?'),
(23, 'Application diagnostics â€“ is detailed code level execution diagnostics captured in production and can be passed to developers?'),
(24, 'Do you have backup mechanisms for the supporting infra?'),
(24, 'Are you doing application performance monitoring in your production?'),
(24, 'Are you capturing user telemetry data?'),
(25, 'Do you perform monkey tests?'),
(25, 'Are you performing A/B testing?'),
(26, 'All expertise is within the team?'),
(26, 'Team values each others opinions?'),
(26, 'Team members are aware of each others work?'),
(26, 'Team members hold each other accountable'),
(27, 'Is pair programming effective?'),
(27, 'Do you follow test driven development?'),
(27, 'Does the team practice behavior driven development?'),
(27, 'Is Definition of Done(DoD) defined and deliverable\'s are accepted based on the DoD?'),
(27, 'Are bugs fixed immediately?'),
(27, 'Improvement points are identified every sprint and worked upon frequently'),
(28, 'Team believes in collective code ownership?'),
(28, 'Team stop the line on a build/test failure?'),
(28, 'Team can take decisions on design of application themselves?'),
(28, 'Team ensures information is radiated to the stakeholders on every sprint activity'),
(29, 'Do you have all the necessary authorizations and access permissions for performing deployments of all components?'),
(29, 'Is a release time-frame well defined?'),
(29, 'Release decisions are based on metrics'),
(29, 'Team is supremely confident of the products release'),
(29, 'Team ensures information related to the product radiated to the stakeholders'),
(30, 'End user feedback is highly valued and considered as part of the development process'),
(30, 'Business relies on team\'s suggestions for product improvements');

INSERT INTO options ( qid, display, weightage ) SELECT  id, 'Yes', 2 FROM    question;
INSERT INTO options ( qid, display, weightage ) SELECT  id, 'No',  0 FROM    question;
INSERT INTO options ( qid, display, weightage ) SELECT  id, 'Partial',  1 FROM    question;
INSERT INTO options ( qid, display, weightage ) SELECT  id, 'N/A',  -1 FROM    question;

/* Anti patterns begin */
UPDATE options set weightage = 0 where qid in(
select id from question where
question in (
'Does the build process involve any manual intervention?',
'Are Operation Guides and Troubleshooting Guides being produced and under version control?',
'Do you have a person responsible for managing the builds to make sure they are kept up to date as the application evolves?',
'Is production the starting point for automated deployments of the application and database?'))
and display = 'Yes';

UPDATE options set weightage = 2 where qid in(
select id from question where
question in (
'Does the build process involve any manual intervention?',
'Are Operation Guides and Troubleshooting Guides being produced and under version control?',
'Do you have a person responsible for managing the builds to make sure they are kept up to date as the application evolves?',
'Is production the starting point for automated deployments of the application and database?'))
and display = 'No';
/*Anti pattern end*/

/* Display customisation begin*/

UPDATE options set display = '1 to 2' where qid in(
select id from question where
question in (
'How many long-lived branches you have at a given point of time?'))
and display = 'Yes';
UPDATE options set display = '3 to 5', weightage = 1 where qid in(
select id from question where
question in (
'How many long-lived branches you have at a given point of time?'))
and display = 'No';
UPDATE options set display = 'greater than 5', weightage = 0 where qid in(
select id from question where
question in (
'How many long-lived branches you have at a given point of time?'))
and display = 'Partial';


UPDATE options set display = 'Daily' where qid in(
select id from question where
question in (
'How frequently you''re running integration tests?'))
and display = 'Yes';
UPDATE options set display = 'Weekly', weightage = 1 where qid in(
select id from question where
question in (
'How frequently you''re running integration tests?'))
and display = 'No';
UPDATE options set display = 'Monthly', weightage = 0 where qid in(
select id from question where
question in (
'How frequently you''re running integration tests?'))
and display = 'Partial';

/* Display customisation end*/