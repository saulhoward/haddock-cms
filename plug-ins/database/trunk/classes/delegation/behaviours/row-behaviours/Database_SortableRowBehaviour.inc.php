<?php
/**
 * Database_SortableRowBehaviour
 * 
 * RFI & SANH 2006-12-04
 */

require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/Database_RowBehaviour.inc.php';

require_once PROJECT_ROOT . '/haddock/database/classes/delegation/interfaces/row-interfaces/Database_SortableRow.inc.php';

abstract class Database_SortableRowBehaviour extends Database_RowBehaviour
{
    public function __construct(Database_SortableRow $row)
    {
        parent::__construct($row);
    }
}
?>
