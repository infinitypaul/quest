<?php

require_once 'vendor/autoload.php';

$check = new \App\Checkers\Check([
    'name' => '',
    'email' => [
        'infinitypaul@live.com',
        '',
        'ade',
        'ade@google.com'
    ],
    'password' => 'eeee'
]);

$check->setRules([
    'name' => [
        'required'
    ],
    'email.*' => [
        new \App\Checkers\Rules\Required(),
        'email',
        'blacklist'
    ],
    'password' => [
        'min:5',
        'sequence'
    ]
]);


if(!$check->validate()){
    dump($check->getErrors());
} else {
    dump("passed");
};



