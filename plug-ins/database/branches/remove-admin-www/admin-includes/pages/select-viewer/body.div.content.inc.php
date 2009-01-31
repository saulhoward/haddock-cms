<?php
/**
 * Content of the "select-viewer" admin page.
 *
 * @copyright Clear Line Web Design, 2007-11-16
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Link to a blank form in a new tab or window,
 * so that you can preserve the current query.
 */
if (isset($_GET['query'])) {
	$blank_form_link_a = new HTMLTags_A('New Form');

	$blank_form_link_a->set_attribute_str('target', '_blank');

	$blank_form_link_url = Admin_AdminIncluderURLFactory::get_url(
		$section = 'haddock',
		$module = 'database',
		$page = 'select-viewer',
		$type = 'html'
	);

	$blank_form_link_a->set_href($blank_form_link_url);

	$blank_form_link_p = new HTMLTags_P();

	$blank_form_link_p->append_tag_to_content($blank_form_link_a);

	$content_div->append_tag_to_content($blank_form_link_p);
}

/*
 * The form to take the query.
 */
$query_form = new HTMLTags_Form();

$query_form->set_attribute_str('id', 'query_form');
$query_form->set_attribute_str('method', 'GET');

$action_url = Admin_AdminIncluderURLFactory::get_url(
	'haddock',
	'database',
	'select-viewer',
	'html'
);

$slash_url = new HTMLTags_URL();
$slash_url->set_file('/');

$query_form->set_action($slash_url);

$get_vars = $action_url->get_get_variables();
foreach (array_keys($get_vars) as $key) {
	$hidden_input = new HTMLTags_Input();

	$hidden_input->set_attribute_str('type', 'hidden');
	$hidden_input->set_attribute_str('name', $key);
	$hidden_input->set_attribute_str('value', $get_vars[$key]);

	$query_form->append_tag_to_content($hidden_input);
}

/*
 * A list to store the inputs.
 */

$form_ul = new HTMLTags_UL();

/*
 * The query input.
 */
$query_li = new HTMLTags_LI();

$query_label = new HTMLTags_Label('Query');
$query_label->set_attribute_str('for', 'query');

$query_li->append_tag_to_content($query_label);

$query_input = new HTMLTags_TextArea();

$query_input->set_attribute_str('id', 'query');
$query_input->set_attribute_str('name', 'query');

if (isset($_GET['query'])) {
	$query_input->append_str_to_content(
		stripcslashes($_GET['query'])
	);
}

$query_input->set_attribute_str('cols', 72);
$query_input->set_attribute_str('rows', 15);

$query_li->append_tag_to_content($query_input);

$form_ul->add_li($query_li);

/*
 * The submit button.
 */

$submit_button = new HTMLTags_Input();

$submit_button->set_attribute_str('type', 'submit');
$submit_button->set_attribute_str('value', 'GO');
$submit_button->set_attribute_str('class', 'submit');

$form_ul->add_tag_in_new_li($submit_button);

$query_form->append_tag_to_content($form_ul);

$content_div->append_tag_to_content($query_form);

/*
 * Get the data.
 */
if (isset($_GET['query'])) {
	$query = stripcslashes($_GET['query']);

	if (strlen($query) == 0) {
		$p = new HTMLTags_P('Try typing a SELECT statement.');

		$content_div->append_tag_to_content($p);
	} elseif (preg_match('/^(?:\s*\()*\s*(?:(?:EXPLAIN\s*)?SELECT|SHOW)\s/i', $query)) {
		$muf = Database_MySQLUserFactory::get_instance();

		$mu = $muf->get_for_this_project();

		$dbh = $mu->get_database_handle();

		$result = mysql_query($query, $dbh);

		/*
		 * The table.
		 */
		if (
			$result
			&&
			mysql_num_rows($result) > 0
		) {
			$results_table = new HTMLTags_Table();

			$first = TRUE;
			while ($row = mysql_fetch_assoc($result)) {
				$fields = array_keys($row);

				if ($first) {
					$first = FALSE;

					$fields_header_tr = new HTMLTags_TR();

					foreach ($fields as $field) {
						$fields_header_tr->append_tag_to_content(
							new HTMLTags_TH($field)
						);
					}

					$results_table->append_tag_to_content($fields_header_tr);
				}

				$fields_data_tr = new HTMLTags_TR();

				foreach ($fields as $field) {
					$fields_data_tr->append_tag_to_content(
						new HTMLTags_TD(htmlentities($row[$field]))
					);
				}

				$results_table->append_tag_to_content($fields_data_tr);
			}

			$content_div->append_tag_to_content($results_table);
		} else {
			$p = new HTMLTags_P('No rows found!');

			$content_div->append_tag_to_content($p);
		}
	} else {
		$p = new HTMLTags_P('Sorry, SELECT statements only!');

		$content_div->append_tag_to_content($p);
	}
}

echo $content_div->get_as_string();

?>
