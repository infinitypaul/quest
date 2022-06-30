<?php

namespace App\Checkers\Errors;

class Errors
{
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function add($key, $value){
        $this->errors[$key][] = $value;
    }

    public function hasErrors(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}