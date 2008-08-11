<?php
/**
 * Admin_LogInHelper
 *
 * @copyright RFI, 2008-02-18
 */

class
	Admin_LogInHelper
{
	public static function
		is_logged_id()
	{
		$alm = Admin_LoginManager::get_instance();
		
		return $alm->is_logged_in();
	}
}
?>