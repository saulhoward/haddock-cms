<?php
/**
 * InputValidation_CLIInterrogator
 *
 * @copyright 2007-03-02, RFI
 */

/**
 * DEPRECATED!
 *
 * Move to CLIScripts_UserInputHelper
 */
class
	InputValidation_CLIInterrogator
{
	public function
		ask_required(
			$question,
			$validation_function = NULL
		)
	{   
		while (TRUE) {
			echo $question;
			$answer = trim(fgets(STDIN));
			
			if (isset($validation_function)) {
				try {
					call_user_func($validation_function, $answer);
					
					return $answer;
				} catch (InputValidation_InvalidInputException $e) {
					echo $e->getMessage() . "\n";
				}
			} else {
				return $answer;
			}
		}
	}
	
	public function
		ask_default(
			$question,
			$default,
			$validation_function = NULL
		)
	{
		while (TRUE) {
			echo $question;
			echo "[default: $default]\n";
			
			$answer = trim(fgets(STDIN));
			
			if (strlen($answer) == 0) {
				$answer = $default;
			}
			
			if (isset($validation_function)) {
				try {
					call_user_func($validation_function, $answer);
					
					return $answer;
				} catch (InputValidation_InvalidInputException $e) {
					echo $e->getMessage() . "\n";
				}
			} else {
				return $answer;
			}
		}
	}
	
	public function
		ask_options(
			$question,
			$options,
			$default_index = 0
		)
	{
		while (TRUE) {
			echo $question;
			
			for ($i = 0; $i < count($options); $i++) {
				echo ($i + 1) . ') ' . $options[$i] . "\n";
			}
			echo '[default: ' . $options[$default_index] . "]\n";
			
			$tmp = trim(fgets(STDIN));
			
			try {
				if (strlen($tmp) > 0) {
					if (is_numeric($tmp)) {
						if (
							($tmp >= 1)
							and
							($tmp <= count($options))
						) {
							return $options[$tmp -1];
						} else {
							throw new InputValidation_InvalidInputException(
								'Please enter a number between 1 and ' . count($options) . '!'
							);
						}
					} else {
						throw new InputValidation_InvalidInputException(
							'Please enter a number!'
						);
					}
				} else {
					return $options[$default_index];
				}
			} catch (InputValidation_InvalidInputException $e) {
				echo $e->getMessage() . "\n";
			}
		}
	}
}
?>