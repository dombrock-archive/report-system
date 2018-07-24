<?php
$ip = $_GET['ip'];
$zip = $_GET['zip'];
$link = $_GET['link'];
$ua = $_GET['user-agent'];
$os = $_GET['os'];
$size = $_GET['size'];
$name = $_GET['name'];
$device = $_GET['device'];
$paypal = $_GET['paypal'];
$comments = $_GET['comments'];

$data = "GLIT BETA\r\n";
$data .= "IP: ".$ip."\r\n";
$data .= "ZIP: ".$zip."\r\n";
$data .= "URL: ".$link."\r\n";
$data .= "UA: ".$ua."\r\n";
$data .= "OS: ".$os."\r\n";
$data .= "SIZE: ".$size."\r\n";
$data .= "NAME: ".$name."\r\n";
$data .= "DEVICE: ".$device."\r\n";
$data .= "PAYPAL: ".$paypal."\r\n";
$data .= "COMMENTS: ".$comments."\r\n";

$file = fopen("reports/".time().".txt", "w") or die("Unable to open file!");
fwrite($file, $data);
fclose($file);

print("GOT IT");
