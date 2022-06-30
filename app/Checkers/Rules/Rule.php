<?php

namespace App\Checkers\Rules;

abstract class Rule
{
    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    abstract public function passes($field, $value): bool;


    /**
     * @param $field
     * @return mixed
     */
    abstract public function message($field): string;
}