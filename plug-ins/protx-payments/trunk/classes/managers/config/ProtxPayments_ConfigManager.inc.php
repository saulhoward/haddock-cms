<?php
/**
 * ProtxPayments_ConfigManager
 *
 * @copyright 2008-05-02, RFI
 */

class
ProtxPayments_ConfigManager
extends
HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/plug-ins/protx-payments/';
	}

	public function
		get_encryption_password()
	{
		return $this->get_config_value('encryption-password');
	}
	public function
		get_vendor_name()
	{
		return $this->get_config_value('vendor-name');
	}
	public function
		get_transaction_type()
	{
		return $this->get_config_value('transaction-type');
	}
	public function
		get_vendor_email()
	{
		return $this->get_config_value('vendor-email');
	}
	public function
		get_currency()
	{
		return $this->get_config_value('currency');
	}
	public function
		get_site_FQDN()
	{
		return $this->get_config_value('site-FQDN');
	}
	public function
		get_connect_to()
	{
		return $this->get_config_value('connect-to');
	}
	public function
		get_site_description()
	{
		return $this->get_config_value('site-description');
	}
	public function
		get_email_message()
	{
		return $this->get_config_value('email-message');
	}
}
?>
