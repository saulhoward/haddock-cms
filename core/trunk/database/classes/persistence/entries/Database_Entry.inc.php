<?php
/**
 * Database_Entry
 *
 * @copyright 2008-08-09, Robert Impey
 */

/**
 * A class to represent an entry that can be saved in
 * a RDBMS.
 *
 * The assumption is that the entry can be saved in a single
 * table with a primary key call 'id'.
 *
 * Entries that are saved in several tables, which use foreign keys,
 * should not extend this class and should implement the <code>save</code>
 * and <code>delete</code> functions individually.
 */
abstract class
	Database_Entry
extends
	Persistence_Entry
{
	private $id;
	
	/**
	 * Creates a new entry object.
	 *
	 * The id does not have to be set, it can be
	 * <code>NULL</code>.
	 *
	 * In that case, if the entry is saved, an <code>INSERT</code> statement
	 * is created rather than an <code>UPDATE</code> one.
	 */
	public function
		__construct(
			$id
		)
	{
		$this->id = $id;
	}
	
	public function
		get_id()
	{
		return $this->id;
	}
	
	/*
	 * Should there be a <code>set_id</code> method?
	 *
	 * What would be the use of such a method?
	 *
	 * Does that confuse the idea of what an enty is?
	 */
	
	/**
	 * Saves this entry in the RDBMS.
	 *
	 * If the the id has been set, then an <code>INSERT</code> statement
	 * is created.
	 *
	 * Otherwise, an <code>UPDATE</code> statement is created.
	 */
	public function
		save()
	{
		
	}
	
	/**
	 * Deletes this entry from the RDBMS.
	 *
	 * If the id has not been set, then no SQL is executed.
	 */
	public function
		delete()
	{
		
	}
}
?>