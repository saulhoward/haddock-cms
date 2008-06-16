-- Delta file for the Protx Payments module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE IF NOT EXISTS `hpi_protx_payments_transactions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL,
  `session_id` int(10) NOT NULL,
  `status` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `status_detail` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `vendor_tx_code` int(10) unsigned NOT NULL,
  `vps_tx_id` int(10) unsigned NOT NULL,
  `tx_auth_no` int(10) unsigned NOT NULL,
  `amount` varchar(255) NOT NULL,
  `AVSCV2` varchar(255) NOT NULL,
  `address_result` varchar(255) NOT NULL,
  `postcode_result` varchar(255) NOT NULL,
  `CV2_result` varchar(255) NOT NULL,
  `gift_aid` varchar(255) NOT NULL,
  `3D_secure_status` varchar(255) NOT NULL,
  `CAVV` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
