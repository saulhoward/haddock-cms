<?php
/**
 * FileSystem_FileNotFoundException
 *
 * @copyright 2008-05-30, RFI
 */

class
	FileSystem_FileNotFoundException
extends
	ErrorHandling_SprintfException
{
	public function
		__construct(
			$file_name,
			$error_message_format_string = NULL
		)
	{
		if (!isset($error_message_format_string)) {
			$error_message_format_string = '%f not found!';
		}
		
		parent
			::__construct(
				$error_message_format_string,
				array(
					$file_name
				)
			);
	}
}
?>