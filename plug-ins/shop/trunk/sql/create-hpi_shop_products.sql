-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-7
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 09, 2008 at 05:30 PM
-- Server version: 5.0.32
-- PHP Version: 5.2.0-8+etch11
-- 
-- Database: `rag_saul_dev_msh`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `hpi_shop_products`
-- 

CREATE TABLE `hpi_shop_products` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `added` datetime NOT NULL,
	  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
	  `description` text character set utf8 collate utf8_roman_ci NOT NULL,
	  `product_category_id` int(10) unsigned NOT NULL,
	  `supplier_id` int(10) unsigned NOT NULL,
	  `product_brand_id` int(10) unsigned NOT NULL,
	  `stock_level` int(10) unsigned NOT NULL,
	  `use_stock_level` enum('yes','no') character set utf8 collate utf8_roman_ci NOT NULL default 'no',
	  `stock_buffer_level` int(10) unsigned NOT NULL,
	  `status` enum('hide','display') NOT NULL default 'hide',
	  `sort_order` int(10) unsigned NOT NULL,
	  `plu_code` varchar(255) NOT NULL,
	  `style_id` varchar(255) NOT NULL,
	  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

