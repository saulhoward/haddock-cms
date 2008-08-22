<?php
/**
 * HTMLTags_InputTag
 *
 * @copyright 2006-11-27, Robert Impey
 */

/**
 * E.g.
 *	- input
 *	- textarea
 *	- select
 *
 *	The purpose of this interface is to ensure
 *	that the value of a tag can be set.
 *
 *	How this is achieved will vary from class to class.
 */
interface
	HTMLTags_InputTag
{
	public function
		set_value($value);
}
?>