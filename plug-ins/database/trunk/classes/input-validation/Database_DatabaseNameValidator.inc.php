<?php
/**
 * Database_DatabaseNameValidator
 *
 * @copyright 2008-05-27, RFI
 */

class
	Database_DatabaseNameValidator
extends
	Database_EntityNameValidator
{
	protected function
		get_entity_name()
	{
		return 'database name';
	}
}
?>