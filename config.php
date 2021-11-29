<?php

// session_start();

require 'vendor/autoload.php';
require 'Facebook/autoload.php';

define('APP_ID','438871320913160');
define('APP_SECRET','352d5f4f8af9221926eb8a6d528645a8');
define('API_VERSION','V2.5');
define('FB_BASE_URL','https://rav.ai/server.php');

// Google Settings
$google_client= new Google_Client();

// $google_client->setClientId('13381455356-f7iij4dn2sllosc3k7g45o3q3nf3h3pq.apps.googleusercontent.com');
$google_client->setClientId('526796319789-scngj7n37c4m6o6pblru0gf6663plpkm.apps.googleusercontent.com');
// $google_client->setClientSecret('gwZbrZfZmiq2uEZeSOY-SQIv');
$google_client->setClientSecret('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');
$google_client->setRedirectUri('https://rav.ai/server.php');
$google_client->addScope('email');
$google_client->addScope('profile');

// Facebook Settings
$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.5',
]);

$fb_helper = $fb->getRedirectLoginHelper();



?>