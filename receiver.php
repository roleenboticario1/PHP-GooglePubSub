<?php

require 'vendor/autoload.php';

use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;

 $pubSubClient = new PubSubClient([
     'keyFile' => json_decode(file_get_contents('C:\xampp\htdocs\PUB-SUB2\sandbox-cloud-pub-sub.json'), true)
]);

$subscription = $pubSubClient->subscription('samle-subscription-id');

foreach ($subscription->pull() as $message) {
    printf('%s' . PHP_EOL, $message->data());
    $subscription->acknowledge($message);
}

?>