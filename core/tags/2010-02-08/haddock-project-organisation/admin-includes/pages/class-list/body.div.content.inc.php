<?php
/**
 * The content of the page that creates the class
 * list.
 *
 * @copyright Clear Line Web Design, 2007-05-09
 */

#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Div.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_P.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Input.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Select.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Option.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
    
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

#$find_button = new HTMLTags_Input();
#
#$find_button->set_attribute_str('type', 'button');
#$find_button->set_attribute_str('value', 'Find Classes');
#$find_button->set_attribute_str('onclick', 'find_classes()');
#
#$content_div->append_tag_to_content($find_button);
#
#$class_list_div = new HTMLTags_Div();
#$class_list_div->set_attribute_str('id', 'class_list');
#
#$content_div->append_tag_to_content($class_list_div);

$selection_p = new HTMLTags_P();

$selection_p->append_str_to_content('Look for subclasses of: ');

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$php_class_files = $project_directory->get_php_class_files();

$class_list_select = new HTMLTags_Select();
$class_list_select->set_attribute_str('id', 'class_list_select');
$class_list_select->set_attribute_str('onchange', 'process()');

foreach ($php_class_files as $p_c_f) {
    $class_option = new HTMLTags_Option($p_c_f->get_php_class_name());
    
    $class_option->set_attribute_str('value', $p_c_f->get_php_class_name());
    
    $class_list_select->add_option($class_option);
}

$selection_p->append_tag_to_content($class_list_select);

$content_div->append_tag_to_content($selection_p);

$subclasses_list_div = new HTMLTags_Div();
$subclasses_list_div->set_attribute_str('id', 'subclasses_list');

$content_div->append_tag_to_content($subclasses_list_div);

echo $content_div->get_as_string();
?>
