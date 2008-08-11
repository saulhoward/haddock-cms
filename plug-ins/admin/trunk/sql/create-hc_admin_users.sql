-- 
-- Table structure for table `hc_admin_users`
-- 
-- © Clear Line Web Design, 2007-08-20

CREATE TABLE `hc_admin_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `type` enum('Developer','Admin','User') NOT NULL default 'User',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
