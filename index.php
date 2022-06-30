<?php

require_once 'vendor/autoload.php';

$check = new \App\Checkers\Check([
    'name' => '',
    'email' => 'i',
    'password' => '3'
]);

$check->setRules([
    'name' => [
        'required'
    ],
    'email' => [
        new \App\Checkers\Rules\Required(),
        'email'
    ],
    'password' => [
        'min:4'
    ]
]);


if(!$check->validate()){
    dump($check->getErrors());
} else {
    dump("passed");
};



