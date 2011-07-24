<?php
/**
 * Shop_CustomerRegionsTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
	Shop_CustomerRegionsTable
extends
	Database_Table
{

	//                $_POST['name'],
	//                $_POST['description'],
	//                $_POST['currency_id'],
	//                $_POST['language_id'],
	//                $_POST['sort_order']
	public function
		add_customer_region (
			$name,
			$description,
			$currency_id,
			$language_id,
			$sort_order
		)
	{
		if ($sort_order == '')
		{
			$sort_order = 0;
		}

		$customer_region_values = array();
		$customer_region_values['name'] = $name;
		$customer_region_values['description'] = $description;
		$customer_region_values['currency_id'] = $currency_id;
		$customer_region_values['language_id'] = $language_id;
		$customer_region_values['sort_order'] = $sort_order;

		$customer_region_id = $this->add($customer_region_values);
		return $customer_region_id;
	}

	public function
		edit_customer_region (
			$edit_id,
			$name,
			$description,
			$currency_id,
			$language_id,
			$sort_order
		)
	{
		if ($sort_order == '')
		{
			$sort_order = 0;
		}
		$customer_region_values = array();
		$customer_region_values['name'] = $name;
		$customer_region_values['description'] = $description;
		$customer_region_values['currency_id'] = $currency_id;
		$customer_region_values['language_id'] = $language_id;
		$customer_region_values['sort_order'] = $sort_order;

		return $this->update_by_id($edit_id, $customer_region_values);
	}

	public function
		get_default_customer_region()
	{
		$first_row_by_sort_order = $this->get_all_rows('sort_order', 'ASC', 0, 1);
        
        if (count($first_row_by_sort_order) == 1) {
            //                        print_r($first_row_by_sort_order);
            $default_customer_region = $first_row_by_sort_order[0];
            
            return $default_customer_region;
        } elseif (count($first_row_by_sort_order) == 0) {
            throw new Exception('No default customer region found!');
        } else {
            /*
             * This should never happen...
             */
            throw new Exception('More than one default customer region found!');
        }
	}
	
	public function
		get_current_customer_region()
	{
		if (isset($_SESSION['customer_region_id'])) {
			return $this->get_row_by_id($_SESSION['customer_region_id']);
		} else {
			return $this->get_default_customer_region();
		}
	}
}
?>
