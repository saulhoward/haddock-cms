@ECHO OFF
REM BAT wrapper script for the list-public-pages script.

REM Auto-generated on 2008-04-30.
REM DO NOT EDIT!

@ECHO ON

@php.exe ../../cli-scripts/bin/bin-runner.php --section=haddock --module=public-html --script=list-public-pages
