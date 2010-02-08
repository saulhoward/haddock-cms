<?php
/**
 * PublicHTML_ServerAddressTests
 *
 * @copyright 2008-06-01, RFI
 */

class
	PublicHTML_ServerAddressTests
extends
	UnitTests_UnitTests
{
	public static function
		test_server_address_is_set()
	{
		$server_address
			= PublicHTML_ServerAddressesHelper
				::get_server_address();
		
		return isset($server_address);
	}
	
	public static function
		test_server_address_is_not_zero_length()
	{
		$server_address
			= PublicHTML_ServerAddressesHelper
				::get_server_address();
		
		return strlen($server_address) > 0;
	}
	
	public static function
		test_server_address_has_trailing_slash()
	{
		$server_address
			= PublicHTML_ServerAddressesHelper
				::get_server_address();
		
		return preg_match('{/$}', $server_address);
	}
}
?>