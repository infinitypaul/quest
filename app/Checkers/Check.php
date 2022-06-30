<?php
namespace App\Checkers;

use App\Checkers\Errors\Errors;
use App\Checkers\Rules\EmailRule;
use App\Checkers\Rules\MinRule;
use App\Checkers\Rules\PasswordRule;
use App\Checkers\Rules\Required;
use App\Checkers\Rules\Rule;
use JetBrains\PhpStorm\Pure;

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


    protected Errors $errors;


    protected array $ruleMap = [
        'required' => Required::class,
        'email' => EmailRule::class,
        'min' => MinRule::class,
        'password' => PasswordRule::class
    ];


    #[Pure] public function __construct(array $data){

        $this->data = $data;
        $this->errors = new Errors();
    }

    /**
     * @param array $rules
     * @return void
     */
    public function setRules(array $rules){
        $this->rules = $rules;
    }

    public function validate(): bool
    {
        foreach ($this->rules as $field => $rules){
            foreach ($this->resolveRules($rules) as $rule){
                $this->validateRule($field, $rule);
            }
        }

        return $this->errors->hasErrors();
    }


    protected function resolveRules(array $rules): array
    {
        return array_map(function ($rule){
            if(is_string($rule)){
                return $this->getRuleFromString($rule);
            }
           return $rule;
        }, $rules);
    }


    protected function getRuleFromString($rule){
        $exploded = explode(':', $rule);
        $rule = $exploded[0];
        $options = explode('.', end($exploded));
        return new $this->ruleMap[$rule](...$options);
    }




    public function validateRule($field, Rule $rule){
       if(!$rule->passes($field, $this->getFieldValue($field, $this->data))){
           $this->errors->add($field, $rule->message($field));
       }
    }

    /**
     * @param $field
     * @param $data
     * @return string|null
     */
    public function getFieldValue($field, $data): ?string
    {
        return $data[$field] ?? null;
    }


    #[Pure] public function getErrors(): array
    {
        return $this->errors->getErrors();
    }
}