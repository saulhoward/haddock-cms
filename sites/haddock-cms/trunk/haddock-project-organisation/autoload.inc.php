<?php
/**
 * __autoload .INC file
 *
 * Last Modified: 2008-04-15
 */

function __autoload($class_name)
{
	switch ($class_name) {
	
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

		case('CLIScripts_BatWrapperScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_BatWrapperScript.inc.php';
			break;

		case('CLIScripts_BinIncludesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_BinIncludesDirectory.inc.php';
			break;

		case('CLIScripts_InputReader'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_InputReader.inc.php';
			break;

		case('CLIScripts_ScriptDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_ScriptDirectory.inc.php';
			break;

		case('CLIScripts_ScriptsDirectory'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_ScriptsDirectory.inc.php';
			break;

		case('CLIScripts_SHWrapperScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_SHWrapperScript.inc.php';
			break;

		case('CLIScripts_WrapperScript'): 
			require_once PROJECT_ROOT . '/haddock/cli-scripts/classes/CLIScripts_WrapperScript.inc.php';
			break;

		case('CodeAnalysis_ExecutionTimer'): 
			require_once PROJECT_ROOT . '/haddock/code-analysis/classes/CodeAnalysis_ExecutionTimer.inc.php';
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

		case('Database_DatabaseRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/Database_DatabaseRenderer.inc.php';
			break;

		case('Database_DateTimeField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_DateTimeField.inc.php';
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

		case('Database_EditRowOLForm'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_EditRowOLForm.inc.php';
			break;

		case('Database_Element'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_Element.inc.php';
			break;

		case('Database_EmailAddressVarCharField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_EmailAddressVarCharField.inc.php';
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

		case('Database_HTMLPreFieldRenderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/renderers/field-renderers/Database_HTMLPreFieldRenderer.inc.php';
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

		case('Database_IntField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_IntField.inc.php';
			break;

		case('Database_InvalidUserInputException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_InvalidUserInputException.inc.php';
			break;

		case('Database_LimitForm'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_LimitForm.inc.php';
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

		case('Database_PreviousNextUL'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/html-tags/Database_PreviousNextUL.inc.php';
			break;

		case('Database_Renderer'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_Renderer.inc.php';
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

		case('Database_SQLClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLClause.inc.php';
			break;

		case('Database_SQLDeleteStatement'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLDeleteStatement.inc.php';
			break;

		case('Database_SQLDirectory'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/Database_SQLDirectory.inc.php';
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

		case('Database_SQLUpdateStatement'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/statements/Database_SQLUpdateStatement.inc.php';
			break;

		case('Database_SQLWhereClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLWhereClause.inc.php';
			break;

		case('Database_SQLWhereClauseConditionSubClause'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/sql/clauses/Database_SQLWhereClauseConditionSubClause.inc.php';
			break;

		case('Database_StringField'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/elements/field-subclasses/Database_StringField.inc.php';
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

		case('Database_UserInputTooLongException'): 
			require_once PROJECT_ROOT . '/haddock/database/classes/exceptions/Database_UserInputTooLongException.inc.php';
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
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_ConfigManager.inc.php';
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
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/pages/DBPages_HTMLPage.inc.php';
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

		case('DBPages_SPoE'): 
			require_once PROJECT_ROOT . '/plug-ins/db-pages/classes/DBPages_SPoE.inc.php';
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

		case('ErrorHandling_SprintfException'): 
			require_once PROJECT_ROOT . '/haddock/error-handling/classes/exceptions/ErrorHandling_SprintfException.inc.php';
			break;

		case('FileSystem_Bz2TextFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_Bz2TextFile.inc.php';
			break;

		case('FileSystem_DataFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_DataFile.inc.php';
			break;

		case('FileSystem_Directory'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_Directory.inc.php';
			break;

		case('FileSystem_File'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_File.inc.php';
			break;

		case('FileSystem_PHPClassFile'): 
			require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_PHPClassFile.inc.php';
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

		case('Haddock_MailingListSignUpPage'): 
			require_once PROJECT_ROOT . '/project-specific/classes/pages/html/Haddock_MailingListSignUpPage.inc.php';
			break;

		case('HaddockCMS_DBPage'): 
			require_once PROJECT_ROOT . '/project-specific/classes/pages/html/HaddockCMS_DBPage.inc.php';
			break;

		case('HaddockCMS_ExceptionPage'): 
			require_once PROJECT_ROOT . '/project-specific/classes/pages/html/HaddockCMS_ExceptionPage.inc.php';
			break;

		case('HaddockCMS_HTMLPage'): 
			require_once PROJECT_ROOT . '/project-specific/classes/pages/html/HaddockCMS_HTMLPage.inc.php';
			break;

		case('HaddockProjectOrganisation_AbstractModuleConfigXMLFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_AbstractModuleConfigXMLFile.inc.php';
			break;

		case('HaddockProjectOrganisation_AbstractPlugInModuleDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_AbstractPlugInModuleDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadHelper'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/helpers/HaddockProjectOrganisation_AutoloadHelper.inc.php';
			break;

		case('HaddockProjectOrganisation_AutoloadIncFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_AutoloadIncFile.inc.php';
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

		case('HaddockProjectOrganisation_HPOConfigManager'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/managers/HaddockProjectOrganisation_HPOConfigManager.inc.php';
			break;

		case('HaddockProjectOrganisation_IncludesDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_IncludesDirectory.inc.php';
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

		case('HaddockProjectOrganisation_ModuleConfigXMLFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_ModuleConfigXMLFile.inc.php';
			break;

		case('HaddockProjectOrganisation_ModuleDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ModuleDirectory.inc.php';
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

		case('HaddockProjectOrganisation_ProjectDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ProjectDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectDirectoryFinder'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/finders/HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
			break;

		case('HaddockProjectOrganisation_ProjectSpecificDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_ProjectSpecificDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_PublicPageDirectory'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/directories/HaddockProjectOrganisation_PublicPageDirectory.inc.php';
			break;

		case('HaddockProjectOrganisation_RequiredModulesFile'): 
			require_once PROJECT_ROOT . '/haddock/haddock-project-organisation/classes/file-system/files/HaddockProjectOrganisation_RequiredModulesFile.inc.php';
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

		case('InputValidation_EmailAddressValidator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_EmailAddressValidator.inc.php';
			break;

		case('InputValidation_InvalidInputException'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_InvalidInputException.inc.php';
			break;

		case('InputValidation_NumberValidator'): 
			require_once PROJECT_ROOT . '/haddock/input-validation/classes/InputValidation_NumberValidator.inc.php';
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

		case('Navigation_1DTreeRetriever'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/database/retrievers/Navigation_1DTreeRetriever.inc.php';
			break;

		case('Navigation_1DULRenderer'): 
			require_once PROJECT_ROOT . '/plug-ins/navigation/classes/renderers/Navigation_1DULRenderer.inc.php';
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

		case('ObjectOrientation_NamedMethodCaller'): 
			require_once PROJECT_ROOT . '/haddock/object-orientation/classes/ObjectOrientation_NamedMethodCaller.inc.php';
			break;

		case('PublicHTML_AboutHaddockCMS'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/pages/html/PublicHTML_AboutHaddockCMS.inc.php';
			break;

		case('PublicHTML_AJAXFormHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_AJAXFormHelper.inc.php';
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

		case('PublicHTML_URLFactory'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/url-factories/PublicHTML_URLFactory.inc.php';
			break;

		case('PublicHTML_URLHelper'): 
			require_once PROJECT_ROOT . '/haddock/public-html/classes/helpers/PublicHTML_URLHelper.inc.php';
			break;

		case('Security_PasswordGenerator'): 
			require_once PROJECT_ROOT . '/haddock/security/classes/Security_PasswordGenerator.inc.php';
			break;

		case('Strings_Converter'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_Converter.inc.php';
			break;

		case('Strings_Describer'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_Describer.inc.php';
			break;

		case('Strings_SimpleFilters'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_SimpleFilters.inc.php';
			break;

		case('Strings_Splitter'): 
			require_once PROJECT_ROOT . '/haddock/strings/classes/Strings_Splitter.inc.php';
			break;

		case('UnitTests_UnitTests'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/UnitTests_UnitTests.inc.php';
			break;

		case('UnitTests_UnitTestsPHPClassFile'): 
			require_once PROJECT_ROOT . '/haddock/unit-tests/classes/UnitTests_UnitTestsPHPClassFile.inc.php';
			break;
		
	}
}

?>
