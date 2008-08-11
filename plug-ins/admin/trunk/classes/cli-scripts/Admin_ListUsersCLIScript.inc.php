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
		#/*
		# * Fetch the data on the admin users.
		# */
		#$user_entries = Admin_UsersHelper::get_all_user_entries();
		#
		#/*
		# * Preprocess the user data.
		# */
		#$preprocessed_users = array();
		#
		#foreach ($user_entries as $user_entry) {
		#	$preprocessed_users[]
		#		= array(
		#			'name' => $user_entry->get_name(),
		#			'email' => $user_entry->get_email(),
		#			'real_name' => $user_entry->get_real_name(),
		#			'type' => $user_entry->get_type()
		#		);
		#}
		#
		#/*
		# * Print of the data.
		# */
		#CLIScripts_DataRenderingHelper
		#	::render_array_of_assocs_in_table(
		#		$preprocessed_users
		#	);
		
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