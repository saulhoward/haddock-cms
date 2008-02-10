<?php
/**
 * The redirect script for the mailing-list page in the mailing-list plug-in.
 *
 * @copyright Clear Line Web Design, 2007-07-14
 */

$page_manager = PublicHTML_PageManager::get_instance();
#print_r($page_manager);
#exit;

#throw new Exception('Just for the heck of it!');

//echo 'print_r($_GET)' . "\n";
//print_r($_GET);
//echo 'print_r($_POST)' . "\n";
//print_r($_POST);
////echo 'print_r($_SESSION)' . "\n";
////print_r($_SESSION);
//echo '$_SESSION[\'name\']: ' . $_SESSION['name'] . "\n";
//echo '$_SESSION[\'email\']: ' . $_SESSION['email'] . "\n";

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

	$return_to_url = $page_manager->get_return_to_url();
#	print_r($return_to_url);
#	exit;
	 
    //if ($_POST['name'] != '' && $_POST['email'] != '') {
    //    if (
    //        isset($_POST['force_email'])
    //        or
    //        preg_match('/^[a-z0-9._-]+(?:\+.*)?@[a-z0-9-]+(?:\.[a-z0-9-]+)*\.[a-z]{2,6}$/i', $_POST['email'])
    //    ) {
    //        #$ip = $_SERVER['REMOTE_ADDR'];
            
            try {
                #echo 'About to call: $people_table->add_person(...)' . "\n";
                $last_added_id = $people_table->add_person(
                    $_POST['name'],
                    $_POST['email'],
                    isset($_POST['force_email'])
                );
                
                #$return_to .= '&last_added_id=' . $last_added_id;
                #$page_manager->append_to_return_to_uri('&last_added_id=' . $last_added_id);
                #$return_to_url = $page_manager->get_return_to_url();
                #$return_to_url->set_get_variable('last_added_id', $last_added_id);
                $return_to_url->set_get_variable('person_added');
                
                $_SESSION['last_added_id'] = $last_added_id;
                
                unset($_SESSION['name']);
                unset($_SESSION['email']);
            } catch (MailingList_NameAndEmailException $e) {
                #$return_to_url = $page_manager->get_return_to_url();
                
                $return_to_url->set_get_variable('form_incomplete');
            } catch (MailingList_NameTooLongException $e) {
                #$return_to_url = $page_manager->get_return_to_url();
                
                $return_to_url->set_get_variable('name_too_long');
            } catch (MailingList_EmailTooLongException $e) {
                #$return_to_url = $page_manager->get_return_to_url();
                
                $return_to_url->set_get_variable('email_too_long');
            } catch (MailingList_InvalidEmailException $e) {
                #$return_to_url = $page_manager->get_return_to_url();
                
                $return_to_url->set_get_variable('email_incorrect');
            } catch (Database_InvalidUserInputException $e) {
                #die($e->getMessage());
                
                #$return_to_url = $page_manager->get_return_to_url();
                
                //echo 'print_r($return_to_url): ' . "\n";
                //print_r($return_to_url);
                
                #$return_to_url->set_get_variable('page', 'error');
                $return_to_url->set_get_variable('error_message', urlencode($e->getMessage()));
                
                //echo 'print_r($return_to_url): ' . "\n";
                //print_r($return_to_url);
                
                #$page_manager->set_return_to_url($return_to_url);
            }
    //    } else {
    //        #$return_to .= '&email_incorrect=1';
    //        $page_manager->append_to_return_to_uri('&email_incorrect=1');
    //    }
    //} else {
    //    #$return_to .= '&form_incomplete=1';
    //    $page_manager->append_to_return_to_uri('&form_incomplete=1');
    //}
}

#echo "\$return_to: $return_to\n";

?>
