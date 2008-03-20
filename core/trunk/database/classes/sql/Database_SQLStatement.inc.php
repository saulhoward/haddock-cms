<?php
/**
 * Database_SQLStatement
 *
 * @copyright 2006-11-18, RFI
 */

/**
 * This class serves two purposes.
 *
 * The first is as a wrapper around a string
 * where the string is set in the constructor.
 * This is used for type checking in the methods
 * in the Database_Table class which accept SQL
 * statements.
 *
 * The second purpose is to allow us to build
 * SQL statements by adding items to them in
 * a programmatic way.
 *
 * These items can then be assembled to make
 * a string that can be sent to a database server.
 */
abstract class
	Database_SQLStatement
{
	/**
	 * This is the string that will be sent to
	 * the database server.
	 */
	protected $str;
	
	/**
	 * Flag to say whether the statement has
	 * been put together to make a string yet.
	 */
	protected $assembled;
	
	private $behaviours;
	
	/**
	 * An object can be created as a fully formed string.
	 *
	 * Or you can create an empty statement and then add
	 * items to be assembled later.
	 */
	public function
		__construct($str = '')
	{
		$this->str = $str;
		$this->assembled = (strlen($str) > 0);
		
		if (!$this->assembled) {
			$this->behaviours = array();
			
			$this->set_behaviours();
		}
	}
	
	/**
	 * Returns this SQL statement as a string.
	 *
	 * If this statement needs to be put together from
	 * various items, it is.
	 */
	public final function
		get_as_string()
	{
		if (!$this->assembled) {
			$this->assemble();
		}
		
		return $this->str;
	}
	
	/**
	 * This puts all the parts together to make a SQL
	 * statement as a string.
	 *
	 * It also sets the "assembled" flag to true.
	 */
	abstract protected function
		assemble();
	
	/**
	 * This class uses the delegation pattern if
	 * it is not passed a string of the complete
	 * statement via the constructor.
	 *
	 * See
	 *  http://en.wikipedia.org/wiki/Delegation_pattern
	 *
	 * See also the behaviours classes in this
	 * folder.
	 *
	 * This is all cut and pasted from the delegate
	 * row class.
	 * So much for design patterns removing the need
	 * for that sort of thing!
	 */
	abstract protected function
		set_behaviours();
	
	protected function
		add_behaviour(
			$behaviour_name,
			Database_RowBehaviour $behaviour
		)
	{
		if (array_key_exists($behaviour_name, $this->behaviours)) {
			throw new Exception(
				"Unable to set behaviour $behaviour_name more than once!"
			);
		} else {
			$this->behaviours[$behaviour_name] = $behaviour;
		}
	}
	
	private function
		get_behaviour($behaviour_name)
	{
		if (array_key_exists($behaviour_name, $this->behaviours)) {
			return $this->behaviours[$behaviour_name];
		} else {
			$reflection_class = new ReflectionClass($this);
			
			$error_message = $reflection_class->getName();
			
			$error_message
				.= " doesn't have a behaviour called $behaviour_name!";
			
			throw new Exception($error_message);
		}
	}
	
	protected function
		run_behaviour($behaviour_name)
	{
		$behaviour = $this->get_behaviour($behaviour_name);
		
		$returned = $behaviour->run();
		
		if (isset($returned)) {
			return $returned;
		}
	}
}
?>