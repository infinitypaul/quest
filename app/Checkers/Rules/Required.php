<?php

namespace App\Checkers\Rules;

class Required extends Rule
{
    /**
     * @param $field
     * @param $value
     * @return bool
     */
    public function passes($field, $value): bool
    {
        return !empty($value);
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field): string
    {
        return ucwords($field. ' Is Required');
    }
}