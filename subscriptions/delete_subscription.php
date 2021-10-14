<?php

require '../vendor/autoload.php';
use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;

$subscriptionName = "Subdcription-for-topic10";

$pubsub = new PubSubClient([
       'keyFile' => json_decode(file_get_contents('../sandbox-cloud-pub-sub.json'), true)
]);
$subscription = $pubsub->subscription($subscriptionName);
$subscription->delete();

printf('Subscription deleted: %s' . PHP_EOL, $subscription->name());


?>