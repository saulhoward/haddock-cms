<?php

$muf = Database_MySQLUserFactory::get_instance();

$mu = $muf->get_for_this_project();
$database = $mu->get_database();

$products_table = $database->get_table('hpi_trackit_stock_management_products');

$pr = $products_table->get_row_by_id($_GET['product_id']);

$prr = $pr->get_renderer();

?>
<div id="content">
	<dl>
		<dt>Product ID</dt>
		<dd><?php echo $pr->get('product_id'); ?></dd>
		<dt>Supplier Code</dt>
		<dd><?php echo $pr->get('supplier_code'); ?></dd>
		<dt>Size</dt>
		<dd><?php echo $pr->get('size'); ?></dd>
		<dt>Unit Price</dt>
		<dd><?php echo $pr->get('unit_price'); ?></dd>
		<dt>Tax Rate</dt>
		<dd><?php echo $pr->get('tax_rate'); ?></dd>
		<dt>Weight</dt>
		<dd><?php echo $pr->get('weight'); ?></dd>
		<dt>New</dt>
		<dd><?php echo $pr->get('new'); ?></dd>
		<dt>Top</dt>
		<dd><?php echo $pr->get('top'); ?></dd>
		<dt>Special</dt>
		<dd><?php echo $pr->get('special'); ?></dd>
		<dt>Visible</dt>
		<dd><?php echo $pr->get('visible'); ?></dd>
<?php
if ($pr->has_main_photograph()) {
	echo "<dt>Image</dt>\n";

	$photograph = $pr->get_main_photograph();
	$ph_rr = $photograph->get_renderer();

	$tia = $ph_rr->get_thumbnail_image_a();

	echo "<dd>" . $tia->get_as_string() . "</dd>\n";
}
?>
		<dt>Description</dt>
		<dd><?php echo $pr->get('description'); ?></dd>
		<dt>Full Description</dt>
		<dd><?php echo $pr->get('full_description'); ?></dd>
	</dl>
</div>