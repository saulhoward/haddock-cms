<?php
/**
 * VideoLibrary_EditVideoDataNotSetException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_EditVideoDataNotSetException
extends
VideoLibrary_AdminException
{
	public function
		__construct()
	{
		parent::__construct("Video data not set");
	}

}
?>
