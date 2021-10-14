<?php

require '../vendor/autoload.php';
use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;

$subscriptionName = "samle-topic-name-sub";

$pubsub = new PubSubClient([
       'keyFile' => json_decode(file_get_contents('../sandbox-cloud-pub-sub.json'), true)
]);

$subscription = $pubsub->subscription($subscriptionName);
    $subscription->detach();

printf('Subscription detached: %s' . PHP_EOL, $subscription->name());

?>