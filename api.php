<?php
error_reporting(E_ALL);
ini_set('display_errors', false);

// this contains the constants PDO_DSN, PDO_USER, PDO_PASSWORD
include(__DIR__.'/src/config.php');

include(__DIR__.'/src/Api.php');

$api = new MediaWikiStatGadgetApi();
$api->execute();

