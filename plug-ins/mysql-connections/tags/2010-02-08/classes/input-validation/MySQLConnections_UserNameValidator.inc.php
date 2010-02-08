<?php
/**
 * MySQLConnections_UserNameValidator
 *
 * @copyright 2009-01-31, Robert Impey
 */

class
	MySQLConnections_UserNameValidator
extends
	MySQLConnections_EntityNameValidator
{
	protected function
		get_entity_name()
	{
		return 'username';
	}
}
?>