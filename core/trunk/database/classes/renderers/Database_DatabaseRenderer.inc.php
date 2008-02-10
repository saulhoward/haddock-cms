<?php
/**
 * Database_DatabaseRenderer
 *
 * @copyright Clear Line Web Design, 2006-09-21
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_Renderer.inc.php';

/**
 * Provides code for rendering databases.
 *
 * Subclasses might eventually be saved in
 *
 * PROJECT_ROOT . '/classes/renderers/database-renderers/'
 *
 * There are currently no facilities to access these
 * classes at this point but this could be added
 * easily.
 * See the get_renderer() methods in Table or Row.
 */
class
    Database_DatabaseRenderer
extends
    Database_Renderer
{
    public function render_tables_list()
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
