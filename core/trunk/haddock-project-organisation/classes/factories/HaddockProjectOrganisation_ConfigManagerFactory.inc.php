<?php
/**
 * HaddockProjectOrganisation_ConfigManagerFactory
 *
 * @copyright 2007-10-08, RFI
 */

/**
 * Uses the singleton class.
 *
 * Used to find config managers for modules.
 *
 * A module should extend the default config manager and set
 * custom config manager.
 *
 * e.g.
 * 
 * <config>
 * 	<haddock-project-organisation>
 * 		<config-manager>ModName_ConfigManager</config-manager>
 * 	</haddock-project-organisation>
 * </config>
 *
 * in
 * 
 * 	<MODULE_DIR>/config/config.xml.
 *
 * If ModName_ConfigManager is not a subclass of
 *
 * 	HaddockProjectOrganisation_ConfigManager
 *
 * an exception is thrown.
 */
class 
	HaddockProjectOrganisation_ConfigManagerFactory
{
	private static $instance;
	
	private $config_managers;
	
	private function
		__construct()
	{
	}
	
	public static function
		get_instance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new HaddockProjectOrganisation_ConfigManagerFactory();
		}
		
		return self::$instance;
	}

	public function
		get_config_manager(
			$section,
			$module = NULL
		)
	{
		$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
		
		$pd = $pdf->get_project_directory_for_this_project();
			
		$md = $pd->get_module_directory($section, $module);
	
		$iscf = NULL;
		$pscf = NULL;
		$mcf = NULL;

		if ($md->has_instance_specific_config_file()) {
			$iscf = $md->get_instance_specific_config_file();
		}
		
		if ($md->has_project_specific_config_file()) {
			$pscf = $md->get_project_specific_config_file();
		}

		/*
		 * Create the config manager reflection class.
		 * 
		 * If the module defines its own config manager and this is
		 * set in the module's config file, then an instance of that
		 * class should be returned.
		 * 
		 * Otherwise, an exception is thrown.
		 */
		$cmcn = '';

		if ($md->has_config_file()) {
			$mcf = $md->get_config_file();

			if ($mcf->has_nested_value_str('haddock-project-organisation config-manager')) {
				$cmcn = $mcf->get_nested_value_str('haddock-project-organisation config-manager');
			}
		}
		
		if (strlen($cmcn) > 0) {
			$cmrc = new ReflectionClass($cmcn);

			return $cmrc->newInstance(
				$section,
				$module,
				$iscf,
				$pscf,
				$mcf
			);
		} else {
			throw new ErrorHandling_SprintfException(
				'No config manager class set in the \'%s\' module in the \'%s\'!',
				array($module, $section)
			);
		}
	}
	
#	public function
#		get_core_module_config_manager($identifying_name)
#	{
#		if (!isset($this->config_managers['haddock'][$identifying_name])) {
#			$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder
#				::get_instance();
#			
#			$pd = $pdf->get_project_directory_for_this_project();
#			
#			$modules_directory = $pd->get_core_modules_directory();
#			
#			$module_directory
#				= $modules_directory
#					->get_module_directory($identifying_name);
#					
#			$this->config_managers['haddock'][$identifying_name] =
#				new HaddockProjectOrganisation_ConfigManager(
#					'haddock',
#					$identifying_name,
#					$module_directory->get_instance_specific_config_file(),
#					$module_directory->get_project_specific_config_file(),
#					$module_directory->get_module_config_file()
#				);
#		}
#		
#		return $this->config_managers['haddock'][$identifying_name];
#	}
}
?>
