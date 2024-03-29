<?php
/**
 * CLIScripts_UserInterrogationHelper
 *
 * @copyright 2008-05-27, Robert Impey
 */

/**
 * A collection of functons to do with interrogating a
 * user at the command line.
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
	
	/**
	 * A function to make getting a choice from a user at the CLI easy.
	 *
	 * @param array $choices An array of options for the user to choose from.
	 * @return string The option that the user chose.
	 */
	public static function
		get_choice_from_string_array(
			$choices
		)
	{
		while (TRUE) {
			echo "Please choose: \n";
			
			for ($i = 0; $i < count($choices); $i++) {
				echo "$i) " . $choices[$i] . "\n";
			}
			
			echo "Type \"b\" to go back.\n";
			
			$choice = trim(fgets(STDIN));
			
			if (preg_match('/b/i', $choice)) {
				return NULL;
			}
			
			if (preg_match('/^\d+$/', $choice)) {
				if (($choice >= 0) and ($choice < count($choices))) {
					return $choices[$choice];
				} else {
					echo "Out of range!\n";
				}
			} else {
				echo "Please enter a number!\n";
			}
		}
	}
}
?>