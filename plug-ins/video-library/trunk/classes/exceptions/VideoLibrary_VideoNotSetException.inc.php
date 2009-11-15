<?php
/**
 * VideoLibrary_VideoNotSetException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_VideoNotSetException
extends
VideoLibrary_Exception
{
	public function
		__construct()
	{
		parent::__construct("Video not set on Video Page.");
	}

}
?>
