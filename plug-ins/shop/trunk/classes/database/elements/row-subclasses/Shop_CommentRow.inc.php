<?php
/**
 * Shop_CommentRow
 *
 * @copyright Clear Line Web Design, 2007-02-16
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/row-subclasses/'
    . 'Database_DelegateRow.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
    . 'Database_SortableRowMoveUpBehaviour.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
    . 'Database_SortableRowMoveDownBehaviour.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
    . 'Database_SortableRowMinSortOrderBehaviour.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
    . 'Database_SortableRowMaxSortOrderBehaviour.inc.php';

class
    Shop_CommentRow
extends
    Database_DelegateRow
implements
    Database_SortableRow
{
    protected function
        set_behaviours()
    {
        $this->add_behaviour(
            'min_sort_order',
            new Database_SortableRowMinSortOrderBehaviour($this)
        );
        
        $this->add_behaviour(
            'max_sort_order',
            new Database_SortableRowMaxSortOrderBehaviour($this)
        );
        
        $this->add_behaviour(
            'move_up',
            new Database_SortableRowMoveUpBehaviour($this)
        );
        
        $this->add_behaviour(
            'move_down',
            new Database_SortableRowMoveDownBehaviour($this)
        );
    }
    
    public function
        get_sort_order()
    {
        return $this->get('sort_order');
    }
    
    public function
        set_sort_order($sort_order)
    {
        $this->set('sort_order', $sort_order);
    }
    
    public function
        get_sort_order_group_where_clause_fragment()
    {
        return '';
    }
    
    public function
        min_sort_order()
    {
        return $this->run_behaviour('min_sort_order');
    }
    
    public function
        max_sort_order()
    {
        return $this->run_behaviour('max_sort_order');
    }
    
    public function
        move_up()
    {
        $this->run_behaviour('move_up');
    }
    
    public function
        move_down()
    {
        $this->run_behaviour('move_down');
    }

    public function
        get_added()
    {
        return $this->get('added');
    }

    public function
        get_comment()
    {
        return $this->get('comment');
    }
    public function
        get_status()
    {
        return $this->get('status');
    }
    public function
        get_front_page()
    {
        return $this->get('front_page');
    }
        public function
        get_commenter_id()
    {
        return $this->get('commenter_id');
    }
        public function
        get_product_id()
    {
        return $this->get('product_id');
    }
    
    public function
        get_product()
    {
        $database = $this->get_database();
        $products_table = $database->get_table('hpi_shop_products');
        return $products_table->get_row_by_id($this->get_product_id());
    }
    public function
        get_commenter()
    {
        $database = $this->get_database();
        $commenters_table = $database->get_table('hpi_shop_commenters');
        return $commenters_table->get_row_by_id($this->get_commenter_id());
    }

    public function
	    get_commenters_name_with_possessive()
    {
	    $commenter = $this->get_commenter();
	    return $commenter->get_name_with_possessive();
    }
}
?>
