#!/bin/sh
# \
# Taken from http://www.cyberciti.biz/tips/change-linux-or-unix-system-password-using-php-script.html \
# 2007-06-27 \
exec expect -f "$0" ${1+"$@"}
set password [lindex $argv 1]
spawn passwd [lindex $argv 0]
sleep 1
expect "assword:"
send "$password\r"
expect "assword:"
send "$password\r"
expect eof
