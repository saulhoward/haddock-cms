-- 
-- Table structure for table `hpi_shop_comments`
-- 

CREATE TABLE `hpi_shop_comments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL,
  `comment` text character set utf8 collate utf8_roman_ci NOT NULL,
  `commenter_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `ip` varchar(255) NOT NULL,
  `sort_order` int(10) unsigned NOT NULL,
  `status` enum('new','moderation','spam','accepted') NOT NULL default 'new',
  `front_page` enum('no','yes') NOT NULL default 'no',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

