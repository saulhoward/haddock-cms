<?php
/**
 * HaddockProjectOrganisation_LoginException
 *
 * @copyright Clear Line Web Design, 2007-08-06
 */

class
	HaddockProjectOrganisation_LoginException
extends
    Exception
{
    public function
        __construct($name)
    {
        parent::__construct(
            sprintf(
                'Unable to log in as \'%s\'.', 
                $name
            )
        );
    }
}
?>
