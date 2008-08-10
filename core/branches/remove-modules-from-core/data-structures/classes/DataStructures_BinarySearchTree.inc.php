<?php
/**
 * DataStructures_BinarySearchTree
 *
 * @copyright Clear Line Web Design, 2007-03-30
 */

/*
 * Define the necessary classes.
 */

require_once PROJECT_ROOT
    . '/haddock/data-structures/classes/'
    . 'DataStructures_BSTNode.inc.php';

/**
 * An implementation of a binary search tree.
 *
 * @see http://en.wikipedia.org/wiki/Binary_search_tree
 *
 * The built in array functions in PHP are very quick
 * and much better tested that this and should be
 * preferred in most cases.
 *
 * However, my motivation for writing this was the need
 * to find the key in an associative array with a numerical
 * value closest to a given number.
 *
 * Another way of achieving that might have been to sort
 * the array with <code>asort</code> and then looped through
 * the array until a value less than the number was found and
 * to then compare the difference with the surrounding elements.
 *
 * That would be less efficient if you had lots of look-ups
 * to do or the value was towards to the end of the array.
 */
class
    DataStructures_BinarySearchTree
{
    private $root_node;
    
    public function
        __construct()
    {
        $this->root_node = NULL;
    }
    
    public function
        insert_name_value_pair($name, $value)
    {
        if (!isset($this->root_node)) {
            $this->root_node = new DataStructures_BSTNode($name, $value);
        } else {
            $new_node = new DataStructures_BSTNode($name, $value);
            
            $this->root_node->insert($new_node);
        }
    }
    
    public function
        insert_assoc($assoc, $shuffle_before_insert = TRUE)
    {
        $keys = array_keys($assoc);
        
        if ($shuffle_before_insert) {
            shuffle($keys);
        }
        
        foreach ($keys as $key) {
            $this->insert_name_value_pair($key, $assoc[$key]);
        }
    }
    
    public static function
        get_bst_for_assoc($assoc, $shuffle_before_insert = TRUE)
    {
        $bst = new DataStructures_BinarySearchTree();
        
        $bst->insert_assoc($assoc, $shuffle_before_insert);
        
        return $bst;
    }
    
    public function
        get_lowest_value()
    {
        $lowest_node = $this->root_node->get_lowest_node();
        return $lowest_node->get_value();
    }
    
    public function
        get_greatest_value()
    {
        $greatest_node = $this->root_node->get_greatest_node();
        return $greatest_node->get_value();
    }
    
    public function
        get_name_with_lowest_value()
    {
        $lowest_node = $this->root_node->get_lowest_node();
        return $lowest_node->get_name();
    }
    
    public function
        get_name_with_greatest_value()
    {
        $greatest_node = $this->root_node->get_greatest_node();
        return $greatest_node->get_name();
    }
    
    public function
        get_closest_value($value)
    {
        $closest_node = $this->root_node->get_closest_node($value);
        return $closest_node->get_value();
    }
    
    public function
        get_name_with_closest_value($value)
    {
        $closest_node = $this->root_node->get_closest_node($value);
        return $closest_node->get_name();
    }
}
?>
