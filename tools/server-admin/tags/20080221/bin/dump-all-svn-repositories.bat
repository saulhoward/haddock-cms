@ECHO OFF
REM BAT wrapper script for the dump-all-svn-repositories script.

REM Auto-generated on 2008-02-15.
REM DO NOT EDIT!

@ECHO ON

@php.exe ../../haddock/cli-scripts/bin/bin-runner.php --section=project-specific --script=dump-all-svn-repositories
