<?php
/**
 * Database_PasswordsFileTests
 *
 * @copyright 2008-05-28, RFI
 */

class
	Database_PasswordsFileTests
extends
	UnitTests_UnitTests
{	
	public static function
		test_passwords_file_exists()
	{
		$passwords_file = Database_PasswordsFileHelper
			::get_passwords_file();
		
		return $passwords_file->exists();
	}
}
?>