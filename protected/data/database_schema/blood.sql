-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2012 at 03:58 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blood`
--

-- --------------------------------------------------------

--
-- Table structure for table `bd_admins`
--

DROP TABLE IF EXISTS `bd_admins`;
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

-- --------------------------------------------------------

--
-- Table structure for table `bd_bleed_history`
--

DROP TABLE IF EXISTS `bd_bleed_history`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `bd_donors`
--

DROP TABLE IF EXISTS `bd_donors`;
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

-- --------------------------------------------------------

--
-- Table structure for table `bd_donor_contacts`
--

DROP TABLE IF EXISTS `bd_donor_contacts`;
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

-- --------------------------------------------------------

--
-- Table structure for table `bd_requests`
--

DROP TABLE IF EXISTS `bd_requests`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


SET FOREIGN_KEY_CHECKS=1;
