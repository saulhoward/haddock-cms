-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 02, 2007 at 11:33 PM
-- Server version: 5.0.24
-- PHP Version: 5.2.0
-- 
-- Database: `d_sas_a`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `types`
-- 

CREATE TABLE types (
  id int(10) unsigned NOT NULL auto_increment,
  types varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
