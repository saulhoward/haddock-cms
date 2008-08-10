<?php
/**
 * PublicHTML_VHostTests
 *
 * @copyright 2008-05-28, RFI
 */

class
	PublicHTML_VHostTests
extends
	UnitTests_UnitTests
{	
	public static function
		test_vhost_is_reachable_on_server()
	{
//                $ph_cm
//                        = Configuration_ConfigManagerHelper
//                                ::get_config_manager(
//                                        'haddock',
//                                        'public-html'
//                                );
//                
//                $server_address = $ph_cm->get_server_address();

		$server_address
			= PublicHTML_ServerAddressesHelper
				::get_server_address();
		
	
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $server_address);
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
			
			#echo __METHOD__ . PHP_EOL;
			#echo "\$http_response_code: $http_response_code" . PHP_EOL;
			
			if (
				in_array(
					$http_response_code,
					explode(
						' ',
						'200 301 302'
					)
				)
			) {
				/*
				 * The server returned the code for 'OK', 'Moved Permanently'
				 * or 'Temp'.
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
