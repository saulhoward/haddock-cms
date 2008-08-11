<?php
/**
 * Database_DeltasTests
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	Database_DeltasTests
extends
	UnitTests_UnitTests
{
	public static function
		set_up()
	{
		/*
		 * Prepare the environment for each test in this class.
		 */
	}
	
	public static function
		tear_down()
	{
		/*
		 * Return the environment to a pristine state after
		 * each test in this class.
		 */
	}
	
	/*
	 * ----------------------------------------
	 * The tests.
	 * ----------------------------------------
	 */
	
	public static function
		test_all_delta_files_have_been_applied()
	{
		return Database_DeltaFilesHelper::count_unapplied_delta_files() == 0;
	}
}
?>