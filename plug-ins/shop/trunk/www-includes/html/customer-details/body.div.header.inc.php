<?php
//<div id="container">
//<div id="header">
//<span class="logo"></span>
//<h1>Connected Films Shop</h1>
//<div id="tabs">
//# Build the list of links.
//$tabs_pages[] = array(
//        'name' => 'home',
//        'title' => 'Home',
//        'text' => 'Home'
//);

//$tabs_pages[] = array(
//        'name' => 'products',
//        'title' => 'Products',
//        'text' => 'Products'
//);

//$tabs_pages[] = array(
//        'name' => 'contact',
//        'title' => 'Contact us',
//        'text' => 'Contact'
//);

//# Render the links.
//echo "<ul>\n";
//foreach ($tabs_pages as $tabs_page) {
//        echo "<li";

//        if ($tabs_page['name'] == PAGE) {
//                echo ' class="selected"';
//        }

//        echo ">\n";
//        if ($tabs_page['name'] == 'diary')
//        {
//                echo '<a href="/diary/" title="Production Diary"';
//        } else {
//                echo '<a '
//                        . 'href="/' . $tabs_page['name'] . '.html" '
//                        . 'title="' . $tabs_page['title'] . '"';


//        }

//        echo ">";
//        echo "<span>\n";
//        echo $tabs_page['text'];
//        echo "</span>\n";
//        echo "</a>\n";
//        echo "</li>\n";
//}
//echo "</ul>\n";
//echo "</div>\n";
//echo "<p>buy a DVD!</p>";
//echo "</div>\n";
//




/**
 * The header include for
 * the Connected Films Shop.
 * 
 * @copyright Clear Line Web Design, 2006-09-27
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_UL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_LI.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_URL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Heading.inc.php';
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_A.inc.php';
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';


$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

$header_div = new HTMLTags_Div();
$header_div->set_attribute_str('id', 'header');

$logo_span = new HTMLTags_Span();

$header_div->append_tag_to_content($logo_span);

$header_div_header_id = 'connected_films_shop';
$header_div_header_title = 'Connected Films Shop';
$header_div_header_class = 'header';

$header_div_header_h = new HTMLTags_Heading(1);
$header_div_header_h->set_attribute_str('class', $header_div_header_class);
$header_div_header_h->set_attribute_str('id', $header_div_header_id);

$header_div->append_tag_to_content($header_div_header_h);

//$header_div->append_tag_to_content(new HTMLTags_P('Buy a DVD!'));
echo $header_div;
?>
