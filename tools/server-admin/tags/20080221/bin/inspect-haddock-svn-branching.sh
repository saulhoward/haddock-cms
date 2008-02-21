#!/bin/sh
# A script to look specifically at the haddock project's branching.
#
# This will only work on leon.
#
# @ Clear Line Web Design, 2007-04-26

/usr/bin/php ~/haddock-projects/leon/server-admin-scripts/development/public_html/haddock/cli-scripts/bin/bin-runner.php --module=project-specific --script=svn-branch-status --project-root=~/svn/clwd-repos/ragnar/haddock
