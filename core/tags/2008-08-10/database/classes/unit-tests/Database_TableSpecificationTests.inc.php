<?php
/**
 * Database_TableSpecificationTests
 *
 * @copyright 2008-06-12, RFI
 */

class
	Database_TableSpecificationTests
extends
	UnitTests_UnitTests
{
	public static function
		test_all_specified_tables_exist_in_db()
	{
		foreach (
			Database_TableSpecificationHelper
				::get_tables()
			as
			$specified_table
		) {
			if (
				!Database_DatabaseHelper
					::table_exists(
						$specified_table->get_name()
					)
			) {
				return FALSE;
			}
		}
		
		return TRUE;
	}
	
	public static function
		test_all_db_tables_exist_in_specification()
	{
		foreach (
			Database_DatabaseHelper
				::get_tables()
			as
			$db_table
		) {
			if (
				!Database_TableSpecificationHelper
					::table_exists(
						$db_table->get_name()
					)
			) {
				return FALSE;
			}
		}
		
		return TRUE;
	}

	public static function
		dtest_all_specified_fields_exist_in_db()
	{
		foreach (
			Database_TableSpecificationHelper
				::get_tables()
			as
			$specified_table
		) {
			$db_table
				= Database_DatabaseHelper
					::get_table($specified_table->get_name());
			
			foreach (
				$specified_table->get_fields()
				as
				$specified_field
			) {
				if (!$db_table->has_field($specified_field->get_name())) {
					return FALSE;
				}
			}
		}
		
		return TRUE;
	}

	public static function
		dtest_all_db_fields_exist_in_specification()
	{
		foreach (
			Database_DatabaseHelper
				::get_tables()
			as
			$db_table
		) {
			$specified_table
				= Database_TableSpecificationHelper
					::get_table($db_table->get_name());
					
			foreach (
				$db_table->get_fields()
				as
				$db_field
			) {
				if (!$specified_table->has_field($db_field->get_name())) {
					return FALSE;
				}
			}
		}
		
		return TRUE;
	}
	
	public static function
		dtest_all_specified_fields_have_correct_type_in_db()
	{
		foreach (
			Database_TableSpecificationHelper
				::get_tables()
			as
			$specified_table
		) {
			$db_table
				= Database_DatabaseHelper
					::get_table($specified_table->get_name());
					
			foreach (
				$specified_table->get_fields()
				as
				$specified_field
			) {
				$db_field
					= $db_table->get_field($specified_field->get_name());
				
				if ($db_field->get_type() != $specified_field->get_type()) {
					return FALSE;
				}
			}
		}
		
		return TRUE;
	}

	public static function
		dtest_all_db_fields_have_correct_type_in_specification()
	{
		foreach (
			Database_DatabaseHelper
				::get_tables()
			as
			$db_table
		) {
			$specified_table
				= Database_TableSpecificationHelper
					::get_table($db_table->get_name());
					
			foreach (
				$db_table->get_fields()
				as
				$db_field
			) {
				if (
					$db_field->get_type()
					!=
					$specified_table
						->get_field_type(
							$db_field->get_name()
						)
				) {
					return FALSE;
				}
			}
		}
		
		return TRUE;
	}
	
	public static function
		test_all_specified_indexes_exist_in_db()
	{
		return FALSE;
	}

	public static function
		test_all_db_indexes_exist_in_specification()
	{
		return FALSE;
	}
	
	public static function
		test_all_specified_indexes_have_correct_type_in_db()
	{
		return FALSE;
	}

	public static function
		test_all_db_indexes_have_correct_type_in_specification()
	{
		return FALSE;
	}
}
?>