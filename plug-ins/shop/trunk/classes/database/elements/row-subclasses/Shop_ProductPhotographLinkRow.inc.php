<?php
/**
 * Shop_ProductPhotographLinkRow
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

class
	Shop_ProductPhotographLinkRow
extends
	Database_Row
{
	public function
		get_photograph_id()
	{
		return $this->get('photograph_id');
	}
}
?>
