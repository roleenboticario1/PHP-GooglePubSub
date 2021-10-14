<?php

require 'vendor/autoload.php';
use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;

$subscriptionName = "Subdcription-for-topic3";

$pubsub = new PubSubClient([
       'keyFile' => json_decode(file_get_contents('sandbox-cloud-pub-sub.json'), true)
]);

foreach ($pubsub->topics() as $topic) {
    printf('Topic: %s' . PHP_EOL, $topic->name()."<br/>");
}

?>