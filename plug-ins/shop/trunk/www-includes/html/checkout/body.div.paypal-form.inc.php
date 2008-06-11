<?php
/**
 * The PayPal form div of the Checkout page
 * Step 3 in the Checkout Process
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$log_in_manager = Shop_LogInManager::get_instance();

$page_manager = PublicHTML_PageManager::get_instance();
$current_page_url = $page_manager->get_script_uri();
$redirect_script_url = clone $current_page_url;
$redirect_script_url->set_get_variable('type', 'redirect-script');
$cancel_href = $current_page_url;

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$customers_table = $database->get_table('hpi_shop_customers');
$customers_table_renderer = $customers_table->get_renderer();
$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();

$paypal_form_div = new HTMLTags_Div();
$paypal_form_div->set_attribute_str('id', 'paypal_form_div');

$paypal_form = new HTMLTags_Form();

$paypal_form_action = new HTMLTags_URL();
//$paypal_form_action->set_file('https://www.paypal.com/cgi-bin/webscr'); 	# The real thing
$paypal_form_action->set_file('https://www.sandbox.paypal.com/cgi-bin/webscr'); # The sandbox
$paypal_form->set_action($paypal_form_action);
$paypal_form->set_attribute_str('method', 'post');

// Overall Settings
$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
$currency = $customer_region->get_currency();

$paypal_form->add_hidden_input('cmd', '_cart');
$paypal_form->add_hidden_input('upload', '1');
//$paypal_form->add_hidden_input('business', 'brighton-wok-paypal@connectedfilms.com');	# The Real Thing	
$paypal_form->add_hidden_input('business', 'saulho_1190685903_biz@gmail.com');		# The Sandbox	
$paypal_form->add_hidden_input('currency_code', $currency->get_iso_4217_code());
$paypal_form->add_hidden_input('custom', session_id());

# NOTIFY URL -urlencode, + it can only have one get variable
$secret = 'shhhh';
$paypal_form->add_hidden_input('notify_url', 'http://testing.connected-films-shop.vafan.clearlinewebdesign.com/?section=plug-ins&module=paypal-payments&page=paypal-ipn&type=txt&secret=shhhhh');

// Shopping Cart Items
$shopping_baskets = $shopping_baskets_table->get_shopping_baskets_for_current_session();
$i = 1;
foreach ($shopping_baskets as $shopping_basket)
{
	// name
	$product = $shopping_basket->get_product();
	$paypal_form->add_hidden_input('item_name_' . $i, $product->get_name());

	// product_id
	$paypal_form->add_hidden_input('item_number_' . $i, $product->get_id());

	// price
	$product_currency_price = $product->get_product_currency_price($currency->get_id());
	$product_price = new Shop_SumOfMoney($product_currency_price->get_price(), $currency);
	$paypal_form->add_hidden_input('amount_' . $i, $product_price->get_as_string(FALSE));

	// quantity
	$paypal_form->add_hidden_input('quantity_' . $i, $shopping_basket->get_quantity());

	// shipping 1
	$shipping_price = new Shop_SumOfMoney($product->get_first_shipping_price_for_current_session(), $currency);
	$paypal_form->add_hidden_input('shipping_' . $i, $shipping_price->get_as_string(FALSE));

	// shipping 2
	$shipping2_price = new Shop_SumOfMoney($product->get_additional_shipping_price_for_current_session(), $currency);
	$paypal_form->add_hidden_input('shipping2_' . $i, $shipping2_price->get_as_string(FALSE));

	$i++;
}

// Address Override
$customer = $log_in_manager->get_user();
$address = $customer->get_address();
$paypal_form->add_hidden_input('address_override', '1');
$paypal_form->add_hidden_input('first_name', $customer->get_first_name());
$paypal_form->add_hidden_input('last_name', $customer->get_last_name());
$paypal_form->add_hidden_input('address1', $address->get_street_address());
$paypal_form->add_hidden_input('city', $address->get_locality());
$paypal_form->add_hidden_input('zip', $address->get_postal_code());
$paypal_form->add_hidden_input('country', $address->get_country_name());



$paypal_submit_input = new HTMLTags_Input();
$paypal_submit_input->set_attribute_str('type', 'submit');
$paypal_submit_input->set_attribute_str('value', 'Go to PayPal');
$paypal_form->append_tag_to_content($paypal_submit_input);

 
        foreach ($paypal_form->get_hidden_inputs() as $hidden_input) {
            $paypal_form->append_tag_to_content($hidden_input);
        }

$paypal_form_div->append_tag_to_content($paypal_form);

/*
 * Example of address override
 */
//            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
//                    <input type="hidden" name="cmd" value="_xclick">
//                    <input type="hidden" name="business" value="seller@designerfotos.com">
//                    <input type="hidden" name="item_name" value="Memorex 256MB Memory Stick">
//                    <input type="hidden" name="item_number" value="MEM32507725">
//                    <input type="hidden" name="amount" value="3">
//                    <input type="hidden" name="tax" value="1">
//                    <input type="hidden" name="quantity" value="1">
//                    <input type="hidden" name="no_note" value="1">
//                    <input type="hidden" name="currency_code" value="USD">
//                    <!--
//                    Override the customer’s stored PayPal address
//                    -->
//                    <input type="hidden" name="address_override" value="1">
//                    <!-- Set the prepopulation variables that override the stored address -->
//                   <input type="hidden" name="first_name" value="John">
//                   <input type="hidden" name="last_name" value="Doe">
//                   <input type="hidden" name="address1" value="345 Lark Ave">
//                   <input type="hidden" name="city" value="San Jose">
//                   <input type="hidden" name="state" value="CA">
//                   <input type="hidden" name="zip" value="95121">
//                   <input type="hidden" name="country" value="US">
//                   <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-
//                   but01.gif" border="0" name="submit" alt="Make payments with PayPal - it's
//                   fast, free and secure!">
//           </form>


/*
 * Example of shopping basket stuff
 */
//            <form action=”https://www.paypal.com/cgi-bin/webscr” method=”post”>
//                    <input type=”hidden” name=”cmd” value=”_cart”>
//                    <input type=”hidden” name=”upload” value=”1”>
//                    <input type=”hidden” name=”business” value=”seller@designerfotos.com”>
//                    <input type=”hidden” name=”item_name_1” value=”Item Name 1”>
//                    <input type=”hidden” name=”amount_1” value=”1.00”>
//                    <input type=”hidden” name=”item_name_2” value=”Item Name 2”>
//                    <input type=”hidden” name=”amount_2” value=”2.00”>
//                   <input type=”submit”” value=”PayPal”>
//           </form>



echo $paypal_form_div->get_as_string();
?>
