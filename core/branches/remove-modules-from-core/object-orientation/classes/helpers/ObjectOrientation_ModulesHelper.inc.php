<?php
/**
 * ObjectOrientation_ModulesHelper
 *
 * @copyright 2008-05-29, RFI
 */

class
	ObjectOrientation_ModulesHelper
{
	public static function
		get_camel_case_module_root_of_object(
				$object
			)
	{
		$class_name = get_class($object);
		
		if (
			preg_match(
				'/^((?:[A-Z0-9][a-z0-9]*)+)_/',
				$class_name,
				$matches
			)
		) {
			$module_name = $matches[1];
			
			return $module_name;
		} else {
			throw
				new ErrorHandling_SprintfException(
					'Unable to parse the name of \'%s\'!',
					array(
						$class_name
					)
				);
		}
	}
}
?>