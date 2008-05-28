<?php
/**
 * CLIScripts_ScriptObjectRunnersDirectoryTests
 *
 * @copyright 2008-05-27, RFI
 */

class
	CLIScripts_ScriptObjectRunnersDirectoryTests
extends
	UnitTests_UnitTests
{
	public static function
		test_bin_directory_is_not_accessible_on_server()
	{
		$ph_cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'haddock',
					'public-html'
				);
		
		$bin_directory_on_server = $ph_cm->get_server_address() . 'bin';
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $bin_directory_on_server);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		$out = curl_exec($ch);
		
		curl_close($ch);
		
		#echo $out;
		
		$lines = Strings_SplittingHelper::split_by_eol($out);
		
		if (
			preg_match(
				'{^HTTP/[\d.]+ (\d+)}',
				$lines[0],
				$matches
			)
		) {
			print_r($matches);
			
			$http_response_code = $matches[1];
			
			if ($http_response_code == 403) {
				/*
				 * The server returned the code for 'Forbidden'.
				 *
				 * see http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
				 */
				
				return TRUE;
			}
		}
		
		return FALSE;
	}
}
?>