#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

create-new-server-admin-script.pl

=head1 SYNOPSIS

    $ ./create-new-server-admin-script.pl --name NAME

=head1 DESCRIPTION

Creates a new server admin script.

=head2 Options

=over 12

=item C<-n|--name>

The name of the new script.

=item C<-h|--help>

Print this message and exit.

=item C<-d|--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-02

=cut

use Getopt::Long;
use Pod::Usage;
use POSIX qw(strftime);
use Cwd;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my ($name, $help, $debug);

GetOptions(
    'n|name=s' => \$name,
    'h|help' => \$help,
    'd|debug' => \$debug
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

$ServerAdminScripts::debug = $debug;

if ($ServerAdminScripts::debug) {
    print "Running in debug mode.\n";
}

# Check that the user set the name.
defined($name)
    or die "The name must be set with -n!\n";

# Check that the name has the correct form.
($name =~ /^[a-z\.-]+$/)
    or die "The name must only contain lower case letters, dots and hyphens!\n";

# Makes sure that the name ends ".pl".
$name =~ s/\.pl$//;
$name .= '.pl';

# If there's alread a script, warn and exit.
(-f $name)
    and die "There is aleady a script called $name in this directory!\n";

# Write the script.
my $date = strftime "%Y-%m-%d", gmtime;

my $script = <<SCRIPT;
#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

$name

=head1 SYNOPSIS

    \$ ./$name

=head1 DESCRIPTION

What this script does...

=head2 Options

=over 12

=item C<-h|--help>

Print this message and exit.

=item C<-d|--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, $date

=cut

use Getopt::Long;
use Pod::Usage;

use FindBin qw(\$Bin);
use lib "\$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my (\$help, \$debug);

GetOptions(
    'h|help' => \\\$help,
    'd|debug' => \\\$debug
);

if (defined(\$help)) {
    pod2usage(-verbose => 2);
}

\$ServerAdminScripts::debug = \$debug;

if (\$ServerAdminScripts::debug) {
    print STDERR "Running in debug mode.\\n";
}

SCRIPT

if ($ServerAdminScripts::debug) {
    print $script;
} else {
    open SAS, ">$name"
        or die "Unable to open $name for writing: $!\n";
        
    print SAS $script;
    
    close SAS;
}

# Make the script executable.
print_and_do_cmd("chmod +x $name");

# If the script is in a home directory, make it belong to that user.
if (&getcwd =~ m{/home/(.+?)/}) {
    my $user = $1;
    
    print_and_do_cmd("chown $user.$user $name");
}
