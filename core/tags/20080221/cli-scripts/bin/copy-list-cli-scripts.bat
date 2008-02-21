@ECHO OFF
REM The .BAT for the list-cli-scripts script.
REM © Clear Line Web Design, 2007-08-03

@ECHO ON
@php.exe "..\..\..\haddock\cli-scripts\bin\bin-runner.php" --section=haddock --module=cli-scripts --script=list-cli-scripts %1
