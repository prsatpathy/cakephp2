-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2013 at 08:49 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cakephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `lft`, `rght`, `name`) VALUES
(27, 0, 1, 32, 'Main Menu'),
(28, 27, 2, 11, 'Web Development'),
(29, 27, 12, 17, 'Web Design'),
(30, 35, 8, 9, 'Zend'),
(31, 27, 18, 25, 'Cooking'),
(32, 31, 19, 20, 'Cuisines'),
(33, 31, 21, 22, 'Snaks'),
(34, 28, 3, 4, 'PHP'),
(35, 28, 5, 10, 'Frameworks'),
(36, 31, 23, 24, 'Beverages'),
(37, 29, 13, 14, 'Photoshop'),
(38, 29, 15, 16, 'Flash'),
(39, 35, 6, 7, 'cakePHP'),
(40, 27, 26, 31, 'Friends'),
(41, 40, 27, 28, 'Rachel'),
(42, 40, 29, 30, 'Rubil');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `link` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `link`, `description`, `is_active`, `created`, `modified`) VALUES
(1, 'OrangeScrum', 'https://www.orangescrum.com/', 'OrangeScrum is A project collaboration tool that gives you full visibility and control over your projects. It is a  agile project management tool for team collaboration, ticketing system,  project tracker and a discussion board for team work.', 1, '2013-04-19 00:00:00', '2013-04-19 00:00:00'),
(2, 'OrangeGigs', 'http://www.orangegigs.com/', 'Orangegigs is a place where mobile application developer can list their profile and mobile development companies can also add their jobs. It is basically a mobile application developer directory.', 1, '2013-04-19 00:00:00', '2013-04-19 00:00:00'),
(3, 'Andolasoft.com', 'http://www.andolasoft.com/', 'Ruby on Rails Development | CakePHP Development | Android and iPhone Application Development', 1, '2013-04-19 00:00:00', '2013-04-19 00:00:00'),
(4, 'KurrentJobs', 'http://www.kurrentjobs.com/', 'Kurrentjobs is a job Board that enables companies and individual recruiters to post technical jobs such as Ruby on Rails Jobs and mobile software developer jobs.', 1, '2013-04-19 00:00:00', '2013-04-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

DROP TABLE IF EXISTS `project_users`;
CREATE TABLE IF NOT EXISTS `project_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `project_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 4),
(5, 4, 1),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `fb_id` varchar(100) NOT NULL,
  `twitter_id` varchar(100) NOT NULL,
  `linkedin_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `fb_id`, `twitter_id`, `linkedin_id`) VALUES
(1, 'test@andolasoft.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'John Wedo', '', '', ''),
(2, 'test@andolasoft.co.in', 'cc03e747a6afbbcbf8be7668acfebee5', 'Will Smith', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
