<?php
/**
 * MailingList_PeopleHelper
 *
 * @copyright RFI, 2008-02-18
 */

class
	MailingList_PeopleHelper
{
	public static function
		add_person(
			$name,
			$email,
			$force_email
		)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		
		$people_table = $database->get_table('hpi_mailing_list_people');
	
		$last_added_id = $people_table->add_person(
			$name,
			$email,
			$force_email
		);
		
		return $last_added_id;
	}
}
?>