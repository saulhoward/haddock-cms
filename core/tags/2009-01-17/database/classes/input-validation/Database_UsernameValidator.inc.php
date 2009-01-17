<?php
/**
 * Database_UsernameValidator
 *
 * @copyright 2008-05-27, RFI
 */

class
	Database_UsernameValidator
extends
	Database_EntityNameValidator
{
	protected function
		get_entity_name()
	{
		return 'username';
	}
}
?>