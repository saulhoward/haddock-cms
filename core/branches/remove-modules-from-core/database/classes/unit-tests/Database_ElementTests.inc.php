<?php
/**
 * Database_ElementTests
 *
 * @copyright 2008-06-13, RFI
 */

class
	Database_ElementTests
extends
	UnitTests_UnitTests
{
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

SQL;

		mysql_query($stmt, $dbh);
	}
	
	public static function
		tear_down()
	{
		$dbh = Database_ConnectionsHelper::get_root_connection_using_cli();
		
		$stmt = <<<SQL
DROP TABLE hc_database_test_1;
SQL;

		mysql_query($stmt, $dbh);
	}
	
	/*
	 * ----------------------------------------
	 * The tests
	 * ----------------------------------------
	 */
	
	public static function
		test_table_element_is_fetchable()
	{
		$table = Database_DatabaseHelper::get_table('hc_database_test_1');
		
		return is_a($table, 'Database_Table');
	}
	
	public static function
		test_table_fields_are_correct_classes()
	{
		$table = Database_DatabaseHelper::get_table('hc_database_test_1');
		
		$field_classes = array(
			'id' => 'Database_IntField',
			'varchar_field' => 'Database_VarCharField',
			'float_field' => 'Database_FloatField',
			'decimal_field' => 'Database_DecimalField',
			'date_field' => 'Database_DateTimeField',
			'text_field' => 'Database_TextField',
			'foreign_key_id' => 'Database_IntField',
			'enum_field' => 'Database_EnumField',
		);
		
		foreach (
			array_keys($field_classes)
			as
			$key
		) {
			if (
				!is_a(
					$table->get_field($key),
					$field_classes[$key]
				)
			) {
				return FALSE;
			}
		}
		
		return TRUE;
	}
}
?>