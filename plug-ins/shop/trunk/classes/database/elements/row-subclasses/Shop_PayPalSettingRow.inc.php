<?php
/**
 * Shop_PayPalSettingRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Row.inc.php';

class
	Shop_PayPalSettingRow
	extends
	Database_Row
{
	public function
		get_paypal_account_email_address_id()
	{
		return $this->get('paypal_account_email_address_id');
	}

	public function
		get_paypal_account_email_address()
	{
		$database = $this->get_database();
		$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$paypal_account_email_address_id = $this->get_paypal_account_email_address_id();
		$paypal_account_email_address = $email_addresses_table->get_row_by_id($paypal_account_email_address_id);
		return $paypal_account_email_address->get_email_address();
	}

	public function
		set_paypal_account_email_address_id()
	{



	}
}
?>
