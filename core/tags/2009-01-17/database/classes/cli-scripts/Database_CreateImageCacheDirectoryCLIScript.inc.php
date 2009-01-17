<?php
/**
 * Database_CreateImageCacheDirectoryCLIScript
 *
 * @copyright 2008-05-28, RFI
 */

class
	Database_CreateImageCacheDirectoryCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$cache_dir_name = PROJECT_ROOT . '/hc-database-img-cache';
		
		Caching_CacheDirectoryCreator
			::create_cache_directory(
				$cache_dir_name,
				$restrict_access = FALSE,
				$silent = TRUE
			);
	}
}
?>