#!/bin/perl

use strict;
use warnings;

my $sumOfLiftDistances = 0;
my $skiPassNumber = '30201';
my @lineArray;
my $filepath = 'H:\2016-2017\PERL\LogSkiPass.txt';
my $line;
open(FILE, $filepath) or die "An error occurred: " . $! . "\n";

while($line, <FILE>){
	@lineArray = split(/\|/, $_);

	if ($lineArray[2] eq $skiPassNumber){
		$sumOfLiftDistances = add($sumOfLiftDistances, $lineArray[5]);
	}
}

print "total distance travelled: " . $sumOfLiftDistances . "\n";
close(FILE);