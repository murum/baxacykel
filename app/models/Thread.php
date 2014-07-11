<?php

class Thread extends Eloquent {
    protected $table = 'threads';

    public static $rules = array(

        'title' => 'required||min:4',
        'content' => 'required|min:8',

    );

    public function user() {
        return $this->belongsTo('User');
    }

    public function posts() {
        return $this->hasMany('Post');
    }
}