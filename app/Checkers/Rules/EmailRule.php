<?php

namespace App\Checkers\Rules;

class EmailRule extends Rule
{

    /**
     * @param $field
     * @param $value
     * @return bool
     */
    public function passes($field, $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field): string
    {
        return ucwords($field. ' Must Be A Valid Email Address');
    }
}