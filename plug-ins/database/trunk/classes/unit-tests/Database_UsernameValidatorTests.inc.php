<?php
/**
 * Database_UsernameValidatorTests
 *
 * @copyright 2008-05-28, RFI
 */

class
	Database_UsernameValidatorTests
extends
	UnitTests_UnitTests
{
	public static function
		test_validator_does_not_accept_zero_length_string()
	{
		$validator = new Database_UsernameValidator();
		
		try {
			return !$validator->validate('');
		} catch (InputValidation_InvalidInputException $e) {
			return TRUE;
		}
	}
	
	public static function
		test_validator_accepts_un_with_numbers()
	{
		$validator = new Database_UsernameValidator();
		
		try {
			return $validator->validate('f0o_b4r');
		} catch (InputValidation_InvalidInputException $e) {
			return FALSE;
		}
	}
	
	public static function
		test_validator_does_not_accept_un_with_spaces()
	{
		$validator = new Database_UsernameValidator();
		
		try {
			return !$validator->validate('foo bar');
		} catch (InputValidation_InvalidInputException $e) {
			return TRUE;
		}
	}
	
	public static function
		test_validator_does_not_accept_un_with_upper_case()
	{
		$validator = new Database_UsernameValidator();
		
		try {
			return !$validator->validate('FooBar');
		} catch (InputValidation_InvalidInputException $e) {
			return TRUE;
		}
	}
}
?>