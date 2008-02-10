<?php
/**
 * HaddockProjectOrganisation_PasswordResetException
 *
 * @copyright Clear Line Web Design, 2007-09-24
 */

class
	HaddockProjectOrganisation_PasswordResetException
extends
    Exception
{
    public function
        __construct($name)
    {
        parent::__construct(
            sprintf(
                'Unable to reset the password of \'%s\'',
                $name
            )
        );
    }
}
?>
