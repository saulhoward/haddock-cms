<?php
/**
 * DBPages_ContentManager
 *
 * @copyright 2007-12-15, RFI
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
		$raw_page_sections = self::get_raw_page_sections($page_name);
		
		$first = TRUE;
		foreach ($raw_page_sections as $rps) {
			if ($first) {
				$first = FALSE;
				
				$page = new DBPages_Page($rps['name']);
			}
			
			$section
				= new DBPages_Section(
					$rps['text'],
					$rps['filter_function'],
					$rps['modified']
				);
			
			$page->add_section($rps['section'], $section);
			
			#$at_start_of_section = FALSE;
		}
		
		#print_r($page); exit;
		
		return $page;
	}
	
	private function
		get_raw_page_sections($page_name)
	{
		#$dbh = DB::m();
		
		#$raw_page_sections = array();
		
		#$page_name = mysql_real_escape_string($page_name, $dbh);
		
#		$query = <<<SQL
#SELECT
#	hpi_db_pages_pages.name AS name,
#	hpi_db_pages_edits.submitted AS modified,
#	hpi_db_pages_sections.name AS section,
#	hpi_db_pages_texts.text AS text,
#	hpi_db_pages_filter_functions.name AS filter_function
#FROM
#	hpi_db_pages_pages
#		INNER JOIN hpi_db_pages_edits ON
#			hpi_db_pages_pages.id = hpi_db_pages_edits.page_id
#		INNER JOIN hpi_db_pages_texts ON
#			hpi_db_pages_edits.text_id = hpi_db_pages_texts.id
#		INNER JOIN hpi_db_pages_text_section_links ON
#			hpi_db_pages_texts.id = hpi_db_pages_text_section_links.text_id
#		INNER JOIN hpi_db_pages_sections ON
#			hpi_db_pages_text_section_links.section_id = hpi_db_pages_sections.id
#		LEFT JOIN hpi_db_pages_filter_functions ON
#			hpi_db_pages_texts.filter_function_id
#			=
#			hpi_db_pages_filter_functions.id
#WHERE
#	hpi_db_pages_pages.name = '$page_name'
#	AND
#	hpi_db_pages_edits.deleted = 'No'
#	AND
#	hpi_db_pages_edits.current = 'Yes'
#ORDER BY
#	section ASC,
#	modified ASC
#SQL;
		
		#echo $query; exit;
		
		$query = new DBPages_FetchAllSectionsForPageSelectQuery($page_name);
		
		#print_r($query);
		#echo '$query->get_as_string(): ' . "\n";
		#echo $query->get_as_string();
		#print_r($query);
		#exit;
		
		#$result = mysql_query($query, $dbh);
		#
		#while ($row = mysql_fetch_assoc($result)) {
		#	$raw_page_sections[] = $row;
		#}
		
		$raw_page_sections = Database_FetchingHelper::get_rows_for_query($query);
		
		if (count($raw_page_sections) > 0) {
			return $raw_page_sections;
		} else {
			throw new DBPages_PageSectionNotFoundException($page_name);
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