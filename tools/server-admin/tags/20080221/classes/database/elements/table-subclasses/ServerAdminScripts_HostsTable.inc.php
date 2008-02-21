<?php
/**
 * ServerAdminScripts_HostsTable
 *
 * @copyright Clear Line Web Design, 2007-04-30
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';

class
    ServerAdminScripts_HostsTable
extends
    Database_Table
{
    public function
        get_id_for_host($host_name)
    {
        $conditions['name'] = $host_name;
        
        return $this->get_id_for_super_key_with_possible_insert($conditions);
    }
}
?>
