<?php
/**
 * HaddockProjectOrganisation_ProjectInformationTests
 *
 * @copyright 2008-05-30, RFI
 */

class
	HaddockProjectOrganisation_ProjectInformationTests
extends
	UnitTests_UnitTests
{
	private static function
		run_pih_test_for_rv_and_no_pins_exception(
			$function_name
		)
	{
		try {
			$var
				= call_user_func(
					array(
						'HaddockProjectOrganisation_ProjectInformationHelper',
						$function_name
					)
				);
			
			return isset($var) && strlen($var) > 0;
		} catch (HaddockProjectOrganisation_ProjectInformationNotSetException $e) {
			return FALSE;
		}
		
		return FALSE;
	}
	
	public static function
		test_project_has_name()
	{
		return self::run_pih_test_for_rv_and_no_pins_exception('get_name');
	}
	
	public static function
		test_project_has_copyright_holder()
	{
		return self::run_pih_test_for_rv_and_no_pins_exception('get_copyright_holder');
	}
	
	public static function
		test_project_has_title()
	{
		return self::run_pih_test_for_rv_and_no_pins_exception('get_title');
	}
	
	public static function
		test_project_has_version_code()
	{
		return self::run_pih_test_for_rv_and_no_pins_exception('get_version_code');
	}
	
	public static function
		test_project_has_camel_case_root()
	{
		return self::run_pih_test_for_rv_and_no_pins_exception('get_camel_case_root');
	}
}
?>