<?php
/**
 * Database_CRUDAdminPage
 *
 * @copyright 2007-12-16, RFI
 */

/**
 * A page that allows users with access to the admin
 * section of the site to
 *
 * 	- Create
 * 	- Retrieve
 * 	- Update
 * 	- Delete
 *
 * data in a database.
 */
abstract class
	Database_CRUDAdminPage
extends
	Admin_RestrictedHTMLPage
{
	/*
	 * ----------------------------------------
	 * Instance variables.
	 * ----------------------------------------
	 */
	
	private $back_href;
	private $back_link_p;
	
	/*
	 * ----------------------------------------
	 * Functions
	 * ----------------------------------------
	 */
	
	/*
	 * ----------------------------------------
	 * Functions to do with URLs
	 * ----------------------------------------
	 */
	
	/**
	 * A string representing where you've come from.
	 *
	 * If the user's not come from a page to do with this page
	 * (e.g. the admin navigation) this still points to the
	 * page page to do with this one.
	 */
	protected function
		get_back_href()
	{
		if (!isset($this->back_href)) {
			$current_class_name = get_class($this);
			
			if (
				isset($_SERVER['HTTP_REFERER'])
				&&
				preg_match("/$current_class_name/", $_SERVER['HTTP_REFERER'])
			) {
				$this->back_href = $_SERVER['HTTP_REFERER'];
			} else {
				$this->back_href = $current_class_name;
			}
		}
		
		return $this->back_href;
	}
	
	/**
	 * This link returns the user to the CRUD page that they
	 * have just come from.
	 */
	protected function
		get_back_link_p()
	{
		if (!isset($this->back_link_p)) {
			$return_to = $this->get_back_href();
			
			$this->back_link_p = "<p><a href=\"$return_to\">Back</a></p>\n";
		}
		
		return $this->back_link_p;
	}
	
	/**
	 * Returns the URL of the script that does stuff to the database and so on.
	 */
	protected function
		get_redirect_script_url()
	{
		$url = $this->get_current_url_just_file();
		
		$url->set_get_variable('oo-page');
		$url->set_get_variable('page-class', $this->get_redirect_script_class_name());
		
		$return_to_url = $this->get_current_base_url();
		
		/*
		 * If we got to an action page:
		 * 
		 *	add,
		 *	edit,
		 *	delete row confirmation,
		 *	delete all confirmation
		 *
		 * from a data display page where GET variables had been set to
		 * change the selection of rows, then we should return there
		 * rather than to the default page.
		 *
		 * These vars should be reset
		 */
		if (isset($_SESSION['select-vars'])) {
			foreach ($_SESSION['select-vars'] as $k => $v) {
				$return_to_url->set_get_variable($k, $v);
			}
		}
		
		$return_to = $return_to_url->get_as_string();
		
		$url->set_get_variable('return_to', urlencode($return_to));
		
		return $url;
	}
	
	/**
	 * Returns the name of the class that does the stuff to the database.
	 *
	 * Not sure that this is the best way to ensure that there is an association
	 * between the subclass of this and the redirect script it will do for now.
	 */
	protected function
		get_redirect_script_class_name()
	{
		$acm = $this->get_admin_crud_manager();
		
		return $acm->get_admin_redirect_script_class_name();
	}
	
	protected function
		get_add_something_redirect_script_url()
	{
		$u = $this->get_redirect_script_url();
		$u->set_get_variable('action', 'add_something');
		return $u;
	}
	
	protected function
		get_edit_something_redirect_script_url()
	{
		$u = $this->get_redirect_script_url();
		$u->set_get_variable('action', 'edit_something');
		
		$acm = $this->get_admin_crud_manager();
		
		$something = $acm->get_hash_for_something();
		
		$u = $acm->add_get_vars_to_identify_current_thing($u, $something);
		
		#print_r($u); exit;
		
		return $u;
	}
	
	protected function
		get_delete_something_redirect_script_url()
	{
		$u = $this->get_redirect_script_url();
		$u->set_get_variable('action', 'delete_something');
		
		$acm = $this->get_admin_crud_manager();
		
		$something = $acm->get_hash_for_something();
		
		$u = $acm->add_get_vars_to_identify_current_thing($u, $something);
		
		return $u;
	}
	
	protected function
		get_delete_everything_redirect_script_url()
	{
		$u = $this->get_redirect_script_url();
		$u->set_get_variable('action', 'delete_everything');
		return $u;
	}
	
	protected function
		get_clear_form_redirect_script_url()
	{
		$u = $this->get_redirect_script_url();
		$u->set_get_variable('action', 'clear_form');
		return $u;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with classes that are related.
	 * ----------------------------------------
	 */
	
	/**
	 * The admin crud manager class implements the functionality that is
	 * shared with the related redirect script.
	 */
	abstract protected function
		get_admin_crud_manager_class_name();
		
	protected function
		get_admin_crud_manager()
	{
		#echo "Getting acm\n"; exit;
		
		$cn = $this->get_admin_crud_manager_class_name();
		
		#echo $cn; exit;
		
		$rc = new ReflectionClass($cn);
		
		$acm = $rc->newInstance();
		
		#echo "Got acm\n"; exit;
		
		return $acm;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering stuff to the browser.
	 * ----------------------------------------
	 */
	
	/**
	 * The title of the page.
	 */
	protected function
		get_body_div_header_heading_content()
	{
		return 'Admin CRUD Page';
	}
	
	/**
	 * A map for function names that render content that does different things.
	 *
	 * If you override this function, it's probably sensible to include this
	 * list in the new map.
	 *
	 * e.g.
	 *
	 * <code>
	 * $map = parent::get_content_render_method_map();
	 * $map['do_somthing_else'] = 'render_content_to_do_something_else'
	 * return $map;
	 * </code>
	 *
	 * I've used vague names ('something', 'some stuff') deliberately as we've
	 * really no idea what these things might be.
	 * In particular, I've avoided using the word 'row' (e.g. 'add row', 'edit
	 * row', 'delete row' etc.) as most likely, the classes that implement this
	 * abstract class will represent pages that wrap around tables with foreign
	 * keys.
	 * In which case, the CRUD operations typically involve several tables and
	 * rows.
	 */
	protected function
		get_content_render_method_map()
	{
		$crmm = array();
		
		$crmm['delete_everything'] = 'render_content_to_confirm_deleting_everything';
		$crmm['delete_something'] = 'render_content_to_confirm_deleting_something';
		$crmm['edit_something'] = 'render_content_to_edit_something';
		$crmm['add_something'] = 'render_content_to_add_something';
		$crmm['default'] = 'render_content_to_display_some_stuff';
		
		return $crmm;
	}
	
	/**
	 * Renders different content depending on the 'content' GET var.
	 *
	 * Probably not such a hot idea to override this.
	 *
	 * Instead, override get_content_render_method_map() and add
	 * more functions to the map.
	 */
	public function
		content()
	{
		$content = isset($_GET['content']) ? $_GET['content'] : 'default';
		
		$crmm = $this->get_content_render_method_map();
		
		/*
		 * The content render method.
		 */
		$crmn = $crmm[$content];
		
		$ccn = get_class($this);
		
		$rc = new ReflectionClass($ccn);
		
		if ($rc->hasMethod($crmn)) {
			$crm = $rc->getMethod($crmn);
		} else {
			throw new Exception("No method called '$crmn' in '$ccn'!");
		}
		
		$crm->invoke($this);
	}
	
	/**
	 * Displays some of the data from whatever tables we
	 * are playing with.
	 *
	 * This shouldn't really be public but protected.
	 * This doesn't work with the relfection stuff
	 * in <code>content</code>, however.
	 *
	 * This method should be <code>protected</code> and should *not*
	 * be called outside of this class or its subclasses.
	 *
	 * The same is true of all the <code>render_content_...</code> methods listed
	 * in the map.
	 *
	 * If you need to reuse the functionality found in one of these methods,
	 * refactor that to a separate class and use that class anywhere you like.
	 *
	 * However, creating page objects within other pages is a *bad* idea.
	 * The methods in this class (and in other sub-classes of
	 * <code>PublicHTML_HaddockHTTPResponse</code>) assume that they are being
	 * run from <code>/haddock/public-html/public-html/index.php</code> and
	 * that PHP super global variables will be set accordingly.
	 * Calling methods from these classes elsewhere could have surprising results.
	 */
	public function
		render_content_to_display_some_stuff()
	{
		$this->render_last_action_div();
		$this->render_other_pages_ul();
		
		/*
		 * Possible future additions.
		 */
		#$this->render_search_box_div();
		#$this->render_selection_constraints_div();
		
		$this->render_data_table_div();
	}
	
	/**
	 * Tells the user about what has just happened to the database.
	 *
	 * e.g. after an insertion or deletion.
	 */
	protected function
		render_last_action_div()
	{
		if (
			isset($_GET['last_deleted']) 
			||
			isset($_GET['last_edited']) 
			||
			isset($_GET['last_added']) 
			||
			isset($_GET['deleted_everything'])
			||
			isset($_GET['error'])
		) {
			if (isset($_GET['last_deleted'])) {
				$message = $_GET['last_deleted'];
			} elseif (isset($_GET['last_edited'])) {
				$message = $_GET['last_edited'];
			} elseif (isset($_GET['last_added'])) {
				$message = $_GET['last_added'];
			} elseif (isset($_GET['deleted_everything'])) {
				$message = $_GET['deleted_everything'];
			} elseif (isset($_GET['error'])) {
				$message = $_GET['error'];
			}
			
			$message = urldecode($message);
			$message = stripcslashes($message);
			
			$cbu = $this->get_current_base_url();
			
			$last_error_box_div
				= new HTMLTags_LastActionBoxDiv(
					$message, 
					$cbu->get_as_string(),
					'message'
				);
			
			echo $last_error_box_div->get_as_string();
		}            
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add something';
	}
	
	protected function
		get_delete_everything_title()
	{
		return 'Delete Everything';
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with links to other pages at the top of the page.
	 * ----------------------------------------
	 */
	
	/**
	 * Returns the text that is put in the link to the
	 * page where the user can add something to this set of data.
	 */
	protected function
		get_add_something_link_text()
	{
		return $this->get_add_something_title();
	}
	
	protected function
		get_delete_everything_link_text()
	{
		return $this->get_delete_everything_title();
	}
	
	/**
	 * Renders a UL that contains links to other pages
	 * to do with this one.
	 * e.g. the 'delete_everything' version of this page.
	 *
	 * If you don't want your users to be able to change the model,
	 * override this method but leave the body empty.
	 */
	protected function
		render_other_pages_ul()
	{
		$page_options_div = new HTMLTags_Div();
		$page_options_div->set_attribute_str('id', 'page-options');
		
		$other_pages_ul = new HTMLTags_UL();
		
		foreach ($this->get_other_page_link_as() as $a) {
			$li = new HTMLTags_LI();
			
			$li->append_tag_to_content($a);
			
			$other_pages_ul->append_tag_to_content($li);
		}
		
		$page_options_div->append_tag_to_content($other_pages_ul);
	
		echo $page_options_div->get_as_string();
	}
	
	/**
	 * Returns an array of HTMLTags_A objects that are the
	 * links to the other pages at the top of the page.
	 *
	 * E.g. add something or delete everything.
	 */
	protected function
		get_other_page_link_as()
	{
		$as = array();
		
		/*
		 * Link to the add row form.
		 */
		$add_row_a = new HTMLTags_A($this->get_add_something_link_text());
		
		$add_row_href = $this->get_add_something_page_url();
		
		$add_row_a->set_href($add_row_href);
		
		$as[] = $add_row_a;
		
		/**
		 * Link to the delete all confirmation page.
		 */
		$delete_all_a = new HTMLTags_A($this->get_delete_everything_link_text());
		
		$delete_all_href = $this->get_current_base_url();
		$delete_all_href->set_get_variable('content', 'delete_everything');
		
		$delete_all_a->set_href($delete_all_href);
		
		$as[] = $delete_all_a;
		
		return $as;
	}
	
	protected function
		get_add_something_page_url()
	{
		$url = $this->get_current_base_url();
		$url->set_get_variable('content', 'add_something');
		
		return $url;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering the data for this page.
	 * ----------------------------------------
	 */
	
	/**
	 * Renders a table with data to do with this page.
	 *
	 * The data is sortable, paginated and different numbers of rows
	 * can be displayed at once.
	 *
	 * There are also links to pages related to the data, such as
	 * 	- to the 'edit_something' version of this page.
	 * 	- to the 'delete_something' version of this page.
	 */
	protected function
		render_data_table_div()
	{
?>
<!-- Start of a data_table div -->
<div id="data_table">
<?php
		$this->render_limit_previous_next_div();
		$this->render_data_table();
		$this->render_limit_previous_next_div();
?>
</div>
<!-- End of a data_table div -->
<?php
	}
	
	protected function
		render_limit_previous_next_div()
	{
?>
<!-- Start of a limit_previous_next div -->
<?php
		/*
		 * DIV for limits and previous and nexts.
		 */
		$limit_previous_next_div = new HTMLTags_Div();
		$limit_previous_next_div->set_attribute_str('class', 'table_pages_div');
	
		/*
		 * To allow the user to set the number of extras to show at a time.
		 */
		$limit_action = $this->get_current_url_just_file();
	
		#$limit_form = new Database_LimitForm(
		#	$limit_action,
		#	$this->get_current_limit(),
		#	'10 20 50'
		#);
		$limit_form = new Database_LimitForm(
			$limit_action,
			$this->get_current_limit(),
			$this->get_limits_str()
		);
		
		$cbu = $this->get_current_base_url();
		
		foreach ($cbu->get_get_variables() as $key => $value) {
			$limit_form->add_hidden_input($key, $value);
		}
	
		$limit_form->add_hidden_input('order_by', $this->get_current_order_by());
		$limit_form->add_hidden_input('direction', $this->get_current_direction());
		$limit_form->add_hidden_input('offset', $this->get_current_offset());
		
		$limit_previous_next_div->append_tag_to_content($limit_form);

		/*
		 * Go the previous or next list of extras.
		 */
		$previous_next_url = clone $cbu;
		
		$previous_next_url->set_get_variable('order_by', $this->get_current_order_by());
		$previous_next_url->set_get_variable('direction', $this->get_current_direction());
		
		$row_count = $this->get_total_matching_row_count();
		
		if ($row_count > 0) {
			$previous_next_ul = new Database_PreviousNextUL(
				$previous_next_url,
				$this->get_current_offset(),
				$this->get_current_limit(),
				$row_count
			);
			
			$limit_previous_next_div->append_tag_to_content($previous_next_ul);
		}
		
		echo $limit_previous_next_div->get_as_string();
?>
<!-- End of a limit_previous_next div -->
<?php
	}
	
	protected function
		get_limits_str()
	{
		#return '10 20 50 100 250 500 1000';
		
		$db_cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'haddock',
					'database'
				);
		
		return $db_cm->get_crud_admin_page_limits_string();
	}
	
	/**
	 * Should be overriden in the following way.
	 * 
	 * Returns an array of assocs to show which fields should be rendered as
	 * part of the HTML table.
	 *
	 * e.g.
	 *
	 * 	$array = array(
	 * 		array(
	 *			'col_name' => 'id',
	 *			'title' => 'ID'
	 *		),
	 *		array(
	 *			'col_name' => 'kish_kash',
	 *			'sortable' => 'no'
	 *		),
	 *		array(
	 *			'col_name' => 'ding_dong',
	 *			'filter' => '$str = manip_function($str); return $str'
	 *		)
	 * 	);
	 *
	 * 	'kish_kash' -> 'Kish Kash' automagically.
	 *
	 * 	You don't have to say that a field is sortable (like <code>id</code>)
	 * 	above as this is the default.
	 *
	 * 	The cool part is 'filter'.
	 * 	This allows you to execute arbitrary code on the cell value before it
	 * 	is rendered.
	 * 	The input is a variable called '$str' and the output needs to be returned.
	 * 	If you want to do something complicated, you should probably define a
	 * 	function elsewhere and call that in your sort of filter code.
	 *
	 * 	This used to be an abstract function now it's something similar
	 * 	but causes a run time error if it is not overridden rather than a
	 * 	compile time error if it is not implemented.
	 *
	 * 	The reason for this is that sometime we want to override
	 * 		append_data_to_tr
	 *
	 * 	In which case, this method would be unused.
	 */
	protected function
		get_data_table_fields()
	{
		throw new Exception('Please override ' . __METHOD__);
	}
	
	/**
	 * Renders the HTML table that contains the data and the
	 * links to other pages to do stuff to individual items.
	 */
	protected function
		render_data_table()
	{
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
		
		$caption_str = $this->get_data_table_caption_content();
		$rows_html_table->append_tag_to_content(new HTMLTags_Caption($caption_str));
	
		/*
		 * ----------------------------------------
		 * The heading row of the HTML table that displays the products.
		 * ----------------------------------------
		 */
		
		$thead = new HTMLTags_THead();
		
		$sort_href = $this->get_current_base_url();
		
		$sort_href->set_get_variable('limit', $this->get_current_limit());
		$sort_href->set_get_variable('offset', $this->get_current_offset());
		
		$heading_row = new Database_SortableHeadingTR($sort_href, $this->get_current_direction());
		
		$fields = $this->get_data_table_fields();
		
		#print_r($fields);
		
		foreach ($fields as $field) {
			if (isset($field['sortable']) && (strtolower($field['sortable']) == 'no')) {
				$heading_row->append_nonsortable_field_name(
					$field['col_name'],
					isset($field['title']) ? $field['title'] : NULL
				);
			} else {
				$heading_row->append_sortable_field_name(
					$field['col_name'],
					isset($field['title']) ? $field['title'] : NULL
				);
			}
		}
		
		foreach ($this->get_data_table_action_ths() as $action_th) {
			$heading_row->append_tag_to_content($action_th);
		}
		
		$thead->append_tag_to_content($heading_row);
		
		$rows_html_table->append_tag_to_content($thead);
		
		/*
		 * ----------------------------------------
		 * Fetch the rows from the database table.
		 * ----------------------------------------
		 */
		
		$tbody = new HTMLTags_TBody();

		$rows = $this->get_matching_rows();
		
		/*
		 * Display some of the contents of the table.
		 */
		foreach ($rows as $row) {
			$data_tr = $this->get_data_html_table_tr($row);
				
			$tbody->append_tag_to_content($data_tr);
		}
		
		$rows_html_table->append_tag_to_content($tbody);
		
		echo $rows_html_table->get_as_string();
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the caption for the HTML data table.
	 * ----------------------------------------
	 */
	
	protected function
		get_data_table_caption_content_explanation_part()
	{
		return 'Data';
	}
	
	protected function
		get_data_table_caption_content_count_part()
	{
		$row_count = $this->get_total_matching_row_count();
		return "($row_count)";		
	}
	
	protected function
		get_data_table_caption_content()
	{
		$caption_str = '';
		
		$caption_str .= $this->get_data_table_caption_content_explanation_part();
		$caption_str .= ' ';
		$caption_str .= $this->get_data_table_caption_content_count_part();		
		
		return $caption_str;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with making the action THs for the data html table.
	 *
	 * Borrowed some code from the database table renderer.
	 *
	 * Although it is now much improved and all curried out.
	 *
	 * http://en.wikipedia.org/wiki/Currying
	 *
	 * At least, that's sort of what's going on here.
	 * Using <code>eval()</code> doesn't quite make this functional programming
	 * but it's along those lines.
	 *
	 * See the comment for <code>get_data_table_fields()</code> for an explanation
	 * for the filter.
	 * ----------------------------------------
	 */
	
	/*
	 * Returns an array of assocs to say which actions we want for each item
	 * in the table.
	 *
	 * TIP:
	 * If you override this class, use this array by calling
	 * 	<code>parent::get_data_table_actions()</code>
	 * and then add extra assocs to the array returned.
	 *
	 * While this code is quite cool, it's getting a little obfuscated.
	 * Putting code through <code>sprintf</code> before putting it in an array
	 * before <code>eval()</code>-ing it is a little evil.
	 * Oh well, I might run it through preg_replace before I'm done ...
	 * The horrors of working with strings to build strings that run programs
	 * to build yet more strings.
	 * 
	 * See <code>make_action_td_for_item</code> for an explanation of how that
	 * code works and what args it takes.
	 *
	 * If you don't want your users to be able to edit or delete items of the model,
	 * then override this function and return an empty array.
	 */
	protected function
		get_data_table_actions()
	{
		$eval_template = $this->get_data_table_actions_content_eval_template();
		
		return array(
			array(
				'name' => 'edit',
				'filter' => sprintf($eval_template, 'edit_something')
			),
			array(
				'name' => 'delete',
				'filter' => sprintf($eval_template, 'delete_something')
			)
		);
	}
	
	/**
	 * This is barking mad!
	 *
	 * There's gotta be a better way!
	 *
	 * Override it at your peril!
	 */
	protected function
		get_data_table_actions_content_eval_template()
	{
		$acm = $this->get_admin_crud_manager();
		
		$key_columns = $acm->get_key_columns_for_something();
		
		$template = 'return $this->make_content_for_action_td_for_item($action[\'name\'], \'%s\', array(';
		
		$first = TRUE;
		foreach ($key_columns as $c) {
			if ($first) {
				$first = FALSE;
			} else {
				$template .= ' , ';
			}
			
			$template .= "'$c' => \$row['$c']";
		}
		
		$template .= '));';
		
		return $template;
	}
	
    protected function
        get_data_table_action_ths()
    {
		$action_ths = array();
		
		foreach ($this->get_data_table_actions() as $action) {
			$action_ths[] = $this->make_action_th($action['name']);
		}
		
		#print_r($action_ths);
		#exit;
		
        return $action_ths;
    }
    
	/**
	 * The column heading of for an action.
	 */
    protected function
        make_action_th($action_str)
    {
		#echo "\$action_str: $action_str\n";
		
        $title_low
                = Formatting_ListOfWordsHelper
                    ::get_list_of_words_for_string(
						$action_str,
						'_'
					);
        
		$title = $title_low->get_words_as_capitalised_string();
		#echo $title;
		
        return new HTMLTags_TH($title);
    }
	
	/**
	 * Creates the URL that will be visited when the user
	 * clicks on one of the action links.
	 *
	 * @param string $get_var_content The name of the method that will be called to display the content.
	 * @param array $identifiers The key value pairs for the key that identies the row to be acted on.
	 */
	protected function
		get_action_url_for_content(
			$get_var_content,
			$identifiers
		)
	{
		$url = $this->get_current_base_url();
		
		$url->set_get_variable('content', $get_var_content);
		
		foreach ($identifiers as $key => $value) {
			$url->set_get_variable($key, $value);
		}
		
		return $url;
	}
	
	/**
	 * Makes the link to the page specified by the action.
	 */
	protected function
		make_content_for_action_td_for_item(
			$name,
			$get_var_content,
			$identifiers
		)
	{
		$c
			= Formatting_ListOfWordsHelper
				::capitalise_delimited_string(
					$name,
					'_'
				);
		
		$a = new HTMLTags_A($c);
		
		$url = $this->get_action_url_for_content(
			$get_var_content,
			$identifiers
		);
		
		$a->set_href($url);
		
		return $a->get_as_string();
	}
	
	/**
	 * This is the function that displays the rows in the data table.
	 */
	protected function
		get_data_html_table_tr($row)
	{
		$tr = new HTMLTags_TR();
		
		$tr = $this->append_data_to_tr($row, $tr);
		
		$tr = $this->append_actions_to_tr($row, $tr);
		
		return $tr;
	}
	
	/**
	 * Append data to a row in the table.
	 */
	protected function
		append_data_to_tr(
			$row,
			HTMLTags_TR $tr
		)
	{
		$fields = $this->get_data_table_fields();
		
		#echo "The fields: \n"; print_r($fields);
		##exit;
		#echo "The row: \n"; print_r($row);
		#exit;
		
		foreach ($fields as $field) {
			$str = $row[$field['col_name']];
			
			if (isset($field['filter'])) {
				#echo "Boo!"; exit;
				
				$str = eval($field['filter']);
			}
			
			$td = new HTMLTags_TD($str);
			
			$tr->append_tag_to_content($td);
		}
		
		return $tr;
	}
	
	/**
	 * Append action TDs to the row.
	 *
	 * The array of action hashes can be built up to contain
	 * different actions.
	 *
	 * The default behaviour is to just show the name of the action.
	 *
	 * However, if a filter has been associated with the action,
	 * then the content of the TD is run through that filter using
	 * eval(...).
	 */
	protected function
		append_actions_to_tr(
			$row,
			HTMLTags_TR $tr
		)
	{
		$actions = $this->get_data_table_actions();
		
		foreach ($actions as $action) {
			$str = $action['name'];
			
			if (isset($action['filter'])) {
				#echo $action['filter'];
				#exit;
				
				$str = eval($action['filter']);
			}
			
			$td = new HTMLTags_TD($str);
			
			$tr->append_tag_to_content($td);
		}
		
		return $tr;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering content that allows the user to
	 * add stuff to the database.
	 * ----------------------------------------
	 */
	
	/**
	 * Renders the content that allows a user to add stuff.
	 *
	 * Not really public!
	 * See <code>render_content_to_display_some_stuff()</code>
	 */
	public function
		render_content_to_add_something()
	{
		$this->render_last_action_div();
		$this->render_add_something_form();
	}
	
	/**
	 * Renders the form where the user can set stuff to be
	 * added to the database.
	 *
	 * Sorry, not sure how to do this generally yet so
	 * I'm making this function abstract.
	 */
	#abstract protected function
	#	render_add_something_form();
	
	/*
	 * ----------------------------------------
	 * Functions to do with the SELECT query that gets the
	 * wanted rows from the database.
	 * ----------------------------------------
	 */
	
	/**
	 * The select clause for counting all the rows that match our criteria.
	 */
	protected function
		get_total_matching_query_select_count_clause()
	{
		return <<<SQL
SELECT
	COUNT(*)

SQL;

	}
	
	/**
	 * The select clause of the query for fetching the rows that match our
	 * criteria.
	 *
	 * You'll most likely need to override this if you are making a page
	 * that wraps around a table with foreign keys.
	 * Or you're using aggregate functions.
	 */
	protected function
		get_matching_query_select_clause()
	{
		return <<<SQL
SELECT
	*

SQL;

	}
	
	/**
	 * The from clause of the SQL queries for this page.
	 *
	 * Abstract because the whole point of the subclasses of this is
	 * to wrap around a different table or set of tables.
	 */
	abstract protected function
		get_matching_query_from_clause();
	
	/**
	 * Override this function to have a more interesting selection
	 * of rows.
	 *
	 * The default is to get everything.
	 */
	protected function
		get_matching_query_where_clause()
	{
		return '';
	}
	
	protected function
		get_matching_query_group_by_clause()
	{
		return '';
	}
	
	protected function
		get_matching_query_having_clause()
	{
		return '';
	}
	
	/**
	 * Returns the default field by which the rows will be displayed.
	 *
	 * On the whole, the id of a row is not a very interesting thing to sort
	 * with.
	 * Thus, this easy to override method.
	 */
	protected function
		get_default_order_by()
	{
		return 'id';
	}

    protected function
		get_default_direction()
	{
		return 'ASC';
	}
	
	protected function
		get_current_order_by()
	{
		if (isset($_GET['order_by'])) {
			$order_by = $_GET['order_by'];
		} else {
			$order_by = $this->get_default_order_by();
		}
		
		$_SESSION['select-vars']['order_by'] = $order_by;
		
		return $order_by;
	}
	
	protected function
		get_current_direction()
	{
		if (isset($_GET['direction'])) {
			$direction = $_GET['direction'];
		} else {
			$direction = $this->get_default_direction();
		}
		
		$_SESSION['select-vars']['direction'] = $direction;
		
		return $direction;
	}
	
	protected function
		get_matching_query_order_by_clause()
	{
		$order_by = $this->get_current_order_by();
		$direction = $this->get_current_direction();
	
	return <<<SQL
ORDER BY
	$order_by $direction

SQL;

	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the basics of limiting the fetching
	 * of rows retrieved and displayed.
	 * ----------------------------------------
	 */
	
	protected function
		get_current_limit()
	{	
		if (isset($_GET['limit'])) {
			$limit = $_GET['limit'];
		} else {
			$limit = 10;
		}
		
		$_SESSION['select-vars']['limit'] = $limit;
		
		return $limit;
	}
	
	/**
	 * Returns the current offset.
	 *
	 * If the offset as set in the get variable is not a multiple of the
	 * current limit, the offset is reduced to the next lower mulitple of
	 * the limit.
	 */
	protected function
		get_current_offset()
	{
		if (isset($_GET['offset'])) {
			$limit = $this->get_current_limit();
			
			if ($_GET['offset'] % $limit == 0) {
				$offet = $_GET['offset'];
			} else {
				$offet = (floor($_GET['offset'] / $limit) * $limit);
			}
		} else {
			$offet = 0;
		}
		
		$_SESSION['select-vars']['offset'] = $offet;
		
		return $offet;
	}
	
	protected function
		get_matching_query_limit_clause()
	{
		$offset = $this->get_current_offset();
		$limit = $this->get_current_limit();
		
		return <<<SQL
LIMIT
	$offset, $limit

SQL;

	}
	
	/**
	 * This is the meat of the select queries to count and fetch the rows
	 * that match our criteria.
	 */
	protected function
		get_matching_query_core_clauses()
	{
		$cc = '';
		
		$cc .= $this->get_matching_query_from_clause();
		$cc .= $this->get_matching_query_where_clause();
		$cc .= $this->get_matching_query_group_by_clause();
		$cc .= $this->get_matching_query_having_clause();

		return $cc;
	}
	
	/**
	 * Returns the query that says how many rows there are in total
	 * that match the given constraints.
	 */
	protected function
		get_total_matching_row_count_query()
	{
		$q = '';
		
		$q .= $this->get_total_matching_query_select_count_clause();
		$q .= $this->get_matching_query_core_clauses();
		
		return $q;
	}
	
	/**
	 * Returns the query that fetches the rows that match the given
	 * contraints, limited and sorted according to the settings on the
	 * page.
	 */
	protected function
		get_matching_rows_query()
	{
		$q = '';
		
		$q .= $this->get_matching_query_select_clause();
		$q .= $this->get_matching_query_core_clauses();
		$q .= $this->get_matching_query_order_by_clause();
		$q .= $this->get_matching_query_limit_clause();
		
		return $q;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with getting stuff from the database.
	 * ----------------------------------------
	 */
	
	/**
	 * Returns the total count of rows that match the given constraints.
	 *
	 * This number is used to paginate the data and is displayed to the user.
	 */
	protected function
		get_total_matching_row_count()
	{
		$dbh = DB::m();
		
		$query = $this->get_total_matching_row_count_query();
		
		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		#if ($err = mysql_error($dbh)) {
		#	echo "\$err: $err\n";
		#}
		#
		#if ($row = mysql_fetch_array($result)) {
		#	print_r($row);
		#}
		#
		#exit;
		
		if ($result && ($row = mysql_fetch_array($result))) {
			return $row[0];
		} else {
			throw new Exception("Unable to count the total matching rows!");
		}
	}
	
	/**
	 * Returns an array of associative arrays of the data from the database
	 * that matches the given constraints.
	 * The data is limited and sorted according to the settings of the page.
	 *
	 * This could be refactored to the database class.
	 */
	protected function
		get_matching_rows()
	{
		$dbh = DB::m();
		
		$query = $this->get_matching_rows_query();
		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		if ($result) {
			$matching_rows = array();
			
			while ($row = mysql_fetch_assoc($result)) {
				$matching_rows[] = $row;
			}
			
			return $matching_rows;
		} else {
			#throw new Exception("Unable to fetch the matching rows!");
			throw new Database_MySQLException($dbh);
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with confirming deleting everything.
	 * ----------------------------------------
	 */
	
	/**
	 * Object, is in the part of speech.
	 * Nothing to do with the insanity inducing
	 * way of writing software.
	 */
	protected function
		get_confirm_deleting_everything_question_object()
	{
		return 'everything';
	}
	
	protected function
		get_confirm_deleting_everything_question()
	{
		return 'Are you sure that you want to delete '
			. $this->get_confirm_deleting_everything_question_object()
			. '?';
	}
	
	public function
		render_content_to_confirm_deleting_everything()
	{
		$delete_rsu = $this->get_delete_everything_redirect_script_url();
		$clear_rsu = $this->get_clear_form_redirect_script_url();
		
?>
<p>
	<?php echo $this->get_confirm_deleting_everything_question(); ?>
</p>
<p><a href="<?php echo $delete_rsu->get_as_string(); ?>">Yes</a>
&nbsp;
<a href="<?php echo $clear_rsu->get_as_string(); ?>">No</a></p>
<?php
	}
	
	/**
	 * The content that gets shown before the user confirms
	 * deleting that item or returning.
	 */
	public function
		render_content_to_confirm_deleting_something()
	{
?>
<p>Are you sure that you want to do delete this?</p>
<?php

		$acm = $this->get_admin_crud_manager();
		
		$something = $acm->get_hash_for_something();
		
		$keys = array_keys($something);
		
		$delete_rsu = $this->get_delete_something_redirect_script_url();
		
		$delete_rsu = $acm->add_get_vars_to_identify_current_thing($delete_rsu, $something);
		
		$clear_rsu = $this->get_clear_form_redirect_script_url();
?>
<dl>
	<?php foreach($keys as $k): ?>
	<dt><?php echo $k; ?></dt>
	<dd><?php echo $something[$k]; ?></dd>
	<?php endforeach; ?>
</dl>
<p>
	<a href="<?php echo $delete_rsu->get_as_string(); ?>">Yes</a>
	&nbsp;
	<a href="<?php echo $clear_rsu->get_as_string(); ?>">No</a>
</p>
<?php
	}
	
	/*
	 * ----------------------------------------
	 * Functions that are shared between the functions that render the forms
	 * for adding and editing.
	 * ----------------------------------------
	 */
	
	protected function
		render_form_li_text_input(
			$name,
			$value = NULL,
			$title = NULL
		)
	{
		if (!isset($title)) {
			$title
				= Formatting_ListOfWordsHelper
					::capitalise_delimited_string($name, '_');
		}
?>
<li>
	<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
	<input
		type="text"
		name="<?php echo $name; ?>"
		id="<?php echo $name; ?>"
<?php
		if (isset($value)) {
			echo "value=\"$value\"";
		}
?>
	/>
	<span
		id="<?php echo $name; ?>msg"
		class="rules"
	></span>
</li>
<?php
	}
	
	protected function
		render_form_li_textarea(
			$name,
			$value = NULL,
			$title = NULL,
			$cols = 50,
			$rows = 20
		)
	{
		#echo $value; exit;
		
		if (!isset($title)) {
			$title
				= Formatting_ListOfWordsHelper
					::capitalise_delimited_string($name, '_');
		}
?>
<li>
	<label for="page"><?php echo $title; ?></label>
	<textarea
		name="<?php echo $name; ?>"
		id="<?php echo $name; ?>"
		cols="<?php echo $cols; ?>"
		rows="<?php echo $rows; ?>"
	><?php
	if (isset($value)) {
		$value = stripcslashes($value);
		
		echo $value;
	}
?></textarea>
	<span
		id="<?php echo $name; ?>msg"
		class="rules"
	></span>
</li>
<?php
	}
	
	public function
		render_cu_form_opening_tag(
			$name,
			HTMLTags_URL $action_rsu
		)
	{
?>
<form
	name="<?php echo $name; ?>"
	id="basic-form"
	class="basic-form"
	method="POST"
	action="<?php echo $action_rsu->get_as_string(); ?>"
>
<?php
	}
	
	protected function
		get_cu_form_render_opening_tag_method_name()
	{
		return 'render_cu_form_opening_tag';
	}
	
	/**
	 * The skeleton of the add and edit ('create' - c and 'update' - u)
	 * forms.
	 */
	protected function
		render_cu_form(
			$name,
			HTMLTags_URL $action_rsu,
			HTMLTags_URL $clear_rsu,
			$title,
			$ol,
			$submit_text,
			$render_opening_tag_method_name
		)
	{
		/*
		 * Use a little reflection magic to be able to alter the method
		 * called to render the opening tag of the form.
		 */
		$cn = get_class($this);
		
		$rc = new ReflectionClass($cn);
		
		$crm = $rc->getMethod($render_opening_tag_method_name);
		
		$crm->invoke($this, $name, $action_rsu);

?>
	<fieldset>
		<legend><?php echo $title; ?></legend>
		<?php echo $ol; ?>
	</fieldset>
	<div class="submit_buttons_div">
		<input
			type="submit"
			value="<?php echo $submit_text; ?>"
			class="submit"
		/>
		<input
			type="button"
			value="Cancel"
			onclick="document.location.href=('<?php echo $clear_rsu->get_as_string(); ?>')"
			class="submit"
		/>
	</div>
</form>
<?php
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering forms to add something.
	 * ----------------------------------------
	 */
	
	protected function
		render_add_something_form_li_text_input(
			$name,
			$title = NULL
		)
	{
		$acm = $this->get_admin_crud_manager();
		
		$this->render_form_li_text_input(
			$name,
			($acm->has_form_session_var($name) ? $acm->get_form_session_var($name) : NULL),
			$title
		);
	}
	
	protected function
		render_add_something_form_li_textarea(
			$name,
			$title = NULL,
			$cols = 50,
			$rows = 20
		)
	{
		$acm = $this->get_admin_crud_manager();
		
		$this->render_form_li_textarea(
			$name,
			($acm->has_form_session_var($name) ? $acm->get_form_session_var($name) : NULL),
			$title,
			$cols = 50,
			$rows = 20
		);
	}
	
	protected function
		render_add_something_form()
	{
		$name = $this->get_add_something_form_name();
		
		$action_rsu = $this->get_add_something_redirect_script_url();
		$clear_rsu = $this->get_clear_form_redirect_script_url();
		
		$title = $this->get_add_something_title();
		
		ob_start();
		$this->render_add_something_form_ol();
		$ol = ob_get_clean();
		
		$this->render_cu_form(
			$name,
			$action_rsu,
			$clear_rsu,
			$title,
			$ol,
			$this->get_add_something_form_submit_text(),
			$this->get_add_something_form_render_opening_tag_method_name()
		);
	}
	
	protected function
		get_add_something_form_submit_text()
	{
		return 'Add';
	}
	
	protected function
		get_add_something_form_render_opening_tag_method_name()
	{
		return $this->get_cu_form_render_opening_tag_method_name();
	}
	
	protected function
		get_add_something_form_name()
	{
		return 'add_something_form';
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with displaying stuff to edit something.
	 * ----------------------------------------
	 */
	
	public function
		render_content_to_edit_something()
	{
		$this->render_last_action_div();
		$this->render_edit_something_form();
	}
	
	/**
	 * Renders the form where something can be edited.
	 */
	#abstract protected function
	#	render_edit_something_form();

	/**
	 * The title that is shown on the page where something
	 * is edited.
	 */
	protected function
		get_edit_something_title()
	{
		return 'Edit';
	}
	
	protected function
		render_edit_something_form_li_text_input(
			$name,
			$title = NULL
		)
	{
		$acm = $this->get_admin_crud_manager();
		
		$this->render_form_li_text_input(
			$name,
			($acm->has_current_var($name) ? $acm->get_current_var($name) : NULL),
			$title
		);
	}
	
	protected function
		render_edit_something_form_li_textarea(
			$name,
			$title = NULL,
			$cols = 50,
			$rows = 20
		)
	{
		$acm = $this->get_admin_crud_manager();
		
		$this->render_form_li_textarea(
			$name,
			($acm->has_current_var($name) ? $acm->get_current_var($name) : NULL),
			$title,
			$cols = 50,
			$rows = 20
		);
	}
	
	protected function
		render_edit_something_form()
	{
		$name = $this->get_edit_something_form_name();
		
		$action_rsu = $this->get_edit_something_redirect_script_url();
		$clear_rsu = $this->get_clear_form_redirect_script_url();
		
		$title = $this->get_edit_something_title();
		
		ob_start();
		$this->render_edit_something_form_ol();
		$ol = ob_get_clean();
		
		$this->render_cu_form(
			$name,
			$action_rsu,
			$clear_rsu,
			$title,
			$ol,
			$this->get_edit_something_form_submit_text(),
			$this->get_edit_something_form_render_opening_tag_method_name()
		);
	}
	
	protected function
		get_edit_something_form_submit_text()
	{
		return 'Update';
	}
	
	/**
	 * A bit of a mouthful.
	 *
	 * This returns the name of the method that is used to render
	 * the opening tag of the form to edit something.
	 */
	protected function
		get_edit_something_form_render_opening_tag_method_name()
	{
		return $this->get_cu_form_render_opening_tag_method_name();
	}
	
	protected function
		get_edit_something_form_name()
	{
		return 'edit_something_form';
	}
}
?>
