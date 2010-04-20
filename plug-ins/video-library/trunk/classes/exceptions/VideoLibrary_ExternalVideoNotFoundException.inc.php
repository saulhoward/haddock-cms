<?php
/**
 * VideoLibrary_ExternalVideoNotFoundException
 *
 * @copyright 2009-10-02, SANH
 */

class
VideoLibrary_ExternalVideoNotFoundException
extends
VideoLibrary_Exception
{
	public function
		__construct($id)
	{
		parent::__construct("That Video is not in the database.");
	}

}
?>
