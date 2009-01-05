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
	
	public static function
		get_edit_section_admin_page_link_text(
			$page_name,
			$section_name
		)
	{
		return "Edit text for '$section_name' on '$page_name'.";
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with generating HTML
	 * ----------------------------------------
	 */
	
	private static function
		get_link_a_to_admin_section(
			$link_text,
			HTMLTags_URL $href
		)
	{
		$a = new HTMLTags_A($link_text);
		
		$a->set_href($href);
		
		$a->set_attribute_str('target', '_blank');
		
		return $a;
	}
	
	private static function
		get_link_p_to_admin_section(
			HTMLTags_A $a
		)
	{
		$p = new HTMLTags_P();
		
		$p->set_attribute_str('class', 'haddock_admin');
		
		$p->append($a);
		
		return $p;
	}
	
	public static function
		get_link_p_to_add_new_section_admin_page(
			$page_name,
			$section_name
		)
	{
		return self
			::get_link_p_to_admin_section(
				self
					::get_link_a_to_admin_section(
						self
							::get_add_new_section_admin_page_link_text(
								$page_name,
								$section_name
							),
						self
							::get_add_new_section_admin_page_url(
								$page_name,
								$section_name
							)
					)
				);
	}
	
	public static function
		get_link_p_to_edit_section_admin_page(
			$page_name,
			$section_name
		)
	{
		return self
			::get_link_p_to_admin_section(
				self
					::get_link_a_to_admin_section(
						self
							::get_edit_section_admin_page_link_text(
								$page_name,
								$section_name
							),
						self
							::get_edit_section_admin_page_url(
								$page_name,
								$section_name
							)
					)
				);
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
	
	public static function
		render_link_p_to_edit_section_admin_page(
			$page_name,
			$section_name
		)
	{
		$p = self::get_link_p_to_edit_section_admin_page($page_name, $section_name);
		
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
	
	public static function
		get_edit_section_admin_page_url(
			$page_name,
			$section_name
		)
	{
		return PublicHTML_URLHelper
			::get_oo_page_url(
				'DBPages_ManagePagesAdminPage',
				array(
					'content' => 'edit_something',
					'page' => $page_name,
					'section' => $section_name
				)
			);
	}
}
?>