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

$logo_span = new HTMLTags_Span();
$logo_span->set_attribute_str('class', 'logo');

$content_div->append_tag_to_content($logo_span);

// HEADER
$main_page_header_id = 'home';
$main_page_header_title = 'Home';

$main_page_header_h = new HTMLTags_Heading(2);
$main_page_header_h->set_attribute_str('class', 'logo');
$main_page_header_h->set_attribute_str('id', $main_page_header_id);

$main_page_header_h->append_str_to_content($main_page_header_title);

$content_div->append_tag_to_content($main_page_header_h);

// IF LOGGED IN MESSAGE
if ($logged_in) {
    $content_div->append_str_to_content(
        $page_manager->get_inc_file_as_string('body.p.logged-in-salutation')
    );
}

// WELCOME MESSAGE
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.p.welcome-message')
);

// CONNECTED FILMS SHOP IMAGE
//
$home_img = new HTMLTags_IMG();
$home_img_location = new HTMLTags_URL();
$home_img_location->set_file('/images/clapperboard.png');
$home_img->set_src($home_img_location);
$home_img->set_attribute_str('class', 'home-page-img');

$content_div->append_tag_to_content($home_img);

// CUSTOMER REGION NOTIFICATION
//
$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

$customer_region_blurb_p = new HTMLTags_P();

if (isset($_GET['customer_region_session'])) {
	$customer_region_blurb_p->append_str_to_content('You have set your region to&nbsp;');
} else {
	$customer_region_blurb_p->append_str_to_content('Your region is set to&nbsp;');
}

$customer_region_blurb_p->append_str_to_content($customer_region->get_name_with_the());
$customer_region_blurb_p->append_str_to_content('.');
$content_div->append_tag_to_content($customer_region_blurb_p);

// LIST OF PRODUCT CATEGORIES
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.div.lines-of-stock')
);

// ALL PRODUCTS LINK
//
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.p.all-products-link')
);

echo $content_div->get_as_string();
?>
