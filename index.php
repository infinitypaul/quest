<?php

require_once 'vendor/autoload.php';

$check = new \App\Checkers\Check([
    'name' => '',
    'email' => 'i'
]);

$check->setRules([
    'name' => [
        'required'
    ],
    'email' => [
        new \App\Checkers\Rules\Required(),
        'email'
    ]
]);


if(!$check->validate()){
    dump($check->getErrors());
} else {
    dump("passed");
};



