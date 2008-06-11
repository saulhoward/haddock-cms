<?php
/**
 * The redirect script for the checkout page.
 *
 * @copyright Clear Line Web Design, 2007-02-19
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
if (isset($_GET['edit_customer_details']))
{
		/*
		 * UnSet the Session Variable
		 * that shows shipping details have been confirmed
		 */
		$svm->set('customer_shipping_details_confirmed', FALSE);

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
}
?>
