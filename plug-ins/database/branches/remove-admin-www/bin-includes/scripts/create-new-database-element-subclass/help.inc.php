The create-new-database-element-subclass script.
© Clear Line Web Design, 2007-08-26

Creates a new subclass of one of the database element or
renderer classes.

Args:
    --class-section
        One of
            haddock
            plug-ins
            project-specific
    --class-module
        Must be set if section is 'haddock' or 'plug-ins'.
        Must not be set if section is 'project-specific'.
    --type
        Element or renderer.
    --entity
        One of:
            database
            table
            row
            field
    --table
        Must not be set if entity is 'database'.
        Must be set otherwise.
    --field
        Must be set if entity is 'field'.
        Must not be set otherwise.
    --class-name
        Override the automatically generated name for the class.
    --class-filename
        Override the automatically generated filename for the class.
