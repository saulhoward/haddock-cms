Increment Dump Filename
© Clear Line Web Design, 2007-02-08

A script to increment the numerical parts of all the
files in a MySQL or SVN dump directory.

Usage:

    --directory=[DIR]
        User asked, if not given.
    --max-copies=[MAX]
        Default: 3
    --help
    --silent

The files in the directory should be named

0000.dump
0001.dump
0002.dump
...

After running this script, those files would
be called:

0001.dump
0002.dump
0003.dump

If the maximum number of copies was set to
2, then "0003.dump" would be deleted.

The server can then be dumped to "0000.dump".

The intention is that there should be a backup
machine with these files in.

After this, the dump directory on the backup
machine should be incremented.

Also, "0001.dump" should be copied to "0000.dump".

Then rsync will be used to sync the two directories,
only needing to transfer the difference between the
latest dump and the previous dump.
