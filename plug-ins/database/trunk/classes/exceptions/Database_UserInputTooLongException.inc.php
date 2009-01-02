<?php
/**
 * Database_UserInputTooLongException
 *
 * @copyright Clear Line Web Design, 2007-07-18
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/exceptions/'
#    . 'Database_InvalidUserInputException.inc.php';

class
    Database_UserInputTooLongException
extends
    Database_InvalidUserInputException
{
    public function
        __construct($var_name, $max_length)
    {
        parent::__construct("Max $var_name length: $max_length characters!");
    }
}
?>
