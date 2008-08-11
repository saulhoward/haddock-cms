<?php
/**
 * Database_SelectionManager
 *
 * @copyright Clear Line Web Design, 2007-03-16
 */

class
    Database_SelectionManager
{
    private $table;
    
    private $order_by;
    private $direction;
    private $offset;
    private $limit;

    public function 
	__construct(
	    Database_Table $table
	)
    {
	$this->table = $table;
	
	$this->order_by
	    = isset($_GET['order_by'])
		? $_GET['order_by'] : self::get_default_order_by();
		
	$this->direction
	    = isset($_GET['direction'])
		? $_GET['direction'] : self::get_default_direction();
		
	$this->offset
	    = isset($_GET['offset'])
		? $_GET['offset'] : self::get_default_offset();
		
	$this->limit
	    = isset($_GET['limit'])
		? $_GET['limit'] : self::get_default_limit();		
    }

    public function 
	get_order_by()
    {
	return $this->order_by;
    }

    protected static function
        get_default_order_by()
    {
        return 'id';
    }

    public function 
	get_direction()
    {
	return $this->direction;
    }

    protected static function
        get_default_direction()
    {
        return 'ASC';
    }

    public function 
	get_offset()
    {
	return $this->offset;
    }

    protected static function
        get_default_offset()
    {
        return 0;
    }

    public function 
	get_limit()
    {
	return $this->limit;
    }
    
    protected static function
        get_default_limit()
    {
        return 10;
    }
}
?>
