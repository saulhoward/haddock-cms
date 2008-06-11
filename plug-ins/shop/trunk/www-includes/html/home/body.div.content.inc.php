<?php
/**
 * Content of the home page of the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-04-05
 */

$page_manager = PublicHTML_PageManager::get_instance();

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

// CONTENT DIV
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

//$logo_span = new HTMLTags_Span();
//$logo_span->set_attribute_str('class', 'logo');

//$content_div->append_tag_to_content($logo_span);

/*
 *  HEADER
 */
$main_page_header_id = 'home';
$main_page_header_title = 'Home';

$main_page_header_h = new HTMLTags_Heading(2, $main_page_header_title);
$main_page_header_h->set_attribute_str('class', 'logo');
$main_page_header_h->set_attribute_str('id', $main_page_header_id);

$content_div->append_tag_to_content($main_page_header_h);

/*
 * Welcome DIV
 */
$welcome_div = new HTMLTags_Div();
$welcome_div->set_attribute_str('id', 'welcome');

// IF LOGGED IN MESSAGE
if ($logged_in) {
    $welcome_div->append_str_to_content(
        $page_manager->get_inc_file_as_string('body.p.logged-in-salutation')
    );
}

// WELCOME MESSAGE
$welcome_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.p.welcome-message')
);

/*
 *  CONNECTED FILMS SHOP IMAGE
 */
//$home_img = new HTMLTags_IMG();
//$home_img_location = new HTMLTags_URL();
//$home_img_location->set_file('/images/home_page_image.jpg');
//$home_img->set_src($home_img_location);
//$home_img->set_attribute_str('class', 'home-page-img');

//$welcome_div->append_tag_to_content($home_img);

/*
 * Customer Region Notification
 *
 * We should make inclusion of this div conditional and move the region code
 * to a separate plug-in as many shops do not divide their customers into regions.
 */
$welcome_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.div.customer-region-notification')
);

/*
 *  LIST OF PRODUCT CATEGORIES
 */
//$welcome_div->append_str_to_content(
//    $page_manager->get_inc_file_as_string('body.div.lines-of-stock')
//);

/*
 *  ALL PRODUCTS LINK
 */
$welcome_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.p.all-products-link')
);

$content_div->append_tag_to_content($welcome_div);

// FRONT PAGE PRODUCT DISPLAY
//
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.div.front-page-products')
);

echo $content_div->get_as_string();
?>