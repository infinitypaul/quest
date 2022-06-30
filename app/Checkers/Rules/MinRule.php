<?php

namespace App\Checkers\Rules;

class MinRule extends Rule
{
    protected int $minimumValue;

    public function __construct($minimumValue){

        $this->minimumValue = $minimumValue;
    }

    public function passes($field, $value): bool
    {
        return !(strlen($value) < $this->minimumValue);
    }

    public function message($field): string
    {
        return ucwords($field. ' Can Not Be Less Than '. $this->minimumValue);
    }
}