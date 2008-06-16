-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_paypal_settings` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `paypal_account_email_address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
