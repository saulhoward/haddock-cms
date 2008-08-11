<?php
/**
 * Database_SQLUpdateClauseQuotedValueFieldSubClause
 *
 * @copyright 2008-05-14, RFI
 */

class
	Database_SQLUpdateClauseQuotedValueFieldSubClause
extends
	Database_SQLUpdateClauseFieldSubClause
{
	protected function
		get_value_for_string()
	{
		return '\'' . $this->get_value() . '\'';
	}
}
?>