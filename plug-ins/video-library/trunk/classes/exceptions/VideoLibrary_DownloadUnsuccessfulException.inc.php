<?php
/**
 * VideoLibrary_DownloadUnsuccessfulException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_DownloadUnsuccessfulException
extends
VideoLibrary_AdminException
{
	public function
		__construct()
	{
		parent::__construct("Download unsuccessful");
	}

}
?>
