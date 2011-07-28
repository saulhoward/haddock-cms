<?php
/**
 * Admin_ListUsersCLIScript
 *
 * @copyright 2008-08-10, Robert Impey
 */

class
	Admin_ListUsersCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$user_assocs = array();
		
		foreach (
			Admin_UsersHelper::get_all_user_entries()
			as
			$user_entry
		) {
			$user_assocs[] = $user_entry->get_assoc();
		}
		
		CLIScripts_DataRenderingHelper
			::render_array_of_assocs_in_table(
				$user_assocs,
				array(
					'id' => 'ID'
				)
			);
	}
}
?>