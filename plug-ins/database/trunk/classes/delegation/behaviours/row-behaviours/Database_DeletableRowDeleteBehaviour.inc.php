<?php
/**
 * Database_DeletableRowDeleteBehaviour
 * 
 * RFI & SANH 2006-12-04
 */

require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/Database_RowBehaviour.inc.php';

require_once PROJECT_ROOT . '/haddock/database/classes/delegation/interfaces/row-interfaces/Database_DeletableRow.inc.php';

class Database_DeletableRowDeleteBehaviour extends Database_RowBehaviour
{
    public function __construct(Database_DeletableRow $row)
    {
        parent::__construct($row);
    }
    
    public function run()
    {
        $row = $this->get_row();
        
        $table = $row->get_table();
        
        $values['deleted'] = 'Yes';
        
        $table->update_by_id($row->get_id(), $values);
    }
}
?>
