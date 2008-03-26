<?php
/**
 * OrderedTables_ReorderTableAdminPageManager
 *
 * @copyright 2008-03-17, RFI
 */

/**
 * Handles everything to do with the table reordering
 * admin page.
 */
class
	OrderedTables_ReorderTableAdminPageManager
{
	private $reorder_table_admin_page_config_file;
	
	public function
		__construct(
			OrderedTables_ReorderTableAdminPageConfigFile
				$reorder_table_admin_page_config_file
		)
	{
		$this->reorder_table_admin_page_config_file
			= $reorder_table_admin_page_config_file;
	}
	
	protected function
		get_reorder_table_admin_page_config_file()
	{
		return $this->reorder_table_admin_page_config_file;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering the content.
	 * ----------------------------------------
	 */
	
	public function
		render_content()
	{
		$this->render_top_links_ul();
		
		$this->render_rows_table();
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering the top links UL.
	 * ----------------------------------------
	 */
	
	protected function
		render_top_links_ul()
	{
		$page_options_div = new HTMLTags_Div();
		$page_options_div->set_attribute_str('id', 'page-options');
		
		$other_pages_ul = new HTMLTags_UL();
		
		foreach ($this->get_top_links_as() as $a) {
			$li = new HTMLTags_LI();
			
			$li->append_tag_to_content($a);
			
			$other_pages_ul->append_tag_to_content($li);
		}
		
		$page_options_div->append_tag_to_content($other_pages_ul);
		
		echo $page_options_div->get_as_string();
	}
	
	protected function
		get_top_links_as()
	{
		$as = array();
		
		$top_links
			= $this->reorder_table_admin_page_config_file->get_top_links();
		
		#print_r($top_links);
		
		foreach ($top_links as $top_link) {
			$a = new HTMLTags_A($top_link['title']);
			
			$a->set_href(new HTMLTags_URL($top_link['url']));
			
			$as[] = $a;
		}
		
		#print_r($as);
		
		return $as;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering the table containing the data.
	 * ----------------------------------------
	 */
	
	protected function
		render_rows_table()
	{
		$table = new OrderedTables_ReorderRowsHTMLTable();
		
		$rtapcf = $this->get_reorder_table_admin_page_config_file();
		
		/*
		 * Set the names of the key fields.
		 */
		$table->set_key_fields($rtapcf->get_key_fields());
		
		/*
		 * Add the field titles.
		 */
		
		$display_field_titles = $rtapcf->get_display_field_titles();
		
		#print_r($display_field_titles);
		
		foreach (
			$display_field_titles
			as
			$dft
		) {
			$table->add_column_title($dft);
		}
		
		/*
		 * Add the row data.
		 */
		
		$row_data = $this->get_all_rows_filtered_data();
		
		$table->add_row_data($row_data);
		
		/*
		 * Set the base redirect script URL.
		 */
		$table->set_base_redirect_script_url(
			$this->get_base_redirect_script_url()
		);
		
		echo $table->get_as_string();
	}
	
	protected function
		get_all_rows_filtered_data()
	{
		$filtered_row_data = array();
		
		#$dbh = DB::m();
		#
		#$rtapcf = $this->get_reorder_table_admin_page_config_file();
		#
		#$query = $rtapcf->get_select_query();
		#
		##echo $query;
		#
		#$result = mysql_query($query, $dbh);
		#
		#$raw_row_data = array();
		#
		#while ($row = mysql_fetch_assoc($result)) {
		#	$raw_row_data[] = $row;
		#}
		#
		##echo 'print_r($raw_row_data):' . "\n";
		##print_r($raw_row_data);
		#
		#$display_fields = $rtapcf->get_display_fields();
		#
		##echo 'print_r($display_fields):' . "\n";
		##print_r($display_fields);
		#
		#foreach ($raw_row_data as $raw_row_datum) {
		#	#echo 'print_r($raw_row_datum):' . "\n";
		#	#print_r($raw_row_datum);
		#	
		#	$filtered_row_datum = array();
		#	
		#	foreach ($display_fields as $display_field) {
		#		#echo 'print_r($display_field):' . "\n";
		#		#print_r($display_field);
		#		
		#		$field_name = $display_field['name'];
		#		
		#		if (isset($display_field['filter'])) {
		#			#echo $display_field['filter'] . "\n";
		#			#exit;
		#			
		#			$str = $raw_row_datum[$field_name];
		#			
		#			#echo "\$str: $str\n";
		#			
		#			eval($display_field['filter']);
		#			
		#			#echo "\$str: $str\n";
		#			
		#			$filtered_row_datum[$field_name] = $str;
		#		} else {
		#			$filtered_row_datum[$field_name]
		#				= $raw_row_datum[$field_name];
		#		}
		#	}
		#	
		#	$filtered_row_data[] = $filtered_row_datum;
		#}
		#
		##echo 'print_r($filtered_row_data):' . "\n";
		##print_r($filtered_row_data);
		
		$all_rows_raw_data = $this->get_all_rows_raw_data();
		
		return $filtered_row_data;
	}
	
	/**
	 * Adds the data from the config file to a
	 * OrderedTables_FetchAllRowsSelectStatement object then
	 * returns the object.
	 */
	protected function
		get_fetch_all_rows_sql_query()
	{
		$query = new OrderedTables_FetchAllRowsSelectQuery();
		
		return $query;
	}
	
	protected function
		get_all_rows_raw_data()
	{
		$query = $this->get_fetch_all_rows_sql_query();
		
		$dbh = DB::m();
		
		$result = mysql_query($query->get_as_string(), $dbh);
		
		$arrd = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$arrd[] = $row;
		}
		
		echo 'print_r($arrd):' . "\n";
		print_r($arrd);
		
		return $arrd;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with URLs
	 * ----------------------------------------
	 */
	
	protected function
		get_base_redirect_script_url()
	{
		return
			PublicHTML_URLHelper
				::get_oo_page_url(
					'OrderedTables_ReorderTableAdminRedirectScript',
					array(
						'xml_config_file'
						=>
						$this->reorder_table_admin_page_config_file->basename()
					)
				);
	}
}
?>