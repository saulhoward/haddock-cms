<?php
/**
 * Content of the page you see after you have paid for
 * the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */
/**************************************************************************************************
 * Values for you to update
 **************************************************************************************************/

$strConnectTo="TEST"; //Set to SIMULATOR for the VSP Simulator expert system, TEST for the Test Server and LIVE in the live environment

$strVirtualDir="VSPForm-Kit"; //Change if you have created a Virtual Directory in IIS with a different name

/** IMPORTANT.  Set the strYourSiteFQDN value to the Fully Qualified Domain Name of your server. **
 ** This should start http:// or https:// and should be the name by which our servers can call back to yours **
 ** i.e. it MUST be resolvable externally, and have access granted to the Protx servers **
 ** examples would be https://www.mysite.com or http://212.111.32.22/ **
 ** NOTE: You should leave the final / in place. **/

$strYourSiteFQDN="http://testing.mash-shop.ragnar.clearlinewebdesign.com/";  
$strVSPVendorName="mash"; /** Set this value to the VSPVendorName assigned to you by protx or chosen when you applied **/
$strEncryptionPassword="XVt4b34U5J7DSnGF";  /** Set this value to the XOR Encryption password assigned to you by Protx **/
$strCurrency="GBP"; /** Set this to indicate the currency in which you wish to trade. You will need a merchant number in this currency **/
$strVendorEMail="info@mashclothing.com";  /** Set this to the mail address which will receive order confirmations and failures **/
$strTransactionType="PAYMENT"; /** This can be DEFERRED or AUTHENTICATE if your Protx account supports those payment types **/

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


/*
 * Create the singleton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * The title of the page.
 */
$content_div->append_tag_to_content(
	new HTMLTags_Heading(2, 'Payment Confirmed')
);

if (
	isset($_GET['crypt'])
	&&
	isset($_GET['session'])
)
{
	$strCrypt = $_GET['crypt'];
	$session_id = $_GET['session'];

	// Now decode the Crypt field and extract the results
	$strDecoded=Shop_ProtxPayments::simpleXor(
		Shop_ProtxPayments::Base64Decode($strCrypt),$strEncryptionPassword
	);

	//                print_r($strDecoded);exit;
	$values = Shop_ProtxPayments::getToken($strDecoded);
	// Split out the useful information into variables we can use
	$strStatus=$values['Status'];
	$strStatusDetail=$values['StatusDetail'];
	$strVendorTxCode=$values["VendorTxCode"];
	$strVPSTxId=$values["VPSTxId"];
	$strTxAuthNo=$values["TxAuthNo"];
	$strAmount=$values["Amount"];
	$strAVSCV2=$values["AVSCV2"];
	$strAddressResult=$values["AddressResult"];
	$strPostCodeResult=$values["PostCodeResult"];
	$strCV2Result=$values["CV2Result"];
	$strGiftAid=$values["GiftAid"];
	$str3DSecureStatus=$values["3DSecureStatus"];
	$strCAVV=$values["CAVV"];

	$transactions_table = $database->get_table('hpi_protx_payments_transactions');

	if (
		# check that txn_id has not been previously processed
		$transactions_table->txn_id_is_new($strVendorTxCode)
	)
	{

		# ADD THE Tranasaction
		# if its new
		//                add_transaction(
		//                        $session_id,
		//                        $status,
		//                        $status_detail,
		//                        $vendor_tx_code,
		//                        $vps_tx_id,
		//                        $tx_auth_no,
		//                        $amount,
		//                        $avscv2,
		//                        $address_result,
		//                        $postcode_result,
		//                        $cv2_result,
		//                        $gift_aid,
		//                        $threedee_secure_status,
		//                        $cavv
		//                )	

		$last_added_id = $transactions_table->add_transaction(
			$session_id,
			$strStatus,
			$strStatusDetail,
			$strVendorTxCode,
			$strVPSTxId,
			$strTxAuthNo,
			$strAmount,
			$strAVSCV2,
			$strAddressResult,
			$strPostCodeResult,
			$strCV2Result,
			$strGiftAid,
			$str3DSecureStatus,
			$strCAVV
		);
	}


}
$content_div
	->append_str_to_content(
		$page_manager->get_inc_file_as_string('body.div.payment-confirmed')
	);
if ($log_in_manager->is_logged_in())
{
	/*
	 * All Orders Div
	 */
	$customer = $log_in_manager->get_user();
	$customer_renderer = $customer->get_renderer();
	$content_div->append_tag_to_content($customer_renderer->get_all_orders_div());
}
else
{
	$content_div
		->append_str_to_content(
			$page_manager->get_inc_file_as_string('body.div.not-logged-in')
		);
}
/*
 * Print everything.
 */
echo $content_div->get_as_string();
?>
