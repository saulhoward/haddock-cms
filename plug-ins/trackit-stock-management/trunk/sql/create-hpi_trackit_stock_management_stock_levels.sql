-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-7
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 08, 2008 at 08:09 PM
-- Server version: 5.0.32
-- PHP Version: 5.2.0-8+etch11
-- 
-- Database: `rag_saul_dev_msh`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `hpi_trackit_stock_management_stock_levels`
-- 

CREATE TABLE `hpi_trackit_stock_management_stock_levels` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `site_id` int(3) unsigned NOT NULL,
	  `site_suffix` varchar(255) NOT NULL,
	  `style_id` varchar(255) NOT NULL,
	  `product_id` varchar(15) character set ascii collate ascii_bin NOT NULL,
	  `size` varchar(20) character set ascii collate ascii_bin NOT NULL,
	  `colour` varchar(12) character set ascii collate ascii_bin NOT NULL,
	  `quantity` decimal(7,2) unsigned NOT NULL,
	  PRIMARY KEY  (`id`),
	  UNIQUE KEY `product` (`product_id`,`size`,`colour`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

