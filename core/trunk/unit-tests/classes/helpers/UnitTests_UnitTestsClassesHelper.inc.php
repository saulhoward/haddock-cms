<?php
/**
 * UnitTests_UnitTestsClassesHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	UnitTests_UnitTestsClassesHelper
{
	public static function
		create_unit_tests_class(
			$new_unit_tests_class_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$unit_tests_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'unit-tests';
		
		#echo '$unit_tests_directory_name: ' . $unit_tests_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($unit_tests_directory_name);
		
		$unit_tests_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_unit_tests_class_name . 'Tests';
		
		#echo '$unit_tests_class_name: ' . $unit_tests_class_name . PHP_EOL;
		
		$unit_tests_class_file_name
			= $unit_tests_directory_name
				. DIRECTORY_SEPARATOR
				. $unit_tests_class_name . '.inc.php';
		
		#echo '$unit_tests_class_file_name: ' . $unit_tests_class_file_name . PHP_EOL;
		
		if (is_file($unit_tests_class_file_name)) {
			throw new ErrorHandling_SprintfException(
				'\'%s\' already exists!',
				array(
					$unit_tests_class_file_name
				)
			);
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $module_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $new_unit_tests_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$new_unit_tests_class_name
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
	
	/*
	 * Write public static test functions here.
	 */
}
?>
CNT;

			if ($fh = fopen($unit_tests_class_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
	}
}
?>