<?php

namespace App\Checkers\Rules;

class Sequence extends Rule
{

    public function passes($field, $value): bool
    {
        return !preg_match('/(\w)\1{3,}/', $value);
    }

    public function message($field): string
    {
        return $field.' Has Three Sequence Of The Same Character';
    }
}