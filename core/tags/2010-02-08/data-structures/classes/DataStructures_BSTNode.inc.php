<?php
/**
 * DataStructures_BSTNode
 *
 * @copyright 2007-03-30, Robert Impey
 */

/**
 * A node in a binary search tree.
 *
 * @see <code>DataStructures_BinarySearchTree</code>
 */
class
	DataStructures_BSTNode
{
	/**
	 * Using generic <code>$name</code> to avoid confusion with "key".
	 *
	 * Most of the type this will be the key from an assoc
	 * but calling it "key" might lead to confusion with 
	 * <code>$value</code> below.
	 */
	private $name;
	
	/**
	 * This is the value from the assoc that is passed to
	 * the BST factory function.
	 *
	 * From the p.o.v. of this datastructure, this is the key.
	 *
	 * Confused?
	 * Remember the assoc is turned back to front and keys
	 * are made values and values are made keys.
	 * The main use of this class (and <code>DataStructures_BinarySearchTree</code>)
	 * is for finding the key of the numerical element closest to a number.
	 */
	private $value;
	
	/**
	 * Sub-trees.
	 */
	private $left;
	private $right;
	
	public function
		__construct($name, $value)
	{
		$this->name = $name;
		$this->value = $value;
		
		$this->left = NULL;
		$this->right = NULL;
	}
	
	public function
		get_name()
	{
		return $this->name;
	}
	
	public function
		get_value()
	{
		return $this->value;
	}
	
	public function
		insert(DataStructures_BSTNode $new_node)
	{
		if ($new_node->get_value() < $this->get_value()) {
			if (isset($this->left)) {
				$this->left->insert($new_node);
			} else {
				$this->left = $new_node;
			}
		} else {
			if (isset($this->right)) {
				$this->right->insert($new_node);
			} else {
				$this->right = $new_node;
			}
		}
	}
	
	public function
		is_leaf()
	{
		return !isset($this->left) && !isset($this->right);
	}
	
	/**
	 * Lowest in the sense of the numerical value.
	 *
	 * Synonymous with "leftmost"
	 */
	public function
		get_lowest_node()
	{
		if (isset($this->left)) {
			return $this->left->get_lowest_node();
		} else {
			return $this;
		}
	}
	
	/**
	 * "rightmost"
	 *
	 * @see <code>DataStructures_BSTNode::get_lowest_node()</code>
	 */
	public function
		get_greatest_node()
	{
		if (isset($this->right)) {
			return $this->right->get_greatest_node();
		} else {
			return $this;
		}
	}
	
	/**
	 * Finds the node with the value closest to <code>$value</code>.
	 */
	public function
		get_closest_node($value)
	{
		$diffs['this'] = $this->get_value() - $value;
		
		if ($diffs['this'] < 0) {
			$diffs['this'] *= -1;
		}
		
		if (isset($this->left)) {
			$greatest_left_node = $this->left->get_greatest_node();
			
			$diffs['left'] = $greatest_left_node->get_value() - $value;
			
			if ($diffs['left'] < 0) {
				$diffs['left'] *= -1;
			}
		}
		
		if (isset($this->right)) {
			$lowest_right_node = $this->right->get_lowest_node();
			
			$diffs['right'] = $lowest_right_node->get_value() - $value;
			
			if ($diffs['right'] < 0) {
				$diffs['right'] *= -1;
			}
		}
		
		#print_r($diffs);
		
		asort($diffs);

		#print_r($diffs);
		
		$diff_keys = array_keys($diffs);
		
		$closest_diff_key = $diff_keys[0];
		
		switch ($closest_diff_key) {
			case 'this':
				return $this;
			case 'left':
				return $this->left->get_closest_node($value);
			case 'right':
				return $this->right->get_closest_node($value);
		} 
	}
}
?>