<?php
/**
 * FileSystem_DirectoryClassesHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	FileSystem_DirectoryClassesHelper
{
	public static function
		create_directory_class(
			$new_directory_class_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$directory_classes_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'file-system'
				. DIRECTORY_SEPARATOR . 'directories';
		
		echo '$directory_classes_directory_name: ' . $directory_classes_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($directory_classes_directory_name);
		
		$directory_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_directory_class_name . 'Directory';
		
		echo '$directory_class_name: ' . $directory_class_name . PHP_EOL;
		
		$directory_class_file_name
			= $directory_classes_directory_name
				. DIRECTORY_SEPARATOR
				. $directory_class_name . '.inc.php';
		
		echo '$directory_class_file_name: ' . $directory_class_file_name . PHP_EOL;
		
		if (is_file($directory_class_file_name)) {
			throw new ErrorHandling_SprintfException(
				'\'%s\' already exists!',
				array(
					$directory_class_file_name
				)
			);
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $module_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $directory_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$directory_class_name
extends
	FileSystem_Directory
{
	/*
	 * Write code here.
	 */
}
?>
CNT;

			if ($fh = fopen($directory_class_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
	}
}
?>