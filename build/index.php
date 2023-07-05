<?php

use Felixjanot\OssTd3\Api;



require_once __DIR__ . '/../vendor/autoload.php';
$client = Symfony\Component\HttpClient\HttpClient::create();

$api = new Api($client);
var_dump($api->getAllCharacters());
