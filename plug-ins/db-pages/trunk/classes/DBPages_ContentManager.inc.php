<?php
/**
 * DBPages_ContentManager
 *
 * @copyright RFI 2007-12-15
 */

/**
 * This manager takes care of the DB page objects and their sections.
 *
 * It fetches the relevant information from the database
 * and puts an object together with that data.
 */
class
	DBPages_ContentManager
{
	/*
	 * Class variables.
	 */
	private static $instance;
	
	/*
	 * Instance variables.
	 */
	private $pages;
	
	/*
	 * ----------------------------------------
	 * Functions to do with the singleton design pattern.
	 * ----------------------------------------
	 */
	
	private function
		__construct()
	{
		$this->pages = array();
	}
	
	public static function
		get_instance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new DBPages_ContentManager();
		}
		
		return self::$instance;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with getting data from the database.
	 * ----------------------------------------
	 */
	
	/**
	 * Gets the page data from the DB.
	 *
	 * If the page does not exist, an exception is thrown.
	 */
	public function
		get_page($page_name)
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	hpi_db_pages_pages.name AS name,
	hpi_db_pages_edits.submitted AS modified,
	hpi_db_pages_sections.name AS section,
	hpi_db_pages_texts.text AS text,
	hpi_db_pages_filter_functions.name AS filter_function
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
	hpi_db_pages_pages.name = '$page_name'
	AND
	hpi_db_pages_edits.deleted = 'No'
	AND
	hpi_db_pages_edits.current = 'Yes'
ORDER BY
	section ASC,
	modified ASC
SQL;

		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		if (mysql_num_rows($result) > 0) {
			$first = TRUE;
			
			while ($row = mysql_fetch_assoc($result)) {
				if ($first) {
					$first = FALSE;
					
					$page = new DBPages_Page($row['name']);
				}
				
				$section = new DBPages_Section(
					$row['text'],
					$row['filter_function'],
					$row['modified']
				);
				
				$page->add_section($row['section'], $section);
				
				$at_start_of_section = FALSE;
			}
			
			#print_r($page); exit;
			
			return $page;
		} else {
			throw new Exception("Unable to find page '$page_name'!");
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with altering the database.
	 * ----------------------------------------
	 */
	
	/**
	 * Adds a row to the pages table.
	 */
	public function
		add_page($page_name)
	{
		
	}
	
	/**
	 * Flips the deleted bit of a page.
	 */
	public function
		delete_page($page_name)
	{
		
	}
	
	/**
	 * Actually deletes the page from the table and deletes all
	 * the sections and edits.
	 *
	 * I'm not sure that I dare implement this yet!
	 */
	public function
		purge_page($page_name)
	{
		
	}
	
	/**
	 * Previous edits of pages are kept in the database.
	 *
	 * This can lead to a build up of data that is not
	 * being used.
	 *
	 * This function deletes sections that are not the latest edit
	 * of a page that are older than <code>$days</code>.
	 */
	public function
		purge_ancient_history($days)
	{
		
	}
}
?>