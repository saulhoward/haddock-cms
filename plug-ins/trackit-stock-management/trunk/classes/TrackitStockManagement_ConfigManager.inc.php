<?php
/**
 * TrackitStockManagement_ConfigManager
 *
 * @copyright 2007-11-21, RFI
 */

class
	TrackitStockManagement_ConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/plug-ins/trackit-stock-management/';
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the remote server.
	 * ----------------------------------------
	 */
	
	public function
		get_ftp_server_address()
	{
		return $this->get_config_value('ftp_server/address');
	}

	public function
		get_ftp_server_user()
	{
		return $this->get_config_value('ftp_server/user');
	}

	public function
		get_ftp_server_password()
	{
		return $this->get_config_value('ftp_server/password');
	}

	public function
		get_ftp_server_webin()
	{
		return $this->get_config_value('ftp_server/webin');
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with caching files locally.
	 * ----------------------------------------
	 */
	
	public function
		get_cache_dir_name()
	{
		return $this->get_config_value('cache/dir_name');
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with lock files.
	 * ----------------------------------------
	 */
	
	public function
		get_lock_files_dir_name()
	{
		return $this->get_config_value('lock_files/dir_name');
	}
	
	public function
		get_lock_files_directory()
	{
		return new CLIScripts_LockFilesDirectory(
			$this->get_lock_files_dir_name()
		);
	}
	
	/**
	 * Read feed file names.
	 */
	public function
		get_rffn_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/rffn_lock_file_name');
	}

	/**
	 * Download non text files.
	 */
	public function
		get_dlntf_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/dlntf_lock_file_name');
	}

	/**
	 * Download text files.
	 */
	public function
		get_dltf_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/dltf_lock_file_name');
	}

	/**
	 * Process product text files.
	 */
	public function
		get_pptf_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/pptf_lock_file_name');
	}

	/**
	 * Process stock text files.
	 */
	public function
		get_pstf_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/pstf_lock_file_name');
	}

	/**
	 * Process deletion files.
	 */
	public function
		get_pdf_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/pdf_lock_file_name');
	}
	
	/**
	 * Process image text files.
	 */
	public function
		get_pitf_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/pitf_lock_file_name');
	}
	
	/**
	 * Add photographs from cache.
	 */
	public function
		get_apfc_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/apfc_lock_file_name');
	}
	
	/**
	 * process photographs
	 */
	public function
		get_process_photographs_lock_file_name()
	{
		return
			$this->get_lock_files_dir_name()
			. '/'
			. $this->get_config_value('lock_files/process_photographs_lock_file_name');
	}
	
	/*
 	 * ----------------------------------------
 	 * Functions to do with resizing photos.
	 * ----------------------------------------
	 */
	
	public function
		get_resized_photos_temporary_dir_name()
	{
		return $this->get_cache_dir_name() . '/resized-photos';
	}

	public function
		get_photograph_sizes()
	{
		$sizes = array();

		foreach (explode(' ', 'full_size medium_size thumbnail') as $name) {
			$size = array();

			$size['name'] = $name;
			$size['x'] = $this->get_config_value("photographs/$name/x");
			$size['y'] = $this->get_config_value("photographs/$name/y");

			$sizes[] = $size;
		}

		return $sizes;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with dead lock file removal email
	 * ----------------------------------------
	 */
	
	public function
		get_dlfre_to()
	{
		return $this->get_config_value('emails/dead_lock_file_removal/to');
	}
	
	public function
		get_dlfre_subject_template()
	{
		return $this->get_config_value('emails/dead_lock_file_removal/subject_template');
	}
	
	public function
		get_dlfre_body_template()
	{
		return $this->get_config_value('emails/dead_lock_file_removal/body_template');
	}
}
?>