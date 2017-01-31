#!/bin/perl

use strict;
use warnings;

my $filePathRead = 'H:\2016-2017\PERL\filewithtext.txt';
my $filePathWrite = 'H:\2016-2017\PERL\fileWithNewtext.txt';
open(FILE, $filePathRead) or die "An error occurred: " . $! . "\n";

my @datastream = <FILE>;
close(FILE);

open(FILE, ">$filePathWrite");
print FILE @datastream;
close(FILE);

