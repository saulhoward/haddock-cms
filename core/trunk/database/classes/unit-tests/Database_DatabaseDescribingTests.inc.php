<?php
/**
 * Database_DatabaseDescribingTests
 *
 * @copyright 2008-06-13, RFI
 */

class
	Database_DatabaseDescribingTests
extends
	UnitTests_UnitTests
{
	private static function get_table_specification_directory_name()
	{
		$temporary_directory = Environment_MachineHelper::get_temporary_directory();
		
		return
			$temporary_directory->get_name()
			. DIRECTORY_SEPARATOR . 'database-describing-tests';
	}
	
	public static function
		set_up()
	{
		$dbh = Database_ConnectionsHelper::get_root_connection_using_cli();
		
		$stmt = <<<SQL
CREATE TABLE `hc_database_test_1` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `varchar_field` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `float_field` float NOT NULL,
  `decimal_field` decimal(5,2) NOT NULL,
  `date_field` datetime NOT NULL,
  `text_field` text character set utf8 collate utf8_unicode_ci,
  `foreign_key_id` int(11) unsigned NOT NULL,
  `enum_field` enum('Yes','No') character set utf8 collate utf8_unicode_ci NOT NULL default 'No',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `hc_database_test_2` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `hc_database_test_3` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `foreign_key_id_1` int(11) unsigned NOT NULL,
  `foreign_key_id_2` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `f_k_1_2` (`foreign_key_id_1`,`foreign_key_id_2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

SQL;

		mysql_query($stmt, $dbh);
		
		FileSystem_DirectoryHelper
			::mkdir_parents(
				self::get_table_specification_directory_name()
			);
	}
	
	public static function
		tear_down()
	{
		$dbh = Database_ConnectionsHelper::get_root_connection_using_cli();
		
		$stmt = <<<SQL
DROP TABLE hc_database_test_1;
DROP TABLE hc_database_test_2;
DROP TABLE hc_database_test_3;
SQL;

		mysql_query($stmt, $dbh);
		
		FileSystem_DirectoryHelper
			::delete_recursively(
				self::get_table_specification_directory_name()
			);
	}
	
	/*
	 * The tests.
	 */
	
	public static function
		dtest_field_types_can_be_saved()
	{
		$table_specification_directory_name
			= self::get_table_specification_directory_name()
				. DIRECTORY_SEPARATOR . 'test_1';
		
		Database_TableSpecificationHelper
			::save_table_structure_in_directory(
				'hc_database_test_1',
				$table_specification_directory_name
			);
		
		$specified_table = Database_TableSpecificationHelper
			::save_table_structure_in_directory(
				$table_specification_directory_name
			);
		
		$field_types = self::get_field_types();
		
		foreach (
			array_keys($field_types)
			as
			$key
		) {
			if (
				$specified_table->get_field_type($key)
				!=
				$field_types[$key]
			) {
				return TRUE;
			}
		}
		
		return TRUE;
	}
}
?>