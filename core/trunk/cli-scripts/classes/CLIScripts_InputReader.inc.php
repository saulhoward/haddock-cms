<?php
/**
 * CLIScripts_InputReader
 *
 * @copyright 2007-07-12, RFI
 */

/**
 * DEPRECATED!
 *
 * Move to CLIScripts_UserInterrogationHelper
 */
class
	CLIScripts_InputReader
{
	public function
		__construct()
	{
	}
	
	public static function
		get_choice_from_string(
			$choices_str,
			$delimiter = ' '
		)
	{
		$choices = explode($delimiter, $choices_str);
		
		return self::get_choice_from_string_array($choices);
	}
	
	public static function
		get_choice_from_string_array(
			$choices
		)
	{
		#while (TRUE) {
		#	echo "Please choose: \n";
		#	
		#	for ($i = 0; $i < count($choices); $i++) {
		#		echo "$i) " . $choices[$i] . "\n";
		#	}
		#	
		#	echo "Type \"b\" to go back.\n";
		#	
		#	$choice = trim(fgets(STDIN));
		#	
		#	if (preg_match('/b/i', $choice)) {
		#		return NULL;
		#	}
		#	
		#	if (preg_match('/^\d+$/', $choice)) {
		#		if (($choice >= 0) and ($choice < count($choices))) {
		#			return $choices[$choice];
		#		} else {
		#			echo "Out of range!\n";
		#		}
		#	} else {
		#		echo "Please enter a number!\n";
		#	}
		#}
		
		return
			CLIScripts_UserInterrogationHelper
				::get_choice_from_string_array($choices);
	}
	
	public static function
		ask_yes_no_question(
			$prompt = "Please answer (y)es or (n)o\n"
		)
	{
		while (TRUE) {
			$choice = trim(fgets(STDIN));
			
			if (preg_match('/^y(?:es)?$/i', $choice)) {
				return TRUE;
			}
			
			if (preg_match('/^n(?:o)?$/i', $choice)) {
				return FALSE;
			}
			
			echo $prompt;
		}
	}
	
	public static function
		get_validated_input(
			$question,
			InputValidation_Validator $validator
		)
	{
		#while (TRUE) {
		#	try {
		#		echo $question;
		#		
		#		$answer = trim(fgets(STDIN));
		#		
		#		if ($validator->validate($answer)) {
		#			return $answer;
		#		}
		#	} catch (InputValidation_InvalidInputException $e) {
		#		echo $e->getMessage() . "\n";
		#		
		#		continue;
		#	}
		#}
		
		return CLIScripts_UserInterrogationHelper
			::get_validated_input(
				$question,
				$validator
			);
	}
	
	public static function
		confirm_continue($action)
	{
		echo "\nPress \"ENTER\" to $action.\n";
		
		$continuation_confirmed = trim(fgets(STDIN));
		
		return $continuation_confirmed;
	}
}
?>