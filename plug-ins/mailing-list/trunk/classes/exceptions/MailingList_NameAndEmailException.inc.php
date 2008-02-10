<?php
/**
 * MailingList_NameAndEmailException
 *
 * @copyright Clear Line Web Design, 2007-07-18
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/exceptions/'
    . 'Database_InvalidUserInputException.inc.php';

class
    MailingList_NameAndEmailException
extends
    Database_InvalidUserInputException
{
    public function
        __construct()
    {
        parent::__construct('The name and email most both be set when adding someone to the mailing-list people table!');
    }
}
?>
