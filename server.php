<?php
 
error_reporting(~E_WARNING);
 
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

 
if( !socket_bind($sock, "0.0.0.0" , 4444) )
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not bind socket : [$errorcode] $errormsg \n");
}
 
while(1)
{
    $r = socket_recvfrom($sock, $buf, 512, 0, $remote_ip, $remote_port);
    $f = fopen($buf,"a") or die("Can not open file");
    $r = socket_recvfrom($sock, $buf, 512, 0, $remote_ip, $remote_port);
	fwrite($f,$buf);
	fwrite($f,"\n");
	fclose($f);
}
 
socket_close($sock);
