<?php
/**
 * DBPages_FetchAllSectionsForPageSelectQuery
 *
 * @copyright 2008-03-21, RFI
 */

class
	DBPages_FetchAllSectionsForPageSelectQuery
extends
	Database_SQLSelectQuery
{
	#private $page_name;
	
	public function
		__construct($page_name)
	{
		#$this->page_name = $page_name;
		
		/*
		 * Build the SELECT clause.
		 */
		$this->add_field_str_to_select_clause('name', 'hpi_db_pages_pages', 'name');
		$this->add_field_str_to_select_clause('submitted', 'hpi_db_pages_edits', 'modified');
		$this->add_field_str_to_select_clause('name', 'hpi_db_pages_sections', 'section');
		$this->add_field_str_to_select_clause('text', 'hpi_db_pages_texts', 'text');
		$this->add_field_str_to_select_clause('name', 'hpi_db_pages_filter_functions', 'filter_function');
		
		/*
		 * Build the FROM clause.
		 */
		$this->set_from_clause_table_name('hpi_db_pages_pages');
		
		$this->add_from_clause_inner_join(
			'hpi_db_pages_edits',
			'page_id',
			'hpi_db_pages_pages',
			'id'
		);
		
		$this->add_from_clause_inner_join(
			'hpi_db_pages_texts',
			'id',
			'hpi_db_pages_edits',
			'text_id'
		);
		
		$this->add_from_clause_inner_join(
			'hpi_db_pages_text_section_links',
			'text_id',
			'hpi_db_pages_texts',
			'id'
		);
		
		$this->add_from_clause_inner_join(
			'hpi_db_pages_sections',
			'id',
			'hpi_db_pages_text_section_links',
			'section_id'
		);
		
		$this->add_from_clause_left_join(
			'hpi_db_pages_filter_functions',
			'id',
			'hpi_db_pages_texts',
			'filter_function_id'
		);
		
		/*
		 * Build the WHERE clause.
		 */
		$this->add_where_clause_str_literal_and_condition('No', 'deleted', 'hpi_db_pages_edits');
		$this->add_where_clause_str_literal_and_condition('Yes', 'current', 'hpi_db_pages_edits');
		$this->add_where_clause_str_literal_and_condition($page_name, 'name', 'hpi_db_pages_pages');
		
		/*
		 * Build the ORDER BY clause.
		 */
		$this->add_order_by_clause_field('section', 'ASC');
		$this->add_order_by_clause_field('modified', 'ASC');		
	}
}
?>