<?php
/**
 * Database_UnableToMakeConnectionException
 *
 * @copyright 2008-05-29, RFI
 */

class
	Database_UnableToMakeConnectionException
extends
	ErrorHandling_SprintfException
{
	public function
		__construct(
			$username,
			$host
		)
	{
		parent
			::__construct(
				'Unable to connect as %s@%s!',
				array(
					$username,
					$host
				)
			);
	}
}
?>