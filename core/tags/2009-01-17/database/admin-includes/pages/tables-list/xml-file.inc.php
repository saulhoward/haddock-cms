<?php
/**
 * The XML file that gives a list of the tables in this
 * database.
 *
 * @copyright Clear Line Web Design, 2007-05-14
 */

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$dom = new DOMDocument('1.0', 'UTF-8');

if (isset($_GET['tables'])) {
    $tables_element = $dom->createElement('tables');
    $dom->appendChild($tables_element);
    
    $tables = $database->get_tables();
    
    foreach ($tables as $table) {
        $table_element = $dom->createElement('table');
        $tables_element->appendChild($table_element);
        
        /*
         * Which of the following is really better?
         */
        #$table_element->setAttribute('name', $table->get_name());
        $name_text_node = $dom->createTextNode($table->get_name());
        
        $table_element->appendChild($name_text_node);
    }
}

echo $dom->saveXML();
?>
