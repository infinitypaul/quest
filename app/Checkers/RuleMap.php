<?php

namespace App\Checkers;

use App\Checkers\Rules\{DomainBlackListRule, EmailRule, MinRule, PasswordRule, Required, Sequence};


class RuleMap
{
    protected static array  $map = [
        'required' => Required::class,
        'email' => EmailRule::class,
        'min' => MinRule::class,
        'password' => PasswordRule::class,
        'blacklist' => DomainBlackListRule::class,
        'sequence' => Sequence::class
    ];

    public static function resolve($rule, $options){
        return new static::$map[$rule](...$options);
    }
}