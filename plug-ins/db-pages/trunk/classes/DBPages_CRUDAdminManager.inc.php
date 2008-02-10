<?php

class
	DBPages_CRUDAdminManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'DBPages_ManagePagesAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'DBPages_ManagePagesAdminRedirectScript';
	}
	
	public function
		get_key_columns_for_something()
	{
		return explode(' ', 'page section');
	}
	
	public function
		get_query_for_something()
	{
		if ($key_values = $this->get_key_values_from_get_vars()) {
			$page = $key_values['page'];
			$section = $key_values['section'];
			
			$query = <<<SQL
SELECT
	hpi_db_pages_pages.id AS id,
	hpi_db_pages_pages.name AS page,
	hpi_db_pages_sections.name AS section,
	hpi_db_pages_texts.text AS text,
	hpi_db_pages_filter_functions.name AS filter_function,
	hpi_db_pages_edits.submitted AS modified,
	hpi_db_pages_texts.filter_function_id AS filter_function_id
FROM
	hpi_db_pages_pages
		INNER JOIN hpi_db_pages_edits ON
			hpi_db_pages_pages.id = hpi_db_pages_edits.page_id
		INNER JOIN hpi_db_pages_texts ON
			hpi_db_pages_edits.text_id = hpi_db_pages_texts.id
		INNER JOIN hpi_db_pages_text_section_links ON
			hpi_db_pages_texts.id = hpi_db_pages_text_section_links.text_id
		INNER JOIN hpi_db_pages_sections ON
			hpi_db_pages_text_section_links.section_id = hpi_db_pages_sections.id
		LEFT JOIN hpi_db_pages_filter_functions ON
			hpi_db_pages_texts.filter_function_id
			=
			hpi_db_pages_filter_functions.id
WHERE
	hpi_db_pages_edits.deleted = 'No'
	AND
	hpi_db_pages_edits.current = 'Yes'
	AND
	hpi_db_pages_pages.name = '$page'
	AND
	hpi_db_pages_sections.name = '$section'
	
SQL;
			
			return $query;
		}
	}
}
?>