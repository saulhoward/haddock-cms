<?php
/**
 * Configuration_InstanceSpecificConfigDirectory
 *
 * @copyright 2008-05-30, RFI
 */

class
	Configuration_InstanceSpecificConfigDirectory
extends
	Configuration_ConfigDirectory
{
	private function
		get_config_file_name(
			$module_name,
			$file_name = NULL
		)
	{
		if (isset($file_name)) {
			$file_name = 'config.xml';
		}
		
		return $this->get_name() . DIRECTORY_SEPARATOR . $file_name;
	}
	
	public function
		has_config_file(
			$module_name,
			$file_name = NULL
		)
	{
		return
			is_file(
				$this
					->get_config_file_name(
						$module_name,
						$file_name
					)
			);
	}
	
	public function
		get_config_file(
			$module_name,
			$file_name = NULL
		)
	{
		if (
			$this->has_config_file(
				$module_name,
				$file_name
			)
		) {
			return
				new Configuration_ConfigFile(
					$this
						->get_config_file_name(
							$module_name,
							$file_name
						)
				);
		} else {
			throw
				new Configuration_InstanceSpecificConfigFileNotFoundException(
					$module_name,
					$file_name
				);
		}
	}
	
	public function
		create_config_file(
			$module_name,
			$file_name = NULL
		)
	{
		$config_file_name = $this
			->get_config_file_name(
				$module_name,
				$file_name
			);
		
		if ($fh = fopen($config_file_name, 'w')) {
			$new_config_file_contents = <<<CNF
<?xml version="1.0" encoding="UTF-8"?>
<config>
</config>
CNF;

			fwrite($fh, $new_config_file_contents);
			
			fclose($fh);
		}
	}
	
	public function
		commit()
	{
		if (!$this->exists()) {
			mkdir($this->get_name());
		}
		
		/*
		 * Create a date string.
		 */
		$date = date('Y-m-d');

		/*
		 * Write the .htaccess file.
		 */
		$instance_specific_directory_htaccess_file_name
			= $this->get_name() . DIRECTORY_SEPARATOR .  '.htaccess';
		if (!is_file($instance_specific_directory_htaccess_file_name)) { 
			$htaccess = <<<HTA
# Restrict Access to the instance specific config folder.
# © $date

Order Deny,Allow
Deny from all

HTA;

			if ($fh = fopen($instance_specific_directory_htaccess_file_name, 'w')) {
				fwrite($fh, $htaccess);
				
				fclose($fh);
			}
		}
	}
}
?>