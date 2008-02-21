#!/bin/bash

# A little shell script to update a haddock project.
# @copyright Clear Line Web Design, 2007-09-19

echo "Updating the haddock core directory..."
pwd
cd haddock/
svn info
svn up

cd ..

if [ -d plug-ins ]; then
    echo "Updating the plug-ins directories..."
    cd plug-ins
    
    for i in $(ls); do
        svn info $i
        svn up $i
    done;
    
    cd ..
fi

echo "Updating the project-specific directory..."
cd project-specific
svn info
svn up

echo "Updating the .htaccess file for the project..."
cd ../haddock/cli-scripts/bin
php bin-runner.php --section=haddock --module=public-html --script=assemble-htaccess

echo "Updating the autoload .INC file..."
php bin-runner.php --section=haddock --module=haddock-project-organisation --script=assemble-autoload-file

echo "Returning to the document root..."
cd ../../..
pwd
