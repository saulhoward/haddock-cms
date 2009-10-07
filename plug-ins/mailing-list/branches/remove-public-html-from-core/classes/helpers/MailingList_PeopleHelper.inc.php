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

	public static function
		attemp_to_add_person()
	{
		#echo 'print_r($_GET)' . "\n"; print_r($_GET);
		
		#echo 'print_r($_POST)' . "\n"; print_r($_POST);
		
		//echo 'print_r($_SESSION)' . "\n";
		//print_r($_SESSION);
		
		#echo '$_SESSION[\'name\']: ' . $_SESSION['name'] . "\n";
		#echo '$_SESSION[\'email\']: ' . $_SESSION['email'] . "\n";
		
		$return_to_url = MailingList_SignUpURLFactory::get_email_adding_html_page();
		#print_r($return_to_url); exit;
		
		if (isset($_GET['add_person'])) {
			$mysql_user_factory = Database_MySQLUserFactory::get_instance();
			#print_r($mysql_user_factory); exit;
			
			$mysql_user = $mysql_user_factory->get_for_this_project();
			#print_r($mysql_user); exit;
			
			$database = $mysql_user->get_database();
			#print_r($database); exit;
			
			$people_table = $database->get_table('hpi_mailing_list_people');
			#print_r($people_table); exit;
			
			if (isset($_POST['name'])) {
				$_SESSION['name'] = $_POST['name'];
			}

			if (isset($_POST['email'])) {
				$_SESSION['email'] = $_POST['email'];
			}

			try {
				$last_added_id = $people_table->add_person(
					$_POST['name'],
					$_POST['email'],
					isset($_POST['force_email'])
				);

				$return_to_url->set_get_variable('person_added');

				$_SESSION['last_added_id'] = $last_added_id;

				unset($_SESSION['name']);
				unset($_SESSION['email']);
			} catch (MailingList_NameAndEmailException $e) {
				$return_to_url->set_get_variable('form_incomplete');
			} catch (MailingList_NameTooLongException $e) {
				$return_to_url->set_get_variable('name_too_long');
			} catch (MailingList_EmailTooLongException $e) {
				$return_to_url->set_get_variable('email_too_long');
			} catch (MailingList_InvalidEmailException $e) {
				$return_to_url->set_get_variable('email_incorrect');
			} catch (Database_InvalidUserInputException $e) {
				$return_to_url->set_get_variable('error_message', urlencode($e->getMessage()));
			}
		}

		#print_r($return_to_url); exit;
		
		return $return_to_url;
	}

	public static function
		get_list_addresses_div()
	{

		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$people_table = $database->get_table('hpi_mailing_list_people');

		#$conditions = array();
		#$conditions['status'] = 'accepted';
		#
		#$people = $people_table->get_rows_where($conditions);

		$people = $people_table->get_all_rows();

		$div = new HTMLTags_Div();

		$people_p = new HTMLTags_Pre();
		$people_p->set_attribute_str('id', 'people-csv');

		$first = TRUE;
		$i = 0;
		foreach ($people as $person) {
			if ($first) {
				$first = FALSE;
			} else {
				$people_p->append_str_to_content(', ' . "\n");
			}
			if (strlen($person->get_name()))
			{
				$name = self::sanitise_name($person->get_name());
				$people_p->append_str_to_content('"');
				$people_p->append_str_to_content($name);
				$people_p->append_str_to_content('" ');
			}

			$email = self::sanitise_email($person->get_email());
			$people_p->append_str_to_content('&lt;');
			$people_p->append_str_to_content($email);
			$people_p->append_str_to_content('&gt;');
		}

		$div->append($people_p);
		return $div;
	}

	public static function
		sanitise_name($name)
	{
		$name = str_replace('"', '', $name);
		return $name;
	}
	
	/**
	 * Sanitises an email address.
	 *
	 * Should we check more mistakes?
	 * Should we provide a list in a separate text file of replacements?
	 * Might an individual project want to maintain their own list?
	 *
	 * @param string $email The email address to be sanitised.
	 * @return string The sanitised email address.
	 */
	public static function
		sanitise_email($email)
	{
		$email = str_replace('yahoo.company', 'yahoo.com', $email);
		
		return $email;
	}

	public function
		get_widget_content()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$people_table = $database->get_table('hpi_mailing_list_people');
		$widget_div = new HTMLTags_Div();

		$rows_html_ul = new HTMLTags_UL();
		$rows_html_ul->set_attribute_str('class', 'people');

		$query = <<<SQL
SELECT *
FROM hpi_mailing_list_people
WHERE status = 'new' OR status = 'accepted'
ORDER BY `added` DESC
LIMIT 0, 5
SQL;

		try
		{
			$rows = $people_table->get_rows_for_select($query);
		}
		catch (Exception $e)
		{

		}

		if (count($rows) > 0)
		{
			$explanation_p = new HTMLTags_P();
			$explanation_txt = <<<TXT
The last five people to join the list:
TXT;

			$explanation_p->append($explanation_txt);
			$widget_div->append($explanation_p);
			foreach ($rows as $row) {
				$li = new HTMLTags_LI();
				$li->append_str_to_content(
					$row->get_name() 
					. '&nbsp;(' 
					. $row->get_email() 
					. ')'
				);
				$rows_html_ul->append_tag_to_content($li);
			}
		}
		else
		{
			$no_people_p = new HTMLTags_P();
			$no_people_txt = <<<TXT
There are no people in the Mailing List.
TXT;

			$no_people_p->append($no_people_txt);
			$widget_div->append($no_people_p);
		}

		$widget_div->append_tag_to_content($rows_html_ul);
		$widget_div->append(self::get_mailing_list_links_ul());


		return $widget_div;
	}

	public static function
		get_mailing_list_links_ul()
	{
		$links = array(
			"Mailing List" => "/?section=haddock&module=admin&page=admin-includer&type=html&admin-section=plug-ins&admin-page=mailing-list&admin-module=mailing-list",
			"People CSV" => "/MailingList_ListAddressesAdminPage"
		);

		$ul = new HTMLTags_UL();
		$ul->set_attribute_str('class', 'inline');

		foreach ($links as $key => $value) {
			$li = new HTMLTags_LI();

			$url = new HTMLTags_URL();
			$url->set_file($value);
			$a = new HTMLTags_A($key);
			$a->set_href($url);

			$li->append($a);
			$ul->append($li);
		}
		
		return $ul;
	}
}
?>
