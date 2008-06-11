<?php
/**
 * Shop_ProductsTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';
    
class
    Shop_ProductsTable
extends
    Database_Table
{
    public function
        add_product(
            $name,
            $description,
	    $product_category_id,
	    $product_brand_id,
	    $supplier_id,
            $use_stock_level,
            $sort_order
        )
    {
        $values = array();
        
        $values['name'] = $name;
        $values['added'] = 'NOW()';
        $values['description'] = $description;
        $values['product_category_id'] = $product_category_id;
        $values['product_brand_id'] = $product_brand_id;
        $values['supplier_id'] = $supplier_id;
        $values['use_stock_level'] = $use_stock_level;
        $values['sort_order'] = $sort_order;
        
        return $this->add($values);
    }
    
    public function
        edit_product(
            $edit_id,
            $name,
            $description,
	    $product_category_id,
	    $product_brand_id,
	    $supplier_id,
            $use_stock_level,
            $sort_order
        )
//                $_GET['edit_id'],
//                $_POST['name'],
//                $_POST['description'],
//                $_POST['photograph_id'],
//                $_POST['product_category_id'],
//                $_POST['product_brand_id'],
//                $_POST['supplier_id'],
//                $_POST['use_stock_level'],
//                $_POST['sort_order']
    {
        $values = array();
        
        $values['name'] = $name;
        $values['description'] = $description;
        $values['product_category_id'] = $product_category_id;
        $values['product_brand_id'] = $product_brand_id;
        $values['supplier_id'] = $supplier_id;
        $values['use_stock_level'] = $use_stock_level;
        $values['sort_order'] = $sort_order;
        
        return $this->update_by_id($edit_id, $values);
    }

    public function
	    explode_tags ($tags)
    {
	    if (preg_match('/\S+/', $tags))
	    {
		    if (preg_match('/^\s*(\S+(?:\s+\S+)*)\s*$/', $tags, $matches)){
			    $tags = $matches[1];
			    #print_r($matches);
		    }
		    $tags_array = preg_split('/\s+/', $tags);

		    return $tags_array;
	    }
	    else {
		    return array();
	    }
    }

    public function
	    edit_product_tags(
		    $edit_id,
		    $tags
	    )
    {
//            print_r($edit_id);exit;
	    $database = $this->get_database();

	    $tags_table = $database->get_table('hpi_shop_product_tags');

	    $tag_links_table = $database->get_table('hpi_shop_product_tag_links');

	    $conditions = array();
	    $conditions['product_id'] = $edit_id;

	    $tag_links_table->delete_where($conditions);

	    $tags_table->delete_orphaned_tags_excluding_principal_tags();

//            print_r($tags);exit;
	    $tags = strtolower($tags);
	    $tags_array = $this->explode_tags($tags);

//            print_r($tags_array);exit;
	    foreach ($tags_array as $tag)
	    {
		    $tag_values = array();
		    $tag_values['tag'] = $tag;
		    try
		    {
			    $tag_id = $tags_table->add($tag_values);

		    }
		    catch (Database_MySQLException $e)
		    {
			    if ($e->get_error_number() == 1062) #duplicate sql entry
			    {
				    $conditions = array();
				    $conditions['tag'] = $tag;
				    $existing_tag_rows = $tags_table->get_rows_where($conditions);
				    $tag_id = $existing_tag_rows[0]->get_id();  
			    } else {

				    throw $e;
			    }
		    }

		    $tag_links_values = array();
		    $tag_links_values['product_tag_id'] = $tag_id;
		    $tag_links_values['product_id'] = $edit_id;

		    try
		    {
			    $tag_links_table->add($tag_links_values);
		    }
		    catch (Database_MySQLException $e)
		    {
			    if ($e->get_error_number() == 1062) #duplicate sql entry
			    {
				    #if tag link already exists, do nothing

			    } else {
				    throw $e;
			    }
		    }
	    }
    }

    public function
	    remove_tag($product_id, Shop_ProductTagRow $tag)
    {
	    $database = $this->get_database();
	    $tags_table = $database->get_table('hpi_shop_product_tags');
	    $tag_links_table = $database->get_table('hpi_shop_product_tag_links');

	    $conditions = array();
	    $conditions['product_tag_id'] = $tag->get_id();
	    $conditions['product_id'] = $product_id;

	    $tag_links_table->delete_where($conditions);

//            $tags_table->delete_orphaned_tags_excluding_principal_tags();


	    //                if (!is_array($this->tags)) {
	    //                        $this->tags = array();
	    //                }
	    //                $this->tags[] = $tag;

    }

    public function
	    remove_all_principal_tags($product_id)
    {
	    $product = $this->get_row_by_id($product_id);
	    $tags = $product->get_tags();

	    foreach ($tags as $tag)
	    {
		    if ($tag->is_principal())
		    {

			    #print_r($tags);exit;
			    $this->remove_tag($product_id, $tag);
		    }
	    }
    }

    public function
	    count_products()
    {

	    return $this->count_all_rows();

    }

}
?>
