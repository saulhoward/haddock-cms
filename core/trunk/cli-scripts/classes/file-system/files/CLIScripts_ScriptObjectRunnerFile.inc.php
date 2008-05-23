<?php
/**
 * CLIScripts_ScriptObjectRunnerFile
 *
 * @copyright 2008-05-23, RFI
 */

/**
 * Represents an executable file that can be called at
 * the command line to execute code contained in a subclass
 * of <code>CLIScripts_CLIScript</code>.
 *
 * The files that this represents are automatically generated
 * and should not be edited.
 */
class
	CLIScripts_ScriptObjectRunnerFile
extends
	CLIScripts_ExecutablePHPFile
{
	private $cli_script_class_name;

	public function 
		get_cli_script_class_name()
	{
		return $this->cli_script_class_name;
	}

	public function 
		set_cli_script_class_name($cli_script_class_name)
	{
		$this->cli_script_class_name = $cli_script_class_name;
	}
	
	public function
		commit()
	{
		#echo __METHOD__ . "\n";
		#echo 'print_r($this): ' . "\n";
		#print_r($this) . "\n";
		
		if (
			$fh
				= fopen(
					$this->get_name(),
					'w'
				)
		) {
			/*
			 * Write the shebang.
			 */
			fwrite(
				$fh,
				$this->get_shebang()
			);
			
			$cli_script_class_name = $this->get_cli_script_class_name();
			$eol = $this->get_eol();
			
			fwrite($fh, "<?php$eol");
			
			/*
			 * Write a comment explaining the file.
			 */
			$hpo_cm
				= Configuration_ConfigManagerHelper
					::get_config_manager(
						'haddock',
						'haddock-project-organisation'
					);
			fwrite($fh, "/*$eol");
			fwrite($fh, " * Script object runner for $cli_script_class_name $eol");
			fwrite($fh, " *$eol");
			fwrite($fh, ' * @copyright ' . date('Y-m-d') . ', ' . $hpo_cm->get_copyright_holder() . $eol);
			fwrite($fh, " */$eol");
			fwrite($fh, $eol);
			
			/*
			 * Define the project root.
			 */
			fwrite($fh, "define('PROJECT_ROOT', '" . PROJECT_ROOT . "');$eol");
			
			/*
			 * Define the debug constants.
			 */
			fwrite($fh, "require_once PROJECT_ROOT . '/haddock/public-html/public-html/define-debug-constants.inc.php';$eol");
			
			/*
			 * Define the debug constants.
			 */
			fwrite($fh, "require PROJECT_ROOT . '/haddock/haddock-project-organisation/includes/autoload.inc.php';$eol");

			
			/*
			 * Parse the args.
			 */
			fwrite($fh, "\$args = CLIScripts_ArgsHelper::parse_argv(\$_SERVER['argv']);$eol");
			
			/*
			 * Run the class.
			 */
			fwrite($fh, "
try {
	\$script_class_reflection_class = new ReflectionClass('$cli_script_class_name');
	
	\$script_class_reflection_object
		= \$script_class_reflection_class
			->newInstanceArgs(
				array(
					\$args
				)
			);
	
	\$script_class_reflection_object->main();
} catch (Exception \$e) {
	CLIScripts_ExceptionsHelper
		::render_exception_trace(\$e);
}
"

);
			
			fwrite($fh, "?>$eol");
			
			fclose($fh);
			
			chmod(
				$this->get_name(),
				0755
			);
		}
	}
}
?>