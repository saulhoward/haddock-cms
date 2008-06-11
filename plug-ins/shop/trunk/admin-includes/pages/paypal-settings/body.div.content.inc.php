<?php
/**
 * The content of the paypal_settings page.
 *
 * From here, the user can
 *
 *  - add a new paypal_setting
 *  - delete a paypal_setting
 *  - Rearrange the sort order of paypal_settings
 *  - Edit a paypal_setting
 * 
 * @copyright Clear Line Web Design, 2007-02-16
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TR.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TH.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TD.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/extensions/'
    . 'HTMLTags_SimpleOLForm.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/database/classes/html-tags/'
    . 'Database_EditRowOLForm.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/database/classes/html-tags/'
    . 'Database_LimitForm.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/html-tags/'
    . 'Database_PreviousNextUL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/html-tags/'
    . 'Database_SortableHeadingTR.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Caption.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/extensions/'
    . 'HTMLTags_LastActionBoxDiv.inc.php';

/*
 * Get the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$mysql_user = $mysql_user_factory->get_for_this_project();

$database = $mysql_user->get_database();

$paypal_settings_table = $database->get_table('hpi_shop_paypal_settings');

$table_renderer = $paypal_settings_table->get_renderer();
    
/*
 * Assemble the HTML
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Cloned repeatedly throughout.
 */
$redirect_script_url = new HTMLTags_URL();
$redirect_script_url->set_file('/admin/redirect-script.php');
$redirect_script_url->set_get_variable('module', 'shop');
$redirect_script_url->set_get_variable('page', 'paypal-settings');

$cancel_href = new HTMLTags_URL();
$cancel_href->set_file('/admin/shop/paypal-settings.html');

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
            
            $question_delete_all_p = new HTMLTags_P('Are you sure that you want to delete all of the Paypal Settings?');
            $action_div->append_tag_to_content($question_delete_all_p);
            
            $confirm_delete_all_p = new HTMLTags_P();
            
            $delete_all_href = new HTMLTags_URL();
            
            $delete_all_href->set_file('/admin/redirect-script.php');
            
            $delete_all_href->set_get_variable('module', 'shop');
            $delete_all_href->set_get_variable('page', 'paypal-settings');
            
            $delete_all_href->set_get_variable('delete_all');
            
            $delete_all_a = new HTMLTags_A('Reset all options');
            
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
            $row = $paypal_settings_table->get_row_by_id($_GET['delete_id']);
            
            $question_p = new HTMLTags_P();
            
            $question_p->set_attribute_str('class', 'question');
            
            $question_p->append_str_to_content('Are you sure that you want to delete this setting?');
            
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
            
            $delete_href = new HTMLTags_URL();
            
            $delete_href->set_file('/admin/redirect-script.php');
            
            $delete_href->set_get_variable('module', 'shop');
            $delete_href->set_get_variable('page', 'paypal-settings');
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
            /**
             * Row editing.
             */
            $row = $paypal_settings_table->get_row_by_id($_GET['edit_id']);
            
            $row_editing_form = new Database_EditRowOLForm($row);
            
            $row_editing_action = new HTMLTags_URL();
            
            $row_editing_action->set_file('/admin/redirect-script.php');
            
            $row_editing_action->set_get_variable('module', 'shop');
            $row_editing_action->set_get_variable('page', 'paypal-settings');
            $row_editing_action->set_get_variable('edit_id', $row->get_id());
        
            $row_editing_form->set_action($row_editing_action);
            
            $row_editing_form->set_legend_text('Edit row ' . $row->get_id());
            
            $row_editing_form->set_submit_text('Update');
            
            $row_editing_form->set_cancel_location($cancel_href);
            
            $content_div->append_tag_to_content($row_editing_form);
	}
//       
//        elseif (isset($_GET['add_row'])) {
//            /**
//             * Row Adding.
//             */
//            #$row_adding_action = new HTMLTags_URL();
//            #
//            #$row_adding_action->set_file('/admin/redirect-script.php');
//            
//            #$row_adding_action->set_get_variable('module', 'shop');
//            #$row_adding_action->set_get_variable('page', 'paypal_settings');
//            #$row_adding_action->set_get_variable('table', $paypal_settings_table->get_name());
//            #$row_adding_action->set_get_variable('add_row');
//                    $redirect_script_url = new HTMLTags_URL();
//                        $redirect_script_url->set_file('/admin/redirect-script.php');
//                        $redirect_script_url->set_get_variable('module', 'shop');
//                        $redirect_script_url->set_get_variable('page', 'paypal_settings');
//                        $redirect_script_url->set_get_variable('add_row');
//                        
//            $row_adding_form = $table_renderer->get_paypal_setting_adding_form($redirect_script_url, $cancel_href);
//            
//            $content_div->append_tag_to_content($row_adding_form);

//            $explanation_div = new HTMLTags_Div();

//            $explanation_text = <<<TXT
//The ISO 639-1 paypal_setting code is a two letter unique identifier for paypal_setting. Eg.
//TXT;
//            $explanation_div->append_tag_to_content(new HTMLTags_P($explanation_text));

//                $explanation_dl = new HTMLTags_DL();
//                        $explanation_1_dt = new HTMLTags_DT('en');
//                        $explanation_dl->append_tag_to_content($explanation_1_dt);
//                        $explanation_1_dd = new HTMLTags_DT('English');
//                        $explanation_dl->append_tag_to_content($explanation_1_dd);
//                        $explanation_2_dt = new HTMLTags_DT('fr');
//                        $explanation_dl->append_tag_to_content($explanation_2_dt);
//                        $explanation_2_dd = new HTMLTags_DT('French');
//                        $explanation_dl->append_tag_to_content($explanation_2_dd);

//            $explanation_div->append_tag_to_content($explanation_dl);

//            $explanation_div->append_tag_to_content(new HTMLTags_P('See also:'));

//            $explanation_link_a = new HTMLTags_A('Wikipedia - List of ISO 639-1 codes');
//            $explanation_link_href = new HTMLTags_URL();
//            $explanation_link_href->set_file('http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes');
//                $explanation_link_a->set_href($explanation_link_href);
//            
//            $explanation_div->append_tag_to_content($explanation_link_a);
//            
//            $content_div->append_tag_to_content($explanation_div);
//        } 
	
	else {
            
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
			$message = 'Deleted paypal_setting id: ' . $_GET['last_deleted_id'];
		   }
		   elseif (isset($_GET['last_edited_id'])) {
			$message = 'Edited paypal_setting id: ' . $_GET['last_edited_id'];
		   }
		   elseif (isset($_GET['last_added_id'])) {
			$message = 'Added paypal_setting id: ' . $_GET['last_added_id'];
		   }
		   elseif (isset($_GET['deleted_all'])) {
		    
			if ($_GET['deleted_all'] == 'successful')
			{
				$message = 'Succesfully deleted 
					all of your paypal_settings! 
					(Not really - feature disabled)';
			}
			else
			{
			    $message = 'Failed to delete all of your paypal_settings.';
                }
           }
           $last_error_box_div
               = new HTMLTags_LastActionBoxDiv(
                   $message, 
                   '/admin/shop/paypal_settings.html',
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
             * Link to the add row form.
             */
            $add_row_li = new HTMLTags_LI();
            
            $add_row_a = new HTMLTags_A('Add New paypal_setting');
            
            $add_row_href = new HTMLTags_URL();
            
            $add_row_href->set_file('/admin/index.php');
            
            $add_row_href->set_get_variable('module', 'shop');
            $add_row_href->set_get_variable('page', 'paypal-settings');
            $add_row_href->set_get_variable('add_row');
            
            $add_row_a->set_href($add_row_href);
            
            $add_row_li->append_tag_to_content($add_row_a);
            
            $other_pages_ul->append_tag_to_content($add_row_li);
            
            /**
             * Link to the delete all confirmation page.
             */
            $delete_all_li = new HTMLTags_LI();
            
            $delete_all_a = new HTMLTags_A('Reset All Settings');
            
            $delete_all_href = new HTMLTags_URL();
            
            $delete_all_href->set_file('/admin/index.php');
            
            $delete_all_href->set_get_variable('module', 'shop');
            $delete_all_href->set_get_variable('page', 'paypal-settings');
            $delete_all_href->set_get_variable('delete_all');
            
            $delete_all_a->set_href($delete_all_href);
            
            $delete_all_li->append_tag_to_content($delete_all_a);
            
            $other_pages_ul->append_tag_to_content($delete_all_li);
            $page_options_div->append_tag_to_content($other_pages_ul);
            
            $content_div->append_tag_to_content($page_options_div);
            
            
            ####################################################################
            #
            # Display some of the data in the table.
            #
            ####################################################################
//            
//            /*
//             * DIV for limits and previous and nexts.
//             */
//            $limit_previous_next_div = new HTMLTags_Div();
//            $limit_previous_next_div->set_attribute_str('class', 'table_pages_div');
//            
//            /*
//             * To allow the user to set the number of extras to show at a time.
//             */
//            $limit_action = new HTMLTags_URL();
//            $limit_action->set_file('/admin/index.php');
//            
//            $limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');
//            
//            $limit_form->add_hidden_input('module', 'shop');
//            $limit_form->add_hidden_input('page', 'paypal-settings');
//            
//            $limit_form->add_hidden_input('order_by', ORDER_BY);
//            $limit_form->add_hidden_input('direction', DIRECTION);
//            $limit_form->add_hidden_input('offset', OFFSET);
//            
//            $limit_previous_next_div->append_tag_to_content($limit_form);
//            
//            /*
//             * Go the previous or next list of extras.
//             */
//            $previous_next_url = new HTMLTags_URL();
//            $previous_next_url->set_file('/admin/index.php');
//            
//            $previous_next_url->set_get_variable('module', 'shop');
//            $previous_next_url->set_get_variable('page', 'paypal-settings');
//            
//            $previous_next_url->set_get_variable('order_by', ORDER_BY);
//            $previous_next_url->set_get_variable('direction', DIRECTION);
//            
//            #print_r($previous_next_url);
//            
//            $row_count = $paypal_settings_table->count_all_rows();
//            
//            #echo "\$row_count: $row_count\n";
//            
//            $previous_next_ul = new Database_PreviousNextUL(
//                $previous_next_url,
//                OFFSET,
//                LIMIT,
//                $row_count
//            );
//            
//            $limit_previous_next_div->append_tag_to_content($previous_next_ul);
//            
//            $content_div->append_tag_to_content($limit_previous_next_div);
//            
            # ------------------------------------------------------------------
            
            /**
             * The table.
             */
            $rows_html_table = new HTMLTags_Table();
            $rows_html_table->set_attribute_str('class', 'table_pages');
            
            /**
             * The caption.
             */
            $caption = new HTMLTags_Caption(
                'paypal_settings'
            );
            $rows_html_table->append_tag_to_content($caption);
//            
//            /**
//             * The Heading Row.
//             */
//            $sort_href = new HTMLTags_URL();
//            $sort_href->set_file('/admin/index.php');
//            
//            $sort_href->set_get_variable('module', 'shop');
//            $sort_href->set_get_variable('page', 'paypal-settings');
//            
//            $sort_href->set_get_variable('limit', LIMIT);
//            
//            $heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);
//            
//            #$fields = $paypal_settings_table->get_fields();
//            #
//            #foreach ($fields as $field) {
//            #    $heading_row->append_sortable_field_name($field->get_name());
//            #}
//            
//            $field_names = explode(' ', 'name iso_639_1_code');

//            foreach ($field_names as $field_name) {
//                $heading_row->append_sortable_field_name($field_name);
//            }
//            
//            foreach (
//                $table_renderer->get_admin_database_action_ths()
//                as
//                $action_th
//            ) {
//                $heading_row->append_tag_to_content($action_th);
//            }
//            
//            $rows_html_table->append_tag_to_content($heading_row);
//            
            # ------------------------------------------------------------------
            
            /**
             * Display the contents of the table.
             */
            #$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
            #$direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
            #$table_renderer->render_all_data_table($order_by, $direction);
            $rows = $paypal_settings_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
            
            foreach ($rows as $row) {
                $row_renderer = $row->get_renderer();
                
                #$data_tr = $row_renderer->get_admin_database_tr();
                $data_tr = $row_renderer->get_admin_paypal_settings_html_table_tr();
                
                $rows_html_table->append_tag_to_content($data_tr);
            }
            
            # ------------------------------------------------------------------
            
            $content_div->append_tag_to_content($rows_html_table);
            
            $content_div->append_tag_to_content($limit_previous_next_div);
}

echo $content_div->get_as_string();

?>
