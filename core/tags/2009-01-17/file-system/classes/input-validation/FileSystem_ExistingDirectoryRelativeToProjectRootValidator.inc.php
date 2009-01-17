<?php
/**
 * FileSystem_ExistingDirectoryRelativeToProjectRootValidator
 *
 * @copyright 2008-06-02, RFI
 */

/**
 * Used to check that a given string is the name of directory
 * relative to the project root.
 */
class
	FileSystem_ExistingDirectoryRelativeToProjectRootValidator
extends
	InputValidation_Validator
{
	public function
		validate($directory_name)
	{
		#return
		#	$this->validate_pattern(
		#		$directory_name,
		#		'',
		#		'The directory must exist and be relative to the project root!'
		#	);
		if (!is_dir(PROJECT_ROOT . DIRECTORY_SEPARATOR . $directory_name)) {
			throw new InputValidation_InvalidInputException(
				sprintf(
					"'%s' is not an exisiting directory relative to the project root!",
					$directory_name
				)
			);            
		}
		
		return TRUE;
	}
}
?>