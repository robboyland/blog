<?php

class Comment extends \Eloquent {

	protected $fillable = ['user_id', 'post_id', 'body'];

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}