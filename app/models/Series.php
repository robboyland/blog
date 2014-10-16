<?php

class Series extends Eloquent {

	protected $fillable = ['title', 'user_id'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function post()
    {
        return $this->hasMany('Post');
    }
}