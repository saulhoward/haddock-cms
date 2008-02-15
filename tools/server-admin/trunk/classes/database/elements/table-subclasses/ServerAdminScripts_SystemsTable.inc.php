<?php
/**
 * ServerAdminScripts_SystemsTable
 *
 * @copyright Clear Line Web Design, 2007-04-30
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';

class
    ServerAdminScripts_SystemsTable
extends
    Database_Table
{
    public function
        get_id_for_system($system_name)
    {
        $conditions['name'] = $system_name;
        
        return $this->get_id_for_super_key_with_possible_insert($conditions);
    }
}
?>
