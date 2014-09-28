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

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'body', 'user_id', 'category_id'];

}