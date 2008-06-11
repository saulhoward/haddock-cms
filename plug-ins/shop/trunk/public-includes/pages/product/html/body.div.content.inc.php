<?php
/**
 * The content of a page that shows a product.
 *
 * @copyright Clear Line Web Design, 2007-07-26
 */

/*
 * Get instances of the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$gvm = Caching_GlobalVarManager::get_instance();

$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Create other objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$comments_table = $database->get_table('hpi_shop_comments');

$product_row = $gvm->get('product');
$product_row_renderer = $product_row->get_renderer();

/*
 * Start assembling the display.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$full_product_div = $product_row_renderer->get_full_product_div_in_public();
$content_div->append_tag_to_content($full_product_div);

$product_links_ul = $product_row_renderer->get_product_links_ul_in_public();
$content_div->append_tag_to_content($product_links_ul);

// Comments Div
$comments_div = new HTMLTags_Div();
$comments_div->set_attribute_str('id', 'product-comments');

if ($product_row->count_comments() > 0) {
    $comments_div->append_tag_to_content(new HTMLTags_Heading(3, 'Comments'));
    $product_comments_div = 
        $product_row_renderer->get_paged_public_all_comments_div($page_manager->get_page());
        
    $product_comments_div->set_attribute_str('class', 'comments-listing');
    $comments_div->append_tag_to_content($product_comments_div);
}

#--------------------------------
# COMMENT ADDING FORM
#--------------------------------
$comment_form_div = new HTMLTags_Div();
$comment_form_div->set_attribute_str('class', 'comment-form');

$form_notification_div = new HTMLTags_Div();
$form_notification_div->set_attribute_str('id', 'form_notification_div');
if (isset($_GET['last_added_id'])) {
    $form_notification_div->
        append_tag_to_content(
            new HTMLTags_P(
                'Thank you for your comment.<br />
                Comments can take up to 24 hours to 
                appear in the guestbook.'
            )
        );
}
if (isset($_GET['form_incomplete'])) {
        $form_notification_div->
                append_tag_to_content(new HTMLTags_P('Please complete name, email and comment'));
}
$comment_form_div->append_tag_to_content($form_notification_div);

$comment_adding_action_url = new HTMLTags_URL();
$comment_adding_action_url->set_file('/');

$comment_adding_action_url->set_get_variable('section', 'plug-ins');
$comment_adding_action_url->set_get_variable('module', 'shop');
$comment_adding_action_url->set_get_variable('page', 'products');
$comment_adding_action_url->set_get_variable('type', 'redirect-script');

$comment_adding_action_url->set_get_variable('product_id', $_GET['product_id']);

$cancel_location = new HTMLTags_URL();
$cancel_location->set_file('/');

$cancel_location->set_get_variable('section', 'plug-ins');
$cancel_location->set_get_variable('module', 'shop');
$cancel_location->set_get_variable('page', 'product');
$cancel_location->set_get_variable('product_id', $_GET['product_id']);

$comment_adding_form = new HTMLTags_SimpleOLForm('comment_adding');
$comment_adding_form->set_attribute_str('class', 'cmxform');
$comment_adding_form->set_attribute_str('id', 'comment-form');
$comment_adding_action = $comment_adding_action_url;
$comment_adding_action->set_get_variable('add_comment');
$comment_adding_form->set_action($comment_adding_action);
$comment_adding_form->set_legend_text('Add a comment');
$comment_adding_form->add_input_name('name');
$comment_adding_form->add_input_name('email');

/*
 * Hidden product_id input
 */
$product_id_input = new HTMLTags_Input();
$product_id_input->set_attribute_str('type', 'hidden');
$product_id_input->set_attribute_str('name', 'product_id');
$product_id_input->set_attribute_str('value', $_GET['product_id']);
$comment_adding_form->add_input_tag(
        '',
        $product_id_input
);
#$comment_adding_form->add_input_name('url', 'URL');
#
#$comment_adding_form->add_input_name('homepage_title');

/*
 * The comment input.
 */
$comment_field = $comments_table->get_field('comment');
$comment_field_renderer = $comment_field->get_renderer();
$comment_input_tag = $comment_field_renderer->get_form_input();
$comment_adding_form->add_input_tag(
        'comment',
        $comment_input_tag
);

/*
 * The add button.
 */
$comment_adding_form->set_submit_text('Add');
$comment_adding_form->set_cancel_location($cancel_location);

$comment_form_div->append_tag_to_content($comment_adding_form);
$comments_div->append_tag_to_content($comment_form_div);
$content_div->append_tag_to_content($comments_div);

echo $content_div->get_as_string();
?>
