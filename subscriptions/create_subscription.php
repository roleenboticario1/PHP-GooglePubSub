<?php

require '../vendor/autoload.php';
use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;

 $pubsub = new PubSubClient([
        'keyFile' => json_decode(file_get_contents('../sandbox-cloud-pub-sub.json'), true)
]);

$topicName = "my-new-topic-3";
$subscriptionName = "Subdcription-for-topic10";

$topic = $pubsub->topic($topicName);
$subscription = $topic->subscription($subscriptionName);
$subscription->create();

printf('Subscription created: %s' . PHP_EOL, $subscription->name());


?>