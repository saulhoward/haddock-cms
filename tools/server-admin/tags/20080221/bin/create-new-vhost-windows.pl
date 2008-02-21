#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

create-new-vhost-windows.pl

=head1 SYNOPSIS

    $ ./create-new-vhost-windows.pl

=head1 DESCRIPTION

Creates a new vhost on Windows.

=head2 Options

=over 12

=item C<p|project> PROJECT

The name of the project.

The project name should only contain lower case letters and hyphens.

=item C<u|purpose> PURPOSE

The purpose of this vhost.

Legal choices are

- dev
- test
- customer
- prod

=item C<h|hostname> HOSTNAME

The HOSTNAME.

=item C<d|directory> DIRECTORY

The directory where the vhosts are kept.

Default: "C:/Documents and Settings/Clear Line/My Documents/www"

=item C<--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-24

=cut

use Getopt::Long;
use Pod::Usage;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my ($project, $purpose, $project_id, $hostname, $directory, $help, $debug);

GetOptions(
    'p|project=s' => \$project,
    'u|purpose=s' => \$purpose,
    'h|hostname=s'=> \$hostname,
    'd|directory=s' => \$directory,
    'help' => \$help,
    'debug' => \$debug
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

$ServerAdminScripts::debug = $debug;

if ($ServerAdminScripts::debug) {
    print STDERR "Running in debug mode.\n";
}

defined($project)
    or die "The project name must be set with -p!\n";

# The project name can only contain lower case letters and hyphens.
($project =~ /^[a-z-]+$/)
    or die "The project name should only contain lower case letters and hyphens!\n";

defined($purpose)
    or die "The purose must be set with -u!\n";

# Make sure that the user has chosen a legal purpose.
{
    my @legal_purposes = qw(dev test customer prod);
    my $user_gave_legal_purpose = 0;
    
    for (@legal_purposes) {
        if ($_ eq $purpose) {
            $user_gave_legal_purpose = 1;
            last;
        }
    }
    
    die "Illegal purpose!\n" unless $user_gave_legal_purpose;
}

# Decide on the domain used to access this site.
defined($hostname)
    or die "The hostname must be set with -h!\n";

my $domain = "$purpose.$project.$hostname";

# Get the dir.
defined($directory)
    #or die "The directory must be set with -d!\n";
    or $directory = 'C:/Documents and Settings/Clear Line/My Documents/www';
    
(-d $directory)
    or die "$directory is not a directory!\n";

# Show the user their options.
print "Project: $project\n";
print "Purpose: $purpose\n";
print "Domain: $domain\n";
print "Directory: $directory\n";

# Make the combined name.
my $combined_name;

if ($purpose eq 'prod') {
    $combined_name = $project;
} else {
    $combined_name = $purpose . '_' . $project;
}

print "Combined name: $combined_name\n";

# Make the vhost dir.
my $vhost_dir = "$directory/$combined_name";
$vhost_dir =~ s{\\}{/}g;
if (-d $vhost_dir) {
    print STDERR "$vhost_dir already exists!";
} else {
    print_and_do_cmd("mkdir \"$vhost_dir\"");
}

# Add the necessary folders unless they already exist.
for (qw(public_html logs db-backups)) {
    my $dir = "$vhost_dir/$_";
    
    if (-d $dir) {
        print "$dir already exists.\n";
    } else {
        print_and_do_cmd("mkdir \"$dir\"");
    }
}

# Add the vhost file.
my $vhost_conf_file = "C:/Program Files/Apache Group/Apache2/conf/vhosts/$domain.conf";

print "Vhost file: $vhost_conf_file\n";

if (-f $vhost_conf_file) {
    print STDERR "Vhost file $vhost_conf_file already exists.\n";
} else {
    my $vhost = <<VHOST;
<VirtualHost *>
    ServerName $domain

    ServerName $domain

    DocumentRoot "$vhost_dir/public_html"
    ErrorLog "$vhost_dir/logs/error.log"
    CustomLog "$vhost_dir/logs/access.log" combined
    
    <Directory "$vhost_dir/public_html">
        AllowOverride All
    </Directory>
</VirtualHost>
VHOST
    
    if ($debug) {
        print $vhost;
    } else {
        open VHOST, ">$vhost_conf_file"
            or die "Unable to open $vhost_conf_file for writing! $!\n";
        
        print VHOST $vhost;
        
        close VHOST;
    }
}

# Stop and start the Apache2 service.
print_and_do_cmd('NET STOP apache2');
print_and_do_cmd('NET START apache2');
