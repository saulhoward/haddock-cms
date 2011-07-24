<?php
/**
 * Shop_ProductTagsTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
	Shop_ProductTagsTable
extends
	Database_Table
{
	private $tag_popularity_css_classes_with_popularities;

	public function
		get_tags_with_counts(
			$order_by = 'product_count',
			$direction = 'DESC'
		)
	{
		$query = <<<SQL
SELECT
    count(distinct(hpi_shop_products.id)) AS 'product_count',
    hpi_shop_product_tags.*
FROM
    hpi_shop_products,
    hpi_shop_product_tags,
    hpi_shop_product_tag_links
WHERE
    hpi_shop_product_tag_links.product_id = hpi_shop_products.id
    AND
    hpi_shop_product_tag_links.product_tag_id = hpi_shop_product_tags.id
GROUP BY
    hpi_shop_product_tags.id
ORDER BY
    $order_by $direction
SQL;

		#$tags_table = $this->get_element();

		return $this->get_rows_for_select($query);      
	}

	public function
		delete_orphaned_tags()
	{
		$query = <<<SQL
DELETE FROM
    hpi_shop_product_tags
WHERE
    hpi_shop_product_tags.id
NOT IN (
    SELECT DISTINCT (
	hpi_shop_product_tag_links.product_tag_id
    )
    FROM
    hpi_shop_product_tag_links
)
SQL;

		$dbh = $this->get_database_handle();
		mysql_query($query, $dbh);  
	}

	public function
		delete_orphaned_tags_excluding_principal_tags()
	{
		$query = <<<SQL
DELETE FROM
	hpi_shop_product_tags
WHERE
	id
NOT IN (
	SELECT DISTINCT (
		product_tag_id
	)
	FROM `hpi_shop_product_tag_links`
)
AND 
	principal = 'no'
SQL;
		$dbh = $this->get_database_handle();
		mysql_query($query, $dbh);  
	}   

	public static function
		get_tag_popularity_css_classes()
	{
		return explode(' ', 'not-popular not-very-popular somewhat-popular popular very-popular ultra-popular');
	}

	private function
		get_tag_popularity($end)
	{
		$end = strtoupper($end);
		if (!in_array($end, explode(' ', 'MAX MIN'))) {
			throw new Exception(
				'The first argument passed to Shop_ProductTagsTable::get_tag_popularity(...)
				must be \'MAX\' or \'MIN\'!'
			);
		}

		if ($end == 'MAX') {
			$direction = 'DESC';
		} else {
			$direction = 'ASC';
		}

		$query = <<<SQL
SELECT
    DISTINCT (product_tag_id),
    COUNT(product_id) AS product_count
FROM
    hpi_shop_product_tag_links
GROUP BY
    product_tag_id
ORDER BY
    product_count $direction
LIMIT
    0, 1
SQL;

		#echo "\$query: \n$query\n";

		$dbh = $this->get_database_handle();

		$result = mysql_query($query, $dbh);

		$tag_popularity = 0;

		while ($row = mysql_fetch_array($result)) {
			$tag_popularity = $row[1];
		}

		return $tag_popularity;
	}

	public function
		get_max_tag_popularity()
	{
		return $this->get_tag_popularity('MAX');
	}

	public function
		get_min_tag_popularity()
	{
		return $this->get_tag_popularity('MIN');        
	}

	/**
	 * @return DataStructures_BinarySearchTree
	 */
	public function
		get_tag_popularity_css_classes_with_popularities()
	{
		if (!isset($this->tag_popularity_css_classes_with_popularities)) {
			$t_p_c_cs_w_ps = array();

			$t_p_c_cs = self::get_tag_popularity_css_classes();

			#print_r($t_p_c_cs);

			$min_popularity = $this->get_min_tag_popularity();
			#echo "\$min_popularity: $min_popularity\n";

			$max_popularity = $this->get_max_tag_popularity();
			#echo "\$max_popularity: $max_popularity\n";

			$range = ($max_popularity - $min_popularity) + 1;

			$number_of_popularities = count($t_p_c_cs);

			#$popularity_step = floor($range / $number_of_popularities);
			$popularity_step = $range / $number_of_popularities;

			#echo "\$popularity_step: $popularity_step\n";

			$previous = 0;
			foreach ($t_p_c_cs as $popularity) {
				$current = $previous + $popularity_step;
				$t_p_c_cs_w_ps[$popularity]
					#= floor($current);
					= $current;

				$previous = $current;
			}

			#$current = 0;
			#foreach ($t_p_c_cs as $popularity) {
			#    $this->tag_popularity_css_classes_with_popularities[$popularity]
			#        #= floor($current);
			#        = $current;
			#    
			#    $current += $popularity_step;
			#}

			$this->tag_popularity_css_classes_with_popularities
				= DataStructures_BinarySearchTree::get_bst_for_assoc($t_p_c_cs_w_ps);
		}

		return $this->tag_popularity_css_classes_with_popularities;
	}

	public function
		add_product_tag(
			$tag,
			$principal
		)
	{
		$values = array();

		$values['tag'] = $tag;
		$values['principal'] = $principal;

		try
		{
			$tag_id = $this->add($values);

		}
		catch (Database_MySQLException $e)
		{
			if ($e->get_error_number() == 1062) #duplicate sql entry
			{
				$conditions = array();
				$conditions['tag'] = $tag;
				$existing_tag_rows = $this->get_rows_where($conditions);
				$tag_id = $existing_tag_rows[0]->get_id();  
			} else {

				throw $e;
			}
		}

		return $tag_id;
	}

	public function
		get_principal_tags()
	{
		$conditions = array();
		$conditions['principal'] = 'yes';

		return $this->get_rows_where($conditions);
	}
	
	/**
	 * This should probably be deprecated or replaced by
	 * get_single_tag() below.
	 */
	public function
		get_tag($tag_str)
	{
		$conditions = array();
		$conditions['tag'] = $tag_str;

		return $this->get_rows_where($conditions);
	}

	public function
		get_single_tag($tag_str)
	{
		$conditions = array();
		$conditions['tag'] = $tag_str;

		$rows = $this->get_rows_where($conditions);
		
		if (count($rows) == 1) {
			return $rows[0];
		} elseif (count($rows) == 0) {
			throw new Exception("No tag called '$tag_str' found!");
		} else {
			throw new Exception("More than one tag called '$tag_str' found!");
		}
	}
}
?>
