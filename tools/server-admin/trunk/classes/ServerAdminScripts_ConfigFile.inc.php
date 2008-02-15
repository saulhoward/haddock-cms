<?php
/**
 * ServerAdminScripts_ConfigFile
 *
 * @copyright Clear Line Web Design, 2007-04-27
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ConfigFile.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_DumpDirectory.inc.php';

class
    ServerAdminScripts_ConfigFile
extends
    HaddockProjectOrganisation_ConfigFile
{
    /**
     * Defaults to the current directory.
     */
    private function
        get_dump_directory_name()
    {
        if ($this->has_value_for('dump-directory')) {
            return realpath($this->get_value_for('dump-directory'));
        } else {
            return realpath('.');
        }
    }
    
    public function
        get_dump_directory()
    {
        return new ServerAdminScripts_DumpDirectory(
            $this->get_dump_directory_name()
        );
    }
    
    public function
        get_mysql_username()
    {
        if ($this->has_value_for('mysql-username')) {
            return $this->get_value_for('mysql-username');
        } else {
            return 'root';
        }
    }
    
    public function
        get_mysql_password()
    {
        if ($this->has_value_for('mysql-password')) {
            return $this->get_value_for('mysql-password');
        } else {
            return '';
        }
    }
    
    public function
        get_mysql_host()
    {
        if ($this->has_value_for('mysql-host')) {
            return $this->get_value_for('mysql-host');
        } else {
            return 'localhost';
        }
    }
    
    public function
        get_control_centre_url()
    {
        return $this->get_control_centre_server_protocol()
            . '://'
            . $this->get_control_centre_server_domain()
            . ':'
            . $this->get_control_centre_server_port();
    }
    
    public function
        get_control_centre_server_protocol()
    {
        if ($this->has_value_for('control-centre-server-protocol')) {
            return $this->get_value_for('control-centre-server-protocol');
        } else {
            return 'http';
        }
    }
    
    public function
        get_control_centre_server_domain()
    {
        if ($this->has_value_for('control-centre-server-domain')) {
            return $this->get_value_for('control-centre-server-protocol');
        } else {
            return 'localhost';
        }
    }

    public function
        get_control_centre_server_port()
    {
        if ($this->has_value_for('control-centre-server-port')) {
            return $this->get_value_for('control-centre-server-port');
        } else {
            if ($this->get_control_centre_server_protocol() == 'http') {
                return 80;
            } else if ($this->get_control_centre_server_protocol() == 'https') {
                return 443;
            } else {
                throw new Exception('Port not set but the protocol is neither HTTP nor HTTPS!');
            }
        }
    }
}
?>
