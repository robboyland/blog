<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'notify'];

    public function posts()
    {
        return $this->hasMany('Post');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function series()
    {
        return $this->hasMany('Series');
    }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function updateCredentials($input)
    {
        $this->notify = isset($input['notify']) ? 1 : 0;
        $this->save();
    }
}
