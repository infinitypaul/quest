<?php
namespace App\Checkers;

use App\Checkers\Rules\Rule;

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

    public function validate(){
        foreach ($this->rules as $field => $rules){
            foreach ($rules as $rule){
                $this->validateRule($field, $rule);
            }
        }
    }

    public function validateRule($field, Rule $rule){
       if(!$rule->passes($field, $this->getFieldValue($field, $this->data))){
           dump($rule->message($field));
       }
    }

    /**
     * @param $field
     * @param $data
     * @return string|null
     */
    public function getFieldValue($field, $data){
        return $data[$field] ?? null;
    }
}