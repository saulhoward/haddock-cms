<?php
/**
 * The content of the transactions page.
 *
 * From here, the user can
 *
 *  - add a new transaction
 *  - delete a transaction
 *  - Rearrange the sort order of transactions
 *  - Edit a transaction
 * 
 * @copyright Clear Line Web Design, 2007-02-16
 */

/*
 * Get the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$transactions_table = $database->get_table('hpi_paypal_payments_transactions');
$table_renderer = $transactions_table->get_renderer();
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Assemble the HTML
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Cloned repeatedly throughout.
 */
$current_page_url = $gvm->get('current_page_admin_url');
$redirect_script_url = $gvm->get('redirect_script_admin_url');
$cancel_href = $current_page_url;

/**
 * LAST ACTION BOX DIV
 *
 */
if (isset($_GET['last_deleted_id']) 
	|| isset($_GET['last_edited_id']) 
		|| isset($_GET['last_added_id']) 
			|| isset($_GET['deleted_all'])) 
{

	if (isset($_GET['last_deleted_id'])) {
		$message = 'Deleted transaction id: ' . $_GET['last_deleted_id'];
	}
	elseif (isset($_GET['last_edited_id'])) {
		$message = 'Edited transaction id: ' . $_GET['last_edited_id'];
	}
	elseif (isset($_GET['last_added_id'])) {
		$message = 'Added transaction id: ' . $_GET['last_added_id'];
	}
	elseif (isset($_GET['deleted_all'])) {

		if ($_GET['deleted_all'] == 'successful')
		{
			$message = 'Succesfully deleted 
				all of your transactions! 
				(Not really - feature disabled)';
		}
		else
		{
			$message = 'Failed to delete all of your transactions.';
		}
	}
	$last_error_box_div
		= new HTMLTags_LastActionBoxDiv(
			$message, 
			$current_page_url->get_as_string(),
			'message'
		); 
	$content_div->append_tag_to_content($last_error_box_div);
}            


/**
 * Links to other pages in the admin section.
 */

$page_options_div = new HTMLTags_Div();
$page_options_div->set_attribute_str('id', 'page-options');

$other_pages_ul = new HTMLTags_UL();

/**
 * Link to the refresh page.
 */
$refresh_page_li = new HTMLTags_LI();
$refresh_page_a = new HTMLTags_A('Check for new transactions');
$refresh_page_a->set_href($current_page_url);
$refresh_page_li->append_tag_to_content($refresh_page_a);
$other_pages_ul->append_tag_to_content($refresh_page_li);


$page_options_div->append_tag_to_content($other_pages_ul);

$content_div->append_tag_to_content($page_options_div);


####################################################################
#
# Display some of the data in the table.
#
####################################################################
$actions_method_args[] = $current_page_url;

$selection_div
	= $table_renderer->get_admin_database_selection_html_table(
		ORDER_BY,
		DIRECTION,
		OFFSET,
		LIMIT,
		$current_page_url,
		'added order_id txn_id payment_status payment_amount payment_shipping receiver_email payer_email',
		'Transactions'
		//                'get_shop_plug_in_admin_actions',
		//                $actions_method_args
	);

//        $selection_div
//            = $table_renderer
//		->get_admin_transactions_selection_html_table(
//			DIRECTION,
//			ORDER_BY,
//			LIMIT,
//			OFFSET
//		    );

$content_div->append_tag_to_content($selection_div);

echo $content_div->get_as_string();

?>
