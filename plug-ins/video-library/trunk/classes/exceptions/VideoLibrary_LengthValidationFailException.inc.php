<?php
/**
 * VideoLibrary_LengthValidationFailException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_LengthValidationFailException
extends
VideoLibrary_AdminException
{
	public function
		__construct()
	{
		parent::__construct("The Video Length failed the validation check. 'Length' must contain only <em>numbers 0-9</em>, <em>:</em> or <em>.</em>");
	}

}
?>
