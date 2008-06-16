<?php
/**
 * HaddockProjectOrganisation_HaddockClassNameValidatorsHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	HaddockProjectOrganisation_HaddockClassNameValidatorsHelper
{
	public static function
		create_haddock_class_name_validator(
			$new_haddock_class_name_validator_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$input_validators_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'input-validation';
		
		echo '$input_validators_directory_name: ' . $input_validators_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($input_validators_directory_name);
		
		$input_validator_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_haddock_class_name_validator_name . 'ClassNameValidator';
		
		echo '$input_validator_class_name: ' . $input_validator_class_name . PHP_EOL;
		
		$input_validator_file_name
			= $input_validators_directory_name
				. DIRECTORY_SEPARATOR
				. $input_validator_class_name . '.inc.php';
		
		echo '$input_validator_file_name: ' . $input_validator_file_name . PHP_EOL;
		
		if (is_file($input_validator_file_name)) {
			throw new ErrorHandling_SprintfException(
				'\'%s\' already exists!',
				array(
					$input_validator_file_name
				)
			);
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $module_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $input_validator_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$input_validator_class_name
extends
	HaddockProjectOrganisation_HaddockClassNameValidator
{
	protected function
		get_class_name_stem()
	{
		return '$new_haddock_class_name_validator_name';
	}
}
?>
CNT;

			if ($fh = fopen($input_validator_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
	}
}
?>