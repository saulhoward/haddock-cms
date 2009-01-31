<?php
/**
 * Database_SortableRowMaxSortOrderBehaviour
 * 
 * RFI & SANH 2006-12-04
 */

#require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_SortableRowBehaviour.inc.php';

class Database_SortableRowMaxSortOrderBehaviour extends Database_SortableRowBehaviour
{
    public function run()
    {
        $row = $this->get_row();
        
        $table = $row->get_table();
        $database = $table->get_database();
        $dbh = $database->get_database_handle();
        
        $query = 'SELECT MAX(sort_order) FROM ' . $table->get_name();
        
        $group_frag = $row->get_sort_order_group_where_clause_fragment();
        
        if (strlen($group_frag) > 0) {
            $query .= ' WHERE ';
            
            $query .= $group_frag;
        }
        
        $result = mysql_query($query, $dbh);
        
        $max = 0;
        
        while ($row_from_result = mysql_fetch_array($result)) {
            $max = $row_from_result[0];
        }
        
        return $max;
    }
}
?>
