#!/usr/bin/perl 

use warnings;
use strict;

use IO::Socket;

my $host = '0.0.0.0';
my $port = 4444;

my $client = new IO::Socket(
    Domain   => PF_INET,
    Proto    => 'udp',
);

die "Unable to create socket: $!\n" unless $client;

my $servaddr = sockaddr_in($port, inet_aton($host));
while(1){
	my $data = <STDIN>;   
	chomp $data;
	$client->send($$, 0, $servaddr) or die "Send: $!\n"; 
	$client->send($data, 0, $servaddr) or die "Send: $!\n";
}
