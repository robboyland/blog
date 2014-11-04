<?php namespace Blog\Validators;

use Validator as V;

abstract class Validator
{
    protected $errors;

    public function getErrors()
    {
        return $this->errors;
    }

    public function isValid(array $attributes)
    {
        $v = V::make($attributes, static::$rules);

        if ($v->fails())
        {
            $this->errors = $v->messages();
            return false;
        }

        return true;
    }
}
