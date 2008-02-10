<?php
/**
 * DBPages_ManagePagesAdminRedirectScript
 * 
 * @copyright RFI 2007-12-18
 */

class
	DBPages_ManagePagesAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'DBPages_CRUDAdminManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'page section filter_function text');
	}
	
	public function
		add_something()
	{
		#throw new Database_CRUDException('Foo bar!');
		
		#echo __METHOD__;
		#
		#print_r($_POST);
		
		/*
		 * Set the session vars for any of the fields that should have been set.
		 */
		$this->set_required_fields_in_session_array();
		
		/*
		 * Check that all the vars have been set.
		 */
		if ($this->check_that_all_required_fields_have_been_set()) {
			#echo "All fields have been set.\n";
			
			$dbh = DB::m();
			
			/*
			 * Check that the id of the filter function is valid.
			 */
			$filter_function_id = mysql_real_escape_string($_POST['filter_function'], $dbh);
			
			$query = <<<SQL
SELECT
	COUNT(id)
FROM
	hpi_db_pages_filter_functions
WHERE
	id = $filter_function_id
SQL;

			$result = mysql_query($query, $dbh);
			
			if (
				$result
				&&
				($row = mysql_fetch_array($result))
			) {
				if ($row[0] == 1) {
					/*
					 * See if the page already exists, if not create it.
					 */
					$page = mysql_real_escape_string($_POST['page'], $dbh);
					
					$query = <<<SQL
SELECT
	id
FROM
	hpi_db_pages_pages
WHERE
	name = '$page'
SQL;
					
					$result = mysql_query($query, $dbh);
					
					if ($result) {
						if ($row = mysql_fetch_array($result)) {
							$page_id = $row['id'];
						} else {
							/*
							 * The page doesn't exist, create it.
							 */
							
							$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_pages
SET
	name = '$page'
SQL;
							
							mysql_query($stmt, $dbh);
							
							$page_id = mysql_insert_id($dbh);
						}
							
						/*
						 * See if the section already exists.
						 */
						$section = mysql_real_escape_string($_POST['section'], $dbh);
						
						$query = <<<SQL
SELECT
	id
FROM
	hpi_db_pages_sections
WHERE
	name = '$section'
SQL;
					
						$result = mysql_query($query, $dbh);
						
						if ($result) {
							/*
							 * If there is already a section for the given page
							 * and that section has not been 'deleted' from that page,
							 * tell the user to use the edit page instead.
							 *
							 * If the section already exists for another page,
							 * use the id of the existing section.
							 *
							 * If the section doesn't already exist, add a row.
							 */
							if ($row = mysql_fetch_array($result)) {
								$section_id = $row[0];
								
								$query = <<<SQL
SELECT
	COUNT(*)
FROM
	hpi_db_pages_text_section_links
		INNER JOIN hpi_db_pages_texts ON
			hpi_db_pages_text_section_links.text_id = hpi_db_pages_texts.id
		INNER JOIN hpi_db_pages_edits ON
			hpi_db_pages_texts.id = hpi_db_pages_edits.text_id
		INNER JOIN hpi_db_pages_pages ON
			hpi_db_pages_edits.page_id = hpi_db_pages_pages.id
WHERE
	hpi_db_pages_pages.id = $page_id
	AND
	hpi_db_pages_text_section_links.section_id = $section_id
	AND
	hpi_db_pages_edits.current = 'Yes'
	AND
	hpi_db_pages_edits.deleted = 'No'
SQL;
								
								#echo $query; exit;
								
								$result = mysql_query($query, $dbh);
								
								if (
									$result
									&&
									($row = mysql_fetch_array($result))
								) {
									#print_r($row); exit;
									
									if ($row[0] > 0) {
										throw new Database_CRUDException(
											"There is already a section called '$section' on '$page'!"
										);
									} else {
										/*
										 * If we've got this far, then we can use
										 * the section id from above.
										 */
									}
								} else {
									/*
									 * Unable to find out about whether this section
									 * already exists on the given page.
									 */
									throw new Database_MySQLException($dbh);
								}
							} else {
								/*
								 * The section doesn't exist yet, add it.
								 */
								
								$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_sections
SET
	name = '$section'
SQL;
						
								mysql_query($stmt, $dbh);
								
								$section_id = mysql_insert_id($dbh);
							}
							
							/*
							 * Add the text to the database.
							 */
							$text = mysql_real_escape_string($_POST['text'], $dbh);
							
							$md5_checksum = md5($text);
							
							$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_texts
SET
	text = '$text',
	checksum = '$md5_checksum',
	filter_function_id = $filter_function_id
SQL;
					
							mysql_query($stmt, $dbh);
							
							$text_id = mysql_insert_id($dbh);
							
							/*
							 * Link the text to the section.
							 */
							$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_text_section_links
SET
	text_id = $text_id,
	section_id = $section_id
SQL;
					
							mysql_query($stmt, $dbh);
							
							/*
							 * Link the text to a page with the edits table.
							 */
							$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_edits
SET
	page_id = $page_id,
	text_id = $text_id,
	submitted = NOW(),
	current = 'Yes',
	deleted = 'No'
SQL;
					
							#echo $stmt; exit;
							
							mysql_query($stmt, $dbh);
							
							$this->clear_form();
						} else {
							/*
							 * Unable to make the query about the section.
							 */
							throw new Database_MySQLException($dbh);
						}
					} else {
						/*
						 * Unable to find out about the page.
						 */
						throw new Database_MySQLException($dbh);
					}
				} else {
					throw new Database_CRUDException("Invalid filter function!");
				}
			} else {
				/*
				 * Unable to find out about the section.
				 */
				throw new Database_MySQLException($dbh);
			}
		} else {
			/*
			 * At least one of the required fields was not set.
			 *
			 * No need to throw an exception as one will have been thrown
			 * in the method that checks the required fields.
			 */
		}
		
		#exit;
	}
	
	public function
		edit_something()
	{
		#echo __METHOD__;
		#print_r($_GET);
		#print_r($_POST);
		
		$acm = $this->get_admin_crud_manager();
		
		$ks = $acm->get_key_values_from_get_vars();
		
		$page = $ks['page'];
		$section = $ks['section'];
		
		#$current_something = $acm->get_hash_for_something();
		#print_r($current_something);
		
		/*
		 * Set the session vars for any of the fields that should have been set.
		 */
		$this->set_required_fields_in_session_array();
		
		/*
		 * Check that all the vars have been set.
		 */
			/*
			 * What's changed?
			 */
			
			$dbh = DB::m();
			
			$query = <<<SQL
SELECT
	hpi_db_pages_edits.id AS edit_id,
	hpi_db_pages_pages.id AS page_id,
	hpi_db_pages_pages.name AS page,
	hpi_db_pages_sections.id AS section_id,
	hpi_db_pages_sections.name AS section,
	hpi_db_pages_texts.text AS text,
	hpi_db_pages_texts.checksum AS checksum,
	hpi_db_pages_texts.filter_function_id
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
WHERE
	hpi_db_pages_edits.current = 'Yes'
	AND
	hpi_db_pages_edits.deleted = 'No'
	AND
	hpi_db_pages_pages.name = '$page'
	AND
	hpi_db_pages_sections.name = '$section'
SQL;
			
			$result = mysql_query($query, $dbh);
			
			if ($result) {
				if ($row = mysql_fetch_assoc($result)) {
					#print_r($row);
					
					/*
					 * What's changed?
					 */
					
					$old_edit_id = $row['edit_id'];
					$old_page_id = $row['page_id'];
					$old_page = $row['page'];
					$old_section_id = $row['section_id'];
					$old_section = $row['section'];
					$old_text = $row['text'];
					$old_checksum = $row['checksum'];
					$old_filter_function_id = $row['filter_function_id'];
					
					$new_text = mysql_real_escape_string($_POST['text']);
					$new_checksum = md5($new_text);
					$new_filter_function_id = mysql_real_escape_string($_POST['filter_function']);
					
					/*
					 * Add the text to the database.
					 */
					$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_texts
SET
	text = '$new_text',
	checksum = '$new_checksum',
	filter_function_id = $new_filter_function_id
SQL;
					
							mysql_query($stmt, $dbh);
							
							$text_id = mysql_insert_id($dbh);
							
							/*
							 * Link the text to the section.
							 */
							$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_text_section_links
SET
	text_id = $text_id,
	section_id = $old_section_id
SQL;
					
							mysql_query($stmt, $dbh);
							
							/*
							 * Make the old edit no longer current.
							 */
							$stmt = <<<SQL
UPDATE
	hpi_db_pages_edits
SET
	current = 'No'
WHERE
	id = $old_edit_id
SQL;
							
							mysql_query($stmt, $dbh);	
							
							/*
							 * Link the text to a page with the edits table.
							 */
							$stmt = <<<SQL
INSERT INTO
	hpi_db_pages_edits
SET
	page_id = $old_page_id,
	text_id = $text_id,
	submitted = NOW(),
	current = 'Yes',
	deleted = 'No'
SQL;
					
							#echo $stmt; exit;
							
							mysql_query($stmt, $dbh);
							
							$this->clear_form();
				} else {
					throw new Database_CRUDException("Unable to find anything to edit!");
				}
			} else {
				throw new Database_MySQLException($dbh);
			}
		
		#exit;
	}
		
	public function
		delete_something()
	{
		#echo __METHOD__;
		#print_r($_GET);
		#exit;
		
		$acm = $this->get_admin_crud_manager();
		
		$ks = $acm->get_key_values_from_get_vars();
		
		$page = $ks['page'];
		$section = $ks['section'];
		
		$dbh = DB::m();
		
		/*
		 * Set the edit row to deleted.
		 */
		$query = <<<SQL
SELECT
	hpi_db_pages_edits.id
FROM
	hpi_db_pages_edits
		INNER JOIN hpi_db_pages_pages ON
			hpi_db_pages_edits.page_id = hpi_db_pages_pages.id
		INNER JOIN hpi_db_pages_texts ON
			hpi_db_pages_edits.text_id = hpi_db_pages_texts.id
		INNER JOIN hpi_db_pages_text_section_links ON
			hpi_db_pages_texts.id = hpi_db_pages_text_section_links.text_id
		INNER JOIN hpi_db_pages_sections ON
			hpi_db_pages_text_section_links.section_id = hpi_db_pages_sections.id
WHERE
	hpi_db_pages_pages.name = '$page'
	AND
	hpi_db_pages_sections.name = '$section'
	AND
	hpi_db_pages_edits.current = 'Yes'
SQL;
		
		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		$row = mysql_fetch_array($result);
		
		$edit_id = $row[0];
		
		$stmt = <<<SQL
UPDATE
	hpi_db_pages_edits
SET
	current = 'No',
	deleted = 'Yes'
WHERE
	id = $edit_id
SQL;
		
		mysql_query($stmt, $dbh);
	}
		
	public function
		delete_everything()
	{
		#echo __METHOD__; exit;
		$dbh = DB::m();
		
		$stmt = <<<SQL
UPDATE
	hpi_db_pages_edits
SET
	deleted = 'Yes',
	current = 'No'
SQL;
					
		#echo $stmt; exit;
		
		mysql_query($stmt, $dbh);
		
		$this->clear_form();
	}
}
?>