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
		echo 'print_r($_GET)' . "\n";
		print_r($_GET);
		echo 'print_r($_POST)' . "\n";
		print_r($_POST);
		//echo 'print_r($_SESSION)' . "\n";
		//print_r($_SESSION);
		echo '$_SESSION[\'name\']: ' . $_SESSION['name'] . "\n";
		echo '$_SESSION[\'email\']: ' . $_SESSION['email'] . "\n";
		
		$return_to_url = MailingList_SignUpURLFactory::get_email_adding_html_page();
		
		if (isset($_GET['add_person'])) {
			$mysql_user_factory = Database_MySQLUserFactory::get_instance();
			$mysql_user = $mysql_user_factory->get_for_this_project();
			$database = $mysql_user->get_database();
			
			$people_table = $database->get_table('hpi_mailing_list_people');
			
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
		
		print_r($return_to_url);
		#exit;
		
		return $return_to_url;
	}
}
?>