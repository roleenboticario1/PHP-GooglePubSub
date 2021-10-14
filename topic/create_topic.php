<?php

require '../vendor/autoload.php';
use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;

$pubsub = new PubSubClient([
    'keyFile' => json_decode(file_get_contents('../sandbox-cloud-pub-sub.json'), true)
]);

$topicName = 'my-new-topic-7';

$topic = $pubsub->createTopic($topicName);

echo 'Topic ' . $topic->name() . ' created.';

?>