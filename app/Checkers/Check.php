<?php
namespace App\Checkers;

class Check
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var array
     */
    protected array $rules = [];

    public function __construct(array $data){

        $this->data = $data;
    }

    /**
     * @param array $rules
     * @return void
     */
    public function setRules(array $rules){
        $this->rules = $rules;
    }
}