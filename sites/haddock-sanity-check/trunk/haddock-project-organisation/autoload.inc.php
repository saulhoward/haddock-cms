<?php
/**
 * __autoload .INC file
 *
 * Last Modified: 2008-06-13
 */

function __autoload($class_name)
{
	switch ($class_name) {
	
		case('Admin_AddUserCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/cli-scripts/Admin_AddUserCLIScript.inc.php';
			break;

		case('Admin_AdminIncluderURLFactory'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_AdminIncluderURLFactory.inc.php';
			break;

		case('Admin_ConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_ConfigManager.inc.php';
			break;

		case('Admin_HTMLPage'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/pages/Admin_HTMLPage.inc.php';
			break;

		case('Admin_IncFileFinder'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncFileFinder.inc.php';
			break;

		case('Admin_IncludesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncludesDirectory.inc.php';
			break;

		case('Admin_LogInHelper'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/helpers/Admin_LogInHelper.inc.php';
			break;

		case('Admin_LoginManager'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_LoginManager.inc.php';
			break;

		case('Admin_ModuleLinksUL'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/html-tags/Admin_ModuleLinksUL.inc.php';
			break;

		case('Admin_ModuleTitleFile'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_ModuleTitleFile.inc.php';
			break;

		case('Admin_NavigationLinksFile'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_NavigationLinksFile.inc.php';
			break;

		case('Admin_NavigationXMLFile'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_NavigationXMLFile.inc.php';
			break;

		case('Admin_NXFPage'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_NXFPage.inc.php';
			break;

		case('Admin_PageDirectory'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_PageDirectory.inc.php';
			break;

		case('Admin_PagesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_PagesDirectory.inc.php';
			break;

		case('Admin_RestrictedHTMLPage'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/pages/Admin_RestrictedHTMLPage.inc.php';
			break;

		case('Admin_RestrictedRedirectScript'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/pages/Admin_RestrictedRedirectScript.inc.php';
			break;

		case('Admin_SiteMapUL'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/html-tags/Admin_SiteMapUL.inc.php';
			break;

		case('Admin_UserRow'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/database/elements/row-subclasses/Admin_UserRow.inc.php';
			break;

		case('Admin_UserRowRenderer'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/database/renderers/row-renderers/Admin_UserRowRenderer.inc.php';
			break;

		case('Admin_UsersTable'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/database/elements/table-subclasses/Admin_UsersTable.inc.php';
			break;

		case('Admin_UsersTableRenderer'): 
			require_once PROJECT_ROOT . '/haddock/admin/classes/database/renderers/table-renderers/Admin_UsersTableRenderer.inc.php';
			break;

		case('BannerAds_BannerAdRow'): 
			require_once PROJECT_ROOT . '/plug-ins/banner-ads/classes/database/elements/row-subclasses/BannerAds_BannerAdRow.inc.php';
			break;

		case('BannerAds_BannerAdsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/banner-ads/classes/database/elements/table-subclasses/BannerAds_BannerAdsTable.inc.php';
			break;

		case('Caching_CacheDirectoryCreator'): 
			require_once PROJECT_ROOT . '/haddock/caching/classes/Caching_CacheDirectoryCreator.inc.php';
			break;

		case('Caching_CacheManager'): 
			require_once PROJECT_ROOT . '/haddock/caching/classes/Caching_CacheManager.inc.php';
			break;

		case('Caching_GlobalVarManager'): 
			require_once PROJECT_ROOT . '/haddock/caching/classes/Caching_GlobalVarManager.inc.php';
			break;

		case('Caching_SessionVarManager'): 
			require_once PROJECT_ROOT . '/haddock/caching/classes/Caching_SessionVarManager.inc.php';
			break;

		case('CLIScripts_ArgsHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_ArgsHelper.inc.php';
			break;

		case('CLIScripts_BatWrapperScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_BatWrapperScript.inc.php';
			break;

		case('CLIScripts_BinIncludesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_BinIncludesDirectory.inc.php';
			break;

		case('CLIScripts_CLIScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/cli-scripts/CLIScripts_CLIScript.inc.php';
			break;

		case('CLIScripts_CLIScriptFilesHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_CLIScriptFilesHelper.inc.php';
			break;

		case('CLIScripts_CLIScriptPHPClassFile'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/file-system/files/CLIScripts_CLIScriptPHPClassFile.inc.php';
			break;

		case('CLIScripts_CLIScriptsHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_CLIScriptsHelper.inc.php';
			break;

		case('CLIScripts_ConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/managers/config/CLIScripts_ConfigManager.inc.php';
			break;

		case('CLIScripts_CreateCLIScriptCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/cli-scripts/CLIScripts_CreateCLIScriptCLIScript.inc.php';
			break;

		case('CLIScripts_DataRenderingHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_DataRenderingHelper.inc.php';
			break;

		case('CLIScripts_ExceptionsHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_ExceptionsHelper.inc.php';
			break;

		case('CLIScripts_ExecutablePHPFile'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/file-system/files/CLIScripts_ExecutablePHPFile.inc.php';
			break;

		case('CLIScripts_GenerateScriptObjectRunnersCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/cli-scripts/CLIScripts_GenerateScriptObjectRunnersCLIScript.inc.php';
			break;

		case('CLIScripts_InputReader'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_InputReader.inc.php';
			break;

		case('CLIScripts_InterpreterProgramHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_InterpreterProgramHelper.inc.php';
			break;

		case('CLIScripts_LockFile'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/file-system/files/CLIScripts_LockFile.inc.php';
			break;

		case('CLIScripts_LockFilesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/file-system/directories/CLIScripts_LockFilesDirectory.inc.php';
			break;

		case('CLIScripts_LockFilesHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_LockFilesHelper.inc.php';
			break;

		case('CLIScripts_NewScriptNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/input-validation/CLIScripts_NewScriptNameValidator.inc.php';
			break;

		case('CLIScripts_ScriptDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_ScriptDirectory.inc.php';
			break;

		case('CLIScripts_ScriptLockedException'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/exceptions/CLIScripts_ScriptLockedException.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnerFile'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/file-system/files/CLIScripts_ScriptObjectRunnerFile.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnersDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/file-system/directories/CLIScripts_ScriptObjectRunnersDirectory.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnersDirectoryTests'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/unit-tests/CLIScripts_ScriptObjectRunnersDirectoryTests.inc.php';
			break;

		case('CLIScripts_ScriptObjectRunnersHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_ScriptObjectRunnersHelper.inc.php';
			break;

		case('CLIScripts_ScriptsDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_ScriptsDirectory.inc.php';
			break;

		case('CLIScripts_ShowServerCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/cli-scripts/CLIScripts_ShowServerCLIScript.inc.php';
			break;

		case('CLIScripts_SHWrapperScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_SHWrapperScript.inc.php';
			break;

		case('CLIScripts_UserInterrogationHelper'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/helpers/CLIScripts_UserInterrogationHelper.inc.php';
			break;

		case('CLIScripts_WrapperScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_WrapperScript.inc.php';
			break;

		case('CodeAnalysis_ExecutionTimer'): 
			require_once PROJECT_ROOT . '/haddock/code-analysis/classes/CodeAnalysis_ExecutionTimer.inc.php';
			break;

		case('CodeAnalysis_ListClassesCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/code-analysis/classes/cli-scripts/CodeAnalysis_ListClassesCLIScript.inc.php';
			break;

		case('CodeAnalysis_MemoryHelper'): 
			require_once PROJECT_ROOT . '/haddock/code-analysis/classes/helpers/CodeAnalysis_MemoryHelper.inc.php';
			break;

		case('Configuration_ConfigDirectoriesHelper'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/helpers/Configuration_ConfigDirectoriesHelper.inc.php';
			break;

		case('Configuration_ConfigDirectory'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/file-system/directories/Configuration_ConfigDirectory.inc.php';
			break;

		case('Configuration_ConfigFile'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/file-system/files/Configuration_ConfigFile.inc.php';
			break;

		case('Configuration_ConfigFileNotFoundException'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/exceptions/Configuration_ConfigFileNotFoundException.inc.php';
			break;

		case('Configuration_ConfigFilesHelper'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/helpers/Configuration_ConfigFilesHelper.inc.php';
			break;

		case('Configuration_ConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/managers/config/Configuration_ConfigManager.inc.php';
			break;

		case('Configuration_ConfigManagerHelper'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/helpers/Configuration_ConfigManagerHelper.inc.php';
			break;

		case('Configuration_InstanceSpecificConfigDirectory'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/file-system/directories/Configuration_InstanceSpecificConfigDirectory.inc.php';
			break;

		case('Configuration_InstanceSpecificConfigDirectoryTests'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/unit-tests/Configuration_InstanceSpecificConfigDirectoryTests.inc.php';
			break;

		case('Configuration_InstanceSpecificConfigFileNotFoundException'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/exceptions/Configuration_InstanceSpecificConfigFileNotFoundException.inc.php';
			break;

		case('Configuration_ListAllConfigFilesCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/configuration/classes/cli-scripts/Configuration_ListAllConfigFilesCLIScript.inc.php';
			break;

		case('Database_AddConditionsToWhereClauseBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/behaviours/Database_AddConditionsToWhereClauseBehaviour.inc.php';
			break;

		case('Database_AddKeyValuePairsToSetClauseBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/behaviours/Database_AddKeyValuePairsToSetClauseBehaviour.inc.php';
			break;

		case('Database_AddRowOLForm'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_AddRowOLForm.inc.php';
			break;

		case('Database_AdminXMLPageManager'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_AdminXMLPageManager.inc.php';
			break;

		case('Database_ApplyUnappliedDeltaFilesCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_ApplyUnappliedDeltaFilesCLIScript.inc.php';
			break;

		case('Database_BlobField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_BlobField.inc.php';
			break;

		case('Database_BlobFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_BlobFieldRenderer.inc.php';
			break;

		case('Database_Cell'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/Database_Cell.inc.php';
			break;

		case('Database_ChoiceField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_ChoiceField.inc.php';
			break;

		case('Database_ChoiceFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_ChoiceFieldRenderer.inc.php';
			break;

		case('Database_ConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/managers/config/Database_ConfigManager.inc.php';
			break;

		case('Database_ConnectionsHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_ConnectionsHelper.inc.php';
			break;

		case('Database_CreateDeltaFileCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_CreateDeltaFileCLIScript.inc.php';
			break;

		case('Database_CreateImageCacheDirectoryCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_CreateImageCacheDirectoryCLIScript.inc.php';
			break;

		case('Database_CreateMySQLUserAndDatabaseCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_CreateMySQLUserAndDatabaseCLIScript.inc.php';
			break;

		case('Database_CreatePasswordsFileCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_CreatePasswordsFileCLIScript.inc.php';
			break;

		case('Database_CRUDAdminManager'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_CRUDAdminManager.inc.php';
			break;

		case('Database_CRUDAdminPage'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/pages/Database_CRUDAdminPage.inc.php';
			break;

		case('Database_CRUDAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/pages/Database_CRUDAdminRedirectScript.inc.php';
			break;

		case('Database_CRUDException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_CRUDException.inc.php';
			break;

		case('Database_Database'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/Database_Database.inc.php';
			break;

		case('Database_DatabaseClassFactory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_DatabaseClassFactory.inc.php';
			break;

		case('Database_DatabaseClassFactoryTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_DatabaseClassFactoryTests.inc.php';
			break;

		case('Database_DatabaseClassFinder'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_DatabaseClassFinder.inc.php';
			break;

		case('Database_DatabaseClassNameFile'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_DatabaseClassNameFile.inc.php';
			break;

		case('Database_DatabaseClassNameFileTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_DatabaseClassNameFileTests.inc.php';
			break;

		case('Database_DatabaseClassNameOverride'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_DatabaseClassNameOverride.inc.php';
			break;

		case('Database_DatabaseClassNameOverrideFile'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_DatabaseClassNameOverrideFile.inc.php';
			break;

		case('Database_DatabaseDescribingTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_DatabaseDescribingTests.inc.php';
			break;

		case('Database_DatabaseHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_DatabaseHelper.inc.php';
			break;

		case('Database_DatabaseNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/input-validation/Database_DatabaseNameValidator.inc.php';
			break;

		case('Database_DatabaseRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/Database_DatabaseRenderer.inc.php';
			break;

		case('Database_DateTimeField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_DateTimeField.inc.php';
			break;

		case('Database_DBHandleTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_DBHandleTests.inc.php';
			break;

		case('Database_DBSubClassesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_DBSubClassesDirectory.inc.php';
			break;

		case('Database_DelegateRow'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/row-subclasses/Database_DelegateRow.inc.php';
			break;

		case('Database_DeletableRow'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/interfaces/row-interfaces/Database_DeletableRow.inc.php';
			break;

		case('Database_DeletableRowDeleteBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_DeletableRowDeleteBehaviour.inc.php';
			break;

		case('Database_DeltaFile'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/file-system/files/Database_DeltaFile.inc.php';
			break;

		case('Database_DeltaFilesHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_DeltaFilesHelper.inc.php';
			break;

		case('Database_DeltasDirectory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/file-system/directories/Database_DeltasDirectory.inc.php';
			break;

		case('Database_DeltasTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_DeltasTests.inc.php';
			break;

		case('Database_EditRowOLForm'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_EditRowOLForm.inc.php';
			break;

		case('Database_Element'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_Element.inc.php';
			break;

		case('Database_ElementTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_ElementTests.inc.php';
			break;

		case('Database_EmailAddressVarCharField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_EmailAddressVarCharField.inc.php';
			break;

		case('Database_EntityNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/input-validation/Database_EntityNameValidator.inc.php';
			break;

		case('Database_EnumField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_EnumField.inc.php';
			break;

		case('Database_FetchingHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_FetchingHelper.inc.php';
			break;

		case('Database_Field'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/Database_Field.inc.php';
			break;

		case('Database_FieldNotInTableException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_FieldNotInTableException.inc.php';
			break;

		case('Database_FieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/Database_FieldRenderer.inc.php';
			break;

		case('Database_FilesTableRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/table-renderers/Database_FilesTableRenderer.inc.php';
			break;

		case('Database_ForeignKeyRow'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/row-subclasses/Database_ForeignKeyRow.inc.php';
			break;

		case('Database_ForeignKeyTable'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/table-subclasses/Database_ForeignKeyTable.inc.php';
			break;

		case('Database_GetSetClauseBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/behaviours/Database_GetSetClauseBehaviour.inc.php';
			break;

		case('Database_GetWhereClauseBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/behaviours/Database_GetWhereClauseBehaviour.inc.php';
			break;

		case('Database_HostNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/input-validation/Database_HostNameValidator.inc.php';
			break;

		case('Database_HostNameValidatorTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_HostNameValidatorTests.inc.php';
			break;

		case('Database_HTMLPreFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_HTMLPreFieldRenderer.inc.php';
			break;

		case('Database_ImageCacheHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_ImageCacheHelper.inc.php';
			break;

		case('Database_ImageFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_ImageFieldRenderer.inc.php';
			break;

		case('Database_ImageRow'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/row-subclasses/Database_ImageRow.inc.php';
			break;

		case('Database_ImageRowRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/row-renderers/Database_ImageRowRenderer.inc.php';
			break;

		case('Database_ImagesHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_ImagesHelper.inc.php';
			break;

		case('Database_ImagesTable'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/table-subclasses/Database_ImagesTable.inc.php';
			break;

		case('Database_ImagesTableRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/table-renderers/Database_ImagesTableRenderer.inc.php';
			break;

		case('Database_InputSanitationHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_InputSanitationHelper.inc.php';
			break;

		case('Database_IntField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_IntField.inc.php';
			break;

		case('Database_InvalidUserInputException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_InvalidUserInputException.inc.php';
			break;

		case('Database_LimitForm'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_LimitForm.inc.php';
			break;

		case('Database_ListDeltaFileApplicationsCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_ListDeltaFileApplicationsCLIScript.inc.php';
			break;

		case('Database_ListDeltaFilesCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_ListDeltaFilesCLIScript.inc.php';
			break;

		case('Database_ListUnappliedDeltaFilesCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_ListUnappliedDeltaFilesCLIScript.inc.php';
			break;

		case('Database_LongTextFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_LongTextFieldRenderer.inc.php';
			break;

		case('Database_ManageSimpleCRUDAdminPage'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/pages/crud-pages/simple-crud/Database_ManageSimpleCRUDAdminPage.inc.php';
			break;

		case('Database_ManageSimpleCRUDAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/pages/crud-pages/simple-crud/Database_ManageSimpleCRUDAdminRedirectScript.inc.php';
			break;

		case('Database_ModifyingStatementHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_ModifyingStatementHelper.inc.php';
			break;

		case('Database_MySQLException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_MySQLException.inc.php';
			break;

		case('Database_MySQLRootUser'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_MySQLRootUser.inc.php';
			break;

		case('Database_MySQLUser'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_MySQLUser.inc.php';
			break;

		case('Database_MySQLUserFactory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_MySQLUserFactory.inc.php';
			break;

		case('Database_NumericField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_NumericField.inc.php';
			break;

		case('Database_PageRow'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/database/elements/row-subclasses/Database_PageRow.inc.php';
			break;

		case('Database_PageRowRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/database/renderers/row-renderers/Database_PageRowRenderer.inc.php';
			break;

		case('Database_PagesTable'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/database/elements/table-subclasses/Database_PagesTable.inc.php';
			break;

		case('Database_PagesTableRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/database/renderers/table-renderers/Database_PagesTableRenderer.inc.php';
			break;

		case('Database_PasswordFile'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_PasswordFile.inc.php';
			break;

		case('Database_PasswordsDirectoryTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_PasswordsDirectoryTests.inc.php';
			break;

		case('Database_PasswordsFileHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_PasswordsFileHelper.inc.php';
			break;

		case('Database_PasswordsFileTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_PasswordsFileTests.inc.php';
			break;

		case('Database_PasswordValidator'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/input-validation/Database_PasswordValidator.inc.php';
			break;

		case('Database_PreviousNextUL'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_PreviousNextUL.inc.php';
			break;

		case('Database_Renderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_Renderer.inc.php';
			break;

		case('Database_ResetDatabaseCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_ResetDatabaseCLIScript.inc.php';
			break;

		case('Database_Row'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/Database_Row.inc.php';
			break;

		case('Database_RowBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/Database_RowBehaviour.inc.php';
			break;

		case('Database_RowNotFoundException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_RowNotFoundException.inc.php';
			break;

		case('Database_RowOLForm'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_RowOLForm.inc.php';
			break;

		case('Database_RowRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/Database_RowRenderer.inc.php';
			break;

		case('Database_SelectionHTMLDiv'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_SelectionHTMLDiv.inc.php';
			break;

		case('Database_SelectionManager'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/selection-managers/Database_SelectionManager.inc.php';
			break;

		case('Database_SelectionManagerFactory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/selection-managers/Database_SelectionManagerFactory.inc.php';
			break;

		case('Database_SelectionManagersFile'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/selection-managers/Database_SelectionManagersFile.inc.php';
			break;

		case('Database_ShortTextFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_ShortTextFieldRenderer.inc.php';
			break;

		case('Database_SimpleCRUDManager'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/pages/crud-pages/simple-crud/Database_SimpleCRUDManager.inc.php';
			break;

		case('Database_SortableHeadingTR'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_SortableHeadingTR.inc.php';
			break;

		case('Database_SortableRow'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/interfaces/row-interfaces/Database_SortableRow.inc.php';
			break;

		case('Database_SortableRowBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_SortableRowBehaviour.inc.php';
			break;

		case('Database_SortableRowMaxSortOrderBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_SortableRowMaxSortOrderBehaviour.inc.php';
			break;

		case('Database_SortableRowMinSortOrderBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_SortableRowMinSortOrderBehaviour.inc.php';
			break;

		case('Database_SortableRowMoveDownBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_SortableRowMoveDownBehaviour.inc.php';
			break;

		case('Database_SortableRowMoveUpBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/delegation/behaviours/row-behaviours/Database_SortableRowMoveUpBehaviour.inc.php';
			break;

		case('Database_SpecifiedTable'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_SpecifiedTable.inc.php';
			break;

		case('Database_SpecifiedTableFieldTypeTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_SpecifiedTableFieldTypeTests.inc.php';
			break;

		case('Database_SQLClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLClause.inc.php';
			break;

		case('Database_SQLDeleteStatement'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLDeleteStatement.inc.php';
			break;

		case('Database_SQLDirectory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_SQLDirectory.inc.php';
			break;

		case('Database_SQLFile'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/file-system/files/Database_SQLFile.inc.php';
			break;

		case('Database_SQLFromClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLFromClause.inc.php';
			break;

		case('Database_SQLFromClauseJoinSubSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLFromClauseJoinSubSubClause.inc.php';
			break;

		case('Database_SQLFromClauseTableReference'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLFromClauseTableReference.inc.php';
			break;

		case('Database_SQLInsertStatement'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLInsertStatement.inc.php';
			break;

		case('Database_SQLLimitClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLLimitClause.inc.php';
			break;

		case('Database_SQLOrderByClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLOrderByClause.inc.php';
			break;

		case('Database_SQLOrderByClauseFieldSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLOrderByClauseFieldSubClause.inc.php';
			break;

		case('Database_SQLSelectClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLSelectClause.inc.php';
			break;

		case('Database_SQLSelectClauseFieldSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLSelectClauseFieldSubClause.inc.php';
			break;

		case('Database_SQLSelectQuery'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLSelectQuery.inc.php';
			break;

		case('Database_SQLSetClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLSetClause.inc.php';
			break;

		case('Database_SQLStatement'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLStatement.inc.php';
			break;

		case('Database_SQLStatementBehaviour'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/behaviours/Database_SQLStatementBehaviour.inc.php';
			break;

		case('Database_SQLStatementWithSetClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLStatementWithSetClause.inc.php';
			break;

		case('Database_SQLStatementWithWhereClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLStatementWithWhereClause.inc.php';
			break;

		case('Database_SQLSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLSubClause.inc.php';
			break;

		case('Database_SQLUpdateClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLUpdateClause.inc.php';
			break;

		case('Database_SQLUpdateClauseFieldSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLUpdateClauseFieldSubClause.inc.php';
			break;

		case('Database_SQLUpdateClauseQuotedValueFieldSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLUpdateClauseQuotedValueFieldSubClause.inc.php';
			break;

		case('Database_SQLUpdateStatement'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLUpdateStatement.inc.php';
			break;

		case('Database_SQLWhereClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLWhereClause.inc.php';
			break;

		case('Database_SQLWhereClauseBinaryOperatorConditionSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLWhereClauseBinaryOperatorConditionSubClause.inc.php';
			break;

		case('Database_SQLWhereClauseConditionSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLWhereClauseConditionSubClause.inc.php';
			break;

		case('Database_SQLWhereClauseFieldInListConditionSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLWhereClauseFieldInListConditionSubClause.inc.php';
			break;

		case('Database_StringField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_StringField.inc.php';
			break;

		case('Database_SyncDatabaseWithTableSpecificationCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_SyncDatabaseWithTableSpecificationCLIScript.inc.php';
			break;

		case('Database_SyncTableSpecificationWithDatabaseCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/cli-scripts/Database_SyncTableSpecificationWithDatabaseCLIScript.inc.php';
			break;

		case('Database_Table'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/Database_Table.inc.php';
			break;

		case('Database_TableHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_TableHelper.inc.php';
			break;

		case('Database_TableNameTranslator'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_TableNameTranslator.inc.php';
			break;

		case('Database_TableNameTranslatorFactory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_TableNameTranslatorFactory.inc.php';
			break;

		case('Database_TableRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/Database_TableRenderer.inc.php';
			break;

		case('Database_TableSpecificationDirectory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/table-structure-synchronisation/Database_TableSpecificationDirectory.inc.php';
			break;

		case('Database_TableSpecificationFile'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/table-structure-synchronisation/Database_TableSpecificationFile.inc.php';
			break;

		case('Database_TableSpecificationHelper'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/helpers/Database_TableSpecificationHelper.inc.php';
			break;

		case('Database_TableSpecificationTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_TableSpecificationTests.inc.php';
			break;

		case('Database_TableStructureManager'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/table-structure-synchronisation/Database_TableStructureManager.inc.php';
			break;

		case('Database_TemporalField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_TemporalField.inc.php';
			break;

		case('Database_TextField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_TextField.inc.php';
			break;

		case('Database_TimeFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_TimeFieldRenderer.inc.php';
			break;

		case('Database_UnableToMakeConnectionException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_UnableToMakeConnectionException.inc.php';
			break;

		case('Database_UserInputTooLongException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_UserInputTooLongException.inc.php';
			break;

		case('Database_UsernameValidator'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/input-validation/Database_UsernameValidator.inc.php';
			break;

		case('Database_UsernameValidatorTests'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/unit-tests/Database_UsernameValidatorTests.inc.php';
			break;

		case('Database_VarCharField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_VarCharField.inc.php';
			break;

		case('DataStructures_BinarySearchTree'): 
			require_once PROJECT_ROOT . '/haddock/data-structures/classes/DataStructures_BinarySearchTree.inc.php';
			break;

		case('DataStructures_BSTNode'): 
			require_once PROJECT_ROOT . '/haddock/data-structures/classes/DataStructures_BSTNode.inc.php';
			break;

		case('DB'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/DB.inc.php';
			break;

		case('DBPages_AdminHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/helpers/DBPages_AdminHelper.inc.php';
			break;

		case('DBPages_ConfigManager'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/managers/config/DBPages_ConfigManager.inc.php';
			break;

		case('DBPages_ContentManager'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_ContentManager.inc.php';
			break;

		case('DBPages_CRUDAdminManager'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_CRUDAdminManager.inc.php';
			break;

		case('DBPages_FetchAllSectionsForPageSelectQuery'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/database/sql/statements/DBPages_FetchAllSectionsForPageSelectQuery.inc.php';
			break;

		case('DBPages_FilterHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_FilterHelper.inc.php';
			break;

		case('DBPages_HTMLPage'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/pages/html/DBPages_HTMLPage.inc.php';
			break;

		case('DBPages_ManagePagesAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/pages/DBPages_ManagePagesAdminPage.inc.php';
			break;

		case('DBPages_ManagePagesAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/pages/DBPages_ManagePagesAdminRedirectScript.inc.php';
			break;

		case('DBPages_Page'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_Page.inc.php';
			break;

		case('DBPages_PageRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/renderers/DBPages_PageRenderer.inc.php';
			break;

		case('DBPages_PageSectionNotFoundException'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/exceptions/DBPages_PageSectionNotFoundException.inc.php';
			break;

		case('DBPages_PCROFactory'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_PCROFactory.inc.php';
			break;

		case('DBPages_Section'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_Section.inc.php';
			break;

		case('DBPages_SectionsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/helpers/DBPages_SectionsHelper.inc.php';
			break;

		case('DBPages_SPoE'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_SPoE.inc.php';
			break;

		case('DPPages_URLsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/helpers/DPPages_URLsHelper.inc.php';
			break;

		case('EmailAddresses_EmailAddressHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/email-addresses/classes/helpers/EmailAddresses_EmailAddressHelper.inc.php';
			break;

		case('EmailAddresses_EmailAddressRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/email-addresses/classes/renderers/EmailAddresses_EmailAddressRenderer.inc.php';
			break;

		case('EmailAddresses_MailToA'): 
			require_once PROJECT_ROOT . '/plug-ins/email-addresses/classes/html-tags/EmailAddresses_MailToA.inc.php';
			break;

		case('EmailDelivery_Email'): 
			require_once PROJECT_ROOT . '/plug-ins/email-delivery/classes/EmailDelivery_Email.inc.php';
			break;

		case('EmailDelivery_TemplateEmail'): 
			require_once PROJECT_ROOT . '/plug-ins/email-delivery/classes/EmailDelivery_TemplateEmail.inc.php';
			break;

		case('Environment_MachineHelper'): 
			require_once PROJECT_ROOT . '/haddock/environment/classes/helpers/Environment_MachineHelper.inc.php';
			break;

		case('Environment_ProcessesHelper'): 
			require_once PROJECT_ROOT . '/haddock/environment/classes/helpers/Environment_ProcessesHelper.inc.php';
			break;

		case('ErrorHandling_SprintfException'): 
			require_once PROJECT_ROOT . '/haddock/error-handling/classes/exceptions/ErrorHandling_SprintfException.inc.php';
			break;

		case('FacebookApp_FacebookObjFactory'): 
			require_once PROJECT_ROOT . '/plug-ins/facebook-app/classes/helpers/FacebookApp_FacebookObjFactory.inc.php';
			break;

		case('FacebookApp_FBMLPage'): 
			require_once PROJECT_ROOT . '/plug-ins/facebook-app/classes/pages/fbml/FacebookApp_FBMLPage.inc.php';
			break;

		case('FileSystem_Bz2TextFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_Bz2TextFile.inc.php';
			break;

		case('FileSystem_CreateDirectoryClassCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/cli-scripts/FileSystem_CreateDirectoryClassCLIScript.inc.php';
			break;

		case('FileSystem_CreateFileClassCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/cli-scripts/FileSystem_CreateFileClassCLIScript.inc.php';
			break;

		case('FileSystem_DataFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_DataFile.inc.php';
			break;

		case('FileSystem_Directory'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_Directory.inc.php';
			break;

		case('FileSystem_DirectoryClassesHelper'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/helpers/FileSystem_DirectoryClassesHelper.inc.php';
			break;

		case('FileSystem_DirectoryClassNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/input-validation/FileSystem_DirectoryClassNameValidator.inc.php';
			break;

		case('FileSystem_DirectoryHelper'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/helpers/FileSystem_DirectoryHelper.inc.php';
			break;

		case('FileSystem_DirectoryHelperTests'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/unit-tests/FileSystem_DirectoryHelperTests.inc.php';
			break;

		case('FileSystem_ExistingDirectoryRelativeToProjectRootValidator'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/input-validation/FileSystem_ExistingDirectoryRelativeToProjectRootValidator.inc.php';
			break;

		case('FileSystem_File'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_File.inc.php';
			break;

		case('FileSystem_FileClassesHelper'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/helpers/FileSystem_FileClassesHelper.inc.php';
			break;

		case('FileSystem_FileClassNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/input-validation/FileSystem_FileClassNameValidator.inc.php';
			break;

		case('FileSystem_FileNotFoundException'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/exceptions/FileSystem_FileNotFoundException.inc.php';
			break;

		case('FileSystem_PHPClassFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_PHPClassFile.inc.php';
			break;

		case('FileSystem_PHPFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/files/FileSystem_PHPFile.inc.php';
			break;

		case('FileSystem_PHPIncFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_PHPIncFile.inc.php';
			break;

		case('FileSystem_SVNReposDumpFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_SVNReposDumpFile.inc.php';
			break;

		case('FileSystem_SVNRepositoryDirectory'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_SVNRepositoryDirectory.inc.php';
			break;

		case('FileSystem_SVNWorkingDirectory'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_SVNWorkingDirectory.inc.php';
			break;

		case('FileSystem_TextFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_TextFile.inc.php';
			break;

		case('FileSystem_TextFileWithComments'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_TextFileWithComments.inc.php';
			break;

		case('FileSystem_XMLFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_XMLFile.inc.php';
			break;

		case('Formatting_CountingNumber'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_CountingNumber.inc.php';
			break;

		case('Formatting_DateTime'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_DateTime.inc.php';
			break;

		case('Formatting_FileName'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_FileName.inc.php';
			break;

		case('Formatting_ListOfWords'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_ListOfWords.inc.php';
			break;

		case('Formatting_ListOfWordsHelper'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/helpers/Formatting_ListOfWordsHelper.inc.php';
			break;

		case('Formatting_Number'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_Number.inc.php';
			break;

		case('Formatting_NumbersHelper'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_NumbersHelper.inc.php';
			break;

		case('Formatting_Word'): 
			require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_Word.inc.php';
			break;

		case('HaddockProjectOrganisation_AbstractModuleConfigXMLFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_AbstractModuleConfigXMLFile.inc.php';
			break;

		case('HaddockProjectOrganisation_AbstractPlugInModuleDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_AbstractPlugInModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_AssembleAutoloadFileCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/cli-scripts/HaddockProjectOrganisation_AssembleAutoloadFileCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadFilesHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_AutoloadFilesHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_AutoloadHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadIncFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_AutoloadIncFile.inc.php';
			break;

		case('HaddockProjectOrganisation_CamelCaseRootValidator'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/input-validation/HaddockProjectOrganisation_CamelCaseRootValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_ClassesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ClassesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_CLIModuleDirectoryFinder'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/finders/HaddockProjectOrganisation_CLIModuleDirectoryFinder.inc.php';
			break;

		case('HaddockProjectOrganisation_CLIScriptDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_CLIScriptDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigDBManager'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/managers/HaddockProjectOrganisation_ConfigDBManager.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_ConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/managers/HaddockProjectOrganisation_ConfigManager.inc.php';
			break;

		case('HaddockProjectOrganisation_ConfigManagerFactory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/factories/HaddockProjectOrganisation_ConfigManagerFactory.inc.php';
			break;

		case('HaddockProjectOrganisation_CoreModuleDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_CoreModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_CoreModulesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_CoreModulesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_CreateHaddockClassNameValidatorCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/cli-scripts/HaddockProjectOrganisation_CreateHaddockClassNameValidatorCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockClassNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/input-validation/HaddockProjectOrganisation_HaddockClassNameValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockClassNameValidatorNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/input-validation/HaddockProjectOrganisation_HaddockClassNameValidatorNameValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockClassNameValidatorsHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_HaddockClassNameValidatorsHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_HaddockDirectoryTests'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/unit-tests/HaddockProjectOrganisation_HaddockDirectoryTests.inc.php';
			break;

		case('HaddockProjectOrganisation_HPOConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/managers/HaddockProjectOrganisation_HPOConfigManager.inc.php';
			break;

		case('HaddockProjectOrganisation_IncludesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_IncludesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ListModuleNamesCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/cli-scripts/HaddockProjectOrganisation_ListModuleNamesCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_LoginException'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/exceptions/HaddockProjectOrganisation_LoginException.inc.php';
			break;

		case('HaddockProjectOrganisation_LoginManager'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/managers/HaddockProjectOrganisation_LoginManager.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleConfigException'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/exceptions/HaddockProjectOrganisation_ModuleConfigException.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleConfigFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/HaddockProjectOrganisation_ModuleConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleConfigXMLFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_ModuleConfigXMLFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectoriesHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_ModuleDirectoriesHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectoryHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_ModuleDirectoryHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleNameTests'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/unit-tests/HaddockProjectOrganisation_ModuleNameTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ModulesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ModulesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_NavigationLinksFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_NavigationLinksFile.inc.php';
			break;

		case('HaddockProjectOrganisation_OptionButtonsFactory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/factories/HaddockProjectOrganisation_OptionButtonsFactory.inc.php';
			break;

		case('HaddockProjectOrganisation_PageConfigFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_PageConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_PageDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_PageDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PagesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_PagesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PasswordResetException'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/exceptions/HaddockProjectOrganisation_PasswordResetException.inc.php';
			break;

		case('HaddockProjectOrganisation_PHPIncFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_PHPIncFile.inc.php';
			break;

		case('HaddockProjectOrganisation_PlugInModuleDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_PlugInModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PlugInModulesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_PlugInModulesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PlugInsDirectoryTests'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/unit-tests/HaddockProjectOrganisation_PlugInsDirectoryTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ProjectDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectDirectoryFinder'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/finders/HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectDirectoryHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_ProjectDirectoryHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectInformationHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_ProjectInformationHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectInformationSettingTests'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/unit-tests/HaddockProjectOrganisation_ProjectInformationSettingTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectInformationTests'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/unit-tests/HaddockProjectOrganisation_ProjectInformationTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/input-validation/HaddockProjectOrganisation_ProjectNameValidator.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificConfigFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_ProjectSpecificConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ProjectSpecificDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDirectoryHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_ProjectSpecificDirectoryHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDirectoryTests'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/unit-tests/HaddockProjectOrganisation_ProjectSpecificDirectoryTests.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectTitleInferenceTests'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/unit-tests/HaddockProjectOrganisation_ProjectTitleInferenceTests.inc.php';
			break;

		case('HaddockProjectOrganisation_PSModuleConfigFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_PSModuleConfigFile.inc.php';
			break;

		case('HaddockProjectOrganisation_PublicPageDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_PublicPageDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_RequiredModulesFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_RequiredModulesFile.inc.php';
			break;

		case('HaddockProjectOrganisation_SetProjectInformationCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/cli-scripts/HaddockProjectOrganisation_SetProjectInformationCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_ShowProjectInformationCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/cli-scripts/HaddockProjectOrganisation_ShowProjectInformationCLIScript.inc.php';
			break;

		case('HaddockProjectOrganisation_StandardModuleSubDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_StandardModuleSubDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_WWWIncludesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_WWWIncludesDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_WWWPageDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_WWWPageDirectory.inc.php';
			break;

		case('HPO_NoISCFileException'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/exceptions/HPO_NoISCFileException.inc.php';
			break;

		case('HTMLTags_A'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_A.inc.php';
			break;

		case('HTMLTags_Abbr'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Abbr.inc.php';
			break;

		case('HTMLTags_Attribute'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_Attribute.inc.php';
			break;

		case('HTMLTags_AttributeWithValue'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_AttributeWithValue.inc.php';
			break;

		case('HTMLTags_BareAttribute'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_BareAttribute.inc.php';
			break;

		case('HTMLTags_BLSeparatedPFactory'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/factories/HTMLTags_BLSeparatedPFactory.inc.php';
			break;

		case('HTMLTags_BLSeparatedPsRenderer'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/renderers/HTMLTags_BLSeparatedPsRenderer.inc.php';
			break;

		case('HTMLTags_BR'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_BR.inc.php';
			break;

		case('HTMLTags_Button'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Button.inc.php';
			break;

		case('HTMLTags_Caption'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Caption.inc.php';
			break;

		case('HTMLTags_Code'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Code.inc.php';
			break;

		case('HTMLTags_ColGroup'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_ColGroup.inc.php';
			break;

		case('HTMLTags_ConfirmationP'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_ConfirmationP.inc.php';
			break;

		case('HTMLTags_DD'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_DD.inc.php';
			break;

		case('HTMLTags_Div'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Div.inc.php';
			break;

		case('HTMLTags_DL'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_DL.inc.php';
			break;

		case('HTMLTags_DT'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_DT.inc.php';
			break;

		case('HTMLTags_Em'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Em.inc.php';
			break;

		case('HTMLTags_Embed'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Embed.inc.php';
			break;

		case('HTMLTags_ExceptionDiv'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_ExceptionDiv.inc.php';
			break;

		case('HTMLTags_FieldSet'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_FieldSet.inc.php';
			break;

		case('HTMLTags_FillTable'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_FillTable.inc.php';
			break;

		case('HTMLTags_FluidBoxDiv'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_FluidBoxDiv.inc.php';
			break;

		case('HTMLTags_Form'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Form.inc.php';
			break;

		case('HTMLTags_FormActionAttribute'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_FormActionAttribute.inc.php';
			break;

		case('HTMLTags_FormWithInputs'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_FormWithInputs.inc.php';
			break;

		case('HTMLTags_Heading'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Heading.inc.php';
			break;

		case('HTMLTags_HiddenInput'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_HiddenInput.inc.php';
			break;

		case('HTMLTags_HR'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_HR.inc.php';
			break;

		case('HTMLTags_HReviewDiv'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_HReviewDiv.inc.php';
			break;

		case('HTMLTags_IMG'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_IMG.inc.php';
			break;

		case('HTMLTags_Input'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Input.inc.php';
			break;

		case('HTMLTags_InputTag'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_InputTag.inc.php';
			break;

		case('HTMLTags_Label'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Label.inc.php';
			break;

		case('HTMLTags_LastActionBoxDiv'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_LastActionBoxDiv.inc.php';
			break;

		case('HTMLTags_Legend'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Legend.inc.php';
			break;

		case('HTMLTags_LI'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_LI.inc.php';
			break;

		case('HTMLTags_Link'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Link.inc.php';
			break;

		case('HTMLTags_LinkFactory'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/factories/HTMLTags_LinkFactory.inc.php';
			break;

		case('HTMLTags_LinkRenderer'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/renderers/HTMLTags_LinkRenderer.inc.php';
			break;

		case('HTMLTags_List'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_List.inc.php';
			break;

		case('HTMLTags_Meta'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Meta.inc.php';
			break;

		case('HTMLTags_MetaWithNameAndContent'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_MetaWithNameAndContent.inc.php';
			break;

		case('HTMLTags_Noscript'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Noscript.inc.php';
			break;

		case('HTMLTags_Object'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Object.inc.php';
			break;

		case('HTMLTags_OL'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_OL.inc.php';
			break;

		case('HTMLTags_Option'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Option.inc.php';
			break;

		case('HTMLTags_P'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_P.inc.php';
			break;

		case('HTMLTags_Param'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Param.inc.php';
			break;

		case('HTMLTags_Pre'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Pre.inc.php';
			break;

		case('HTMLTags_Script'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Script.inc.php';
			break;

		case('HTMLTags_ScriptRenderer'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/renderers/HTMLTags_ScriptRenderer.inc.php';
			break;

		case('HTMLTags_Select'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Select.inc.php';
			break;

		case('HTMLTags_SelectFactory'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/factories/HTMLTags_SelectFactory.inc.php';
			break;

		case('HTMLTags_SimpleForm'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_SimpleForm.inc.php';
			break;

		case('HTMLTags_SimpleOLForm'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_SimpleOLForm.inc.php';
			break;

		case('HTMLTags_Span'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Span.inc.php';
			break;

		case('HTMLTags_StyleSheetLink'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/extensions/HTMLTags_StyleSheetLink.inc.php';
			break;

		case('HTMLTags_Table'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Table.inc.php';
			break;

		case('HTMLTags_Tag'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_Tag.inc.php';
			break;

		case('HTMLTags_TagContent'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagContent.inc.php';
			break;

		case('HTMLTags_TagWithContent'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';
			break;

		case('HTMLTags_TagWithoutContent'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithoutContent.inc.php';
			break;

		case('HTMLTags_TBody'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_TBody.inc.php';
			break;

		case('HTMLTags_TD'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_TD.inc.php';
			break;

		case('HTMLTags_TextArea'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_TextArea.inc.php';
			break;

		case('HTMLTags_TFoot'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_TFoot.inc.php';
			break;

		case('HTMLTags_TH'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_TH.inc.php';
			break;

		case('HTMLTags_THead'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_THead.inc.php';
			break;

		case('HTMLTags_Title'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Title.inc.php';
			break;

		case('HTMLTags_TR'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_TR.inc.php';
			break;

		case('HTMLTags_TruncatedSpanFactory'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/factories/HTMLTags_TruncatedSpanFactory.inc.php';
			break;

		case('HTMLTags_UL'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_UL.inc.php';
			break;

		case('HTMLTags_URL'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_URL.inc.php';
			break;

		case('HTMLTags_ValueNotSetInSelectException'): 
			require_once PROJECT_ROOT . '/haddock/html-tags/classes/exceptions/HTMLTags_ValueNotSetInSelectException.inc.php';
			break;

		case('InputValidation_CLIInterrogator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_CLIInterrogator.inc.php';
			break;

		case('InputValidation_CreateInputValidatorCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/cli-scripts/InputValidation_CreateInputValidatorCLIScript.inc.php';
			break;

		case('InputValidation_CreateRegexValidatorCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/cli-scripts/InputValidation_CreateRegexValidatorCLIScript.inc.php';
			break;

		case('InputValidation_EmailAddressValidator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_EmailAddressValidator.inc.php';
			break;

		case('InputValidation_InputValidatorNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/input-validation/InputValidation_InputValidatorNameValidator.inc.php';
			break;

		case('InputValidation_InputValidatorsHelper'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/helpers/InputValidation_InputValidatorsHelper.inc.php';
			break;

		case('InputValidation_InvalidInputException'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_InvalidInputException.inc.php';
			break;

		case('InputValidation_NumberValidator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_NumberValidator.inc.php';
			break;

		case('InputValidation_RegexValidator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/input-validation/InputValidation_RegexValidator.inc.php';
			break;

		case('InputValidation_StringValidator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_StringValidator.inc.php';
			break;

		case('InputValidation_Validator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_Validator.inc.php';
			break;

		case('Logging_Logger'): 
			require_once PROJECT_ROOT . '/haddock/logging/classes/Logging_Logger.inc.php';
			break;

		case('Logging_LogsHelper'): 
			require_once PROJECT_ROOT . '/haddock/logging/classes/helpers/Logging_LogsHelper.inc.php';
			break;

		case('Logging_ServerLogsTable'): 
			require_once PROJECT_ROOT . '/haddock/logging/classes/database/elements/table-subclasses/Logging_ServerLogsTable.inc.php';
			break;

		case('Logging_ServerLogsTableRenderer'): 
			require_once PROJECT_ROOT . '/haddock/logging/classes/database/renderers/table-renderers/Logging_ServerLogsTableRenderer.inc.php';
			break;

		case('MailingList_ConfigManager'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/MailingList_ConfigManager.inc.php';
			break;

		case('MailingList_EmailTooLongException'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/exceptions/MailingList_EmailTooLongException.inc.php';
			break;

		case('MailingList_InvalidEmailException'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/exceptions/MailingList_InvalidEmailException.inc.php';
			break;

		case('MailingList_NameAndEmailException'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/exceptions/MailingList_NameAndEmailException.inc.php';
			break;

		case('MailingList_NameTooLongException'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/exceptions/MailingList_NameTooLongException.inc.php';
			break;

		case('MailingList_PCROFactory'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/MailingList_PCROFactory.inc.php';
			break;

		case('MailingList_PeopleHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/helpers/MailingList_PeopleHelper.inc.php';
			break;

		case('MailingList_PeopleTable'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/database/elements/table-subclasses/MailingList_PeopleTable.inc.php';
			break;

		case('MailingList_PeopleTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/database/renderers/table-renderers/MailingList_PeopleTableRenderer.inc.php';
			break;

		case('MailingList_PersonRow'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/database/elements/row-subclasses/MailingList_PersonRow.inc.php';
			break;

		case('MailingList_PersonRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/database/renderers/row-renderers/MailingList_PersonRowRenderer.inc.php';
			break;

		case('MailingList_SignUpPage'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/pages/html/MailingList_SignUpPage.inc.php';
			break;

		case('MailingList_SignUpRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/pages/redirect-scripts/MailingList_SignUpRedirectScript.inc.php';
			break;

		case('MailingList_SignUpRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/renderers/MailingList_SignUpRenderer.inc.php';
			break;

		case('MailingList_SignUpURLFactory'): 
			require_once PROJECT_ROOT . '/plug-ins/mailing-list/classes/url-factories/MailingList_SignUpURLFactory.inc.php';
			break;

		case('ModelViewController_Model'): 
			require_once PROJECT_ROOT . '/haddock/model-view-controller/classes/ModelViewController_Model.inc.php';
			break;

		case('Navigation_1DTreeRetriever'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/database/retrievers/Navigation_1DTreeRetriever.inc.php';
			break;

		case('Navigation_1DULRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/renderers/Navigation_1DULRenderer.inc.php';
			break;

		case('Navigation_HTMLListsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/helpers/Navigation_HTMLListsHelper.inc.php';
			break;

		case('Navigation_LinkNode'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/Navigation_LinkNode.inc.php';
			break;

		case('Navigation_LinksTree'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/Navigation_LinksTree.inc.php';
			break;

		case('Navigation_ManageNodesAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/pages/Navigation_ManageNodesAdminPage.inc.php';
			break;

		case('Navigation_ManageNodesAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/pages/Navigation_ManageNodesAdminRedirectScript.inc.php';
			break;

		case('Navigation_ManageTreesAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/pages/Navigation_ManageTreesAdminPage.inc.php';
			break;

		case('Navigation_ManageTreesAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/pages/Navigation_ManageTreesAdminRedirectScript.inc.php';
			break;

		case('Navigation_ManageURLsAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/pages/Navigation_ManageURLsAdminPage.inc.php';
			break;

		case('Navigation_ManageURLsAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/pages/Navigation_ManageURLsAdminRedirectScript.inc.php';
			break;

		case('Navigation_NodeRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/renderers/Navigation_NodeRenderer.inc.php';
			break;

		case('Navigation_NodesCRUDManager'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/Navigation_NodesCRUDManager.inc.php';
			break;

		case('Navigation_NodesHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/helpers/Navigation_NodesHelper.inc.php';
			break;

		case('Navigation_SPoE'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/Navigation_SPoE.inc.php';
			break;

		case('Navigation_TreesCRUDManager'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/Navigation_TreesCRUDManager.inc.php';
			break;

		case('Navigation_URLsCRUDManager'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/Navigation_URLsCRUDManager.inc.php';
			break;

		case('News_ManageNewsItemsAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/news/classes/crud-pages/manage-news-items/News_ManageNewsItemsAdminPage.inc.php';
			break;

		case('News_ManageNewsItemsAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/news/classes/crud-pages/manage-news-items/News_ManageNewsItemsAdminRedirectScript.inc.php';
			break;

		case('News_NewsItemsCRUDManager'): 
			require_once PROJECT_ROOT . '/plug-ins/news/classes/crud-pages/manage-news-items/News_NewsItemsCRUDManager.inc.php';
			break;

		case('News_SPoE'): 
			require_once PROJECT_ROOT . '/plug-ins/news/classes/News_SPoE.inc.php';
			break;

		case('ObjectOrientation_CompilationTests'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/unit-tests/ObjectOrientation_CompilationTests.inc.php';
			break;

		case('ObjectOrientation_CountPHPClassFilesInProjectCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/cli-scripts/ObjectOrientation_CountPHPClassFilesInProjectCLIScript.inc.php';
			break;

		case('ObjectOrientation_CreateHelperCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/cli-scripts/ObjectOrientation_CreateHelperCLIScript.inc.php';
			break;

		case('ObjectOrientation_HelperNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/input-validation/ObjectOrientation_HelperNameValidator.inc.php';
			break;

		case('ObjectOrientation_HelpersHelper'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/helpers/ObjectOrientation_HelpersHelper.inc.php';
			break;

		case('ObjectOrientation_ModulesHelper'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/helpers/ObjectOrientation_ModulesHelper.inc.php';
			break;

		case('ObjectOrientation_NamedMethodCaller'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/ObjectOrientation_NamedMethodCaller.inc.php';
			break;

		case('ObjectOrientation_UpperCamelCaseValidator'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/input-validation/ObjectOrientation_UpperCamelCaseValidator.inc.php';
			break;

		case('OrderedTables_AdminCRUDHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/helpers/OrderedTables_AdminCRUDHelper.inc.php';
			break;

		case('OrderedTables_AdminCRUDManager'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/managers/OrderedTables_AdminCRUDManager.inc.php';
			break;

		case('OrderedTables_AdminCRUDShiftRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/pages/redirect-scripts/OrderedTables_AdminCRUDShiftRedirectScript.inc.php';
			break;

		case('OrderedTables_DataRow'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/database/elements/OrderedTables_DataRow.inc.php';
			break;

		case('OrderedTables_FARSFromClause'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/database/sql/clauses/OrderedTables_FARSFromClause.inc.php';
			break;

		case('OrderedTables_FARSOrderByClause'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/database/sql/clauses/OrderedTables_FARSOrderByClause.inc.php';
			break;

		case('OrderedTables_FARSSelectClause'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/database/sql/clauses/OrderedTables_FARSSelectClause.inc.php';
			break;

		case('OrderedTables_FetchAllRowsSelectQuery'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/database/sql/statements/OrderedTables_FetchAllRowsSelectQuery.inc.php';
			break;

		case('OrderedTables_ReorderRowsHTMLTable'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/html-tags/OrderedTables_ReorderRowsHTMLTable.inc.php';
			break;

		case('OrderedTables_ReorderTableAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/pages/html/OrderedTables_ReorderTableAdminPage.inc.php';
			break;

		case('OrderedTables_ReorderTableAdminPageConfigFile'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/config-files/OrderedTables_ReorderTableAdminPageConfigFile.inc.php';
			break;

		case('OrderedTables_ReorderTableAdminPageConfigFileFactory'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/factories/OrderedTables_ReorderTableAdminPageConfigFileFactory.inc.php';
			break;

		case('OrderedTables_ReorderTableAdminPageHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/helpers/OrderedTables_ReorderTableAdminPageHelper.inc.php';
			break;

		case('OrderedTables_ReorderTableAdminPageManager'): 
			require_once PROJECT_ROOT . '/plug-ins/ordered-tables/classes/managers/OrderedTables_ReorderTableAdminPageManager.inc.php';
			break;

		case('Payments_AbstractModuleDirectory'): 
			require_once PROJECT_ROOT . '/plug-ins/payments/classes/Payments_AbstractModuleDirectory.inc.php';
			break;

		case('Payments_ModuleConfigFile'): 
			require_once PROJECT_ROOT . '/plug-ins/payments/classes/Payments_ModuleConfigFile.inc.php';
			break;

		case('Payments_OptionButtonsFactory'): 
			require_once PROJECT_ROOT . '/plug-ins/payments/classes/Payments_OptionButtonsFactory.inc.php';
			break;

		case('Payments_PlugInModuleDirectory'): 
			require_once PROJECT_ROOT . '/plug-ins/payments/classes/Payments_PlugInModuleDirectory.inc.php';
			break;

		case('PaypalPayments_TransactionsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/protx-payments/classes/database/renderers/table-renderers/PaypalPayments_TransactionsTableRenderer.inc.php';
			break;

		case('Polls_AnswersCRUDManager'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/crud-pages/manage-answers/Polls_AnswersCRUDManager.inc.php';
			break;

		case('Polls_ChooseCurrentQuestionAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/pages/admin/Polls_ChooseCurrentQuestionAdminPage.inc.php';
			break;

		case('Polls_ChooseCurrentQuestionAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/pages/admin/Polls_ChooseCurrentQuestionAdminRedirectScript.inc.php';
			break;

		case('Polls_ManageAnswersAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/crud-pages/manage-answers/Polls_ManageAnswersAdminPage.inc.php';
			break;

		case('Polls_ManageAnswersAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/crud-pages/manage-answers/Polls_ManageAnswersAdminRedirectScript.inc.php';
			break;

		case('Polls_ManageQuestionsAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/crud-pages/manage-questions/Polls_ManageQuestionsAdminPage.inc.php';
			break;

		case('Polls_ManageQuestionsAdminRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/crud-pages/manage-questions/Polls_ManageQuestionsAdminRedirectScript.inc.php';
			break;

		case('Polls_QuestionsCRUDManager'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/crud-pages/manage-questions/Polls_QuestionsCRUDManager.inc.php';
			break;

		case('Polls_SPoE'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/Polls_SPoE.inc.php';
			break;

		case('Polls_VotingRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/polls/classes/pages/Polls_VotingRedirectScript.inc.php';
			break;

		case('ProtxPayments_TransactionRow'): 
			require_once PROJECT_ROOT . '/plug-ins/protx-payments/classes/database/elements/row-subclasses/ProtxPayments_TransactionRow.inc.php';
			break;

		case('ProtxPayments_TransactionsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/protx-payments/classes/database/elements/table-subclasses/ProtxPayments_TransactionsTable.inc.php';
			break;

		case('PublicHTML_AboutHaddockCMS'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/html/PublicHTML_AboutHaddockCMS.inc.php';
			break;

		case('PublicHTML_AJAXFormHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_AJAXFormHelper.inc.php';
			break;

		case('PublicHTML_AssembleHTAccessCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/cli-scripts/PublicHTML_AssembleHTAccessCLIScript.inc.php';
			break;

		case('PublicHTML_ConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_ConfigManager.inc.php';
			break;

		case('PublicHTML_Exception'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/exceptions/PublicHTML_Exception.inc.php';
			break;

		case('PublicHTML_ExceptionHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_ExceptionHelper.inc.php';
			break;

		case('PublicHTML_ExceptionPage'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/PublicHTML_ExceptionPage.inc.php';
			break;

		case('PublicHTML_ExceptionRenderer'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/renderers/PublicHTML_ExceptionRenderer.inc.php';
			break;

		case('PublicHTML_GDPNGImage'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/png/PublicHTML_GDPNGImage.inc.php';
			break;

		case('PublicHTML_HaddockHTTPResponse'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/PublicHTML_HaddockHTTPResponse.inc.php';
			break;

		case('PublicHTML_HTMLPage'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/PublicHTML_HTMLPage.inc.php';
			break;

		case('PublicHTML_HTTPResponse'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_HTTPResponse.inc.php';
			break;

		case('PublicHTML_HTTPResponseWithMessageBody'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/PublicHTML_HTTPResponseWithMessageBody.inc.php';
			break;

		case('PublicHTML_IncludesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_IncludesDirectory.inc.php';
			break;

		case('PublicHTML_JavaScriptPage'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/PublicHTML_JavaScriptPage.inc.php';
			break;

		case('PublicHTML_PageDirectory'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_PageDirectory.inc.php';
			break;

		case('PublicHTML_PageManager'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_PageManager.inc.php';
			break;

		case('PublicHTML_PageNotFoundException'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/exceptions/PublicHTML_PageNotFoundException.inc.php';
			break;

		case('PublicHTML_PagesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_PagesDirectory.inc.php';
			break;

		case('PublicHTML_PCROFactory'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_PCROFactory.inc.php';
			break;

		case('PublicHTML_PNGImage'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/png/PublicHTML_PNGImage.inc.php';
			break;

		case('PublicHTML_ProjectRootDotHTAcessFileTests'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/unit-tests/PublicHTML_ProjectRootDotHTAcessFileTests.inc.php';
			break;

		case('PublicHTML_PublicURLFactory'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_PublicURLFactory.inc.php';
			break;

		case('PublicHTML_RedirectionHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_RedirectionHelper.inc.php';
			break;

		case('PublicHTML_RedirectionManager'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/PublicHTML_RedirectionManager.inc.php';
			break;

		case('PublicHTML_RedirectScript'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/PublicHTML_RedirectScript.inc.php';
			break;

		case('PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/cli-scripts/PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript.inc.php';
			break;

		case('PublicHTML_ServerAccessControlHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_ServerAccessControlHelper.inc.php';
			break;

		case('PublicHTML_ServerAddressesHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_ServerAddressesHelper.inc.php';
			break;

		case('PublicHTML_ServerAddressTests'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/unit-tests/PublicHTML_ServerAddressTests.inc.php';
			break;

		case('PublicHTML_ServerAddressValidator'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/input-validation/PublicHTML_ServerAddressValidator.inc.php';
			break;

		case('PublicHTML_ServerCapabilitiesHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_ServerCapabilitiesHelper.inc.php';
			break;

		case('PublicHTML_SetServerAddressCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/cli-scripts/PublicHTML_SetServerAddressCLIScript.inc.php';
			break;

		case('PublicHTML_ShowServerAddressCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/cli-scripts/PublicHTML_ShowServerAddressCLIScript.inc.php';
			break;

		case('PublicHTML_URLFactory'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/url-factories/PublicHTML_URLFactory.inc.php';
			break;

		case('PublicHTML_URLHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_URLHelper.inc.php';
			break;

		case('PublicHTML_VHostTests'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/unit-tests/PublicHTML_VHostTests.inc.php';
			break;

		case('Security_PasswordGenerator'): 
			require_once PROJECT_ROOT . '/haddock/security/classes/Security_PasswordGenerator.inc.php';
			break;

		case('Shop_AddressesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_AddressesTable.inc.php';
			break;

		case('Shop_AddressRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_AddressRow.inc.php';
			break;

		case('Shop_AddressRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_AddressRowRenderer.inc.php';
			break;

		case('Shop_AdminDisassociateProductPhotoRedirectScript'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/pages/redirect-scripts/Shop_AdminDisassociateProductPhotoRedirectScript.inc.php';
			break;

		case('Shop_AdminProductsPage'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/pages/Shop_AdminProductsPage.inc.php';
			break;

		case('Shop_CheckoutManager'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/Shop_CheckoutManager.inc.php';
			break;

		case('Shop_CommenterRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_CommenterRow.inc.php';
			break;

		case('Shop_CommentRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_CommentRow.inc.php';
			break;

		case('Shop_CommentRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_CommentRowRenderer.inc.php';
			break;

		case('Shop_CommentsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_CommentsTable.inc.php';
			break;

		case('Shop_CommentsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_CommentsTableRenderer.inc.php';
			break;

		case('Shop_CurrenciesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_CurrenciesTable.inc.php';
			break;

		case('Shop_CurrenciesTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_CurrenciesTableRenderer.inc.php';
			break;

		case('Shop_CurrencyRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_CurrencyRow.inc.php';
			break;

		case('Shop_CurrencyRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_CurrencyRowRenderer.inc.php';
			break;

		case('Shop_CustomerRegionRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_CustomerRegionRow.inc.php';
			break;

		case('Shop_CustomerRegionRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_CustomerRegionRowRenderer.inc.php';
			break;

		case('Shop_CustomerRegionsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_CustomerRegionsTable.inc.php';
			break;

		case('Shop_CustomerRegionsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_CustomerRegionsTableRenderer.inc.php';
			break;

		case('Shop_CustomerRegionSupplierLinkRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_CustomerRegionSupplierLinkRow.inc.php';
			break;

		case('Shop_CustomerRegionSupplierLinkRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_CustomerRegionSupplierLinkRowRenderer.inc.php';
			break;

		case('Shop_CustomerRegionSupplierLinksTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_CustomerRegionSupplierLinksTable.inc.php';
			break;

		case('Shop_CustomerRegionSupplierLinksTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_CustomerRegionSupplierLinksTableRenderer.inc.php';
			break;

		case('Shop_CustomerRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_CustomerRow.inc.php';
			break;

		case('Shop_CustomerRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_CustomerRowRenderer.inc.php';
			break;

		case('Shop_CustomersTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_CustomersTable.inc.php';
			break;

		case('Shop_CustomersTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_CustomersTableRenderer.inc.php';
			break;

		case('Shop_EmailAddressesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_EmailAddressesTable.inc.php';
			break;

		case('Shop_EmailAddressRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_EmailAddressRow.inc.php';
			break;

		case('Shop_Exception'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/exceptions/Shop_Exception.inc.php';
			break;

		case('Shop_ImageRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ImageRow.inc.php';
			break;

		case('Shop_ImageRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_ImageRowRenderer.inc.php';
			break;

		case('Shop_LanguageRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_LanguageRow.inc.php';
			break;

		case('Shop_LanguageRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_LanguageRowRenderer.inc.php';
			break;

		case('Shop_LanguagesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_LanguagesTable.inc.php';
			break;

		case('Shop_LanguagesTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_LanguagesTableRenderer.inc.php';
			break;

		case('Shop_LogInException'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/Shop_LogInException.inc.php';
			break;

		case('Shop_LogInManager'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/Shop_LogInManager.inc.php';
			break;

		case('Shop_ManagementHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/helpers/Shop_ManagementHelper.inc.php';
			break;

		case('Shop_OrderRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_OrderRow.inc.php';
			break;

		case('Shop_OrderRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_OrderRowRenderer.inc.php';
			break;

		case('Shop_OrdersTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_OrdersTable.inc.php';
			break;

		case('Shop_OrdersTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_OrdersTableRenderer.inc.php';
			break;

		case('Shop_PayPalSettingRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_PayPalSettingRow.inc.php';
			break;

		case('Shop_PayPalSettingsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_PayPalSettingsTable.inc.php';
			break;

		case('Shop_PhotographRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_PhotographRow.inc.php';
			break;

		case('Shop_PhotographRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_PhotographRowRenderer.inc.php';
			break;

		case('Shop_PhotographsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_PhotographsTable.inc.php';
			break;

		case('Shop_PhotographsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_PhotographsTableRenderer.inc.php';
			break;

		case('Shop_ProductBrandRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ProductBrandRow.inc.php';
			break;

		case('Shop_ProductBrandRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_ProductBrandRowRenderer.inc.php';
			break;

		case('Shop_ProductBrandsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ProductBrandsTable.inc.php';
			break;

		case('Shop_ProductBrandsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_ProductBrandsTableRenderer.inc.php';
			break;

		case('Shop_ProductCategoriesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ProductCategoriesTable.inc.php';
			break;

		case('Shop_ProductCategoriesTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_ProductCategoriesTableRenderer.inc.php';
			break;

		case('Shop_ProductCategoryRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ProductCategoryRow.inc.php';
			break;

		case('Shop_ProductCategoryRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_ProductCategoryRowRenderer.inc.php';
			break;

		case('Shop_ProductCurrencyPriceRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ProductCurrencyPriceRow.inc.php';
			break;

		case('Shop_ProductCurrencyPriceRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_ProductCurrencyPriceRowRenderer.inc.php';
			break;

		case('Shop_ProductCurrencyPricesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ProductCurrencyPricesTable.inc.php';
			break;

		case('Shop_ProductCurrencyPricesTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_ProductCurrencyPricesTableRenderer.inc.php';
			break;

		case('Shop_ProductPhotographLinkRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ProductPhotographLinkRow.inc.php';
			break;

		case('Shop_ProductPhotographLinksTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ProductPhotographLinksTable.inc.php';
			break;

		case('Shop_ProductRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ProductRow.inc.php';
			break;

		case('Shop_ProductRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_ProductRowRenderer.inc.php';
			break;

		case('Shop_ProductsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/helpers/Shop_ProductsHelper.inc.php';
			break;

		case('Shop_ProductsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ProductsTable.inc.php';
			break;

		case('Shop_ProductsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_ProductsTableRenderer.inc.php';
			break;

		case('Shop_ProductTagRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ProductTagRow.inc.php';
			break;

		case('Shop_ProductTagRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_ProductTagRowRenderer.inc.php';
			break;

		case('Shop_ProductTagsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ProductTagsTable.inc.php';
			break;

		case('Shop_ProductTagsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_ProductTagsTableRenderer.inc.php';
			break;

		case('Shop_ProductTextLinkRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ProductTextLinkRow.inc.php';
			break;

		case('Shop_ProductTextLinksTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ProductTextLinksTable.inc.php';
			break;

		case('Shop_ProtxPayments'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/Shop_ProtxPayments.inc.php';
			break;

		case('Shop_ShoppingBasketRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_ShoppingBasketRow.inc.php';
			break;

		case('Shop_ShoppingBasketRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_ShoppingBasketRowRenderer.inc.php';
			break;

		case('Shop_ShoppingBasketsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_ShoppingBasketsTable.inc.php';
			break;

		case('Shop_ShoppingBasketsTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_ShoppingBasketsTableRenderer.inc.php';
			break;

		case('Shop_StockLevelsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/helpers/Shop_StockLevelsHelper.inc.php';
			break;

		case('Shop_StockNotAvailableException'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/exceptions/Shop_StockNotAvailableException.inc.php';
			break;

		case('Shop_SumOfMoney'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/Shop_SumOfMoney.inc.php';
			break;

		case('Shop_SupplierRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_SupplierRow.inc.php';
			break;

		case('Shop_SupplierRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_SupplierRowRenderer.inc.php';
			break;

		case('Shop_SupplierShippingPriceRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_SupplierShippingPriceRow.inc.php';
			break;

		case('Shop_SupplierShippingPriceRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/row-renderers/Shop_SupplierShippingPriceRowRenderer.inc.php';
			break;

		case('Shop_SupplierShippingPricesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_SupplierShippingPricesTable.inc.php';
			break;

		case('Shop_SupplierShippingPricesTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_SupplierShippingPricesTableRenderer.inc.php';
			break;

		case('Shop_SuppliersTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_SuppliersTable.inc.php';
			break;

		case('Shop_SuppliersTableRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/renderers/table-renderers/Shop_SuppliersTableRenderer.inc.php';
			break;

		case('Shop_TelephoneNumberRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_TelephoneNumberRow.inc.php';
			break;

		case('Shop_TelephoneNumbersTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_TelephoneNumbersTable.inc.php';
			break;

		case('Shop_TextRow'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/row-subclasses/Shop_TextRow.inc.php';
			break;

		case('Shop_TextsTable'): 
			require_once PROJECT_ROOT . '/plug-ins/shop/classes/database/elements/table-subclasses/Shop_TextsTable.inc.php';
			break;

		case('Strings_Converter'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_Converter.inc.php';
			break;

		case('Strings_Describer'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_Describer.inc.php';
			break;

		case('Strings_FilteringHelper'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/helpers/Strings_FilteringHelper.inc.php';
			break;

		case('Strings_SimpleFilters'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_SimpleFilters.inc.php';
			break;

		case('Strings_Splitter'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_Splitter.inc.php';
			break;

		case('Strings_SplittingHelper'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/helpers/Strings_SplittingHelper.inc.php';
			break;

		case('Templates_TemplateHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/templates/classes/helpers/Templates_TemplateHelper.inc.php';
			break;

		case('TrackitStockManagement_CacheHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_CacheHelper.inc.php';
			break;

		case('TrackitStockManagement_ConfigManager'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/TrackitStockManagement_ConfigManager.inc.php';
			break;

		case('TrackitStockManagement_DeadLockFileRemovalEmail'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/emails/TrackitStockManagement_DeadLockFileRemovalEmail.inc.php';
			break;

		case('TrackitStockManagement_DeletionFile'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/file-system/files/TrackitStockManagement_DeletionFile.inc.php';
			break;

		case('TrackitStockManagement_DeletionFilesHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_DeletionFilesHelper.inc.php';
			break;

		case('TrackitStockManagement_Email'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/emails/TrackitStockManagement_Email.inc.php';
			break;

		case('TrackitStockManagement_FeedFilesHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_FeedFilesHelper.inc.php';
			break;

		case('TrackitStockManagement_FeedFilesTable'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/database/elements/table-subclasses/TrackitStockManagement_FeedFilesTable.inc.php';
			break;

		case('TrackitStockManagement_ImageFilesHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_ImageFilesHelper.inc.php';
			break;

		case('TrackitStockManagement_ImageTextFile'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/file-system/files/TrackitStockManagement_ImageTextFile.inc.php';
			break;

		case('TrackitStockManagement_LockFilesHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_LockFilesHelper.inc.php';
			break;

		case('TrackitStockManagement_ManagementHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_ManagementHelper.inc.php';
			break;

		case('TrackitStockManagement_ManageProductsAdminPage'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/pages/html/admin/crud/TrackitStockManagement_ManageProductsAdminPage.inc.php';
			break;

		case('TrackitStockManagement_Model'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/models/TrackitStockManagement_Model.inc.php';
			break;

		case('TrackitStockManagement_PhotographsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_PhotographsHelper.inc.php';
			break;

		case('TrackitStockManagement_Product'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/models/TrackitStockManagement_Product.inc.php';
			break;

		case('TrackitStockManagement_ProductDeletionUpdateStatement'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/sql/statements/TrackitStockManagement_ProductDeletionUpdateStatement.inc.php';
			break;

		case('TrackitStockManagement_ProductRow'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/database/elements/row-subclasses/TrackitStockManagement_ProductRow.inc.php';
			break;

		case('TrackitStockManagement_ProductRowRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/database/renderers/row-renderers/TrackitStockManagement_ProductRowRenderer.inc.php';
			break;

		case('TrackitStockManagement_ProductsCRUDAdminManager'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/managers/admin/crud/TrackitStockManagement_ProductsCRUDAdminManager.inc.php';
			break;

		case('TrackitStockManagement_ProductsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_ProductsHelper.inc.php';
			break;

		case('TrackitStockManagement_StockLevelsHelper'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/helpers/TrackitStockManagement_StockLevelsHelper.inc.php';
			break;

		case('TrackitStockManagement_TextFeedFile'): 
			require_once PROJECT_ROOT . '/plug-ins/trackit-stock-management/classes/file-system/files/TrackitStockManagement_TextFeedFile.inc.php';
			break;

		case('UnitTests_CreateUnitTestsClassCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/cli-scripts/UnitTests_CreateUnitTestsClassCLIScript.inc.php';
			break;

		case('UnitTests_RunAllTestsCLIScript'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/cli-scripts/UnitTests_RunAllTestsCLIScript.inc.php';
			break;

		case('UnitTests_TestResult'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/UnitTests_TestResult.inc.php';
			break;

		case('UnitTests_TestResultsSet'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/UnitTests_TestResultsSet.inc.php';
			break;

		case('UnitTests_TestsHelper'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/helpers/UnitTests_TestsHelper.inc.php';
			break;

		case('UnitTests_UnitTests'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/UnitTests_UnitTests.inc.php';
			break;

		case('UnitTests_UnitTestsClassesHelper'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/helpers/UnitTests_UnitTestsClassesHelper.inc.php';
			break;

		case('UnitTests_UnitTestsClassNameValidator'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/input-validation/UnitTests_UnitTestsClassNameValidator.inc.php';
			break;

		case('UnitTests_UnitTestsPHPClassFile'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/UnitTests_UnitTestsPHPClassFile.inc.php';
			break;
		
	}
}

?>
