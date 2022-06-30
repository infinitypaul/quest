<?php

require_once 'vendor/autoload.php';

$check = new \App\Checkers\Check([
    'name' => 'Paul'
]);

$check->setRules([
    'testing'
]);




dump($check);