<?php
/**
 * FileSystem_FileClassesHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	FileSystem_FileClassesHelper
{
	public static function
		create_file_class(
			$new_file_class_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$file_classes_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'file-system'
				. DIRECTORY_SEPARATOR . 'files';
		
		echo '$file_classes_directory_name: ' . $file_classes_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($file_classes_directory_name);
		
		$file_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_file_class_name . 'File';
		
		echo '$file_class_name: ' . $file_class_name . PHP_EOL;
		
		$file_class_file_name
			= $file_classes_directory_name
				. DIRECTORY_SEPARATOR
				. $file_class_name . '.inc.php';
		
		echo '$file_class_file_name: ' . $file_class_file_name . PHP_EOL;
		
		if (is_file($file_class_file_name)) {
			throw new ErrorHandling_SprintfException(
				'\'%s\' already exists!',
				array(
					$file_class_file_name
				)
			);
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $module_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $file_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$file_class_name
extends
	FileSystem_File
{
	/*
	 * Write code here.
	 */
}
?>
CNT;

			if ($fh = fopen($file_class_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
	}
}
?>