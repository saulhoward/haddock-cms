<?
/**
 * Admin page for setting the product image in Trackit
 *
 * @copyright CLWD, 2007-11-26
 */

$muf = Database_MySQLUserFactory::get_instance();

$mu = $muf->get_for_this_project();
$database = $mu->get_database();

$products_table
	= $database->get_table('hpi_trackit_stock_management_products');

$product_row = $products_table->get_row_by_id($_GET['product_id']);

$photographs_table
	= $database->get_table('hpi_shop_photographs');

?>
<div id="content">
<h2>Please set the image for Product <?php echo $product_row->get('product_id'); ?></h2>
<?php

$photographs = $photographs_table->get_all_rows();

echo "<ul>\n";

foreach ($photographs as $photograph) {
	$prr = $photograph->get_renderer();

	echo "<li>\n";

	$url = Admin_AdminIncluderURLFactory::get_url(
		'plug-ins',
		'trackit-stock-management',
		'set-product-image',
		'redirect-script'
	);

	$url->set_get_variable('photograph_id', $photograph->get_id());
	$url->set_get_variable('product_id', $product_row->get_id());

	$link = new HTMLTags_A();

	$link->set_href($url);

	$link->append_tag_to_content($prr->get_thumbnail_img());

	echo $link->get_as_string();
	
	echo "</li>\n";
}

echo "</ul>\n";

?>
</div>
