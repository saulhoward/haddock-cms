<?php
/**
 * MySQLConnections_DatabaseNameValidator
 *
 * @copyright 2009-01-31, Robert Impey
 */

class
	MySQLConnections_DatabaseNameValidator
extends
	MySQLConnections_EntityNameValidator
{
	protected function
		get_entity_name()
	{
		return 'database name';
	}
}
?>