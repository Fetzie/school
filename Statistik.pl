#!/usr/bin/perl
use strict;
use warnings;

my $input = '';  # Benutzereingabe
my @nums = ();   # Zahlen-Array
my $count = 0;   # Zaehler
my $sum = 0;     # Summe
my $avg = 0;     # Durchschnitt
my $med = 0;     # Median

while ($input ne ';') {
	print 'Bitte eine Zahl eingeben: ';
	chomp ($input = <STDIN>);
	if($input ne ';')
	{
		$nums[$count] = $input; #push(@nums, $input);
		#push(@nums, $input);
		$count++;
	}
}

my $element;
foreach $element(@nums)
{
	$sum += $element;
	#$sum = $sum + $element;
}
#Durchschnitt ermitteln
$avg = $sum / $count;
#/Median ermitteln: vorsicht Fehler! mittleres Element
my @sortiert = sort {$a <=> $b} (@nums);
$med = $nums[$count /2];
my $anz_elemente=@nums;

print "\nAnzahl der eingegebenen Zahlen: $count\n";
print "Summe der eingegebenen Zahlen: $sum\n";
printf("Durchschnitt: %.2f\n", $avg);
print "Median: $med\n";
print "Letzte Zahl im Array: $nums[$anz_elemente-1]\n";
print "Erste Zahl im Array: $nums[0]\n\n";

print @nums;  
print "\n"; 
$" = '-'; 
print "@nums"; 