#!/bin/perl
use strict;
use warnings;

# funktionen


sub begruessung {

my $returnValue="willkommen im perl unterricht\n";
print $returnValue;
return $returnValue;


}

sub param {
my @parameters;
	my $counter=1;
	my $element=$_;
	
	my @returnValue;
	foreach $element(@_){
		push (@returnValue, $element);
		print "line: $counter: $element\n";
		$counter++;
	}
return @returnValue;
}


sub quad {

foreach (@_){

my $quad = $_*$_;
print "$quad\n";

}

}


begruessung();

param(1, 2, 3, 4, 5);

quad(2, 4, 6, 8);