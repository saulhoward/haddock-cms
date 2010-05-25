<?php
/**
 * VideoLibrary_FailedToCreateImageException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_FailedToCreateImageException
extends
VideoLibrary_AdminException
{
	public function
		__construct()
	{
		parent::__construct("Failed to create image");
	}

}
?>
