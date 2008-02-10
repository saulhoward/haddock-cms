<?php
/**
 * InputValidation_StringValidator
 *
 * @copyright Clear Line Web Design, 2007-03-02
 */

require_once PROJECT_ROOT
    . '/haddock/input-validation/classes/'
    . 'InputValidation_InvalidInputException.inc.php';

require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_ListOfWords.inc.php';
    
class
    InputValidation_StringValidator
{
    public function
        validate_length(
            $input,
            $field_name,
            $min_length = 1,
            $max_length = -1
        )
    {
        if (strlen($input) < $min_length) {
            $msg = "The $field_name must be at least $min_length character";
            
            if ($min_length > 1) {
                $msg .= 's';
            }
            
            $msg .= ' long!';
            
            throw new InputValidation_InvalidInputException($msg);
        }
        
        if ($max_length > 0) {
            if (strlen($input) > $max_length) {
                $msg = "The $field_name must be at most $max_length character";
                
                if ($max_length > 1) {
                    $msg .= 's';
                }
                
                $msg .= ' long!';
                
                throw new InputValidation_InvalidInputException($msg);
            }
        }
        
        return TRUE;
    }
    
    public function
        validate_alphanumeric(
            $input,
            $field_name,
            $ignore_leading_white_space = TRUE,
            $ignore_trailing_white_space = TRUE,
            $spaces = FALSE,
            $zero_lenghth_allowed = FALSE
        )
    {
        if (!$zero_lenghth_allowed) {
            $this->validate_length($input, $field_name, 1);
        }
        
        $regex = '/^';
        
        if ($ignore_leading_white_space) {
            $regex .= '\s*';
        }
        
        $regex .= '\w';
        
        $regex .= $zero_lenghth_allowed ? '*' : '+';
        
        if ($spaces) {
            $regex .= '(?:\s+\w+)*';
        }
        
        if ($ignore_trailing_white_space) {
            $regex .= '\s*';
        }
        
        $regex .= '$/';
        
        if (!preg_match($regex, $input)) {
            throw new InputValidation_InvalidInputException(
                "The $field_name must contain only alphanumeric characters or underscores!"
            );
        }
        
        return TRUE;
    }
    
    public function
        validate_alphanumeric_or_dashes(
            $input,
            $field_name,
            $ignore_leading_white_space = TRUE,
            $ignore_trailing_white_space = TRUE,
            $spaces = FALSE,
            $zero_lenghth_allowed = FALSE
        )
    {
        if (!$zero_lenghth_allowed) {
            $this->validate_length($input, $field_name, 1);
        }
        
        $regex = '/^';
        
        if ($ignore_leading_white_space) {
            $regex .= '\s*';
        }
        
        $regex .= '[-\w]';
        
        $regex .= $zero_lenghth_allowed ? '*' : '+';
        
        if ($spaces) {
            $regex .= '(?:\s+[-\w]+)*';
        }
        
        if ($ignore_trailing_white_space) {
            $regex .= '\s*';
        }
        
        $regex .= '$/';
        
        if (!preg_match($regex, $input)) {
            throw new InputValidation_InvalidInputException(
                "The $field_name must contain only alphanumeric characters, underscores or dashes!"
            );
        }
        
        return TRUE;
    }
    
    public function
        validate_in_array(
            $input,
            $array,
            $field_name
        )
    {
        if (!in_array($input, $array)) {
            $error_message = "The $field_name must be ";
            
            $options_l_o_w
                = Formatting_ListOfWords
                    ::get_list_of_words_for_string($array);
            
            $error_message
                .= $options_l_o_w
                    ->get_words_as_conjunction_list('or');
            
            throw new InputValidation_InvalidInputException($error_message);
        }
        
        return TRUE;
    }
}
?>
