#!/bin/bash

# Finds all the wrapper scripts in a haddock project executable.
# @copyright Clear Line Web Design, 2007-09-19

function search_dir_with_modules
{   
    echo "Making the scripts in the $1 folder executable..."
    cd $1
    
    for dir in $(ls)
    do
        if [ -d $dir ]
        then
            cd $dir
            
            echo "Looking in "
            pwd
            
            if [ -d bin ]
            then
                cd bin
                for f in $(ls *.sh)
                do
                    if [ ! -x $f ]
                    then
                        echo "Making $f executable"
                        chmod +x $f
                    else
                        echo "$f is already executable!"
                    fi;
                done
                cd ..
            else
                echo "No bin dir found!"
            fi
            cd ..
        fi
    done
    cd ..
}

function search_dir_without_modules
{   
    echo "Making the scripts in the $1 folder executable..."
    cd $1
    
    echo "Looking in "
    pwd
    
    if [ -d bin ]
    then
        cd bin
        for f in $(ls *.sh)
        do
            if [ ! -x $f ]
            then
                echo "Making $f executable"
                chmod +x $f
            else
                echo "$f is already executable!"
            fi;
        done
        cd ..
    else
        echo "No bin dir found!"
    fi
    cd ..
}

search_dir_with_modules haddock
search_dir_with_modules plug-ins
search_dir_without_modules project-specific
