<?php
/**
 * Database_SQLLimitClause
 *
 * @copyright 2007-02-20, Robert Impey
 */

class
	Database_SQLLimitClause
extends
	Database_SQLClause
{
	private $offset;
	private $row_count;

	public function 
		__construct(
			$offset,
			$row_count
		)
	{
		$this->offset = $offset;
		$this->row_count = $row_count;
	}

	public function 
		get_offset()
	{
		return $this->offset;
	}

	public function 
		set_offset($offset)
	{
		$this->offset = $offset;
	}

	public function 
		get_row_count()
	{
		return $this->row_count;
	}

	public function 
		set_row_count($row_count)
	{
		$this->row_count = $row_count;
	}
	
	public function
		get_as_string()
	{
		return
			' LIMIT ' . $this->get_row_count()
			. ' OFFSET ' . $this->get_offset()
			. ' ';
	}
}
?>