#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

show-env.pl

=head1 SYNOPSIS

    $ ./show-env.pl

=head1 DESCRIPTION

Shows the environment variables.

=head1 AUTHOR

RFI 2007-06-26

=head1 LICENCE

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

http://www.gnu.org/licenses/gpl.html

=cut

print <<TOP;
The Environment variables:
    
TOP

foreach my $key (sort keys %ENV) {
    print "$key\n";
    
    my @items = split /[;:]/, $ENV{$key};
    for my $item (@items) {
        print "\t$item\n";
    }
}
