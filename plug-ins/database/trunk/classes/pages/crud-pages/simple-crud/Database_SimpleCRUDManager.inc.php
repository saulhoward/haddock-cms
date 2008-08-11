<?php
class
	Database_SimpleCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'Database_ManageSimpleCRUDAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'Database_ManageSimpleCRUDAdminRedirectScript';
	}
	
	public function
		get_query_for_something()
	{
		if ($key_values = $this->get_key_values_from_get_vars()) {
			$id = $key_values['id'];
			
			$table_name = $this->get_table_name();
			
			return <<<SQL
SELECT
	*
FROM
	$table_name
WHERE
	id = $id
SQL;

		}
	}
	
	public function
		get_body_div_header_heading_content()
	{
		return 'Manage ' . $this->get_managed_object_name_plural();
	}
	
	public function
		get_table_name()
	{
		$lines = $this->get_lines_of_schema_file();
		
		#print_r($lines); exit;
		
		foreach ($lines as $line) {
			if (preg_match('/^table:(\w+)/', $line, $matches)) {
				return $matches[1];
			}
		}
		
		throw new Exception('Table not set!');
	}
	
	public function
		get_lines_of_schema_file()
	{
		$lines = array();
		
		$file_name = PROJECT_ROOT . $this->get_file_name();
		
		if ($fh = fopen($file_name, 'r')) {
			while ($line = fgets($fh)) {
				if (!preg_match('/^#/', $line)) {
					$line = trim($line);
					
					$lines[] = $line;
				}
			}
		}
		
		return $lines;
	}
	
	public function
		get_file_name()
	{
		return $_GET['file'];
	}
	
	public function
		get_add_something_title()
	{
		return 'Add a new ' . $this->get_managed_object_name_singular();
	}
	
	public function
		get_managed_object_name_plural()
	{
		$table_name = $this->get_table_name();
		
		#echo $table_name;
		
		if (preg_match('/^(?:ps_|hpi_|hci_)(\w+)/', $table_name, $matches)) {
			#echo "Match\n";
			#
			#print_r($matches);
			
			$table_name = $matches[1];
		} else {
			echo "No match!\n";
		}
		
		$c = Formatting_ListOfWordsHelper::capitalise_delimited_string($table_name, '_');
		
		#echo $c;
		#exit;
		
		return $c;
	}
	
	/**
	 * TO DO:
	 *  Deal with irregular plurals.
	 */
	public function
		get_managed_object_name_singular()
	{
		$plural = $this->get_managed_object_name_plural();
		
		$singular = '';
		
		if (preg_match('/(.*)ies$/i', $plural, $matches)) {
			$singular = $matches[1] . 'y';
		} else {
			$singular = rtrim($plural, 's');
		}
		
		return $singular;
	}
	
	public function
		get_data_table_fields()
	{
		$field_assocs = $this->get_field_assocs();
		
		$data_table_fields = array();
		
		foreach ($field_assocs as $fa) {
			$dtf = array();
			
			$dtf['col_name'] = $fa['col_name'];
			$dtf['filter'] = $fa['filter'];
			
			$data_table_fields[] = $dtf;
		}
		
		return $data_table_fields;
	}
	
	public function
		get_field_assocs()
	{
		$field_assocs = array();
		
		$lines = $this->get_lines_of_schema_file();
		
		$in_fields = FALSE;
		
		foreach ($lines as $line) {
			if ($line == 'fields:') {
				$in_fields = TRUE;
				continue;
			}
			
			if ($in_fields) {
				$csvs = explode(',', $line);
				
				$fa = array();
				
				$i = 0;
				$fa['col_name'] = $csvs[$i++];
				$fa['filter'] = $csvs[$i++];
				$fa['input_type'] = $csvs[$i++];
				$fa['set_type'] = $csvs[$i];
				
				if (strlen($fa['filter']) == 0) {
					$fa['filter'] = 'return $str;';
				}
				
				$field_assocs[] = $fa;
			}
			
			if ($in_fields && (preg_match('/^\s*$/', $line))) {
				$in_fields = FALSE;
				break;
			}
		}
		
		#print_r($field_assocs); exit;
		
		return $field_assocs;
	}
	
	public function
		get_required_fields()
	{
		$field_assocs = $this->get_field_assocs();
		
		$rfs = array();
		
		foreach ($field_assocs as $fa) {
			$rfs[] = $fa['col_name'];
		}
		
		return $rfs;
	}
	
	public function
		get_set_clause()
	{
		$set_clause = ' SET ';
		
		$field_assocs = $this->get_field_assocs();
		
		$dbh = DB::m();
		
		$first = TRUE;
		foreach ($field_assocs as $fa) {
			if ($first) {
				$first = FALSE;
			} else {
				$set_clause .= ' , ';
			}
			
			$set_clause .= $fa['col_name'] . ' = ';
			
			if ($fa['set_type'] == 's') {
				$set_clause .= '\'';
			}
			
			$set_clause .= mysql_real_escape_string($_POST[$fa['col_name']], $dbh);
			
			if ($fa['set_type'] == 's') {
				$set_clause .= '\'';
			}
		}
		
		return $set_clause;
	}
}
?>