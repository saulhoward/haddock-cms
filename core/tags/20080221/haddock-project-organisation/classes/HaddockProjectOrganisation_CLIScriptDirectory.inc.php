<?php
/**
 * HaddockProjectOrganisation_CLIScriptDirectory
 *
 * @copyright Clear Line Web Design, 2007-07-12
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';

class
    HaddockProjectOrganisation_CLIScriptDirectory
extends
    FileSystem_Directory
{
    public function
        get_script_name()
    {
        return $this->basename();
    }
}
?>
