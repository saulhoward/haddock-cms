<?php
/**
 * CLIScripts_ExecutablePHPFile
 *
 * @copyright 2008-05-23, RFI
 */

class
	CLIScripts_ExecutablePHPFile
extends
	FileSystem_PHPFile
{
	public function
		get_shebang()
	{
		return '#!/usr/bin/php' . $this->get_eol();
	}
}
?>