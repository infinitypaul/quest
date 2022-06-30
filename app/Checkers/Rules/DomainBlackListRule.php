<?php

namespace App\Checkers\Rules;

class DomainBlackListRule extends Rule
{
    protected $blacklist = [
        'live.com',
        'yahoo.com'
    ];

    public function passes($field, $value): bool
    {
        if( filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
            $explodedValue = explode('@', $value);
            $domain = array_pop($explodedValue);
            return !in_array($domain, $this->blacklist);
        }

        return false;
    }

    public function message($field): string
    {
        return $field.' Has Been Blacklisted';
    }
}