<?php
/**
 * DBPages_AdminHelper
 *
 * @copyright 2008-04-02, RFI
 */

class
	DBPages_AdminHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do with returning string constants.
	 * ----------------------------------------
	 */
	
	public static function
		get_add_new_section_admin_page_link_text(
			$page_name,
			$section_name
		)
	{
		return "Write text for '$section_name' on '$page_name'.";
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with generating HTML
	 * ----------------------------------------
	 */
	
	public static function
		get_link_p_to_add_new_section_admin_page(
			$page_name,
			$section_name
		)
	{
		$p = new HTMLTags_P();
		
		$p->set_attribute_str('class', 'haddock_admin');
		
		$url = self
			::get_add_new_section_admin_page_url(
				$page_name,
				$section_name
			);
		
		$a = new HTMLTags_A(
			self
				::get_add_new_section_admin_page_link_text(
					$page_name,
					$section_name
				)
		);
		
		$a->set_href($url);
		
		$p->append($a);
		
		return $p;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering HTML
	 * ----------------------------------------
	 */
	
	public static function
		render_link_p_to_add_new_section_admin_page(
			$page_name,
			$section_name
		)
	{
		$p = self::get_link_p_to_add_new_section_admin_page($page_name, $section_name);
		
		echo $p->get_as_string();
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering HTML
	 * ----------------------------------------
	 */
	public static function
		get_add_new_section_admin_page_url(
			$page_name,
			$section_name
		)
	{
		return PublicHTML_URLHelper
			::get_oo_page_url(
				'DBPages_ManagePagesAdminPage',
				array(
					'content' => 'add_something',
					'page' => $page_name,
					'section' => $section_name
				)
			);
	}
}
?>