@ECHO OFF
REM BAT wrapper script for the table-structure-synchronisation script.

REM Auto-generated on 2007-11-22.
REM DO NOT EDIT!

@ECHO ON

@php.exe ../../cli-scripts/bin/bin-runner.php --section=haddock --module=database --script=table-structure-synchronisation
