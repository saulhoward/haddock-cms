<?php
/**
 * __autoload .INC file
 *
 * Last Modified: 2009-10-07
 */

function __autoload($class_name)
{
	switch ($class_name) {
	
		case('Admin_AddUserCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_AddUserCLIScript.inc.php';
			break;

		case('Admin_AdminIncluderURLFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_AdminIncluderURLFactory.inc.php';
			break;

		case('Admin_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_ConfigManager.inc.php';
			break;

		case('Admin_DeleteAllUsersCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_DeleteAllUsersCLIScript.inc.php';
			break;

		case('Admin_DeleteUserCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_DeleteUserCLIScript.inc.php';
			break;

		case('Admin_EditUserCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_EditUserCLIScript.inc.php';
			break;

		case('Admin_HTMLPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Admin_HTMLPage.inc.php';
			break;

		case('Admin_IncFileFinder'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_IncFileFinder.inc.php';
			break;

		case('Admin_IncludesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_IncludesDirectory.inc.php';
			break;

		case('Admin_ListUsersCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_ListUsersCLIScript.inc.php';
			break;

		case('Admin_LogInHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Admin_LogInHelper.inc.php';
			break;

		case('Admin_LoginManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_LoginManager.inc.php';
			break;

		case('Admin_ModuleLinksUL'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Admin_ModuleLinksUL.inc.php';
			break;

		case('Admin_ModuleTitleFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_ModuleTitleFile.inc.php';
			break;

		case('Admin_NavigationLinksFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_NavigationLinksFile.inc.php';
			break;

		case('Admin_NavigationXMLFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_NavigationXMLFile.inc.php';
			break;

		case('Admin_NXFPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_NXFPage.inc.php';
			break;

		case('Admin_PageDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_PageDirectory.inc.php';
			break;

		case('Admin_PagesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_PagesDirectory.inc.php';
			break;

		case('Admin_ResetAllUsersPasswordsCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_ResetAllUsersPasswordsCLIScript.inc.php';
			break;

		case('Admin_ResetUserPasswordCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_ResetUserPasswordCLIScript.inc.php';
			break;

		case('Admin_RestrictedHTMLPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Admin_RestrictedHTMLPage.inc.php';
			break;

		case('Admin_RestrictedRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Admin_RestrictedRedirectScript.inc.php';
			break;

		case('Admin_ShowUserCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Admin_ShowUserCLIScript.inc.php';
			break;

		case('Admin_SiteMapUL'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Admin_SiteMapUL.inc.php';
			break;

		case('Admin_StartPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Admin_StartPage.inc.php';
			break;

		case('Admin_StartPageWidget'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Admin_StartPageWidget.inc.php';
			break;

		case('Admin_UserEntry'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'persistence' . DIRECTORY_SEPARATOR . 'entries' . DIRECTORY_SEPARATOR . 'Admin_UserEntry.inc.php';
			break;

		case('Admin_UserRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'row-subclasses' . DIRECTORY_SEPARATOR . 'Admin_UserRow.inc.php';
			break;

		case('Admin_UserRowRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'row-renderers' . DIRECTORY_SEPARATOR . 'Admin_UserRowRenderer.inc.php';
			break;

		case('Admin_UsersHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Admin_UsersHelper.inc.php';
			break;

		case('Admin_UsersTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'table-subclasses' . DIRECTORY_SEPARATOR . 'Admin_UsersTable.inc.php';
			break;

		case('Admin_UsersTableRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'table-renderers' . DIRECTORY_SEPARATOR . 'Admin_UsersTableRenderer.inc.php';
			break;

		case('Caching_CacheDirectoryCreator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'caching' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Caching_CacheDirectoryCreator.inc.php';
			break;

		case('Caching_CacheManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'caching' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Caching_CacheManager.inc.php';
			break;

		case('Caching_GlobalVarManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'caching' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Caching_GlobalVarManager.inc.php';
			break;

		case('Caching_SessionVarManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'caching' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Caching_SessionVarManager.inc.php';
			break;

		case('CLIScripts_ArgsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_ArgsHelper.inc.php';
			break;

		case('CLIScripts_BatWrapperScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CLIScripts_BatWrapperScript.inc.php';
			break;

		case('CLIScripts_BinIncludesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CLIScripts_BinIncludesDirectory.inc.php';
			break;

		case('CLIScripts_CLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'CLIScripts_CLIScript.inc.php';
			break;

		case('CLIScripts_CLIScriptFilesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_CLIScriptFilesHelper.inc.php';
			break;

		case('CLIScripts_CLIScriptPHPClassFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'CLIScripts_CLIScriptPHPClassFile.inc.php';
			break;

		case('CLIScripts_CLIScriptsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_CLIScriptsHelper.inc.php';
			break;

		case('CLIScripts_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'CLIScripts_ConfigManager.inc.php';
			break;

		case('CLIScripts_CreateCLIScriptCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'CLIScripts_CreateCLIScriptCLIScript.inc.php';
			break;

		case('CLIScripts_DataRenderingHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_DataRenderingHelper.inc.php';
			break;

		case('CLIScripts_ExceptionsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_ExceptionsHelper.inc.php';
			break;

		case('CLIScripts_ExecutablePHPFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'CLIScripts_ExecutablePHPFile.inc.php';
			break;

		case('CLIScripts_GenerateScriptObjectRunnersCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'CLIScripts_GenerateScriptObjectRunnersCLIScript.inc.php';
			break;

		case('CLIScripts_InputReader'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CLIScripts_InputReader.inc.php';
			break;

		case('CLIScripts_InterpreterProgramHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_InterpreterProgramHelper.inc.php';
			break;

		case('CLIScripts_LockFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'CLIScripts_LockFile.inc.php';
			break;

		case('CLIScripts_LockFilesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'CLIScripts_LockFilesDirectory.inc.php';
			break;

		case('CLIScripts_LockFilesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_LockFilesHelper.inc.php';
			break;

		case('CLIScripts_NewScriptNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'CLIScripts_NewScriptNameValidator.inc.php';
			break;

		case('CLIScripts_ScriptDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CLIScripts_ScriptDirectory.inc.php';
			break;

		case('CLIScripts_ScriptLockedException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'CLIScripts_ScriptLockedException.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnerFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'CLIScripts_ScriptObjectRunnerFile.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnersDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'CLIScripts_ScriptObjectRunnersDirectory.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnersDirectoryTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'CLIScripts_ScriptObjectRunnersDirectoryTests.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnersHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_ScriptObjectRunnersHelper.inc.php';
			break;

		case('CLIScripts_ScriptsDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CLIScripts_ScriptsDirectory.inc.php';
			break;

		case('CLIScripts_ShowServerCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'CLIScripts_ShowServerCLIScript.inc.php';
			break;

		case('CLIScripts_SHWrapperScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CLIScripts_SHWrapperScript.inc.php';
			break;

		case('CLIScripts_UserInterrogationHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CLIScripts_UserInterrogationHelper.inc.php';
			break;

		case('CLIScripts_WrapperScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CLIScripts_WrapperScript.inc.php';
			break;

		case('CodeAnalysis_DebugModeHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'code-analysis' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CodeAnalysis_DebugModeHelper.inc.php';
			break;

		case('CodeAnalysis_ExecutionTimer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'code-analysis' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CodeAnalysis_ExecutionTimer.inc.php';
			break;

		case('CodeAnalysis_ListClassesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'code-analysis' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'CodeAnalysis_ListClassesCLIScript.inc.php';
			break;

		case('CodeAnalysis_MemoryHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'code-analysis' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'CodeAnalysis_MemoryHelper.inc.php';
			break;

		case('CodeAnalysis_TurnOffDebugModeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'code-analysis' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'CodeAnalysis_TurnOffDebugModeCLIScript.inc.php';
			break;

		case('CodeAnalysis_TurnOnDebugModeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'code-analysis' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'CodeAnalysis_TurnOnDebugModeCLIScript.inc.php';
			break;

		case('Configuration_ConfigDirectoriesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Configuration_ConfigDirectoriesHelper.inc.php';
			break;

		case('Configuration_ConfigDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'Configuration_ConfigDirectory.inc.php';
			break;

		case('Configuration_ConfigFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'Configuration_ConfigFile.inc.php';
			break;

		case('Configuration_ConfigFileNotFoundException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Configuration_ConfigFileNotFoundException.inc.php';
			break;

		case('Configuration_ConfigFilesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Configuration_ConfigFilesHelper.inc.php';
			break;

		case('Configuration_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Configuration_ConfigManager.inc.php';
			break;

		case('Configuration_ConfigManagerHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Configuration_ConfigManagerHelper.inc.php';
			break;

		case('Configuration_InstanceSpecificConfigDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'Configuration_InstanceSpecificConfigDirectory.inc.php';
			break;

		case('Configuration_InstanceSpecificConfigDirectoryTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Configuration_InstanceSpecificConfigDirectoryTests.inc.php';
			break;

		case('Configuration_InstanceSpecificConfigFileNotFoundException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Configuration_InstanceSpecificConfigFileNotFoundException.inc.php';
			break;

		case('Configuration_ListAllConfigFilesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Configuration_ListAllConfigFilesCLIScript.inc.php';
			break;

		case('Database_AddConditionsToWhereClauseBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'Database_AddConditionsToWhereClauseBehaviour.inc.php';
			break;

		case('Database_AddKeyValuePairsToSetClauseBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'Database_AddKeyValuePairsToSetClauseBehaviour.inc.php';
			break;

		case('Database_AddRowOLForm'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Database_AddRowOLForm.inc.php';
			break;

		case('Database_AdminXMLPageManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_AdminXMLPageManager.inc.php';
			break;

		case('Database_ApplyUnappliedDeltaFilesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_ApplyUnappliedDeltaFilesCLIScript.inc.php';
			break;

		case('Database_BlobField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_BlobField.inc.php';
			break;

		case('Database_BlobFieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'field-renderers' . DIRECTORY_SEPARATOR . 'Database_BlobFieldRenderer.inc.php';
			break;

		case('Database_Cell'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'Database_Cell.inc.php';
			break;

		case('Database_ChoiceField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_ChoiceField.inc.php';
			break;

		case('Database_ChoiceFieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'field-renderers' . DIRECTORY_SEPARATOR . 'Database_ChoiceFieldRenderer.inc.php';
			break;

		case('Database_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Database_ConfigManager.inc.php';
			break;

		case('Database_ConnectionsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_ConnectionsHelper.inc.php';
			break;

		case('Database_CreateDeltaFileCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_CreateDeltaFileCLIScript.inc.php';
			break;

		case('Database_CreateImageCacheDirectoryCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_CreateImageCacheDirectoryCLIScript.inc.php';
			break;

		case('Database_CreateMySQLUserAndDatabaseCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_CreateMySQLUserAndDatabaseCLIScript.inc.php';
			break;

		case('Database_CreatePasswordsFileCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_CreatePasswordsFileCLIScript.inc.php';
			break;

		case('Database_CRUDAdminManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_CRUDAdminManager.inc.php';
			break;

		case('Database_CRUDAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Database_CRUDAdminPage.inc.php';
			break;

		case('Database_CRUDAdminRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Database_CRUDAdminRedirectScript.inc.php';
			break;

		case('Database_CRUDException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Database_CRUDException.inc.php';
			break;

		case('Database_Database'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'Database_Database.inc.php';
			break;

		case('Database_DatabaseClassFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_DatabaseClassFactory.inc.php';
			break;

		case('Database_DatabaseClassFactoryTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_DatabaseClassFactoryTests.inc.php';
			break;

		case('Database_DatabaseClassFinder'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_DatabaseClassFinder.inc.php';
			break;

		case('Database_DatabaseClassNameFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_DatabaseClassNameFile.inc.php';
			break;

		case('Database_DatabaseClassNameFileTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_DatabaseClassNameFileTests.inc.php';
			break;

		case('Database_DatabaseClassNameOverride'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_DatabaseClassNameOverride.inc.php';
			break;

		case('Database_DatabaseClassNameOverrideFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_DatabaseClassNameOverrideFile.inc.php';
			break;

		case('Database_DatabaseDescribingTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_DatabaseDescribingTests.inc.php';
			break;

		case('Database_DatabaseHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_DatabaseHelper.inc.php';
			break;

		case('Database_DatabaseNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'Database_DatabaseNameValidator.inc.php';
			break;

		case('Database_DatabaseRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'Database_DatabaseRenderer.inc.php';
			break;

		case('Database_DateTimeField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_DateTimeField.inc.php';
			break;

		case('Database_DBHandleTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_DBHandleTests.inc.php';
			break;

		case('Database_DBSubClassesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_DBSubClassesDirectory.inc.php';
			break;

		case('Database_DelegateRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'row-subclasses' . DIRECTORY_SEPARATOR . 'Database_DelegateRow.inc.php';
			break;

		case('Database_DeletableRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'row-interfaces' . DIRECTORY_SEPARATOR . 'Database_DeletableRow.inc.php';
			break;

		case('Database_DeletableRowDeleteBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'row-behaviours' . DIRECTORY_SEPARATOR . 'Database_DeletableRowDeleteBehaviour.inc.php';
			break;

		case('Database_DeltaFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'Database_DeltaFile.inc.php';
			break;

		case('Database_DeltaFilesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_DeltaFilesHelper.inc.php';
			break;

		case('Database_DeltasDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'Database_DeltasDirectory.inc.php';
			break;

		case('Database_DeltasTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_DeltasTests.inc.php';
			break;

		case('Database_EditRowOLForm'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Database_EditRowOLForm.inc.php';
			break;

		case('Database_Element'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_Element.inc.php';
			break;

		case('Database_ElementTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_ElementTests.inc.php';
			break;

		case('Database_EmailAddressVarCharField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_EmailAddressVarCharField.inc.php';
			break;

		case('Database_EntityNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'Database_EntityNameValidator.inc.php';
			break;

		case('Database_Entry'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'persistence' . DIRECTORY_SEPARATOR . 'entries' . DIRECTORY_SEPARATOR . 'Database_Entry.inc.php';
			break;

		case('Database_EnumField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_EnumField.inc.php';
			break;

		case('Database_FetchingHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_FetchingHelper.inc.php';
			break;

		case('Database_Field'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'Database_Field.inc.php';
			break;

		case('Database_FieldNotInTableException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Database_FieldNotInTableException.inc.php';
			break;

		case('Database_FieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'Database_FieldRenderer.inc.php';
			break;

		case('Database_FilesTableRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'table-renderers' . DIRECTORY_SEPARATOR . 'Database_FilesTableRenderer.inc.php';
			break;

		case('Database_ForeignKeyRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'row-subclasses' . DIRECTORY_SEPARATOR . 'Database_ForeignKeyRow.inc.php';
			break;

		case('Database_ForeignKeyTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'table-subclasses' . DIRECTORY_SEPARATOR . 'Database_ForeignKeyTable.inc.php';
			break;

		case('Database_GetSetClauseBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'Database_GetSetClauseBehaviour.inc.php';
			break;

		case('Database_GetWhereClauseBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'Database_GetWhereClauseBehaviour.inc.php';
			break;

		case('Database_HostNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'Database_HostNameValidator.inc.php';
			break;

		case('Database_HostNameValidatorTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_HostNameValidatorTests.inc.php';
			break;

		case('Database_HTMLPreFieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'field-renderers' . DIRECTORY_SEPARATOR . 'Database_HTMLPreFieldRenderer.inc.php';
			break;

		case('Database_ImageCacheHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_ImageCacheHelper.inc.php';
			break;

		case('Database_ImageFieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'field-renderers' . DIRECTORY_SEPARATOR . 'Database_ImageFieldRenderer.inc.php';
			break;

		case('Database_ImageRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'row-subclasses' . DIRECTORY_SEPARATOR . 'Database_ImageRow.inc.php';
			break;

		case('Database_ImageRowRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'row-renderers' . DIRECTORY_SEPARATOR . 'Database_ImageRowRenderer.inc.php';
			break;

		case('Database_ImagesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_ImagesHelper.inc.php';
			break;

		case('Database_ImagesTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'table-subclasses' . DIRECTORY_SEPARATOR . 'Database_ImagesTable.inc.php';
			break;

		case('Database_ImagesTableRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'table-renderers' . DIRECTORY_SEPARATOR . 'Database_ImagesTableRenderer.inc.php';
			break;

		case('Database_InputSanitationHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_InputSanitationHelper.inc.php';
			break;

		case('Database_IntField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_IntField.inc.php';
			break;

		case('Database_InvalidUserInputException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Database_InvalidUserInputException.inc.php';
			break;

		case('Database_LimitForm'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Database_LimitForm.inc.php';
			break;

		case('Database_ListDeltaFileApplicationsCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_ListDeltaFileApplicationsCLIScript.inc.php';
			break;

		case('Database_ListDeltaFilesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_ListDeltaFilesCLIScript.inc.php';
			break;

		case('Database_ListUnappliedDeltaFilesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_ListUnappliedDeltaFilesCLIScript.inc.php';
			break;

		case('Database_LongTextFieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'field-renderers' . DIRECTORY_SEPARATOR . 'Database_LongTextFieldRenderer.inc.php';
			break;

		case('Database_ManageSimpleCRUDAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'crud-pages' . DIRECTORY_SEPARATOR . 'simple-crud' . DIRECTORY_SEPARATOR . 'Database_ManageSimpleCRUDAdminPage.inc.php';
			break;

		case('Database_ManageSimpleCRUDAdminRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'crud-pages' . DIRECTORY_SEPARATOR . 'simple-crud' . DIRECTORY_SEPARATOR . 'Database_ManageSimpleCRUDAdminRedirectScript.inc.php';
			break;

		case('Database_ModifyingStatementHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_ModifyingStatementHelper.inc.php';
			break;

		case('Database_MySQLException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Database_MySQLException.inc.php';
			break;

		case('Database_MySQLRootUser'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_MySQLRootUser.inc.php';
			break;

		case('Database_MySQLUser'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_MySQLUser.inc.php';
			break;

		case('Database_MySQLUserFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_MySQLUserFactory.inc.php';
			break;

		case('Database_NumericField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_NumericField.inc.php';
			break;

		case('Database_PageRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'row-subclasses' . DIRECTORY_SEPARATOR . 'Database_PageRow.inc.php';
			break;

		case('Database_PageRowRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'row-renderers' . DIRECTORY_SEPARATOR . 'Database_PageRowRenderer.inc.php';
			break;

		case('Database_PagesTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'table-subclasses' . DIRECTORY_SEPARATOR . 'Database_PagesTable.inc.php';
			break;

		case('Database_PagesTableRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'table-renderers' . DIRECTORY_SEPARATOR . 'Database_PagesTableRenderer.inc.php';
			break;

		case('Database_PasswordFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_PasswordFile.inc.php';
			break;

		case('Database_PasswordsDirectoryTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_PasswordsDirectoryTests.inc.php';
			break;

		case('Database_PasswordsFileHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_PasswordsFileHelper.inc.php';
			break;

		case('Database_PasswordsFileTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_PasswordsFileTests.inc.php';
			break;

		case('Database_PasswordValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'Database_PasswordValidator.inc.php';
			break;

		case('Database_PreviousNextUL'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Database_PreviousNextUL.inc.php';
			break;

		case('Database_Renderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_Renderer.inc.php';
			break;

		case('Database_ResetDatabaseCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_ResetDatabaseCLIScript.inc.php';
			break;

		case('Database_Row'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'Database_Row.inc.php';
			break;

		case('Database_RowBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'Database_RowBehaviour.inc.php';
			break;

		case('Database_RowNotFoundException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Database_RowNotFoundException.inc.php';
			break;

		case('Database_RowOLForm'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Database_RowOLForm.inc.php';
			break;

		case('Database_RowRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'Database_RowRenderer.inc.php';
			break;

		case('Database_SelectionHTMLDiv'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Database_SelectionHTMLDiv.inc.php';
			break;

		case('Database_SelectionManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'selection-managers' . DIRECTORY_SEPARATOR . 'Database_SelectionManager.inc.php';
			break;

		case('Database_SelectionManagerFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'selection-managers' . DIRECTORY_SEPARATOR . 'Database_SelectionManagerFactory.inc.php';
			break;

		case('Database_SelectionManagersFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'selection-managers' . DIRECTORY_SEPARATOR . 'Database_SelectionManagersFile.inc.php';
			break;

		case('Database_ShortTextFieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'field-renderers' . DIRECTORY_SEPARATOR . 'Database_ShortTextFieldRenderer.inc.php';
			break;

		case('Database_SimpleCRUDManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'crud-pages' . DIRECTORY_SEPARATOR . 'simple-crud' . DIRECTORY_SEPARATOR . 'Database_SimpleCRUDManager.inc.php';
			break;

		case('Database_SortableHeadingTR'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'Database_SortableHeadingTR.inc.php';
			break;

		case('Database_SortableRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'row-interfaces' . DIRECTORY_SEPARATOR . 'Database_SortableRow.inc.php';
			break;

		case('Database_SortableRowBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'row-behaviours' . DIRECTORY_SEPARATOR . 'Database_SortableRowBehaviour.inc.php';
			break;

		case('Database_SortableRowMaxSortOrderBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'row-behaviours' . DIRECTORY_SEPARATOR . 'Database_SortableRowMaxSortOrderBehaviour.inc.php';
			break;

		case('Database_SortableRowMinSortOrderBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'row-behaviours' . DIRECTORY_SEPARATOR . 'Database_SortableRowMinSortOrderBehaviour.inc.php';
			break;

		case('Database_SortableRowMoveDownBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'row-behaviours' . DIRECTORY_SEPARATOR . 'Database_SortableRowMoveDownBehaviour.inc.php';
			break;

		case('Database_SortableRowMoveUpBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'delegation' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'row-behaviours' . DIRECTORY_SEPARATOR . 'Database_SortableRowMoveUpBehaviour.inc.php';
			break;

		case('Database_SpecifiedTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_SpecifiedTable.inc.php';
			break;

		case('Database_SpecifiedTableFieldTypeTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_SpecifiedTableFieldTypeTests.inc.php';
			break;

		case('Database_SQLClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLClause.inc.php';
			break;

		case('Database_SQLDeleteStatement'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'Database_SQLDeleteStatement.inc.php';
			break;

		case('Database_SQLDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_SQLDirectory.inc.php';
			break;

		case('Database_SQLFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'Database_SQLFile.inc.php';
			break;

		case('Database_SQLFromClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLFromClause.inc.php';
			break;

		case('Database_SQLFromClauseJoinSubSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLFromClauseJoinSubSubClause.inc.php';
			break;

		case('Database_SQLFromClauseTableReference'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLFromClauseTableReference.inc.php';
			break;

		case('Database_SQLInsertStatement'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'Database_SQLInsertStatement.inc.php';
			break;

		case('Database_SQLLimitClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLLimitClause.inc.php';
			break;

		case('Database_SQLOrderByClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLOrderByClause.inc.php';
			break;

		case('Database_SQLOrderByClauseFieldSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLOrderByClauseFieldSubClause.inc.php';
			break;

		case('Database_SQLSelectClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLSelectClause.inc.php';
			break;

		case('Database_SQLSelectClauseFieldSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLSelectClauseFieldSubClause.inc.php';
			break;

		case('Database_SQLSelectQuery'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'Database_SQLSelectQuery.inc.php';
			break;

		case('Database_SQLSetClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLSetClause.inc.php';
			break;

		case('Database_SQLStatement'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'Database_SQLStatement.inc.php';
			break;

		case('Database_SQLStatementBehaviour'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR . 'Database_SQLStatementBehaviour.inc.php';
			break;

		case('Database_SQLStatementWithSetClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'Database_SQLStatementWithSetClause.inc.php';
			break;

		case('Database_SQLStatementWithWhereClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'Database_SQLStatementWithWhereClause.inc.php';
			break;

		case('Database_SQLSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLSubClause.inc.php';
			break;

		case('Database_SQLUpdateClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLUpdateClause.inc.php';
			break;

		case('Database_SQLUpdateClauseFieldSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLUpdateClauseFieldSubClause.inc.php';
			break;

		case('Database_SQLUpdateClauseQuotedValueFieldSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLUpdateClauseQuotedValueFieldSubClause.inc.php';
			break;

		case('Database_SQLUpdateStatement'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'Database_SQLUpdateStatement.inc.php';
			break;

		case('Database_SQLWhereClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLWhereClause.inc.php';
			break;

		case('Database_SQLWhereClauseBinaryOperatorConditionSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLWhereClauseBinaryOperatorConditionSubClause.inc.php';
			break;

		case('Database_SQLWhereClauseConditionSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLWhereClauseConditionSubClause.inc.php';
			break;

		case('Database_SQLWhereClauseFieldInListConditionSubClause'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'clauses' . DIRECTORY_SEPARATOR . 'Database_SQLWhereClauseFieldInListConditionSubClause.inc.php';
			break;

		case('Database_StringField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_StringField.inc.php';
			break;

		case('Database_SyncDatabaseWithTableSpecificationCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_SyncDatabaseWithTableSpecificationCLIScript.inc.php';
			break;

		case('Database_SyncTableSpecificationWithDatabaseCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Database_SyncTableSpecificationWithDatabaseCLIScript.inc.php';
			break;

		case('Database_Table'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'Database_Table.inc.php';
			break;

		case('Database_TableHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_TableHelper.inc.php';
			break;

		case('Database_TableNameTranslator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_TableNameTranslator.inc.php';
			break;

		case('Database_TableNameTranslatorFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database_TableNameTranslatorFactory.inc.php';
			break;

		case('Database_TableRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'Database_TableRenderer.inc.php';
			break;

		case('Database_TableSpecificationDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'table-structure-synchronisation' . DIRECTORY_SEPARATOR . 'Database_TableSpecificationDirectory.inc.php';
			break;

		case('Database_TableSpecificationFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'table-structure-synchronisation' . DIRECTORY_SEPARATOR . 'Database_TableSpecificationFile.inc.php';
			break;

		case('Database_TableSpecificationHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Database_TableSpecificationHelper.inc.php';
			break;

		case('Database_TableSpecificationTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_TableSpecificationTests.inc.php';
			break;

		case('Database_TableStructureManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'table-structure-synchronisation' . DIRECTORY_SEPARATOR . 'Database_TableStructureManager.inc.php';
			break;

		case('Database_TemporalField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_TemporalField.inc.php';
			break;

		case('Database_TextField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_TextField.inc.php';
			break;

		case('Database_TimeFieldRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'field-renderers' . DIRECTORY_SEPARATOR . 'Database_TimeFieldRenderer.inc.php';
			break;

		case('Database_UnableToMakeConnectionException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Database_UnableToMakeConnectionException.inc.php';
			break;

		case('Database_UserInputTooLongException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'Database_UserInputTooLongException.inc.php';
			break;

		case('Database_UsernameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'Database_UsernameValidator.inc.php';
			break;

		case('Database_UsernameValidatorTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'Database_UsernameValidatorTests.inc.php';
			break;

		case('Database_VarCharField'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'field-subclasses' . DIRECTORY_SEPARATOR . 'Database_VarCharField.inc.php';
			break;

		case('DataStructures_BinarySearchTree'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DataStructures_BinarySearchTree.inc.php';
			break;

		case('DataStructures_BSTNode'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DataStructures_BSTNode.inc.php';
			break;

		case('DB'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DB.inc.php';
			break;

		case('DBPages_AdminHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'DBPages_AdminHelper.inc.php';
			break;

		case('DBPages_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'DBPages_ConfigManager.inc.php';
			break;

		case('DBPages_ContentManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DBPages_ContentManager.inc.php';
			break;

		case('DBPages_CRUDAdminManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DBPages_CRUDAdminManager.inc.php';
			break;

		case('DBPages_FetchAllSectionsForPageSelectQuery'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'statements' . DIRECTORY_SEPARATOR . 'DBPages_FetchAllSectionsForPageSelectQuery.inc.php';
			break;

		case('DBPages_FilterHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DBPages_FilterHelper.inc.php';
			break;

		case('DBPages_HTMLPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'DBPages_HTMLPage.inc.php';
			break;

		case('DBPages_ManagePagesAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'DBPages_ManagePagesAdminPage.inc.php';
			break;

		case('DBPages_ManagePagesAdminRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'DBPages_ManagePagesAdminRedirectScript.inc.php';
			break;

		case('DBPages_Page'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DBPages_Page.inc.php';
			break;

		case('DBPages_PageRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'DBPages_PageRenderer.inc.php';
			break;

		case('DBPages_PageSectionNotFoundException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'DBPages_PageSectionNotFoundException.inc.php';
			break;

		case('DBPages_PCROFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DBPages_PCROFactory.inc.php';
			break;

		case('DBPages_Section'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DBPages_Section.inc.php';
			break;

		case('DBPages_SectionsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'DBPages_SectionsHelper.inc.php';
			break;

		case('DBPages_SPoE'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DBPages_SPoE.inc.php';
			break;

		case('DPPages_URLsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'db-pages' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'DPPages_URLsHelper.inc.php';
			break;

		case('EmailAddresses_EmailAddressHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'email-addresses' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'EmailAddresses_EmailAddressHelper.inc.php';
			break;

		case('EmailAddresses_EmailAddressRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'email-addresses' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'EmailAddresses_EmailAddressRenderer.inc.php';
			break;

		case('EmailAddresses_MailToA'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'email-addresses' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'EmailAddresses_MailToA.inc.php';
			break;

		case('Environment_MachineHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'environment' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Environment_MachineHelper.inc.php';
			break;

		case('Environment_ProcessesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'environment' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Environment_ProcessesHelper.inc.php';
			break;

		case('ErrorHandling_SprintfException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'error-handling' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'ErrorHandling_SprintfException.inc.php';
			break;

		case('FileSystem_Bz2TextFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_Bz2TextFile.inc.php';
			break;

		case('FileSystem_CreateDirectoryClassCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'FileSystem_CreateDirectoryClassCLIScript.inc.php';
			break;

		case('FileSystem_CreateFileClassCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'FileSystem_CreateFileClassCLIScript.inc.php';
			break;

		case('FileSystem_DataFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_DataFile.inc.php';
			break;

		case('FileSystem_Directory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_Directory.inc.php';
			break;

		case('FileSystem_DirectoryClassesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'FileSystem_DirectoryClassesHelper.inc.php';
			break;

		case('FileSystem_DirectoryClassNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'FileSystem_DirectoryClassNameValidator.inc.php';
			break;

		case('FileSystem_DirectoryHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'FileSystem_DirectoryHelper.inc.php';
			break;

		case('FileSystem_DirectoryHelperTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'FileSystem_DirectoryHelperTests.inc.php';
			break;

		case('FileSystem_ExistingDirectoryRelativeToProjectRootCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'FileSystem_ExistingDirectoryRelativeToProjectRootCLIScript.inc.php';
			break;

		case('FileSystem_ExistingDirectoryRelativeToProjectRootValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'FileSystem_ExistingDirectoryRelativeToProjectRootValidator.inc.php';
			break;

		case('FileSystem_File'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_File.inc.php';
			break;

		case('FileSystem_FileClassesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'FileSystem_FileClassesHelper.inc.php';
			break;

		case('FileSystem_FileClassNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'FileSystem_FileClassNameValidator.inc.php';
			break;

		case('FileSystem_FileNamesInPHPCodeHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'FileSystem_FileNamesInPHPCodeHelper.inc.php';
			break;

		case('FileSystem_FileNamesInPHPCodeHelperTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'FileSystem_FileNamesInPHPCodeHelperTests.inc.php';
			break;

		case('FileSystem_FileNotFoundException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'FileSystem_FileNotFoundException.inc.php';
			break;

		case('FileSystem_PHPClassFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_PHPClassFile.inc.php';
			break;

		case('FileSystem_PHPFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'FileSystem_PHPFile.inc.php';
			break;

		case('FileSystem_PHPIncFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_PHPIncFile.inc.php';
			break;

		case('FileSystem_SVNReposDumpFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_SVNReposDumpFile.inc.php';
			break;

		case('FileSystem_SVNRepositoryDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_SVNRepositoryDirectory.inc.php';
			break;

		case('FileSystem_SVNWorkingDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_SVNWorkingDirectory.inc.php';
			break;

		case('FileSystem_TextFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_TextFile.inc.php';
			break;

		case('FileSystem_TextFileWithComments'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_TextFileWithComments.inc.php';
			break;

		case('FileSystem_XMLFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'FileSystem_XMLFile.inc.php';
			break;

		case('Formatting_CountingNumber'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Formatting_CountingNumber.inc.php';
			break;

		case('Formatting_DateTime'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Formatting_DateTime.inc.php';
			break;

		case('Formatting_FileName'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Formatting_FileName.inc.php';
			break;

		case('Formatting_ListOfWords'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Formatting_ListOfWords.inc.php';
			break;

		case('Formatting_ListOfWordsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Formatting_ListOfWordsHelper.inc.php';
			break;

		case('Formatting_Number'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Formatting_Number.inc.php';
			break;

		case('Formatting_NumbersHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Formatting_NumbersHelper.inc.php';
			break;

		case('Formatting_Word'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'formatting' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Formatting_Word.inc.php';
			break;

		case('Haddock_MailingListSignUpPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'project-specific' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'Haddock_MailingListSignUpPage.inc.php';
			break;

		case('HaddockCMS_DBPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'project-specific' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'HaddockCMS_DBPage.inc.php';
			break;

		case('HaddockCMS_ExceptionPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'project-specific' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'HaddockCMS_ExceptionPage.inc.php';
			break;

		case('HaddockCMS_HTMLPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'project-specific' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'HaddockCMS_HTMLPage.inc.php';
			break;

		case('HaddockProjectOrganisation_AbstractModuleConfigXMLFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_AbstractModuleConfigXMLFile.inc.php';
			break;

		case('HaddockProjectOrganisation_AbstractPlugInModuleDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_AbstractPlugInModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_AssembleAutoloadFileCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_AssembleAutoloadFileCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadFilesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_AutoloadFilesHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_AutoloadHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadIncFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_AutoloadIncFile.inc.php';
			break;

		case('HaddockProjectOrganisation_CamelCaseRootValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_CamelCaseRootValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_ClassesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ClassesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_CLIModuleDirectoryFinder'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'finders' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_CLIModuleDirectoryFinder.inc.php';
			break;

		case('HaddockProjectOrganisation_CLIScriptDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_CLIScriptDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigDBManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ConfigDBManager.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ConfigManager.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigManagerFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ConfigManagerFactory.inc.php';
			break;

		case('HaddockProjectOrganisation_CoreModuleDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_CoreModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_CoreModulesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_CoreModulesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_CreateHaddockClassNameValidatorCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_CreateHaddockClassNameValidatorCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockClassNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_HaddockClassNameValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockClassNameValidatorNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_HaddockClassNameValidatorNameValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockClassNameValidatorsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_HaddockClassNameValidatorsHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockDirectoryTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_HaddockDirectoryTests.inc.php';
			break;

		case('HaddockProjectOrganisation_HPOConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_HPOConfigManager.inc.php';
			break;

		case('HaddockProjectOrganisation_IncludesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_IncludesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_InitialTimeHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_InitialTimeHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ListModuleNamesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ListModuleNamesCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_LoginException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_LoginException.inc.php';
			break;

		case('HaddockProjectOrganisation_LoginManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'managers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_LoginManager.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleConfigException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleConfigException.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleConfigFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleConfigXMLFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleConfigXMLFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectoriesCamelCaseRootsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleDirectoriesCamelCaseRootsHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectoriesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleDirectoriesHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectoryCamelCaseRootValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleDirectoryCamelCaseRootValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectoryHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleDirectoryHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectoryNamesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleDirectoryNamesHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleNameTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModuleNameTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ModulesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ModulesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_NavigationLinksFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_NavigationLinksFile.inc.php';
			break;

		case('HaddockProjectOrganisation_OptionButtonsFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_OptionButtonsFactory.inc.php';
			break;

		case('HaddockProjectOrganisation_PageConfigFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PageConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_PageDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PageDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PagesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PagesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PasswordResetException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PasswordResetException.inc.php';
			break;

		case('HaddockProjectOrganisation_PHPIncFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PHPIncFile.inc.php';
			break;

		case('HaddockProjectOrganisation_PlugInModuleDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PlugInModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PlugInModulesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PlugInModulesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PlugInsDirectoryTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PlugInsDirectoryTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectDirectoryFinder'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'finders' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectDirectoryHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectDirectoryHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectInformationHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectInformationHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectInformationSettingTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectInformationSettingTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectInformationTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectInformationTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectNameValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificConfigFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectSpecificConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDataHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectSpecificDataHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectSpecificDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDirectoryHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectSpecificDirectoryHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDirectoryTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectSpecificDirectoryTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectTitleInferenceTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ProjectTitleInferenceTests.inc.php';
			break;

		case('HaddockProjectOrganisation_PSModuleConfigFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PSModuleConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_PublicPageDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_PublicPageDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_RequiredModulesFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_RequiredModulesFile.inc.php';
			break;

		case('HaddockProjectOrganisation_SetInitalTimeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_SetInitalTimeCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_SetModuleDirectoryCamelCaseRootCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_SetModuleDirectoryCamelCaseRootCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_SetProjectInformationCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_SetProjectInformationCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_ShowProjectInformationCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_ShowProjectInformationCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_StandardModuleSubDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_StandardModuleSubDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_WWWIncludesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_WWWIncludesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_WWWPageDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'directories' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_WWWPageDirectory.inc.php';
			break;

		case('HPO_NoISCFileException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'HPO_NoISCFileException.inc.php';
			break;

		case('HTMLTags_A'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_A.inc.php';
			break;

		case('HTMLTags_Abbr'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Abbr.inc.php';
			break;

		case('HTMLTags_Attribute'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_Attribute.inc.php';
			break;

		case('HTMLTags_AttributeWithValue'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_AttributeWithValue.inc.php';
			break;

		case('HTMLTags_BareAttribute'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_BareAttribute.inc.php';
			break;

		case('HTMLTags_BLSeparatedPFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR . 'HTMLTags_BLSeparatedPFactory.inc.php';
			break;

		case('HTMLTags_BLSeparatedPsRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'HTMLTags_BLSeparatedPsRenderer.inc.php';
			break;

		case('HTMLTags_BR'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_BR.inc.php';
			break;

		case('HTMLTags_Button'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Button.inc.php';
			break;

		case('HTMLTags_Caption'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Caption.inc.php';
			break;

		case('HTMLTags_Code'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Code.inc.php';
			break;

		case('HTMLTags_ColGroup'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_ColGroup.inc.php';
			break;

		case('HTMLTags_ConfirmationP'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_ConfirmationP.inc.php';
			break;

		case('HTMLTags_DD'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_DD.inc.php';
			break;

		case('HTMLTags_Div'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Div.inc.php';
			break;

		case('HTMLTags_DL'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_DL.inc.php';
			break;

		case('HTMLTags_DT'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_DT.inc.php';
			break;

		case('HTMLTags_Em'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Em.inc.php';
			break;

		case('HTMLTags_Embed'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Embed.inc.php';
			break;

		case('HTMLTags_ExceptionDiv'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_ExceptionDiv.inc.php';
			break;

		case('HTMLTags_FieldSet'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_FieldSet.inc.php';
			break;

		case('HTMLTags_FillTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_FillTable.inc.php';
			break;

		case('HTMLTags_FluidBoxDiv'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_FluidBoxDiv.inc.php';
			break;

		case('HTMLTags_Form'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Form.inc.php';
			break;

		case('HTMLTags_FormActionAttribute'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_FormActionAttribute.inc.php';
			break;

		case('HTMLTags_FormWithInputs'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_FormWithInputs.inc.php';
			break;

		case('HTMLTags_Heading'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Heading.inc.php';
			break;

		case('HTMLTags_HiddenInput'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_HiddenInput.inc.php';
			break;

		case('HTMLTags_HR'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_HR.inc.php';
			break;

		case('HTMLTags_HReviewDiv'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_HReviewDiv.inc.php';
			break;

		case('HTMLTags_IMG'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_IMG.inc.php';
			break;

		case('HTMLTags_Input'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Input.inc.php';
			break;

		case('HTMLTags_InputTag'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_InputTag.inc.php';
			break;

		case('HTMLTags_Label'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Label.inc.php';
			break;

		case('HTMLTags_LastActionBoxDiv'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_LastActionBoxDiv.inc.php';
			break;

		case('HTMLTags_Legend'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Legend.inc.php';
			break;

		case('HTMLTags_LI'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_LI.inc.php';
			break;

		case('HTMLTags_Link'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Link.inc.php';
			break;

		case('HTMLTags_LinkFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR . 'HTMLTags_LinkFactory.inc.php';
			break;

		case('HTMLTags_LinkRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'HTMLTags_LinkRenderer.inc.php';
			break;

		case('HTMLTags_List'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_List.inc.php';
			break;

		case('HTMLTags_Meta'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Meta.inc.php';
			break;

		case('HTMLTags_MetaWithNameAndContent'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_MetaWithNameAndContent.inc.php';
			break;

		case('HTMLTags_Noscript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Noscript.inc.php';
			break;

		case('HTMLTags_Object'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Object.inc.php';
			break;

		case('HTMLTags_OL'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_OL.inc.php';
			break;

		case('HTMLTags_Option'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Option.inc.php';
			break;

		case('HTMLTags_P'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_P.inc.php';
			break;

		case('HTMLTags_Param'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Param.inc.php';
			break;

		case('HTMLTags_Pre'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Pre.inc.php';
			break;

		case('HTMLTags_Script'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Script.inc.php';
			break;

		case('HTMLTags_ScriptRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'HTMLTags_ScriptRenderer.inc.php';
			break;

		case('HTMLTags_Select'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Select.inc.php';
			break;

		case('HTMLTags_SelectFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR . 'HTMLTags_SelectFactory.inc.php';
			break;

		case('HTMLTags_SimpleForm'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_SimpleForm.inc.php';
			break;

		case('HTMLTags_SimpleOLForm'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_SimpleOLForm.inc.php';
			break;

		case('HTMLTags_Span'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Span.inc.php';
			break;

		case('HTMLTags_StyleSheetLink'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'HTMLTags_StyleSheetLink.inc.php';
			break;

		case('HTMLTags_Table'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Table.inc.php';
			break;

		case('HTMLTags_Tag'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_Tag.inc.php';
			break;

		case('HTMLTags_TagContent'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_TagContent.inc.php';
			break;

		case('HTMLTags_TagWithContent'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_TagWithContent.inc.php';
			break;

		case('HTMLTags_TagWithoutContent'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_TagWithoutContent.inc.php';
			break;

		case('HTMLTags_TBody'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_TBody.inc.php';
			break;

		case('HTMLTags_TD'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_TD.inc.php';
			break;

		case('HTMLTags_TextArea'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_TextArea.inc.php';
			break;

		case('HTMLTags_TFoot'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_TFoot.inc.php';
			break;

		case('HTMLTags_TH'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_TH.inc.php';
			break;

		case('HTMLTags_THead'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_THead.inc.php';
			break;

		case('HTMLTags_Title'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_Title.inc.php';
			break;

		case('HTMLTags_TR'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_TR.inc.php';
			break;

		case('HTMLTags_TruncatedSpanFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR . 'HTMLTags_TruncatedSpanFactory.inc.php';
			break;

		case('HTMLTags_UL'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'standard' . DIRECTORY_SEPARATOR . 'HTMLTags_UL.inc.php';
			break;

		case('HTMLTags_URL'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'HTMLTags_URL.inc.php';
			break;

		case('HTMLTags_ValueNotSetInSelectException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'html-tags' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'HTMLTags_ValueNotSetInSelectException.inc.php';
			break;

		case('InputValidation_CLIInterrogator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'InputValidation_CLIInterrogator.inc.php';
			break;

		case('InputValidation_CreateInputValidatorCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'InputValidation_CreateInputValidatorCLIScript.inc.php';
			break;

		case('InputValidation_CreateRegexValidatorCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'InputValidation_CreateRegexValidatorCLIScript.inc.php';
			break;

		case('InputValidation_EmailAddressValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'InputValidation_EmailAddressValidator.inc.php';
			break;

		case('InputValidation_InputValidatorNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'InputValidation_InputValidatorNameValidator.inc.php';
			break;

		case('InputValidation_InputValidatorsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'InputValidation_InputValidatorsHelper.inc.php';
			break;

		case('InputValidation_InvalidInputException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'InputValidation_InvalidInputException.inc.php';
			break;

		case('InputValidation_NumberValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'InputValidation_NumberValidator.inc.php';
			break;

		case('InputValidation_RegexValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'InputValidation_RegexValidator.inc.php';
			break;

		case('InputValidation_StringValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'InputValidation_StringValidator.inc.php';
			break;

		case('InputValidation_Validator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'InputValidation_Validator.inc.php';
			break;

		case('Logging_Logger'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'logging' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Logging_Logger.inc.php';
			break;

		case('Logging_LogsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'logging' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Logging_LogsHelper.inc.php';
			break;

		case('Logging_ResetLogsCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'logging' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Logging_ResetLogsCLIScript.inc.php';
			break;

		case('Logging_ServerLogsTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'logging' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'table-subclasses' . DIRECTORY_SEPARATOR . 'Logging_ServerLogsTable.inc.php';
			break;

		case('Logging_ServerLogsTableRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'logging' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'table-renderers' . DIRECTORY_SEPARATOR . 'Logging_ServerLogsTableRenderer.inc.php';
			break;

		case('MailingList_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'MailingList_ConfigManager.inc.php';
			break;

		case('MailingList_EmailTooLongException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'MailingList_EmailTooLongException.inc.php';
			break;

		case('MailingList_InvalidEmailException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'MailingList_InvalidEmailException.inc.php';
			break;

		case('MailingList_ListAddressesAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'MailingList_ListAddressesAdminPage.inc.php';
			break;

		case('MailingList_NameAndEmailException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'MailingList_NameAndEmailException.inc.php';
			break;

		case('MailingList_NameTooLongException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'MailingList_NameTooLongException.inc.php';
			break;

		case('MailingList_PCROFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'MailingList_PCROFactory.inc.php';
			break;

		case('MailingList_PeopleHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'MailingList_PeopleHelper.inc.php';
			break;

		case('MailingList_PeopleTable'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'table-subclasses' . DIRECTORY_SEPARATOR . 'MailingList_PeopleTable.inc.php';
			break;

		case('MailingList_PeopleTableRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'table-renderers' . DIRECTORY_SEPARATOR . 'MailingList_PeopleTableRenderer.inc.php';
			break;

		case('MailingList_PersonRow'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'row-subclasses' . DIRECTORY_SEPARATOR . 'MailingList_PersonRow.inc.php';
			break;

		case('MailingList_PersonRowRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'row-renderers' . DIRECTORY_SEPARATOR . 'MailingList_PersonRowRenderer.inc.php';
			break;

		case('MailingList_SignUpPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'MailingList_SignUpPage.inc.php';
			break;

		case('MailingList_SignUpRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'redirect-scripts' . DIRECTORY_SEPARATOR . 'MailingList_SignUpRedirectScript.inc.php';
			break;

		case('MailingList_SignUpRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'MailingList_SignUpRenderer.inc.php';
			break;

		case('MailingList_SignUpURLFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'url-factories' . DIRECTORY_SEPARATOR . 'MailingList_SignUpURLFactory.inc.php';
			break;

		case('MailingList_StartPageWidget'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'mailing-list' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'MailingList_StartPageWidget.inc.php';
			break;

		case('Navigation_1DTreeRetriever'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'retrievers' . DIRECTORY_SEPARATOR . 'Navigation_1DTreeRetriever.inc.php';
			break;

		case('Navigation_1DULRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'Navigation_1DULRenderer.inc.php';
			break;

		case('Navigation_AddNodeToProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_AddNodeToProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_AddProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_AddProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_DeleteAllNodesFromProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_DeleteAllNodesFromProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_DeleteAllProjectSpecific1DTreesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_DeleteAllProjectSpecific1DTreesCLIScript.inc.php';
			break;

		case('Navigation_DeleteNodeFromProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_DeleteNodeFromProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_DeleteProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_DeleteProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_EditNodeOfProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_EditNodeOfProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_EditProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_EditProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_HTMLListsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Navigation_HTMLListsHelper.inc.php';
			break;

		case('Navigation_LinkNode'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Navigation_LinkNode.inc.php';
			break;

		case('Navigation_LinksTree'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Navigation_LinksTree.inc.php';
			break;

		case('Navigation_ListNodesOfProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_ListNodesOfProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_ListProjectSpecific1DTreesCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_ListProjectSpecific1DTreesCLIScript.inc.php';
			break;

		case('Navigation_ListsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Navigation_ListsHelper.inc.php';
			break;

		case('Navigation_ManageNodesAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Navigation_ManageNodesAdminPage.inc.php';
			break;

		case('Navigation_ManageNodesAdminRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Navigation_ManageNodesAdminRedirectScript.inc.php';
			break;

		case('Navigation_ManageTreesAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Navigation_ManageTreesAdminPage.inc.php';
			break;

		case('Navigation_ManageTreesAdminRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Navigation_ManageTreesAdminRedirectScript.inc.php';
			break;

		case('Navigation_ManageURLsAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Navigation_ManageURLsAdminPage.inc.php';
			break;

		case('Navigation_ManageURLsAdminRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'Navigation_ManageURLsAdminRedirectScript.inc.php';
			break;

		case('Navigation_NodeRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'Navigation_NodeRenderer.inc.php';
			break;

		case('Navigation_NodesCRUDManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Navigation_NodesCRUDManager.inc.php';
			break;

		case('Navigation_NodesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Navigation_NodesHelper.inc.php';
			break;

		case('Navigation_ShiftNodeOfProjectSpecific1DTreeCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'Navigation_ShiftNodeOfProjectSpecific1DTreeCLIScript.inc.php';
			break;

		case('Navigation_SPoE'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Navigation_SPoE.inc.php';
			break;

		case('Navigation_TreesCRUDManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Navigation_TreesCRUDManager.inc.php';
			break;

		case('Navigation_URLsCRUDManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'navigation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Navigation_URLsCRUDManager.inc.php';
			break;

		case('News_ManageNewsItemsAdminPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'crud-pages' . DIRECTORY_SEPARATOR . 'manage-news-items' . DIRECTORY_SEPARATOR . 'News_ManageNewsItemsAdminPage.inc.php';
			break;

		case('News_ManageNewsItemsAdminRedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'crud-pages' . DIRECTORY_SEPARATOR . 'manage-news-items' . DIRECTORY_SEPARATOR . 'News_ManageNewsItemsAdminRedirectScript.inc.php';
			break;

		case('News_NewsItemsCRUDManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'crud-pages' . DIRECTORY_SEPARATOR . 'manage-news-items' . DIRECTORY_SEPARATOR . 'News_NewsItemsCRUDManager.inc.php';
			break;

		case('News_SPoE'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'News_SPoE.inc.php';
			break;

		case('ObjectOrientation_CompilationTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'ObjectOrientation_CompilationTests.inc.php';
			break;

		case('ObjectOrientation_CountPHPClassFilesInProjectCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'ObjectOrientation_CountPHPClassFilesInProjectCLIScript.inc.php';
			break;

		case('ObjectOrientation_CreateHelperCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'ObjectOrientation_CreateHelperCLIScript.inc.php';
			break;

		case('ObjectOrientation_HelperNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'ObjectOrientation_HelperNameValidator.inc.php';
			break;

		case('ObjectOrientation_HelpersHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'ObjectOrientation_HelpersHelper.inc.php';
			break;

		case('ObjectOrientation_ModulesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'ObjectOrientation_ModulesHelper.inc.php';
			break;

		case('ObjectOrientation_NamedMethodCaller'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'ObjectOrientation_NamedMethodCaller.inc.php';
			break;

		case('ObjectOrientation_UpperCamelCaseValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'object-orientation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'ObjectOrientation_UpperCamelCaseValidator.inc.php';
			break;

		case('Persistence_Entry'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'persistence' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Persistence_Entry.inc.php';
			break;

		case('PublicHTML_AboutHaddockCMS'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'PublicHTML_AboutHaddockCMS.inc.php';
			break;

		case('PublicHTML_AJAXFormHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_AJAXFormHelper.inc.php';
			break;

		case('PublicHTML_AllowAccessToDirectoryOnTheServerCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_AllowAccessToDirectoryOnTheServerCLIScript.inc.php';
			break;

		case('PublicHTML_AssembleHTAccessCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_AssembleHTAccessCLIScript.inc.php';
			break;

		case('PublicHTML_ConfigManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_ConfigManager.inc.php';
			break;

		case('PublicHTML_CreateProjectSpecificHTMLPageClassCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_CreateProjectSpecificHTMLPageClassCLIScript.inc.php';
			break;

		case('PublicHTML_DefaultLocationHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_DefaultLocationHelper.inc.php';
			break;

		case('PublicHTML_DefaultLocationValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'PublicHTML_DefaultLocationValidator.inc.php';
			break;

		case('PublicHTML_DeleteDefaultLocationCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_DeleteDefaultLocationCLIScript.inc.php';
			break;

		case('PublicHTML_Exception'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'PublicHTML_Exception.inc.php';
			break;

		case('PublicHTML_ExceptionHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_ExceptionHelper.inc.php';
			break;

		case('PublicHTML_ExceptionPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'PublicHTML_ExceptionPage.inc.php';
			break;

		case('PublicHTML_ExceptionRenderer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'renderers' . DIRECTORY_SEPARATOR . 'PublicHTML_ExceptionRenderer.inc.php';
			break;

		case('PublicHTML_GDPNGImage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'png' . DIRECTORY_SEPARATOR . 'PublicHTML_GDPNGImage.inc.php';
			break;

		case('PublicHTML_HaddockHTTPResponse'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'PublicHTML_HaddockHTTPResponse.inc.php';
			break;

		case('PublicHTML_HTMLPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'PublicHTML_HTMLPage.inc.php';
			break;

		case('PublicHTML_HTTPResponse'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_HTTPResponse.inc.php';
			break;

		case('PublicHTML_HTTPResponseWithMessageBody'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'PublicHTML_HTTPResponseWithMessageBody.inc.php';
			break;

		case('PublicHTML_IncludesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_IncludesDirectory.inc.php';
			break;

		case('PublicHTML_JavaScriptPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'PublicHTML_JavaScriptPage.inc.php';
			break;

		case('PublicHTML_NavigationListsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_NavigationListsHelper.inc.php';
			break;

		case('PublicHTML_PageDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_PageDirectory.inc.php';
			break;

		case('PublicHTML_PageManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_PageManager.inc.php';
			break;

		case('PublicHTML_PageNotFoundException'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'PublicHTML_PageNotFoundException.inc.php';
			break;

		case('PublicHTML_PagesDirectory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_PagesDirectory.inc.php';
			break;

		case('PublicHTML_PCROFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_PCROFactory.inc.php';
			break;

		case('PublicHTML_PNGImage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'png' . DIRECTORY_SEPARATOR . 'PublicHTML_PNGImage.inc.php';
			break;

		case('PublicHTML_ProjectRootDotHTAcessFileTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'PublicHTML_ProjectRootDotHTAcessFileTests.inc.php';
			break;

		case('PublicHTML_ProjectSpecificHTMLPageClassesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_ProjectSpecificHTMLPageClassesHelper.inc.php';
			break;

		case('PublicHTML_PublicURLFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_PublicURLFactory.inc.php';
			break;

		case('PublicHTML_RedirectionHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_RedirectionHelper.inc.php';
			break;

		case('PublicHTML_RedirectionManager'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'PublicHTML_RedirectionManager.inc.php';
			break;

		case('PublicHTML_RedirectScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'PublicHTML_RedirectScript.inc.php';
			break;

		case('PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript.inc.php';
			break;

		case('PublicHTML_ServerAccessControlHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_ServerAccessControlHelper.inc.php';
			break;

		case('PublicHTML_ServerAddressesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_ServerAddressesHelper.inc.php';
			break;

		case('PublicHTML_ServerAddressTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'PublicHTML_ServerAddressTests.inc.php';
			break;

		case('PublicHTML_ServerAddressValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'PublicHTML_ServerAddressValidator.inc.php';
			break;

		case('PublicHTML_ServerCapabilitiesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_ServerCapabilitiesHelper.inc.php';
			break;

		case('PublicHTML_SetDefaultLocationCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_SetDefaultLocationCLIScript.inc.php';
			break;

		case('PublicHTML_SetServerAddressCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_SetServerAddressCLIScript.inc.php';
			break;

		case('PublicHTML_ShowDefaultLocationCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_ShowDefaultLocationCLIScript.inc.php';
			break;

		case('PublicHTML_ShowServerAddressCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_ShowServerAddressCLIScript.inc.php';
			break;

		case('PublicHTML_UpdateDefaultLocationCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'PublicHTML_UpdateDefaultLocationCLIScript.inc.php';
			break;

		case('PublicHTML_URLFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'url-factories' . DIRECTORY_SEPARATOR . 'PublicHTML_URLFactory.inc.php';
			break;

		case('PublicHTML_URLHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'PublicHTML_URLHelper.inc.php';
			break;

		case('PublicHTML_VHostTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'PublicHTML_VHostTests.inc.php';
			break;

		case('PublicHTMLSkyTheme_HTMLPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html-sky-theme' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'PublicHTMLSkyTheme_HTMLPage.inc.php';
			break;

		case('Security_PasswordGenerator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'security' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Security_PasswordGenerator.inc.php';
			break;

		case('Security_PasswordsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'security' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Security_PasswordsHelper.inc.php';
			break;

		case('Strings_Converter'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'strings' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Strings_Converter.inc.php';
			break;

		case('Strings_Describer'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'strings' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Strings_Describer.inc.php';
			break;

		case('Strings_FilteringHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'strings' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Strings_FilteringHelper.inc.php';
			break;

		case('Strings_SimpleFilters'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'strings' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Strings_SimpleFilters.inc.php';
			break;

		case('Strings_Splitter'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'strings' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Strings_Splitter.inc.php';
			break;

		case('Strings_SplittingHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'strings' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Strings_SplittingHelper.inc.php';
			break;

		case('UnitTests_CreateUnitTestsClassCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'UnitTests_CreateUnitTestsClassCLIScript.inc.php';
			break;

		case('UnitTests_ListAllUnitTestsCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'UnitTests_ListAllUnitTestsCLIScript.inc.php';
			break;

		case('UnitTests_RunAllTestsCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'UnitTests_RunAllTestsCLIScript.inc.php';
			break;

		case('UnitTests_TestResult'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'UnitTests_TestResult.inc.php';
			break;

		case('UnitTests_TestResultsSet'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'UnitTests_TestResultsSet.inc.php';
			break;

		case('UnitTests_TestsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'UnitTests_TestsHelper.inc.php';
			break;

		case('UnitTests_UnitTests'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'UnitTests_UnitTests.inc.php';
			break;

		case('UnitTests_UnitTestsClassesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'UnitTests_UnitTestsClassesHelper.inc.php';
			break;

		case('UnitTests_UnitTestsClassNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'UnitTests_UnitTestsClassNameValidator.inc.php';
			break;

		case('UnitTests_UnitTestsPHPClassFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'unit-tests' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'UnitTests_UnitTestsPHPClassFile.inc.php';
			break;
		
	}
}

?>
