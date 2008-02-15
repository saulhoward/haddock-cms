@ECHO OFF
REM BAT wrapper script for the empty-tables script.

REM Auto-generated on 2008-02-15.
REM DO NOT EDIT!

@ECHO ON

@php.exe ../../cli-scripts/bin/bin-runner.php --section=haddock --module=database --script=empty-tables
