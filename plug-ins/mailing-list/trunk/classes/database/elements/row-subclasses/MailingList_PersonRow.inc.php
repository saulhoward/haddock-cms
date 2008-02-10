<?php
/**
 * MailingList_PersonRow
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
    MailingList_PersonRow
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
        get_name()
    {
        return $this->get('name');
    }
    public function
        get_email()
    {
        return $this->get('email');
    }
    public function
        get_status()
    {
        return $this->get('status');
    }
}
?>
