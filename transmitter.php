<?php

require 'vendor/autoload.php';
require 'hardware-resources/SystemInfo.php';

use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;

$cpu = "CPU Usage: " . $system->getCpuLoadPercentage() . "%";
$arrDisk = $system->getDisk();
$ramTotal = "RAM total: " . round($system->getRamTotal() / 1024 / 1024) . " MB";
$ramFree = "RAM free: " . round($system->getRamFree() / 1024 / 1024) . " MB";
$totalDisk = "Total Disc: " .$arrDisk['Total Disc'];
$availableDiscSpace = "Available Disc Space: ". $arrDisk['Available Disc Space'];
$usageSpace = "Disk Usage Space: ". $arrDisk['Usage Space'];
$percentageUsageSpace = "Disk Usage Space: ". $arrDisk['Percentage Usage Space']."%";
$ramFreeNum = round($system->getRamFree() / 1024 / 1024);
$cpuNum = $system->getCpuLoadPercentage();
$diskWarning = '';
$ramWarning = '';
$cpuWarning = '';
$warning = '';

if($arrDisk['Available Disc Space'] == 1) //If ram Equal to 1GB
{
    $diskWarning = "DISK Almost Full (Critical)";
}
else if($ramFreeNum == 100)  //If ram Equal to 100 MB
{
    $ramWarning = "RAM Almost Full (Critical)";
}
else if($cpuNum == 5)  //If CP Equal to 5%
{
    $cpuWarning = "CPU Almost Full (Critical)";
}
else if($cpuNum == 5 && $arrDisk['Available Disc Space'] == 1 && $ramFreeNum == 100)
{
    $warning = "CPU, DISK and RAM Almost Full (Critical)";
}

$pubSubClient = new PubSubClient([
    'keyFile' => json_decode(file_get_contents('C:\xampp\htdocs\PUB-SUB2\sandbox-cloud-pub-sub.json'), true)
]);

$ids = $_SERVER['argv'][1];
$id = substr($ids, 3);
echo $id;
$myfile = fopen("config.php", "w");
fwrite($myfile, $id);
fclose($myfile);

$topic = $pubSubClient->topic('samle-topic-name')
	->publish([
	    'data' => "ID: ".$id.", ".$cpu.", ".$ramTotal.", ".$ramFree.", ".$totalDisk.", ".$availableDiscSpace.", ".$usageSpace.", ".$percentageUsageSpace.", ".$diskWarning.", ".$ramWarning.", ".$cpuWarning.", ".$warning,
	    'attributes' => [
	        'location' => 'Sydney'
	    ]
]);

?>