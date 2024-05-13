PARTICIPANT ACCEPTED
<?php
// Required if your environment does not handle autoloading
require 'C:\xampp\htdocs\Projet\FrontBack12\twilio-php-main\src\Twilio\autoload.php';

// Your Account SID and Auth Token from console.twilio.com
$sid = "AC9282842a7b7b0103a65e2ab2c10828e0";
$token = "d17983dee5dc8a7d02d1def8fb48095e";


$client = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$client->messages->create(
    // The number you'd like to send the message to
    '+21624458899',
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+12176162476',
        
        // The body of the text message you'd like to send
        'body' => "You are accepted for the training"
    ]
);
header('Location: list.php');

