<?php

class Post extends \Eloquent {

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function tags() {
        return $this->belongsToMany('Tag');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['title', 'body', 'user_id', 'category_id'];

}