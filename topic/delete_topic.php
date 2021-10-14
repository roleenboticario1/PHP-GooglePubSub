<?php

require '../vendor/autoload.php';

use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;


$topicName = 'my-new-topic-3';

$pubsub = new PubSubClient([
     'keyFile' => json_decode(file_get_contents('../sandbox-cloud-pub-sub.json'), true)
]);
$topic = $pubsub->topic($topicName);
$topic->delete();

printf('Topic deleted: %s' . PHP_EOL, $topic->name());

?>