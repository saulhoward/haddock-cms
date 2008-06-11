<?php
/*
 *
 * PayPal IPN Processor
 *
 */
$log_file_name = $_SERVER['DOCUMENT_ROOT'] . '/../logs/ipn-post.txt';

if ($fh = fopen($log_file_name, 'a'))
{
	$date = date('r');
	fwrite ($fh, "\n\n\n\n--\n$date\n\n_POST\n\n");

	foreach (array_keys($_POST) as $key)
	{
		fwrite($fh, "$key: $_POST[$key]\n");
	}

	fwrite ($fh, "\n_GET\n\n");
	foreach (array_keys($_GET) as $key)
	{
		fwrite($fh, "$key: $_GET[$key]\n");
	}
	fclose($fh);
}

//echo 'print_r($_GET): ' . "\n";
//print_r($_GET);
//exit;

# Check the $_GET variable matches the secret set in the notify_url
if (
	isset($_GET['secret'])
	&&
	($_GET['secret'] == 'shhhhh')
)
{
	# get the PayPal IPN values from the _POST
	$session_id = $_POST['custom'];
	$payment_status = $_POST['payment_status'];
	$payment_total_amount = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email_to_be_checked = $_POST['receiver_email'];
	$payer_email_to_be_checked = $_POST['payer_email'];
	$num_cart_items = $_POST['num_cart_items'];

	# Get the receiver email from the project-specific config file
	$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
	$pd = $pdf->get_project_directory_for_this_project();
	$paypal_payments_module = $pd->get_plug_in_module_directory('paypal-payments');
	if ($paypal_payments_module->has_config_variable('receiver-email')) 
	{
		$receiver_email = $paypal_payments_module->get_config_variable('receiver-email');
	}
	if ($fh = fopen($log_file_name, 'a'))
	{
		fwrite ($fh, "\n---- VALUES FROM POST RECEIVED AND EMAIL FROM CONFIG READ... ----");
		fclose($fh);
	}

	$mysql_user_factory = Database_MySQLUserFactory::get_instance();
	$mysql_user = $mysql_user_factory->get_for_this_project();
	$database = $mysql_user->get_database();
	$transactions_table = $database->get_table('hpi_paypal_payments_transactions');

	if (
		#Check the Payment_status == Completed
		$payment_status == 'Completed'
		&&
		# check that txn_id has not been previously processed
		$transactions_table->txn_id_is_new($txn_id)
		&&
		# check that receiver_email is your Primary PayPal email
		$receiver_email_to_be_checked == $receiver_email
		&&
		# check that payment_amount/payment_currency are correct
		$transactions_table->check_payments_against_shopping_baskets(
			$session_id, 
			$payment_total_amount, 
			$payment_currency
		)
	)
	{
		if ($fh = fopen($log_file_name, 'a'))
		{
			fwrite ($fh, "\n---- CONDITIONS FOR TRANSACTION MET... ----");
			fclose($fh);
		}


		# process payment
		# foreach cart item, add a transaction
		for ($i = 1; $i <= $num_cart_items; $i++)
		{
			$item_name = $_POST['item_name' . $i];
			$item_number = $_POST['item_number' . $i];
			$item_quantity = $_POST['quantity' . $i];
			$payment_amount = $_POST['mc_gross_' . $i];
			$payment_shipping = $_POST['mc_shipping' . $i];

			$last_added_id = $transactions_table->add_transaction(
				$session_id,
				$item_name,
				$item_number,
				$item_quantity,
				$payment_status,
				$payment_amount,
				$payment_shipping,
				$payment_currency,
				$txn_id,
				$receiver_email_to_be_checked,
				$payer_email_to_be_checked
			);
		}
	}
}
?>