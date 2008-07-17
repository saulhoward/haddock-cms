<?php
/**
 * Shop_AdminProductsPage
 *
 * @copyright Clear Line Web Design, 2008-02-28
 */

class
	Shop_AdminProductsPage
extends
	Admin_RestrictedHTMLPage
{
	/*
	 * ----------------------------------------
	 * Static variables.
	 * ----------------------------------------
	 */
	
	private static $back_to_products_href;
	private static $back_to_products_link_p;
	
	/*
	 * ----------------------------------------
	 * Functions
	 * ----------------------------------------
	 */
	
	/**
	 * We call in an extra style sheet for the products.
	 */
	protected function
		render_head_link_stylesheet()
	{
		parent::render_head_link_stylesheet();
//<link
//    rel="stylesheet"
//    href="/plug-ins/shop/public-html/styles/admin-products-styles.css"
//    type="text/css"
//    media="screen"
///>
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/plug-ins/shop/public-html/styles/admin-products-styles.css'
			);
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Products';
	}
	
	/**
	 * UGLY!
	 *
	 * How else can we trick abstract classes?
	 *
	 * In future, don't rely on this sort of thing.
	 */
	public function
		content()
	{
	}
	
	public function
		run_post_session_header_commands()
	{		
		/*
		 * Create the database objects.
		 */
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		
		$products_table = $database->get_table('hpi_shop_products');
		
		
		/**
		 * Define these values so that they cannot be modified.
		 */
		
		if (isset($_GET['order_by'])) {
			define('ORDER_BY', $_GET['order_by']);
		} else {
			define('ORDER_BY', 'status');
		}
		
		if (isset($_GET['direction'])) {
			define('DIRECTION', $_GET['direction']);
		} else {
			define('DIRECTION', 'DESC');
		}
		
		if (isset($_GET['limit'])) {
			define('LIMIT', $_GET['limit']);
		} else {
			define('LIMIT', 10);
		}
		
		if (isset($_GET['offset'])) {
			# Make sure that the offset is a multiple of the limit.
			if ($_GET['offset'] % LIMIT == 0) {
				define('OFFSET', $_GET['offset']);
			} else {
				define('OFFSET', (floor($_GET['offset'] / LIMIT) * LIMIT));
				#echo OFFSET;
			}
		} else {
			define('OFFSET', 0);
		}
		
		#echo 'LIMIT: ' . LIMIT . "\n";
		#exit;
	}
	
	public function
		render_body_div_content()
	{
		/*
		 * Get the database objects.
		 */
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		
		$mysql_user = $mysql_user_factory->get_for_this_project();
		
		$database = $mysql_user->get_database();
		
		$products_table = $database->get_table('hpi_shop_products');
		
		$table_renderer = $products_table->get_renderer();
		
		$page_manager = PublicHTML_PageManager::get_instance();
		$gvm = Caching_GlobalVarManager::get_instance();
		/*
		 * Assemble the HTML
		 */
		$content_div = new HTMLTags_Div();
		$content_div->set_attribute_str('id', 'content');
		
		/*
		 * Cloned repeatedly throughout.
		 */
		#$current_page_url = $gvm->get('current_page_admin_url');
		#$redirect_script_url = $gvm->get('redirect_script_admin_url');
		
		$current_page_url = new HTMLTags_URL();
		
		$current_page_url->set_file('/haddock/public-html/public-html/index.php');
		
		$current_page_url->set_get_variable('oo-page');
		$current_page_url->set_get_variable('page-class', 'Shop_AdminProductsPage');
		
		$redirect_script_url = Admin_AdminIncluderURLFactory::get_url(
			'plug-ins',
			'shop',
			'products',
			'redirect-script'
		);
		
		$cancel_href = $current_page_url;
		
		########################################################################
		#
		# Forms for changing the contents of the database.
		#
		########################################################################

		if (isset($_GET['delete_all'])) {
			/**
			 * Confirm deleting all the rows in the table.
			 */
			$action_div = new HTMLTags_Div();
			$action_div->set_attribute_str('id', 'action-div');
		
			$question_delete_all_p = new HTMLTags_P('Are you sure that you want to delete all of the products?');
			$action_div->append_tag_to_content($question_delete_all_p);
		
			$confirm_delete_all_p = new HTMLTags_P();
		
			$delete_all_href = clone $redirect_script_url;
			$delete_all_href->set_get_variable('delete_all');
		
			$delete_all_a = new HTMLTags_A('DELETE ALL');
		
			$delete_all_a->set_attribute_str('class', 'cool_button');
			$delete_all_a->set_attribute_str('id', 'inline');
		
			$delete_all_a->set_href($delete_all_href);
		
			$confirm_delete_all_p->append_tag_to_content($delete_all_a);
		
			$confirm_delete_all_p->append_str_to_content('&nbsp;');
		
			$cancel_a = new HTMLTags_A('Cancel');
		
			$cancel_a->set_attribute_str('class', 'cool_button');
			$cancel_a->set_attribute_str('id', 'inline');
		
			$cancel_a->set_href($cancel_href);
		
			$confirm_delete_all_p->append_tag_to_content($cancel_a);
			$action_div->append_tag_to_content($confirm_delete_all_p);
			$content_div->append_tag_to_content($action_div);
		
		} elseif (isset($_GET['delete_id'])) {
			/**
			 * Confirm deleting a row.
			 */
			$row = $products_table->get_row_by_id($_GET['delete_id']);
		
			$question_p = new HTMLTags_P();
		
			$question_p->set_attribute_str('class', 'question');
		
			$question_p->append_str_to_content('Are you sure that you want to delete this row?');
		
			$content_div->append_tag_to_content($question_p);
		
			/**
			 * Show the user the data in the row.
			 */
			$row_renderer = $row->get_renderer();
		
			$content_div->append_tag_to_content($row_renderer->get_all_data_html_table());
		
			# ------------------------------------------------------------------
		
			$answer_p = new HTMLTags_P();
		
			$answer_p->set_attribute_str('class', 'answer');
		
			$delete_link = new HTMLTags_A('DELETE');
		
			$delete_href = clone $redirect_script_url;
			$delete_href->set_get_variable('delete_id', $row->get_id());
		
			$delete_link->set_href($delete_href);
		
			$delete_link->set_attribute_str('class', 'cool_button');
			$delete_link->set_attribute_str('id', 'inline');
		
			$answer_p->append_tag_to_content($delete_link);
		
			$cancel_link = new HTMLTags_A('Cancel');
		
			$cancel_link->set_href($cancel_href);
		
			$cancel_link->set_attribute_str('class', 'cool_button');
			$cancel_link->set_attribute_str('id', 'inline');
		
			$answer_p->append_tag_to_content($cancel_link);
		
			$content_div->append_tag_to_content($answer_p);
		} elseif (isset($_GET['edit_id'])) {
			/*
			 * Edit the values of this product.
			 */
			$row_editing_url = clone $redirect_script_url;
			$row_editing_url->set_get_variable('edit_id', $_GET['edit_id']);
			$product_row = $products_table->get_row_by_id($_GET['edit_id']);
			$product_row_renderer = $product_row->get_renderer();
			$row_editing_form  = $product_row_renderer
				->get_product_editing_form($row_editing_url, $cancel_href);
		
			$content_div->append_tag_to_content($row_editing_form);
		
			$explanation_div = new HTMLTags_Div();
		
			$explanation_text = <<<TXT
Some other links to edit forms:
TXT;

			$explanation_div->append_tag_to_content(new HTMLTags_P($explanation_text));
		
			$explanation_links_ul = new HTMLTags_UL();
		
			#$explanation_link_li_1 = new HTMLTags_LI();
			#$explanation_link_a = new HTMLTags_A('Add a new photograph...');
			#
			#$explanation_link_href = clone $current_page_url;
			#
			#$explanation_link_href->set_get_variable('admin-page', 'photographs');
			#$explanation_link_href->set_get_variable('add_row', '1');
			#$explanation_link_a->set_href($explanation_link_href);
			#
			#$explanation_link_li_1->append_tag_to_content($explanation_link_a);
			#$explanation_links_ul->append_tag_to_content($explanation_link_li_1);
		
			$explanation_link_li_2 = new HTMLTags_LI();
			$explanation_link_a = new HTMLTags_A('Edit all the tags for this product...');
			$explanation_link_href = clone $current_page_url;
			$explanation_link_href->set_get_variable('edit_tags', '1');
			$explanation_link_href->set_get_variable('product_id', $_GET['edit_id']);
			$explanation_link_a->set_href($explanation_link_href);
		
			$explanation_link_li_2->append_tag_to_content($explanation_link_a);
			$explanation_links_ul->append_tag_to_content($explanation_link_li_2);
		
			$explanation_div->append_tag_to_content($explanation_links_ul);
		
			$content_div->append_tag_to_content($explanation_div);
		
		} elseif (isset($_GET['add_row'])) {
			/**
			 * Row Adding.
			 */
		
			$row_adding_url = clone $redirect_script_url;
			$row_adding_url->set_get_variable('add_row');
		
			$row_adding_form = $table_renderer->get_product_adding_form($row_adding_url, $cancel_href);
		
			$content_div->append_tag_to_content($row_adding_form);
		
			$explanation_div = new HTMLTags_Div();
		
			$explanation_text = <<<TXT
Some other links to forms:
TXT;

			$explanation_div->append_tag_to_content(new HTMLTags_P($explanation_text));
		
			$explanation_links_ul = new HTMLTags_UL();
		
			$explanation_link_li_1 = new HTMLTags_LI();
			$explanation_link_a = new HTMLTags_A('Add a new photograph...');
			$explanation_link_href = clone $current_page_url;
			$explanation_link_href->set_get_variable('admin-page', 'photographs');
			$explanation_link_href->set_get_variable('add_row', '1');
			$explanation_link_a->set_href($explanation_link_href);
		
			$explanation_link_li_1->append_tag_to_content($explanation_link_a);
			$explanation_links_ul->append_tag_to_content($explanation_link_li_1);
			$explanation_div->append_tag_to_content($explanation_links_ul);
		
			$content_div->append_tag_to_content($explanation_div);
		} 
		elseif (
			isset($_GET['edit_tags'])
			&&
			isset($_GET['product_id'])
		)
		{
			/**
			 * Row editing.
			 */
			$product_row = $products_table->get_row_by_id($_GET['product_id']);
			$product_row_renderer = $product_row->get_renderer();
			$row_editing_form  = $product_row_renderer
				->get_product_tag_editing_form($redirect_script_url, $cancel_href);
		
			$content_div->append_tag_to_content($row_editing_form);
		} 
		elseif (
			isset($_GET['set_principal_tags'])
			&&
			isset($_GET['product_id'])
		)
		{
			/**
			 * Row editing.
			 */
			$product_row = $products_table->get_row_by_id($_GET['product_id']);
			$product_row_renderer = $product_row->get_renderer();
			$row_editing_form  = $product_row_renderer
				->get_product_principal_tag_editing_form($redirect_script_url, $cancel_href);
		
			$content_div->append_tag_to_content($row_editing_form);
		}
		elseif (
			isset($_GET['set_price'])
			&&
			isset($_GET['product_id'])
		) {
			/**
			 * Set Prices
			 */
		
			$set_price_url = clone $redirect_script_url;
			$set_price_url->set_get_variable('set_price');
			$set_price_url->set_get_variable('product_id', $_GET['product_id']);
		
			$product_currency_prices_table = $database->get_table('hpi_shop_product_currency_prices');
			$product_currency_prices_table_renderer = $product_currency_prices_table->get_renderer();
			$price_setting_form = 
				$product_currency_prices_table_renderer->get_product_currency_price_editing_form(
					$_GET['product_id'],
					$set_price_url,
					$cancel_href
				);
		
			$content_div->append_tag_to_content($price_setting_form);
		} 
		elseif (
			isset($_GET['set_stock_level'])
			&&
			isset($_GET['product_id'])
		) {
			/**
			 * Set Stock Level
			 */
		
			$product_row = $products_table->get_row_by_id($_GET['product_id']);
			$product_row_renderer = $product_row->get_renderer();
			$row_editing_form  = $product_row_renderer
				->get_stock_level_editing_form($redirect_script_url, $cancel_href);
		
			$content_div->append_tag_to_content($row_editing_form);
		} elseif (
			isset($_GET['stock_level'])
			&&
			isset($_GET['product_id'])	
		) {
			/*
			 * Shows the current stock levels for a single product.
			 */
			
			ob_start();
			
			$return_to_p = self::get_back_to_products_link_p();
			
			echo $return_to_p;
			
			$id = $_GET['product_id'];
			
			$dbh = $database->get_database_handle();
			
			/*
			 * Get product names, sizes, colours and quantities for this product.
			 */
			
			$query = <<<SQL
SELECT 
	hpi_shop_products.name,
	hpi_trackit_stock_management_stock_levels.size,
	hpi_trackit_stock_management_stock_levels.colour,
	hpi_trackit_stock_management_stock_levels.quantity
FROM
	hpi_shop_products
		INNER JOIN hpi_trackit_stock_management_products
			ON hpi_shop_products.id = hpi_trackit_stock_management_products.shop_product_id
		INNER JOIN hpi_trackit_stock_management_stock_levels
			ON
				hpi_trackit_stock_management_products.product_id
				=
				hpi_trackit_stock_management_stock_levels.product_id
WHERE
	hpi_shop_products.id = $id
SQL;

			$result = mysql_query($query, $dbh);
			
			if (mysql_num_rows($result)) {
				$first = TRUE;
				while ($row = mysql_fetch_assoc($result)) {
					if ($first) {
?>
<table>
	<caption>Stock Levels for <?php echo $row['name']; ?></caption>
	<tr>
		<th>Size</th>
		<th>Colour</th>
		<th>Quantity</th>
	</tr>	
<?php
						$first = FALSE;
					}
?>
	<tr>
		<td><?php echo $row['size']; ?></td>
		<td><?php echo $row['colour']; ?></td>
		<td><?php echo (int)$row['quantity']; ?></td>
	</tr>
<?php
				}
				echo "</table>\n";
			} else {
?>
<p class="error">
	No product found!
</p>
<?php
			}
			
			echo $return_to_p;
			
			$content_div->append_str_to_content(ob_get_clean());
		} elseif (
			isset($_GET['set_main_photograph'])
			&&
			isset($_GET['product_id'])
		) {
			$product = $products_table->get_row_by_id($_GET['product_id']);
			
			$instruction_p = new HTMLTags_P(
				'Set main photograph for ' . $product->get_name()
			);
			
			$content_div->append_tag_to_content($instruction_p);
			
			$photographs_table = $database->get_table('hpi_shop_photographs');
			
			$photograhps_ul = new HTMLTags_UL();
			
			$photograhps_ul->set_attribute_str('id', 'photographs');
			
			$photographs = $photographs_table->get_all_rows();
			
			$set_main_photograph_url = clone $redirect_script_url;
			
			$set_main_photograph_url->set_get_variable('product_id', $product->get_id());
			$set_main_photograph_url->set_get_variable('set_main_photograph');
			
			foreach ($photographs as $photograph) {
				$li = new HTMLTags_LI();
				
				$pr = $photograph->get_renderer();
				
				$set_main_photograph_to_this_photograph_url
					= clone $set_main_photograph_url;
				
				$set_main_photograph_to_this_photograph_url
					->set_get_variable('photograph_id', $photograph->get_id());
					
				$tnia = $pr->get_thumbnail_image_a();
				
				$tnia->set_href($set_main_photograph_to_this_photograph_url);
				
				$li->append_tag_to_content($tnia);
				
				$photograhps_ul->add_li($li);
			}
			
			$content_div->append_tag_to_content($photograhps_ul);
		} elseif (
			isset($_GET['set_design_photograph'])
			&&
			isset($_GET['product_id'])
		) {
			$product = $products_table->get_row_by_id($_GET['product_id']);
			
			$instruction_p = new HTMLTags_P(
				'Set design photograph for ' . $product->get_name()
			);
			
			$content_div->append_tag_to_content($instruction_p);
			
			$photographs_table = $database->get_table('hpi_shop_photographs');
			
			$photograhps_ul = new HTMLTags_UL();
			
			$photograhps_ul->set_attribute_str('id', 'photographs');
			
			$photographs = $photographs_table->get_all_rows();
			
			$set_design_photograph_url = clone $redirect_script_url;
			
			$set_design_photograph_url->set_get_variable('product_id', $product->get_id());
			$set_design_photograph_url->set_get_variable('set_design_photograph');
			
			foreach ($photographs as $photograph) {
				$li = new HTMLTags_LI();
				
				$pr = $photograph->get_renderer();
				
				$set_design_photograph_to_this_photograph_url
					= clone $set_design_photograph_url;
				
				$set_design_photograph_to_this_photograph_url
					->set_get_variable('photograph_id', $photograph->get_id());
					
				$tnia = $pr->get_thumbnail_image_a();
				
				$tnia->set_href($set_design_photograph_to_this_photograph_url);
				
				$li->append_tag_to_content($tnia);
				
				$photograhps_ul->add_li($li);
			}
			
			$content_div->append_tag_to_content($photograhps_ul);
		} elseif (
			isset($_GET['add_extra_photograph'])
			&&
			isset($_GET['product_id'])
		) {
			$product = $products_table->get_row_by_id($_GET['product_id']);
			
			$instruction_p = new HTMLTags_P(
				'Add extra photograph for ' . $product->get_name()
			);
			
			$content_div->append_tag_to_content($instruction_p);
			
			$photographs_table = $database->get_table('hpi_shop_photographs');
			
			$photograhps_ul = new HTMLTags_UL();
			
			$photograhps_ul->set_attribute_str('id', 'photographs');
			
			$photographs = $photographs_table->get_all_rows();
			
			$url = clone $redirect_script_url;
			
			$url->set_get_variable('product_id', $product->get_id());
			$url->set_get_variable('add_extra_photograph');
			
			foreach ($photographs as $photograph) {
				$li = new HTMLTags_LI();
				
				$pr = $photograph->get_renderer();
				
				$this_photograph_url
					= clone $url;
				
				$this_photograph_url
					->set_get_variable('photograph_id', $photograph->get_id());
					
				$tnia = $pr->get_thumbnail_image_a();
				
				$tnia->set_href($this_photograph_url);
				
				$li->append_tag_to_content($tnia);
				
				$photograhps_ul->add_li($li);
			}
			
			$content_div->append_tag_to_content($photograhps_ul);
		} else {

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
			$message = 'Deleted product id: ' . $_GET['last_deleted_id'];
		}
		elseif (isset($_GET['last_edited_id'])) {
			$product = $products_table->get_row_by_id($_GET['last_edited_id']);
			$message = 'Edited ' . $product->get_name();
		}
		elseif (isset($_GET['last_added_id'])) {
			$product = $products_table->get_row_by_id($_GET['last_added_id']);
			$message = 'Added ' . $product->get_name();
		}
		elseif (isset($_GET['deleted_all'])) {

			if ($_GET['deleted_all'] == 'successful')
			{
				$message = 'Succesfully deleted 
					all of your products! 
					(Not really - feature disabled)';
			}
			else
			{
				$message = 'Failed to delete all of your products.';
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

//        $page_options_div = new HTMLTags_Div();
//        $page_options_div->set_attribute_str('id', 'page-options');

//        $other_pages_ul = new HTMLTags_UL();
	
	/**
	 * Link to the add row form.
	 */
	#$add_row_li = new HTMLTags_LI();
	#
	#$add_row_a = new HTMLTags_A('Add New Product');
	#
	#$add_row_href = clone $current_page_url;
	#$add_row_href->set_get_variable('add_row');
	#
	#$add_row_a->set_href($add_row_href);
	#
	#$add_row_li->append_tag_to_content($add_row_a);
	#
	#$other_pages_ul->append_tag_to_content($add_row_li);

	/**
	 * Link to the delete all confirmation page.
	 */
//        $delete_all_li = new HTMLTags_LI();

//        $delete_all_a = new HTMLTags_A('Delete All Products');

//        $delete_all_href = clone $current_page_url;
//        $delete_all_href->set_get_variable('delete_all');

//        $delete_all_a->set_href($delete_all_href);

//        $delete_all_li->append_tag_to_content($delete_all_a);

//        $other_pages_ul->append_tag_to_content($delete_all_li);
//        $page_options_div->append_tag_to_content($other_pages_ul);

//        $content_div->append_tag_to_content($page_options_div);
//        
	/*
	 * ----------------------------------------
	 * See if the variables for constraining the selection of products
	 * have been set in GET.
	 * ----------------------------------------
	 */
	
	$product_category_id = NULL;
	if (
		isset($_GET['product_category_id'])
		&&
		is_numeric($_GET['product_category_id'])
	) {
		$product_category_id = $_GET['product_category_id'];
	}
	
//        $just_with_photos = FALSE;
	$just_with_photos = TRUE;
	
	if (
		isset($_GET['just_with_photos'])
		&&
		(strtolower($_GET['just_with_photos']) == 'yes')
	) {
		$just_with_photos = TRUE;
	}
	elseif (
		isset($_GET['just_with_photos'])
		&&
		(strtolower($_GET['just_with_photos']) == 'no')
	) {
		$just_with_photos = FALSE;
	}
	

	// Hide hidden products
	//
//        $just_displayed_products = FALSE;
	$just_displayed_products = TRUE;
	
	if (
		isset($_GET['just_displayed_products'])
		&&
		(strtolower($_GET['just_displayed_products']) == 'yes')
	) {
		$just_displayed_products = TRUE;
	}
	elseif (
		isset($_GET['just_displayed_products'])
		&&
		(strtolower($_GET['just_displayed_products']) == 'no')
	) {
		$just_displayed_products = FALSE;
	}


	if (isset($_GET['plu_code'])) {
		// If PLU Code is set, unset everyhting else
		$just_with_photos = FALSE;
		$just_displayed_products = FALSE;
	}
	
	$content_div->append_tag_to_content($this->get_enter_plu_code_form());

	/*
	 * -------------------------------------------------------------------------
	 * The product selecting form.
	 * -------------------------------------------------------------------------
	 */
	
	$product_category_selecting_form = new HTMLTags_Form();

	$product_category_selecting_form->set_attribute_str('name', 'product_category_selecting');
	$product_category_selecting_form->set_attribute_str('method', 'GET');
	$product_category_selecting_form->set_attribute_str('class', 'table-select-form');

	$product_category_selecting_form->set_action(new HTMLTags_URL('/'));

	$inputs_ol = new HTMLTags_OL();
		
	/*
	 * Select whether you want all products or just those with status==display
	 */
	$li = new HTMLTags_LI();
	$label = new HTMLTags_Label('Just Display Products');
	$label->set_attribute_str('for', 'just_displayed_products');
	$li->append_tag_to_content($label);
	
	$select = new HTMLTags_Select();
	
	$select->set_attribute_str('name', 'just_displayed_products');
	
	$yes_option = new HTMLTags_Option('Yes');
	$yes_option->set_attribute_str('value', 'yes');
	
	$no_option = new HTMLTags_Option('No');
	$no_option->set_attribute_str('value', 'no');
	
	if (isset($_GET['just_displayed_products'])) {
		if ($_GET['just_displayed_products'] == 'no') {
			$no_option->set_attribute_str('selected', 'TRUE');
		}
	} else {
		$yes_option->set_attribute_str('selected', 'TRUE');
	}
	
	$select->add_option($yes_option);
	$select->add_option($no_option);
	
	/*
	 * The default is 'no'. /changed it to yes SAUL
	 *
	 * i.e. Get all the products, regardless of whether they have photos or not.
	 */
	if (isset($_GET['just_displayed_products'])) {
		$select->set_value($_GET['just_displayed_products']);
	} else {
		$select->set_value('yes');
	}
	
	$li->append_tag_to_content($select);
	$inputs_ol->add_li($li);
	

	/*
	 * Select whether you want all products or just those with photos.
	 */
	$li = new HTMLTags_LI();
	$label = new HTMLTags_Label('Just with Photos');
	$label->set_attribute_str('for', 'just_with_photos');
	$li->append_tag_to_content($label);
	
	$select = new HTMLTags_Select();
	
	$select->set_attribute_str('name', 'just_with_photos');
	
	$yes_option = new HTMLTags_Option('Yes');
	$yes_option->set_attribute_str('value', 'yes');
	
	$no_option = new HTMLTags_Option('No');
	$no_option->set_attribute_str('value', 'no');
	
	if (isset($_GET['just_with_photos'])) {
		if ($_GET['just_with_photos'] == 'no') {
			$no_option->set_attribute_str('selected', 'TRUE');
		}
	} else {
		$yes_option->set_attribute_str('selected', 'TRUE');
	}
	
	$select->add_option($yes_option);
	$select->add_option($no_option);
	
	/*
	 * The default is 'no'. /changed it to yes SAUL
	 *
	 * i.e. Get all the products, regardless of whether they have photos or not.
	 */
	if (isset($_GET['just_with_photos'])) {
		$select->set_value($_GET['just_with_photos']);
	} else {
		$select->set_value('yes');
	}
	
	$li->append_tag_to_content($select);
	$inputs_ol->add_li($li);
	
	/*
	 * Select the product_category_id.
	 */
	$product_category_li = new HTMLTags_LI();
	$product_category_label = new HTMLTags_Label('Product Category');
	$product_category_label->set_attribute_str('for', 'product_category_id');
	$product_category_li->append_tag_to_content($product_category_label);
	
	if (isset($_GET['product_category_id'])) {
		$product_category_form_select = 
			$table_renderer->get_product_category_form_select($_GET['product_category_id']);
	} else {
		$product_category_form_select = $table_renderer->get_product_category_form_select();
	}

	$all_product_categories_option = new HTMLTags_Option('all');
	$all_product_categories_option->set_attribute_str('value', 'all');

	if ($_GET['product_category_id'] == 'all' || !isset($_GET['product_category_id'])) {
		$all_product_categories_option->set_attribute_str('selected');
	}

	$product_category_form_select->add_option($all_product_categories_option);
	$product_category_li->append_tag_to_content($product_category_form_select);
	$inputs_ol->add_li($product_category_li);

	/*
	 * The hidden inputs.
	 */

	$product_category_selecting_action = clone $current_page_url;
	$product_category_selecting_action_get_vars = $product_category_selecting_action->get_get_variables();

	foreach (array_keys($product_category_selecting_action_get_vars) as $key) {
		$form_hidden_input = new HTMLTags_Input();
		
		$form_hidden_input->set_attribute_str('type', 'hidden');
		$form_hidden_input->set_attribute_str('name', $key);
		$form_hidden_input->set_attribute_str('value', $product_category_selecting_action_get_vars[$key]);
		
		$product_category_selecting_form->append_tag_to_content($form_hidden_input);
	}

	/*
	 * The submit button.
	 */
	$go_button_li = new HTMLTags_LI();
	$go_button = new HTMLTags_Input();
	$go_button->set_attribute_str('type', 'submit');
	$go_button->set_attribute_str('value', 'Go');
	$go_button->set_attribute_str('class', 'submit');
	$go_button_li->append_tag_to_content($go_button);
	$inputs_ol->add_li($go_button_li);

	$product_category_selecting_form->append_tag_to_content($inputs_ol);
	$content_div->append_tag_to_content($product_category_selecting_form);

	####################################################################
	#
	# Display some of the data in the table.
	#
	####################################################################
	
	/*
	 * Build the the 'from' and 'where' clauses for the select statements below.
	 *
	 * One counts the rows matching the selection criteria and the other fetches
	 * the data from the database.
	 */
	
	$from_and_where_clauses = <<<SQL
FROM
	hpi_shop_products
	
SQL;

	if ($just_with_photos) {
		$from_and_where_clauses .= <<<SQL
		INNER JOIN hpi_shop_product_photograph_links
			ON hpi_shop_products.id = hpi_shop_product_photograph_links.product_id
		INNER JOIN hpi_shop_photographs
			ON hpi_shop_product_photograph_links.photograph_id = hpi_shop_photographs.id
			
SQL;

	}
	
	if (
		isset($_GET['plu_code'])
	)
	{
		// If PLU_CODE is set, then nothing else should be
		// (different form)
		$plu_code = $_GET['plu_code'];
		$from_and_where_clauses .= <<<SQL

WHERE
	hpi_shop_products.plu_code = $plu_code

SQL;

	}

	if (
		isset($product_category_id)
		||
		$just_with_photos
		||
		$just_displayed_products
	)
	 {			
		$from_and_where_clauses .= <<<SQL

WHERE

SQL;

	}
	
	if (isset($product_category_id)) {			
		$from_and_where_clauses .= <<<SQL
	
	hpi_shop_products.product_category_id = $product_category_id
	
SQL;

	}
	
	if (
		isset($product_category_id)
		&&
		($just_with_photos || $just_displayed_products)
	) {			
		$from_and_where_clauses .= <<<SQL

	AND

SQL;

	}
	
	if ($just_displayed_products) {
		$from_and_where_clauses .= <<<SQL

	hpi_shop_products.status = 'display'
	
SQL;
	}

	if (
		$just_with_photos 
		&& 
		($just_displayed_products || isset($product_category_id)
	)
	) {			
		$from_and_where_clauses .= <<<SQL

	AND

SQL;

	}
	
	if ($just_with_photos) {
		$from_and_where_clauses .= <<<SQL

	hpi_shop_product_photograph_links.type = 'main'
	
SQL;

	}
	/*
	 * DIV for limits and previous and nexts.
	 */
	$limit_previous_next_div = new HTMLTags_Div();
	$limit_previous_next_div->set_attribute_str('class', 'table_pages_div');

	/*
	 * To allow the user to set the number of extras to show at a time.
	 */
	$limit_action = clone $current_page_url;

	#		echo 'LIMIT: ' . LIMIT . "\n";
	#		exit;

	$limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');

	//                $limit_form->add_hidden_input('module', 'shop');
	//                $limit_form->add_hidden_input('page', 'products');

	$limit_form->add_hidden_input('section', 'haddock');
	$limit_form->add_hidden_input('module', 'admin');
	$limit_form->add_hidden_input('page', 'admin-includer');
	$limit_form->add_hidden_input('type', 'html');

	$limit_form->add_hidden_input('admin-section', 'plug-ins');
	$limit_form->add_hidden_input('admin-module', 'shop');
	$limit_form->add_hidden_input('admin-page', 'products');

	$limit_form->add_hidden_input('order_by', ORDER_BY);
	$limit_form->add_hidden_input('direction', DIRECTION);
	$limit_form->add_hidden_input('offset', OFFSET);
	
	/*
	 * Extra get vars if we've restricted the selection.
	 */
	if (isset($product_category_id)) {
		$limit_form->add_hidden_input('product_category_id', $product_category_id);
	}
		
	if ($just_displayed_products) {
		$limit_form->add_hidden_input('just_displayed_products', 'yes');
	}
	

	if ($just_with_photos) {
		$limit_form->add_hidden_input('just_with_photos', 'yes');
	}
	
	$limit_previous_next_div->append_tag_to_content($limit_form);

	/*
	 * Go the previous or next list of extras.
	 */
	$previous_next_url = clone $current_page_url;
	
	$previous_next_url->set_get_variable('order_by', ORDER_BY);
	$previous_next_url->set_get_variable('direction', DIRECTION);

	#print_r($previous_next_url);

	/*
	 * Count the rows in the table that match our selection criteria.
	 */
	
	#$row_count = $products_table->count_all_rows();
	
	$query = <<<SQL
SELECT
	COUNT(hpi_shop_products.id)
$from_and_where_clauses

SQL;

	if (DEBUG) {
		echo DEBUG_DELIM_OPEN;
		
		echo 'Line: ' . __LINE__ . "\n";
		echo 'File: ' . __FILE__ . "\n";
		echo 'Class: ' . __CLASS__ . "\n";
		echo 'Method: ' . __METHOD__ . "\n";
		echo 'get_class($this): ' . get_class($this) . "\n";
		
		echo "\n";
		
		echo '$query: ' . "\n";
		print_r($query);
		
		echo DEBUG_DELIM_CLOSE;
	}
	
	$dbh = DB::m();
	
	$result = mysql_query($query, $dbh);
	
	$row_count = 0;
	
	if (
		$result
		&&
		($row = mysql_fetch_array($result))
	) {
		$row_count = $row[0];
	}
	
	#echo "\$row_count: $row_count\n";

	$previous_next_ul = new Database_PreviousNextUL(
		$previous_next_url,
		OFFSET,
		LIMIT,
		$row_count
	);

	/*
	 * Extra get vars if we've restricted the selection.
	 */
	if (isset($product_category_id)) {
		$previous_next_url->set_get_variable('product_category_id', $product_category_id);
	}
		
	if ($just_displayed_products) {
		$previous_next_url->set_get_variable('just_displayed_products', 'yes');
	}

	if ($just_with_photos) {
		$previous_next_url->set_get_variable('just_with_photos', 'yes');
	}
	
	$limit_previous_next_div->append_tag_to_content($previous_next_ul);

	$content_div->append_tag_to_content($limit_previous_next_div);

	# ------------------------------------------------------------------

	/*
	 * The table.
	 */
	$rows_html_table = new HTMLTags_Table();
	$rows_html_table->set_attribute_str('class', 'table_pages');

	/*
	 * ----------------------------------------
	 * The caption for the HTML table displaying the products.
	 * ----------------------------------------
	 */
	
	#if (isset($_GET['product_category_id'])) {
	#	if ($_GET['product_category_id'] == 'all') {
	#		$caption = new HTMLTags_Caption(
	#			'All Products'  
	#		);
	#		
	#		#$caption->append_str_to_content(' (' . $products_table->count_products() . ')');
	#	} else {
	#		$product_categories_table = $database->get_table('hpi_shop_product_categories');
	#		$product_category = $product_categories_table->get_row_by_id($_GET['product_category_id']);
	#		$caption = new HTMLTags_Caption(
	#			'Products in Category&nbsp;' . $product_category->get_name()
	#		);
	#		
	#		#$caption->append_str_to_content(' (' . $product_category->count_products() . ')');
	#	}
	#} else {
	#	$caption = new HTMLTags_Caption(
	#		'All Products'  
	#	);
	#	
	#	#$caption->append_str_to_content(' (' . $products_table->count_products() . ')');
	#	$caption->append_str_to_content(" ($row_count)");
	#}
	#
	#$rows_html_table->append_tag_to_content($caption);
	
	$caption_str = '';
	if (isset($product_category_id)) {
		$product_categories_table = $database->get_table('hpi_shop_product_categories');
		$product_category = $product_categories_table->get_row_by_id($product_category_id);
		
		$caption_str .= 'Products in Category&nbsp;&quot;' . $product_category->get_name() . '&quot;';
	} else {
		$caption_str .= 'All Products';
	}
			
	if (isset($_GET['plu_code'])) {
		$caption_str .= ' with PLU code ' . $_GET['plu_code'];
	}

	
	if ($just_with_photos) {
		$caption_str .= ' with photos';
	}

	if ($just_displayed_products) {
		$caption_str .= ' on display';
	}
	
	$caption_str .= " ($row_count)";
	
	$rows_html_table->append_tag_to_content(new HTMLTags_Caption($caption_str));

	/*
	 * ----------------------------------------
	 * The heading row of the HTML table that displays the products.
	 * ----------------------------------------
	 */
	
	$sort_href = clone $current_page_url;
	
	$sort_href->set_get_variable('limit', LIMIT);
	$sort_href->set_get_variable('offset', OFFSET);
	
	/*
	 * Extra get vars if we've restricted the selection.
	 */
	if (isset($product_category_id)) {
		$sort_href->set_get_variable('product_category_id', $product_category_id);
	}
		
	if ($just_displayed_products) {
		$sort_href->set_get_variable('just_displayed_products', 'yes');
	}
	if ($just_with_photos) {
		$sort_href->set_get_variable('just_with_photos', 'yes');
	}
	
	$heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);

	$plu_code_header = new HTMLTags_TH('PLU Code'); 
	$heading_row->append_tag_to_content($plu_code_header);

	$style_id_header = new HTMLTags_TH('Style ID'); 
	$heading_row->append_tag_to_content($style_id_header);

	$field_names = explode(' ', 'added name');

	foreach ($field_names as $field_name) {
		$heading_row->append_sortable_field_name($field_name);
	}

	$photograph_header = new HTMLTags_TH('Photograph'); 
	$heading_row->append_tag_to_content($photograph_header);

	$brand_header = new HTMLTags_TH('Brand'); 
	$heading_row->append_tag_to_content($brand_header);

	$product_category_id_header = new HTMLTags_TH('Product Category'); 
	$heading_row->append_tag_to_content($product_category_id_header);

	$price_header = new HTMLTags_TH('Price'); 
	$heading_row->append_tag_to_content($price_header);

	#$supplier_header = new HTMLTags_TH('Supplier'); 
	#$heading_row->append_tag_to_content($supplier_header);

//        $comments_header = new HTMLTags_TH('Comments'); 
//        $heading_row->append_tag_to_content($comments_header);

	$heading_row->append_tag_to_content(new HTMLTags_TH('Tags'));
	//                $heading_row->append_sortable_field_name('use_stock_level');
	//                $heading_row->append_sortable_field_name('stock_level');
	//                $heading_row->append_sortable_field_name('stock_buffer_level');
	#$heading_row->append_tag_to_content(new HTMLTags_TH('Stock (Buffer)'));
	
#	$heading_row->append_sortable_field_name('sort_order');

	//                $heading_row->append_tag_to_content(new HTMLTags_TH('Principal Tags'));
	//                $heading_row->append_tag_to_content(new HTMLTags_TH('Tags'));
	//                $heading_row->append_tag_to_content(new HTMLTags_TH('Price'));
	$heading_row->append_sortable_field_name('status');

	$heading_row->append_tag_to_content(new HTMLTags_TH('Stock Level'));
	$heading_row->append_tag_to_content(new HTMLTags_TH('Edit'));

//        foreach (
//                $table_renderer->get_admin_database_action_ths()
//                as
//                $action_th
//        ) {
//                $heading_row->append_tag_to_content($action_th);
//        }

	$rows_html_table->append_tag_to_content($heading_row);

	# ------------------------------------------------------------------
	
	#if (isset($_GET['product_category_id'])) {
	#	if ($_GET['product_category_id'] == 'all') {
	#		$rows = $products_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
	#	} else {
	#		$conditions = array();
	#		$conditions['product_category_id'] = $_GET['product_category_id'];
	#		$rows = $products_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
	#	}
	
	/*
	 * ----------------------------------------
	 * Fetch the products from the database table.
	 * ----------------------------------------
	 */
	
	$query = <<<SQL
SELECT
	hpi_shop_products.*
$from_and_where_clauses

SQL;
	
	/*
	 * Can we do something about these defined constants.
	 *
	 * They're making me feel ill.
	 */
	$order_by = ORDER_BY;
	$direction = DIRECTION;
	$offset = OFFSET;
	$limit = LIMIT;
	
	$query .= <<<SQL
ORDER BY
	$order_by $direction
LIMIT
	$offset, $limit
	
SQL;

	#echo $query; exit;
	if (DEBUG) {
		echo DEBUG_DELIM_OPEN;
		
		echo 'Line: ' . __LINE__ . "\n";
		echo 'File: ' . __FILE__ . "\n";
		echo 'Class: ' . __CLASS__ . "\n";
		echo 'Method: ' . __METHOD__ . "\n";
		echo 'get_class($this): ' . get_class($this) . "\n";
		
		echo "\n";
		
		echo "\$query: \n$query\n";
		
		echo DEBUG_DELIM_CLOSE;
	}
	
	$rows = $products_table->get_rows_for_select($query);
	
	/*
	 * Display some of the contents of the table.
	 */
	foreach ($rows as $row) {
		$row_renderer = $row->get_renderer();
		
		#$data_tr = $row_renderer->get_admin_database_tr();
		$data_tr = 
			$row_renderer->get_admin_products_html_table_tr(
				$current_page_url,
				$redirect_script_url
			);
			
		$rows_html_table->append_tag_to_content($data_tr);
	}

	# ------------------------------------------------------------------

	$content_div->append_tag_to_content($rows_html_table);

	$content_div->append_tag_to_content($limit_previous_next_div);
}

		echo $content_div->get_as_string();
	}
	
	private function
		get_enter_plu_code_form()
	{
		$enter_plu_code_form = new HTMLTags_Form();

		$enter_plu_code_form->set_attribute_str('name', 'enter_plu_code');
		$enter_plu_code_form->set_attribute_str('method', 'GET');
		$enter_plu_code_form->set_attribute_str('class', 'table-select-form');

		$enter_plu_code_form->set_action(new HTMLTags_URL('/'));

		$inputs_ol = new HTMLTags_OL();

		/*
		 * Select whether you want all products or just those with status==display
		 */
		$li = new HTMLTags_LI();
		$label = new HTMLTags_Label('PLU Code');
		$label->set_attribute_str('for', 'plu_code');
		$li->append_tag_to_content($label);

		$input = new HTMLTags_Input();
		$input->set_attribute_str('name', 'plu_code');
		$li->append($input);

		$inputs_ol->append($li);

		/*
		 * The submit button.
		 */
		$go_button_li = new HTMLTags_LI();
		$go_button = new HTMLTags_Input();
		$go_button->set_attribute_str('type', 'submit');
		$go_button->set_attribute_str('value', 'Go');
		$go_button->set_attribute_str('class', 'submit');
		$go_button_li->append_tag_to_content($go_button);
		$inputs_ol->add_li($go_button_li);

		$enter_plu_code_form->append($inputs_ol);

		/*
		 * The hidden inputs.
		 */
		$current_page_url = $this->get_current_page_url();
		$enter_plu_code_action = clone $current_page_url;
		$enter_plu_code_action_get_vars = $enter_plu_code_action->get_get_variables();

		foreach (array_keys($enter_plu_code_action_get_vars) as $key) {
			$form_hidden_input = new HTMLTags_Input();

			$form_hidden_input->set_attribute_str('type', 'hidden');
			$form_hidden_input->set_attribute_str('name', $key);
			$form_hidden_input->set_attribute_str('value', $enter_plu_code_action_get_vars[$key]);

			$enter_plu_code_form->append_tag_to_content($form_hidden_input);
		}

		return $enter_plu_code_form;
	}


	/*
	 * ----------------------------------------
	 * Functions to do with returning to whence you came.
	 * ----------------------------------------
	 */
	
	/**
	 * A string representing where you've come from.
	 */
	private static function
		get_back_to_products_href()
	{
		if (!isset(self::$back_to_products_href)) {
			if (
				isset($_SERVER['HTTP_REFERER'])
				&&
				preg_match('/Shop_AdminProductsPage/', $_SERVER['HTTP_REFERER'])
			) {
				self::$back_to_products_href = $_SERVER['HTTP_REFERER'];
			} else {
				self::$back_to_products_href = '/Shop_AdminProductsPage';
			}
		}
		
		return self::$back_to_products_href;
	}
	
	/**
	 * This link returns the user to the products page that they
	 * have just come from.
	 */
	private static function
		get_back_to_products_link_p()
	{
		if (!isset(self::$back_to_products_link_p)) {
			$return_to = self::get_back_to_products_href();
			
			self::$back_to_products_link_p = "<p><a href=\"$return_to\">Back to products</a></p>\n";
		}
		
		return self::$back_to_products_link_p;
	}

	private static function
		get_current_page_url()
	{
	
		$current_page_url = new HTMLTags_URL();
		
		$current_page_url->set_file('/haddock/public-html/public-html/index.php');
		
		$current_page_url->set_get_variable('oo-page');
		$current_page_url->set_get_variable('page-class', 'Shop_AdminProductsPage');

		return $current_page_url;
	}
		

}
?>
