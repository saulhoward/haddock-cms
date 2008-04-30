@ECHO OFF
REM BAT wrapper script for the drop-all-tables script.

REM Auto-generated on 2008-04-30.
REM DO NOT EDIT!

@ECHO ON

@php.exe ../../cli-scripts/bin/bin-runner.php --section=haddock --module=database --script=drop-all-tables
