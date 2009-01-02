<?php
/**
 * DBPages_PageSectionNotFoundException
 *
 * @copyright 2008-03-31, RFI
 */

class
	DBPages_PageSectionNotFoundException
extends
	Exception
{
	public function
		__construct($page_name)
	{
		parent::__construct("Unable to find page '$page_name'!");
	}
}
?>