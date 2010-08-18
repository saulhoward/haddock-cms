<?php
/**
 * __autoload .INC file
 *
 * Last Modified: 2010-08-18
 */

function __autoload($class_name)
{
	switch ($class_name) {
	
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

		case('DataStructures_BinarySearchTree'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DataStructures_BinarySearchTree.inc.php';
			break;

		case('DataStructures_BSTNode'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'DataStructures_BSTNode.inc.php';
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

		case('FileSystem_MetaDataHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'file-system' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'FileSystem_MetaDataHelper.inc.php';
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

		case('HaddockCMS_SiteTextsHTMLPage'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'project-specific' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'HaddockCMS_SiteTextsHTMLPage.inc.php';
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

		case('HaddockProjectOrganisation_FullHaddockClassNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'haddock' . DIRECTORY_SEPARATOR . 'haddock-project-organisation' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'HaddockProjectOrganisation_FullHaddockClassNameValidator.inc.php';
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

		case('PublicHTML_CascadingStyleSheet'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'PublicHTML_CascadingStyleSheet.inc.php';
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

		case('PublicHTML_PageClassNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'PublicHTML_PageClassNameValidator.inc.php';
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

		case('PublicHTML_ZipFile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'public-html' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'PublicHTML_ZipFile.inc.php';
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

		case('SiteTexts_PageClassNameValidator'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'site-texts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'input-validation' . DIRECTORY_SEPARATOR . 'SiteTexts_PageClassNameValidator.inc.php';
			break;

		case('SiteTexts_PagesHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'site-texts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'SiteTexts_PagesHelper.inc.php';
			break;

		case('SiteTexts_PCROFactory'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'site-texts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'SiteTexts_PCROFactory.inc.php';
			break;

		case('SiteTexts_SetPageClassNameCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'site-texts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'SiteTexts_SetPageClassNameCLIScript.inc.php';
			break;

		case('SiteTexts_ShowPageClassNameCLIScript'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'site-texts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'cli-scripts' . DIRECTORY_SEPARATOR . 'SiteTexts_ShowPageClassNameCLIScript.inc.php';
			break;

		case('SiteTexts_SiteTextsHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'site-texts' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'SiteTexts_SiteTextsHelper.inc.php';
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

		case('Textile_Textile'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'textile' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Textile_Textile.inc.php';
			break;

		case('Textile_TranslationHelper'): 
			require_once PROJECT_ROOT . DIRECTORY_SEPARATOR . 'plug-ins' . DIRECTORY_SEPARATOR . 'textile' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Textile_TranslationHelper.inc.php';
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
