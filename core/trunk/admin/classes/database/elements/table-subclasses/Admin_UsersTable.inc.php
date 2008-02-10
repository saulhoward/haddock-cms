<?php
/**
 * Admin_UsersTable
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';

class
	Admin_UsersTable
extends
    Database_Table
{
    /**
     * Should this list be dependent on who is logged in?
     */
    public function
        get_admin_users_viewable_by_currently_logged_in_user()
    {
        return $this->get_all_rows();
    }
}
?>
