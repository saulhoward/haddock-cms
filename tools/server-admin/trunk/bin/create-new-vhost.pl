#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

create-new-vhost.pl

=head1 SYNOPSIS

    # ./create-new-vhost.pl --project PROJECT --purpose PURPOSE -i ID

=head1 DESCRIPTION

The script that we use to create each new vhost.

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

=item C<w|password-scipt>

The name of the password setting script.

Default is "./set-password.sh"

=item C<i|project-id> ID

The DB ID of this project.

=item C<a|ip-address>

The IP address that this host will use.

If this is not set, the IP for the constructed address is looked up.

=item C<h|help>

Print this help message and exit.

=item C<d|debug>

Run in debug mode and don't change anything.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-27

=cut

use Getopt::Long;
use Pod::Usage;
use Socket;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.

my ($project, $purpose, $help, $password_script, $project_id, $ip_address, $debug);

GetOptions(
    'p|project=s' => \$project,
    'u|purpose=s' => \$purpose,
    'h|help' => \$help,
    'w|password-script=s' => \$password_script,
    'i|project-id=i' => \$project_id,
    'a|ip-address=s' => \$ip_address,
    'd|debug' => \$debug
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

$ServerAdminScripts::debug = $debug;

if ($debug) {
    print "Running in debug mode.\n";
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

## Make sure that the password setting script is set.
#defined($password_script)
#    or die "The password script must be set!\n";

# Set the password script to the default if not set.
unless (defined($password_script)) {
    $password_script = "$Bin/set-password.sh";
}

# Make sure that the password setting script is a file that exists.
(-f $password_script)
    or die "The password script must be a file set with -w!\n";

# Make sure that the project id is set.
defined($project_id)
    or die "The project ID must be set with -i!\n";

# Make sure that the project id is a positive number.
($project_id > 0)
    or die "The project ID must be greater than zero!\n";

# Decide on the domain used to access this site.
my $host = `hostname --fqdn`;
chomp $host;

my $domain = "$purpose.$project.$host";

# Make sure that the IP address for the vhost is set.
# If not, look it up.
unless (defined($ip_address)) {
    $ip_address = inet_ntoa(inet_aton($domain));
}

# Make sure that the IP address has the right form.
($ip_address =~ /\d+(?:\.\d+){3}/)
    or die "Not a valid IP address!\n";

# Show the user their options.
print "Project: $project\n";
print "Purpose: $purpose\n";
print "Password script: $password_script\n";
print "Domain: $domain\n";
print "Project ID: $project_id\n";
print "IP Address: $ip_address\n";

# Make the combined name.
# This is the login.
my $combined_name;

if ($purpose eq 'prod') {
    $combined_name = $project;
} else {
    $combined_name = $purpose . '_' . $project;
}

print "Combined name: $combined_name\n";

# Create a random password.
my $password = '';

{
    my @letters = ();
    
    push @letters, chr($_) for (ord('a') .. ord('z'));
    push @letters, chr($_) for (ord('A') .. ord('Z'));
    push @letters, $_ for (1 .. 9);
    
    #print "\@letters: @letters\n";
    
    for (0 .. 7) {
        $password .= $letters[rand scalar @letters];
    }
}

print "Password: $password\n";

# Does the user exist already?
if (getpwnam($combined_name)) {
    print "UNIX user $combined_name already exists.\n";
} else {
    # Create the user and their home directory.
    print_and_do_cmd("useradd --create-home --shell /bin/false $combined_name");
    
    # Set the user's password.
    print_and_do_cmd("/bin/sh $password_script $combined_name $password");
    
    # Add the user to the ftpusers group.
    print_and_do_cmd("usermod --groups ftpusers $combined_name");
}

# Add the necessary folders unless they already exist.
for (qw(public_html logs db-backups)) {
    my $dir = "/home/$combined_name/$_";
    
    if (-d $dir) {
        print "$dir already exists.\n";
    } else {
        print "mkdir $dir\n";
        mkdir $dir unless $debug;
    }
    
    print_and_do_cmd("chown -R $combined_name.$combined_name $dir");
}

# Add the user to apache unless it already exists.
my $apache_passwords_file = '/etc/apache2/passwords/passwords';
my $apache_user_exists = 0;

if (-f $apache_passwords_file) {
    open APF, "<$apache_passwords_file"
        or die "Unable to open $apache_passwords_file: $!\n";
    
    for (<APF>) {
        if (/([\w-]+):/) {
            if ($1 eq $combined_name) {
                $apache_user_exists = 1;
                last;
            }
        }
    }
    
    close APF;
}

if ($apache_user_exists) {
    print "Apache user $combined_name already exists.\n";
} else {
    print_and_do_cmd("htpasswd -b $apache_passwords_file $combined_name $password");
}

# Create the SSL certificates.

# Private key.
my $private_key_file = "/etc/apache2/ssl/$domain.private.pem";

if (-f $private_key_file) {
    print "Private key file $private_key_file already exists.\n";
} else {
    print_and_do_cmd("openssl genrsa -out $private_key_file 2048");
}

# Public key.
my $public_key_file = "/etc/apache2/ssl/$domain.public.pem";
if (-f $public_key_file) {
    print "Public key file $public_key_file already exists.\n";
} else {
    print_and_do_cmd("openssl req -new -x509 -subj '/C=UK/ST=East Sussex/L=Brighton/CN=$domain' -key $private_key_file -out $public_key_file -days 3650");
}

# Ownership & permissions.
for (qw(private public)) {
    print_and_do_cmd("chown www-data.www-data /etc/apache2/ssl/$domain.$_.pem");
    
    print_and_do_cmd("chmod 600 /etc/apache2/ssl/$domain.$_.pem");
}

# Add the vhost file.
my $vhost_conf_file = "/etc/apache2/sites-available/$domain.conf";

print "Vhost file: $vhost_conf_file\n";

if (-f $vhost_conf_file) {
    print "Vhost file $vhost_conf_file already exists.\n";
} else {
    my $secure_port = $project_id;
    
    if ($purpose eq 'dev') {
        $secure_port += 10000;
    } elsif ($purpose eq 'test') {
        $secure_port += 20000;
    } elsif ($purpose eq 'customer') {
        $secure_port += 30000;
    } elsif ($purpose eq 'prod') {
        $secure_port += 40000;
    }
    
    my $vhost = <<VHOST;
<VirtualHost $ip_address:80>
    ServerName $domain
    
    Redirect permanent / https://$domain:$secure_port/
</VirtualHost>

Listen $secure_port
NameVirtualHost $ip_address:$secure_port

<VirtualHost $ip_address:$secure_port>
    SSLEngine on
    SSLCertificateFile /etc/apache2/ssl/$domain.public.pem
    SSLCertificateKeyFile /etc/apache2/ssl/$domain.private.pem

    ServerName $domain

    DocumentRoot /home/$combined_name/public_html
    ErrorLog /home/$combined_name/logs/error.log
    CustomLog /home/$combined_name/logs/access.log combined

   <Location />
        AuthType Basic
        AuthName "$purpose for $project on $host"
        AuthUserFile /etc/apache2/passwords/passwords
        Require user $combined_name
    </Location>
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

# Symlink the vhost.
my $vhost_symlink = "/etc/apache2/sites-enabled/$domain.conf";

if (-f $vhost_symlink) {
    print "Symbolic link $vhost_symlink already exists.\n";
} else {
    print_and_do_cmd("ln -s $vhost_conf_file $vhost_symlink");
}

# Restart apache.
#print_and_do_cmd("/etc/init.d/apache2 restart");

# Create the MySQL database.
#my $db_name = $combined_name;
#
#{
#    my $cmd = "mysqladmin -";
#    print "$cmd\n";
#    system $cmd;
#}

# Create the MySQL user.

## Add the MySQL user and password to the backup script list.
#open BLF, ">>$backup_list"
#    or die "Cannot open $backup_list: $!\n";
#
## unix name, home dir, apache name, mysql name, mysql database, mysql host, mysql pw.
#print BLF "\"$combined_name\",\"/home/$combined_name\",\"$combined_name\",\"$combined_name\",\"$combined_name\",\"localhost\",$password\n";
#
#close BLF;

