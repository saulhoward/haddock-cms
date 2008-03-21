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
	
	/**
	 * Renders the page that has been set in the get variable.
	 *
	 * This is the function that should be called in the content
	 * method of classes that used to render DB pages for a project.
	 */
	public static function
		render_current_page_content()
	{
		if (isset($_GET['page'])) {
			DBPages_PageRenderer::render_page_section($_GET['page'], 'content');
		} else {
			echo "<p class=\"error\">Please set the page name!</p>\n";
		}
	}
}
?>