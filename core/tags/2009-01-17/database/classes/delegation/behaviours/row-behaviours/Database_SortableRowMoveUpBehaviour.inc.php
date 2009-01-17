<?php
/**
 * Database_SortableRow
 *
 * RFI & SANH 2006-12-02
 */

require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_SortableRowBehaviour.inc.php';

class Database_SortableRowMoveUpBehaviour extends Database_SortableRowBehaviour
{
    public function run()
    {
        $row = $this->get_row();
        
        $table = $row->get_table();
        $database = $table->get_database();
        $dbh = $database->get_database_handle();
        
        $table_name = $table->get_name();
        
        $this_sort_order = $row->get_sort_order();
        
        $query = <<<SQL
SELECT
    id
FROM
    $table_name
WHERE
    sort_order > $this_sort_order
SQL;
        
        $group_frag = $row->get_sort_order_group_where_clause_fragment();
        
        if (strlen($group_frag) > 0) {
            $query .= ' AND ';
            $query .= $group_frag;
        }

        $query .= <<<SQL

ORDER BY
    sort_order ASC
LIMIT
    0, 1
SQL;
        
        $result = mysql_query($query, $dbh);
        
        $that_id = 0;
        
        while ($row_from_result = mysql_fetch_array($result)) {
            $that_id = $row_from_result[0];
        }
        
        $that = $table->get_row_by_id($that_id);
        
        $values = null;
        $values['sort_order'] = $that->get_sort_order();
        
        $table->update_by_id($row->get_id(), $values);
        
        $values = null;
        $values['sort_order'] = $this_sort_order;
        
        $table->update_by_id($that_id, $values);
    }
}
?>
