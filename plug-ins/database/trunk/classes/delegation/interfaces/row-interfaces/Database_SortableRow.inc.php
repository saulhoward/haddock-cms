<?php
/**
 * Database_SortableRow
 *
 * @copyright Clear Line Web Design, 2006-12-04
 */

/**
 * Any table that has rows for classes that implement
 * this interface, must have a column called 'sort_order'
 * that is an unsigned int.
 */
interface
    Database_SortableRow
{
    /**
     * Implement in the class as ordinary methods.
     */
    public function get_sort_order();
    public function set_sort_order($sort_order);
    public function get_sort_order_group_where_clause_fragment();
    
    /**
     * The class could extend Database_DelegateRow
     * and run the relevant behaviours.
     */
    public function min_sort_order();
    public function max_sort_order();
    
    public function move_up();
    public function move_down();
}

# e.g.
# Cut 'n' Paste programming at its best!

###################################################

# Put these include statements above the class definition.

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
#    . 'Database_SortableRowMoveUpBehaviour.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
#    . 'Database_SortableRowMoveDownBehaviour.inc.php';
#    
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
#    . 'Database_SortableRowMinSortOrderBehaviour.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/delegation/behaviours/row-behaviours/'
#    . 'Database_SortableRowMaxSortOrderBehaviour.inc.php';

###################################################

###################################################
# Add these methods to the class:

#protected function set_behaviours()
#{
#   $this->add_behaviour('min_sort_order', new Database_SortableRowMinSortOrderBehaviour($this));
#   $this->add_behaviour('max_sort_order', new Database_SortableRowMaxSortOrderBehaviour($this));
#   $this->add_behaviour('move_up', new Database_SortableRowMoveUpBehaviour($this));
#   $this->add_behaviour('move_down', new Database_DeletableRowDeleteBehaviour($this));
#}

#public function get_sort_order()
#{
#    return $this->get('sort_order');
#}
#
#public function set_sort_order($sort_order)
#{
#    $this->set('sort_order', $sort_order);
#}
#
#public function get_sort_order_group_where_clause_fragment()
#{
#    return '';
#}
#
#public function min_sort_order()
#{
#    return $this->run_behaviour('min_sort_order');
#}
#
#public function max_sort_order()
#{
#    return $this->run_behaviour('max_sort_order');
#}
#
#public function move_up()
#{
#    $this->run_behaviour('move_up');
#}
#
#public function move_down()
#{
#    $this->run_behaviour('move_down');
#}
?>
