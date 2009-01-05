<?php
/**
 * DBPages_SectionsHelper
 *
 * @copyright 2008-04-29, RFI
 */

class
	DBPages_SectionsHelper
{
	public static function
		get_filtered_page_section(
			$page_name,
			$section_name
		)
	{
		return DBPages_SPoE
			::get_filtered_page_section(
				$page_name,
				$section_name
			);
	}
}
?>