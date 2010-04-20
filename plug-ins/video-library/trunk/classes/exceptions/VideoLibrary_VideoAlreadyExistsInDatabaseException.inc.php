<?php
/**
 * VideoLibrary_VideoAlreadyExistsInDatabaseException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_VideoAlreadyExistsInDatabaseException
extends
VideoLibrary_AdminException
{
	public function
		__construct()
	{
		parent::__construct("That Video is already in the database.");
	}

}
?>
