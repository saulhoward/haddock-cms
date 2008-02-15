#!/usr/bin/perl

$dir = $ARGV[0];

for (split /\n/, `ls -1 "$dir"`) {
    print "$dir/$_\n";
}
