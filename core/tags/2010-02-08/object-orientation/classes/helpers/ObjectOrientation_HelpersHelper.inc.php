<?php
/**
 * ObjectOrientation_HelpersHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	ObjectOrientation_HelpersHelper
{
	public static function
		create_helper(
			$new_helper_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$helpers_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'helpers';
		
		#echo '$helpers_directory_name: ' . $helpers_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($helpers_directory_name);
		
		$helper_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_helper_name . 'Helper';
		
		#echo '$helper_class_name: ' . $helper_class_name . PHP_EOL;
		
		$helper_file_name
			= $helpers_directory_name
				. DIRECTORY_SEPARATOR
				. $helper_class_name . '.inc.php';
		
		#echo '$helper_file_name: ' . $helper_file_name . PHP_EOL;
		
		if (is_file($helper_file_name)) {
			throw new ErrorHandling_SprintfException(
				'\'%s\' already exists!',
				array(
					$helper_file_name
				)
			);
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $module_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $helper_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$helper_class_name
{
	/*
	 * Write public static functions here.
	 */
}
?>
CNT;

			if ($fh = fopen($helper_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
	}
}
?>