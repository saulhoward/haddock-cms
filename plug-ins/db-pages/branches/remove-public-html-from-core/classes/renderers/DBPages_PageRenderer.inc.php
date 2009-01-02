<?php
/**
 * DBPages_PageRenderer
 *
 * @copyright 2008-02-08, RFI
 */

class
	DBPages_PageRenderer
{
	/**
	 * Renders a text from the database.
	 *
	 * If the user is logged in as an admin user,
	 * then a link to the appropriate page in the admin section is provided.
	 *
	 * if the user is not logged in and the section required is 'content', then the exception
	 * is propagated.
	 *
	 * Otherwise, the function does nothing.
	 */
	public static function
		render_page_section(
			$page_name,
			$section_name
		)
	{
		try {
			$filtered_page_section = DBPages_SPoE::get_filtered_page_section($page_name, $section_name);
			
			if (Admin_LogInHelper::is_logged_id()) {
				DBPages_AdminHelper
					::render_link_p_to_edit_section_admin_page(
						$page_name,
						$section_name
					);
			}
			
			echo $filtered_page_section;
		} catch (DBPages_PageSectionNotFoundException $e) {
			#print_r($e);
			if (Admin_LogInHelper::is_logged_id()) {
				DBPages_AdminHelper
					::render_link_p_to_add_new_section_admin_page(
						$page_name,
						$section_name
					);
			} else {
				if ($section_name == 'content') {
					throw $e;
				} else {
					#echo '<p class="error">Text not found.</p>' . "\n";
				}
			}
		}
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