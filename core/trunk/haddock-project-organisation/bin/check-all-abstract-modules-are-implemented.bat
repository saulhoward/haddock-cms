@ECHO OFF
REM BAT wrapper script for the check-all-abstract-modules-are-implemented script.

REM Auto-generated on 2007-11-22.
REM DO NOT EDIT!

@ECHO ON

@php.exe ../../cli-scripts/bin/bin-runner.php --section=haddock --module=haddock-project-organisation --script=check-all-abstract-modules-are-implemented
