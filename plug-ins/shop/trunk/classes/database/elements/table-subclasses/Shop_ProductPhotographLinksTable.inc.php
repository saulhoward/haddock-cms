<?php
/**
 * Shop_ProductPhotographLinksTable
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

class
	Shop_ProductPhotographLinksTable
	extends
	Database_Table
{
	public function
		delete_orphaned_product_photograph_links()
	{
		$query = <<<SQL
DELETE FROM
	hpi_shop_product_photograph_links
WHERE
	product_id
NOT IN (
	SELECT (
		id
	)
	FROM `hpi_shop_products`
)
SQL;
		$dbh = $this->get_database_handle();
		mysql_query($query, $dbh);  
	}
}
?>
