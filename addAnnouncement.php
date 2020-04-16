<?php
require("connect.php");
// Enabling error reporting
error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/firebase.php';
require_once __DIR__ . '/push.php';

$firebase = new Firebase();
$push = new Push();

// optional payload
$payload = array();
$payload['team'] = 'India';
$payload['score'] = '5.6';

// notification title
$title = isset($_POST['inputType']) ? $_POST['inputType'] : '';

// notification message
$message = isset($_POST['inputBody']) ? $_POST['inputBody'] : '';

// push type - single user / topic
$push_type = isset($_POST['push_type']) ? $_POST['push_type'] : '';

// whether to include to image or not
$include_image = isset($_POST['include_image']) ? TRUE : FALSE;


$push->setTitle($title);
$push->setMessage($message);
if ($include_image) {
    $push->setImage('https://api.androidhive.info/images/minion.jpg');
} else {
    $push->setImage('');
}
$push->setIsBackground(FALSE);
$push->setPayload($payload);


$json = '';
$response = '';

$json = $push->getPush();
$response = $firebase->sendToTopic('quickbuyusers', $json);

header("Access-Control-Allow-Origin: *");

echo json_encode($response);
