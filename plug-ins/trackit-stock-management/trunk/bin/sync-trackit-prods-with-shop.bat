@ECHO OFF
REM BAT wrapper script for the sync-trackit-prods-with-shop script.

REM Auto-generated on 2008-04-30.
REM DO NOT EDIT!

@ECHO ON

@php.exe ../../../haddock/cli-scripts/bin/bin-runner.php --section=plug-ins --module=trackit-stock-management --script=sync-trackit-prods-with-shop
