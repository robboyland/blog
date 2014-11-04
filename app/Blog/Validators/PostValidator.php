<?php namespace Blog\Validators;

class PostValidator extends Validator
{
    protected static $rules = [
        'title'   => 'required',
        'body'    => 'required',
        'user_id' => 'required',
        'categories' => 'required',
        'slug' => 'required'
    ];
}