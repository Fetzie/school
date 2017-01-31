#!/usr/bin/perl
use strict;
use warnings;

my $input = '';  # Benutzereingabe

my @nums0 = ();   # Zahlen-Array
my $count0 = 0;   # Zaehler

my @nums1 = ();
my $count1 = 0;

my @nums3 = ();

while ($input ne ';') {
	print 'Bitte eine Zahl eingeben: ';
	chomp ($input = <STDIN>);
	if($input ne ';')
	{
		push(@nums0, $input);
	}else{
		while ($input ne ';') {
		print 'Bitte eine Zahl eingeben: ';
		chomp ($input = <STDIN>);
		if($input ne ';')
		{
			push(@nums0, $input);
		}
	}
	
	}
}
my $element;
foreach $element(@nums0){

	if ( $element ~~ @nums0 && $element ~~ @nums1 ){
		push($var, @nums2);
	}
	

}
