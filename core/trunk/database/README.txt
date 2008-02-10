=================================
The Haddock Core Database Package
RFI & SANH 2006-11-10
© 2006 Clear Line Web Design.
=================================

The Haddock Core Database Package attempts to provide an object oriented
interface to MySQL databases for PHP5.
The most important classes in the package are Database, Table, Row and Field,
which all extend Element.
These classes can be extended within the database package itself, within other
Haddock Core Packages (e.g. code-analysis), in Haddock plug-in modules (e.g. shop,
photo-gallery) and within specific projects (e.g. brighton-wok, kevin-bacon).

Choosing the correct class to instantiate is a somewhat complicated process
that relies on a file called

PROJECT_ROOT . '/project-specific/sql/database-class-names.txt'

that list which class should be used for each database element.

This file can be created easily using the script at

/admin/database/datbase-class-finding.html
