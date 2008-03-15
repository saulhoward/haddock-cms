<?php
/**
 * OrderedTables_AdminCRUDHelper
 *
 * @copyright 2008-03-13
 */

/**
 * A procedural helper for admin CRUD pages.
 */
class
	OrderedTables_AdminCRUDHelper
{
	/**
	 * Prepends the definitions of the actions to shift a row up or down
	 * on a CRUD admin page.
	 *
	 * See:
	 * 	Database_CRUDAdminPage::get_data_table_actions()
	 */
	public static function
		prepend_shift_actions(
			&$data_table_actions,
			$table_name
		)
	{
		$acm = OrderedTables_AdminCRUDManager::get_instance();
		
		$acm->set_table_name($table_name);
		
		$acm->prepend_shift_actions($data_table_actions);
	}
	
	public static function
		make_content_for_action_td(
			$action_name,
			$identifiers
		)
	{
		$acm = OrderedTables_AdminCRUDManager::get_instance();
		
		return $acm->make_content_for_action_td(
			$action_name,
			$identifiers
		);
	}
	
	public static function
		shift(
			$get_vars
		)
	{
		
	}
	
	/**
	 * Appends an HTMLTags_A object to the list so
	 * that users can link to the admin page where the
	 * rows in the table are reordered.
	 */
	public static function
		append_reorder_html_a_to_list(
			&$html_as,
			$xml_config_file_name
		)
	{
		$a = new HTMLTags_A('Reorder');
		
		$url = self::get_reorder_table_admin_page($xml_config_file_name);
		
		$a->set_href($url);
		
		$html_as[] = $a;
	}
	
	public static function
		get_reorder_table_admin_page($xml_config_file_name)
	{
		return PublicHTML_URLHelper::get_oo_page_url(
			'OrderedTables_ReorderTableAdminPage',
			array(
				'xml_config_file' => $xml_config_file_name
			)
		);
	}
}
?>