<?php
/**
 * Persistence_Entry
 *
 * @copyright 2008-08-09, Robert Impey
 */

/**
 * An Entry in the Persistence module is something
 * that can be saved.
 *
 * That might be a user, an image or a record of a visit
 * to the site.
 */
abstract class
	Persistence_Entry
{
	abstract function
		save();
	
	abstract function
		delete();
	
	/**
	 * This should be the data for an entry
	 * as returned by its access statements
	 * in an associative array.
	 */
	abstract function
		get_assoc();
}
?>