<?php
/**
 * MailingList_InvalidEmailException
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
    MailingList_InvalidEmailException
extends
    Database_InvalidUserInputException
{
    public function
        __construct($email)
    {
        parent::__construct("\"$email\" is not a valid email address!");
    }
}
?>
