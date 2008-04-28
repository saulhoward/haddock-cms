<?php
/**
 * Templates_TemplateHelper
 *
 * @copyright 2008-04-29, RFI
 */

class
	Templates_TemplateHelper
{
	public static function
		expand_variables(
			$template,
			$variables
		)
	{
		$output = $template;
		
		ksort($variables);
		
		foreach ($variables as $key => $value) {
			$regex = '/\$\{' . $key . '\}/';
			
			#echo $regex;
			#exit;
			
			$output = preg_replace(
				$regex,
				$value,
				$output
			);
		}
		
		
		
		return $output;
	}
}
?>