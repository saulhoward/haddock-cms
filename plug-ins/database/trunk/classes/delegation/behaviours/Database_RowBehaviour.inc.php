<?php
/**
 * Database_RowBehaviour
 *
 * @copyright Clear Line Web Design, 2006-12-04
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Row.inc.php';

abstract class
    Database_RowBehaviour
{
    private $row;
    
    public function
        __construct(Database_Row $row)
    {
        $this->row = $row;
    }
    
    protected function
        get_row()
    {
        return $this->row;
    }
    
    abstract public function
        run();
}
?>
