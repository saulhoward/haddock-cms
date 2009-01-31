<?php
/**
 * Database_HostNameValidatorTests
 *
 * @copyright 2008-05-27, RFI
 */

class
	Database_HostNameValidatorTests
extends
	UnitTests_UnitTests
{
	public static function
		test_validator_does_not_accept_zero_length_string()
	{
		$validator = new Database_HostNameValidator();
		
		try {
			return !$validator->validate('');
		} catch (InputValidation_InvalidInputException $e) {
			return TRUE;
		}
	}
	
	public static function
		test_validator_accepts_localhost()
	{
		$validator = new Database_HostNameValidator();
		
		try {
			return $validator->validate('localhost');
		} catch (InputValidation_InvalidInputException $e) {
			return FALSE;
		}
	}
	
	public static function
		test_validator_accepts_127_0_0_1()
	{
		$validator = new Database_HostNameValidator();
		
		try {
			return $validator->validate('127.0.0.1');
		} catch (InputValidation_InvalidInputException $e) {
			return FALSE;
		}
	}
	
	public static function
		test_validator_accepts_random_numeric_ip_v4()
	{
		$validator = new Database_HostNameValidator();
		
		try {
			$ip_string = '';
			
			for ($i = 0; $i < 4; $i++) {
				if ($i > 0) {
					$ip_string .= '.';
				}
				
				$ip_string .= rand(0, 255);
			}
			
			return $validator->validate($ip_string);
		} catch (InputValidation_InvalidInputException $e) {
			return FALSE;
		}
	}
	
	#public static function
	#	test_validator_does_not_accept_malformed_ip_v4()
	#{
	#	$validator = new Database_HostNameValidator();
	#	
	#	try {
	#		return !$validator->validate('127.0.');
	#	} catch (InputValidation_InvalidInputException $e) {
	#		return TRUE;
	#	}
	#}
	
	public static function
		test_validator_accepts_domain_name()
	{
		$validator = new Database_HostNameValidator();
		
		try {
			return $validator->validate('foobar.com');
		} catch (InputValidation_InvalidInputException $e) {
			return FALSE;
		}
	}
}
?>