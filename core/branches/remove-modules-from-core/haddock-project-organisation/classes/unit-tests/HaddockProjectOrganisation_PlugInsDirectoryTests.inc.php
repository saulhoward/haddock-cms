<?php
/**
 * HaddockProjectOrganisation_PlugInsDirectoryTests
 *
 * @copyright 2008-05-28, RFI
 */

class
	HaddockProjectOrganisation_PlugInsDirectoryTests
extends
	UnitTests_UnitTests
{	
	public static function
		test_plug_ins_directory_is_not_accessible_on_server()
	{
		#$ph_cm
		#	= Configuration_ConfigManagerHelper
		#		::get_config_manager(
		#			'haddock',
		#			'public-html'
		#		);
		#
		#$plug_ins_directory_on_server
		#	= $ph_cm->get_server_address()
		#	. 'plug-ins';
		
		$plug_ins_directory_on_server
			= PublicHTML_ServerAddressesHelper
				::get_server_address()
			. 'plug-ins';
		
		#echo $plug_ins_directory_on_server . PHP_EOL;
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $plug_ins_directory_on_server);
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
			#print_r($matches);
			
			$http_response_code = $matches[1];
			
			if (
				in_array(
					$http_response_code,
					explode(
						' ',
						'403 404'
					)
				)
			) {
				/*
				 * The server returned the code for 'Forbidden' or 'Not Found'.
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