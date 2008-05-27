<?php
/**
 * CLIScripts_UserInterrogationHelper
 *
 * @copyright 2008-05-27, RFI
 */

class
	CLIScripts_UserInterrogationHelper
{
	public static function
		get_validated_input(
			$question,
			InputValidation_Validator $validator
		)
	{
		while (TRUE) {
			try {
				echo $question;
				
				$answer = trim(fgets(STDIN));
				
				if ($validator->validate($answer)) {
					return $answer;
				}
			} catch (InputValidation_InvalidInputException $e) {
				echo $e->getMessage() . PHP_EOL;
				
				continue;
			}
		}
	}
}
?>