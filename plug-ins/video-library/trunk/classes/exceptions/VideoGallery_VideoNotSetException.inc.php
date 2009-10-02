<?php
/**
 * VideoGallery_VideoNotSetException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoGallery_VideoNotSetException
extends
VideoGallery_Exception
{
	public function
		__construct()
	{
		parent::__construct("Video not set on Video Page.");
	}

}
?>
