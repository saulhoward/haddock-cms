<?
/**
 * The script where photos are set for a product.
 *
 * @copyright Clear Line Web Design, 2007-11-26
 */

$muf = Database_MySQLUserFactory::get_instance();
$mu = $muf->get_for_this_project();
$database = $mu->get_database();

$products_table = $database->get_table('hpi_trackit_stock_management_products');
$photographs_table = $database->get_table('hpi_shop_photographs');

$photograph_row = $photographs_table->get_row_by_id($_GET['photograph_id']);

$values = array();

$values['image_name'] = $photograph_row->get('name');

$products_table->update_by_id($_GET['product_id'], $values);

$page_manager = PublicHTML_PageManager::get_instance();

$return_to_url = Admin_AdminIncluderURLFactory::get_url(
	'plug-ins',
	'trackit-stock-management',
	'product',
	'html'
);

$return_to_url->set_get_variable('product_id', $_GET['product_id']);

$page_manager->set_return_to_url($return_to_url);

?>