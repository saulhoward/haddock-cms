<?php
/**
 * The redirect script for the checkout page.
 *
 * @copyright 2007-02-19, Clear Line Web Design
 */


/*
 * Create the singleton variables.
 */
$svm = Caching_SessionVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();

/*
 * Add Customer Details to Customer
 */
if (isset($_GET['customer_details']))
{
	/*
	 * Check that we know where to go if something has gone
	 * wrong.
	 */
	$form_location = new HTMLTags_URL();

	if (isset($_GET['form_location'])) {
		$form_location->parse_url($_GET['form_location']);
	} elseif (isset($_SERVER['HTTP_REFERER'])) {
		$form_location->parse_url($_SERVER['HTTP_REFERER']);
	} else {
		throw new Exception('Unable to set the form URL!');
	}
	try {
		//	throw
		//            new InputValidation_InvalidInputException(
		//                'Debug error message.'
		//            );
		/*
		 * Preliminary checks of the user's input.
		 */
		if (
			!isset($_POST['first_name'])
			||
			(strlen($_POST['first_name']) == 0)
		) {
			throw
				new InputValidation_InvalidInputException(
					'Please enter your first name.'
				);
		}
		if (
			!isset($_POST['last_name'])
			||
			(strlen($_POST['last_name']) == 0)
		) {
			throw
				new InputValidation_InvalidInputException(
					'Please enter your last name.'
				);
		}
		if (
			!isset($_POST['telephone_number'])
			||
			(strlen($_POST['telephone_number']) == 0)
		) {
			throw
				new InputValidation_InvalidInputException(
					'Please enter your telephone number.'
				);
		}
		if (
			!isset($_POST['street_address'])
			||
			(strlen($_POST['street_address']) == 0)
		) {
			throw
				new InputValidation_InvalidInputException(
					'Please enter your street address.'
				);
		}
		if (
			!isset($_POST['locality'])
			||
			(strlen($_POST['locality']) == 0)
		) {
			throw
				new InputValidation_InvalidInputException(
					'Please enter your city.'
				);
		}
		if (
			!isset($_POST['postal_code'])
			||
			(strlen($_POST['postal_code']) == 0)
		) {
			throw
				new InputValidation_InvalidInputException(
					'Please enter your post code.'
				);
		}
		if (
			!isset($_POST['country_name'])
			||
			(strlen($_POST['country_name']) == 0)
		) {
			throw
				new InputValidation_InvalidInputException(
					'Please enter your country.'
				);
		}

		/*
		 * Add the details
		 */
		$user = $log_in_manager->get_user();

		$muf = Database_MySQLUserFactory::get_instance();
		$mu = $muf->get_for_this_project();
		$database = $mu->get_database();
		$customers_table = $database->get_table('hpi_shop_customers');

		$customers_table->edit_customer(
			$user->get_id(),		#$edit_id,
			$_POST['first_name'],		#$first_name,
			$_POST['last_name'],		#$last_name,
			$user->get_email_address(),	#$email_address,
			$_POST['telephone_number'],	#$telephone_number,
			'',				#$address_post_office_box,
			'',				#$address_extended_address,
			$_POST['street_address'],	#$address_street_address,
			$_POST['locality'],		#$address_locality,
			'',				#$address_region,
			$_POST['postal_code'],		#$address_postal_code,
			$_POST['country_name'],		#$address_country_name,
			$_POST['customer_region_id']	#$customer_region_id
		);

		/*
		 * Set the Session Variable
		 * to show shipping details have been confirmed
		 */
		$_SESSION['customer_region_id'] = $_POST['customer_region_id'];
		$svm->set('customer_shipping_details_confirmed', TRUE);

		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
		$current_session_has_shopping_basket = 
			$shopping_baskets_table->check_for_current_session_in_shopping_baskets();
		if ($current_session_has_shopping_basket) {
			$shopping_baskets_table->delete_illegal_shopping_baskets_for_current_customer_region();	
			$shopping_baskets_table->convert_shopping_baskets_for_current_session_to_new_customer_region();
		}
		/*
		 * Set the return location after successfully adding to the database.
		 */
		$return_to_url = new HTMLTags_URL();

		if (isset($_GET['desired_location'])) {
			$return_to_url->parse_url(
				urldecode($_GET['desired_location'])
			);
		} else {
			$return_to_url->set_file('/');
		}


		$return_to_url->set_get_variable('updated_details', 1);
		$page_manager->set_return_to_url($return_to_url);

	} catch (InputValidation_InvalidInputException $e) {
		/*
		 * If there's been an input error,
		 * go back to the form.
		 */
		$form_location->set_get_variable('error_message', $e->getMessage());

		$page_manager->set_return_to_url($form_location);
	} 
}
?>