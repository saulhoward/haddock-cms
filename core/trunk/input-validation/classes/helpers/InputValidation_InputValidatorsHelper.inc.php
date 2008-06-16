<?php
/**
 * InputValidation_InputValidatorsHelper
 *
 * @copyright 2008-06-16, RFI
 */

class
	InputValidation_InputValidatorsHelper
{
	public static function
		create_input_validator(
			$new_input_validator_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$input_validators_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'input-validation';
		
		#echo '$input_validators_directory_name: ' . $input_validators_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($input_validators_directory_name);
		
		$input_validator_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_input_validator_name . 'Validator';
		
		#echo '$input_validator_class_name: ' . $input_validator_class_name . PHP_EOL;
		
		$input_validator_file_name
			= $input_validators_directory_name
				. DIRECTORY_SEPARATOR
				. $input_validator_class_name . '.inc.php';
		
		#echo '$input_validator_file_name: ' . $input_validator_file_name . PHP_EOL;
		
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
	InputValidation_Validator
{
	public function
		validate(\$string)
	{
		/*
		 * Write code here.
		 */
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
	
	public static function
		create_regex_validator(
			$new_regex_validator_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$input_validators_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'input-validation';
		
		#echo '$input_validators_directory_name: ' . $input_validators_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($input_validators_directory_name);
		
		$input_validator_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_regex_validator_name . 'Validator';
		
		#echo '$input_validator_class_name: ' . $input_validator_class_name . PHP_EOL;
		
		$input_validator_file_name
			= $input_validators_directory_name
				. DIRECTORY_SEPARATOR
				. $input_validator_class_name . '.inc.php';
		
		#echo '$input_validator_file_name: ' . $input_validator_file_name . PHP_EOL;
		
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
	InputValidation_RegexValidator
{
	protected function
		get_regex()
	{
		/*
		 * Write the regex here.
		 */
		return '/^$/';
	}
	
	protected function
		get_exception_message()
	{
		/*
		 * Write a more informative exception message here.
		 */
		return 'Regex validation error!';
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