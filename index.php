<?php

require_once 'vendor/autoload.php';

$check = new \App\Checkers\Check([
    'name' => 'Paul'
]);

$check->setRules([
    'name' => [
        new \App\Checkers\Rules\Required()
    ]
]);




dump($check);