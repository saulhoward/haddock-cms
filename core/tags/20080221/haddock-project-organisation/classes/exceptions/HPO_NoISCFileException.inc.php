<?php
/**
 * HPO_NoISCFileException
 *
 * @copyright Clear Line Web Design, 2007-07-27
 */

class
    HPO_NoISCFileException
extends
    Exception
{
    public function
        __construct()
    {
        parent::__construct('No ISC file in ' . PROJECT_ROOT . '!');
    }
}
?>
