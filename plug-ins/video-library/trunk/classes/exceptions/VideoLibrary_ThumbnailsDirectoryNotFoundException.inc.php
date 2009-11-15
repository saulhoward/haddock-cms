<?php
/**
 * VideoLibrary_ThumbnailsDirectoryNotFoundException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_ThumbnailsDirectoryNotFoundException
extends
VideoLibrary_Exception
{
	public function
		__construct()
	{
		parent::__construct("The thumbnails directory doesn't exist.");
	}

}
?>
