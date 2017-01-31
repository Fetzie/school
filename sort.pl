#!/bin/perl
use strict;
use warnings;

my @unsortedArray=('c', 'f', 'A', 'Z', 4, 10, 2);

my @sortedArray=sort({$a <=> $b}@unsortedArray);

print "unsorted array: @unsortedArray\n";
print "sorted array: @sortedArray";
