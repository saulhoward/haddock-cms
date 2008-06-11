<?php
/**
 * Shop_CheckoutManager
 *
 * @copyright Clear Line Web Design, 2007-09-12
 */

class
	Shop_CheckoutManager
{
	private function
		__construct()
	{
	}

	public static function
		get_instance()
	{
		$svm = Caching_SessionVarManager::get_instance();
		if (!$svm->is_set('checkout-manager'))
		{
			$checkout_manager = new Shop_CheckoutManager();
			$svm->set('checkout-manager', $checkout_manager);
		}
		return $svm->get('checkout-manager');
	}
	
	/**
	 * Determines what stage of the checkout process the user has reached.
	 *
	 * Possible statuses:
	 * 	- 'no-shopping-basket'
	 * 	- 'accounts'
	 * 	- 'shipping-details'
	 * 	- 'checkout-error'
	 */
	public function
		get_checkout_status()
	{

		// accounts >> shipping-details >> payment-options
		//
		// if not logged_in then return accounts
		//
		// if you are logged and you haven't confirmed shipping-details then return shipping-details
		//
		// if you are logged and you have confirmed shippin-details then return payment-options
		//
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
	
		$current_session_has_shopping_basket = 
			$shopping_baskets_table
				->check_for_current_session_in_shopping_baskets();

		if (!$current_session_has_shopping_basket)
		{
			return 'no-shopping-basket';
		}

		$log_in_manager = Shop_LogInManager::get_instance();

		if (!$log_in_manager->is_logged_in())
		{
			return 'accounts';
		}
		elseif ($log_in_manager->is_logged_in())
		{
			if (!$this->are_shipping_details_confirmed())
			{
				return 'shipping-details';
			}
			elseif ($this->are_shipping_details_confirmed())
			{

				return 'payment-options';
			}
		}
		
		return 'checkout-error';
	}
	
	public function
		are_shipping_details_confirmed()
	{

		$log_in_manager = Shop_LogInManager::get_instance();
		$customer = $log_in_manager->get_user();

		$confirmation_of_shipping_details = $this->get_shipping_details_confirmation_answer();

		if (
			$confirmation_of_shipping_details == TRUE
			&&
			$customer->get_address_id() != 0
			&&
			$customer->get_telephone_number_id() != 0
			&&
			$customer->get_customer_region_id() != 0
		)
		{
			return TRUE;

		}

		return FALSE;
	}
	
	public function
		get_shipping_details_confirmation_answer()
	{
		$svm = Caching_SessionVarManager::get_instance();
		if ($svm->is_set('customer_shipping_details_confirmed'))
		{
			return $svm->get('customer_shipping_details_confirmed');
		}
		return FALSE;
	}
	
	public function
		set_shipping_details_confirmation_answer($shipping_details_confirmation_answer)
	{
		$svm = Caching_SessionVarManager::get_instance();
		return $svm->set(
			'checkout-shipping-details-confirmation-answer', 
			$shipping_details_confirmation_answer
		);
	}
	
	/**
	 * The purpose of this div is to tell the customer which
	 * the stage of the checkout process they have reached.
	 *
	 * A short explanation of the stage is also given.
	 */
	public function
		get_checkout_status_div()
	{
		// accounts >> shipping-details >> payment-options
	
		$checkout_status = $this->get_checkout_status();
		
		#echo $checkout_status; exit;
		
		$checkout_status_div = new HTMLTags_Div();
		$checkout_status_div->set_attribute_str('id', 'checkout_status_div');

		$checkout_status_ul = new HTMLTags_UL();
		
		switch ($checkout_status) {
			case 'accounts':
				$status_step_one_li = new HTMLTags_LI();
				$status_step_one_li->append_tag_to_content(new HTMLTags_Em('Log In'));
				$checkout_status_ul->append_tag_to_content($status_step_one_li);
				
				$status_step_two_li = new HTMLTags_LI();
				$status_step_two_li->append_str_to_content('Shipping Details');
				$checkout_status_ul->append_tag_to_content($status_step_two_li);
				
				$status_step_three_li = new HTMLTags_LI();
				$status_step_three_li->append_str_to_content('Go to Secure Server');
				$checkout_status_ul->append_tag_to_content($status_step_three_li);
				
				$p_text = <<<TXT
Please complete this form and create an account with us.
Alternatively, log in with your existing email address and password.
TXT;
				
				break;
			case 'shipping-details':
				$status_step_one_li = new HTMLTags_LI();
				$status_step_one_li->append_str_to_content('Log In');
				$checkout_status_ul->append_tag_to_content($status_step_one_li);
				
				$status_step_two_li = new HTMLTags_LI();
				$status_step_two_li->append_tag_to_content(new HTMLTags_Em('Shipping Details'));
				$checkout_status_ul->append_tag_to_content($status_step_two_li);
				
				$status_step_three_li = new HTMLTags_LI();
				$status_step_three_li->append_str_to_content('Go to Secure Server');
				$checkout_status_ul->append_tag_to_content($status_step_three_li);
				
				$p_text = <<<TXT
Please enter or confirm your shipping address, this must be the same as your billing address. 
TXT;

				break;
			case 'payment-options':
				$status_step_one_li = new HTMLTags_LI();
				$status_step_one_li->append_str_to_content('Log In');
				$checkout_status_ul->append_tag_to_content($status_step_one_li);
				
				$status_step_two_li = new HTMLTags_LI();
				$status_step_two_li->append_str_to_content('Shipping Details');
				$checkout_status_ul->append_tag_to_content($status_step_two_li);
				
				$status_step_three_li = new HTMLTags_LI();
				$status_step_three_li->append_tag_to_content(new HTMLTags_Em('Go to Secure Server'));
				$checkout_status_ul->append_tag_to_content($status_step_three_li);
				
				$p_text = <<<TXT
Check your shipping details and shopping basket.
TXT;

				$p2_text = <<<TXT
When you're happy, click the button below to be 
transfered to a secure server where you 
can enter your credit card details to complete the payment.
TXT;
				break;
		}
		
		$checkout_status_div->append_tag_to_content($checkout_status_ul);
		
		$checkout_status_div->append_tag_to_content(new HTMLTags_P($p_text));
		
		if (isset($p2_text)) {
			$checkout_status_div->append_tag_to_content(new HTMLTags_P($p2_text));
		}

		return $checkout_status_div;
	}
}
?>
