<?php
/**
 * Shop_ProductTagRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Row.inc.php';

class
	Shop_ProductTagRow
	extends
	Database_Row
{
	private $product_count;

	public function
		__construct($table, $row)
	{
		if (!isset($row['product_count']))
		{
			parent::__construct($table, $row);
		}
		else
		{
			$this->product_count = $row['product_count'];
			unset($row['product_count']);
			parent::__construct($table, $row);
		}
	}

	public function
		get_tag()
	{
		return $this->get('tag');
	}

	public function
		get_principal()
	{
		return $this->get('principal');
	}

	public function
		is_principal()
	{
		if ($this->get_principal() == 'yes')
		{
			return TRUE;
		}
		return FALSE;
	}

	public function
		set_principal($principal)
	{
		$this->set('principal', $principal);
		$this->commit();
	}

	public function
		make_principal()
	{
		$this->set_principal('yes');
	}

	public function
		unmake_principal()
	{
		$this->set_principal('no');
	}

	public function
		get_product_count()
	{
		if (!isset($this->product_count)) {
			throw new Exception('I should really implement this product count function in tag row now');
		}

		return $this->product_count;
	}

	public function
		toggle_principal_status()
	{
		if ($this->is_principal())
		{
			$this->unmake_principal();
		}
		else
		{
			$this->make_principal();
		}
	}

	public function
		get_product_rows($ignore_product_id = 0)
	{
		$product_tag_id = $this->get_id();

		$query = <<<SQL
SELECT
	hpi_shop_products.*
FROM
	hpi_shop_products,
	hpi_shop_product_tags,
	hpi_shop_product_tag_links
WHERE
	hpi_shop_products.id = hpi_shop_product_tag_links.product_id
	AND
	hpi_shop_product_tags.id = hpi_shop_product_tag_links.product_tag_id
	AND
	hpi_shop_product_tags.id = $product_tag_id
	AND
	hpi_shop_products.status = 'display'

SQL;

		if ($ignore_product_id > 0) {
			$query .= <<<SQL
	AND
	hpi_shop_products.id <> $ignore_product_id

SQL;

		}

		$query .= <<<SQL
ORDER BY
	hpi_shop_products.id
SQL;

		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');
		return $products_table->get_rows_for_select($query);
	}

	public function
		get_first_product_row()
	{
		$product_tag_id = $this->get_id();

		$query = <<<SQL
SELECT
	hpi_shop_products.*
FROM
	hpi_shop_products,
	hpi_shop_product_tags,
	hpi_shop_product_tag_links
WHERE
	hpi_shop_products.id = hpi_shop_product_tag_links.product_id
AND
	hpi_shop_product_tags.id = hpi_shop_product_tag_links.product_tag_id
AND
	hpi_shop_product_tags.id =$product_tag_id
AND
	hpi_shop_products.status = 'display'
ORDER BY
	hpi_shop_products.id
LIMIT 0 , 1

SQL;
		#echo $query;
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$rows = $products_table->get_rows_for_select($query);
		return $rows[0];
	}    

	public function
		get_popularity_css_class()
	{
		$tags_table = $this->get_table();

		$t_p_c_c_w_ps
			= $tags_table->get_tag_popularity_css_classes_with_popularities();

		#print_r($t_p_c_c_w_ps);

		$product_count = $this->get_product_count();

		#echo "\$product_count: $product_count\n";

		$css_class = $t_p_c_c_w_ps->get_name_with_closest_value($product_count);

		#echo "\$css_class: $css_class\n";

		return $css_class;
	}
}

?>
