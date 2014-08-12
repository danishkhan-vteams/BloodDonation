-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2012 at 10:53 PM
-- Server version: 5.5.27-1~dotdeb.0
-- PHP Version: 5.3.17-1~dotdeb.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `donors`
--

-- --------------------------------------------------------

--
-- Table structure for table `bd_admins`
--

CREATE TABLE IF NOT EXISTS `bd_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `notes` text,
  `blood_group` enum('AB+','AB-','O+','O-','A+','A-','B+','B-','Unknown') NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_by` int(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified_by` int(5) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bd_admins`
--

INSERT INTO `bd_admins` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `notes`, `blood_group`, `is_active`, `created_by`, `created`, `modified_by`, `modified`) VALUES
(1, 'Admin', 'Sample', 'admin', 'a01d13f4302bda7f653d26f9358c0e53cb9a99b2e529f4fe55810fe172a2b6eb', 'bloodadmin@nxb.com.pk', '', '', 1, 1, '2012-01-16 19:58:51', 1, '2012-01-23 12:45:59'),
(2, 'Muhammad Danish', 'Khan', 'mdkhan', 'danish', 'mdkhan@yahoo.com', 'hello how are you?', '', 1, 1, '2012-01-18 02:02:29', 1, '2012-01-18 02:02:29'),
(3, '2nd admin', 'admin', 'admin2', 'a01d13f4302bda7f653d26f9358c0e53cb9a99b2e529f4fe55810fe172a2b6eb', 'mdkhan2@yahoo.com', '', '', 1, 1, '2012-01-20 02:20:22', 1, '2012-01-23 02:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `bd_bleed_history`
--

CREATE TABLE IF NOT EXISTS `bd_bleed_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_id` int(11) NOT NULL,
  `bleed_date` datetime NOT NULL,
  `notes` varchar(255) NOT NULL,
  `bleed_stamp` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bd_bleed_history`
--

INSERT INTO `bd_bleed_history` (`id`, `donor_id`, `bleed_date`, `notes`, `bleed_stamp`, `created_by`, `created`, `modified_by`, `modified`) VALUES
(1, 1, '2012-01-16 12:00:00', 'sample', '2012-01-26 01:23:59', 0, '0000-00-00 00:00:00', 1, '2012-01-26 01:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `bd_donors`
--

CREATE TABLE IF NOT EXISTS `bd_donors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `blood_group` enum('AB+','AB-','O+','O-','A+','A-','B+','B-','Unknown') NOT NULL DEFAULT 'Unknown',
  `notes` text,
  `is_admin` tinyint(4) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_by` int(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified_by` int(5) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bd_donors`
--

INSERT INTO `bd_donors` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `blood_group`, `notes`, `is_admin`, `is_verified`, `is_active`, `created_by`, `created`, `modified_by`, `modified`) VALUES
(1, 'Muhammad Danish', 'Khan', 'danish@nxb.com.pk', 'admin', '613fa7ada0c826b8fd4434b464109b2c41f66b7b62c9b8023526f8554cf86eed', 'B-', '', 1, 1, 1, 1, '2012-01-23 04:50:38', 1, '2012-01-26 11:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `bd_donor_contacts`
--

CREATE TABLE IF NOT EXISTS `bd_donor_contacts` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `donor_id` int(10) unsigned NOT NULL,
  `contact_type` enum('Email','Phone','Cell') NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `ext` int(5) unsigned DEFAULT NULL,
  `created_by` int(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified_by` int(5) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bd_donor_contacts`
--

INSERT INTO `bd_donor_contacts` (`id`, `donor_id`, `contact_type`, `contact_number`, `ext`, `created_by`, `created`, `modified_by`, `modified`) VALUES
(1, 1, 'Email', 'danish@vteams.com', 0, 0, '2012-01-23 04:50:38', 1, '2012-01-26 11:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `bd_requests`
--

CREATE TABLE IF NOT EXISTS `bd_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `blood_group` enum('AB+','AB-','O+','O-','A+','A-','B+','B-','Unknown') NOT NULL,
  `bleed_date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `pickup` tinyint(1) NOT NULL,
  `notes` text NOT NULL,
  `is_report_sent` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bd_requests`
--

INSERT INTO `bd_requests` (`id`, `full_name`, `email`, `phone`, `blood_group`, `bleed_date`, `location`, `pickup`, `notes`, `is_report_sent`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'ABC', 'abc@yahoo.com', 45646546, 'AB+', '2012-01-02 12:00:00', 'Lahore', 1, 'great notes', 1, '2012-01-27 03:19:31', 1, '2012-01-27 03:19:31', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
