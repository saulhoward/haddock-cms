<?php
/**
 * Database_DatabaseRenderer
 *
 * @copyright 2006-09-21, Robert Impey
 */

/**
 * Provides code for rendering databases.
 */
class
	Database_DatabaseRenderer
extends
	Database_Renderer
{
	public function
		render_tables_list()
	{
		$database = $this->get_element();
		
		$tables = $database->get_tables();

		echo "<ul>\n";

		foreach ($tables as $table) {
			echo "<li>\n";
			
			#echo '<a href="/database/index.php?page=table&table=' . $table->get_name() . '">';
			#echo '<a href="/admin/index.php?module=database&page=table&table=' . $table->get_name() . '">';
			
			/*
			 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			 *
			 * TO DO:
			 *
			 *  Move this to the table render class.
			 * 
			 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			 */
			echo '<a href="/?section=haddock&module=admin&page=admin-includer&type=html&admin-section=haddock&admin-module=database&admin-page=table&table=' . $table->get_name() . '">';
			
			echo $table->get_name();
			echo "</a>\n";
			
			echo "</li>\n";
		}
		
		echo "</ul>\n";
	}
}

?>
