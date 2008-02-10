<?php
/**
 * DBPages_PageRenderer
 *
 * @copyright Clear Line Web Design, 2008-02-08
 */

class
	DBPages_PageRenderer
{
	public static function
		render_page_section(
			$page_name,
			$section_name
		)
	{
		echo DBPages_SPoE::get_filtered_page_section($page_name, $section_name);
	}
}
?>