<?php
/**
 * Database_DeletableRow
 *
 * RFI & SANH 2006-12-04
 */

/**
 * Any table that has rows for classes that implement
 * this interface, must have a column called 'deleted'
 * that is an enum with values 'Yes', 'No'.
 */
interface Database_DeletableRow
{
    /**
     * Implement in the class.
     */
    public function get_deleted();
    public function is_deleted();
    
    /**
     * The class could extend Database_DelegateRow
     * and run the relevant behaviour.
     */
    public function delete();
}

# e.g.
# Cut 'n' Paste programming at its best!

###################################################

# Put these include statements above the class definition.

#require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_DeletableRowDeleteBehaviour.inc.php';

###################################################

# Put these into a method called:
# protected function set_behaviours()

#$this->add_behaviour('delete', new Database_DeletableRowDeleteBehaviour($this));

###################################################
# Add these methods to the class:

#public function get_deleted()
#{
#    return $this->get('deleted');
#}
#
#public function is_deleted()
#{
#    return $this->get_deleted() == 'Yes';
#}
#
#public function delete()
#{
#    $this->run_behaviour('delete');
#}
?>
