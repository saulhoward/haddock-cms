The help messages for the script to list the classes in this project.
© Clear Line Web Design, 2007-07-04

Args:
    --search-section
        The section to search.
        One of:
            - haddock
            - plug-ins
            - project-specific
    --search-module
        The module that will be searched.
        If the search-section has been set to 'project-specific'
        this must not be set.
    --parent-class=PARENT_CLASS
        Find classes that are subclasses of PARENT_CLASS.
    --batch-mode
        Run in batch mode.
        Don't ask questions.
    --whole-project
        Whether to search the whole project or not.
    --csv
        Output in CSVs
    --methods
        List methods of the classes found or not.
        In batch or CSV mode, this doesn't work yet.
    --files
        List the files as well.
    --sort-methods
        Sort the methods or not.
        This should not be set when --methods is not set.
