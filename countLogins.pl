#!/bin/perl

use strict;
use warnings;

my $numberOfLogins = 0;
my $filepath = 'H:\2016-2017\PERL\Login.txt';
my @months = ('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
open(FILE, "<$filepath") or die $!."\n";
my @loginArray = <FILE>;
for (my $count = 0; $count < scalar @loginArray; $count++){

		for(my $i = 0; $i < scalar @months; $i++){
			push(my @list, $_[9]);
			print "there were " . scalar @list . "logins in" . $months[$i] . "\n";
		}
}
}