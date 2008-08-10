<?php
/**
 * Admin_UserEntry
 *
 * @copyright 2008-08-09, Robert Impey
 */

class
	Admin_UserEntry
extends
	Database_Entry
{
	private $name;
	private $email;
	private $real_name;
	private $type;

	public function 
		__construct(
			$id,
			$name,
			$email,
			$real_name,
			$type
		)
	{
		parent::__construct($id);
		
		$this->name = $name;
		$this->email = $email;
		$this->real_name = $real_name;
		$this->type = $type;
	}

	public function 
		get_name()
	{
		return $this->name;
	}

	public function 
		set_name($name)
	{
		$this->name = $name;
	}

	public function 
		get_email()
	{
		return $this->email;
	}

	public function 
		set_email($email)
	{
		$this->email = $email;
	}

	public function 
		get_real_name()
	{
		return $this->real_name;
	}

	public function 
		set_real_name($real_name)
	{
		$this->real_name = $real_name;
	}

	public function 
		get_type()
	{
		return $this->type;
	}

	public function 
		set_type($type)
	{
		$this->type = $type;
	}
}
?>