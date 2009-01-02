<?php
/**
 * CLIScripts_CLIScript
 *
 * @copyright 2008-05-20, RFI
 */

abstract class
	CLIScripts_CLIScript
{
	private $args;
	
	/**
	 * Constructs a new CLIScripts_CLIScript object.
	 *
	 * @param array $args An array as returned from CLIScripts_ArgsHelper::parse_argv(...)
	 */
	public function
		__construct($args)
	{
		$this->args = $args;
	}
	
	protected function
		has_arg($name)
	{
		return isset($this->args[$name]);
	}
	
	protected function
		get_arg($name)
	{
		if ($this->has_arg($name)) {
			return $this->args[$name];
		} else {
			throw new Exception("No arg call '$name' set!");
		}
	}
	
	public final function
		main()
	{
		if ($this->has_arg('help')) {
			$this->help();
		} else {
			$this->begin();
			$this->do_actions();
			$this->end();
		}
	}
	
	abstract public function
		do_actions();
	
	/**
	 * Called before the <code>do_actions()</code> method.
	 *
	 * No point in overriding this if the implementing class is a direct sub
	 * class of this.
	 *
	 * However, this could be useful for an abstract subclass that keeps
	 * <code>do_actions</code> abstract.
	 *
	 * e.g. a locked script.
	 *
	 * See also <code>end()</code>.
	 */
	public function
		begin()
	{
	}
	
	public function
		end()
	{
	}
	
	public function
		help()
	{
		fprintf(
			STDERR,
			$this->get_help_message()
		);
	}
	
	protected function
		get_help_message()
	{
		return 'Help for ' . get_class($this) . PHP_EOL;
	}
}
?>
