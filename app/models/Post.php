<?php

class Post extends Eloquent {
    protected $table = 'posts';

    public function thread() {
        return $this->belongsTo('Thread');
    }

    public function user() {
        return $this->belongsTo('User');
    }
}