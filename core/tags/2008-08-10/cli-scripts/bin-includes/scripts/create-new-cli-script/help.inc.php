A script that can be used to create a new script for in
a haddock project.
© Clear Line Web Design, 2007-07-31

Args
    
    --script-section
        The section where the script should be saved.
    --script-module
        The module where the script should be saved.
        If this is set when "script-section" is set
        to "project-specific", an exception is thrown.
    --script-name
        The name of the new script.
    
    --copyright
        The name of the copyright holder of the new script.
        If this is not set, the copyright holder as set
        in the project-specific config.xml file is used.
