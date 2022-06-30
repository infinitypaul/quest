<?php
namespace App\Checkers;

use App\Checkers\Errors\Errors;
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





    #[Pure] public function __construct(array $data){

        $this->data = $this->extractWildCartData($data);
        $this->errors = new Errors();
    }


    protected function extractWildCartData($data, $root='', $results=[]): mixed
    {
        foreach ($data as $key => $value){
            if (is_array($value)){
                $results = array_merge($results, $this->extractWildCartData($value, $root.$key.'.'));
            } else {
                $results[$root.$key] = $value;
            }
        }

        return $results;
    }

    /**
     * @param array $rules
     * @return void
     */
    public function setRules(array $rules){
        $this->rules = $rules;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->rules as $field => $rules){
            foreach ($this->resolveRules($rules) as $rule){
                $this->validateRule($field, $rule);
            }
        }

        return $this->errors->hasErrors();
    }


    /**
     * @param array $rules
     * @return array
     */
    protected function resolveRules(array $rules): array
    {
        return array_map(function ($rule){
            if(is_string($rule)){
                return $this->getRuleFromString($rule);
            }
           return $rule;
        }, $rules);
    }


    /**
     * @param $rule
     * @return mixed
     */
    protected function getRuleFromString($rule){
        return $this->newRuleFromMap(
            ($exploded = explode(':', $rule))[0],
            explode('.', end($exploded))
        );


    }

    protected function newRuleFromMap($rule, $options){
        return RuleMap::resolve($rule, $options);
    }


    /**
     * @param $field
     * @param Rule $rule
     * @return void
     */
    public function validateRule($field, Rule $rule){
        foreach ($this->getMatchingData($field) as $matchedField){
            $this->validateUsingRuleObject($matchedField, $this->getFieldValue($matchedField, $this->data), $rule );
        }

    }

    /**
     * @param $field
     * @param $value
     * @param Rule $rule
     * @return void
     */
    protected function validateUsingRuleObject($field, $value, Rule $rule){
        if(!$rule->passes($field, $value)){
            $this->errors->add($field, $rule->message($field));
        }
    }


    protected function getMatchingData($field): bool|array
    {
        return preg_grep('/^' . str_replace('*', '([^\.]+)', $field) . '/', array_keys($this->data));
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