<?php
/**
 * MailingList_NameTooLongException
 *
 * @copyright Clear Line Web Design, 2007-07-18
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/exceptions/'
    . 'Database_UserInputTooLongException.inc.php';

class
    MailingList_NameTooLongException
extends
    Database_UserInputTooLongException
{
    public function
        __construct($max_length)
    {
        parent::__construct('name', $max_length);
    }
}
?>
