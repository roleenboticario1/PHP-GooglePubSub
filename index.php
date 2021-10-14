<?php

require 'vendor/autoload.php';

use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\PubSub\PubSubClient;


// $ids =  $_SERVER['argv'][1];
// $id = substr($ids, 3);
// echo $id;
// $myfile = fopen("config.php", "w");
// fwrite($myfile, $id);

// fclose($myfile);

// $myfile = fopen("data.txt", "w") or die("Unable to open file");
  // $name = $_POST['name']."\n";
  // fwrite($myfile, $name);

  // $email = $_POST['email']."\n";
  // fwrite($myfile, $email);
  // fclose($myfile);

// echo "Enter First Number: ";

// $handle = fopen("php://stdin","r"); //Input stream

// $no1 = fgets($handle);

// echo "Enter Second Number: ";

// $no2 = fgets($handle);

// $no3 = $no1 + $no2;

// echo "The addition is : " .$no3;

//  $pubSubClient = new PubSubClient([
//      'keyFile' => json_decode(file_get_contents('sandbox-cloud-pub-sub.json'), true)
// ]);

// $subscription = $pubSubClient->subscription('sub-id123PHP');

// $messages = $subscription->pull();

// foreach ($messages as $message) {
//     $subscription->acknowledge($message);
// }


// $pubSubClient = new PubSubClient([
//     'keyFile' => json_decode(file_get_contents('sandbox-cloud-pub-sub.json'), true)
// ]);

// $topic = $pubSubClient->topic('topic-id123PHP')
//     ->publish([
//         'data' => 'This is the first message sent to the topic',
//         'attributes' => [
//             'location' => 'Sydney'
//         ]
//     ]);

// return response()->json('Success', 200);


// $pubSub = new PubSubClient();

// // Get an instance of a previously created topic.
// $topic = $pubSub->topic('topic-id123PHP');

// // Publish a message to the topic.
// $topic->publish([
//     'data' => 'My new message.',
//     'attributes' => [
//         'location' => 'Detroit'
//     ]
// ]);

// // Get an instance of a previously created subscription.
// $subscription = $pubSub->subscription('my_subscription');

// // Pull all available messages.
// $messages = $subscription->pull();

// foreach ($messages as $message) {
//     echo $message->data() . "\n";
//     echo $message->attribute('location');
// }

// //Authenticate using a keyfile path
// $cloud = new ServiceBuilder([
//     'keyFilePath' => 'sandbox-cloud-pub-sub.json'
// ]);

// // $env:GOOGLE_APPLICATION_CREDENTIALS="sandbox-cloud-pub-sub.json";

// // // Authenticate using keyfile data
// // $cloud = new ServiceBuilder([
// //     'keyFile' => json_decode(file_get_contents('sandbox-cloud-pub-sub.json'), true)
// // ]);

// // Expects Env PROJECT_ID, TOPIC_NAME **and** GOOGLE_APPLICATION_CREDENTIALS
// $projectId = getenv("sandbox-328904");
// $topicName = getenv("topic-id123PHP");

// $pubsub = new PubSubClient([
//         "projectId" => $projectId
// ]);

// $topic = $pubsub->topic($topicName);
// $topic->publish(["data"=>"Hello Freddie!"]);
// print("Message published" . PHP_EOL);


// $url = 'http://localhost:8000/api/v1/items';
// //The url you wish to send the POST request to

// //The data you want to send via POST
// $fields = [
//     'name'    => 'nag Run na',
//     'price' => 2,
//     'description' => 'asdadad',
//     // 'btnSubmit'         => 'Submit'
// ];

// //url-ify the data for the POST
// $fields_string = http_build_query($fields);

// //open connection
// $ch = curl_init();

// //set the url, number of POST vars, POST data
// curl_setopt($ch,CURLOPT_URL, $url);
// curl_setopt($ch,CURLOPT_POST, true);
// curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

// //So that curl_exec returns the contents of the cURL; rather than echoing it
// curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

// //execute post
// $result = curl_exec($ch);
// echo $result;

// $projectId = 'topic-test0001';
// $keyFile = file_get_contents(storage_path('sandbox-cloud-pub-sub.json'));
// $pubsub = new PubSubClient([
//     'projectId' => $projectId,
//     'keyFile' => json_decode($keyFile, true)
// ]);

// $httpPostRequestBody = file_get_contents('php://input');
// $requestData = json_decode($httpPostRequestBody, true);

// info(json_encode($requestData));

// $message = $pubsub->consume($requestData);
// info(json_encode($message));

// $container->set('subscription', 'subscription-test');
?>