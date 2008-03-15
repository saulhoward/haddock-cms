<?php
class
	OrderedTables_AdminCRUDShiftRedirectScript
extends
	Admin_RestrictedRedirectScript
{
	public function
		do_actions()
	{
		if (isset($_GET['action'])) {
			switch ($_GET['action']) {
				case 'shift_back':
				case 'shift_forward':
					OrderedTables_AdminCRUDHelper::shift($_GET);
					break;
				default:
					throw new Exception('Unknown action name!');
			}
		} else {
			throw new Exception('Action not set!');
		}
	}
}
?>