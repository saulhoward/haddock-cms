<?php

class 
ProtxPayments_PaymentsManager
{
	private function
		get_config_manager()
	{
		return Configuration_ConfigManagerHelper
			::get_config_manager(
				'plug-ins',
				'protx-payments'
			);
	}

	public static function get_encryption_password()
	{
		//some code to get the value from a text file in the instance specific data files
		//like the database passwords

		$db_cm = self::get_config_manager();
		return $db_cm->get_encryption_password();
	}

	public static function get_vendor_name()
	{
		$db_cm = self::get_config_manager();
		return $db_cm->get_vendor_name();
	}

	public function
		get_transaction_type()
	{

		$db_cm = self::get_config_manager();
		return $db_cm->get_transaction_type();
	}
	public function
		get_vendor_email()
	{

		$db_cm = self::get_config_manager();
		return $db_cm->get_vendor_email();
	}
	public function
		get_currency()
	{

		$db_cm = self::get_config_manager();
		return $db_cm->get_currency();
	}
	public function
		get_site_FQDN()
	{

		$db_cm = self::get_config_manager();
		return $db_cm->get_site_FQDN();
	}
	public function
		get_connect_to()
	{

		$db_cm = self::get_config_manager();
		return $db_cm->get_connect_to();
	}
	public function
		get_site_description()
	{

		$db_cm = self::get_config_manager();
		return $db_cm->get_site_description();
	}

	public function
		get_email_message()
	{

		$db_cm = self::get_config_manager();
		return $db_cm->get_email_message();
	}
}
?>
