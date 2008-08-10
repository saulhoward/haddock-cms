<?php
/**
 * HaddockProjectOrganisation_SetProjectInformationCLIScript
 *
 * @copyright 2008-06-30, RFI
 */

class
	HaddockProjectOrganisation_SetProjectInformationCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		if ($this->has_arg('datum-name')) {
			$datum_name = $this->get_arg('datum-name');
		} else {
			echo 'Which datum do you want to set?' . PHP_EOL;
			
			$datum_name
				= CLIScripts_UserInterrogationHelper
					::get_choice_from_string_array(
						array(
							'Name',
							'Title',
							'Copyright Holder',
							'Version Code',
							'Camel Case Root'
						)
					);
			
			echo "Setting the '$datum_name'" . PHP_EOL;
		}
		
		if ($this->has_arg('new-value')) {
			$new_value = $this->get_arg('new-value');
		} else {
			echo 'Please enter the new value:' . PHP_EOL;
			$new_value = trim(fgets(STDIN));
			
			echo 'New value: ' . $new_value . PHP_EOL;
		}
		
		switch ($datum_name) {
			case 'Name':
				HaddockProjectOrganisation_ProjectInformationHelper
					::set_name($new_value);
				break;
			case 'Title':
				HaddockProjectOrganisation_ProjectInformationHelper
					::set_title($new_value);
				break;
			case 'Copyright Holder':
				HaddockProjectOrganisation_ProjectInformationHelper
					::set_copyright_holder($new_value);
				break;
			case 'Version Code':
				HaddockProjectOrganisation_ProjectInformationHelper
					::set_version_code($new_value);
				break;
			case 'Camel Case Root':
				HaddockProjectOrganisation_ProjectInformationHelper
					::set_camel_case_root($new_value);
				break;
		}
	}
}
?>