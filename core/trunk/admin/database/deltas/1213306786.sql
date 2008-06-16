-- Delta file for the Admin module
-- 2008-06-12

-- Table structure for table `hc_admin_users`
-- 

CREATE TABLE `hc_admin_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `type` enum('Developer','Admin','User') NOT NULL default 'User',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
