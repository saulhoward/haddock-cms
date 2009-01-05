<?php
/**
 * Content of the "list-people-csv" admin page.
 *
 * @copyright Clear Line Web Design, 2007-11-29
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$people_table = $database->get_table('hpi_mailing_list_people');

#$conditions = array();
#$conditions['status'] = 'accepted';
#
#$people = $people_table->get_rows_where($conditions);

$people = $people_table->get_all_rows();

$people_p = new HTMLTags_P();
$people_p->set_attribute_str('id', 'people-csv');

$first = TRUE;
foreach ($people as $person) {
	if ($first) {
		$first = FALSE;
	} else {
		$people_p->append_str_to_content(', ');
	}
	
	$people_p->append_str_to_content('"');
	$people_p->append_str_to_content($person->get('name'));
	$people_p->append_str_to_content('" ');

	$people_p->append_str_to_content('&lt;');
	$people_p->append_str_to_content($person->get('email'));
	$people_p->append_str_to_content('&gt;');
}

$content_div->append_tag_to_content($people_p);

echo $content_div->get_as_string();

?>

