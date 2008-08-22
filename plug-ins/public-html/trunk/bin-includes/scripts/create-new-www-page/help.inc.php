The create-new-www-page script.
© Clear Line Web Design, 2007-08-27

This script is used to create a new www page.

    --page-section
        The section where the page should be saved.
    --page-module
        The module where the page should be saved.
        If this is set when "page-section" is set
        to "project-specific", an exception is thrown.
    --page-name
        The name of the new page.
    --page-type
        The type of the new page.
    
    --copyright
        The name of the copyright holder of the new page.
        If this is not set, the copyright holder as set
        in the project-specific config.xml file is used.
        