<?php
/**
 * The PayPal form div of the Checkout page
 * Step 3 in the Checkout Process
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

/**************************************************************************************************
* Values for you to update
**************************************************************************************************/

//Set to SIMULATOR for the VSP Simulator expert system, TEST for the Test Server and LIVE in the live environment
$strConnectTo = ProtxPayments_PaymentsManager::get_connect_to();
$strVirtualDir="VSPForm-Kit"; //Change if you have created a Virtual Directory in IIS with a different name

/** IMPORTANT.  Set the strYourSiteFQDN value to the Fully Qualified Domain Name of your server. **
** This should start http:// or https:// and should be the name by which our servers can call back to yours **
** i.e. it MUST be resolvable externally, and have access granted to the Protx servers **
** examples would be https://www.mysite.com or http://212.111.32.22/ **
** NOTE: You should leave the final / in place. **/
$strYourSiteFQDN = ProtxPayments_PaymentsManager::get_site_FQDN();

/** Set this value to the VSPVendorName assigned to you by protx or chosen when you applied **/
$strVSPVendorName = ProtxPayments_PaymentsManager::get_vendor_name();

/** Set this value to the XOR Encryption password assigned to you by Protx **/
$strEncryptionPassword = ProtxPayments_PaymentsManager::get_encryption_password();

/** Set this to indicate the currency in which you wish to trade. You will need a merchant number in this currency **/
$strCurrency = ProtxPayments_PaymentsManager::get_currency();

 /** Set this to the mail address which will receive order confirmations and failures **/
$strVendorEMail = ProtxPayments_PaymentsManager::get_vendor_email();

/** This can be DEFERRED or AUTHENTICATE if your Protx account supports those payment types **/
$strTransactionType = ProtxPayments_PaymentsManager::get_transaction_type();

/**************************************************************************************************
* Global Definitions for this site
**************************************************************************************************/

$strProtocol="2.22";

if ($strConnectTo=="LIVE") 
	$strPurchaseURL="https://ukvps.protx.com/vspgateway/service/vspform-register.vsp"; 
elseif ($strConnectTo=="TEST")
	$strPurchaseURL="https://ukvpstest.protx.com/vspgateway/service/vspform-register.vsp";
else
	$strPurchaseURL="https://ukvpstest.protx.com/VSPSimulator/VSPFormGateway.asp";
/**************************************************************************************************
* ---- END of PROTX SETTINGS ----
**************************************************************************************************/

//include("/scripts/Protx-includes.php");
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

// Overall Settings
$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
$currency = $customer_region->get_currency();
$customer = $log_in_manager->get_user();
$address = $customer->get_address();
$telephone_number = $customer->get_telephone_number();

##########################################################
##   CRYPT BUILDER
##########################################################

/** Okay, build the crypt field for VSP Form using the information in our session **
*** First we need to generate a unique VendorTxCode for this transaction **
*** We're using VendorName, time stamp and a random element.  You can use different methods if you wish **
*** but the VendorTxCode MUST be unique for each transaction you send to VSP Server **/

$intRandNum = rand(0,32000)*rand(0,32000);
$strVendorTxCode = $intRandNum;
					
/** Now to calculate the transaction total based on basket contents.  For security **
*** we recalculate it here rather than relying on totals stored in the session or hidden fields **
*** We'll also create the basket contents to pass to VSP Form. See the VSP Form Protocol for **
*** the full valid basket format.  The code below converts from our "x of y" style into **
*** the VSP system basket format (using a 17.5% VAT calculation for the tax columns) **/

// Shopping Cart Items
$shopping_baskets = $shopping_baskets_table->get_shopping_baskets_for_current_session();
$str_basket = '';

$number_of_lines_in_basket = count($shopping_baskets) + 1;
$str_basket .= $number_of_lines_in_basket . ':';
#
#&Basket=2:Razor Tee:1:::25.00:25.00:Delivery:::::4.50
#
foreach ($shopping_baskets as $shopping_basket)
{
	// Add TXN_ID (random no) to hpi_shop_shopping_baskets
	$shopping_basket->set_txn_id($strVendorTxCode);
	
	// name
	$product = $shopping_basket->get_product();
	$str_basket .= $product->get_name() . ':';

	// quantity
	$str_basket .= $shopping_basket->get_quantity() . ':';

	//Unit Cost Without Tax
	//NOTHING FOR NOW
	$str_basket .= ':';

	//Tax applied
	//NOTHING FOR NOW
	$str_basket .= ':';

	//Unit Total Cost with tax
	$product_currency_price = $product->get_product_currency_price($currency->get_id());
	$product_price = new Shop_SumOfMoney($product_currency_price->get_price(), $currency);
	$str_basket .= $product_price->get_as_string(FALSE) . ':';

	// Line Total (unit * quantity)
	$product_currency_price = $product->get_product_currency_price($currency->get_id());
	$line_total = new Shop_SumOfMoney(
		$product_currency_price->get_price() *  $shopping_basket->get_quantity(), $currency
	);
	$str_basket .= $line_total->get_as_string(FALSE) . ':';

}

$shipping_price = new Shop_SumOfMoney(
	$shopping_baskets_table->get_shipping_total_for_current_session($customer_region_id), $currency
);
//Delivery Total
$str_basket .= 'Delivery:1::::' . $shipping_price->get_as_string(FALSE);

######################################

// Now to build the VSP Form crypt field.  For more details see the VSP Form Protocol 2.22 
$strPost="VendorTxCode=" . $strVendorTxCode; /** As generated above **/

//print_r($customer_region);exit;
$shopping_baskets_total = new Shop_SumOfMoney(
	$shopping_baskets_table->get_total_for_current_session($customer_region->get_id()), $currency
);

$strPost=$strPost . "&Amount=" . $shopping_baskets_total->get_as_string(FALSE); // Formatted to 2 decimal places with leading digit
$strPost=$strPost . "&Currency=" . $currency->get_iso_4217_code();

// Up to 100 chars of free format description
$description_str = ProtxPayments_PaymentsManager::get_site_description();
$strPost=$strPost . "&Description=" . $description_str;


/* The SuccessURL is the page to which VSP Form returns the customer if the transaction is successful 
** You can change this for each transaction, perhaps passing a session ID or state flag if you wish */
$strPost=$strPost . "&SuccessURL=" . $strYourSiteFQDN . "?section=plug-ins&module=shop&page=payment-confirmed-protx&session=" . session_id();

/* The FailureURL is the page to which VSP Form returns the customer if the transaction is unsuccessful
** You can change this for each transaction, perhaps passing a session ID or state flag if you wish */
$strPost=$strPost . "&FailureURL=" . $strYourSiteFQDN . "?section=plug-ins&module=shop&page=payment-cancelled";

$strPost=$strPost . "&CustomerName=" . $customer->get_first_name() . $customer->get_last_name();
$strPost=$strPost . "&CustomerEMail=" . $customer->get_email_address();
$strPost=$strPost . "&VendorEMail=" . $strVendorEMail;

/* You can specify any custom message to send to your customers in their confirmation e-mail here 
** The field can contain HTML if you wish, and be different for each order.  The field is optional */
$email_message = ProtxPayments_PaymentsManager::get_email_message();
$strPost=$strPost . "&eMailMessage=" . $email_message;

$strPost=$strPost . "&BillingAddress=" . $address->get_street_address() . " " . $address->get_locality();
$strPost=$strPost . "&BillingPostCode=" . $address->get_postal_code();
$strPost=$strPost . "&DeliveryAddress=" . $address->get_street_address() . " " . $address->get_locality();
$strPost=$strPost . "&DeliveryPostCode=" . $address->get_postal_code();

// Optionally add the contact numbers, if they are present
$strPost=$strPost . "&ContactNumber=" . $telephone_number->get_telephone_number();

$strPost=$strPost . "&Basket=" . $str_basket; // As created above 

/* Allow fine control over AVS/CV2 checks and rules by changing this value. 0 is Default 
** It can be changed dynamically, per transaction, if you wish.  See the VSP Server Protocol document */
if ($strTransactionType!=="AUTHENTICATE")
	$strPost=$strPost . "&ApplyAVSCV2=0";
	
/* Allow fine control over 3D-Secure checks and rules by changing this value. 0 is Default 
** It can be changed dynamically, per transaction, if you wish.  See the VSP Server Protocol document */
$strPost=$strPost . "&Apply3DSecure=0";
// Encrypt the plaintext string for inclusion in the hidden field
$strCrypt = Shop_ProtxPayments::base64Encode(Shop_ProtxPayments::SimpleXor($strPost,$strEncryptionPassword));

#################################################################################
## END OF CRYPT BUILDER
#################################################################################

$protx_form_div = new HTMLTags_Div();
$protx_form_div->set_attribute_str('id', 'paypal_form_div');

$protx_form = new HTMLTags_Form();

$protx_form_action = new HTMLTags_URL();

//$protx_form_action->set_file('https://ukvps.protx.com/vspgateway/service/vspform-register.vsp'); # The real thing
//$protx_form_action->set_file('https://ukvpstest.protx.com/vspgateway/service/vspform-register.vsp'); # The sandbox
$protx_form_action->set_file($strPurchaseURL); # The URL set above

$protx_form->set_action($protx_form_action);
$protx_form->set_attribute_str('method', 'POST');
 

$protx_form->add_hidden_input('VPSProtocol', '2.22');
$protx_form->add_hidden_input('TxType', $strTransactionType);
$protx_form->add_hidden_input('Vendor', $strVSPVendorName);
$protx_form->add_hidden_input('Crypt', $strCrypt);

$protx_submit_input = new HTMLTags_Input();
$protx_submit_input->set_attribute_str('type', 'submit');
$protx_submit_input->set_attribute_str('value', 'Go to Secure Server');
$protx_form->append_tag_to_content($protx_submit_input);

foreach ($protx_form->get_hidden_inputs() as $hidden_input) 
{
	$protx_form->append_tag_to_content($hidden_input);
}

$protx_form_div->append_tag_to_content($protx_form);

/*
 * Example of ProTx Form
 */
//<form 
//        action="https://ukvpstest.protx.com/vspgateway/service/vspform-register.vsp" 
//        method="POST" id="VSPForm" name="VSPForm"
//        > 
//        <input type="hidden" name="VPSProtocol" value="2.22">
//        <input type="hidden" name="TxType" value="PAYMENT">
//        <input type="hidden" name="Vendor" value="mash ">
//        <input type="hidden" name="Crypt" value="">
//        <input type="submit" name="proceed" src="images/proceed.gif" value="Proceed to VSP Form registration">

/*
 * Example of ProTx Crypt Form
 */
//VendorTxCode=mash60565545&Amount=10.25&Currency=GBP&Description=The best DVDs from mash&SuccessURL=http://dev.protx-sample-kit.ragnar.clearlinewebdesign.com//orderSuccessful.php&FailureURL=http://dev.protx-sample-kit.ragnar.clearlinewebdesign.com//orderFailed.php&CustomerName=Saul Howard&CustomerEMail=saul@saul.com&VendorEMail=robert@clearlinewebdesign.com&eMailMessage=Thank you so very much for your order.&BillingAddress=12 Chesham RdBrighton&BillingPostCode=BN21NB&DeliveryAddress=&DeliveryPostCode=&Basket=2:Nacho Libre:1:7.45:1.30:8.75:8.75:Delivery:1:1.50:---:1.50:1.50&AllowGiftAid=0&ApplyAVSCV2=0&Apply3DSecure=0

if ($strConnectTo!=="LIVE") 
{ 
	echo
		"<table style=\"width:100%;display:block;background-color: #c1c1c1\">
		<tr style=\"width:50em;display:block;\">
		<td class=\"subheader\" align=\"center\">Your VSP Form Crypt Post Contents</td>
		</tr>
		<tr style=\"width:50em;display:block;\">
		<td class=\"smallheader\" align=\"center\">The box below shows the unencrypted contents of the VSP Form
		Crypt field.  This will not be displayed in LIVE mode.  If you wish to view the encrypted and encoded
		contents view the source of this page and scroll to the bottom.  You'll find the submission FORM there.
		</tr>
		<tr style=\"width:50em;display:block;\">
		<td align=\"left\" style=\"word-wrap:break-word\" width=\"630\" class=\"smalltext\">" . $strPost . "</td>
		</tr>
		</table>";
}
echo $protx_form_div->get_as_string();
?>
