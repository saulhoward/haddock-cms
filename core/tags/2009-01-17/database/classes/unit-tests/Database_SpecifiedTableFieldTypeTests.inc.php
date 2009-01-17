<?php
/**
 * Database_SpecifiedTableFieldTypeTests
 *
 * @copyright 2008-06-13, RFI
 */

class
	Database_SpecifiedTableFieldTypeTests
extends
	UnitTests_UnitTests
{
	private static function
		get_field_types()
	{
		return array(
			'id' => 'int(10) unsigned',
			'remote_addr' => 'varchar(255)',
			'session_id' => 'varchar(255)',
			'visited' => 'datetime',
			'request_uri' => 'text',
			'http_referer' => 'text',
			'http_user_agent' => 'text',
			'referer_domain_id' => 'int(10) unsigned',
		);
	}
	
	public static function
		test_field_types_can_be_stored()
	{
		$field_types = self::get_field_types();
		
		$specified_table = new Database_SpecifiedTable('ps_foo_bar');
		
		foreach (
			array_keys($field_types)
			as
			$key
		) {
			$specified_table->add_field_type(
				$key,
				$field_types[$key]
			);
		}
		
		/*
		 * Test that they went in.
		 */
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
				return FALSE;
			}
		}
		
		return TRUE;
	}
}
?>