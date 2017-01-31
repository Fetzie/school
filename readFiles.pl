#!/bin/perl

#read files

use strict;
use warnings;


my $file = 'H:\2016-2017\PERL\filewithtext.txt';

open(FILE, $file);
my @text = <FILE>;
close(FILE);
print (@text);


open(FILE2, 'H:\2016-2017\PERL\filewithouttext.txt') or die "an error occurred: " . $! . "\n";