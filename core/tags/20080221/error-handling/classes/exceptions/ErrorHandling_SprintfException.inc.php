<?php
/**
 * ErrorHandling_SprintfException
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

class
	ErrorHandling_SprintfException
extends
    Exception
{
    public function
        __construct(
            $format_string,
            $args = array()
        )
    {
        parent::__construct(vsprintf($format_string, $args));
    }
}
?>
