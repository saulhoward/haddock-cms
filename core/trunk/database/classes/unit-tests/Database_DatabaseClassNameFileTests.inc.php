<?php
/**
 * Database_DatabaseClassNameFileTests
 *
 * @copyright 2007-03-21, RFI
 */

#require_once PROJECT_ROOT
#	. '/haddock/unit-tests/classes/'
#	. 'UnitTests_UnitTests.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/'
#	. 'Database_DatabaseClassNameFile.inc.php';
	
class
	Database_DatabaseClassNameFileTests
extends
	UnitTests_UnitTests
{    
	private static function
		get_sample_file()
	{
		return
			new Database_DatabaseClassNameFile(
				PROJECT_ROOT
					. '/haddock/database/classes/unit-tests/test-files/'
					. 'brighton-wok-2007-03-21.txt'
			);
	}
	
	public static function
		test_has_database_class_file_returns_true()
	{
		$sample_file = self::get_sample_file();
		
		#print_r($sample_file);
		
		return $sample_file->has_database_class_file() == TRUE;
	}
	
	public static function
		test_has_database_renderer_class_file_returns_true()
	{
		$sample_file = self::get_sample_file();
			
		return $sample_file->has_database_renderer_class_file() == TRUE;
	}
}
?>