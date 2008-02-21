-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 02, 2007 at 11:33 PM
-- Server version: 5.0.24
-- PHP Version: 5.2.0
-- 
-- Database: 'd_sas_a'
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table 'dump_files'
-- 

CREATE TABLE dump_files (
  id int(10) unsigned NOT NULL auto_increment,
  dumped datetime NOT NULL,
  filename text NOT NULL,
  type_id int(10) unsigned NOT NULL,
  checksum varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
